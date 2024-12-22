<x-app-layout>
    <head>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    </head>

    <div class=" bg-gray-100  dark:bg-gray-900 ">
        <div class="max-w-7xl mx-auto grid-cols-1 lg:grid-cols-2 gap-2">
            <!-- Swiper Container -->
            <div class="swiper-container ">
                <!-- Wrapper for Slides -->
                <div class="swiper-wrapper">
                    <!-- Slide 1 -->
                    <div class="swiper-slide " >

                        <div class="card">
                            <div class="grid grid-cols-2 max-w-xl sm:grid-cols-3 md:max-w-7xl md:grid-cols-4 lg:grid-cols-5 gap-2">
                                @can('manage users')
                                <button class="square-btn">
                                    <a href="{{ route('admin.users.index') }}">
                                        <i class="fa fa-users text-2xl"></i>
                                        <p class="text-menu-icon mt-2 text-xs">کاربران</p>
                                    </a>
                                </button>
                                @endcan

                                @can('manage roles')
                                <button class="square-btn">
                                    <a href="{{ route('admin.roles.index') }}">
                                        <i class="fa fa-key text-2xl"></i>
                                        <p class="text-menu-icon mt-2 text-xs">نقش ها</p>
                                    </a>
                                </button>
                                @endcan

                                <button class="square-btn">
                                    <i class="fa fa-gift text-2xl"></i>
                                    <p class="text-menu-icon mt-2 text-xs">جوایز</p>
                                </button>

                                <button class="square-btn">
                                    <i class="fa fa-tag text-2xl"></i>
                                    <p class="text-menu-icon mt-2 text-xs">کد تخفیف</p>
                                </button>

                                <button class="square-btn">
                                    <i class="fa fa-tasks text-2xl"></i>
                                    <p class="text-menu-icon mt-2 text-xs">وظایف</p>
                                </button>

                                <button class="square-btn">
                                    <i class="fa fa-calendar text-2xl"></i>
                                    <p class="text-menu-icon mt-2 text-xs">تقویم</p>
                                </button>

                                <button class="square-btn">
                                    <i class="fa fa-envelope text-2xl"></i>
                                    <p class="text-menu-icon mt-2 text-xs">پیام ها</p>
                                </button>

                                <button class="square-btn">
                                    <i class="fa fa-balance-scale text-2xl"></i>
                                    <p class="text-menu-icon mt-2 text-xs">حسابداری</p>
                                </button>

                                <button class="square-btn">
                                    <i class="fa fa-wallet text-2xl"></i>
                                    <p class="text-menu-icon mt-2 text-xs">موجودی</p>
                                </button>

                                <button class="square-btn">
                                    <i class="fa fa-cogs text-2xl"></i>
                                    <p class="text-menu-icon mt-2 text-xs">تنظیمات</p>
                                </button>

                                <button class="square-btn">
                                    <i class="fa fa-file-alt text-2xl"></i>
                                    <p class="text-menu-icon mt-2 text-xs">فرم ها</p>
                                </button>

                                <button class="square-btn">
                                    <i class="fa fa-user text-2xl"></i>
                                    <p class="text-menu-icon mt-2 text-xs">کارمندان</p>
                                </button>

                                <button class="square-btn">
                                    <i class="fa fa-store text-2xl"></i>
                                    <p class="text-menu-icon mt-2 text-xs">فروشگاه ها</p>
                                </button>

                                <button class="square-btn">
                                    <i class="fa fa-utensils text-2xl"></i>
                                    <p class="text-menu-icon mt-2 text-xs">فودهال</p>
                                </button>

                                <button class="square-btn">
                                    <i class="fa fa-dolly text-2xl"></i>
                                    <p class="text-menu-icon mt-2 text-xs">هایپرمارکت</p>
                                </button>

                                <button class="square-btn">
                                    <i class="fa fa-chess-rook text-2xl"></i>
                                    <p class="text-menu-icon mt-2 text-xs">شهربازی</p>
                                </button>

                                <button class="square-btn">
                                    <i class="fa fa-file-invoice-dollar text-2xl"></i>
                                    <p class="text-menu-icon mt-2 text-xs">فاکتور</p>
                                </button>

                                <button class="square-btn">
                                    <i class="fa fa-barcode text-2xl"></i>
                                    <p class="text-menu-icon mt-2 text-xs">بلیت ها</p>
                                </button>

                                <button class="square-btn">
                                    <i class="fa fa-power-off text-2xl"></i>
                                    <p class="text-menu-icon mt-2 text-xs">خروج</p>
                                </button>

                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="swiper-slide px-4" >
                        <div class="card" dir="rtl">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ __('') }}</h3>
                            <p class="mt-4 text-gray-700 dark:text-gray-300">
                                {{ __('این محتوایی است که برای همه نقش‌ها قابل مشاهده است. اعلان‌ها، آمار شرکت یا سایر عناصر عمومی را اینجا اضافه کنید.') }}
                            </p>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    @if(auth()->user()->can('general user data'))
                    <div class="swiper-slide px-4 ">
                        <div class="card ">
                            @php
                            $summary = App\Helpers\DashboardHelper::getUserSummary();
                            @endphp
                            @include('admin.users.partials.user-summary-card', compact('summary'))
                        </div>
                    </div>
                    @endif


                </div>

                <!-- Pagination Dots -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const swiper = new Swiper('.swiper-container', {
                loop: false, // Enables infinite looping
                slidesPerView: 1, // Default number of slides to show
                centeredSlides: true, // Center the active slide
                spaceBetween: 0, // Remove extra spacing between slides
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true, // Enable clicking on pagination dots
                },
                breakpoints: {
                    1024: { // Adjust based on your large screen breakpoint
                        slidesPerView: 2, // Show two slides for large displays
                        centeredSlides: false, // Optional: Adjust centering if needed
                        spaceBetween: 20, // Optional: Add spacing between slides
                    },
                },
            });
        });
    </script>

</x-app-layout>
