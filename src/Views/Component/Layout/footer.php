<footer id="footer" class="py-28">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap justify-between">
            <div class="w-full lg:w-1/4 sm:w-1/2 pb-6 lg:pb-0">
                <div>
                    <img src="/images/main-logo.png" alt="logo" class="w-auto h-auto mb-2 max-w-full">
                    <p class="mb-4">Nisi, purus vitae, ultrices nunc. Sit ac sit suscipit hendrerit. Gravida massa volutpat
                        aenean odio erat nullam fringilla.</p>
                    <div class="social-links">
                        <ul class="flex space-x-4 list-none">
                            <li>
                                <a href="#">
                                    <svg class="facebook w-6 h-6 text-gray-400 hover:text-primary">
                                        <use xlink:href="#facebook" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <svg class="instagram w-6 h-6 text-gray-400 hover:text-primary">
                                        <use xlink:href="#instagram" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <svg class="twitter w-6 h-6 text-gray-400 hover:text-primary">
                                        <use xlink:href="#twitter" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <svg class="linkedin w-6 h-6 text-gray-400 hover:text-primary">
                                        <use xlink:href="#linkedin" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <svg class="youtube w-6 h-6 text-gray-400 hover:text-primary">
                                        <use xlink:href="#youtube" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-1/6 sm:w-1/2 pb-6 lg:pb-0">
                <div>
                    <h5 class="font-bold pb-2">Quick Links</h5>
                    <ul class="list-none capitalize">
                        <li class="mb-1">
                            <a href="#">Home</a>
                        </li>
                        <li class="mb-1">
                            <a href="#">About</a>
                        </li>
                        <li class="mb-1">
                            <a href="#">Shop</a>
                        </li>
                        <li class="mb-1">
                            <a href="#">Blogs</a>
                        </li>
                        <li class="mb-1">
                            <a href="#">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="w-full lg:w-1/4 sm:w-1/2 pb-6 lg:pb-0">
                <div>
                    <h5 class="font-bold pb-2 capitalize">Help & Info Help</h5>
                    <ul class="list-none">
                        <li class="mb-1">
                            <a href="#">Track Your Order</a>
                        </li>
                        <li class="mb-1">
                            <a href="#">Returns Policies</a>
                        </li>
                        <li class="mb-1">
                            <a href="#">Shipping + Delivery</a>
                        </li>
                        <li class="mb-1">
                            <a href="#">Contact Us</a>
                        </li>
                        <li class="mb-1">
                            <a href="#">Faqs</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="w-full lg:w-1/4 sm:w-1/2 pb-6 lg:pb-0">
                <div>
                    <h5 class="font-bold pb-2 capitalize">Contact Us</h5>
                    <p class="mb-2">Do you have any queries or suggestions? <a href="mailto:"
                                                                               class="underline">{{ setting()->email ?? '' }}</a></p>
                    <p>If you need support? Just give us a call. <a href="#" class="underline">{{ setting()->phone ?? '' }}</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>