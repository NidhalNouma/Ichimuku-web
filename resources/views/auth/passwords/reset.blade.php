@extends('layouts.app')

@section('content')
<div class="flex my-20">
    <div class="m-auto w-2/5 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
          <h3 class="mb-5 text-gray-700 font-bold ">{{ __('Reset Password') }}</h3>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-6">
                            <label for="email" class="block text-grey-darker text-sm font-bold mb-2">{{ __('E-Mail Address') }}</label>

                            <div class="">
                                <input id="email" type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="text-red-500 mt-3 text-xs italic" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="password" class="block text-grey-darker text-sm font-bold mb-2">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="text-red-500 mt-3 text-xs italic" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="password-confirm" class="block text-grey-darker text-sm font-bold mb-2">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="">
                                <button type="submit" class="text-btnTxt bg-prim font-bold py-2 px-4 rounded">
                                    {{ __('Reset Password') }}
                                </button>
                        </div>
                    </form>
                </div>
            </div>
</div>
@endsection
