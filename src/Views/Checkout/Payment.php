<div class="min-h-screen bg-gray-50 flex justify-center p-6">
    <div class="w-full bg-white rounded-xl shadow p-8">
        <h1 class="text-2xl font-bold mb-6">Choose payment method</h1>
        <div class="space-y-3 mb-8">
            @foreach($payments as $payment)
            <label class="flex items-center gap-3 border rounded-lg p-4 cursor-pointer">
                <input type="radio" name="payment_id" value="{{ $payment->id }}"
                       class="checkout-radio">
                <span class="font-medium">{{ $payment->name }}</span>
            </label>
            @endforeach
            <button id="savePayment" class="flex items-center justify-between py-2 text-white px-5 font-medium rtl:text-right text-body rounded  hover:text-heading bg-primary hover:bg-neutral-secondary-medium gap-3">Next</button>
        </div>
    </div>
</div>