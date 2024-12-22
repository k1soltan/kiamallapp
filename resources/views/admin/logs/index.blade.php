<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            گزارش‌های کاربران
        </h2>
    </x-slot>

    <div class="py-12" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-4">
                <div class="flex justify-between items-center mb-4">
                    <!-- فیلتر -->
                    <div>
                        <form method="GET" action="{{ route('admin.logs.index') }}">
                            <input 
                                type="text" 
                                name="search" 
                                placeholder="جستجو در گزارش‌ها..." 
                                value="{{ request('search') }}" 
                                class="border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200"
                            >
                            <button 
                                type="submit" 
                                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-400">
                                فیلتر
                            </button>
                        </form>
                    </div>
                    <!-- دانلود اکسل -->
                    <div>
                        <a 
                            href="{{ route('admin.logs.export') }}" 
                            class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-400">
                            خروجی اکسل
                        </a>
                    </div>
                </div>

                <table class="min-w-full table-auto border-collapse border border-gray-200 dark:border-gray-700">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700">
                            <th class="px-6 py-3 text-right text-gray-800 dark:text-gray-200">
                                <a href="?sort=timestamp" class="hover:underline">تاریخ و زمان</a>
                            </th>
                            <th class="px-6 py-3 text-right text-gray-800 dark:text-gray-200">
                                <a href="?sort=level" class="hover:underline">سطح</a>
                            </th>
                            <th class="px-6 py-3 text-right text-gray-800 dark:text-gray-200">پیام</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logs as $log)
                            <tr>
                                <td class="px-6 py-2">{{ \Carbon\Carbon::parse($log['timestamp'])->format('Y-m-d H:i:s') }}</td>
                                <td class="px-6 py-2">{{ $log['level'] }}</td>
                                <td class="px-6 py-2">{{ $log['message'] }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-2 text-center text-gray-500 dark:text-gray-400">هیچ گزارشی موجود نیست.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- صفحه‌بندی -->
                <div class="mt-4">
                    {{ $logs->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
