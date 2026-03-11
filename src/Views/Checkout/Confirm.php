<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-xl p-6">

    <h2 class="text-2xl font-semibold mb-6">Order Summary</h2>

    <table class="w-full border-collapse">

        <thead>
        <tr class="border-b text-left text-gray-600 text-sm uppercase">
            <th class="py-3">Product</th>
            <th class="py-3 text-center">Qty</th>
            <th class="py-3 text-right">Price</th>
            <th class="py-3 text-right">Total</th>
        </tr>
        </thead>

        <tbody class="divide-y">

        <!-- Products -->
        @dd($order->books)
            @foreach($order->books as $book)
                <tr>
                    <td class="py-4 flex items-center gap-3">
                        <img src="{{ public_path('/uploads/books/' . $book->book->id . '/'. $book->book->cover_image) }}" class="w-12 h-16 object-cover rounded">
                        <span class="font-medium">{{ $book->name }}</span>
                    </td>

                    <td class="text-center">{{ $book->quantity }}</td>

                    <td class="text-right">{{ getBookPrice($book->book) }}</td>

                    <td class="text-right font-medium">{{ getBookPrice($book->book,$book->quantity) }}</td>
                </tr>
            @endforeach
        </tbody>

    </table>

    <!-- totals -->
    <div class="mt-8 border-t pt-6 space-y-3 text-sm">

        <div class="flex justify-between">
            <span class="text-gray-600">Subtotal</span>
            <span>{{ $order->subtotal . ' ' . setting()->currency->symbol }} </span>
        </div>

        <div class="flex justify-between">
            <span class="text-gray-600">Discount</span>
            <span class="text-green-600">{{ $order->discounted . ' ' . setting()->currency->symbol }}</span>
        </div>

        <div class="flex justify-between">
            <span class="text-gray-600">Shipping</span>
            <span>{{ $order->shippingMethodItem->price . ' ' . setting()->currency->symbol }}</span>
        </div>

        <div class="flex justify-between text-lg font-semibold border-t pt-4">
            <span>Total</span>
            <span>{{ $order->total . ' ' . setting()->currency->symbol }}</span>
        </div>

    </div>

    <!-- confirm button -->
    <div class="mt-6 text-right">
        <button
            class="bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-800 transition">
            Confirm Order
        </button>
    </div>

</div>