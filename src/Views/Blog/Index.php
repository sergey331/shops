@include('Component.broadCast')
<div id="blog" class="py-28">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row-reverse gap-8">
            <!-- Main Content -->
            <main class="w-full md:w-3/4 mb-8 md:mb-0">
                <!-- Filter/Sort Section -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                    <div class="showing-product">
                        <p class="text-gray-600">Showing 1-9 of 55 results</p>
                    </div>
                    <div class="sort-by">
                        <select id="sorting"
                                class="border border-gray-300 rounded-md py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Latest to oldest</option>
                            <option value="">Oldest to latest</option>
                            <option value="">Popular</option>
                            <option value="">Name (A - Z)</option>
                            <option value="">Name (Z - A)</option>
                            <option value="">Model (A - Z)</option>
                            <option value="">Model (Z - A)</option>
                        </select>
                    </div>
                </div>

                <!-- Blog Posts Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($posts as $post)
                    <div class="posts mb-2">
                        <img src="/uploads/posts/{{ $post->image }}" alt="post image" class="w-full rounded-lg mb-4 h-[200px] object-cover">
                        <a href="/blog/{{ $post->id }}" class="text-primary text-sm">{{ $post->category->name }}</a>
                        <h4 class="text-xl font-semibold my-2 text-gray-900 capitalize">
                            <a href="/blog/{{ $post->id }}" class="hover:text-primary ">{{ $post->title }}</a>
                        </h4>
                        <p class="text-gray-600 mb-2">
                            {{ $post->content }}
                            <a href="/blog/{{ $post->id }}" class="underline text-gray-500 hover:text-gray-700">Read More</a>
                        </p>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <nav class="pt-12" aria-label="Page navigation">
                    <ul class="flex justify-center items-center gap-4">
                        <li class="disabled">
                            <span class="text-gray-400 cursor-not-allowed">Prev</span>
                        </li>
                        <li class="active" aria-current="page">
                            <span class="bg-primary text-white px-3 py-1 rounded-md">1</span>
                        </li>
                        <li>
                            <a href="#" class="text-gray-700 hover:text-primary px-3 py-1">2</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-700 hover:text-primary px-3 py-1">3</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-700 hover:text-primary px-3 py-1">Next</a>
                        </li>
                    </ul>
                </nav>
            </main>

            <!-- Sidebar -->
            <aside class="w-full md:w-1/4">
                <div class="sidebar space-y-10">
                    <!-- Search Widget -->
                    <div class="widget-menu">
                        <form class="flex border rounded-lg p-2 bg-white">
                            <input class="flex-grow border-0 px-3 py-2 focus:ring-0 focus:outline-none" type="search"
                                   placeholder="Search" aria-label="Search">
                            <button class="bg-primary rounded-lg p-2 flex items-center justify-center transition" type="submit">
                                <svg class="text-white w-5 h-5" fill="currentColor">
                                    <use xlink:href="#search"></use>
                                </svg>
                            </button>
                        </form>
                    </div>

                    <!-- Categories Widget -->
                    <div class="widget-product-categories pt-4">
                        <div class="mb-4">
                            <h3 class="text-xl font-semibold mb-0">Categories</h3>
                        </div>
                        <ul class="space-y-2">
                            <li class="cat-item">
                                <a href="/collections/categories" class="text-gray-600 hover:text-primary">All</a>
                            </li>
                            <li class="cat-item">
                                <a href="#" class="text-gray-600 hover:text-primary">Phones</a>
                            </li>
                            <li class="cat-item">
                                <a href="#" class="text-gray-600 hover:text-primary">Accessories</a>
                            </li>
                            <li class="cat-item">
                                <a href="#" class="text-gray-600 hover:text-primary">Tablets</a>
                            </li>
                            <li class="cat-item">
                                <a href="#" class="text-gray-600 hover:text-primary">Watches</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Tags Widget -->
                    <div class="widget-product-tags pt-4">
                        <div class="mb-4">
                            <h3 class="text-xl font-semibold mb-0">Tags</h3>
                        </div>
                        <ul class="space-y-2">
                            <li class="tags-item">
                                <a href="#" class="text-gray-600 hover:text-primary">White</a>
                            </li>
                            <li class="tags-item">
                                <a href="#" class="text-gray-600 hover:text-primary">Cheap</a>
                            </li>
                            <li class="tags-item">
                                <a href="#" class="text-gray-600 hover:text-primary">Mobile</a>
                            </li>
                            <li class="tags-item">
                                <a href="#" class="text-gray-600 hover:text-primary">Modern</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Social Links Widget -->
                    <div class="widget-social-links pt-4">
                        <div class="mb-4">
                            <h3 class="text-xl font-semibold mb-0">Social Links</h3>
                        </div>
                        <ul class="space-y-2">
                            <li class="links">
                                <a href="#" class="text-gray-600 hover:text-primary">Facebook</a>
                            </li>
                            <li class="links">
                                <a href="#" class="text-gray-600 hover:text-primary">Instagram</a>
                            </li>
                            <li class="links">
                                <a href="#" class="text-gray-600 hover:text-primary">Twitter</a>
                            </li>
                            <li class="links">
                                <a href="#" class="text-gray-600 hover:text-primary">Youtube</a>
                            </li>
                            <li class="links">
                                <a href="#" class="text-gray-600 hover:text-primary">Pinterest</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>
@include('Component.Home.instagram')