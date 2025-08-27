<x-app-layout>
    <x-slot name="header">
        <div class="mb-4 flex justify-between items-center">
            <h2 class="text-lg font-semibold">
                {{ __("Total Services: ") . $services->total() }}
            </h2>
            <a href="{{ route('vendor.services.create') }}" 
                class="px-4 py-2 bg-blue-600 text-black rounded-lg hover:bg-blue-700">
                + Add New Service
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">                
                    @if($services->count() > 0)
                        <table class="min-w-full border border-gray-200 text-sm">
                            <thead>
                                <tr class="bg-gray-100 text-left">
                                    <th class="px-4 py-2 border">#</th>
                                    <th class="px-4 py-2 border">Title</th>
                                    <th class="px-4 py-2 border">Price</th>
                                    <th class="px-4 py-2 border">Category</th>
                                    <th class="px-4 py-2 border">Status</th>
                                    <th class="px-4 py-2 border">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($services as $index => $service)
                                    <tr>
                                        <td class="px-4 py-2 border">{{ $services->firstItem() + $index }}</td>
                                        <td class="px-4 py-2 border">{{ $service->title }}</td>
                                        <td class="px-4 py-2 border">${{ number_format($service->price, 2) }}</td>
                                        <td class="px-4 py-2 border">{{ $service->category?->name ?? '-' }}</td>
                                        <td class="px-4 py-2 border">
                                            @if($service->is_active)
                                                <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded">Active</span>
                                            @else
                                                <span class="px-2 py-1 text-xs bg-red-100 text-red-700 rounded">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 border">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('vendor.services.show', $service->id) }}" 
                                                   class="text-blue-600 hover:underline">View</a>
                                                <a href="{{ route('vendor.services.edit', $service->id) }}" 
                                                   class="text-yellow-600 hover:underline">Edit</a>
                                                <form action="{{ route('vendor.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $services->links() }}
                        </div>
                    @else
                        <p class="text-gray-600">You haven’t added any services yet.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
