@include('Component.broadCast')
<section class="py-28">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Product Images -->
            <div class="w-full lg:w-1/2">
                <div class="flex gap-4">
                    <!-- Thumbnail Swiper -->
                    <div class="swiper thumb-swiper w-1/4">
                        <div class="swiper-wrapper flex flex-wrap gap-3 content-start">
                            <div class="swiper-slide h-auto bg-white p-2">
                                <img src="/images/product-thumbnail-1.png" alt="product-thumb"
                                     class="w-full border border-gray-200 rounded-lg">
                            </div>
                            <div class="swiper-slide h-auto bg-white p-2">
                                <img src="/images/product-thumbnail-2.png" alt="product-thumb"
                                     class="w-full border border-gray-200 rounded-lg">
                            </div>
                            <div class="swiper-slide h-auto bg-white p-2">
                                <img src="/images/product-thumbnail-3.png" alt="product-thumb"
                                     class="w-full border border-gray-200 rounded-lg">
                            </div>
                        </div>
                    </div>

                    <!-- Main Image Swiper -->
                    <div class="swiper large-swiper border border-gray-200 rounded-lg overflow-hidden w-3/4">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide bg-white">
                                <img src="/images/product-large-1.png" alt="single-product" class="w-full">
                            </div>
                            <div class="swiper-slide bg-white">
                                <img src="/images/product-large-2.png" alt="single-product" class="w-full">
                            </div>
                            <div class="swiper-slide bg-white">
                                <img src="/images/product-large-3.png" alt="single-product" class="w-full">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Info -->
            <div class="w-full lg:w-1/2 lg:pl-8 pt-4 lg:pt-0">
                <div class="product-info">
                    <div class="mb-6">
                        <h1 class="text-3xl font-bold mb-2">The Emerald Crown</h1>
                        <div class="flex items-center mb-2">
                            <span class="text-2xl text-primary font-light mr-3">$200</span>
                            <del class="text-gray-500 mr-3">$260</del>
                            <div class="flex items-center text-yellow-400">
                                <!-- Star SVGs would go here -->
                                ★★★★★
                            </div>
                        </div>

                        <p class="text-gray-700 mb-4">Justo, cum feugiat imperdiet nulla molestie ac vulputate
                            scelerisque amet.
                            Bibendum adipiscing platea blandit sit sed quam semper rhoncus.</p>
                    </div>

                    <hr class="my-6 border-gray-200">

                    <!-- Product Options -->
                    <div class="space-y-6">
                        <!-- Color Options -->
                        <div class="color-options">
                            <h4 class="text-lg font-medium underline mb-3">Color</h4>
                            <ul class="flex space-x-4">
                                <li>
                                    <a href="#" class="text-gray-700 hover:text-primary">Gray</a>
                                </li>
                                <li>
                                    <a href="#" class="text-gray-700 hover:text-primary">Blue</a>
                                </li>
                                <li>
                                    <a href="#" class="text-gray-700 hover:text-primary">White</a>
                                </li>
                            </ul>
                        </div>

                        <!-- Size Options -->
                        <div class="size-options">
                            <h4 class="text-lg font-medium underline mb-3">Size</h4>
                            <ul class="flex space-x-4">
                                <li>
                                    <a href="#" class="text-gray-700 hover:text-primary">S</a>
                                </li>
                                <li>
                                    <a href="#" class="text-gray-700 hover:text-primary">M</a>
                                </li>
                                <li>
                                    <a href="#" class="text-gray-700 hover:text-primary">L</a>
                                </li>
                            </ul>
                        </div>

                        <!-- Quantity Selector -->
                        <div class="quantity-selector">
                            <div class="mb-2 text-gray-600">2 in stock</div>
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
                            <a href="#"
                               class="px-6 py-3 bg-gray-800 text-white rounded-md hover:bg-gray-700 transition">Add to
                                cart</a>
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
                            <span class="font-medium mr-2">SKU:</span>
                            <span>1223</span>
                        </div>
                        <div class="flex flex-wrap">
                            <span class="font-medium mr-2">Category:</span>
                            <div class="flex flex-wrap">
                                <a href="#" class="text-gray-700 hover:text-primary mr-1">Romance,</a>
                                <a href="#" class="text-gray-700 hover:text-primary mr-1">Sci-Fi,</a>
                                <a href="#" class="text-gray-700 hover:text-primary">Fiction</a>
                            </div>
                        </div>
                        <div class="flex flex-wrap">
                            <span class="font-medium mr-2">Tags:</span>
                            <div class="flex flex-wrap">
                                <a href="#" class="text-gray-700 hover:text-primary mr-1">Revenge,</a>
                                <a href="#" class="text-gray-700 hover:text-primary mr-1">Vampire,</a>
                                <a href="#" class="text-gray-700 hover:text-primary">Life</a>
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
                            id="nav-information-tab" data-tab-target="#nav-information" role="tab"
                            aria-controls="nav-information">Additional information
                    </button>
                    <button
                            class="nav-link capitalize px-4 py-2 mx-1 text-gray-600 hover:text-primary border-b-2 border-transparent hover:border-primary"
                            id="nav-shipping-tab" data-tab-target="#nav-shipping" role="tab"
                            aria-controls="nav-shipping">Shipping &
                        Return
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
                    <p>Product Description</p>
                    <p class="my-4">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque
                        volutpat
                        mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna viverra non, semper suscipit,
                        posuere a,
                        pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci.
                        Aenean
                        dignissim pellentesque felis. Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec
                        consectetuer
                        ligula vulputate sem tristique cursus.</p>
                    <ul class="font-light space-y-2 my-4">
                        <li>Donec nec justo eget felis facilisis fermentum.</li>
                        <li>Suspendisse urna viverra non, semper suscipit pede.</li>
                        <li>Aliquam porttitor mauris sit amet orci.</li>
                    </ul>
                    <p class="my-4">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque
                        volutpat
                        mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna viverra non, semper suscipit,
                        posuere a,
                        pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci.
                        Aenean
                        dignissim pellentesque felis. Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec
                        consectetuer
                        ligula vulputate sem tristique cursus.</p>
                </div>

                <!-- Additional Info Tab -->
                <div class="tab-pane hidden" id="nav-information" role="tabpanel" aria-labelledby="nav-information-tab">
                    <p>It is Comfortable and Best</p>
                    <p class="my-4">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla
                        pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                        mollit anim
                        id est laborum. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat
                        nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                        deserunt mollit
                        anim id est laborum.</p>
                </div>

                <!-- Shipping Tab -->
                <div class="tab-pane hidden" id="nav-shipping" role="tabpanel" aria-labelledby="nav-shipping-tab">
                    <p>Returns Policy</p>
                    <p class="my-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eros justo, accumsan
                        non dui
                        sit amet. Phasellus semper volutpat mi sed imperdiet. Ut odio lectus, vulputate non ex non,
                        mattis
                        sollicitudin purus. Mauris consequat justo a enim interdum, in consequat dolor accumsan. Nulla
                        iaculis
                        diam purus, ut vehicula leo efficitur at.</p>
                    <p class="my-4">Interdum et malesuada fames ac ante ipsum primis in faucibus. In blandit nunc enim,
                        sit amet
                        pharetra erat aliquet ac.</p>
                    <p>Shipping</p>
                    <p class="my-4">Pellentesque ultrices ut sem sit amet lacinia. Sed nisi dui, ultrices ut turpis
                        pulvinar.
                        Sed fringilla ex eget lorem consectetur, consectetur blandit lacus varius. Duis vel scelerisque
                        elit, et
                        vestibulum metus. Integer sit amet tincidunt tortor. Ut lacinia ullamcorper massa, a fermentum
                        arcu
                        vehicula ut. Ut efficitur faucibus dui Nullam tristique dolor eget turpis consequat varius.
                        Quisque a
                        interdum augue. Nam ut nibh mauris.</p>
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
@include('Component.Home.instagram')