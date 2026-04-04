@extends('frontend.layouts.__app')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-2xl p-8 border border-slate-100">

    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold">Languages</h2>

        <a href="{{ route('user.languages.create') }}"
           class="bg-slate-900 text-white px-6 py-3 rounded-2xl font-bold hover:bg-blue-600 transition">
            + Add Language
        </a>
    </div>

    <div class="space-y-4">
        @forelse($languages as $item)
            <div class="flex justify-between items-center p-5 bg-slate-50 rounded-2xl border">

                <span class="font-semibold text-lg">
                    {{ $item->name }}
                </span>

                <div class="flex gap-3">
                    <a href="{{ route('user.languages.edit', $item->id) }}"
                       class="px-4 py-2 bg-blue-500 text-white rounded-xl">
                        Edit
                    </a>

                    <form action="{{ route('user.languages.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button
                            onclick="return confirm('Are you sure?')"
                            class="px-4 py-2 bg-red-500 text-white rounded-xl">
                            Delete
                        </button>
                    </form>
                </div>

            </div>
        @empty
            <p class="text-slate-500">No languages added yet.</p>
        @endforelse
    </div>

</div>
@endsection