@extends('layouts.app')

@section('content')
<div class="flex mt-32">
    <div class="m-auto xl:w-2/5 sm:w-1/2 w-9/12 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
                <h3 class="mb-5 text-prim font-bold ">{{ __('Register') }}</h3>

                <div class="mb-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-6">
                            <label for="name" class="block text-lbl text-sm font-bold mb-2">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="focus:outline-none focus:border-axc shadow appearance-none border rounded w-full py-2 px-3 text-txt" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="text-red-500 mt-3 text-xs italic" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="email" class="block text-lbl text-sm font-bold mb-2">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="focus:outline-none focus:border-axc shadow appearance-none border rounded w-full py-2 px-3 text-txt" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="text-red-500 mt-3 text-xs italic" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="password" class="block text-lbl text-sm font-bold mb-2">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="focus:outline-none focus:border-axc shadow appearance-none border rounded w-full py-2 px-3 text-txt" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="text-red-500 mt-3 text-xs italic" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="password-confirm" class="block text-lbl text-sm font-bold mb-2">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="focus:outline-none focus:border-axc shadow appearance-none border rounded w-full py-2 px-3 text-txt" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="">
                                <button type="submit" class="text-btnTxt bg-prim font-bold py-2 px-4 rounded">
                                    {{ __('Register') }}
                                </button>
                        </div>
                    </form>
                </div>
    </div>
</div>
@endsection
