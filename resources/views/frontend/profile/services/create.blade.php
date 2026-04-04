@extends('frontend.layouts.__app')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-2xl p-8 border">

    <h2 class="text-3xl font-bold mb-6">Create Service</h2>

    <form action="{{ route('user.services.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Title -->
        <div>
            <label class="font-semibold">Title *</label>
            <input type="text" name="title" required
                class="w-full px-5 py-4 rounded-2xl border focus:ring-4 focus:ring-blue-100">
        </div>

        <!-- Price -->
        <div>
            <label class="font-semibold">Price</label>
            <input type="text" name="price"
                class="w-full px-5 py-4 rounded-2xl border">
        </div>

        <!-- Category -->
        <div>
            <label class="font-semibold">Category *</label>
            <select name="category_id" required
                class="w-full px-5 py-4 rounded-2xl border">
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                @endforeach
            </select>
        </div>

        <!-- Images -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label>Image One</label>
                <input type="file" name="image_one" class="w-full">
            </div>
            <div>
                <label>Image Two</label>
                <input type="file" name="image_two" class="w-full">
            </div>
        </div>

        <!-- Description -->
        <div>
            <label class="font-semibold">Description</label>
            <textarea name="description" rows="5"
                class="w-full px-5 py-4 rounded-2xl border"></textarea>
        </div>

        <!-- Status -->
        <div class="flex items-center gap-3">
            <input type="checkbox" name="is_active" value="1" checked>
            <label>Active</label>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('user.services.index') }}" class="text-slate-500">← Back</a>

            <button class="bg-slate-900 text-white px-8 py-4 rounded-2xl font-bold hover:bg-blue-600">
                Save
            </button>
        </div>

    </form>
</div>
@endsection