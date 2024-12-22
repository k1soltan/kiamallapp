<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-6">Create Event</h1>
                    <form action="{{ route('admin.events.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Event Title</label>
                            <input type="text" name="title" id="title" 
                                   class="block w-full mt-1 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 shadow-sm 
                                          focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:text-gray-300" required>
                        </div>

                        <div class="mb-4">
                            <label for="details" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Event Details</label>
                            <textarea name="details" id="details" rows="3"
                                      class="block w-full mt-1 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 shadow-sm 
                                             focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:text-gray-300" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Event Type</label>
                            <select name="type" id="type" 
                                    class="block w-full mt-1 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 shadow-sm 
                                           focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:text-gray-300" required>
                                <option value="public">Public</option>
                                <option value="private">Private</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="start" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Date & Time</label>
                            <input type="datetime-local" name="start" id="start" 
                                   class="block w-full mt-1 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 shadow-sm 
                                          focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:text-gray-300" required>
                        </div>

                        <div class="mb-4">
                            <label for="end" class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Date & Time</label>
                            <input type="datetime-local" name="end" id="end" 
                                   class="block w-full mt-1 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 shadow-sm 
                                          focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:text-gray-300">
                        </div>

                        <div class="mb-4">
                            <label for="tickets_available" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tickets Available</label>
                            <select name="tickets_available" id="tickets_available" 
                                    class="block w-full mt-1 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 shadow-sm 
                                           focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:text-gray-300" required>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ticket Quantity</label>
                            <input type="number" name="quantity" id="quantity" min="1" 
                                   class="block w-full mt-1 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 shadow-sm 
                                          focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:text-gray-300">
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" 
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow dark:bg-indigo-500 dark:hover:bg-indigo-600">
                                Create Event
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
