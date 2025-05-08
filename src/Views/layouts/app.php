<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>Document</title>

</head>
<body>
<header>
<nav class="bg-gray-800">
    <div class="logo">
        <a href="/">
            <img src="assets/img/logo.png" alt="logo" />
        </a>
    </div>
    <div class="menu"></div>
    <div class="authentication">
        @if(!$auth->check())  
            <a href="/login" class="btn btn-primary">Login</a>
            <a href="/register" class="btn btn-secondary">Register</a>
        @else
            <span> {{ $auth->user()->username }}</span>
            <a href="/logout" class="btn btn-secondary">logout</a>
        @endif
    </div>
</nav>
</header>
<main>

    <?= $content ?>
</main>

<footer>
   
</footer>
</body>
</html>