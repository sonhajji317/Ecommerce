<header>
    <nav class="bg-stone-500">
        <div class="max-w-screen-xl mx-auto flex flex-wrap justify-between items-center p-4">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-3">
                <img src="{{ asset('storage/logo-bulat.png') }}" class="h-10" alt="Logo" />
                <span class="text-amber-200 text-2xl font-semibold">ASC Creative</span>
            </a>

            <!-- Menu -->
            <div class="flex items-center gap-x-8">
                <ul class="flex flex-row gap-x-6 font-medium">

                    {{-- Home --}}
                    <li>
                        <a href="{{ route('home') }}"
                            class="text-amber-200 text-sm hover:text-white {{ request()->routeIs('home') ? 'underline' : '' }}">
                            Home
                        </a>
                    </li>

                    {{-- Product --}}
                    <li>
                        @if (auth()->check() && auth()->user()->role === 'admin')
                            <a href="{{ route('products.index') }}"
                                class="text-amber-200 text-sm hover:text-white {{ request()->routeIs('products.index') ? 'underline' : '' }}">
                                Product
                            </a>
                        @else
                            <a href="{{ route('productAll', 'all') }}"
                                class="text-amber-200 text-sm hover:text-white {{ request()->routeIs('productAll') ? 'underline' : '' }}">
                                Product
                            </a>
                        @endif
                    </li>

                    {{-- Category (khusus admin) --}}
                    @if (auth()->check() && auth()->user()->role === 'admin')
                        <li>
                            <a href="{{ route('categories.index') }}"
                                class="text-amber-200 text-sm hover:text-white {{ request()->routeIs('categories.index') ? 'underline' : '' }}">
                                Category
                            </a>
                        </li>
                    @endif

                    {{-- About (semua user) --}}
                    <li>
                        <a href="{{ route('about') }}"
                            class="text-amber-200 text-sm hover:text-white {{ request()->is('about') ? 'underline' : '' }}">
                            About
                        </a>
                    </li>

                    {{-- Order --}}
                    <li>
                        @if (auth()->check())
                            <a href="{{ route('orderList') }}"
                                class="text-amber-200 text-sm hover:text-white {{ request()->routeIs('orderList') ? 'underline' : '' }}">
                                Order
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-amber-200 text-sm hover:text-white">
                                Order
                            </a>
                        @endif
                    </li>

                </ul>

                <!-- Auth Button -->
                <div class="flex justify-center">
                    @guest
                        <a href="{{ route('login') }}"
                            class="text-stone-700 text-sm font-semibold hover:text-stone-300 hover:bg-stone-700 px-2 py-1 rounded-lg bg-stone-300">
                            Sign in / Sign up
                        </a>
                    @else
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                class="text-stone-700 text-sm font-semibold hover:text-stone-300 hover:bg-stone-700 px-2 py-1 rounded-lg bg-stone-300">
                                Logout
                            </button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>
</header>
