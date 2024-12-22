<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transaction History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-4">
                <table class="min-w-full table-auto border-collapse border border-gray-200 dark:border-gray-700">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700">
                            <th class="px-6 py-3 text-left text-gray-800 dark:text-gray-200">{{ __('Date') }}</th>
                            <th class="px-6 py-3 text-left text-gray-800 dark:text-gray-200">{{ __('Type') }}</th>
                            <th class="px-6 py-3 text-left text-gray-800 dark:text-gray-200">{{ __('Amount') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td class="px-6 py-2">{{ $transaction->created_at }}</td>
                                <td class="px-6 py-2">{{ $transaction->type }}</td>
                                <td class="px-6 py-2">{{ $transaction->amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
