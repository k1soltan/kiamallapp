<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Event Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-6">Event Details</h1>
                    <table class="min-w-full border border-gray-200 mb-6">
                        <tr>
                            <th class="border px-4 py-2 text-left">ID</th>
                            <td class="border px-4 py-2">{{ $event->id }}</td>
                        </tr>
                        <tr>
                            <th class="border px-4 py-2 text-left">Title</th>
                            <td class="border px-4 py-2">{{ $event->title }}</td>
                        </tr>
                        <tr>
                            <th class="border px-4 py-2 text-left">Start Date</th>
                            <td class="border px-4 py-2">{{ $event->start }}</td>
                        </tr>
                        <tr>
                            <th class="border px-4 py-2 text-left">End Date</th>
                            <td class="border px-4 py-2">{{ $event->end }}</td>
                        </tr>
                        <tr>
                            <th class="border px-4 py-2 text-left">Description</th>
                            <td class="border px-4 py-2">{{ $event->description ?? 'No description available.' }}</td>
                        </tr>
                    </table>

                    <h2 class="mt-6 font-bold text-lg">Tickets</h2>
                    @if ($tickets->isEmpty())
                        <p class="text-gray-400">No tickets available for this event.</p>
                    @else
                        <table class="min-w-full border-collapse border border-gray-200 mt-4">
                            <thead>
                                <tr>
                                    <th class="border px-4 py-2">Ticket ID</th>
                                    <th class="border px-4 py-2">User ID</th>
                                    <th class="border px-4 py-2">Quantity</th>
                                    <th class="border px-4 py-2">Status</th>
                                    <th class="border px-4 py-2">Booked At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $ticket->id }}</td>
                                        <td class="border px-4 py-2">{{ $ticket->user_id }}</td>
                                        <td class="border px-4 py-2">{{ $ticket->quantity }}</td>
                                        <td class="border px-4 py-2">{{ $ticket->status }}</td>
                                        <td class="border px-4 py-2">{{ $ticket->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                
                       <a href="{{ route('admin.events.book.form', $event->id) }}" class="inline-block mt-6 bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded shadow">Book Tickets</a>

                    <a href="{{ route('admin.events.index') }}" class="inline-block mt-6 bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded shadow">
                        Back to Events
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
