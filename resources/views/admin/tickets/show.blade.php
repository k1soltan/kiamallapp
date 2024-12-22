<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ticket Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-6">Ticket Details</h1>
                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <td>{{ $ticket->id }}</td>
                        </tr>
                        <tr>
                            <th>User</th>
                            <td>{{ $ticket->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Event</th>
                            <td>{{ $ticket->event->title }}</td>
                        </tr>
                        <tr>
                            <th>Quantity</th>
                            <td>{{ $ticket->quantity }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ $ticket->status }}</td>
                        </tr>
                    </table>

                    <h2 class="mt-6 font-bold text-lg">QR Code</h2>
                    <img src="{{ route('admin.tickets.qrCode', $ticket->id) }}" alt="Ticket QR Code" class="mt-4 border rounded shadow">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
