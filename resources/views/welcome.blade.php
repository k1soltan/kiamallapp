<x-app-layout>
    <head>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    </head>

    <div class="py-4 bg-gray-100  dark:bg-gray-900">
        <div class="max-w-7xl mx-auto">
            <!-- Swiper Container -->
            <div class="swiper-container">
                <!-- Wrapper for Slides -->
                <div class="swiper-wrapper">
                    <!-- Slide 1 -->
                    <div class="swiper-slide px-4" >
                        <div class="card">
                            <div class="">



                                <section class="bg-center card bg-no-repeat bg-[url('/public/assets/images/conference.jpg')]  bg-blend-overlay ">
                                    <div class="px-4 mx-auto max-w-screen-xl text-center py-20 lg:py-56">
                                        <h1 class="mb-12 text-3xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
                                            کیا‌مال، لذت کنار هم بودن
                                        </h1>
                                        <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">
                                            در کیا‌مال، ما فضایی فراهم کرده‌ایم که به جای هر مکان دیگری، اینجا محل کنار هم بودن، خرید، سرگرمی و ایجاد لحظات ماندگار برای شما باشد.
                                        </p>

                                        <div class="flex flex-col space-y-4 rtl sm:flex-row sm:justify-center sm:space-y-0">
                                            <a href="#" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-500 hover:bg-blue-400 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                                                عضویت
                                                <svg class="w-3.5 h-3.5 ms-2 rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                                </svg>
                                            </a>
                                            <a href="#" class="inline-flex justify-center hover:text-gray-900 items-center py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg border border-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-400">
                                               بیشتر بخوانید
                                            </a>
                                        </div>
                                    </div>
                                </section>


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
                slidesPerView: 1, // Show only one slide at a time
                centeredSlides: true, // Center the active slide
                spaceBetween: 0, // Remove extra spacing between slides
                pagination: {
                    el: '.swiper-pagination',
                    clickable: false, // Enable clicking on pagination dots
                },
            });
        });
    </script>
</x-app-layout>
