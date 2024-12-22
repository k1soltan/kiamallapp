<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reserved Tickets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-6">Reserved Tickets</h1>
                    @if ($tickets->isEmpty())
                        <p>No reserved tickets available.</p>
                    @else
                        <table class="w-full border-collapse border border-gray-300 dark:border-gray-600">
                            <thead>
                                <tr>
                                    <th class="border px-4 py-2 dark:text-gray-300">ID</th>
                                    <th class="border px-4 py-2 dark:text-gray-300">User</th>
                                    <th class="border px-4 py-2 dark:text-gray-300">Event</th>
                                    <th class="border px-4 py-2 dark:text-gray-300">Quantity</th>
                                    <th class="border px-4 py-2 dark:text-gray-300">Status</th>
                                    <th class="border px-4 py-2 dark:text-gray-300">Actions</th>
                                    <th class="border px-4 py-2 dark:text-gray-300">QR Code</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                    <tr class="dark:bg-gray-900 hover:dark:bg-gray-700">
                                        <td class="border px-4 py-2 dark:text-gray-300">{{ $ticket->id }}</td>
                                        <td class="border px-4 py-2 dark:text-gray-300">{{ $ticket->user->name }}</td>
                                        <td class="border px-4 py-2 dark:text-gray-300">{{ $ticket->event->title }}</td>
                                        <td class="border px-4 py-2 dark:text-gray-300">{{ $ticket->quantity }}</td>
                                        <td class="border px-4 py-2 dark:text-gray-300">{{ ucfirst($ticket->status) }}</td>
                                        <td class="border px-4 py-2">
                                            <form action="{{ route('admin.tickets.confirm', $ticket->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PUT') <!-- Ensure PUT method is used -->
                                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-1 px-3 rounded">
                                                    Confirm
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.tickets.decline', $ticket->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE') <!-- Ensure DELETE method is used -->
                                                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded">
                                                    Decline
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.tickets.delete', $ticket->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                        <td class="border px-4 py-2 text-center">
                                            <a href="{{ route('admin.tickets.qrCode', $ticket->id) }}" target="_blank">
                                                <img src="{{ route('admin.tickets.qrCode', $ticket->id) }}" alt="QR Code" class="w-8 h-8">
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
