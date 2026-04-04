@extends('frontend.profile.edit.layout')

@section('form')

<h2 class="text-3xl font-bold mb-6">Contact Options</h2>

<form method="POST" action="{{ route('save.seller.profile', ['type'=>$type,'setup'=>'contact']) }}">
@csrf

<div class="space-y-6">

    <div class="bg-white border rounded-3xl p-6 shadow-sm">
        <label class="block mb-2 font-semibold">Phone</label>
        <input type="text" name="phone" value="{{ $user->phone }}" class="input">

        <label class="flex items-center gap-2 mt-3">
            <input type="checkbox" name="show_phone" {{ $user->show_phone ? 'checked':'' }}>
            Show publicly
        </label>
    </div>

    <div class="bg-white border rounded-3xl p-6 shadow-sm">
        <label class="block mb-2 font-semibold">WhatsApp</label>
        <input type="text" name="whatsapp" value="{{ $user->whatsapp }}" class="input">
    </div>

</div>

<div class="flex justify-between mt-8">
    <a href="{{ route('type.profile', [$type,'service_location']) }}" class="text-slate-500">← Back</a>
    <button class="btn-primary">Save & Next →</button>
</div>

</form>

@endsection