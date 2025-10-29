<nav id="header-nav" class="py-6">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <a class="navbar-brand" href="/">
                <img src="/images/main-logo.png" class="logo h-10">
            </a>

            <!-- Mobile Menu Button -->
            <button class="md:hidden p-2" type="button" @click="mobileMenuOpen = !mobileMenuOpen">
                <svg class="w-6 h-6">
                    <use xlink:href="#navbar-icon"></use>
                </svg>
            </button>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center">
                <ul class="flex space-x-6 uppercase">
                    <li><a class="text-dark hover:text-primary font-heading font-medium active" href="/">Home</a></li>
                    <li><a class="text-dark hover:text-primary font-heading font-medium" href="/about">About</a></li>
                    <li><a class="text-dark hover:text-primary font-heading font-medium" href="/shop">Shop</a></li>
                    <li><a class="text-dark hover:text-primary font-heading font-medium" href="/blog">Blogs</a></li>
                    <li><a class="text-dark hover:text-primary font-heading font-medium" href="/contact">Contact</a></li>
                </ul>
            </div>

            <!-- User Actions -->
            <div class="hidden md:flex items-center space-x-6">
                <!-- Search -->
                <a href="#" class="search-button text-dark hover:text-primary">
                    <svg class="w-5 h-5">
                        <use xlink:href="#search"></use>
                    </svg>
                </a>

                <!-- User Modal -->
                <a href="#" @click="userModalOpen = true" class="text-dark hover:text-primary">
                    <svg class="w-5 h-5">
                        <use xlink:href="#user"></use>
                    </svg>
                </a>

                <!-- Wishlist Dropdown -->
                <div class="relative group">
                    <a href="#" class="text-dark hover:text-primary flex items-center">
                        <svg class="w-5 h-5">
                            <use xlink:href="#heart"></use>
                        </svg>
                        <span class="text-xs ml-1">(2)</span>
                    </a>
                    <div class="absolute right-0 w-72 bg-white shadow-lg rounded-md p-4 z-50 hidden group-hover:block">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-primary font-medium">Your wishlist</span>
                            <span class="bg-primary text-white text-xs px-2 py-1 rounded-full">2</span>
                        </div>
                        <ul class="space-y-4 mb-4">
                            <li class="flex justify-between">
                                <div>
                                    <h5 class="font-medium"><a href="single-product.html" class="hover:text-primary">The Emerald
                                            Crown</a></h5>
                                    <p class="text-xs text-gray-500">Special discounted price.</p>
                                    <a href="#" class="text-sm font-medium text-primary hover:underline block mt-1">Add to cart</a>
                                </div>
                                <span class="text-primary">$2000</span>
                            </li>
                            <li class="flex justify-between">
                                <div>
                                    <h5 class="font-medium"><a href="single-product.html" class="hover:text-primary">The Last
                                            Enchantment</a></h5>
                                    <p class="text-xs text-gray-500">Perfect for enlightened people.</p>
                                    <a href="#" class="text-sm font-medium text-primary hover:underline block mt-1">Add to cart</a>
                                </div>
                                <span class="text-primary">$400</span>
                            </li>
                            <li class="flex justify-between border-t pt-2">
                                <span class="font-bold">Total (USD)</span>
                                <strong>$2400</strong>
                            </li>
                        </ul>
                        <div class="space-y-2">
                            <a href="#" class="block w-full bg-dark text-white py-2 text-center rounded hover:bg-opacity-90">Add
                                all to cart</a>
                            <a href="/cart"
                               class="block w-full bg-primary text-white py-2 text-center rounded hover:bg-opacity-90">View
                                cart</a>
                        </div>
                    </div>
                </div>

                <!-- Cart Dropdown -->
                <div class="relative group">
                    <a href="/cart" class="text-dark hover:text-primary flex items-center">
                        <svg class="w-5 h-5">
                            <use xlink:href="#cart"></use>
                        </svg>
                        <span class="text-xs ml-1">(2)</span>
                    </a>
                    <div class="absolute right-0 w-72 bg-white shadow-lg rounded-md p-4 z-50 hidden group-hover:block">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-primary font-medium">Your cart</span>
                            <span class="bg-primary text-white text-xs px-2 py-1 rounded-full">2</span>
                        </div>
                        <ul class="space-y-4 mb-4">
                            <li class="flex justify-between">
                                <div>
                                    <h5 class="font-medium"><a href="single-product.html" class="hover:text-primary">Secrets of the
                                            Alchemist</a></h5>
                                    <p class="text-xs text-gray-500">High quality in good price.</p>
                                </div>
                                <span class="text-primary">$870</span>
                            </li>
                            <li class="flex justify-between">
                                <div>
                                    <h5 class="font-medium"><a href="single-product.html" class="hover:text-primary">Quest for the
                                            Lost City</a></h5>
                                    <p class="text-xs text-gray-500">Professional Quest for the Lost City.</p>
                                </div>
                                <span class="text-primary">$600</span>
                            </li>
                            <li class="flex justify-between border-t pt-2">
                                <span class="font-bold">Total (USD)</span>
                                <strong>$1470</strong>
                            </li>
                        </ul>
                        <div class="space-y-2">
                            <a href="/cart"
                               class="block w-full bg-dark text-white py-2 text-center rounded hover:bg-opacity-90">View Cart</a>
                            <a href="/checkout"
                               class="block w-full bg-primary text-white py-2 text-center rounded hover:bg-opacity-90">Go to
                                checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu (Offcanvas) -->
    <div
        class="fixed block md:hidden inset-y-0 right-0 w-full max-w-xs bg-white shadow-lg transform transition-transform duration-300 ease-in-out z-50"
        :class="{'translate-x-0': mobileMenuOpen, 'translate-x-full': !mobileMenuOpen}">
        <div class="flex justify-between items-center p-4 border-b">
            <a href="/">
                <img src="/images/main-logo.png" class="h-8">
            </a>
            <button @click="mobileMenuOpen = false" class="p-2">
                <svg class="w-6 h-6">
                    <use xlink:href="#close"></use>
                </svg>
            </button>
        </div>

        <div class="p-4 overflow-y-auto">
            <ul class="space-y-4 uppercase">
                <li><a class="block py-1 text-dark hover:text-primary" href="/">Home</a></li>
                <li><a class="block py-1 text-dark hover:text-primary" href="/about">About</a></li>
                <li><a class="block py-1 text-dark hover:text-primary" href="/shop">Shop</a></li>
                <li><a class="block py-1 text-dark hover:text-primary" href="/blog">Blogs</a></li>
                <li><a class="block py-1 text-dark hover:text-primary" href="/contact">Contact</a></li>
            </ul>

            <!-- Mobile User Actions -->
            <div class="mt-8 flex justify-around">
                <a href="#" class="search-button text-dark hover:text-primary">
                    <svg class="w-6 h-6">
                        <use xlink:href="#search"></use>
                    </svg>
                </a>
                <a href="#" @click="userModalOpen = true" class="text-dark hover:text-primary">
                    <svg class="w-6 h-6">
                        <use xlink:href="#user"></use>
                    </svg>
                </a>
                <a href="#" class="text-dark hover:text-primary">
                    <svg class="w-6 h-6">
                        <use xlink:href="#heart"></use>
                    </svg>
                </a>
                <a href="/cart" class="text-dark hover:text-primary">
                    <svg class="w-6 h-6">
                        <use xlink:href="#cart"></use>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- User Modal -->
    @include('Component.Modal.UserModal')
</nav>