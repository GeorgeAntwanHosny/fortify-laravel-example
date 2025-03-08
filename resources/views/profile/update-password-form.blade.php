@extends('profile.layout')
@section('title', 'Update Password')

@section('profile-content')
@include('partials.errors')

<form method="POST" action="{{ route('user-password.update') }}">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block text-gray-700 mb-2">Current Password</label>
        <input 
            type="password" 
            name="current_password" 
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            required
        >
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 mb-2">New Password</label>
        <input 
            type="password" 
            name="password" 
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            required
        >
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 mb-2">Confirm Password</label>
        <input 
            type="password" 
            name="password_confirmation" 
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            required
        >
    </div>

    <button 
        type="submit"
        class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
    >
        Update Password
    </button>
</form>
@endsection