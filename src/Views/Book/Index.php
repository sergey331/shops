@include('Component.broadCast')
<section class="py-28">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Product Images -->
            <div class="w-full lg:w-1/2">
                <div class="flex gap-4">

                    <!-- LEFT: Thumbnails (scrollable) -->
                    <div class="swiper thumb-swiper w-[100px] shrink-0 max-h-[520px] overflow-y-auto hide-scrollbar">
                        <div class="swiper-wrapper">
                            @foreach ($images as $index => $image)
                                <div class="swiper-slide cursor-pointer">
                                    <img
                                            src="{{ $image['path'] }}"
                                            alt="Thumbnail {{ $index }}"
                                            class="w-full h-[80px] object-cover rounded-lg border border-gray-200 hover:border-indigo-500 transition"
                                    >
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- RIGHT: Main image -->
                    <div class="swiper large-swiper flex-1 border border-gray-200 rounded-lg overflow-hidden">
                        <div class="swiper-wrapper">
                            @foreach ($images as $index => $image)
                            <div class="swiper-slide flex items-center justify-center bg-white">
                                <img
                                        src="{{ $image['path'] }}"
                                        alt="Product image {{ $index }}"
                                        class="max-h-[520px] w-full object-contain"
                                >
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>


            <!-- Product Info -->
            <div class="w-full lg:w-1/2 lg:pl-8 pt-4 lg:pt-0">
                <div class="product-info">
                    <div class="mb-6">
                        <h1 class="text-3xl font-bold mb-2">{{ $book->title }}</h1>
                        <div class="flex items-center mb-2">
                            {{ getBookPrice($book) }}
                            <div class="flex ml-3 items-center text-yellow-400">
                                <!-- Star SVGs would go here -->
                                ★★★★★
                            </div>
                        </div>
                    </div>

                    <hr class="my-6 border-gray-200">

                    <!-- Product Options -->
                    <div class="space-y-6">
                        <div class="flex">
                            <span class="font-medium mr-2">IsBin:</span>
                            <span>{{ $book->isbn }}</span>
                        </div>
                        <div class="flex">
                            <span class="font-medium mr-2">Pages:</span>
                            <span>{{ $book->pages }}</span>
                        </div>
                        <div class="flex">
                            <span class="font-medium mr-2">Status:</span>
                            <span>{{ $book->status }}</span>
                        </div>
                        <!-- Quantity Selector -->
                        <div class="quantity-selector">
                            @if($book->stock)
                                <div class="mb-2 text-gray-600">In stock</div>
                            @endif
                            <div class="flex product-qty items-center">
                                <button type="button"
                                        class="input-group-btn bg-white shadow border border-gray-200 rounded-lg font-light p-2 quantity-left-minus">
                                    <svg width="16" height="16" class="fill-current">
                                        <use xlink:href="#minus"></use>
                                    </svg>
                                </button>
                                <input type="text" id="quantity" name="quantity"
                                       class="bg-white shadow border border-gray-200 rounded-lg py-2 mx-2 text-center w-12"
                                       value="1"
                                       min="1" max="100" required>
                                <button type="button"
                                        class="input-group-btn bg-white shadow border border-gray-200 rounded-lg font-light p-2 quantity-right-plus">
                                    <svg width="16" height="16" class="fill-current">
                                        <use xlink:href="#plus"></use>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-wrap gap-3 mt-6">
                            <a href="#" class="px-6 py-3 bg-primary text-white rounded-md transition">Order now</a>
                            <button
                               class="px-6 py-3 bg-gray-800 text-white rounded-md hover:bg-gray-700 transition add_to_cart" data-book_id="{{ $book->id }}">Add to
                                cart</button>
                            <a href="#" class="p-3 bg-gray-800 text-white rounded-md hover:bg-gray-700 transition">
                                <svg class="w-5 h-5 fill-current">
                                    <use xlink:href="#heart"></use>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <hr class="my-6 border-gray-200">

                    <!-- Product Meta -->
                    <div class="product-meta space-y-2">
                        <div class="flex">
                            <span class="font-medium mr-2">Publisher:</span>
                            <span>{{ $book->publisher->name }}</span>
                        </div>
                        <div class="flex flex-wrap">
                            <span class="font-medium mr-2">Authors:</span>
                            <div class="flex flex-wrap">
                                @foreach($book->authors as $author)
                                    <a href="#" class="text-gray-700 hover:text-primary mr-1">{{ $author->name }},</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="flex flex-wrap">
                            <span class="font-medium mr-2">Category:</span>
                            <div class="flex flex-wrap">
                                @foreach($book->categories as $category)
                                    <a href="#" class="text-gray-700 hover:text-primary mr-1">{{ $category->name }},</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="flex flex-wrap">
                            <span class="font-medium mr-2">Tags:</span>
                            <div class="flex flex-wrap">
                                @foreach($book->tags as $tag)
                                <a href="#" class="text-gray-700 hover:text-primary mr-1">{{ $tag->name }},</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="product-tabs pb-28">
    <div class="container mx-auto px-4">
        <div class="tabs-listing">
            <nav>
                <div class=" flex flex-wrap justify-center py-3 border-b" role="tablist">
                    <button
                            class="nav-link capitalize px-4 py-2 mx-1 hover:text-primary border-b-2 hover:border-primary text-primary border-primary"
                            id="nav-home-tab" data-tab-target="#nav-home" role="tab" aria-controls="nav-home"
                            aria-selected="true">Description
                    </button>
                    <button
                            class="nav-link capitalize px-4 py-2 mx-1 text-gray-600 hover:text-primary border-b-2 border-transparent hover:border-primary"
                            id="nav-review-tab" data-tab-target="#nav-review" role="tab" aria-controls="nav-review">
                        Reviews
                        (02)
                    </button>
                </div>
            </nav>

            <div class="tab-content border-b py-4">
                <!-- Description Tab -->
                <div class="tab-pane active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <p>{{ $book->description }}</p>
                </div>

                <!-- Reviews Tab -->
                <div class="tab-pane hidden" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab">
                    <div class="review-box space-y-4">
                        <!-- Review 1 -->
                        <div class="review-item flex">
                            <div class="image-holder mr-2">
                                <img src="/images/review-image1.jpg" alt="review"
                                     class="w-12 h-12 rounded-lg object-cover">
                            </div>
                            <div class="review-content">
                                <div class="rating text-primary flex">
                                    <svg class="w-4 h-4 fill-current">
                                        <use xlink:href="#star-fill"></use>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current">
                                        <use xlink:href="#star-fill"></use>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current">
                                        <use xlink:href="#star-fill"></use>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current">
                                        <use xlink:href="#star-fill"></use>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current">
                                        <use xlink:href="#star-fill"></use>
                                    </svg>
                                </div>
                                <div class="review-header">
                                    <span class="author-name font-medium">Tom Johnson</span>
                                    <span class="review-date text-gray-500">- 07/05/2022</span>
                                </div>
                                <p class="mt-1">Vitae tortor condimentum lacinia quis vel eros donec ac. Nam at lectus
                                    urna duis
                                    convallis convallis</p>
                            </div>
                        </div>

                        <!-- Review 2 -->
                        <div class="review-item flex">
                            <div class="image-holder mr-2">
                                <img src="/images/review-image2.jpg" alt="review"
                                     class="w-12 h-12 rounded-lg object-cover">
                            </div>
                            <div class="review-content">
                                <div class="rating text-primary flex">
                                    <svg class="w-4 h-4 fill-current">
                                        <use xlink:href="#star-fill"></use>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current">
                                        <use xlink:href="#star-fill"></use>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current">
                                        <use xlink:href="#star-fill"></use>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current">
                                        <use xlink:href="#star-fill"></use>
                                    </svg>
                                    <svg class="w-4 h-4 fill-current">
                                        <use xlink:href="#star-fill"></use>
                                    </svg>
                                </div>
                                <div class="review-header">
                                    <span class="author-name font-medium">Jenny Willis</span>
                                    <span class="review-date text-gray-500">- 07/05/2022</span>
                                </div>
                                <p class="mt-1">Vitae tortor condimentum lacinia quis vel eros donec ac. Nam at lectus
                                    urna duis
                                    convallis convallis</p>
                            </div>
                        </div>
                    </div>

                    <!-- Add Review Form -->
                    <div class="add-review mt-8">
                        <h3 class="text-xl font-semibold">Add a review</h3>
                        <p class="my-2">Your email address will not be published. Required fields are marked *</p>

                        <div class="review-rating py-2">
                            <span class="my-2 block">Your rating *</span>
                            <div class="rating text-gray-400 flex">
                                <svg class="w-4 h-4 fill-current">
                                    <use xlink:href="#star-fill"></use>
                                </svg>
                                <svg class="w-4 h-4 fill-current">
                                    <use xlink:href="#star-fill"></use>
                                </svg>
                                <svg class="w-4 h-4 fill-current">
                                    <use xlink:href="#star-fill"></use>
                                </svg>
                                <svg class="w-4 h-4 fill-current">
                                    <use xlink:href="#star-fill"></use>
                                </svg>
                                <svg class="w-4 h-4 fill-current">
                                    <use xlink:href="#star-fill"></use>
                                </svg>
                            </div>
                        </div>

                        <input type="file" class="w-full py-3 border-0 focus:outline-0">

                        <form id="form" class="space-y-4">
                            <div class="flex flex-col md:flex-row gap-4">
                                <div class="w-full md:w-1/2">
                                    <input type="text" name="name" placeholder="Write your name here *"
                                           class="w-full px-4 py-2 border border-gray-300 focus:border-gray-800 focus:outline-none focus:ring-0">
                                </div>
                                <div class="w-full md:w-1/2">
                                    <input type="text" name="email" placeholder="Write your email here *"
                                           class="w-full px-4 py-2 border border-gray-300 focus:border-gray-800 focus:outline-none focus:ring-0">
                                </div>
                            </div>

                            <div class="w-full">
                  <textarea placeholder="Write your review here *"
                            class="w-full px-4 py-2 border border-gray-300 focus:border-gray-800 focus:outline-none focus:ring-0"></textarea>
                            </div>

                            <label class="flex items-center">
                                <input type="checkbox" required class="mr-2">
                                <span>Save my name, email, and website in this browser for the next time.</span>
                            </label>

                            <button type="submit" name="submit"
                                    class="px-6 py-2 bg-primary text-white rounded transition-colors">Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="{{public_path('/assets/js/client/cart.js')}}"></script>
@include('Component.Home.instagram')
