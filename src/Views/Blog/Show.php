@include('Component.broadCast')

<div id="singlepost" class="py-28">
    <div class="container mx-auto px-4">
        <div class="flex justify-center flex-wrap -mx-4">
            <article class="mb-12">
                <h3 class="text-3xl md:text-5xl font-bold mb-6">{{ $post->title }}</h3>
                <div class="hero-image mb-6">
                    <img src="/uploads/posts/{{ $post->image }}" alt="single-post" class="w-full h-auto">
                </div>

                <div class="post-content py-8">
                    <div class="post-description space-y-6">
                        <p>
                            {{ $post->content }}
                        </p>

                        <div class="flex flex-col md:flex-row justify-between my-8 gap-4">
                            <div class="block-tag">
                                <ul class="flex flex-wrap gap-3">
                                    @foreach($post->tags as $tag)
                                        <li>
                                            <a href="#" class="underline hover:no-underline">{{ $tag->name }}</a>
                                        </li>
                                   @endforeach
                                </ul>
                            </div>

                            <div class="flex items-center">
                                <div class="uppercase pe-4 font-medium">Share:</div>
                                <ul class="flex gap-4">
                                    <li>
                                        <a href="#">
                                            <svg width="16" height="16" class="text-gray-600 hover:text-blue-500">
                                                <use xlink:href="#facebook"></use>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <svg width="16" height="16" class="text-gray-600 hover:text-blue-400">
                                                <use xlink:href="#twitter"></use>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <svg width="16" height="16" class="text-gray-600 hover:text-blue-700">
                                                <use xlink:href="#linkedin"></use>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <svg width="16" height="16" class="text-gray-600 hover:text-pink-500">
                                                <use xlink:href="#instagram"></use>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <svg width="16" height="16" class="text-gray-600 hover:text-red-600">
                                                <use xlink:href="#youtube"></use>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row justify-between gap-4 mt-12">
                        <a class="font-bold underline uppercase hover:no-underline" href="#">
                            How to make your blog post
                        </a>
                        <a class="font-bold underline uppercase hover:no-underline" href="#">
                            tips for product design
                        </a>
                    </div>
                </div>
            </article>

            <section class="w-full lg:w-10/12 mt-8">
                <h3 class="text-2xl font-bold mb-6"><span>3</span> Comments</h3>

                <div class="space-y-8">
                    <article class="flex flex-col md:flex-row gap-6 pb-6">
                        <div class="w-full md:w-1/6">
                            <img src="/images/commentor-item1.jpg" alt="default" class="rounded-full">
                        </div>
                        <div class="w-full md:w-5/6">
                            <div class="mb-4">
                                <div class="flex gap-3 uppercase font-medium">
                                    <div>Lufy carlson</div>
                                    <span class="text-gray-500">Jul 10</span>
                                </div>
                                <p class="mt-2">Tristique tempis condimentum diam done ullancomroer sit element
                                    henddg sit he consequert.Tristique tempis condimentum diam done ullancomroer
                                    sit element henddg sit he consequert.</p>
                                <a href="#" class="inline-block mt-3 hover:underline">Reply</a>
                            </div>
                        </div>
                    </article>

                    <article class="flex flex-col md:flex-row gap-6 pb-6 ml-0 md:ml-12">
                        <div class="w-full md:w-1/6">
                            <img src="/images/commentor-item2.jpg" alt="default" class="rounded-full">
                        </div>
                        <div class="w-full md:w-5/6">
                            <div class="mb-4">
                                <div class="flex gap-3 uppercase font-medium">
                                    <div>Lora leigh</div>
                                    <span class="text-gray-500">Jul 10</span>
                                </div>
                                <p class="mt-2">Tristique tempis condimentum diam done ullancomroer sit element
                                    henddg sit he consequert.Tristique tempis condimentum diam done ullancomroer
                                    sit element henddg sit he consequert.</p>
                                <a href="#" class="inline-block mt-3 hover:underline">Reply</a>
                            </div>
                        </div>
                    </article>

                    <article class="flex flex-col md:flex-row gap-6 pb-6">
                        <div class="w-full md:w-1/6">
                            <img src="/images/commentor-item3.jpg" alt="default" class="rounded-full">
                        </div>
                        <div class="w-full md:w-5/6">
                            <div class="mb-4">
                                <div class="flex gap-3 uppercase font-medium">
                                    <div>Lufy carlson</div>
                                    <span class="text-gray-500">Jul 10</span>
                                </div>
                                <p class="mt-2">Tristique tempis condimentum diam done ullancomroer sit element
                                    henddg sit he consequert.Tristique tempis condimentum diam done ullancomroer
                                    sit element henddg sit he consequert.</p>
                                <a href="#" class="inline-block mt-3 hover:underline">Reply</a>
                            </div>
                        </div>
                    </article>
                </div>

                <div class="mt-12">
                    <h3 class="text-2xl font-bold mb-4">Leave a Comment</h3>
                    <p class="mb-6 text-gray-600">Your email address will not be published. Required fields are
                        marked *</p>

                    <form class="space-y-4">
                        <div>
                <textarea
                        class="w-full px-4 py-2 border border-gray-300 focus:border-gray-800 focus:outline-none focus:ring-0"
                        placeholder="Write your comment here *"></textarea>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <input
                                    class="w-full px-4 py-2 border border-gray-300 focus:border-gray-800 focus:outline-none focus:ring-0"
                                    type="text" placeholder="Write your full name here *">
                            <input
                                    class="w-full px-4 py-2 border border-gray-300 focus:border-gray-800 focus:outline-none focus:ring-0"
                                    type="email" placeholder="Write your e-mail address *">
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" class="mr-2">
                            <span>Save my name, email, and website in this browser for the next time.</span>
                        </div>
                        <button class="bg-primary text-white px-6 py-3 mt-4" type="submit">Post Comment</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
@include('Component.Home.instagram')