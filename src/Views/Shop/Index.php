{!!

use Kernel\Model\Paginator;
!!}

@include('Component.broadCast')

<div class="py-16">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row-reverse gap-8 relative" >
            <!-- Main Content -->
            <main class="w-full lg:w-3/4" id="books">
                {{ $booksData }}
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
<script src="{{public_path('/assets/js/client/cart.js')}}"></script>