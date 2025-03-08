@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Confirm Password</h2>

    @include('partials.errors')

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 mb-2">Password</label>
            <input 
                type="password" 
                name="password" 
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
            >
        </div>

        <button 
            type="submit"
            class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
            Confirm
        </button>
    </form>
</div>
@endsection