<div class="min-h-screen bg-gray-50 flex justify-center p-6">
    <div class="w-full bg-white rounded-xl shadow p-8">
        <h1 class="text-2xl font-bold mb-6">Choose type</h1>
        <div class="space-y-3 mb-8">
            <label class="flex items-center gap-3 border rounded-lg p-4 cursor-pointer">
                <input type="radio" name="checkout_type" value="register"
                       {{ $type ==  'register' ? 'checked' : ''}}
                       class="checkout-radio">
                <span class="font-medium">Create Account</span>
            </label>
            <label class="flex items-center gap-3 border rounded-lg p-4 cursor-pointer">
                <input type="radio" name="checkout_type" value="guest"
                       {{ $type ==  'guest' ? 'checked' : ''}}
                       class="checkout-radio">
                <span class="font-medium">Continue as Guest</span>
            </label>

            <button id="saveNext1" class="flex items-center justify-between py-2 text-white px-5 font-medium rtl:text-right text-body rounded  hover:text-heading bg-primary hover:bg-neutral-secondary-medium gap-3">Next</button>
        </div>
    </div>
</div>
