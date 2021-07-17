<x-guest-layout>
    <div class="flex items-center justify-center bg-gray-100 mt-60">
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">



            <form class="mt-8" method="post" action="{{route('verification.send')}}">
                @csrf

                <div class="text-center w-6/12 p-10 m-auto">


                    <button type="submit" class="w-full bg-blue-600 mt-11 rounded text-white p-2 hover:bg-blue-800 font-medium focus:outline-none">
                        {{ __('Resend Verification Email') }}
                    </button>

                </div>
            </form>

            <form class="mt-8" method="post" action="{{route('logout')}}">
                @csrf

                <div class="text-center w-6/12 p-10 m-auto">


                    <button type="submit" class="w-full bg-blue-600 mt-11 rounded text-white p-2 hover:bg-blue-800 font-medium focus:outline-none">
                        {{ __('Log Out') }}
                    </button>

                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
