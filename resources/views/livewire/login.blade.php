<div class="flex items-center justify-center bg-gray-100 mt-60">



    <div class="bg-white w-7/12 space-y-8 rounded shadow-sm border-gray-400 border-1">
        <div class="text-center pt-11">

            <h2 class="text-3xl font-extrabold">
                {{ __('Sign-in') }}
            </h2>
            or
            <a href="{{route('register')}}" class="text-center font-medium text-blue-700">
                you need an account.
            </a>
        </div>


        <form class="mt-8" method="post">
            @csrf

            <div class="text-center w-6/12 p-10 m-auto">

                <label for="email">
                    <input id="email" name="email" type="email" placeholder="Please enter a email" class="relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md mb-5 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10">
                </label>

                <label for="password">
                    <input type="password" name="password" placeholder="Please enter a password" class="relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md mb-5 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10">
                </label>


                <div class="float-left mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>


                <button type="submit" class="w-full bg-blue-600 mt-11 rounded text-white p-2 hover:bg-blue-800 font-medium focus:outline-none">
                    Sign-in
                </button>

            </div>

        </form>
    </div>
</div>