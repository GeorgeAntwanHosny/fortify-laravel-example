@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md w-full">
        <h1 class="text-3xl font-bold mb-6">Profile</h1>

        <div class="grid grid-cols-1 md:grid-cols-[170px_1fr] gap-4  ">
            <!-- Sidebar -->
            <nav class="space-y-2">
                <a href="{{ route('profile.show') }}"
                    class="block px-4 py-2 rounded-lg {{ request()->routeIs('profile.show') ? 'bg-blue-500 text-white' : 'hover:bg-gray-100' }}">
                    Profile
                </a>
                <a href="{{ route('profile.show-password') }}"
                    class="block px-4 py-2 rounded-lg {{ request()->routeIs('profile.show-password') ? 'bg-blue-500 text-white' : 'hover:bg-gray-100' }}">
                    Update Password
                </a>

                <a href="{{ route('two-factor.show') }}"
                    class="block px-4 py-2 rounded-lg {{ request()->routeIs('two-factor.show') ? 'bg-blue-500 text-white' : 'hover:bg-gray-100' }}">
                    Two-Factor Auth
                </a>
            </nav>

            <!-- Content -->
            <div class="space-y-6">
                @yield('profile-content')
            </div>
        </div>
    </div>
@endsection
