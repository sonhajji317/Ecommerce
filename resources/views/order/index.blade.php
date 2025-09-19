@extends('layouts.app')
@section('title', 'Order list')
@section('content')
    <div
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 mx-auto px-6 pt-4 pb-4 rounded-lg gap-4 min-h-screen">
        @forelse ($orders as $order)
            <div class="group relative block overflow-hidden rounded-xl">
                <img src="{{ $order->product->image ? asset('storage/' . $order->product->image) : asset('storage/placeholder-image.png') }}"
                    alt="" class="h-64 w-full object-cover transition duration-500 group-hover:scale-105 sm:h-72" />

                <div class="relative border border-gray-100 bg-stone-700 p-6">
                    <span class="bg-amber-200 text-stone-900 rounded-lg px-3 py-1.5 text-sm font-medium whitespace-nowrap">
                        {{ $order->product->category->name }} </span>

                    <h3 class="mt-4 text-lg font-medium text-white">{{ $order->product->name }}</h3>

                    <div class="flex flex-nowrap justify-between mb-2">

                        <p class="mt-1.5 text-sm text-white">Price : {{ number_format($order->product->price, 0, ',', '.') }}
                        </p>
                        <p class="mt-1.5 text-sm text-white">Quantity : {{ $order->qty }} </p>
                    </div>

                    <div class="flex flex-nowrap justify-between">
                        <p class="mt-1.5 text-sm text-white">Total Price :
                            <strong class="text-green-600">IDR
                                {{ number_format($order->total_price, 0, ',', '.') }}</strong>
                        </p>

                        <p class="text-black bg-amber-200 rounded-lg px-2 py-1 text-sm font-semibold capitalize">
                            {{ $order->status }}</p>
                    </div>


                    <div class="flex flex-nowrap justify-between mt-4">
                        <form action="/order/{{ $order->id }}/delete" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure to delete this order?')"
                                class="px-3 py-1.5 text-sm bg-red-600 text-white rounded-md hover:bg-red-700 transition">Delete</button>
                        </form>
                        <a href="{{ route('order.pay', $order->id) }}"
                            class="px-3 py-1.5 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-md transition">
                            Pay now
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500 col-span-4 text-2xl font-bold">Ooopss!!! No orders found.</p>
        @endforelse

    </div>
    <div class="mb-6 px-6">
        {{ $orders->links() }}
    </div>

@endsection
