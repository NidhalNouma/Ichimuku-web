@extends('layouts.apph')

@section('content')

    <script src="https://js.stripe.com/v3/"></script>
    <div class="mt-20">

        <section class="text-gray-600 body-font overflow-hidden ">
            <div class="text-center pt-4">

                @if (session('status'))
                    <div class="my-5 w-1/2 mx-auto bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                        role="alert">
                        <strong class="font-bold">Something wrong!</strong>
                        <span class="block sm:inline">{{ session('status') }}</span>
                    </div>
                @endif

                <div id="app" class="mt-8">
                    <app>
                    </app>
                </div>
            </div>
        </section>
    </div>


    <!-- Scripts -->
    <script src="{{ asset('js/vue.js') }}"></script>
    {{-- <script src="https://js.stripe.com/v3/"></script> --}}
@endsection
