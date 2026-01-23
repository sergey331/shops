{!!

use Kernel\Model\Paginator;
!!}

@include('Component.broadCast')

<div class="py-16">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row-reverse gap-8 relative" >
            <!-- Main Content -->
            <main class="w-full lg:w-3/4" id="books">
                <div>
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
                </div>
            </main>

            <div id="books-loader"
                 class="hidden absolute inset-0 flex items-center justify-center bg-white/70 z-10">
                <div id="preloader" class="preloader-container">
                    <div class="book">
                        <div class="inner">
                            <div class="left"></div>
                            <div class="middle"></div>
                            <div class="right"></div>
                        </div>
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Sidebar -->
            <aside class="w-full lg:w-1/4 lg:pr-8">
                <div class="space-y-8">
                    <!-- Search Widget -->
                    <div class="widget-menu">
                        <div class="flex border border-gray-300 rounded-lg p-2 bg-white">
                            <input class="flex-grow border-0 px-3 py-2 focus:outline-none" type="search" placeholder="Search"
                                aria-label="Search" id="search_input">
                            <button class="bg-primary rounded-lg p-2 flex items-center justify-center transition" type="button" id="search">
                                <svg class="text-white w-5 h-5" fill="currentColor">
                                    <use xlink:href="#search"></use>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Categories Widget -->
                    <div class="relative ">
                        <!-- Categories -->
                        <h3 class="text-lg font-semibold mb-4">Categories</h3>
                        <div class="dropdown-container mb-4" data-name="categories">
                            <div class="dropdown-button border border-gray-300 rounded-lg px-3 py-2 flex justify-between items-center cursor-pointer">
                                <div class="selected-container flex flex-wrap gap-1">
                                    <span class="placeholder text-gray-400">Select categories...</span>
                                </div>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>

                            <div class="dropdown-menu absolute hidden mt-1 w-full bg-white border border-gray-300 rounded-lg shadow max-h-40 overflow-y-auto z-10">
                                @foreach($categories as $category)
                                    <label class="flex items-center px-3 py-2 hover:bg-gray-100 cursor-pointer">
                                        <input type="checkbox" value="{{ $category->id }}" class="mr-2 checkbox"> {{ $category->name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Tags -->
                        <h3 class="text-lg font-semibold mb-4">Tags</h3>
                        <div class="relative mt-3 mb-4 dropdown-container" data-name="tags">
                            <div class="dropdown-button border border-gray-300 rounded-lg px-3 py-2 flex justify-between items-center cursor-pointer">
                                <div class="selected-container flex flex-wrap gap-1">
                                    <span class="placeholder text-gray-400">Select tags...</span>
                                </div>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>

                            <div class="dropdown-menu absolute hidden mt-1 w-full bg-white border border-gray-300 rounded-lg shadow max-h-40 overflow-y-auto z-10">
                                @foreach($tags as $tag)
                                    <label class="flex items-center px-3 py-2 hover:bg-gray-100 cursor-pointer">
                                        <input type="checkbox" value="{{ $tag->id }}" class="mr-2 checkbox"> {{ $tag->name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <!-- Tags -->
                        <h3 class="text-lg font-semibold mb-4">Authors</h3>
                        <div class="relative mt-3 dropdown-container" data-name="authors">
                            <div class="dropdown-button border border-gray-300 rounded-lg px-3 py-2 flex justify-between items-center cursor-pointer">
                                <div class="selected-container flex flex-wrap gap-1">
                                    <span class="placeholder text-gray-400">Select authors...</span>
                                </div>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>

                            <div class="dropdown-menu absolute hidden mt-1 w-full bg-white border border-gray-300 rounded-lg shadow max-h-40 overflow-y-auto z-10">
                                @foreach($authors as $author)
                                <label class="flex items-center px-3 py-2 hover:bg-gray-100 cursor-pointer">
                                    <input type="checkbox" value="{{ $author->id }}" class="mr-2 checkbox"> {{ $author->name }}
                                </label>
                                @endforeach
                            </div>
                        </div>
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

<script src="{{public_path('/assets/js/client/shop.js')}}"></script>