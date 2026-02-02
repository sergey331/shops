<section id="limited-offer" class="py-28 bg-counter bg-cover bg-no-repeat bg-center flex">
    @foreach ($discounts as $discount)
    <div class="container mx-auto my-2 px-4 h-full">
        <div class="flex flex-col md:flex-row items-center h-full">
            <!-- Image Column -->
            <div class="w-full md:w-1/2 text-center">
                <div class="image-holder">
                    <img src="/images/banner-image3.png" class="w-full max-w-lg mx-auto" alt="Limited time offer">
                </div>
            </div>

            <!-- Content Column -->
            <div class="w-full md:w-5/12 md:ml-8 mt-10 md:mt-0 text-center md:text-left">
                <h2 class="text-4xl md:text-5xl font-bold mb-6">30% Discount on all items. Hurry Up !!!</h2>

                <!-- Countdown Timer -->
                <div id="countdown-clock" class="text-dark flex items-center my-8">
                    <div class="time grid pe-3">
                        <span class="days text-5xl font-normal"></span>
                        <small class="text-lg">Days</small>
                    </div>
                    <span class="text-5xl text-primary mx-1">:</span>
                    <div class="time grid pe-3 ps-3">
                        <span class="hours text-5xl font-normal"></span>
                        <small class="text-lg">Hrs</small>
                    </div>
                    <span class="text-5xl text-primary mx-1">:</span>
                    <div class="time grid pe-3 ps-3">
                        <span class="minutes text-5xl font-normal"></span>
                        <small class="text-lg">Min</small>
                    </div>
                    <span class="text-5xl text-primary mx-1">:</span>
                    <div class="time grid ps-3">
                        <span class="seconds text-5xl font-normal"></span>
                        <small class="text-lg">Sec</small>
                    </div>
                </div>

                <a href="/shop"
                   class="inline-block px-8 py-3 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors mt-6">
                    Shop Collection
                </a>
            </div>
        </div>
    </div>
    @endforeach
</section>