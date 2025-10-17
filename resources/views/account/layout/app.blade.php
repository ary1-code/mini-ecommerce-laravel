@extends('layouts.app')

@section('content')
    <main class="container relative">
        <div class="flex flex-col lg:flex-row gap-x-8 mt-10">
            <!-- SIDE MENU -->
            <div
                class="lg:sticky mb-8 top-1 h-fit lg:w-1/4 hidden lg:flex flex-col gap-y-4 items-center shadow rounded-lg p-4 dark:bg-gray-800 bg-white">
                <!-- NAME AND AVATAR  -->
                <div
                    class="w-full flex items-center justify-between border-b border-gray-200 dark:border-white/20 py-3">
                    <div class="flex items-center gap-x-3">
                        <span class="felx flex-col gap-y-2">
                            <p class="font-DanaMedium text-lg">{{getUserFullName()}}</p>
                            <p class="text-gray-400">{{auth()->user()->mobile}}</p>
                        </span>
                    </div>
                </div>
                <ul
                    class="w-full relative space-y-2 child:duration-300 child:transition-all child:py-3  child:px-2 child:flex child:gap-x-2 text-lg child:cursor-pointer child:rounded-lg"
                >

                    <li class="{{activeSideMenuItem('account.profile.index')}}">
                        <svg class="w-6 h-6 ">
                            <use href="#cog"></use>
                        </svg>
                        <a href="{{route('account.profile.index')}}">اطلاعات کاربری </a>
                    </li>

                    <li class=" {{activeSideMenuItem('account.order.index')}}">
                        <svg class="w-6 h-6 ">
                            <use href="#shopping-bag"></use>
                        </svg>
                        <a href="{{route('account.order.index')}}">
                            سفارش ها
                        </a>
                    </li>
                    <li class="text-red-400">
                        <svg class="w-6 h-6 ">
                            <use href="#arrow-left-end"></use>
                        </svg>
                        <a onclick="$('#logout-form').submit()">خروج</a>
                    </li>
                </ul>
            </div>


            <!-- TOP FILTER BOX & PRODUCT & PAGINATION -->
            <div class="lg:w-3/4">
                @yield('account.content')
            </div>
        </div>
    </main>
@endsection
