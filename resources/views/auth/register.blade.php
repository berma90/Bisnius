<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-cover bg-center px-4"
        style="background-image: url('{{ asset('images/bg-login.png') }}');">

        <div class="bg-primary50 bg-opacity-90 px-10 py-8 w-full max-w-md shadow-md rounded-2xl sm:rounded-lg">
            
            <p class="text-white text-3xl font-bold text-center mb-6">Register</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-4">
                    <x-label for="name" class="text-white text-lg" value="Name" />
                    <x-input id="name" class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md" 
                        type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>

                <div class="mb-4">
                    <x-label for="email" class="text-white text-lg" value="Email" />
                    <x-input id="email" class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md" 
                        type="email" name="email" :value="old('email')" required autocomplete="username" />
                </div>

                <div class="mb-4">
                    <x-label for="password" class="text-white text-lg" value="Password" />
                    <x-input id="password" class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md" 
                        type="password" name="password" required autocomplete="new-password" />
                </div>

                <div class="mb-6">
                    <x-label for="password_confirmation" class="text-white text-lg" value="Confirm Password" />
                    <x-input id="password_confirmation" class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md" 
                        type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

                <div class="flex justify-end">
                    <x-button class="w-22 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 rounded-md">
                        Create
                    </x-button>
                </div>
            </form>

            <div class="text-center mt-6">
                <p class="text-white font-semibold text-lg">Already Have an Account?</p>
                <a href="/login" class="text-white text-sm hover:underline">Login Now</a>
            </div>

        </div>
    </div>
</x-guest-layout>
