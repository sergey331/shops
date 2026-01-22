{!!

use Kernel\Model\Paginator;
!!}

@include('Component.broadCast')

<div class="py-16">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row-reverse gap-8">
            <!-- Main Content -->
            <main class="w-full lg:w-3/4">

                <!-- Product Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    
                    @foreach ($books->data as $book)
                    <div class="card relative p-6 border rounded-xl hover:shadow-lg transition-shadow">
                        @if($book->discount) 
                            <div class="absolute top-4 left-4">
                                <p class="bg-primary py-1 px-3 text-sm text-white rounded-lg">{{ $book->discount->price }} off</p>
                            </div>
                        @endif
                        <img src="{{ public_path('/uploads/books/' . $book->id . '/'. $book->cover_image) }}" class="w-full min-h-[320px] shadow-sm" alt="House of Sky Breath">
                        <h6 class="mt-4 mb-1 font-bold text-lg">
                            <a href="single-product.html" class="hover:text-primary">
                                {{ $book->title }}
                            </a>
                        </h6>

                        <span class="price text-primary font-bold text-lg">
                            {{ $book->price . ' ' . $book->currency->symbol }}
                        </span>
                        <div class="card-concern absolute left-0 right-0 flex justify-center gap-2 opacity-0">
                            <button type="button" class="p-2 bg-gray-800 text-white rounded-full hover:bg-gray-700">
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
            </main>

            <!-- Sidebar -->
            <aside class="w-full lg:w-1/4 lg:pr-8">
                <div class="space-y-8">
                    <!-- Search Widget -->
                    <div class="widget-menu">
                        <form class="flex border border-gray-300 rounded-lg p-2 bg-white">
                            <input class="flex-grow border-0 px-3 py-2 focus:outline-none" type="search" placeholder="Search"
                                aria-label="Search">
                            <button class="bg-primary rounded-lg p-2 flex items-center justify-center transition" type="submit">
                                <svg class="text-white w-5 h-5" fill="currentColor">
                                    <use xlink:href="#search"></use>
                                </svg>
                            </button>
                        </form>
                    </div>

                    <!-- Categories Widget -->
                    <div class="widget-product-categories">
                        <h3 class="text-lg font-semibold mb-4">Categories</h3>
                        <ul class="space-y-2">
                            <li><a href="/collections/categories" class="text-gray-600 hover:text-primary">All</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-primary">Romance</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-primary">Recipie</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-primary">Sci-Fi</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-primary">Lifestyle</a></li>
                        </ul>
                    </div>

                    <!-- Tags Widget -->
                    <div class="widget-product-tags">
                        <h3 class="text-lg font-semibold mb-4">Tags</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-600 hover:text-primary">Sci-Fi</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-primary">Revenge</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-primary">Zombie</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-primary">Vampire</a></li>
                        </ul>
                    </div>

                    <!-- Author Widget -->
                    <div class="widget-product-authur">
                        <h3 class="text-lg font-semibold mb-4">Author</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-600 hover:text-primary">Hanna Clark</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-primary">Albert E. Beth</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-primary">D.K John</a></li>
                        </ul>
                    </div>

                    <!-- Price Filter Widget -->
                    <div class="widget-price-filter">
                        <h3 class="text-lg font-semibold mb-4">Filter by price</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-600 hover:text-primary">Less than $10</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-primary">$10- $20</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-primary">$20- $30</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-primary">$30- $40</a></li>
                            <li><a href="#" class="text-gray-600 hover:text-primary">$40- $50</a></li>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>

@include('Component.Home.instagram')