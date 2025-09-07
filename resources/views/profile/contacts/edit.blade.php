<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Edit Contact') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6">

                <form method="POST" action="{{ route('profile.contacts.update', $contact->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Type -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Type</label>
                        <select name="type" class="w-full border-gray-300 rounded-lg shadow-sm">
                            <option value="email" {{ $contact->type == 'email' ? 'selected' : '' }}>Email</option>
                            <option value="phone" {{ $contact->type == 'phone' ? 'selected' : '' }}>Phone</option>
                            <option value="address" {{ $contact->type == 'address' ? 'selected' : '' }}>Address</option>
                        </select>
                        @error('type') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <!-- Value -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Value</label>
                        <input type="text" name="value" value="{{ old('value', $contact->value) }}" 
                               class="w-full border-gray-300 rounded-lg shadow-sm">
                        @error('value') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('profile.contacts.index') }}" class="px-4 py-2 bg-gray-300 rounded-lg mr-2">Cancel</a>
                        <button type="submit" class="px-4 py-2 text-black rounded-lg shadow hover:bg-blue-700">
                            Update
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
