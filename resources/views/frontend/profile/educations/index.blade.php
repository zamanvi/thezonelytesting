@extends('frontend.layouts.__app')

@section('content')
<div class="max-w-5xl mx-auto bg-white rounded-3xl shadow-2xl p-8 border border-slate-100">

    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold">Education</h2>

        <a href="{{ route('user.educations.create') }}"
           class="bg-slate-900 text-white px-6 py-3 rounded-2xl font-bold hover:bg-blue-600 transition">
            + Add Education
        </a>
    </div>

    <div class="space-y-4">
        @forelse($educations as $item)
            <div class="p-6 bg-slate-50 rounded-2xl border flex justify-between items-center">

                <div>
                    <h3 class="font-bold text-lg">{{ $item->degree }}</h3>
                    <p class="text-sm text-slate-500">
                        {{ $item->institution ?? 'N/A' }} • {{ $item->passing_year ?? 'N/A' }}
                    </p>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('user.educations.edit', $item->id) }}"
                       class="px-4 py-2 bg-blue-500 text-white rounded-xl">
                        Edit
                    </a>

                    <form action="{{ route('user.educations.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button onclick="return confirm('Delete this?')"
                            class="px-4 py-2 bg-red-500 text-white rounded-xl">
                            Delete
                        </button>
                    </form>
                </div>

            </div>
        @empty
            <p class="text-slate-500">No education added yet.</p>
        @endforelse
    </div>

</div>
@endsection