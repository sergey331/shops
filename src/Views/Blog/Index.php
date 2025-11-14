{!!
use Kernel\Model\Paginator;
!!}
@include('Component.broadCast')
<div id="blog" class="py-28">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row-reverse gap-8">
            <!-- Main Content -->
            <main class="w-full md:w-3/4 mb-8 md:mb-0">
                <!-- Filter/Sort Section -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                    <div class="showing-product">
                        <p class="text-gray-600">Showing {{ $posts->total_data }} of {{ $posts->total }} results</p>
                    </div>
                </div>

                <!-- Blog Posts Grid -->
                @count($posts->data)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($posts->data as $post)
                    <div class="posts mb-2">
                        <img src="/uploads/posts/{{ $post->image }}" alt="post image"
                             class="w-full rounded-lg mb-4 h-[200px] object-cover">
                        <a href="/blog/{{ $post->id }}" class="text-primary text-sm">{{ $post->category->name }}</a>
                        <h4 class="text-xl font-semibold my-2 text-gray-900 capitalize">
                            <a href="/blog/{{ $post->id }}" class="hover:text-primary ">{{ $post->title }}</a>
                        </h4>
                        <p class="text-gray-600 mb-2">
                            {{ $post->content }}
                            <a href="/blog/{{ $post->id }}" class="underline text-gray-500 hover:text-gray-700">Read
                                More</a>
                        </p>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-4xl text-gray-400 text-center">Not data found</p>
                @endcount
                <!-- Pagination -->
                {{ Paginator::html($posts) }}
            </main>

            <!-- Sidebar -->
            <aside class="w-full md:w-1/4">
                <form action="/blog" method="get"  id="searchForm" class="sidebar space-y-10">
                    <!-- Search Widget -->
                    <div class="widget-menu">
                        <div class="flex border rounded-lg p-2 bg-white">
                            <input class="flex-grow border-0 px-3 py-2 focus:ring-0 focus:outline-none" name="search" id="search" type="search"
                                   placeholder="Search" aria-label="Search"
                                   value="{{ $filteredData['search'] ?? ''}}"
                            >
                            <div class="bg-primary rounded-lg p-2 flex items-center justify-center transition">
                                <svg class="text-white w-5 h-5" fill="currentColor">
                                    <use xlink:href="#search"></use>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div id="accordion-collapse" data-accordion="collapse" class="rounded-base border border-default overflow-hidden shadow-xs">
                        <h2 id="accordion-collapse-heading-1">
                            <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-body rounded-t-base border border-t-0 border-x-0 border-b-default hover:text-heading hover:bg-neutral-secondary-medium gap-3" data-accordion-target="#accordion-collapse-body-1" aria-expanded="false" aria-controls="accordion-collapse-body-1">
                                <span class="text-xl font-semibold mb-0">Categories</span>
                                <svg data-accordion-icon class="w-5 h-5 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 15 7-7 7 7"/></svg>
                            </button>
                        </h2>
                        <div id="accordion-collapse-body-1" class="hidden border border-s-0 border-e-0 border-t-0 border-b-default" aria-labelledby="accordion-collapse-heading-1">
                            <div class="p-4 md:p-5">
                                <ul class="space-y-2">
                                    @foreach($categories as $category)
                                    <li class="cat-item">
                                        <label for="category_{{$category->id}}"
                                               class="text-gray-600 hover:text-primary"
                                               @if(isset($filteredData['category_id']) && $filteredData['category_id'] == $category->id) style="color:#dc2626" @endif
                                        >
                                        <input
                                                type="checkbox"
                                                @if(isset($filteredData['category_id']) && $filteredData['category_id'] == $category->id) checked @endif
                                        class="categories hidden"
                                        id="category_{{$category->id}}"
                                        name="category_id"
                                        value="{{$category->id}}"
                                        />
                                        {{ $category->name }}
                                        </label>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <h2 id="accordion-collapse-heading-2">
                            <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-body border border-x-0 border-b-default border-t-0 hover:text-heading hover:bg-neutral-secondary-medium gap-3" data-accordion-target="#accordion-collapse-body-2" aria-expanded="false" aria-controls="accordion-collapse-body-2">
                                <span class="text-xl font-semibold mb-0">Tags</span>
                                <svg data-accordion-icon class="w-5 h-5 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 15 7-7 7 7"/></svg>
                            </button>
                        </h2>
                        <div id="accordion-collapse-body-2" class="hidden border border-s-0 border-e-0 border-t-0 border-b-default" aria-labelledby="accordion-collapse-heading-2">
                            <div class="p-4 md:p-5">
                                <ul class="space-y-2">
                                    @foreach($tags as $tag)
                                    <li class="cat-item">
                                        <label
                                                for="tag_{{ $tag->id }}"
                                                class="text-gray-600 hover:text-primary"
                                                @if(isset($filteredData['tags_id']) && in_array($tag->id,$filteredData['tags_id'])) style="color:#dc2626" @endif
                                        >
                                        <input
                                                type="checkbox"
                                                id="tag_{{ $tag->id }}"
                                                value="{{ $tag->id }}"
                                                class="tags hidden"
                                                @if(isset($filteredData['tags_id']) && in_array($tag->id,$filteredData['tags_id'])) checked @endif
                                        name="tags_id[]"
                                        >
                                        {{ $tag->name }}
                                        </label>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <button type="submit" style="display:none;"></button>
                </form>
            </aside>
        </div>
    </div>
</div>

<script  src="/assets/js/postSearch.js" type="application/javascript">

</script>
@include('Component.Home.instagram')