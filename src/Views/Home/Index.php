@count($sliders)
    @include('Component.Home.billboard')
@endcount
@include('Component.Home.company_services')

@include('Component.Home.best_selling')

@include('Component.Home.limited_offer')

@include('Component.Home.items_listing')

@count($categories)
    @include('Component.Home.categories')
@endcount
@include('Component.Home.customers_reviews')

@include('Component.Home.latest_posts')

@include('Component.Home.instagram')