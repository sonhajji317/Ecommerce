@extends('layouts.app')

@section('title', 'Pay Order')
@section('content')
    <div class="min-h-screen flex items-center justify-center bg-stone-300 py-10">
        <div class="bg-stone-500 p-8 rounded-2xl shadow-lg w-full max-w-lg">
            <h2 class="text-2xl font-bold mb-6 text-white text-center">Checkout Details</h2>

            <div class="space-y-6">
                {{-- Product Name --}}
                <div>
                    <label for="product_id" class="block text-sm font-medium text-white mb-1">Product</label>
                    <input type="text" id="product_id" name="product_id" value="{{ $order->product->name }}" readonly
                        class="w-full border border-stone-500 rounded-lg px-3 py-2 bg-gray-100 cursor-not-allowed text-stone-700 font-semibold">
                </div>

                {{-- Product Image --}}
                <div>
                    <label class="block text-sm font-medium text-white mb-2">Product Image</label>
                    <div class="w-full h-64 rounded-lg overflow-hidden border border-stone-500 shadow-sm">
                        @if ($order->product->image)
                            <img src="{{ asset('storage/' . $order->product->image) }}" alt="{{ $order->product->name }}"
                                class="object-cover w-full h-full">
                        @else
                            <img src="{{ asset('storage/placeholder-image.png') }}" alt="{{ $order->product->name }}"
                                class="object-cover w-full h-full">
                        @endif
                    </div>
                </div>

                {{-- Quantity --}}
                <div>
                    <label for="qty" class="block text-sm font-medium text-white mb-1">Quantity</label>
                    <input type="number" id="qty" name="qty" value="{{ old('qty', $order->qty) }}" min="1"
                        readonly
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100 text-stone-700 cursor-not-allowed font-medium">
                </div>

                {{-- Total Price --}}
                <div>
                    <label for="total_price" class="block text-sm font-medium text-white mb-1">Total Price</label>
                    <input type="text" id="total_price" name="total_price"
                        value="Rp {{ number_format($order->total_price, 0, ',', '.') }}" readonly
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100 text-green-600 font-bold cursor-not-allowed">
                </div>

                {{-- Status --}}
                <div>
                    <label for="status" class="block text-sm font-bold text-white mb-1">Status</label>
                    <input type="text" id="status" name="status" value="{{ old('status', $order->status) }}"readonly
                        class="w-full capitalize border border-gray-300 rounded-lg px-3 py-2 bg-gray-100  font-semibold cursor-not-allowed {{ $order->status == 'unpaid' ? 'text-amber-500' : 'text-green-600' }}">
                </div>

                {{-- Pay Button --}}
                <div class="flex justify-end pt-4">
                    <button type="submit" id="pay-button"
                        class="px-6 py-2 bg-stone-100 text-stone-700 font-semibold rounded-lg shadow hover:bg-stone-700 hover:text-stone-100 transition">
                        Pay Now
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        document.getElementById('pay-button').addEventListener('click', function() {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    alert("Payment success!");
                    console.log(result);
                    window.location.href = "{{ route('orderList') }}";
                },
                onPending: function(result) {
                    alert("Waiting for your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    alert("Payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    alert("You closed the popup without finishing the payment");
                }
            });
        });
    </script>
@endsection
