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
    <span class="text-primary">{{ $c->getBook()->currency->symbol . '' . $c->getSubtotal() }}</span>
</li>
@endforeach
<li class="flex justify-between border-t pt-2">
    <span class="font-bold">Total ({{ $c->getBook()->currency->code }})</span>
    <strong>{{ $cart->total() }}</strong>
</li>

@endempty