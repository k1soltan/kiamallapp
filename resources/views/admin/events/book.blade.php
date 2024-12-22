<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Book Tickets for Event: ') . $event->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-6">Book Tickets</h1>
                    <form action="{{ route('admin.events.book', $event->id) }}" method="POST">
                        @csrf
                        
                        <!-- User Dropdown -->
                        <div class="mb-4">
                            <label for="user_id" class="block text-sm font-medium text-gray-300">
                                Select User:
                            </label>
                            <select name="user_id" id="user_id" 
                                    class="block w-full mt-1 rounded-md border-gray-700 bg-gray-800 text-gray-300 shadow-sm 
                                           focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="" disabled selected>Select a user</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Quantity Input -->
                        <div class="mb-4">
                            <label for="quantity" class="block text-sm font-medium text-gray-300">
                                Number of Tickets:
                            </label>
                            <input type="number" name="quantity" id="quantity" min="1"
                                   class="block w-full mt-1 rounded-md border-gray-700 bg-gray-800 text-gray-300 shadow-sm 
                                          focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                   required>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" 
                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow">
                            Book Tickets
                        </button>
                    </form>

                    <!-- Back to Event Button -->
                    <a href="{{ route('admin.events.show', $event->id) }}" 
                       class="inline-block mt-6 bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded shadow">
                        Back to Event
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
