{!! $error = $session->getCLean('login_error') ?? [];  !!}



<section class="min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md dark:bg-gray-800 p-6 space-y-6 mt-10">
        <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white">Sign in to your account</h2>

        @noempty($error)
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100 dark:bg-red-200 dark:text-red-900" role="alert">
            {{ $error }}
        </div>
        @endempty
        <form action="/login" method="POST"  class="space-y-4">
            <!-- Email -->
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your email</label>
                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
               focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700
               dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Password</label>
                <input type="password" name="password" id="password" placeholder="••••••••"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
               focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700
               dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" >
            </div>

            <!-- Remember Me + Forgot -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember" type="checkbox" class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300
                 rounded focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800
                 dark:bg-gray-700 dark:border-gray-600">
                    <label for="remember" class="ml-2 text-sm text-gray-600 dark:text-gray-400">Remember me</label>
                </div>
                <a href="#" class="text-sm text-primary-600 hover:underline dark:text-primary-400">Forgot password?</a>
            </div>

            <!-- Submit -->
            <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none
              focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center
              dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                Sign in
            </button>

            <!-- Register link -->
            <p class="text-sm font-light text-gray-500 dark:text-gray-400 text-center">
                Don’t have an account yet?
                <a href="/register" class="font-medium text-primary-600 hover:underline dark:text-primary-400">Sign up</a>
            </p>
        </form>
    </div>
</section>