<style>
    .sliders {
        width: 100%;
        height: 100%;
    }

    .sliders .swiper-slide {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .sliders-inform {
        text-align: center;
        position: absolute;
        top: 40%;
        left: 10%;
        color: black;
    }
</style>
<div class="max-w-7xl mx-auto px-4 py-10">

    <!-- Swiper Container -->
    <div class="swiper sliders bg-white rounded-lg shadow p-3">
        <div class="swiper-wrapper ">

            @foreach ($sliders as $slider)

            <div class="swiper-slide">
                <div class="relative p-4 w-[250px] mx-auto">
                    @if ($slider->image_url)
                    <img src="/uploads/sliders/{{ $slider->image_url }}" class="w-full h-40 object-cover rounded" alt=""/>
                    @else
                    No Image
                    @endif

                    <div class="sliders-inform">
                        <h3 class="text-lg">{{ $slider->title }}</h3>
                        <p>{{ $slider->content }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<script>
    new Swiper(".sliders", {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        autoplay: {
            delay: 5000,
        },
    })
</script>

