<footer class="bg-stone-600 shadow-sm ">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <a href="/" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('storage/logo-bulat.png') }}" class="h-8" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-amber-200">ASC Creative</span>
            </a>
            <ul class="flex flex-wrap items-center mb-6 text-sm text-amber-200 sm:mb-0 font-semibold gap-4">
                <li>
                    <a href="{{ route('home') }}"
                        class="text-amber-200 text-sm hover:text-white {{ request()->routeIs('home') ? 'underline' : '' }}">Home</a>
                </li>
                <li>
                    @if (auth()->check() && auth()->user()->role === 'admin')
                        <a href="{{ route('products.index') }}"
                            class="text-amber-200 text-sm hover:text-white {{ request()->routeIs('products.index') ? 'underline' : '' }}">
                            Product
                        </a>
                    @elseif (!auth()->check() || auth()->user()->role === 'user')
                        <a href="/product/category/all"
                            class="text-amber-200 text-sm hover:text-white {{ request()->routeIs('productAll') ? 'underline' : '' }}">Product
                        </a>
                    @endif
                </li>
                <li>
                    @if (auth()->check() && auth()->user()->role === 'admin')
                        <a href="{{ route('categories.index') }}"
                            class="text-amber-200 text-sm hover:text-white {{ request()->routeIs('categories.index') ? 'underline' : '' }}">
                            Category
                        </a>
                    @elseif (!auth()->check() || auth()->user()->role === 'user')
                        <a href="{{ route('about') }}"
                            class="text-amber-200 text-sm hover:text-white {{ request()->is('about') ? 'underline' : '' }}">About</a>
                    @endif
                </li>
                <li>
                    @if (!auth()->check())
                        <a href="{{ route('login') }}"
                            class="text-amber-200 text-sm hover:text-white {{ request()->routeIs('orderList') ? 'underline' : '' }}">Order</a>
                    @elseif (auth()->user()->role === 'user' || auth()->user()->role === 'admin')
                        <a href="{{ route('orderList') }}"
                            class="text-amber-200 text-sm hover:text-white {{ request()->routeIs('orderList') ? 'underline' : '' }}">Order</a>
                    @endif
                </li>
            </ul>
        </div>
        <hr class="my-6 border-amber-200 sm:mx-auto  lg:my-8" />
        <span class="block text-sm text-amber-200 sm:text-center ">© 2025 <a href="/" class="hover:underline">ASC
                Creative</a>. All Rights Reserved.</span>
    </div>
</footer>
