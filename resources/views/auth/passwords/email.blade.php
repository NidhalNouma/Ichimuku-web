@extends('layouts.app')

@section('content')
<div class="flex my-20">
    <div class="m-auto w-2/5 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
          <h3 class="mb-5 text-prim font-bold ">{{ __('Reset Password') }}</h3>

                <div class="">
                    @if (session('status'))
                        <div class="text-red-500 mt-3 text-xs italic" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-6">
                            <label for="email" class="block text-lbl text-sm font-bold mb-2">{{ __('E-Mail Address') }}</label>

                            <div class="">
                                <input id="email" type="email" class="focus:outline-none focus:border-axc  shadow appearance-none border rounded w-full py-2 px-3 text-txt" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="text-red-500 mt-3 text-xs italic" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="">
                                <button type="submit" class="text-btnTxt bg-prim font-bold py-2 px-4 rounded">
                                      {{ __('Send Password Reset Link') }}
                                </button>
                        </div>
                    </form>
                </div>
            </div>

</div>
@endsection
