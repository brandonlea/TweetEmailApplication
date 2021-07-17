<div>
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
            <h1 class="text-center pt-11 text-3xl font-extrabold">
                Send someone an email!
            </h1>

            <p class="text-center">{{ $success_message }}</p>

            <form class="mt-8" method="POST" wire:submit.prevent="submitMessage">

                <div class="text-center w-6/12 p-10 m-auto">
                    <input wire:model="email" id="email" type="text" name="email" placeholder="Please enter a email" class="relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md mb-5 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10">

                    <textarea wire:model="message" id="message" name="message" placeholder="Please enter your email message." rows="8" class="relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10"></textarea>


                    <button type="submit" class="w-full bg-blue-600 mt-11 rounded text-white p-2 hover:bg-blue-800 font-medium focus:outline-none">
                        Send Email
                    </button>

                </div>

            </form>
        </div>
    </div>

</div>
