<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth System</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-md ">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
            <div class="flex justify-between h-14">
                <div class="flex">
                    <a href="{{ route('dashboard') }}" class="flex-shrink-0 flex items-center">
                        <span class="text-xl font-bold text-blue-600">MyApp</span>
                    </a>
                </div>

                <div class="flex items-center">
                    
                    @auth
                    <a href="{{ route('profile.show') }}" class="flex-shrink-0 flex items-center">
                        <span class="text-md  text-blue-600">My Profile</span>
                    </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-blue-600 hover:text-blue-800 ml-4">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 ml-4">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 ml-4">
                            Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>
</body>
</html>