@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-6 bg-white rounded-lg shadow-md overflow-hidden">
    <div class="bg-gray-100 p-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-800">Two Factor Recovery Code</h3>
    </div>

    <div class="p-6">
        <p class="text-center text-gray-600 mb-6">
            Please enter your recovery code to login.
        </p>

        <form method="POST" action="{{ route('two-factor.login') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-[120px_1fr] gap-4 mb-6">
                <label for="recovery_code" class="text-right text-gray-700 font-medium self-center">
                    Recovery Code:
                </label>

                <div class="space-y-2">
                    <input 
                        id="recovery_code" 
                        type="text" 
                        name="recovery_code"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 
                        @error('recovery_code') border-red-500 @enderror"
                        required
                        autocomplete="off"
                        placeholder="XXXX-XXXX-XXXX-XXXX"
                    >
                    
                    @error('recovery_code')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end">
                <button 
                    type="submit"
                    class="bg-blue-500 text-white py-2 px-6 rounded-lg hover:bg-blue-600 
                    focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
                >
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>
@endsection