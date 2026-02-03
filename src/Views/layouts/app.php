<!doctype html>
<html lang="en">
<head>
    <title>Bookly - Bookstore</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="Templates Jungle">
    <meta name="keywords" content="Tailwind CSS eCommerce HTML CSS Template">
    <meta name="description" content="Bookly is Bookstore">
    <link rel="icon" type="image/png"  href="/images/favicon.ico">

    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Vendor Styles -->
    <link rel="stylesheet" type="text/css" href="/css/vendor.css">

    <!-- Custom Styles -->
    <link rel="stylesheet" type="text/css" href="/style.css">
    <link rel="stylesheet" type="text/css" href="/css/index.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


</head>
<body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@include('Component.Layout.svg')
@include('Component.Layout.preloader')
@include('Component.Layout.search_popup')
@include('Component.Layout.header')

<?= $content ?>

@include('Component.Layout.footer')

<hr class="my-0">

@include('Component.Layout.footer_bottom')

<!-- Swiper.js -->
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
<!-- Alpine.js -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js" defer></script>
<script src="/js/plugins.js"></script>
<script type="text/javascript" src="/js/script.js"></script>

</body>
</html>