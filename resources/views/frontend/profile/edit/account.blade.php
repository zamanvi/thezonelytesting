@extends('frontend.profile.edit.layout')

@section('form')

<h2 class="text-3xl font-bold mb-6">Update Account Info</h2>

<form method="POST" action="{{ route('save.seller.profile', ['type'=>$type,'setup'=>'account']) }}">
    @csrf

    <div class="grid md:grid-cols-2 gap-6">

        <input type="text" name="name"
            value="{{ old('name',$user->name) }}"
            placeholder="Full Name"
            class="input">

        <input type="text" name="business_name"
            value="{{ old('business_name',$user->business_name) }}"
            placeholder="Business Name"
            class="input">

        <input type="text" name="phone"
            value="{{ old('phone',$user->phone) }}"
            placeholder="Phone"
            class="input md:col-span-2">

    </div>

    <div class="flex justify-end mt-8">
        <button class="btn-primary">Save & Next →</button>
    </div>

</form>

@endsection