@include('Component.broadCast')
<section id="about-us" class="py-28">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center">
            <div class="w-full md:w-1/2">
                <div class="video-content">
                    <div class="video-bg relative">
                        <img src="/images/single-image-about.jpg" alt="video" class="w-full">
                        <div class="player absolute flex justify-center items-center inset-0 ">
                            <a class="youtube play-btn flex justify-center items-center hover:scale-110 transition-transform"
                               href="https://www.youtube.com/embed/ICzsGD7FPpk?si=Gei-rb0DY8gWq2ti">
                                <svg class="play text-dark w-20 h-20 bg-white p-6 rounded-full">
                                    <use xlink:href="#play"></use>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/2">
                <div class="detail md:pl-12 mt-12 lg:mt-0">
                    <div class="display-header">
                        <h3 class="text-4xl font-semibold mb-4">Best Bookstore of all time</h3>
                        <p class="pb-4">Risus augue curabitur diam senectus congue velit et. Sed vitae metus nibh sit
                            era. Nulla
                            adipiscing pharetra pellentesque maecenas odio eros at. Et libero vulputate amet duis erat
                            volutpat
                            vitae eget. Sed vitae metus nibh sit era. Nulla adipiscing pharetra eros at.</p>
                        <p class="pb-4">Nulla adipiscing pharetra pellentesque maecenas odio eros at. Et libero
                            vulputate amet
                            duis erat volutpat vitae eget. Quam libero etiam et in ac at quis. Risus augue curabitur
                            diam senectus
                            congue velit et.</p>
                        <p class="pb-4">Risus augue curabitur diam senectus congue velit et. Sed vitae metus nibh sit
                            era. Nulla
                            adipiscing pharetra pellentesque maecenas odio eros at. Et libero vulputate amet duis erat
                            volutpat
                            vitae eget. Sed vitae metus nibh sit era. Nulla adipiscing pharetra eros at.</p>
                        <p class="pb-4">Nulla adipiscing pharetra pellentesque maecenas odio eros at. Et libero
                            vulputate amet
                            duis erat volutpat vitae eget. Quam libero etiam et in ac at quis. Risus augue curabitur
                            diam senectus
                            congue velit et.</p>
                        <a href="shop.html"
                           class="btn mt-6 inline-block px-6 py-3 bg-primary text-white rounded-md transition">
                            Go to shop
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div style="margin-bottom: 50px">
    @include('Component.Home.company_services')
</div>

<div style="margin-bottom: 50px">
    @include('Component.Home.customers_reviews')
</div>

@include('Component.Home.instagram')