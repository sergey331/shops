{!!

use Kernel\Model\Paginator;
!!}

<div>
    <!-- Product Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach ($books->data as $book)
        <div class="card relative p-6 border rounded-xl hover:shadow-lg transition-shadow">
            @if($book->discount)
            <div class="absolute top-4 left-4">
                <p class="bg-primary py-1 px-3 text-sm text-white rounded-lg">
                    {{ showDiscount($book->discount,setting()->currency->symbol) }}
                </p>
            </div>
            @endif
            <img src="{{ public_path('/uploads/books/' . $book->id . '/'. $book->cover_image) }}" class="w-full min-h-[320px] shadow-sm" alt="House of Sky Breath">
            <h6 class="mt-4 mb-1 font-bold text-lg">
                <a href="/book/{{ $book->id }}" class="hover:text-primary">
                    {{ $book->title }}
                </a>
            </h6>

            {{ getBookPrice($book) }}
            <div class="card-concern absolute left-0 right-0 flex justify-center gap-2 opacity-0">
                <button type="button" data-book_id="{{ $book->id }}" class="addcart p-2 bg-gray-800 text-white rounded-full hover:bg-gray-700">
                    <svg class="w-8 h-8 p-1">
                        <use xlink:href="#cart"></use>
                    </svg>
                </button>
                <a href="#" class="p-2 bg-gray-800 text-white rounded-full hover:bg-gray-700">
                    <svg class="w-8 h-8 p-1">
                        <use xlink:href="#heart"></use>
                    </svg>
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    {{ Paginator::html($books) }}
</div>