<div class="max-w-8xl sm:px-8 px-6 pb-6">
    <h1 class="text-2xl font-bold px-8 mb-4">Related Products</h1>
    <div class="max-w-9xl sm:mx-auto grid gap-8 sm:grid-cols-2 lg:grid-cols-4 sm:px-8 px-6">
        @foreach ($relatedProducts as $product)
            <div
                class="bg-stone-500 border border-stone-500 rounded-lg shadow-md hover:shadow-xl transition duration-300">
                @if ($product->image)
                    <img class="rounded-t-lg w-full h-48 object-cover" src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}" />
                @else
                    <img class="rounded-t-lg w-full h-48 object-cover" src="{{ asset('storage/placeholder-image.png') }}"
                        alt="Placeholder" />
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
