<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Events') }}
        </h2>
    </x-slot>

    <div class="py-12">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('admin.events.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-8 rounded shadow">
                Create Event
            </a>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>All Events</h1>
                    @if ($events->isEmpty())
                        <p>No events found.</p>
                    @else
                        <table class="min-w-full border-collapse border border-gray-200">
                            <thead>
                                <tr>
                                    <th class="border px-4 py-2">ID</th>
                                    <th class="border px-4 py-2">Title</th>
                                    <th class="border px-4 py-2">Start</th>
                                    <th class="border px-4 py-2">End</th>
                                    <th class="border px-4 py-2">Tickets</th>
                                    <th class="border px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $event->id }}</td>
                                        <td class="border px-4 py-2">{{ $event->title }}</td>
                                        <td class="border px-4 py-2">{{ $event->start }}</td>
                                        <td class="border px-4 py-2">{{ $event->end }}</td>
                                        <td class="border px-4 py-2">{{ $event->tickets_count }}</td>
                                        <td class="border px-4 py-2">
                                            <a href="{{ route('admin.events.show', ['event' => $event->id]) }}" class="text-blue-500 hover:underline">View</a>
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
