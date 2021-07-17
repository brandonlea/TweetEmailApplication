<x-guest-layout>
    <div class="flex items-center justify-center bg-gray-100 mt-60">



        <div class="bg-white w-7/12 space-y-8 rounded shadow-sm border-gray-400 border-1">
            <div class="text-center pt-11">

                <h2 class="text-3xl font-extrabold">
                    {{ __('Please confirm your password.') }}
                </h2>
            </div>


            <form class="mt-8" method="post">
                @csrf

                <div class="text-center w-6/12 p-10 m-auto">


                    <label for="password">
                        <input type="password" name="password" placeholder="Please enter your password" class="relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md mb-5 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10">
                    </label>



                    <button type="submit" class="w-full bg-blue-600 mt-11 rounded text-white p-2 hover:bg-blue-800 font-medium focus:outline-none">
                        Proceed
                    </button>

                </div>

            </form>
        </div>
    </div>
</x-guest-layout>
