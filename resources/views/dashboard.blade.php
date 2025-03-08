@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
        <p class="text-gray-600">Welcome back, {{ Auth::user()->name }}!</p>
    </div>
</div>
@endsection