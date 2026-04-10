@if (!empty($reviews))
    @foreach($reviews as $review)
        <div class="review-item flex">
            <div class="image-holder mr-2">
                <img src="/images/review-image1.jpg" alt="review"
                     class="w-12 h-12 rounded-lg object-cover">
            </div>
            <div class="review-content">
                <div class="rating text-primary flex">
                    <svg class="w-4 h-4 fill-current {{ $review->rating >= 1 ? 'text-yellow-500' : '' }}">
                        <use xlink:href="#star-fill"></use>
                    </svg>
                    <svg class="w-4 h-4 fill-current {{ $review->rating >= 2 ? 'text-yellow-500' : '' }}">
                        <use xlink:href="#star-fill"></use>
                    </svg>
                    <svg class="w-4 h-4 fill-current {{ $review->rating >= 3 ? 'text-yellow-500' : '' }}">
                        <use xlink:href="#star-fill"></use>
                    </svg>
                    <svg class="w-4 h-4 fill-current {{ $review->rating >= 4 ? 'text-yellow-500' : '' }}">
                        <use xlink:href="#star-fill"></use>
                    </svg>
                    <svg class="w-4 h-4 fill-current {{ $review->rating >= 5 ? 'text-yellow-500' : '' }}">
                        <use xlink:href="#star-fill"></use>
                    </svg>
                </div>
                <div class="review-header">
                    <span class="author-name font-medium">{{ $review->user->first_name ?? '' }} {{ $review->user->last_name ?? '' }}</span>

                    <span class="review-date text-gray-500">- {{ date('Y-m-d H:i:s',strtotime($review->created_at)) }}</span>
                </div>
                <p class="mt-1">{{ $review->comment }}</p>
            </div>
        </div>
    @endforeach
@else
    <span>Not review found</span>
@endif