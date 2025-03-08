@extends('profile.layout')

@section('profile-content')
    @include('partials.errors')
    {{-- @include('partials.flash') --}}

    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Two Factor Authentication</h2>

        @if (session('status') === 'two-factor-authentication-disabled')
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                Two factor authentication has been disabled.
            </div>
        @endif

        @if (session('status') === 'two-factor-authentication-enabled')
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                Two factor authentication has been enabled.
            </div>
        @endif

        @if (session('status') === 'two-factor-authentication-confirmed')
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                Two factor authentication confirmed successfully.
            </div>
        @endif

        @if (auth()->user()->two_factor_secret && !auth()->user()->two_factor_confirmed_at)
            <form method="POST" action="{{ route('two-factor.confirm') }}" class="mb-8">
                @csrf
                <div class="mb-4">
                    <label for="code" class="block text-gray-700 mb-2">Verification Code</label>
                    <input type="text" name="code" id="code"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter code from authenticator app" required>
                        @error('code')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                </div>
                
                <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Confirm 2FA Setup
                </button>
            </form>
        @endif

        <form method="POST" action="{{ route('two-factor.disable') }}" class="pt-4">
            @csrf
            @if (auth()->user()->two_factor_secret)
                @method('DELETE')

                <div >
                    <div class="bg-gray-100 p-4 rounded-lg mb-4">
                        {!! auth()->user()->twoFactorQrCodeSvg('YourAppName') !!}
                    </div>

                    <div class="mb-4">
                        <h3 class="text-lg font-medium mb-2">Recovery Codes:</h3>
                        <ul class="list-disc pl-5 space-y-1 text-gray-700">

                            @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes)) as $code)
                                <li>{{ $code }}</li>
                            @endforeach

                        </ul>
                    </div>
                </div>

                <button type="submit"
                    class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">
                    Disable 2FA
                </button>
            @else
                <button type="submit" formaction="{{ route('two-factor.enable') }}"
                    class="bg-green-500  py-2 px-4 rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Enable 2FA
                </button>
            @endif
        </form>
    </div>
@endsection
