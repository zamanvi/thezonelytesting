<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('My Contacts') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="p-4 bg-green-100 text-green-800 rounded-lg shadow">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-end">
                <a href="{{ route('profile.contacts.create') }}" 
                   class="p-2 text-blue-600 rounded-lg shadow hover:bg-blue-700 transition">
                    + Add Contact
                </a>
            </div>

            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-2 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700">Contact Records</h3>
                </div>

                <div class="overflow-x-auto">
                    @if($contacts->count())
                        <table class="w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase">Type</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase">Value</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium text-gray-600 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-100 divide-y divide-gray-200">
                                @foreach($contacts as $contact)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 text-gray-700 capitalize">{{ $contact->type }}</td>
                                        <td class="px-6 py-4 text-gray-700">{{ $contact->value }}</td>
                                        <td class="px-6 py-4 text-center space-x-2">
                                            <a href="{{ route('profile.contacts.edit', $contact->id) }}" 
                                               class="px-3 py-1 text-black rounded-lg shadow hover:bg-yellow-600 transition">
                                                Edit
                                            </a>
                                            <form action="{{ route('profile.contacts.destroy', $contact->id) }}" method="POST" class="inline-block"
                                                  onsubmit="return confirm('Are you sure you want to delete this contact?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="px-3 py-1 text-red-600 rounded-lg shadow hover:bg-red-700 transition">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="px-6 py-4">
                            {{ $contacts->links() }}
                        </div>
                    @else
                        <p class="px-6 py-4 text-gray-500">You have no contact records yet.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
