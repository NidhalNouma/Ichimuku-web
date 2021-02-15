@extends('layouts.app')

@section('content')
<div class="container"><div class="flex mt-32">
    <div class="m-auto xl:w-2/5 sm:w-1/2 w-9/12 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
        <h3 class="mb-5 text-prim font-bold ">{{ __('Verify Your Email Address') }}</h3>

        <div class="mb-4">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="text-btnTxt bg-prim font-bold py-2 px-4 rounded">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
        </div>
</div>
@endsection
