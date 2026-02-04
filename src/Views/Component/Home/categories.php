<section id="categories" class="py-28 pt-0">
    <div class="container mx-auto px-4">
        <div class="section-title overflow-hidden mb-6">
            <h3 class="text-4xl font-semibold flex items-center">Categories</h3>
        </div>
        <div class="swiper category-swiper w-full h-full">
            <div class="swiper-wrapper flex items-center md:mx-32">
                @foreach($categories as $category)
                    <div class="swiper-slide content-center">
                        <div class="w-full shadow">
                            <div class="card mb-4 border-0 rounded-lg relative">
                                <a href="/shop?categories[]={{ $category->id }}" class="block">
                                    <img src="/images/categories/{{$category->logo}}" class="w-full rounded-lg h-[200px]" style="object-fit: contain" alt="cart item">
                                    <h6 class="absolute bottom-0 bg-primary m-4 py-2 px-3 rounded-lg">
                                        <a href="/shop" class="text-white">{{ $category->name }}</a>
                                    </h6>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>