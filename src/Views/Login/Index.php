<?php 

$errors = $session->getCLean('errors') ?? [];
?>

<div class="container">
    <ul class="register">
        <h1 class="header">Login</h1>
        <form action="/login" method="POST" class="form">
        
            <div class="form-group">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email"  />
            </div>

            <?php if (!empty($errors) && isset($errors['email'])) { ?>
                <ul class="errors">
                    <?php foreach ($errors['email'] as $error) { ?>
                        <li><?= $error ?></li>
                    <?php } ?> 
                </ul>
            <?php } ?>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password"  />
            </div>

            <?php if (!empty($errors) && isset($errors['password'])) { ?>
                <ul class="errors">
                    <?php foreach ($errors['password'] as $error) { ?>
                        <li><?= $error ?></li>
                    <?php } ?> 
                </ul>
            <?php } ?>
            <button type="submit" >Login</button>
        </form>
    </div>
</div>