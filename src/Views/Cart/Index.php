@include('Component.broadCast')
<section class="py-28" id="cartContent">
    {{ $cartContent }}
</section>
@include('Component.Home.instagram')

<script src="{{public_path('/assets/js/client/cart.js')}}"></script>