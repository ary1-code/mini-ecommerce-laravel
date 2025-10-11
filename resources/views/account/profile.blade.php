@extends('account.layout.app')

@section('account.content')
    <div class="flex flex-col shadow rounded-lg p-4 dark:bg-gray-800 bg-white mt-5 lg:mt-0">
        <div class="flex items-center justify-between">
            <h2 class="font-DanaMedium text-lg">اطلاعات حساب کاربری</h2>
        </div>


        <div>

            @if(session()->has('success-message'))

                <span class="text-green-500"> {{session()('success-message')}} </span>

            @endif

            @error('general')

                <span class="text-red-500"> {{ $message }}</span>

            @enderror()

        </div>


        <form class="mt-5 grid grid-cols-12 gap-5 child:col-span-12 child:lg:col-span-6"
              action="{{route('account.profile.put')}}"
              method="POST"
        >
            @method('PUT')
            @csrf
            <!-- ITEM -->
            <div>
                <label for="first-name-input" class="block text-sm font-DanaMedium text-gray-500 dark:text-gray-300">

                    نام

                </label>
                <div class="mt-3 relative">
                    <input type="text"
                           id="first-name-input"
                           name="first_name"
                           placeholder="نام خود را وارد کنید"
                           value="{{old('first_name',auth()->user()->first_name)}}"
                           class="block w-full p-2.5 text-base outline dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400 transition-all text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400"
                    />
                    @error('first_name')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>     <!-- ITEM -->
            <div>

                <label for="last-name-input" class="block text-sm font-DanaMedium text-gray-500 dark:text-gray-300">

                    نام خانوادگی

                </label>
                <div class="mt-3 relative">
                    <input type="text"
                           id="last-name-input"
                           name="last_name"
                           placeholder="نام خانوادگی خود را وارد کنید"
                           value="{{old('last_name',auth()->user()->last_name)}}"
                           class="block w-full p-2.5 text-base outline dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400 transition-all text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400"
                    />
                    @error('last_name')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>     <!-- ITEM -->
            <div>
                <label for="email-input" class="block text-sm font-DanaMedium text-gray-500 dark:text-gray-300">

                    پست الکترونیکی

                </label>
                <div class="mt-3 relative">
                    <input type="email"
                           id="email-input"
                           name="email"
                           placeholder="پست الکترونیکی خود را وارد کنید"
                           value="{{old('email',auth()->user()->email)}}"
                           class="block w-full p-2.5 text-base outline dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400 transition-all text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400"
                    />
                    @error('email')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>     <!-- ITEM -->
            <div>
                <label for="mobile-input" class="block text-sm font-DanaMedium text-gray-500 dark:text-gray-300">

                    موبایل

                </label>
                <div class="mt-3 relative">
                    <input type="text"
                           id="mobile-input"
                           name="mobile"
                           placeholder="موبایل خود را وارد کنید"
                           value="{{old('mobile',auth()->user()->mobile)}}"
                           class="block w-full p-2.5 text-base outline dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400 transition-all text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400"
                    />
                    @error('mobile')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div> <!-- ITEM -->
            <div>
                <label for="password-input" class="block text-sm font-DanaMedium text-gray-500 dark:text-gray-300">

                    رمز عبور

                    <small>در صورت نیاز به تغییر رمز عبور این فیلد را پر کنید</small>

                </label>
                <div class="mt-3 relative">
                    <input type="password"
                           id="password-inputt"
                           name="password"
                           placeholder="رمز عبور خود را وارد کنید"
                           value="{{old('password',auth()->user()->password)}}"
                           class="block w-full p-2.5 text-base outline dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400 transition-all text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400"
                    />
                    @error('password')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div>
                <button type="submit" class="submit-btn" tabindex="7">ذخیره تغییرات</button>
            </div>
        </form>
    </div>
@endsection
