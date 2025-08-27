<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Service') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ route('vendor.services.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Title + Price -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Title -->
                            <div>
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" name="title" type="text"
                                    class="mt-1 block w-full"
                                    :value="old('title')"
                                    required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>

                            <!-- Price -->
                            <div>
                                <x-input-label for="price" :value="__('Price')" />
                                <x-text-input id="price" name="price" type="number" step="0.01"
                                    class="mt-1 block w-full"
                                    :value="old('price')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('price')" />
                            </div>
                        </div>

                        <!-- Category + Status -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Category -->
                            <div>
                                <x-input-label for="category_id" :value="__('Category')" />
                                <select id="category_id" name="category_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    required>
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                            </div>

                            <!-- Description -->
                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea id="description" name="description" rows="4"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    required>{{ old('description') }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>
                        </div>


                        <!-- Images -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Image One -->
                            <div>
                                <x-input-label for="image_one" :value="__('Image One')" />
                                <input id="image_one" name="image_one" type="file" accept="image/*"
                                    class="mt-1 block w-full text-sm text-gray-700" />
                                <x-input-error class="mt-2" :messages="$errors->get('image_one')" />
                            </div>

                            <!-- Image Two -->
                            <div>
                                <x-input-label for="image_two" :value="__('Image Two')" />
                                <input id="image_two" name="image_two" type="file" accept="image/*"
                                    class="mt-1 block w-full text-sm text-gray-700" />
                                <x-input-error class="mt-2" :messages="$errors->get('image_two')" />
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save Service') }}</x-primary-button>

                            <a href="{{ route('vendor.services.index') }}"
                                class="text-gray-600 hover:underline">
                                Cancel
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
