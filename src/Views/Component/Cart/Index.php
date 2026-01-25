@empty(cart()->get())
<li>
    <span class="text-primary text-center font-medium">Your cart is empty</span>
</li>
@else
@foreach(cart()->get() as $cart)
<li class="flex justify-between">
    <div>
        <h5 class="font-medium">
            <a href="single-product.html" class="hover:text-primary">
                {{ $cart->getBook()->title }}
            </a>
        </h5>
        <p class="text-xs text-gray-500">Quantity - {{ $cart->getQuantity() }}</p>
    </div>
    <span class="text-primary">{{ $cart->getBook()->currency->synbol . '' . $cart->getSubtotal() }}</span>
</li>
@endforeach
<li class="flex justify-between border-t pt-2">
    <span class="font-bold">Total ({{ $cart->getBook()->currency->code }})</span>
    <strong>{{ cart()->total() }}</strong>
</li>

@endempty