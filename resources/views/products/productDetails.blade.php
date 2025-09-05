@extends('layouts.app')

@section('title', 'Product Details')
@section('content')
    <div class="min-h-screen bg-stone-300">
        <div class="flex justify-center py-6 px-8">
            <div
                class="flex flex-col md:flex-row bg-stone-500 rounded-2xl shadow-lg overflow-hidden 
                       hover:shadow-2xl transition duration-300 w-full max-w-4xl">

                {{-- Product Image --}}
                <div class="w-full md:w-1/3">
                    @if ($products->image)
                        <img src="{{ asset('storage/' . $products->image) }}" alt="{{ $products->name }}"
                            class="w-full h-64 md:h-full object-cover">
                    @else
                        <img src="{{ asset('storage/placeholder-image.png') }}" alt="{{ $products->name }}"
                            class="w-full h-64 md:h-full object-cover">
                    @endif
                </div>

                {{-- Product Info --}}
                <div class="flex flex-col justify-between p-4 sm:p-6 md:w-2/3">
                    <div>
                        <h5 class="text-xl sm:text-2xl font-bold text-white mb-2">
                            {{ $products->name }}
                        </h5>
                        <p class="text-xs sm:text-sm text-white mb-3 underline">
                            {{ $products->category->name }}
                        </p>
                        <p class="text-white leading-relaxed text-sm sm:text-base mb-4">
                            {{ $products->description }}
                        </p>
                    </div>

                    {{-- Price & Stock --}}
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mt-2">
                        <span class="text-lg sm:text-xl font-extrabold text-amber-200">
                            Rp {{ number_format($products->price, 0, ',', '.') }}
                        </span>
                        <span
                            class="px-2 py-1 text-xs sm:text-sm font-medium rounded-lg 
                                {{ $products->stok > 0 ? 'bg-stone-100 text-stone-700' : 'bg-stone-100 text-red-600' }}">
                            {{ $products->stok > 0 ? $products->stok . ' pcs' : 'Out of Stock' }}
                        </span>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex justify-end mt-4 gap-3">
                        <a href="/order/{{ $products->id }}"
                            class="px-3 py-2 bg-stone-100 text-stone-700 font-semibold rounded-lg shadow 
                                   hover:bg-stone-700 hover:text-stone-100 transition">
                            Order
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Related / Category --}}
        @include('products.category')
    </div>
@endsection
