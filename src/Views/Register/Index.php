{!! $errors = $session->getCLean('errors') ?? []; !!}

<div class="container">
    <ul class="register">
        <h1 class="header">Register</h1>
        <form action="/register" method="POST" class="form">
            <div class="form-group">
                <label for="username" >Username</label>
                <input type="text" name="username" id="username"  />
            </div>
            @isset($errors['username'])
                <ul class="errors">
                    @foreach ($errors['username'] as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endisset
            <div class="form-group">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email"  />
            </div>
            @isset($errors['email'])
                <ul class="errors">
                    @foreach ($errors['email'] as $error)
                        <li>{{  $error }}</li>
                    @endforeach 
                </ul>
            @endisset
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password"  />
            </div>

            @isset($errors['password'])
                <ul class="errors">
                    @foreach ($errors['password'] as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endisset
            <button type="submit" >Register</button>
        </form>
    </div>
</div>