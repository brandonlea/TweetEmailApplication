<x-guest-layout>

    <div class="w-6/12 text-center m-auto">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Holy smokes!</strong>
                    <span class="block sm:inline">{{ $error }}</span>
                </div>
            @endforeach
        @endif
    </div>

    <div class="flex items-center justify-center bg-gray-100 mt-60">

        <div class="bg-white w-7/12 space-y-8 rounded shadow-sm border-gray-400 border-1">
            <div class="text-center pt-11">
                <p class=" font-extrabold">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </p>
            </div>



            @if (session('status') == 'verification-link-sent')
                <div class="text-center pt-11">
                    <p class="font-extrabold">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </p>
                </div>
            @endif

            <form class="mt-8" method="post" action="{{route('verification.send')}}">
                @csrf

                <div class="text-center w-6/12 m-auto">


                    <button type="submit" class="w-6/12 mt-11 rounded text-blue-500 p-2 font-medium focus:outline-none">
                        {{ __('Resend Verification Email') }}
                    </button>

                </div>
            </form>

            <form method="post" action="{{route('logout')}}">
                @csrf

                <div class="text-center w-6/12 p-10 m-auto">


                    <button type="submit" class="w-6/12 bg-blue-600 mt-11 rounded text-white p-2 hover:bg-blue-800 font-medium focus:outline-none">
                        {{ __('Log Out') }}
                    </button>

                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
