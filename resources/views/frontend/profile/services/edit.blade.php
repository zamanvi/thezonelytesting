@extends('frontend.layouts.__app')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-2xl p-8 border">

    <h2 class="text-3xl font-bold mb-6">Edit Service</h2>

    <form action="{{ route('user.services.update', $service->id) }}" method="POST"
        enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div>
            <label>Title *</label>
            <input type="text" name="title" value="{{ $service->title }}"
                class="w-full px-5 py-4 rounded-2xl border">
        </div>

        <!-- Price + Pricing Type -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="font-semibold">Price ($)</label>
                <input type="number" name="price" value="{{ $service->price }}" min="0" step="0.01"
                    class="w-full px-5 py-4 rounded-2xl border">
            </div>
            <div>
                <label class="font-semibold">Pricing Type</label>
                <select name="pricing_type" class="w-full px-5 py-4 rounded-2xl border bg-white">
                    @foreach(['starting_at'=>'starting at','per_month'=>'per month','per_hour'=>'per hour','flat_rate'=>'flat rate','free'=>'free','contact'=>'contact us'] as $val=>$lbl)
                    <option value="{{ $val }}" {{ ($service->pricing_type ?? 'starting_at') == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Category -->
        <div>
            <label>Category</label>
            <select name="category_id" class="w-full px-5 py-4 rounded-2xl border">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}"
                        {{ $service->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Images -->
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label>Image One</label>
                <input type="file" name="image_one">
                @if($service->image_one)
                    <img src="{{ asset($service->image_one) }}" class="h-20 mt-2 rounded">
                @endif
            </div>

            <div>
                <label>Image Two</label>
                <input type="file" name="image_two">
                @if($service->image_two)
                    <img src="{{ asset($service->image_two) }}" class="h-20 mt-2 rounded">
                @endif
            </div>
        </div>

        <!-- Features -->
        <div>
            <label class="font-semibold">Feature Bullet Points</label>
            <p class="text-xs text-slate-400 mb-2">One feature per line — shown as ✓ checkmarks on your public page</p>
            <textarea name="features" rows="4"
                placeholder="Federal & New York State Return&#10;Itemized deductions & credits&#10;EITC & Child Tax Credit optimization"
                class="w-full px-5 py-4 rounded-2xl border text-sm">{{ $service->features }}</textarea>
        </div>

        <!-- Description -->
        <div>
            <label class="font-semibold">Description</label>
            <textarea name="description" rows="4"
                class="w-full px-5 py-4 rounded-2xl border">{{ $service->description }}</textarea>
        </div>

        <!-- Status -->
        <div class="flex items-center gap-3">
            <input type="checkbox" name="is_active" value="1"
                {{ $service->is_active ? 'checked' : '' }}>
            <label>Active</label>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('user.services.index') }}" class="text-slate-500">← Back</a>

            <button class="bg-slate-900 text-white px-8 py-4 rounded-2xl font-bold hover:bg-blue-600">
                Update
            </button>
        </div>

    </form>
</div>
@endsection