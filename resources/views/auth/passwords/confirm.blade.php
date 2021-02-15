@extends('layouts.app')

@section('content')
<div class="flex my-20">
    <div class="m-auto w-2/5 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
          <h3 class="mb-5 text-gray-700 font-bold ">{{ __('Confirm Password') }}</h3>

                <div class="card-body">
                    {{ __('Please confirm your password before continuing.') }}

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="focus:outline-none focus:border-axc form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="text-red-500 mt-3 text-xs italic" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="text-btnTxt bg-prim font-bold py-2 px-4 rounded">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
    </div>
</div>
@endsection
