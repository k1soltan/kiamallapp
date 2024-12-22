<x-app-layout>
    <head>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    </head>
            <body class="{{ app()->getLocale() === 'fa' ? 'rtl' : 'ltr' }} font-sans antialiased bg-primary text-gray-900 dark:bg-gray-900 dark:text-gray-100">
<div>
    <x-slot name="header">
        <div>

            <nav class="flex justify-between items-center rtl rtl:flex-row-reverse mr-8  bg-gray-100 dark:bg-gray-800 rounded">
                <!-- Breadcrumb -->
                <div class="flex items-center space-x-2 rtl:space-x-reverse">
                    <!-- Home -->
                    <a href="{{ route('dashboard') }}" class="text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 text-sm">
                        <i class="fas fa-home"></i> <!-- Home Icon -->
                        <span>{{ __('خانه') }}</span>
                    </a>

                    <!-- Separator -->
                    <span class="text-gray-500 dark:text-gray-400">/</span>

                    <!-- Current Page -->
                    <span class="text-gray-800 dark:text-gray-200 text-sm font-semibold">
                        {{ __('مدیریت کاربران') }}
                    </span>
                </div>

                <!-- Back Button -->
                <button
                    onclick="goBack()" class="ml-10">
                    <i class="fa circle-chevron-left text-4xl text-gray-800 dark:text-gray-300"> </i> <!-- Home Icon -->


                </button>
            </nav>


        </div>
    </x-slot>

</div>
<div class="py-12 bg-gray-100 dark:bg-gray-900">
    <div class="max-w-full mx-4 sm:mx-auto sm:px-6 lg:px-8 bg-gray-100 dark:bg-gray-900">
        <!-- Create New User Button and Search -->
        <div class="flex flex-col sm:flex-row justify-between gap-4 mb-6">
            @can('create users')
                <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full sm:w-auto">
                    <a href="{{ route('admin.users.create') }}" class="text-white">
                        {{ __('کاربر جدید') }}
                    </a>
                </button>
            @endcan
            <form method="GET" action="{{ route('admin.users.index') }}" class="relative w-full sm:w-auto">
                <input
                    type="text"
                    name="search"
                    placeholder="{{ __('جست و جو') }}"
                    value="{{ request('search') }}"
                    id="searchInput"
                    class="w-full px-4 py-2 border rtl border-gray-300 dark:border-gray-700 rounded-md focus:ring focus:ring-blue-200 dark:focus:ring-gray-700 focus:outline-none dark:bg-gray-800 dark:text-white"
                    autocomplete="off"
                />
                <ul id="autocompleteResults" class="absolute z-10 bg-white dark:bg-gray-800 shadow-lg rounded-md w-full sm:w-auto hidden">
                    <!-- Dynamic quick search results will appear here -->
                </ul>
            </form>
        </div>
    </div>

    <div class="max-w-full mx-4 rtl sm:mx-auto sm:px-6 lg:px-8 bg-gray-100 dark:bg-gray-900">
        <!-- User Table -->
        <div class="bg-gray-200 dark:bg-gray-800 shadow-sm sm:rounded-lg">
            <div class="p-4 sm:p-6 border-b dark:bg-gray-800 sm:rounded-lg border-gray-200 dark:border-gray-700">
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border-b border-gray-200 dark:border-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                @if ($users->isNotEmpty())
                                    @foreach ($users[0]->getFillable() as $field)
                                        @if ($field !== 'password')

                                        @endif
                                    @endforeach
                                @endif
                                <th class="px-4 sm:px-6 py-3 text-right text-gray-800 dark:text-gray-200">{{ __('نام') }}</th>
                                <th class="px-4 sm:px-6 py-3 text-right text-gray-800 dark:text-gray-200">{{ __('ایمیل') }}</th>
                                <th class="px-4 sm:px-6 py-3 text-right text-gray-800 dark:text-gray-200">{{ __('نقش') }}</th>
                                <th class="px-4 sm:px-6 py-3 text-right text-gray-800 dark:text-gray-200">{{ __('عملیات') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="border-t border-gray-200 dark:border-gray-700">
                                    @foreach ($user->getFillable() as $field)
                                        @if ($field !== 'password')
                                            <td class="px-4 sm:px-6 py-2 text-gray-800 dark:text-gray-200">
                                                {{ $user->$field }}
                                            </td>
                                        @endif
                                    @endforeach
                                    <td class="px-4 sm:px-6 py-2 text-gray-800 dark:text-gray-200">
                                        {{ $user->roles->pluck('name')->join(', ') }}
                                    </td>
                                    <td class="px-4 sm:px-6 py-2 text-right">
                                        <div class="flex flex-row-reverse gap-2 justify-end">
                                            @can('edit users')
                                                <button class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                                                    <a href="{{ route('admin.users.edit', $user) }}" class="text-white">
                                                        {{ __('ویرایش') }}
                                                    </a>
                                                </button>
                                            @endcan
                                            @can('delete users')
                                                <button
                                                    onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}')"
                                                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline">
                                                    {{ __('حذف') }}
                                                </button>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-800 dark:text-gray-200">
                                        {{ __('هیچ نتیجه‌ای یافت نشد') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>




    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 hidden bg-opacity-75 bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 flex justify-center items-center rtl">
        <div class="bg-gray-100 dark:bg-gray-900 rounded-lg shadow-xl p-6 max-w-md w-full">
            <!-- Title -->
            <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200">{{ __('تایید حذف کاربر') }}</h2>

            <!-- Instruction -->
            <p class="mt-4 text-gray-600 dark:text-gray-400">
                {{ __('لطفاً عبارت DELETE را برای تایید حذف کاربر وارد کنید.') }}
            </p>

            <!-- Input Field -->
            <input type="text" id="deleteConfirmationInput"
                   class="mt-4 block w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring focus:ring-red-500  text-gray-800 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-500"
                   placeholder="DELETE">

            <!-- Buttons -->
            <div class="mt-6 flex justify-end">
                <!-- Cancel Button -->
                <button type="button" onclick="closeModal()"
                        class="ml-4 bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-4 py-2 rounded hover:bg-gray-400 dark:hover:bg-gray-600">
                    {{ __('لغو') }}
                </button>

                <!-- Confirm Button -->
                <button id="confirmDeleteButton"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                    {{ __('تایید') }}
                </button>
            </div>
        </div>
    </div>
    <script>
        const noResultsText = @json(__('هیچ نتیجه‌ای یافت نشد'));
        const seeMoreText = @json(__('مشاهده موارد بیشتر'));
    </script>


    <!-- JavaScript for Search and Delete -->
    <script>

        async function updateTable(userId) {
            const response = await fetch(`/admin/users?search=${userId}`);
            const data = await response.text();
            tableBody.innerHTML = new DOMParser()
                .parseFromString(data, "text/html")
                .querySelector('#userTableBody').innerHTML;

            autocompleteResults.classList.add('hidden');
        }

        function confirmDelete(userId, userName) {
            const modal = document.getElementById('deleteModal');
            const confirmButton = document.getElementById('confirmDeleteButton');
            const inputField = document.getElementById('deleteConfirmationInput');

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            inputField.value = '';

            confirmButton.onclick = function () {
                if (inputField.value === 'DELETE') {
                    submitDelete(userId);
                } else {
                    alert('Please type DELETE to confirm.');
                }
            };
        }

        function closeModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function submitDelete(userId) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/users/${userId}`;
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(csrfInput);
            form.appendChild(methodInput);
            document.body.appendChild(form);
            form.submit();
        }



function goBack() {
    if (window.history.length > 1) {
        window.history.back();
    } else {
        window.location.href = '/'; // Fallback URL if no history is available
    }
}
    </script>
</x-app-layout>
