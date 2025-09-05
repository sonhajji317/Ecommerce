@extends('layouts.app')

@section('content')
    <div class="bg-stone-300">
        <div class="mx-auto pt-6 ">
            <form class="max-w-md mx-auto" action="{{ route('productAll', ['id' => $currentCategory ?? 'all']) }}"
                method="GET">
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-stone-100 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="text" id="search" name="search" value="{{ request('search') }}"
                        class="block w-full p-4 ps-10 text-sm text-stone-100 border border-stone-300 rounded-lg bg-stone-700 focus:ring-stone-500 focus:border-stone-500 placeholder:text-stone-100"
                        placeholder="Search Product By Name..." />
                    <button type="submit"
                        class="text-stone-700 absolute end-2.5 bottom-2.5 bg-stone-100 hover:bg-stone-200  focus:ring-4 focus:outline-none focus:ring-stone-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
                </div>
            </form>
        </div>
        <div class="flex items-center justify-center py-4 md:py-8 flex-wrap gap-4">
            <!-- Tombol ALL -->
            <a href="{{ route('productAll', 'all') }}"
                class="px-2 py-1 font-semibold rounded-lg shadow transition border
               {{ request()->route('id') === 'all'
                   ? 'bg-stone-800 text-white border-stone-800'
                   : 'bg-stone-700 text-stone-100 hover:bg-stone-100 hover:text-stone-700 hover:border-stone-700' }}">
                All categories
            </a>

            <!-- Tombol Kategori -->
            @foreach ($categories as $category)
                <a href="{{ route('productAll', $category->id) }}"
                    class="px-2 py-1 font-semibold rounded-lg shadow transition border
                   {{ request()->route('id') == $category->id
                       ? 'bg-stone-800 text-white border-stone-800'
                       : 'bg-stone-700 text-stone-100 hover:bg-stone-100 hover:text-stone-700 hover:border-stone-700' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-8 py-4 px-8">
            @forelse ($products as $product)
                <div class="relative group w-full">
                    <a href="/product/{{ $product->id }}/details">
                        <!-- Gambar produk -->
                        @if ($product->image)
                            <img class="w-full h-80 sm:h-40 object-cover rounded-lg"
                                src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        @else
                            <img class="w-full h-80 sm:h-40 object-cover rounded-lg"
                                src="{{ asset('storage/placeholder-image.png') }}" alt="{{ $product->name }}">
                        @endif

                        <!-- Overlay hitam tipis -->
                        <div
                            class="absolute inset-0 bg-black/40 rounded-lg opacity-0 
                            transition-opacity duration-500 group-hover:opacity-100">
                        </div>

                        <!-- Teks muncul pas hover -->
                        <div
                            class="absolute inset-0 flex flex-col items-center justify-center gap-2
                        text-white font-bold 
                        opacity-0 translate-y-6 transition-all duration-500 
                        group-hover:opacity-100 group-hover:translate-y-0">

                            <span class="text-md line-clamp-1">{{ $product->name }}</span>
                            <span class="text-lg text-amber-100">IDR
                                {{ number_format($product->price, 0, ',', '.') }}</span>
                        </div>
                    </a>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center col-span-full py-5">
                    <img class="h-40 w-40 object-contain mb-4" src="{{ asset('storage/placeholder-image.png') }}"
                        alt="No product">
                    <span class="text-stone-700 font-semibold">Oopss!!! No product available.</span>
                </div>
            @endforelse

        </div>
        <div class="pb-6 px-8">
            {{ $products->links() }}
        </div>
    </div>
@endsection
