{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('layouts.guest')

@section('content')

<section class="is-relative section has-background-light">
  <div class="is-relative container">
    <div class="columns is-vcentered">
      <div class="column is-5 m-auto">
        <div class="box p-6 px-10-desktop py-12-desktop has-background-white has-text-centered">
          <form method="POST" action="{{ route('login') }}">
            @csrf
            {{-- <span class="has-text-danger-light has-text-weight-semibold">Sign Up</span> --}}
            <h3 class="title has-text-danger is-4 mt-4 mb-12">Log in</h3>

            <div class="is-relative mb-6">
              <input class="input py-5 has-background-white has-text-grey" type="email" placeholder="e.g hello@shuffle.dev" value="{{ old('email', '') }}" name="email">
              <span class="span-label ml-3 has-background-white">Your email address</span>
              @error('email')
                <div class="has-text-danger mt-1">{{ $message }}</div>
              @enderror
            </div>
            <div class="is-relative mb-3">
              <input class="input py-5 has-background-white has-text-grey" type="password" placeholder="******" name="password">
              <span class="span-label ml-3 has-background-white">Password</span>
              @error('password')
                <div class="has-text-danger mt-1">{{ $message }}</div>
              @enderror
            </div>            
            <label class="is-flex mb-10">
              
              <input class="mt-1" type="checkbox" name="terms" value="1" name="remember">
              <span class="dark-pink is-inline-block ml-3">Remember me</span>
            </label>
            <div class="is-flex is-justify-content-end	mt-5 is-align-items-flex-end">
              <span class="is-inline-block has-text-grey-dark  mr-5"><a class="dark-pink" href="{{ route('home') }}">Back home</a></span>
              <span class="is-inline-block has-text-grey-dark  mr-5"><a class="dark-pink" href="{{ route('password.request') }}">Forgot your password?</a></span>
              <button class="button is-danger has-text-warning-light">Get Started</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
