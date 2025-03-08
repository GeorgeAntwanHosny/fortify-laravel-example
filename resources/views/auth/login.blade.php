@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
    <h1 class="text-3xl font-bold mb-6 text-center">Login</h1>

    @include('partials.errors')

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 mb-2" for="email">Email</label>
            <input 
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                type="email" 
                name="email" 
                value="{{ old('email') }}" 
                required 
                autofocus
            >
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 mb-2" for="password">Password</label>
            <input 
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror"
                type="password" 
                name="password" 
                required
            >
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center mb-4">
            <input 
                class="mr-2" 
                type="checkbox" 
                name="remember" 
                id="remember"
            >
            <label class="text-gray-700" for="remember">Remember Me</label>
        </div>

        <button 
            type="submit"
            class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
            Login
        </button>

        <div class="mt-4 text-center">
            <a class="text-blue-500 hover:text-blue-700" href="{{ route('password.request') }}">
                Forgot Your Password?
            </a>
        </div>
    </form>
</div>
@endsection