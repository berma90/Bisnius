<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-cover bg-center" 
         style="background-image: url('{{ asset('images/bg-login.png') }}');">
    <x-authentication-card>
       

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <p class="text-white text-3xl font-bold text-center my-3">LOGIN</p>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div  class="flex flex-row items-center justify-center ">
                <x-label for="email" class="text-white text-[20px]" value="{{ __('Email') }}" />
                <x-input id="email" class="block my-3 w-full h-8 ml-12" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>
            <div class="flex flex-row items-center justify-center">
                <x-label for="password"  class="text-white  text-[20px]" value="{{ __('Password') }}" />
                <x-input id="password" class="block my-3 w-full h-8 ml-3" type="password" name="password" required autocomplete="current-password" />
            </div>


            <div class="flex items-center justify-end mx-2 mt-4">
                <a href="{{ route('oauth.google') }}" class="bg-white hover:bg-slate-200 p-1 rounded-2xl">
                    <img src="{{ asset('images/google.png')}}" class="w-10 h-10" alt="">
                </a>
                <x-button class="ms-4 bg-blue-600">
                    {{ __('Log in') }}
                </x-button>
                
            </div>
            <div class="text-white text-center mt-6">
                <p class="font-semibold">Doesn't Have Account?</p>
                <a href="/register" class="underline text-sm justify-center">Create Account Here</a>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
