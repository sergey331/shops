<header id="header" class="site-header"

        x-data="{ mobileMenuOpen: false, userModalOpen: false, pagesDropdownOpen: false, activeTab: 'signin' }">
    <!-- Top Info Bar -->
    <div class="top-info border-b hidden md:block">
        <div class="container mx-auto">
            <div class="flex flex-wrap">
                <div class="md:w-1/3 w-full">
                    <p class="text-sm my-2 text-center">Need any help? Call us <a href="#"
                                                                                  class="hover:text-primary">
                                                                                {{ setting()->phone ?? '' }}</a></p>
                </div>
                <div class="md:w-1/3 w-full border-l border-r">
                    <p class="text-sm my-2 text-center">Summer sale discount off 60% off! <a
                            class="underline hover:text-primary" href="/shop">Shop Now</a></p>
                </div>
                <div class="md:w-1/3 w-full">
                    <p class="text-sm my-2 text-center">2-3 business days delivery & free returns</p>
                </div>
            </div>
        </div>
    </div>

    @include('Component.Layout.menu')


</header>