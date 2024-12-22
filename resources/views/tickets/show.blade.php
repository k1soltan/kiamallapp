<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ticket Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-6">Ticket Details</h1>
                    <table class="table-auto w-full mb-6">
                        <tr>
                            <th class="text-left px-4 py-2">Ticket ID</th>
                            <td class="px-4 py-2">{{ $ticket->id }}</td>
                        </tr>
                        <tr>
                            <th class="text-left px-4 py-2">Event</th>
                            <td class="px-4 py-2">{{ $ticket->event->title }}</td>
                        </tr>
                        <tr>
                            <th class="text-left px-4 py-2">User</th>
                            <td class="px-4 py-2">{{ $ticket->user->name }}</td>
                        </tr>
                        <tr>
                            <th class="text-left px-4 py-2">Quantity</th>
                            <td class="px-4 py-2">{{ $ticket->quantity }}</td>
                        </tr>
                        <tr>
                            <th class="text-left px-4 py-2">Status</th>
                            <td class="px-4 py-2">{{ ucfirst($ticket->status) }}</td>
                        </tr>
                        <tr>
                            <th class="text-left px-4 py-2">Created At</th>
                            <td class="px-4 py-2">{{ $ticket->created_at }}</td>
                        </tr>
                    </table>

                    <div class="flex items-center justify-center mb-6">
                        <img src="{{ route('admin.tickets.qrCode', $ticket->id) }}" alt="Ticket QR Code" class="w-48 h-48">
                    </div>

                    <!-- Buttons for Print and PDF -->
                    <div class="flex justify-center space-x-4">
                        <button onclick="window.print()" 
                                class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded shadow">
                            Print Ticket
                        </button>
                        <a href="{{ route('tickets.pdf', $ticket->id) }}" 
                           class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded shadow">
                            Download as PDF
                        </a>
                    </div>

                    <div class="mt-6 text-center">
                        <a href="{{ route('tickets.user') }}" 
                           class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded shadow">
                            Back to My Tickets
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
