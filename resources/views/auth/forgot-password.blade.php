{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
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
          <form method="POST" action="{{ route('password.email') }}">
            @csrf
            {{-- @if (session('status'))
              <div class="has-text-success">
                  {{ session('status') }}
              </div>
            @endif --}}
            <h3 class="title has-text-danger is-4 mt-4 mb-12">Forgot password?</h3>
            <p class="has-text-weight-medium is-size-6 mb-5">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>

            <div class="is-relative mb-5">
              <input class="input py-5 has-background-white has-text-grey" type="email" name="email" name="email">
              <span class="span-label ml-3 has-background-white">Email</span>
              @error('email')
                <div class="has-text-danger mt-1">{{ $message }}</div>
              @enderror
            </div>     

            <div class="is-flex is-justify-content-end	mt-5 is-align-items-flex-end">
              <span class="is-inline-block has-text-grey-dark  mr-5"><a class="dark-pink" href="{{ route('home') }}">Back home</a></span>
              <button class="button is-danger has-text-warning-light">Email Password Reset Link</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection