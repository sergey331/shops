@include('Component.broadCast')
<section class="py-28">
    <div class="container mx-auto px-4">
        <div>
            <!-- Billing Details -->
            <div class="w-full">
                <h3 class="text-xl font-semibold mb-6">Billing Details</h3>
                <div class="space-y-4" id="order-content"></div>
            </div>
        </div>
    </div>
</section>

<script src="{{ public_path('assets/js/client/order.js') }}"></script>