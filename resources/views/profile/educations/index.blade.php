<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('My Educations') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Success Message -->
            @if(session('success'))
                <div class="p-4 bg-green-100 text-green-800 rounded-lg shadow">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Add Education Button -->
            <div class="flex justify-end">
                <a href="{{ route('profile.educations.create') }}" class="p-2 bg-blue-600 text-black rounded-lg shadow hover:bg-blue-700 transition">
                    + Add Education
                </a>
            </div>

            <!-- Education Table Card -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-2 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700">Education Records</h3>
                </div>

                <div class="overflow-x-auto">
                    @if($educations->count())
                        <table class="w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="text-left text-black-500 uppercase">Degree</th>
                                    <th class="text-left text-black-500 uppercase">Institution</th>
                                    <th class="text-left text-black-500 uppercase">Passing Year</th>
                                    <th class="text-center text-black-500 uppercase">Actions</th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($educations as $education)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $education->degree }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $education->institution }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $education->passing_year }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center space-x-2">
                                            <a href="{{ route('profile.educations.edit', $education->id) }}" class="px-3 py-1 rounded-lg shadow hover:bg-yellow-500 transition">
                                                Edit
                                            </a>

                                            <form action="{{ route('profile.educations.destroy', $education->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this education?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-1 text-red-600 rounded-lg shadow hover:bg-red-700 transition">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="px-6 py-4">
                            {{ $educations->links() }}
                        </div>
                    @else
                        <p class="px-6 py-4 text-gray-500">You have no education records yet.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
