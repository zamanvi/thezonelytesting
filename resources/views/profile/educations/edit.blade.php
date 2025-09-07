<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Edit Education') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="p-4 bg-red-100 text-red-700 rounded-lg shadow">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Edit Education Form -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700">Update Education</h3>
                </div>

                <form action="{{ route('profile.educations.update', $education->id) }}" method="POST" class="p-6 space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- Degree -->
                    <div>
                        <label for="degree" class="block text-sm font-medium text-gray-700">Degree</label>
                        <input type="text" name="degree" id="degree" value="{{ old('degree', $education->degree) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 sm:text-sm" required>
                    </div>

                    <!-- Institution -->
                    <div>
                        <label for="institution" class="block text-sm font-medium text-gray-700">Institution</label>
                        <input type="text" name="institution" id="institution" value="{{ old('institution', $education->institution) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 sm:text-sm" required>
                    </div>

                    <!-- Passing Year -->
                    <div>
                        <label for="passing_year" class="block text-sm font-medium text-gray-700">Passing Year</label>
                        <input type="number" name="passing_year" id="passing_year" value="{{ old('passing_year', $education->passing_year) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 sm:text-sm" required>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('profile.educations.index') }}" 
                           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-600 text-black rounded-md shadow hover:bg-blue-700 transition">
                            Update
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
