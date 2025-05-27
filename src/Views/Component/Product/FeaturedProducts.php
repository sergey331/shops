<div class="max-w-7xl mx-auto px-4 py-10">
    <h2 class="text-2xl font-bold mb-6">🛍 Featured Products</h2>

    <!-- Swiper Container -->
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide">
                <div class="bg-white rounded-lg shadow p-4 w-[250px] mx-auto">
                    <img src="https://cdn.pixabay.com/photo/2015/04/23/22/00/new-year-background-736885_1280.jpg" class="w-full h-40 object-cover rounded" />
                    <h3 class="mt-4 font-semibold text-lg">Product 1</h3>
                    <p class="text-gray-500">$29.99</p>
                    <button class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">Add to Cart</button>
                </div>
            </div>

            <!-- Repeat for other slides -->
            <div class="swiper-slide">
                <div class="bg-white rounded-lg shadow p-4 w-[250px] mx-auto">
                    <img src="https://cdn.pixabay.com/photo/2015/04/23/22/00/new-year-background-736885_1280.jpg" class="w-full h-40 object-cover rounded" />
                    <h3 class="mt-4 font-semibold text-lg">Product 2</h3>
                    <p class="text-gray-500">$39.99</p>
                    <button class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">Add to Cart</button>
                </div>
            </div>

            <!-- Repeat for other slides -->
            <div class="swiper-slide">
                <div class="bg-white rounded-lg shadow p-4 w-[250px] mx-auto">
                    <img src="https://cdn.pixabay.com/photo/2015/04/23/22/00/new-year-background-736885_1280.jpg" class="w-full h-40 object-cover rounded" />
                    <h3 class="mt-4 font-semibold text-lg">Product 2</h3>
                    <p class="text-gray-500">$39.99</p>
                    <button class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">Add to Cart</button>
                </div>
            </div>

            <!-- Repeat for other slides -->
            <div class="swiper-slide">
                <div class="bg-white rounded-lg shadow p-4 w-[250px] mx-auto">
                    <img src="https://cdn.pixabay.com/photo/2015/04/23/22/00/new-year-background-736885_1280.jpg" class="w-full h-40 object-cover rounded" />
                    <h3 class="mt-4 font-semibold text-lg">Product 2</h3>
                    <p class="text-gray-500">$39.99</p>
                    <button class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">Add to Cart</button>
                </div>
            </div>

            <!-- Repeat for other slides -->
            <div class="swiper-slide">
                <div class="bg-white rounded-lg shadow p-4 w-[250px] mx-auto">
                    <img src="https://cdn.pixabay.com/photo/2015/04/23/22/00/new-year-background-736885_1280.jpg" class="w-full h-40 object-cover rounded" />
                    <h3 class="mt-4 font-semibold text-lg">Product 2</h3>
                    <p class="text-gray-500">$39.99</p>
                    <button class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">Add to Cart</button>
                </div>
            </div>

            <!-- Repeat for other slides -->
            <div class="swiper-slide">
                <div class="bg-white  rounded-lg shadow p-4 w-[250px] mx-auto">
                    <img src="https://cdn.pixabay.com/photo/2015/04/23/22/00/new-year-background-736885_1280.jpg" class="w-full h-40 object-cover rounded" />
                    <h3 class="mt-4 font-semibold text-lg">Product 2</h3>
                    <p class="text-gray-500">$39.99</p>
                    <button class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">Add to Cart</button>
                </div>
            </div>

            <!-- Repeat for other slides -->
            <div class="swiper-slide">
                <div class="bg-white  rounded-lg shadow p-4 w-[250px] mx-auto">
                    <img src="https://cdn.pixabay.com/photo/2015/04/23/22/00/new-year-background-736885_1280.jpg" class="w-full h-40 object-cover rounded" />
                    <h3 class="mt-4 font-semibold text-lg">Product 2</h3>
                    <p class="text-gray-500">$39.99</p>
                    <button class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">Add to Cart</button>
                </div>
            </div>

            <!-- Add more .swiper-slide as needed -->
        </div>

        <!-- Navigation -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>

        <!-- Pagination (optional) -->
        <div class="swiper-pagination mt-4"></div>
    </div>
</div><script>
    new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev"
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        autoplay: {
            delay: 5000,
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
            1280: {
                slidesPerView: 4,
            }
        }
    });
</script>
