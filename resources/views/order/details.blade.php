@extends('layouts.app')

@section('title', 'Order')
@section('content')
    <div class="min-h-screen bg-stone-300">
        <div class="flex justify-center py-10 px-4">
            <div
                class="flex flex-col md:flex-row bg-stone-500 rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 max-w-3xl w-full">

                {{-- Product Image --}}
                <div class="w-full md:w-1/3">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="w-full h-64 md:h-full object-cover">
                    @else
                        <img src="{{ asset('storage/placeholder-image.png') }}" alt="{{ $product->name }}"
                            class="w-full h-64 md:h-full object-cover">
                    @endif
                </div>

                {{-- Product Info --}}
                <div class="flex flex-col justify-between p-6 md:w-2/3 h-full">
                    <div>
                        <h5 class="text-2xl font-bold text-white mb-2">
                            {{ $product->name }}
                        </h5>
                        <p class="text-sm text-white mb-4 underline">
                            {{ $product->category->name }}
                        </p>
                        <p class="text-white leading-relaxed mb-4">
                            {{ $product->description }}
                        </p>
                    </div>

                    {{-- Price & Stock --}}
                    <div class="flex items-center justify-between mt-4">
                        <span class="text-xl font-extrabold text-amber-200">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </span>
                        <span
                            class="px-2 py-1 text-sm font-medium rounded-lg 
                            {{ $product->stok > 0 ? 'bg-stone-100 text-stone-600' : 'bg-stone-100 text-red-600' }}">
                            {{ $product->stok > 0 ? $product->stok . ' pcs' : 'Out of Stock' }}
                        </span>
                    </div>

                    {{-- Action Buttons --}}
                    {{-- <form action="" method="POST">
                        @csrf
                        <input type="number" name="qty" value="1">

                        <button type="submit" name="action" value="cart"
                            class="px-3 py-2 bg-stone-100 hover:bg-stone-700 rounded-lg">
                            Add to Cart
                        </button>

                        <button type="submit" name="action" value="checkout"
                            class="px-2 py-1 bg-stone-100 text-stone-700 font-semibold rounded-lg shadow hover:bg-stone-700 hover:text-stone-100 transition">
                            Checkout
                        </button>
                    </form> --}}


                    <form action="{{ route('order.checkout', $product->id) }}" method="POST" class="space-y-2">
                        @csrf
                        <div class="flex justify-between items-center gap-4">
                            <!-- Quantity -->
                            <div>
                                <label class="text-white" for="qty">Quantity</label>
                                <input type="number" name="qty" id="qty"
                                    class="w-20 border border-gray-300 rounded-lg px-2 py-1 
                                              focus:ring-1 focus:ring-stone-400 focus:border-stone-400 text-stone-700"
                                    value="1" min="1" required max="{{ $product->stok }}">
                            </div>

                            <!-- Tombol -->
                            <div>
                                @if (!auth()->check())
                                    <a href="/login"
                                        class="px-2 py-1 bg-stone-100 text-stone-700 font-semibold rounded-lg shadow hover:bg-stone-700 hover:text-stone-100 transition">
                                        Login to Checkout
                                    </a>
                                @else
                                    <div class="flex flex-nowrap gap-3">
                                        {{-- <button type="submit"
                                            class="flex items-center justify-center px-3 py-2 bg-stone-100 hover:bg-stone-700 rounded-lg transition">
                                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-stone-700 hover:text-stone-100"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7h-1M8 7h-.688M13 5v4m-2-2h4" />
                                            </svg>
                                        </button> --}}
                                        <button type="submit"
                                            onclick="return confirm('make sure your order product and quantity is correct?')"
                                            class="px-2 py-1 bg-stone-100 text-stone-700 font-semibold rounded-lg shadow hover:bg-stone-700 hover:text-stone-100 transition">
                                            Checkout
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
