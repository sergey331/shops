@if(!empty($wishlists))
<div class="container mx-auto px-4">
    <div class="mb-5">
        <h1 class="text-4xl">My Wishlist</h1>
    </div>
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

        @foreach ($wishlists as $item)
        <div class="bg-white rounded-2xl shadow overflow-hidden">

            <img
                    src="{{ public_path('uploads/books/' . $item->book->id . '/'. $item->book->cover_image)}}"
                    class="aspect-square object-cover w-full"
                    alt="pr im"
            />

            <div class="p-4">
                <h3 class="font-semibold">{{ $item->book->title }}</h3>
                <p class="text-gray-500">{{ setting()->currency->symbol . '' . $item->book->price }}</p>

                <form method="POST" action="/wishlist/remove">
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <button class="mt-3 text-red-600">Remove</button>
                </form>
            </div>

        </div>
        @endforeach
    </div>
</div>
@endif