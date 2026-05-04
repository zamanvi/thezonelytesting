@props([
    'title',
    'desc',
    'icon',
    'done' => false,
    'href' => '#',
    'required' => false,
])

<a href="{{ $href }}"
   class="flex items-start gap-4 bg-white rounded-3xl border-2 p-6 shadow-sm hover:shadow-md transition-all group
          {{ $done ? 'border-green-200 bg-green-50/30' : 'border-slate-100 hover:border-blue-200' }}">

    {{-- Icon --}}
    <div class="w-12 h-12 rounded-2xl flex items-center justify-center shrink-0
                {{ $done ? 'bg-green-100' : 'bg-blue-50 group-hover:bg-blue-100' }} transition">
        @if($done)
            <i class="fa-solid fa-circle-check text-green-500 text-lg"></i>
        @else
            <i class="fa-solid {{ $icon }} text-blue-600 text-lg"></i>
        @endif
    </div>

    {{-- Text --}}
    <div class="flex-1 min-w-0">
        <div class="flex items-center gap-2 mb-0.5">
            <h3 class="font-bold text-slate-900 text-base">{{ $title }}</h3>
            @if($required && !$done)
                <span class="text-xs bg-red-50 text-red-500 font-bold px-2 py-0.5 rounded-full">Required</span>
            @endif
            @if($done)
                <span class="text-xs bg-green-100 text-green-600 font-bold px-2 py-0.5 rounded-full">Complete</span>
            @endif
        </div>
        <p class="text-sm text-slate-500 leading-relaxed">{{ $desc }}</p>
    </div>

    {{-- Arrow --}}
    <div class="shrink-0 self-center">
        @if($done)
            <i class="fa-solid fa-pen text-slate-300 group-hover:text-green-500 text-xs transition"></i>
        @else
            <i class="fa-solid fa-arrow-right text-slate-300 group-hover:text-blue-600 text-xs transition"></i>
        @endif
    </div>

</a>
