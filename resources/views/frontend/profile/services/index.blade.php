@extends('frontend.layouts.__app')

@section('content')
<div class="max-w-6xl mx-auto bg-white rounded-3xl shadow-2xl p-8 border border-slate-100">

    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold">My Services</h2>

        <a href="{{ route('user.services.create') }}"
           class="bg-slate-900 text-white px-6 py-3 rounded-2xl font-bold hover:bg-blue-600 transition">
            + Add Service
        </a>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($services as $service)
            <div class="bg-slate-50 rounded-2xl border p-4 shadow-sm">

                <!-- Image -->
                <img src="{{ asset($service->image_one ?? 'default.png') }}"
                     class="w-full h-40 object-cover rounded-xl mb-4">

                <!-- Content -->
                <h3 class="font-bold text-lg">{{ $service->title }}</h3>

                <p class="text-sm text-slate-500 mt-1">
                    ৳ {{ $service->price ?? 'N/A' }}
                </p>

                <p class="text-xs mt-2 {{ $service->is_active ? 'text-green-600' : 'text-red-500' }}">
                    {{ $service->is_active ? 'Active' : 'Inactive' }}
                </p>

                <!-- Actions -->
                <div class="flex justify-between mt-4">
                    <a href="{{ route('user.services.edit', $service->id) }}"
                       class="px-4 py-2 bg-blue-500 text-white rounded-xl text-sm">
                        Edit
                    </a>

                    <form action="{{ route('user.services.destroy', $service->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button onclick="return confirm('Delete service?')"
                            class="px-4 py-2 bg-red-500 text-white rounded-xl text-sm">
                            Delete
                        </button>
                    </form>
                </div>

            </div>
        @empty
            <p class="text-slate-500">No services found.</p>
        @endforelse
    </div>

</div>
@endsection