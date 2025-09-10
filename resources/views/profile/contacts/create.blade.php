<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Add Contact') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6">

                <form method="POST" action="{{ route('profile.contacts.store') }}">
                    @csrf

                    <!-- Type -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Type</label>
                        <select name="type" class="w-full border-gray-300 rounded-lg shadow-sm">
                            <option value="email">Email</option>
                            <option value="phone">Phone</option>
                            <option value="address">Address</option>
                        </select>
                        @error('type') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <!-- Value -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Value</label>
                        <input type="text" name="value" value="{{ old('value') }}" 
                               class="w-full border-gray-300 rounded-lg shadow-sm">
                        @error('value') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('profile.contacts.index') }}" class="px-4 py-2 bg-gray-300 rounded-lg mr-2">Cancel</a>
                        <button type="submit" class="px-4 py-2 text-blue-600 rounded-lg shadow hover:bg-blue-700">
                            Save
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
