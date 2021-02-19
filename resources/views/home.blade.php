@extends('layouts.apph')

@section('content')

    <svg class="absolute h-full left-0 right-0 top-0" style="z-index: -10" xmlns="http://www.w3.org/2000/svg"
        viewBox="0 -1 23 18">
        <path d="M 0 0 C 2 14 18 -1 23 16 M 21 0 C 14 0 14 17 2 15 M 6 17 C -1 6 20 7 14 -1 M 5 0 C -1 6 24 7 20 16"
            stroke="#b4c6d0" stroke-width="0.008" fill="none" />
    </svg>
    <svg class="absolute h-full left-10 right-0 bottom-0" style="z-index: -10" xmlns="http://www.w3.org/2000/svg"
        viewBox="0 -1 23 18">
        <path d="M 0 0 C 2 14 18 -1 23 16 M 21 0 C 14 0 14 17 2 15 M 6 17 C -1 6 20 7 14 -1 M 5 0 C -1 6 24 7 20 16"
            stroke="#b4c6d0" stroke-width="0.008" fill="none" />
    </svg>
    <div class="mt-20">

        <section class="text-gray-600 body-font overflow-hidden">
            <div class="text-center pt-4">

                @if (session('status'))
                    <div class="my-5 w-1/2 mx-auto bg-orange-200 border-l-4 border-orange-500 text-orange-700 p-4 relative"
                        role="alert">
                        <p class="block sm:inline">{{ session('status') }}</p>
                    </div>
                @endif
                <div id="app" class="mt-8">
                    <app csrf="{{ csrf_token() }}" usr="{{ Auth::user() }}" sesson="{{ session('status') }}">
                    </app>
                </div>
            </div>
        </section>
    </div>

    <!-- Scripts -->
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('js/vue.js') }}"></script>

@endsection
