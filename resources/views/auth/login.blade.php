<x-guest-layout>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BizAP</title>
    </head>

    <x-jet-authentication-card :logo="$logo">
        <x-jet-validation-errors class="mb-6" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
        @csrf
        <h5 style="font-size: 18px;text-align: center;font-weight: 580;">Login</h5><br>
        <div>
        <x-jet-label for="email" value="{{ __('Email/Username') }}" style="font-size: 15px;font-weight: 530;" />
        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
        </div>

        <div class="mt-4">
        <x-jet-label for="password" value="{{ __('Password') }}"  style="font-size: 15px;font-weight: 530;font-size: 15px;"/>
        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
        </div>

        <div class="block mt-4">
        <label for="remember_me" class="flex items-center">
        <x-jet-checkbox id="remember_me" name="remember" />
        <span class="ml-2 text-sm text-gray-600" style="font-weight: 530;font-size: 15px;">{{ __('Remember me') }}</span>
        </label>
        </div>

        <div class="justify-end mt-4">
        @if (Route::has('password.request'))
        <a class="text-sm text-blue-600 hover:text-blue-900" href="{{ route('password.request') }}"style="color:#206bc4;">
        {{ __('Forgot your password?') }}
        </a>
        @endif

        <x-jet-button class="ml-4" style="float: right;background-color: #206bc4;">
        {{ __('Sign in') }}
        </x-jet-button>


        </form>
    </x-jet-authentication-card>

<br><br>
<div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
Copyright © <?php echo date("Y");?> <a href="https://www.dhi.bt" style="color:#206bc4;">Druk Holding and Investment Limited.</a> All rights reserved.
</div>

</x-guest-layout>
