@include('Component.broadCast')
<section class="py-28">
    <div class="container mx-auto px-4">
        <div class="cart-table">
            <!-- Cart Header -->
            <div class="border-y border-gray-200">
                <div class="flex capitalize">
                    <h4 class="w-full lg:w-5/12 py-3 m-0 font-semibold">Product</h4>
                    <h4 class="w-full lg:w-3/12 py-3 m-0 font-semibold">Quantity</h4>
                    <h4 class="w-full lg:w-2/12 py-3 m-0 font-semibold">Subtotal</h4>
                    <h4 class="w-full lg:w-2/12 py-3 m-0 font-semibold">Remove</h4>
                </div>
            </div>

            <!-- Cart Item 1 -->
            <div class="border-b border-gray-200 py-6">
                <div class="flex flex-col md:flex-row items-center">
                    <!-- Product Info -->
                    <div class="w-full lg:w-5/12 mb-4 md:mb-0">
                        <div class="flex flex-wrap md:flex-nowrap items-center gap-4">
                            <div class="w-full md:w-2/5">
                                <img src="/images/cart-item1.png" alt="cart-img" class="w-full border border-gray-200 rounded-lg">
                            </div>
                            <div class="w-full md:w-3/5">
                                <h5 class="mt-2 font-medium">
                                    <a href="single-product.html" class="text-xl hover:text-primary">The Emerald Crown</a>
                                </h5>
                                <div class="text-primary font-light">$2000.00</div>
                            </div>
                        </div>
                    </div>

                    <!-- Quantity -->
                    <div class="w-full lg:w-3/12">
                        <div class="flex flex-col md:flex-row items-center">
                            <!-- Quantity Selector -->
                            <div class="w-full md:w-3/12 mb-4 md:mb-0 product-quantity">
                                <div class="flex product-qty items-center">
                                    <button type="button"
                                            class="input-group-btn bg-white shadow border border-gray-200 rounded-lg font-light p-2 quantity-left-minus">
                                        <svg width="16" height="16" class="fill-current">
                                            <use xlink:href="#minus"></use>
                                        </svg>
                                    </button>
                                    <input type="text" id="quantity" name="quantity"
                                           class="bg-white shadow border border-gray-200 rounded-lg py-2 mx-2 text-center w-12" value="1"
                                           min="1" max="100" required>
                                    <button type="button"
                                            class="input-group-btn bg-white shadow border border-gray-200 rounded-lg font-light p-2 quantity-right-plus">
                                        <svg width="16" height="16" class="fill-current">
                                            <use xlink:href="#plus"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Subtotal -->
                    <div class="w-full lg:w-2/12">
                        <div class="flex flex-col md:flex-row items-center">
                            <!-- Subtotal -->
                            <div class="w-full md:w-2/12">
                                <span class="text-2xl font-light text-primary">$2000.00</span>
                            </div>
                        </div>
                    </div>

                    <!-- Remove Item -->
                    <div class="w-full lg:w-2/12 flex items-center mt-4 md:mt-0">
                        <a href="#" class="text-gray-500 hover:text-red-500">
                            <svg width="24" height="24" class="fill-current">
                                <use xlink:href="#cart-cross-outline"></use>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Cart Item 2 -->
            <div class="border-b border-gray-200 py-6">
                <div class="flex flex-col md:flex-row items-center">
                    <!-- Product Info -->
                    <div class="w-full lg:w-5/12 mb-4 md:mb-0">
                        <div class="flex flex-wrap md:flex-nowrap items-center gap-4">
                            <div class="w-full md:w-2/5">
                                <img src="/images/cart-item2.png" alt="cart-img" class="w-full border border-gray-200 rounded-lg">
                            </div>
                            <div class="w-full md:w-3/5">
                                <h5 class="mt-2 font-medium">
                                    <a href="single-product.html" class="text-xl hover:text-primary">The Last Enchantment</a>
                                </h5>
                                <div class="text-primary font-light">$2000.00</div>
                            </div>
                        </div>
                    </div>

                    <!-- Quantity -->
                    <div class="w-full lg:w-3/12">
                        <div class="flex flex-col md:flex-row items-center">
                            <!-- Quantity Selector -->
                            <div class="w-full md:w-3/12 mb-4 md:mb-0 product-quantity">
                                <div class="flex product-qty items-center">
                                    <button type="button"
                                            class="input-group-btn bg-white shadow border border-gray-200 rounded-lg font-light p-2 quantity-left-minus">
                                        <svg width="16" height="16" class="fill-current">
                                            <use xlink:href="#minus"></use>
                                        </svg>
                                    </button>
                                    <input type="text" id="quantity" name="quantity"
                                           class="bg-white shadow border border-gray-200 rounded-lg py-2 mx-2 text-center w-12" value="1"
                                           min="1" max="100" required>
                                    <button type="button"
                                            class="input-group-btn bg-white shadow border border-gray-200 rounded-lg font-light p-2 quantity-right-plus">
                                        <svg width="16" height="16" class="fill-current">
                                            <use xlink:href="#plus"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Subtotal -->
                    <div class="w-full lg:w-2/12">
                        <div class="flex flex-col md:flex-row items-center">
                            <!-- Subtotal -->
                            <div class="w-full md:w-2/12">
                                <span class="text-2xl font-light text-primary">$2000.00</span>
                            </div>
                        </div>
                    </div>

                    <!-- Remove Item -->
                    <div class="w-full lg:w-2/12 flex items-center mt-4 md:mt-0">
                        <a href="#" class="text-gray-500 hover:text-red-500">
                            <svg width="24" height="24" class="fill-current">
                                <use xlink:href="#cart-cross-outline"></use>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Cart Totals -->
        <div class="py-8 pb-0">
            <h3 class="text-2xl font-semibold mb-4">Cart Totals</h3>
            <div class="pb-6">
                <table class="w-full lg:w-5/12 capitalize">
                    <tbody>
                    <tr class="border-y border-gray-200 py-2">
                        <th class="py-2 text-left font-medium">Subtotal</th>
                        <td class="py-2 text-right">
                  <span class="text-primary font-light ps-5">
                    <span>$</span>2,400.00
                  </span>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-200 py-2">
                        <th class="py-2 text-left font-medium">Total</th>
                        <td class="py-2 text-right">
                  <span class="text-primary font-light ps-5">
                    <span>$</span>2,400.00
                  </span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <!-- Buttons -->
            <div class="flex flex-wrap gap-3 mb-8">
                <button class="px-6 py-3 bg-gray-200 hover:bg-gray-300 rounded-md transition">Update Cart</button>
                <button class="px-6 py-3 bg-gray-200 hover:bg-gray-300 rounded-md transition">Continue Shopping</button>
                <button class="px-6 py-3 bg-primary text-white rounded-md transition">Proceed to checkout</button>
            </div>
        </div>
    </div>
</section>
@include('Component.Home.instagram')