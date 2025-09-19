<div class="grid gap-4 sm:mx-9">
    {{-- Produk Utama --}}
    <div data-aos="fade-right" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="1000">
        <a href="/product/{{ $product1->id }}/details">
            <div class="relative h-[60vh] sm:h-screen bg-cover bg-center group w-full"
                style="background-image: url('{{ $product1->image ? asset('storage/' . $product1->image) : asset('storage/placeholder-image.png') }}')">

                <!-- Overlay -->
                <div class="absolute inset-0 bg-black/40"></div>

                <!-- Text muncul pas hover -->
                <div
                    class="absolute inset-0 flex flex-col items-center justify-center gap-2
                        text-white text-xl font-bold 
                        opacity-0 translate-y-6 transition-all duration-500 
                        group-hover:opacity-100 group-hover:translate-y-0">

                    <span>{{ $product1->name }}</span>
                    <span class="text-lg text-amber-200">IDR
                        {{ number_format($product1->price, 0, ',', '.') }}</span>
                </div>
            </div>
        </a>
    </div>
</div>

{{-- Grid produk lain --}}
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 px-6 sm:px-9 py-5" data-aos="fade-left"
    data-aos-offset="300" data-aos-easing="ease-in-sine">
    @forelse ($product2 as $product)
        <div class="relative group w-full">
            <a href="/product/{{ $product->id }}/details">
                <!-- Gambar produk -->
                @if ($product->image)
                    <img class="w-full h-64 sm:h-40 object-cover rounded-lg"
                        src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                @elseif ($product->image == null)
                    <img class="w-full h-64 sm:h-40 object-cover rounded-lg"
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
                    <span class="text-lg text-amber-200">IDR
                        {{ number_format($product->price, 0, ',', '.') }}</span>
                </div>
            </a>
        </div>
    @empty
        <div>
            <img class="h-auto max-w-full rounded-lg" src="{{ asset('storage/placeholder-image.png') }}"
                alt="placeholder-image">
        </div>
    @endforelse
</div>
