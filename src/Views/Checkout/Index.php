@include('Component.broadCast')
<section class="py-28">
    <div class="container mx-auto px-4">
        <form class="space-y-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Billing Details -->
                <div class="w-full lg:w-1/2">
                    <h3 class="text-xl font-semibold mb-6">Billing Details</h3>
                    <div class="space-y-4">
                        <div>
                            <label for="fname" class="block text-gray-700 mb-1">First Name*</label>
                            <input type="text" id="fname" name="firstname"
                                   class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-0 focus:border-gray-800">
                        </div>

                        <div>
                            <label for="lname" class="block text-gray-700 mb-1">Last Name*</label>
                            <input type="text" id="lname" name="lastname"
                                   class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-0 focus:border-gray-800">
                        </div>

                        <div>
                            <label for="cname" class="block text-gray-700 mb-1">Company Name (optional)</label>
                            <input type="text" id="cname" name="companyname"
                                   class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-0 focus:border-gray-800">
                        </div>

                        <div>
                            <label for="country" class="block text-gray-700 mb-1">Country / Region*</label>
                            <select id="country"
                                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-0 focus:border-gray-800">
                                <option selected hidden>United States</option>
                                <option value="UK">UK</option>
                                <option value="Australia">Australia</option>
                                <option value="Canada">Canada</option>
                            </select>
                        </div>

                        <div>
                            <label for="address" class="block text-gray-700 mb-1">Street Address*</label>
                            <input type="text" id="adr" name="address" placeholder="House number and street name"
                                   class="w-full border border-gray-300 rounded-md px-4 py-2 mb-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <input type="text" id="adr2" name="address2" placeholder="Appartments, suite, etc."
                                   class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-0 focus:border-gray-800">
                        </div>

                        <div>
                            <label for="city" class="block text-gray-700 mb-1">Town / City*</label>
                            <input type="text" id="city" name="city"
                                   class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-0 focus:border-gray-800">
                        </div>

                        <div>
                            <label for="state" class="block text-gray-700 mb-1">State*</label>
                            <select id="state"
                                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-0 focus:border-gray-800">
                                <option selected hidden>Florida</option>
                                <option value="New York">New York</option>
                                <option value="Chicago">Chicago</option>
                                <option value="Texas">Texas</option>
                                <option value="San Jose">San Jose</option>
                                <option value="Houston">Houston</option>
                            </select>
                        </div>

                        <div>
                            <label for="zip" class="block text-gray-700 mb-1">Zip Code*</label>
                            <input type="text" id="zip" name="zip"
                                   class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-0 focus:border-gray-800">
                        </div>

                        <div>
                            <label for="phone" class="block text-gray-700 mb-1">Phone*</label>
                            <input type="text" id="phone" name="phone"
                                   class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-0 focus:border-gray-800">
                        </div>

                        <div>
                            <label for="email" class="block text-gray-700 mb-1">Email address*</label>
                            <input type="email" id="email" name="email"
                                   class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-0 focus:border-gray-800">
                        </div>
                    </div>
                </div>

                <!-- Additional Information & Order Summary -->
                <div class="w-full lg:w-1/2">
                    <!-- Order Notes -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold mb-6">Additional Information</h3>
                        <div>
                            <label for="notes" class="block text-gray-700 mb-1">Order notes (optional)</label>
                            <textarea id="notes"
                                      class="w-full border border-gray-300 rounded-md px-4 py-3 h-32 focus:outline-none focus:ring-0 focus:border-gray-800"
                                      placeholder="Notes about your order. Like special notes for delivery."></textarea>
                        </div>
                    </div>

                    <!-- Cart Totals -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-xl font-semibold mb-6">Cart Totals</h3>

                        <div class="mb-6">
                            <table class="w-full">
                                <tbody>
                                <tr class="border-y border-gray-200">
                                    <th class="py-3 text-left font-medium">Subtotal</th>
                                    <td class="py-3 text-right">
                                        <span class="text-primary font-light">$2,400.00</span>
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-200">
                                    <th class="py-3 text-left font-medium">Total</th>
                                    <td class="py-3 text-right">
                                        <span class="text-primary font-light">$2,400.00</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Payment Methods -->
                        <div class="space-y-4 mb-6">
                            <label
                                    class="flex items-start gap-4 p-4 border border-gray-200 rounded-lg hover:border-gray-800 cursor-pointer">
                                <input class="mt-1" type="radio" name="payment" checked>
                                <div>
                                    <p class="font-medium">Direct bank transfer</p>
                                    <p class="text-sm text-gray-600 mt-1">Make your payment directly into our bank account. Please use
                                        your Order ID. Your order will shipped after funds have cleared in our account.</p>
                                </div>
                            </label>

                            <label
                                    class="flex items-start gap-4 p-4 border border-gray-200 rounded-lg hover:border-gray-800 cursor-pointer">
                                <input class="mt-1" type="radio" name="payment">
                                <div>
                                    <p class="font-medium">Check payments</p>
                                    <p class="text-sm text-gray-600 mt-1">Please send a check to Store Name, Store Street, Store Town,
                                        Store State / County, Store Postcode.</p>
                                </div>
                            </label>

                            <label
                                    class="flex items-start gap-4 p-4 border border-gray-200 rounded-lg hover:border-gray-800 cursor-pointer">
                                <input class="mt-1" type="radio" name="payment">
                                <div>
                                    <p class="font-medium">Cash on delivery</p>
                                    <p class="text-sm text-gray-600 mt-1">Pay with cash upon delivery.</p>
                                </div>
                            </label>

                            <label
                                    class="flex items-start gap-4 p-4 border border-gray-200 rounded-lg hover:border-gray-800 cursor-pointer">
                                <input class="mt-1" type="radio" name="payment">
                                <div>
                                    <p class="font-medium">Paypal</p>
                                    <p class="text-sm text-gray-600 mt-1">Pay via PayPal; you can pay with your credit card if you don't
                                        have a PayPal account.</p>
                                </div>
                            </label>
                        </div>

                        <!-- Place Order Button -->
                        <button type="submit" class="w-full bg-primary text-white py-3 px-6 rounded-md transition">
                            Place an order
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@include('Component.Home.instagram')