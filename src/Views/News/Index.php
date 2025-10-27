<section class="bg-indigo-100 py-12">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-8 items-center">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSCZlf5lc5tX-0gY-y94pGS0mQdL-D0lCH2OQ&s" alt="Featured" class="rounded-lg shadow-lg" />
            <div>
                <h2 class="text-3xl font-bold text-indigo-800 mb-4">Big Summer Sale Coming Soon!</h2>
                <p class="text-lg text-gray-700 mb-6">We're getting ready to launch our biggest summer sale yet — up to 50% off on top brands. Stay tuned for exclusive updates and sneak peeks.</p>
                <a href="#" class="inline-block px-5 py-3 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">Read More</a>
            </div>
        </div>
    </div>
</section>

<!-- News Grid -->
<section class="py-16 mt-5">
    <div class="max-w-7xl mx-auto px-4">
        <h3 class="text-2xl font-semibold mb-8">Latest News</h3>
        <div class="grid md:grid-cols-3 gap-8">
            <!-- News Card -->

            @foreach($news as $new) 
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ public_path('uploads/news/'.$new->image_url) }}" alt="" class="w-full">
                    <div class="p-4">
                        <h4 class="font-bold text-lg mb-2">{{ $new->title }}</h4>
                        <p class="text-sm text-gray-600 mb-3 truncate">{{ $new->content }}.</p>
                        <a href="/news/{{ $new->slug }}" class="text-indigo-600 hover:underline text-sm font-medium">Read more →</a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>