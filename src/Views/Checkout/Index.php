@include('Component.broadCast')
<section class="py-28">
    <div class="container mx-auto px-4">
        <div>
            <!-- Billing Details -->
            <div class="w-full">
                <h3 class="text-xl font-semibold mb-6">Checkout</h3>
                <div class="flex gap-4">
                    <div class="space-y-4 flex-auto" id="order-content"></div>
                    <div class="bg-white shadow-lg rounded-xl p-6">
                        <ul>
                            @guest
                                <li class="px-7 py-1 border border-dashed cursor-pointer border-primary  text-2xl  rounded-xl mt-3">Choose type</li>
                            @endguest
                            <li class="px-7 py-1 border border-dashed cursor-pointer border-primary  text-2xl  rounded-xl mt-3">Personal info</li>
                            <li class="px-7 py-1 border border-dashed cursor-pointer border-primary  text-2xl  rounded-xl mt-3">Payment</li>
                            <li class="px-7 py-1 border border-dashed cursor-pointer border-primary  text-2xl  rounded-xl mt-3">Confirm</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="{{ public_path('assets/js/client/order.js') }}"></script>