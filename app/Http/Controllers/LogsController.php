<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Morilog\Jalali\Jalalian;
use Illuminate\Support\Facades\File;

class LogsController extends Controller
{
    public function logs(Request $request)
    {
        $logFile = storage_path('logs/laravel.log');

        // Check if the log file exists
        if (!file_exists($logFile)) {
            return view('admin.logs.index', ['logs' => []]);
        }

        // Read log contents line by line
        $logContents = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        $logs = [];

        foreach ($logContents as $line) {
            // Match the Laravel log format
            if (preg_match('/^\[(.*?)\] .*?\.(INFO|ERROR|WARNING|DEBUG): (.*)$/', $line, $matches)) {
                try {
                    $gregorianDate = \Carbon\Carbon::parse($matches[1]);
                    $jalaliDate = Jalalian::fromCarbon($gregorianDate)->format('%Y-%m-%d H:i:s');
                    
                    $logs[] = [
                        'timestamp' => $jalaliDate,
                        'level' => $matches[2],
                        'message' => $matches[3],
                    ];
                } catch (\Exception $e) {
                    continue; // Skip invalid log entries
                }
            }
        }

        // Sort logs by timestamp in descending order
        $logs = collect($logs)->sortByDesc('timestamp');

        // Manual pagination
        $perPage = 10;
        $page = $request->get('page', 1);
        $paginatedLogs = new LengthAwarePaginator(
            $logs->slice(($page - 1) * $perPage, $perPage)->values(),
            $logs->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('admin.logs.index', ['logs' => $paginatedLogs]);
    }
}
