<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>
    <div class="flex items-center rtl rtl:flex-row-reverse mx-auto sm:px-6 lg:px-8 py-12">
        <div class=" flex items-center rtl rtl:flex-row-reverse mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-gray-100 dark:bg-gray-800 flex px-12 py-2 items-center rtl rtl:flex-row-reverse overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6  border-gray-200 dark:border-gray-700">
                    <form method="POST" action="{{ route('admin.users.update', $user) }}">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="mb-4">
                            <x-label for="name" :value="__('نام')" />
                            <x-input id="name" class="w-64 px-4 py-2 border mt-4 border-gray-300 dark:border-gray-700 rounded-md focus:ring focus:ring-blue-200 dark:focus:ring-gray-700 focus:outline-none dark:bg-gray-800 dark:text-white" type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus />
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <x-label for="email" :value="__('ایمیل')" />
                            <x-input id="email" class="w-64 px-4 py-2 border mt-4 border-gray-300 dark:border-gray-700 rounded-md focus:ring focus:ring-blue-200 dark:focus:ring-gray-700 focus:outline-none dark:bg-gray-800 dark:text-white" type="email" name="email" value="{{ old('email', $user->email) }}" required />
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Roles -->
                        <div class="mb-4">
                            <x-label for="roles" :value="__('نوع کاربری')" />
                            <select id="roles" name="roles[]" multiple class="w-64 px-4 py-2 border mt-4 border-gray-300 dark:border-gray-700 rounded-md focus:ring focus:ring-blue-200 dark:focus:ring-gray-700 focus:outline-none dark:bg-gray-800 dark:text-white">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{ $user->roles->contains('id', $role->id) ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-4">
                            <x-button type="submit" class="py-2.5 px-2 font-semibold">
                                {{ __('بروزرسانی') }}
                            </x-button>
                        <a href="{{ route('admin.users.index') }}">
                        <button type="button"
                            class="mr-4 px-4 py-2 rounded bg-gray-200  dark:bg-gray-700 hover:bg-gray-700 text-gray-900 dark:text-white font-semibold">
                            {{ __('انصراف') }}
                        </button>
                    </a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
