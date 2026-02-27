<a href="/wishlist" class="text-dark hover:text-primary flex items-center">
    <svg class="w-5 h-5">
        <use xlink:href="#heart"></use>
    </svg>
    <span class="text-xs ml-1">(<span class="wishCount"></span>)</span>
</a>
<div class="absolute right-0 w-72 bg-white shadow-lg rounded-md p-4 z-50 hidden group-hover:block">
    <div class="flex justify-between items-center mb-4">
        <span class="text-primary font-medium">Your wishlist</span>
        <span class="wishCount bg-primary text-white text-xs px-2 py-1 rounded-full"></span>
    </div>
    <ul class="space-y-4 mb-4">
        @empty($wishlists)
        <li>
            <span class="text-primary text-center font-medium">Your wishlist is empty</span>
        </li>
        @else
        @foreach($wishlists as $wishlist)
            <li class="flex justify-between">
                <div>
                    <h5 class="font-medium">
                        <a href="/book/{{ $wishlist->book->id}}" class="hover:text-primary">
                            {{ $wishlist->book->title }}
                        </a>
                    </h5>
                </div>
                <span class="text-primary">{{ setting()->currency->symbol . '' . $wishlist->book->price }}</span>
            </li>
        @endforeach

        @endempty
    </ul>
    <div class="space-y-2">
        <a href="#"
           class="block w-full bg-primary text-white py-2 text-center rounded hover:bg-opacity-90">Add
            all to cart</a>
        <a href="/wishlist"
           class="block w-full bg-primary text-white py-2 text-center rounded hover:bg-opacity-90">View
            wishlist</a>
    </div>
</div>