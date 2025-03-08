@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Two Factor Authentication</h2>

    @include('partials.errors')

    <div class="mb-4">
        <p class="text-gray-600">
            Please confirm access to your account by entering the authentication code 
            provided by your application.
        </p>
    </div>

    <form method="POST" action="{{ route('two-factor.login') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Code</label>
            <input 
                type="text" 
                name="code" 
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
            >
        </div>

        <button 
            type="submit"
            class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
            Login
        </button>
        <p>do you lose the secret key from your app? you could recover your code <a class="text-blue-500" href="{{ route('recover-code') }}">here</a> </p>
    </form>
</div>
@endsection