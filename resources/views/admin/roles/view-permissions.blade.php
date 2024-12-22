<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View Permissions for Role: ') . $role->name }}
            
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-4">{{ __('Permissions for this Role') }}</h3>

                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-200 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-gray-800 dark:text-gray-200">{{ __('Permission Name') }}</th>
                                <th class="px-6 py-3 text-center text-gray-800 dark:text-gray-200">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800">
                            @foreach ($permissions as $permission)
                                <tr class="border-t border-gray-200 dark:border-gray-700">
                                    <td class="px-6 py-2 text-gray-800 dark:text-gray-200">
                                        {{ $permission->name }}
                                    </td>
                                    <td class="px-6 py-2 text-center">
                                        <form method="POST" action="{{ route('admin.roles.removePermission', $role->id) }}" class="inline-block">
                                            
                                            @csrf
                                            <input type="hidden" name="permission_id" value="{{ $permission->id }}">
                                            <button type="submit"
                                                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">
                                                {{ __('Remove') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        <button onclick="history.back()" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            {{ __('Back to Roles') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
