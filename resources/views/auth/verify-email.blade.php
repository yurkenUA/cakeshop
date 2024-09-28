{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout> --}}


@extends('layouts.guest')

@section('content')

<section class="is-relative section has-background-light">
    <div class="is-relative container">
      <div class="columns is-vcentered">
        <div class="column is-5 m-auto">
          <div class="box p-6 px-10-desktop py-12-desktop has-background-white has-text-centered">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

              <h3 class="title has-text-danger is-4 mt-4 mb-12">Email verification</h3>
              <p class="has-text-weight-medium	is-size-6">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>
              @if (session('status'))
                <div class="has-text-success mt-1">{{ session('status') }}</div>
              @endif
              <div class="is-flex is-justify-content-space-between	mt-5 is-align-items-flex-end">
                <button class="button is-danger has-text-warning-light">Resend Verification Email</button>
                <span class="is-inline-block has-text-grey-dark  mr-5"><a class="dark-pink" href="{{ route('home') }}">Back home</a></span>
                <span class="is-inline-block  mr-5"><a class="dark-pink" href="#">Log out</a></span>
                
                
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  @endsection
