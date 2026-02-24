<ul class="space-y-4 mb-4">
    @foreach($wishlists as $wishlist)
    <li class="flex justify-between">
        <div>
            <h5 class="font-medium">
                <a href="/book/{{ $wishlist->book->id }}" class="hover:text-primary">
                    {{ $wishlist->book->title }}
                </a>
            </h5>
            <p class="text-xs text-gray-500"></p>
            <a href="#" class="text-sm font-medium text-primary hover:underline block mt-1">{{ $wishlist->book->description }}</a>
        </div>
        <span class="text-primary">
            {{ getBookPrice($wishlist->book) }}
        </span>
    </li>
    @endforeach
</ul>