@extends('layouts.app')
@section('content')
    <div class=" bg-stone-300 pb-6">
        @include('partials.hero')
        @include('partials.banner')
        <h1 class="font-bold text-2xl underline text-center text-stone-700 mb-5 mt-7">Popular Product</h1>
        <div class="flex justify-end px-8 mb-3">
            <a href="/product/category/all"
                class="px-2 py-1 rounded-lg border border-stone-700 bg-stone-700 text-stone-100 hover:bg-stone-100 hover:text-stone-700 font-semibold">See
                all</a>
        </div>
        <div class="max-w-8xl mx-auto grid gap-8 sm:grid-cols-2 lg:grid-cols-4 sm:px-8 px-6">
            @foreach ($products as $product)
                <div
                    class="bg-stone-500 border border-stone-500 rounded-lg shadow-md hover:shadow-xl transition duration-300">
                    @if ($product->image)
                        <img class="rounded-t-lg w-full h-48 object-cover" src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}" />
                    @else
                        <img class="rounded-t-lg w-full h-48 object-cover"
                            src="{{ asset('storage/placeholder-image.png') }}" alt="Placeholder" />
                    @endif

                    <div class="p-6 flex flex-col items-center text-center">
                        <h5 class="mb-2 text-xl font-semibold text-white md:line-clamp-1 sm:line-clamp-1">
                            {{ $product->name }}
                        </h5>
                        <h5 class="mb-2 text-sm underline font-semibold text-white md:line-clamp-1 sm:line-clamp-1">
                            {{ $product->category->name }}
                        </h5>
                        <p class="mb-2 text-lg font-bold text-amber-200">IDR
                            {{ number_format($product->price, 0, ',', '.') }}</p>

                        <a href="/product/{{ $product->id }}/details"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-stone-700 hover:text-stone-100 bg-stone-100 rounded-lg hover:bg-stone-700 transition">
                            Read more
                            <svg class="w-4 h-4 ms-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10"
                                aria-hidden="true">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
