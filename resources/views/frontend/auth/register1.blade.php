<x-guest-layout>
    <div class="flex items-center justify-center bg-gray-100">
        <div class="bg-white shadow-lg rounded-2xl p-6 w-full max-w-md text-center space-y-6">

            <!-- Heading Block -->
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Choose your role</h1>
            </div>

            <!-- Buttons Block -->
            <div class="flex flex-col gap-4">
                <!-- Buyer Button -->
                <a href="{{ route('user.register', 'buyer') }}"
                   class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-black font-semibold rounded-xl shadow transition">
                    I’m Buyer
                </a>

                <!-- Seller Button -->
                <a href="{{ route('user.register', 'seller') }}"
                   class="px-6 py-3 bg-green-600 hover:bg-green-700 text-black font-semibold rounded-xl shadow transition">
                    I’m Seller
                </a>
            </div>

        </div>
    </div>
</x-guest-layout>
