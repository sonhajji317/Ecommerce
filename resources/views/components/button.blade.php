<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-stone-100 text-stone-700 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-stone-200 hover:text-stone-800 active:text-stone-100 focus:bg-stone-700 active:bg-stone-900 focus:outline-none focus:ring-2 focus:ring-stone-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
