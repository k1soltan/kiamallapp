<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('General User Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold">{{ __('User Data Summary') }}</h3>
                    <table class="table-auto w-full mt-4">
                        <thead>
                            <tr>
                                @can('view roles')
                                    <th class="border px-4 py-2">{{ __('Role') }}</th>
                                @endcan
                                <th class="border px-4 py-2">{{ __('Total Users') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userCounts as $data)
                                <tr>
                                    @can('view roles')
                                        <td class="border px-4 py-2">{{ $data->role }}</td>
                                    @endcan
                                    <td class="border px-4 py-2">{{ $data->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
