<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Tickets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-6">My Tickets</h1>
                    @if ($tickets->isEmpty())
                        <p>You have no tickets yet.</p>
                    @else
                        <table class="w-full border-collapse border border-gray-300 dark:border-gray-600">
                            <thead>
                                <tr>
                                    <th class="border px-4 py-2">ID</th>
                                    <th class="border px-4 py-2">Event</th>
                                    <th class="border px-4 py-2">Quantity</th>
                                    <th class="border px-4 py-2">Status</th>
                                    <th class="border px-4 py-2">QR Code</th>
                                    <th class="border px-4 py-2">Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $ticket->id }}</td>
                                        <td class="border px-4 py-2">{{ $ticket->event->title }}</td>
                                        <td class="border px-4 py-2">{{ $ticket->quantity }}</td>
                                        <td class="border px-4 py-2">{{ ucfirst($ticket->status) }}</td>
                                        <td class="border px-4 py-2 text-center">
                                            <a href="{{ route('admin.tickets.qrCode', $ticket->id) }}" target="_blank">
                                                <img src="{{ route('admin.tickets.qrCode', $ticket->id) }}" alt="QR Code" class="w-8 h-8">
                                            </a>
                                        </td>
                                        <td class="border px-4 py-2 text-center">
                                            <a href="{{ route('tickets.show', $ticket->id) }}" class="text-blue-500 hover:underline">
                                                View Details
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
