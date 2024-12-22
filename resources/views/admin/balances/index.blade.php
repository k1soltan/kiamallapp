<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Balances') }}
        </h2>
    </x-slot>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-4">
                <div class="flex justify-between items-center mb-4">
                    <a href="{{ route('admin.balances.create') }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-400">
                        {{ __('Create Balance') }}
                    </a>
                </div>

                <table class="min-w-full table-auto border-collapse border border-gray-200 dark:border-gray-700">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700">
                            <th class="px-6 py-3 text-left text-gray-800 dark:text-gray-200">{{ __('Name') }}</th>
                            <th class="px-6 py-3 text-left text-gray-800 dark:text-gray-200">{{ __('Type') }}</th>
                            <th class="px-6 py-3 text-left text-gray-800 dark:text-gray-200">{{ __('Amount') }}</th>
                            <th class="px-6 py-3 text-left text-gray-800 dark:text-gray-200">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($balances as $balance)
                            <tr>
                                <td class="px-6 py-2">{{ $balance->name }}</td>
                                <td class="px-6 py-2">{{ $balance->type }}</td>
                                <td class="px-6 py-2">{{ $balance->amount }}</td>
                                <td class="px-6 py-2">
                                    <a href="{{ route('admin.balances.edit', $balance->id) }}" class="text-blue-500 hover:underline">{{ __('Edit') }}</a>
                                    <form action="{{ route('admin.balances.destroy', $balance->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $balances->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
