<a href="/cart" class="text-dark hover:text-primary flex items-center">
    <svg class="w-5 h-5">
        <use xlink:href="#cart"></use>
    </svg>
    <span class="text-xs ml-1 price_count">({{ count($cart->get()) }})</span>
</a>
<div class="absolute right-0 w-72 bg-white shadow-lg rounded-md p-4 z-50 hidden group-hover:block">
    <div class="flex justify-between items-center mb-4">
        <span class="text-primary font-medium">Your cart</span>
        <span class="bg-primary text-white text-xs px-2 py-1 rounded-full price_count">({{
            count($cart->get()) }})</span>
    </div>
    <ul class="space-y-4 mb-4">
        @empty($cart->get())
        <li>
            <span class="text-primary text-center font-medium">Your cart is empty</span>
        </li>
        @else
        @foreach($cart->get() as $c)
        <li class="flex justify-between">
            <div>
                <h5 class="font-medium">
                    <a href="single-product.html" class="hover:text-primary">
                        {{ $c->getBook()->title }}
                    </a>
                </h5>
                <p class="text-xs text-gray-500">Quantity - {{ $c->getQty() }}</p>
            </div>
            <span class="text-primary">{{ setting()->currency->symbol . '' . $c->getSubtotal() }}</span>
        </li>
        @endforeach
        <li class="flex justify-between border-t pt-2">
            <span class="font-bold">Total ({{ setting()->currency->code }})</span>
            <strong>{{ $cart->total() }}</strong>
        </li>

        @endempty
    </ul>
    @if(!empty($cart->get()))
    <div class="space-y-2">
        <a href="/cart" class="block w-full bg-dark text-black py-2 text-center rounded hover:bg-opacity-90">View
            Cart</a>
        <a href="/checkout" class="block w-full bg-primary text-white py-2 text-center rounded hover:bg-opacity-90">Go
            to
            checkout</a>
    </div>
    @endif
</div>