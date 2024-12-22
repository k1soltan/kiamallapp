<nav x-data="{ open: false }" class="bg-white rtl:flex-row-reverse dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14 lg:h-16 rtl:flex-row-reverse">
            <!-- Left Section -->
            <div class="flex items-center rtl:flex-row-reverse">
                <!-- Logo -->
                <div class="shrink-0 flex items-center lg:ml-8">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600 dark:text-gray-300" />
                    </a>
                </div>
            </div>

            <!-- Right Section -->
            <div class="hidden sm:flex sm:items-center sm:ml-6 rtl:sm:mr-6 rtl:flex-row-reverse">
                <!-- Notification Menu -->
                <div class="ml-3 rtl:mr-3 relative">
                    <x-dropdown align="{{ app()->getLocale() === 'rtl' ? 'left' : 'right' }}" width="48">
                        <x-slot name="trigger">
                                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition">

                            <i class="fa fa-bell text-xl"></i>
                        </button>
                        </x-slot>
                        <x-slot name="content">
                            <div class="mb-2">
                                <x-dropdown-link href="#">
                                    <div class="flex items-center rtl rtl:flex-row-reverse">
                                        <i class="fa fa-info-circle text-lg ml-2 rtl:mr-2"></i>
                                        {{ __('کاربر جدید ثبت‌نام کرد') }}
                                    </div>
                                </x-dropdown-link>
                                <x-dropdown-link href="#">
                                    <div class="flex items-center rtl rtl:flex-row-reverse">
                                        <i class="fa fa-exclamation-circle text-lg ml-2 rtl:mr-2"></i>
                                        {{ __('نقش با موفقیت به‌...') }}
                                    </div>
                                </x-dropdown-link>
                                <x-dropdown-link href="#">
                                    <div class="flex items-center rtl rtl:flex-row-reverse">
                                        <i class="fa fa-check-circle text-lg ml-2 rtl:mr-2"></i>
                                        {{ __('تنظیمات ذخیره شد') }}
                                    </div>
                                </x-dropdown-link>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Desktop Light/Dark Mode Toggle -->
                <div class="hidden sm:block">
                    <button id="theme-toggle-desktop" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition">
                        <i id="theme-toggle-icon-desktop" class="fas text-lg"></i>
                    </button>
                </div>

                <!-- Account Dropdown -->
                <div class="lg:ml-1 lg:mr-4 relative">

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if(Auth::check())
                            <!-- Show the user's name when logged in -->
                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition">
                                {{ Auth::user()->name }}
                            </button>
                        @else
                            <!-- Show a default profile icon when not logged in -->
                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition">
                                <i class="fa fa-user text-lg  rtl:mr-2"></i>

                            </button>
                        @endif

                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link href="{{ route('profile.show') }}">
                                <div class="flex items-center rtl rtl:flex-row-reverse">

                                {{ __('پروفایل کاربری') }}
                                </div>
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    <div class="flex items-center rtl rtl:flex-row-reverse">

                                    {{ __('خروج') }}

                                    </div>
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Mobile Nav Section -->
            <div class="flex items-center sm:hidden rtl:flex-row-reverse">
                <!-- Notification Icon -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button type="button"
                        class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                        <i class="fa fa-bell text-xl"></i>
                    </button>

                    </x-slot>
                    <x-slot name="content">
                        <div class="mb-2">
                            <x-dropdown-link href="#">
                                <div class="flex items-center rtl rtl:flex-row-reverse">
                                    <i class="fa fa-info-circle text-lg ml-2 rtl:mr-2"></i>
                                    {{ __('کاربر جدید ثبت‌نام کرد') }}
                                </div>
                            </x-dropdown-link>
                            <x-dropdown-link href="#">
                                <div class="flex items-center rtl rtl:flex-row-reverse">
                                    <i class="fa fa-exclamation-circle text-lg ml-2 rtl:mr-2"></i>
                                    {{ __('نقش با موفقیت به‌...') }}
                                </div>
                            </x-dropdown-link>
                            <x-dropdown-link href="#">
                                <div class="flex items-center rtl rtl:flex-row-reverse">
                                    <i class="fa fa-check-circle text-lg ml-2 rtl:mr-2"></i>
                                    {{ __('تنظیمات ذخیره شد') }}
                                </div>
                            </x-dropdown-link>
                        </div>
                    </x-slot>
                </x-dropdown>

                <!-- Mobile Light/Dark Mode Toggle -->
                <div>
                    <button id="theme-toggle-mobile" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                        <i id="theme-toggle-icon-mobile" class="fas text-lg"></i>
                    </button>
                </div>



    <!-- Mobile Menu -->
    <div class="lg:ml-1 lg:mr-4 relative">

        <x-dropdown align="right" >
            <x-slot name="trigger">
                <button type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm mr-2 lg:mr-6 ml-2">
                    <i class="fa fa-user text-lg  rtl:mr-2"></i>

                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link href="{{ route('profile.show') }}">
                    <div class="flex items-center rtl rtl:flex-row-reverse">

                    {{ __('پروفایل کاربری') }}
                    </div>
                </x-dropdown-link>
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        <div class="flex items-center rtl rtl:flex-row-reverse">

                        {{ __('خروج') }}

                        </div>
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</nav>
