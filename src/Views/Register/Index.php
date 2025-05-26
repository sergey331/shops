{!! $errors = $session->getCLean('errors') ?? []; !!}



<section class="bg-gray-50 dark:bg-gray-900 min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-white rounded-lg shadow dark:bg-gray-800 p-6 space-y-6 mt-10">
        <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white">Create an account</h2>

        <form action="/register" method="POST" class="space-y-4">
            <!-- Name -->
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Username</label>
                <input type="text" name="username" id="name"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600
                      focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600
                      dark:placeholder-gray-400 dark:text-white" placeholder="John Doe">
            </div>
            @isset($errors['username'])
            <ul class="mt-2 text-sm text-red-600 dark:text-red-500 space-y-1">
                @foreach ($errors['username'] as $error)
                <li class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-red-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M12 4.75a7.25 7.25 0 110 14.5 7.25 7.25 0 010-14.5z" />
                    </svg>
                    {{ $error }}
                </li>
                @endforeach
            </ul>
            @endisset

            <!-- Email -->
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your email</label>
                <input type="email" name="email" id="email"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600
                      focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600
                      dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com">
            </div>
            @isset($errors['email'])
            <ul class="mt-2 text-sm text-red-600 dark:text-red-500 space-y-1">
                @foreach ($errors['email'] as $error)
                <li class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-red-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M12 4.75a7.25 7.25 0 110 14.5 7.25 7.25 0 010-14.5z" />
                    </svg>
                    {{ $error }}
                </li>
                @endforeach
            </ul>
            @endisset

            <!-- Password -->
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Password</label>
                <input type="password" name="password" id="password"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600
                      focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600
                      dark:placeholder-gray-400 dark:text-white" placeholder="••••••••">
            </div>

            @isset($errors['password'])
            <ul class="mt-2 text-sm text-red-600 dark:text-red-500 space-y-1">
                @foreach ($errors['password'] as $error)
                <li class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-red-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M12 4.75a7.25 7.25 0 110 14.5 7.25 7.25 0 010-14.5z" />
                    </svg>
                    {{ $error }}
                </li>
                @endforeach
            </ul>
            @endisset

            <!-- Submit -->
            <button type="submit"
                    class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none
                     focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center
                     dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                Create account
            </button>

            <!-- Sign In Link -->
            <p class="text-sm font-light text-gray-500 dark:text-gray-400 text-center">
                Already have an account?
                <a href="/login" class="font-medium text-primary-600 hover:underline dark:text-primary-400">Sign in</a>
            </p>
        </form>
    </div>
</section>