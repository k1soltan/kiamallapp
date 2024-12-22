<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Balance') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.balances.store') }}" class="bg-white p-4 shadow sm:rounded-lg">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                    <input type="text" name="name" required class="border border-gray-300 rounded px-3 py-2 w-full">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">{{ __('Type') }}</label>
                    <input type="text" name="type" required class="border border-gray-300 rounded px-3 py-2 w-full">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">{{ __('Amount') }}</label>
                    <input type="number" name="amount" required class="border border-gray-300 rounded px-3 py-2 w-full">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">{{ __('Expiration') }}</label>
                    <input type="date" name="expiration" class="border border-gray-300 rounded px-3 py-2 w-full">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">{{ __('Assign to Roles') }}</label>
                    @foreach ($roles as $role)
                        <div>
                            <input type="checkbox" name="roles[]" value="{{ $role->id }}">
                            <label>{{ $role->name }}</label>
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">
                    {{ __('Create') }}
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
