@if(!empty($cart->get()))
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
        @foreach($cart->get() as $c)
        {!! $book = $c->getBook() !!}
        <div class="border-b border-gray-200 py-6">
            <div class="flex flex-col md:flex-row items-center">
                <!-- Product Info -->
                <div class="w-full lg:w-5/12 mb-4 md:mb-0">
                    <div class="flex flex-wrap md:flex-nowrap items-center gap-4">
                        <div class="w-full md:w-2/5">
                            <img src="{{ public_path('uploads/books/' . $book->id . '/'. $book->cover_image)}}"
                                alt="cart-img" class="w-full border border-gray-200 rounded-lg">
                        </div>
                        <div class="w-full md:w-3/5">
                            <h5 class="mt-2 font-medium">
                                <a href="single-product.html" class="text-xl hover:text-primary">
                                    {{ $book->title }}
                                </a>
                            </h5>
                            <div class="text-primary font-light">{{ setting()->currency->symbol . '' . $book->price }}</div>
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
                                <input type="text"
                                    class="bg-white shadow border border-gray-200 rounded-lg py-2 mx-2 text-center w-12 qut-inp"
                                    value="{{ $c->getQty() }}" data-book-id="{{ $c->getBookId() }}" min="1" max="100"
                                    required />
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
                            <span class="text-2xl font-light text-primary">{{ setting()->currency->symbol . '' . $c->getSubtotal() }}</span>
                        </div>
                    </div>
                </div>

                <!-- Remove Item -->
                <div class="w-full lg:w-2/12 flex items-center mt-4 md:mt-0">
                    <button class="text-gray-500 hover:text-red-500 remove_item" data-book-id="{{ $c->getBookId() }}">
                        <svg fill="#6d1010" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                            viewBox="0 0 482.428 482.429" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M381.163,57.799h-75.094C302.323,25.316,274.686,0,241.214,0c-33.471,0-61.104,25.315-64.85,57.799h-75.098
            c-30.39,0-55.111,24.728-55.111,55.117v2.828c0,23.223,14.46,43.1,34.83,51.199v260.369c0,30.39,24.724,55.117,55.112,55.117
            h210.236c30.389,0,55.111-24.729,55.111-55.117V166.944c20.369-8.1,34.83-27.977,34.83-51.199v-2.828
            C436.274,82.527,411.551,57.799,381.163,57.799z M241.214,26.139c19.037,0,34.927,13.645,38.443,31.66h-76.879
            C206.293,39.783,222.184,26.139,241.214,26.139z M375.305,427.312c0,15.978-13,28.979-28.973,28.979H136.096
            c-15.973,0-28.973-13.002-28.973-28.979V170.861h268.182V427.312z M410.135,115.744c0,15.978-13,28.979-28.973,28.979H101.266
            c-15.973,0-28.973-13.001-28.973-28.979v-2.828c0-15.978,13-28.979,28.973-28.979h279.897c15.973,0,28.973,13.001,28.973,28.979
            V115.744z" />
                                    <path d="M171.144,422.863c7.218,0,13.069-5.853,13.069-13.068V262.641c0-7.216-5.852-13.07-13.069-13.07
            c-7.217,0-13.069,5.854-13.069,13.07v147.154C158.074,417.012,163.926,422.863,171.144,422.863z" />
                                    <path d="M241.214,422.863c7.218,0,13.07-5.853,13.07-13.068V262.641c0-7.216-5.854-13.07-13.07-13.07
            c-7.217,0-13.069,5.854-13.069,13.07v147.154C228.145,417.012,233.996,422.863,241.214,422.863z" />
                                    <path d="M311.284,422.863c7.217,0,13.068-5.853,13.068-13.068V262.641c0-7.216-5.852-13.07-13.068-13.07
            c-7.219,0-13.07,5.854-13.07,13.07v147.154C298.213,417.012,304.067,422.863,311.284,422.863z" />
                                </g>
                            </g>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Cart Totals -->
    <div class="py-8 pb-0">
        <h3 class="text-2xl font-semibold mb-4">Cart Totals</h3>
        <div class="pb-6">
            <table class="w-full lg:w-5/12 capitalize">
                <tbody>

                    <tr class="border-b border-gray-200 py-2">
                        <th class="py-2 text-left font-medium">Total</th>
                        <td class="py-2 text-right">
                            <span class="text-primary font-light ps-5">
                                <span>{{ setting()->currency->symbol }}</span>{{ $cart->total() }}
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
@else
<div class="text-center py-5">

    <div class="flex flex-col items-center justify-center py-20 text-center">
        <div class="mb-5 flex justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-400 dark:text-gray-300"
                viewBox="0 0 85 85">
                <title>Artboard-5</title>
                <g id="Unbox-2" data-name="Unbox">
                    <path
                        d="M86.69,32.6084,78.0391,27.74,86.69,22.8716a1,1,0,0,0,0-1.7432l-32-18a1.0015,1.0015,0,0,0-.98,0L44,8.5928,34.29,3.1284a1.0015,1.0015,0,0,0-.98,0l-32,18a1,1,0,0,0,0,1.7432L9.9609,27.74,1.31,32.6084a1,1,0,0,0,0,1.7432L11,39.8024V66a1.0011,1.0011,0,0,0,.51.8716l32,18A1.2026,1.2026,0,0,0,44,85a1.232,1.232,0,0,0,.49-.1284l32-18A1.0011,1.0011,0,0,0,77,66V39.8024l9.69-5.4508a1,1,0,0,0,0-1.7432ZM43,44.03,14.04,27.74,43,11.45Zm2-32.58L73.96,27.74,45,44.03Zm9.2-6.3027L84.1611,22,76,26.5928,46.0394,9.74Zm-20.4,0L41.9606,9.74,19.49,22.38,12,26.5928,3.8389,22ZM12,28.8877c10.578,5.95,5.975,3.3608,29.9606,16.8527L33.8,50.3325,3.8389,33.48Zm1,12.0415L33.31,52.3516a1,1,0,0,0,.98,0L43,47.45V82.29L13,65.415Zm62,0V65.415L45,82.29V47.45l8.71,4.9012a1,1,0,0,0,.98,0ZM54.2,50.3325,46.0394,45.74C72.7863,30.6953,65.1109,35.0126,76,28.8877L84.1611,33.48Z"
                        style="fill:#1d1b1e" />
                </g>
            </svg>
        </div>

        <h2 class="text-2xl font-semibold text-gray-800">
            Your cart is empty
        </h2>

        <p class="mt-2 text-gray-500 max-w-md">
            Looks like you haven’t added any books yet.
        </p>

        <a href="/shop"
            class="mt-6 inline-flex items-center rounded-lg bg-indigo-600 px-6 py-3 text-white font-medium hover:bg-indigo-700 transition">
            Browse books
        </a>
    </div>
</div>
@endif