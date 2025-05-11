{!! $error = $session->getCLean('login_error') ?? [];  !!}


@noempty($error)
    <div>
        {{ $error }}
    </div>
@endempty
<div class="container">
    <ul class="register">
        <h1 class="header">Login</h1>
        <form action="/login" method="POST" class="form">
        
            <div class="form-group">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email"  />
            </div>

           
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password"  />
            </div>

            
            <button type="submit" >Login</button>
        </form>
    </div>
</div>