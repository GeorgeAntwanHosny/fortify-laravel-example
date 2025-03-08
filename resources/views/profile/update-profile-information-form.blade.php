@extends('profile.layout')
@section('title', 'Update Profile')

@section('profile-content')
@include('partials.errors')

<form method="POST" action="{{ route('user-profile-information.update') }}">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block text-gray-700 mb-2">Name</label>
        <input 
            type="text" 
            name="name" 
            value="{{ Auth::user()->name }}" 
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            required
        >
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 mb-2">Email</label>
        <input 
            type="email" 
            name="email" 
            value="{{ Auth::user()->email }}" 
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            required
        >
    </div>

    <button 
        type="submit"
        class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
    >
        Save Changes
    </button>
</form>
@endsection