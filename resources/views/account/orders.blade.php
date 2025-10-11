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
                        نام محصولات
                    </th>
                    <th
                            scope="col" class="px-6 py-3.5">
                        شناسه سفارش
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

                @foreach($orders as $order)
                    <tr class="bg-white border-b cursor-pointer dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all">

                        <td class="px-6 py-5">

                            {{$order->id}}

                        </td>

                        <th scope="row"
                            class="px-6 py-5 font-medium text-gray-900 whitespace-nowrap dark:text-white flex items-center gap-x-2"
                        >

                            @foreach($order->orderItems as $orderItem)

                                <span> {{ $orderItem->product->name }}</span>

                            @endforeach


                        </th>

                        <td class="px-6 py-5">

                            {{ $order->created_at->toJalali->format('H:i Y/m/d')}}

                        </td>

                        <td class="px-6 py-5">

                            {{number_format($order->total_price)}}
                            تومان

                        </td>
                        <td class="px-6 py-5  font-DanaDemiBold">

                            @switch($order->status)

                                @case(\App\Enums\OrderStatus::PROCESSING)
                                    <span class='text-yellow-500'>در حال پردازش</span>
                                    @break
                                @case(\App\Enums\OrderStatus::SENT)
                                    <span class='text-green-500'>ارسال شده</span>
                                    @break
                                @case(\App\Enums\OrderStatus::DELIVERED)
                                    <span class='text-blue-500'>تحویل داده شده</span>
                                    @break
                                @case(\App\Enums\OrderStatus::CANCELLED)
                                    <span class='text-red-500'>لغو شده</span>
                                    @break

                            @endswitch

                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            @if($orders->isEmpty())

                <span>سفارشی یافت نشد</span>

            @endif
        </div>
    </div>

@endsection
