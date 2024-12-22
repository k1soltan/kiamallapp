<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6" dir="rtl">
    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('خلاصه کاربران') }}</h3>
    <ul class="mt-4 space-y-2 text-gray-700 dark:text-gray-300">
        <li>{{ __('تعداد کل کاربران:') }} <strong>{{ $summary['totalUsers'] }}</strong></li>
        <li>{{ __('تعداد کل اعضا:') }} <strong>{{ $summary['totalMembers'] }}</strong></li>
        <li>{{ __('کاربران این هفته:') }} <strong>{{ $summary['usersThisWeek'] }}</strong></li>
        <li>{{ __('کاربران این ماه:') }} <strong>{{ $summary['usersThisMonth'] }}</strong></li>
    </ul>
    <div class="mt-6">
        @if (auth()->user()->can('index users'))
        <a href="{{ route('admin.users.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
            {{ __('مشاهده بیشتر') }}
        </a>
    @elseif (auth()->user()->can('general user data'))
        <a href="{{ route('admin.users.generalUserData') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
            {{ __('مشاهده بیشتر') }}
        </a>
    @endif
    
    </div>
</div>
