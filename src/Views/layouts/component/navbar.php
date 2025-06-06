<nav class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-4">
            <!-- Logo -->
            <a href="/" class="flex items-center space-x-2">
                <img src="assets/img/logo.png" class="h-10" alt="logo" />
            </a>

            <!-- Desktop menu -->
            <div class="hidden md:flex items-center space-x-6">
                <a href="#" class="text-gray-700 hover:text-blue-600 font-medium">Home</a>
                <a href="#" class="text-gray-700 hover:text-blue-600 font-medium">Deals</a>

                <!-- Mega menu -->
                <button id="megaMenuButton" data-dropdown-toggle="megaMenuDropdown"
                        class="text-gray-700 hover:text-blue-600 font-medium flex items-center">
                    Shop
                    <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M5.23 7.21a.75.75 0 011.06.02L10 11.292l3.71-4.06a.75.75 0 111.08 1.04l-4.25 4.65a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z"
                              clip-rule="evenodd" />
                    </svg>
                </button>

                <a href="#" class="text-gray-700 hover:text-blue-600 font-medium">Contact</a>

                <!-- Cart -->
                <a href="#" class="relative text-gray-700 hover:text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path d="M3 3h2l.4 2M7 13h14l1-5H8.4" />
                        <circle cx="10" cy="21" r="1" />
                        <circle cx="20" cy="21" r="1" />
                    </svg>
                    <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs px-1.5 py-0.5 rounded-full">3</span>
                </a>

                <!-- Account Dropdown -->
                <button id="userDropdownButton" data-dropdown-toggle="userDropdown"
                        class="flex items-center text-gray-700 hover:text-blue-600 cursor-pointer">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 12a5 5 0 100-10 5 5 0 000 10zm-7 8a7 7 0 1114 0H3z" />
                    </svg>
                </button>
            </div>

            <!-- Mobile menu toggle -->
            <button data-collapse-toggle="mobile-menu" type="button"
                    class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 md:hidden">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M3 5h14a1 1 0 110 2H3a1 1 0 010-2zm0 6h14a1 1 0 110 2H3a1 1 0 010-2zm0 6h14a1 1 0 110 2H3a1 1 0 010-2z"
                          clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile menu -->
    <div class="hidden md:hidden" id="mobile-menu">
        <ul class="px-4 pb-4 space-y-2">
            <li><a href="/" class="block py-2 text-gray-700 hover:text-blue-600">Home</a></li>
            <li><a href="#" class="block py-2 text-gray-700 hover:text-blue-600">Deals</a></li>
            <li><a href="#" class="block py-2 text-gray-700 hover:text-blue-600">Shop</a></li>
            <li><a href="#" class="block py-2 text-gray-700 hover:text-blue-600">Contact</a></li>
        </ul>
    </div>

    <!-- Mega Dropdown -->
    <div id="megaMenuDropdown"
         class="hidden z-50 w-full bg-white shadow-lg border-t border-gray-200">
        <div class="max-w-screen-xl mx-auto px-4 py-6 grid grid-cols-4 gap-8 text-sm text-gray-700">
            <div>
                <h3 class="text-gray-900 font-bold mb-2">Clothing</h3>
                <ul>
                    <li><a href="#" class="block py-1 hover:text-blue-600">Men</a></li>
                    <li><a href="#" class="block py-1 hover:text-blue-600">Women</a></li>
                    <li><a href="#" class="block py-1 hover:text-blue-600">Kids</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-gray-900 font-bold mb-2">Electronics</h3>
                <ul>
                    <li><a href="#" class="block py-1 hover:text-blue-600">Phones</a></li>
                    <li><a href="#" class="block py-1 hover:text-blue-600">Laptops</a></li>
                    <li><a href="#" class="block py-1 hover:text-blue-600">TVs</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-gray-900 font-bold mb-2">Home</h3>
                <ul>
                    <li><a href="#" class="block py-1 hover:text-blue-600">Furniture</a></li>
                    <li><a href="#" class="block py-1 hover:text-blue-600">Decor</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-gray-900 font-bold mb-2">Beauty</h3>
                <ul>
                    <li><a href="#" class="block py-1 hover:text-blue-600">Skincare</a></li>
                    <li><a href="#" class="block py-1 hover:text-blue-600">Makeup</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Account Dropdown -->
    <div id="userDropdown"
         class="z-50 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 text-sm text-gray-700">
        <ul class="py-2">
            @auth
                <li>
                    <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100">
                        <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.5"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 0115 0" />
                        </svg>
                        Profile
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center px-4 py-2 hover:bg-gray-100">
                        <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.5"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 7.5A1.5 1.5 0 014.5 6h15A1.5 1.5 0 0121 7.5v9a1.5 1.5 0 01-1.5 1.5h-15A1.5 1.5 0 013 16.5v-9z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 12h6" />
                        </svg>
                        Orders
                    </a>
                </li>
                <li>
                    <a href="/logout" class="flex items-center px-4 py-2 hover:bg-gray-100">
                        <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" stroke-width="1.5"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M18 12H9m6-3l3 3-3 3" />
                        </svg>
                        Logout
                    </a>
                </li>
            @else
                <li>
                    <a href="/login" class="flex items-center px-4 py-2 hover:bg-gray-100">
                        <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.5"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-9A2.25 2.25 0 002.25 5.25v13.5A2.25 2.25 0 004.5 21h9a2.25 2.25 0 002.25-2.25V15" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M18 12h-9m6-3l3 3-3 3" />
                        </svg>
                        Login
                    </a>
                </li>
                <li>
                    <a href="/register" class="flex items-center px-4 py-2 hover:bg-gray-100">
                        <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" stroke-width="1.5"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M16 21v-2a4 4 0 00-8 0v2M12 11a4 4 0 100-8 4 4 0 000 8zM19 8v6m3-3h-6" />
                        </svg>
                        Register
                    </a>
                </li>
            @endauth
        </ul>
    </div>
</nav>