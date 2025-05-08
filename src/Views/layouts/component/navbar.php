<nav class="bg-gray-800">
    <div class="logo">
        <a href="/">
            <img src="assets/img/logo.png" alt="logo" />
        </a>
    </div>
    <div class="menu"></div>
    <div class="authentication">
        @auth
            <span> {{ $auth->user()->username }}</span>
            <a href="/logout" class="btn btn-secondary">logout</a>
        @else
            <a href="/login" class="btn btn-primary">Login</a>
            <a href="/register" class="btn btn-secondary">Register</a>
        @endauth
    </div>
</nav>
