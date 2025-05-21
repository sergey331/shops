<nav class="bg-gray-800">
    <div class="logo">
        <a href="/">
            <img src="assets/img/logo.png" alt="logo" />
        </a>
    </div>
    <div class="menu"></div>
    <div class="authentication">
        @auth
        <ul class="authentication-dropdown">
            <li class="authentication-dropdown-item">
                <span> {{ $auth->user()->username }}</span>
                <ul class="authentication-dropdown-item-block">
                    <li>
                        <a href="/profile" class="nav-link">Profile</a>
                    </li>
                    <li>
                        <a href="/logout" class="btn btn-secondary">logout</a>
                    </li>
                </ul>
            </li>
        </ul>

        @else
            <a href="/login" class="btn btn-primary">Login</a>
            <a href="/register" class="btn btn-secondary">Register</a>
        @endauth
    </div>
</nav>
