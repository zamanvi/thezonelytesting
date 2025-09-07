<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('My Memberships') }}
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
                <a href="{{ route('profile.memberships.create') }}" 
                   class="p-2 bg-blue-600 text-black rounded-lg shadow hover:bg-blue-700 transition">
                    + Add Membership
                </a>
            </div>

            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-2 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700">Membership Records</h3>
                </div>

                <div class="overflow-x-auto">
                    @if($memberships->count())
                        <table class="w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase">Name</th>
                                    <th class="px-6 py-3 text-center text-sm font-medium text-gray-600 uppercase">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-100 divide-y divide-gray-200">
                                @foreach($memberships as $membership)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 text-gray-700">{{ $membership->name }}</td>
                                        <td class="px-6 py-4 text-center space-x-2">
                                            <a href="{{ route('profile.memberships.edit', $membership->id) }}" 
                                               class="px-3 py-1 text-black rounded-lg shadow hover:bg-yellow-500 transition">
                                                Edit
                                            </a>
                                            <form action="{{ route('profile.memberships.destroy', $membership->id) }}" method="POST" class="inline-block" 
                                                  onsubmit="return confirm('Are you sure you want to delete this membership?');">
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
                            {{ $memberships->links() }}
                        </div>
                    @else
                        <p class="px-6 py-4 text-gray-500">You have no membership records yet.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
