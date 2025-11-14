@include('Component.broadCast')
{!! $errors = $session->getCLean('errors') ?? []; !!}
<div id="singlepost" class="py-28">
    <div class="container mx-auto px-4">
        <div class="flex justify-center flex-wrap -mx-4">
            <article class="mb-12">
                <h3 class="text-3xl md:text-5xl font-bold mb-6">{{ $post->title }}</h3>
                <div class="hero-image mb-6">
                    <img src="/uploads/posts/{{ $post->image }}" alt="single-post" class="w-full h-auto max-h-[500px]">
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
                <h3 class="text-2xl font-bold mb-6"><span>{{ count($post->comments) }}</span> Comments</h3>

                <div class="space-y-8">
                    @foreach($post->comments as $comment)
                    <article class="flex flex-col md:flex-row gap-6 pb-6">
                        <div class="w-full md:w-1/6">
                            @if($comment->user->avatar)
                            <img src="/uploads/users/{{ $comment->user->avatar }}" alt="default" class="rounded-full">
                            @else
                            <img src="/images/commentor-item1.jpg" alt="default" class="rounded-full">
                            @endif
                        </div>
                        <div class="w-full md:w-5/6">
                            <div class="mb-4">
                                <div class="flex gap-3 uppercase font-medium">
                                    <div>{{ $comment->user->username }}</div>
                                    <span class="text-gray-500">{{ date('Y-m-d H:i:s',strtotime($comment->created_at)) }}</span>
                                </div>
                                <p class="mt-2">{{ $comment->comment }}</p>
                                <a href="#" class="inline-block mt-3 hover:underline">Reply</a>
                            </div>
                        </div>
                    </article>

                        @count($comment->children)
                            @foreach($comment->children as $children)
                                <article class="flex flex-col md:flex-row gap-2 pb-6 ml-[80px]">
                                    <div class="w-full md:w-1/6">
                                        @if($children->user->avatar)
                                        <img src="/uploads/users/{{ $children->user->avatar }}" alt="default" class="rounded-full">
                                        @else
                                        <img src="/images/commentor-item1.jpg" alt="default" class="rounded-full">
                                        @endif
                                    </div>
                                    <div class="w-full md:w-5/6">
                                        <div class="mb-4">
                                            <div class="flex gap-3 uppercase font-medium">
                                                <div>{{ $children->user->username }}</div>
                                                <span class="text-gray-500">{{ date('Y-m-d H:i:s',strtotime($children->created_at)) }}</span>
                                            </div>
                                            <p class="mt-2">{{ $children->comment }}</p>
                                            <a href="#" class="inline-block mt-3 hover:underline">Reply</a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        @endcount
                    @endforeach
                </div>

                <div class="mt-12">
                    <h3 class="text-2xl font-bold mb-4">Leave a Comment</h3>
                    @auth
                    <form class="space-y-4" method="post" action="/blog/comment/{{ $post->id }}">
                        <div>
                            <textarea
                                    name="comment"
                        class="w-full px-4 py-2 border border-gray-300 focus:border-gray-800 focus:outline-none focus:ring-0"
                        placeholder="Write your comment here *"></textarea>
                            @isset($errors['comment'])
                                <ul class="errors">
                                    @foreach ($errors['comment'] as $error)
                                        <li style="font-size: 15px;color: #dc3545">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endisset
                        </div>
                        <button class="bg-primary text-white px-6 py-3 mt-4" type="submit">Post Comment</button>
                    </form>
                    @else
                        Please Login for write comment
                    @endauth
                </div>
            </section>
        </div>
    </div>
</div>
@include('Component.Home.instagram')