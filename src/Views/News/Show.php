
<section class="p-16  mt-5 mb-5">
    <div class="max-w-7xl mx-auto px-4">
        <h3 class="text-2xl font-semibold mb-8">{{ $new->title }}</h3>
        <div class="">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ public_path('uploads/news/'.$new->image_url) }}" alt="" class="w-full">
                <div class="p-4">
                    <p class="text-sm text-gray-600 mb-3">{{ $new->content }}.</p>
                </div>
            </div>
        </div>
    </div>
</section>