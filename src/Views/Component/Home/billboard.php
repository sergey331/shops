<section id="billboard"
         class="relative flex items-center py-12 bg-gray-100 bg-banner bg-cover bg-no-repeat bg-center " style="margin-bottom: 50px;">

    <!-- Next Button -->
    <div class="absolute right-0 pe-0 xl:pe-5 me-0 xl:me-5 swiper-next main-slider-button-next z-10">
        <svg class="chevron-forward-circle flex justify-center items-center p-2 w-20 h-20">
            <use xlink:href="#alt-arrow-right-outline"></use>
        </svg>
    </div>

    <!-- Prev Button -->
    <div class="absolute left-0 ps-0 xl:ps-5 ms-0 xl:ms-5 swiper-prev main-slider-button-prev z-10">
        <svg class="chevron-back-circle flex justify-center items-center p-2 w-20 h-20">
            <use xlink:href="#alt-arrow-left-outline"></use>
        </svg>
    </div>

    <!-- Swiper Container -->
    <div class="swiper main-swiper w-full h-full">
        <div class="swiper-wrapper flex items-center md:mx-32">
            @foreach($sliders as $slider)
            <div class="swiper-slide content-center">
                <div class="container mx-auto px-4">
                    <div class="flex flex-col-reverse md:flex-row items-center">
                        <div class="md:w-6/12 md:ml-8 mt-10 md:mt-0 text-center md:text-left">
                            <div class="banner-content">
                                <h2 class="text-4xl md:text-6xl font-semibold mb-4">{{ $slider->title }}</h2>
                                <p class="text-xl mb-6">{{ $slider->content }}</p>
                                <a href="/shop"
                                   class="btn inline-block px-8 py-3 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
                                    Shop Collection
                                </a>
                            </div>
                        </div>
                        <div class="md:w-5/12 text-center">
                            <div class="image-holder">
                                <img src="/uploads/sliders/{{ $slider->image_url }}" class="w-full max-w-md mx-auto" alt="banner">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>