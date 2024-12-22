<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Auth\User as Authenticatable; // Import the correct user class
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\LengthAwarePaginator;
use Morilog\Jalali\Jalalian; // Add this line for Jalalian
use App\Exports\LogsExport;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class UserController extends Controller
{
    // Define permissions for each action in the controller
    public static $permissions = [
        'index' => 'manage users',
        'create' => 'create users',
        'store' => 'create users',
        'edit' => 'edit users',
        'update' => 'edit users',
        'destroy' => 'delete users',
        'onlyViewMembers' => 'view members',
        'logs' => 'view logs',

    ];

    public function index(Request $request)
    {
        $this->authorizeAction('index');
    
        $query = User::with('roles');
    
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }
    
        $users = $query->paginate(10);
    
        return view('admin.users.index', compact('users'));
    }
    
    
    



    
    


    public function create()
    {
        $this->authorizeAction('create');

        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.users.create', compact('roles', 'permissions'));
    }

    public function store(Request $request)
{
    $this->authorizeAction('store');

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'roles' => 'nullable|array',
        'roles.*' => 'exists:roles,id',
        'permissions' => 'nullable|array',
        'permissions.*' => 'exists:permissions,id',
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
    ]);

    // Sync roles
    if (!empty($validated['roles'])) {
        $roleNames = Role::whereIn('id', $validated['roles'])->pluck('name')->toArray();
        $user->syncRoles($roleNames);
    }

    // Sync permissions
    if (!empty($validated['permissions'])) {
        $permissionNames = Permission::whereIn('id', $validated['permissions'])->pluck('name')->toArray();
        $user->syncPermissions($permissionNames);
    }

    // Log the action
    Log::info("User created successfully: {$user->name}", [
        'performed_by' => auth()->user() ? auth()->user()->name : 'System',
        'ip_address' => request()->ip(),
        'browser' => request()->header('User-Agent'),
    ]);

    return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
}

    public function edit(User $user)
    {
        $this->authorizeAction('edit');

        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.users.edit', compact('user', 'roles', 'permissions'));
    }

    public function update(Request $request, User $user)
{
    $this->authorizeAction('update');

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'roles' => 'nullable|array',
        'roles.*' => 'exists:roles,id',
        'permissions' => 'nullable|array',
        'permissions.*' => 'exists:permissions,id',
    ]);

    $user->update([
        'name' => $validated['name'],
        'email' => $validated['email'],
    ]);

    // Log the specific update action
  Log::info("User updated successfully", [
    'old_name' => $user->getOriginal('name'),
    'new_name' => $user->name,
    'old_email' => $user->getOriginal('email'),
    'new_email' => $user->email,
    'performed_by' => auth()->user() ? auth()->user()->name : 'System',
    'ip_address' => $request->ip(),
    'browser' => $request->header('User-Agent'),
]);
Log::info("User created successfully: {$user->name} {\"performed_by\":\"{$performedBy}\",\"ip_address\":\"{$ip}\",\"browser\":\"{$browser}\"}");


    return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
}
  
    public function destroy(User $user)
    {
        $this->authorizeAction('destroy');
        Log::info("User deleted successfully: {$user->name}", [
            'performed_by' => auth()->user() ? auth()->user()->name : 'System',
            'ip_address' => request()->ip(),
            'browser' => request()->header('User-Agent'),
        ]);

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function onlyViewMembers()
    {
        $this->authorizeAction('onlyViewMembers');

        $role = Role::where('name', 'member')->first();

        if (!$role) {
            return redirect()->back()->with('error', 'Member role not found.');
        }

        $members = User::whereHas('roles', function ($query) use ($role) {
            $query->where('id', $role->id);
        })->get();

        return view('admin.users.only-view-members', compact('members'));
        
    }

    /**
     * Helper method to authorize actions based on permissions
     */
    protected function authorizeAction(string $action): void
    {
        // Fetch the required permission for the action from the permissions mapping
        $permission = self::$permissions[$action] ?? null;
    
        // If no permission is mapped for the action, deny access
        if (!$permission) {
            abort(403, 'Unauthorized action.');
        }
    
        // Check if the authenticated user has the required permission
         /** @var \App\Models\User|null $user */
        /** @var Authenticatable|null $user */
        $user = auth()->user();
        
    
        if (!$user || !$user->can($permission)) {
            abort(403, 'Unauthorized action.');
        }
    }
    public function generalUserData()
    {
         /** @var \App\Models\User|null $user */
        /** @var Authenticatable|null $user */
        $user = auth()->user();
    
        if (!$user || !$user->can('general user data')) {
            abort(403, 'Unauthorized action: Missing "general user data" permission.');
        }
    
        // Example: Get user counts by role and registration date
        $userCounts = User::selectRaw('roles.name as role, COUNT(users.id) as total')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->groupBy('roles.name')
            ->get();
    
        return view('admin.users.general-data', compact('userCounts'));
    }
    

public function userSummaryData()
{
    $totalUsers = User::count();
    $totalMembers = User::whereHas('roles', fn($q) => $q->where('name', 'member'))->count();
    $usersThisWeek = User::where('created_at', '>=', now()->startOfWeek())->count();
    $usersThisMonth = User::where('created_at', '>=', now()->startOfMonth())->count();

    return [
        'totalUsers' => $totalUsers,
        'totalMembers' => $totalMembers,
        'usersThisWeek' => $usersThisWeek,
        'usersThisMonth' => $usersThisMonth,
    ];
}



public function logs(Request $request)
{
    $logFile = storage_path('logs/laravel.log');

    if (!file_exists($logFile)) {
        return view('admin.logs.index', ['logs' => []]);
    }

    // Read the log file
    $logContents = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    $logs = [];
    foreach ($logContents as $line) {
        if (preg_match('/^\[(.*?)\] .*?\.(INFO|WARNING): (.*)$/', $line, $matches)) {
            $rawMessage = $matches[3];

            // Extract readable messages and JSON if available
            $readableMessage = $rawMessage;
            $context = [];

            if (preg_match('/(.*?)(\{.*\})/', $rawMessage, $logParts)) {
                $readableMessage = trim($logParts[1]);
                $context = json_decode($logParts[2], true) ?: [];
            }

            // Build a user-friendly message
            if (!empty($context)) {
                if (isset($context['user_id'], $context['original_data'], $context['updated_data'])) {
                    $changes = [];
                    foreach ($context['original_data'] as $key => $oldValue) {
                        $newValue = $context['updated_data'][$key] ?? $oldValue;
                        if ($oldValue !== $newValue) {
                            $changes[] = ucfirst($key) . " changed from '$oldValue' to '$newValue'";
                        }
                    }
                    $readableMessage .= ": " . implode(', ', $changes);
                }

                if (isset($context['performed_by'])) {
                    $readableMessage .= " (Performed by: {$context['performed_by']})";
                }
            }

            $logs[] = [
                'timestamp' => $matches[1],
                'level' => $matches[2],
                'message' => $readableMessage,
            ];
        }
    }

    // Sort logs in descending order
    $logs = collect($logs)->sortByDesc('timestamp')->values();

    // Handle pagination
    $perPage = 10;
    $page = $request->get('page', 1);
    $paginatedLogs = new \Illuminate\Pagination\LengthAwarePaginator(
        $logs->slice(($page - 1) * $perPage, $perPage)->values(),
        $logs->count(),
        $perPage,
        $page,
        ['path' => $request->url(), 'query' => $request->query()]
    );

    return view('admin.logs.index', ['logs' => $paginatedLogs]);
}










public function show(User $user)
{
    $this->authorizeAction('view'); // Add appropriate permission if necessary

    return view('admin.users.show', compact('user'));
}



public function exportLogs()
{
    $logFile = storage_path('logs/laravel.log');

    if (!file_exists($logFile)) {
        return redirect()->route('admin.logs.index')->with('error', 'No logs available to export.');
    }

    $logContents = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    $logs = collect();
    foreach ($logContents as $line) {
        if (preg_match('/^\[(.*?)\] .*?\.(INFO|WARNING): (.*)$/', $line, $matches)) { // Restrict to INFO and WARNING
            $logs->push([
                'Timestamp' => $matches[1], // Default Laravel timestamp
                'Level' => $matches[2],
                'Message' => $matches[3],
            ]);
        }
    }

    if ($logs->isEmpty()) {
        return redirect()->route('admin.logs.index')->with('error', 'No logs available to export.');
    }

    return Excel::download(new LogsExport($logs), 'logs.xlsx');
}


    


}