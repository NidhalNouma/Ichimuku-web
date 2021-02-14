@extends('layouts.app')

@section('content')
<div class="flex my-20">
    <div class="m-auto xl:w-2/5 sm:w-1/2 w-9/12 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
                <h3 class="mb-5 text-prim font-bold ">{{ __('Login') }}</h3>

                <div class="mb-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-6">
                            <label for="email" class="block text-lbl text-sm font-bold mb-2">{{ __('E-Mail Address') }}</label>

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
                            <label for="password" class="block text-lbl text-sm font-bold mb-2">{{ __('Password') }}</label>

                            <div class="">
                                <input id="password" type="password" class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="text-red-500 mt-3 text-xs italic" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                                <div class="mb-5">
                                    <input class="text-lbl" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="text-lbl" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>

                            <div class="flex items-center justify-between">
                                <button type="submit" class="text-btnTxt bg-prim font-bold py-2 px-4 rounded">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="inline-block align-baseline font-bold text-sm text-prim hover:text-lbl" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                    </form>
                </div>
    </div>
</div>
@endsection
