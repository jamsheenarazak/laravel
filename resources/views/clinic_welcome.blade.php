@extends('welcome')
@section('content')
    <div class="flex bg-white" style="height:600px;">
        <div class="flex items-center text-center lg:text-left px-8 md:px-12 lg:w-1/2">
            <div>
                <h6 class="text-3xl font-semibold text-gray-800 md:text-4xl">Welcome </h6>
                <p class="mt-2 text-sm text-gray-500 md:text-base">We're building a layout using template inheritance. Blanditiis commodi cum cupiditate ducimus, fugit harum id necessitatibus odio quam quasi, quibusdam rem tempora voluptates. Cumque debitis dignissimos id quam vel!</p>
                <div class="flex justify-center lg:justify-start mt-6">
                    @if (Route::has('login'))
                        @auth
                            @else
                            <a id="login" href="{{ route('login') }}" class="mx-4 px-4 py-3 bg-gray-300 text-gray-900 text-xs font-semibold rounded hover:bg-gray-400">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-4 py-3 bg-gray-900 text-gray-200 text-xs font-semibold rounded hover:bg-gray-800">Register</a>
                            @endif
                        @endauth

                    @endif

                </div>
            </div>
        </div>
        <div class="hidden lg:block lg:w-1/2" style="clip-path:polygon(10% 0, 100% 0%, 100% 100%, 0 100%)">
            <div class="h-full object-cover" style="background-image: url(https://d1uhlocgth3qyq.cloudfront.net/provider-message-1232w___4b6fa.jpg)">
                <div class="h-full bg-black opacity-25"></div>
            </div>
        </div>

    </div>



@endsection
