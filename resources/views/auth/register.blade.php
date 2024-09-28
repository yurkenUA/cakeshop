{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
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
          <form method="POST" action="{{ route('register') }}">
            @csrf
            <h3 class="title has-text-danger is-4 mt-4 mb-12">Create New Account</h3>
            <div class="is-relative mb-5 mt-6">
                <input class="input py-5 has-background-white has-text-grey" type="text" placeholder="e.g Natalie" name="name" value="{{ old('name', '') }}">
                <span class="span-label ml-3 has-background-white">Your First Name</span>
                @error('name')
                  <div class="has-text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="is-relative mb-5">
              <input class="input py-5 has-background-white has-text-grey" type="email" placeholder="e.g hello@shuffle.dev" name="email" value="{{ old('email', '') }}">
              <span class="span-label ml-3 has-background-white">Your email address</span>
              @error('email')
                <div class="has-text-danger mt-1">{{ $message }}</div>
              @enderror
            </div>
            <div class="is-relative mb-5">
              <input class="input py-5 has-background-white has-text-grey" type="password" placeholder="******" name="password">
              <span class="span-label ml-3 has-background-white">Password</span>
              @error('password')
                <div class="has-text-danger mt-1">{{ $message }}</div>
              @enderror
            </div>        
            <div class="is-relative mb-5">
                <input class="input py-5 has-background-white has-text-grey" type="password" placeholder="******" name="password_confirmation">
                <span class="span-label ml-3 has-background-white">Confirm Password</span>
                @error('password_confirmation')
                  <div class="has-text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>          

            <div class="is-flex is-justify-content-end	mt-5 is-align-items-flex-end">
              <span class="is-inline-block has-text-grey-dark  mr-5"><a class="dark-pink" href="{{ route('home') }}">Back home</a></span>
              <span class="is-inline-block has-text-grey-dark  mr-5"><a class="dark-pink" href="{{ route('login') }}">Already registered?</a></span>
              <button class="button is-danger has-text-warning-light">Get Started</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection