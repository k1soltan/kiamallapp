<x-guest-layout>

    <x-authentication-card>

        <x-slot name="logo">
            <a href="{{ route('dashboard') }}">
                <x-application-logo class="block h-10 w-auto fill-current text-gray-600 dark:text-gray-300" />
            </a>
        </x-slot>

        <x-validation-errors class="mb-4"  />


        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ $value }}
            </div>
        @endsession
        <h1 class="mb-8 mt-8 text-center rtl text-3xl font-extrabold tracking-tight leading-none text-white  ">

            به کیا‌مال خوش آمدید        </h1>
        <p class="text-gray-400 rtl md:text-ls lg:text-lg  text-center "> <p class=" rtl text-center text-gray-400  ">  با ورود ، از پیشنهادات ویژه، و خدمات اختصاصی بهره‌مند شوید.
        </p>
        <form method="POST" class="rtl  px-2 py-12 mx-auto ll-8" action="{{ route('login') }}">
            @csrf


            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">تلفن</label>
            <div class="flex  mt-4 pb-4">
              <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M5 4a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V4Zm12 12V5H7v11h10Zm-5 1a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z" clip-rule="evenodd"/>
                  </svg>

              </span>
              <input type="email" id="email" class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="09xxxxxxxxx">
            </div>


            <label for="password" class="block mb-4 text-sm font-medium text-gray-900 dark:text-white">رمز عبور</label>
            <div class="flex mb-6">
              <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M8 10V7a4 4 0 1 1 8 0v3h1a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h1Zm2-3a2 2 0 1 1 4 0v3h-4V7Zm2 6a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1Z" clip-rule="evenodd"/>
                  </svg>

              </span>
              <input type="password" id="password" class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="password" :value="old('email')" required autocomplete="current-password" placeholder="*******">
            </div>





            <div class="block mt-4 mb-12">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-xs text-gray-600 dark:text-gray-400">{{ __('من را به خاطر بسپار!') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                    <a class=" text-xs text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('register') }}">
                        {{ __('عضویت') }}
                    </a>

                <x-button class="ms-4 text-gray-900 dark:text-white hover:text-gray-900 dark:hover:text-blue-500">
                    {{ __('ورود') }}
                </x-button>
            </div>
        </form>
    </div>
    </x-authentication-card>
</x-guest-layout>
