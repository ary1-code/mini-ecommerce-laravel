@extends('account.layout.app')


@section('account.content')

    <div class="flex flex-col shadow rounded-lg p-4 dark:bg-gray-800 bg-white mt-5 lg:mt-0">
               <span class="flex items-center justify-between">
                 <span class="flex items-center gap-x-2">
                    <h2 class="font-DanaMedium text-lg">سفارش ها:</h2>
                </span>
               </span>
        <div class="relative mt-5 overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
            <table class="w-full text-sm text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700  bg-gray-100 dark:bg-gray-900 dark:text-gray-200">
                <tr>
                    <th
                        scope="col" class="px-6 py-3.5">
                        نام محصول
                    </th>
                    <th
                        scope="col" class="px-6 py-3.5">
                        تاریخ ثبت
                    </th>
                    <th
                        scope="col" class="px-6 py-3.5">
                        قیمت نهایی
                    </th>
                    <th
                        scope="col" class="px-6 py-3.5"
                    >
                        وضعیت
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr class="bg-white border-b cursor-pointer dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all">
                    <th scope="row"
                        class="px-6 py-5 font-medium text-gray-900 whitespace-nowrap dark:text-white flex items-center gap-x-2"
                    >

                        گوشی موبایل اپل مدل iPhone 16
                    </th>
                    <td class="px-6 py-5">
                        1402/11/11
                    </td>
                    <td class="px-6 py-5">
                        62,000,000 تومان
                    </td>
                    <td class="px-6 py-5 text-red-500 font-DanaDemiBold">
                        لغو شده
                    </td>
                </tr>
                <tr class="bg-white border-b cursor-pointer dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all">
                    <th scope="row"
                        class="px-6 py-5 font-medium text-gray-900 whitespace-nowrap dark:text-white flex items-center gap-x-2">
                        <img class="w-10 object-cover" src="./images/products/8.webp" alt="">
                        گوشی موبایل اپل مدل iPhone 16
                    </th>
                    <td class="px-6 py-5">
                        1402/11/11
                    </td>
                    <td class="px-6 py-5">
                        62,000,000 تومان
                    </td>
                    <td class="px-6 py-5 text-yellow-500 font-DanaDemiBold">
                        درانتظار پرداخت
                    </td>
                </tr>
                <tr class="bg-white border-b cursor-pointer dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all">
                    <th scope="row"
                        class="px-6 py-5 font-medium text-gray-900 whitespace-nowrap dark:text-white flex items-center gap-x-2">
                        <img class="w-10 object-cover" src="./images/products/3.png" alt="">
                        گوشی موبایل اپل مدل iPhone 16
                    </th>
                    <td class="px-6 py-5">
                        1402/11/11
                    </td>
                    <td class="px-6 py-5">
                        62,000,000 تومان
                    </td>
                    <td class="px-6 py-5 text-green-500 font-DanaDemiBold">
                        پرداخت شده
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
