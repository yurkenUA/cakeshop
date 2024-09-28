{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirm') }}
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
          <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <h3 class="title has-text-danger is-4 mt-4 mb-12">Confirm password</h3>
            <p class="has-text-weight-medium is-size-6 mb-5">This is a secure area of the application. Please confirm your password before continuing.</p>

            <div class="is-relative mb-5">
                <input class="input py-5 has-background-white has-text-grey" type="password" placeholder="******" name="password">
                <span class="span-label ml-3 has-background-white">Password</span>
                @error('password')
                  <div class="has-text-danger mt-1">{{ $message }}</div>
                @enderror
              </div>   

            <div class="is-flex is-justify-content-end	mt-5 is-align-items-flex-end">
              <span class="is-inline-block has-text-grey-dark  mr-5"><a class="dark-pink" href="{{ route('home') }}">Back home</a></span>
              <button class="button is-danger has-text-warning-light">Confirm</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection