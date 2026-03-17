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
                                <li data-step="type" class="steps type px-7 py-1 border {{ $step === '' ? 'border-dashed border-primary' : '' }} cursor-pointer   text-2xl  rounded-xl mt-3">Choose type</li>
                            @endguest
                            <li data-step="personal_info" class="steps personal_info px-7 py-1 border {{ $step === 'personal_info' ? 'border-dashed border-primary' : '' }} cursor-pointer   text-2xl  rounded-xl mt-3">Personal info</li>
                            <li data-step="payment" class="steps payment px-7 py-1 border {{ $step === 'payment' ? 'border-dashed border-primary' : '' }} cursor-pointer   text-2xl  rounded-xl mt-3">Payment</li>
                            <li data-step="confirm" class="steps confirm px-7 py-1 border {{ $step === 'confirm' ? 'border-dashed border-primary' : '' }} cursor-pointer   text-2xl  rounded-xl mt-3">Confirm</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="{{ public_path('assets/js/client/order.js') }}"></script>