<nav class="bg-gray-800">
    <div class="logo">
        <a href="/">
            <img src="assets/img/logo.png" alt="logo" />
        </a>
    </div>
    <div class="menu"></div>
    <div class="authentication">
        <?php if (!$auth->check()) : ?>
            <a href="/login" class="btn btn-primary">Login</a>
            <a href="/register" class="btn btn-secondary">Register</a>
        <?php else: ?>
            <span><?= $auth->user()->username?></>
            <a href="/logout" class="btn btn-secondary">logout</a>
        <?php endif; ?>
    </div>
</nav>
