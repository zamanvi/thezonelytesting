@php
    $meta_title = $user->name . ' - ' . $user->designation;
    $meta_description = $user->name . ' - ' . $user->designation . ' - ' . ($user->about ?? '');
@endphp
@extends('frontend.layouts._app')
@section('title', $meta_title)

@section('content')
    <main class="max-w-7xl mx-auto px-6 pt-32 pb-10">

        <div class="relative mb-12">
            <div class="flex flex-col lg:flex-row gap-12 items-end">
                <div class="relative group">
                    <div
                        class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-violet-600 rounded-[3rem] blur opacity-25 group-hover:opacity-50 transition duration-1000">
                    </div>
                    <div
                        class="relative w-64 h-80 md:w-80 md:h-[420px] bg-slate200 rounded-[2.8rem] overflow-hidden border-4 border-white shadow2xl">
                        <img src="{{ $user->profile_photo }}" class="w-full h-full object-cover" alt="Attorney">
                    </div>
                </div>

                <div class="flex-1 pb-4">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 roundedfull bg-blue-50 text-blue-600 text-[10px] font-bold uppercase trackingwidest mb-6">
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bgblue-600"></span>
                        </span>
                        Verified Senior Associate
                    </div>
                    <h2 class="font-serif text-5xl md:text-7xl text-slate-900 mb-6 leading-[1.1]">{{ $user->title }}</h2>
                    {{-- <p class="max-w-xl text-lg text-slate-500 font-medium leadingrelaxed">
                        {{ $user->title }}
                    </p> --}}
                    <blockquote
                        class="border-l-4 border-blue-600 pl-6 italic text-slate-900 font-medium bg-slate-50 py-4 rounded-r-2xl text-center">
                        <strong>"{{ $user->bio }}"</strong>
                    </blockquote>
                    <h2 class="font-serif text-5xl md:text-7xl text-slate-900 mb-6 leading-[1.1]">Service Tag</h2>
                    @if (!empty($user->tags))
                        @php
                            $tags = array_filter(array_map('trim', explode(',', $user->tags)));
                        @endphp

                        @if (count($tags))
                            <div class="mt-10">

                                {{-- Title --}}
                                <h3 class="text-lg font-semibold text-slate-800 mb-4">
                                    People also searched for
                                </h3>

                                {{-- Tags --}}
                                <div class="flex flex-wrap gap-3">
                                    @foreach ($tags as $tag)
                                        <div
                                            class="flex items-center gap-2 px-4 py-2 rounded-full border border-slate-300 text-sm text-slate-700 bg-white hover:bg-slate-100 transition cursor-pointer">

                                            {{-- Icon --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 21l-4.35-4.35M16.65 10.65a6 6 0 11-12 0 6 6 0 0112 0z" />
                                            </svg>

                                            {{-- Tag Text --}}
                                            <span>{{ ucfirst($tag) }}</span>

                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            <div class="lg:col-span-8 space-y-10">

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bento-card bg-white p-6 rounded-[2rem] border border-slate-100">
                        <p class="text-[10px] font-bold text-slate-400 uppercase mb2">Experience</p>
                        <p class="text-2xl font-bold">5+ Yrs</p>
                    </div>
                    <div class="bento-card bg-blue-600 p-6 rounded-[2rem] textwhite">
                        <p class="text-[10px] font-bold opacity-70 uppercase mb2">Success Rate</p>
                        <p class="text-2xl font-bold">98%</p>
                    </div>
                    <div class="bento-card bg-white p-6 rounded-[2rem] border border-slate-100">
                        <p class="text-[10px] font-bold text-slate-400 uppercase mb2">Cases Won</p>
                        <p class="text-2xl font-bold">450+</p>
                    </div>
                    <div class="bento-card bg-slate-600 p-6 rounded-[2rem] textwhite">
                        <p class="text-[10px] font-bold opacity-70 uppercase mb2">Response</p>
                        <p class="text-2xl font-bold">&lt; 2h</p>
                    </div>
                </div>
                <section
                    class="bg-white rounded-[3rem] p-10 md:p-14 border border-slate-100 shadow-sm relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-8 opacity-[0.03]">
                        <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16
                                        16.017 16H19.017V14C19.017 11.2386 16.7784 9 14.017 9V7C17.883 7
                                        21.017 10.134 21.017 14V21H14.017ZM3.01709 21L3.01709
                                        18C3.01709 16.8954 3.91252 16 5.01709 16H8.01709V14C8.01709
                                        11.2386 5.77851 9 3.01709 9V7C6.88309 7 10.0171 10.134 10.0171
                                        14V21H3.01709Z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold mb-8">About</h2>
                    <div class="prose prose-slate lg:prose-lg max-w-none text-slate600 leading-relaxed text-justify">
                        <p class="mb-6">{{ $user->name }}
                            <strong>{{ $user->title }}</strong>,
                            {{ $user->about ?? 'No about information available.' }}
                        </p>
                    </div>
                </section>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                    <div class="bg-white p-8 rounded-[2.5rem] border border-slate100">
                        <h3 class="text-sm font-bold uppercase tracking-widest textblue-600 mb-6">Academic Excellence
                        </h3>
                        <div class="space-y-6">
                            @forelse($user->educations as $education)
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-20 h-8 rounded-xl bg-blue-50 flex itemscenter justify-center text-blue-600 font-bold shrink-0">
                                        {{ $education->degree }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-900">
                                            {{ $education->institution ? ' from ' . $education->institution : '' }}</p>
                                    </div>
                                </div>
                            @empty
                                <li>No education records available.</li>
                            @endforelse
                        </div>
                    </div>
                    <div class="bg-slate-900 p-8 rounded-[2.5rem] text-white">
                        <h3 class="text-sm font-bold uppercase tracking-widest textblue-400 mb-6">Working Zone</h3>
                        <div class="space-y-4">
                            @forelse($user->memberships as $membership)
                                <div class="py-1 border-b border-slate-200">

                                    {{-- Title --}}
                                    <p class="text-base font-semibold text-slate-600">
                                        {{ $membership->name }}
                                    </p>

                                    {{-- Date (only if exists) --}}
                                    @if ($membership->start || $membership->end)
                                        <p class="text-sm text-slate-500">
                                            {{ $membership->start ?? '' }}
                                            @if ($membership->start && $membership->end)
                                                -
                                            @endif
                                            {{ $membership->end ?? 'Present' }}
                                        </p>
                                    @endif

                                    {{-- Address (only if exists) --}}
                                    @if (!empty($membership->address))
                                        <p class="text-sm text-slate-500">
                                            {{ $membership->address }}
                                        </p>
                                    @endif

                                </div>
                            @empty
                                <p class="text-sm text-slate-400 italic">
                                    No membership records available.
                                </p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-4 lg:sticky lg:top-32 h-fit">
                <div
                    class="mt-5 bg-white rounded-[3rem] border border-slate-200 p-8 shadow-2xl shadow-blue-500/5 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-2 animategradient"></div>

                    <h3 class="text-2xl font-bold mb-2">Work with {{ $user->name }}</h3>
                    <p class="text-slate-500 text-sm mb-8">Submit your case for a
                        15-min priority review.</p>

                    {{-- <form id="hubspotForm" class="space-y-5">
                        <div class="space-y-1">
                            <input type="text" name="firstname" required
                                class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm focus:ring2 focus:ring-blue-500 focus:bg-white outline-none transition-all"
                                placeholder="Full Name">
                        </div>
                        <div class="space-y-1">
                            <input type="tel" name="phone" required
                                class="w-full bgslate-50 border border-slate-200 rounded-2xl p-4 text-sm focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition-all"
                                placeholder="Phone Number">
                        </div>
                        <div class="space-y-1">
                            <textarea name="message" required rows="4"
                                class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 text-sm focus:ring2 focus:ring-blue-500 focus:bg-white outline-none transition-all"
                                placeholder="Tell us about your case..."></textarea>
                        </div>
                        <button type="submit" id="submitBtn"
                            class="group w-full bgslate-900 text-white font-bold py-5 rounded-2xl transition-all hover:bgblue-600 flex items-center justify-center gap-2">
                            Submit Inquiry
                            <svg class="w-4 h-4 group-hover:translate-x-1 transitiontransform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" strokewidth="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                        <p id="successMsg"
                            class="hidden text-emerald-600 text-[11px] font-bold text-center bg-emerald-50 py-2 rounded-lg">
                            ✅
                            Received. We will reach out shortly.</p>
                    </form> --}}
                    <div class="mt-8 space-y-3">
                        @forelse($user->contacts as $contact)
                            {{-- <a href="tel:+16465550198" onclick="trackDirectLead('PhoneCall')" --}}
                            <a href="#"
                                class="flex items-center justify-center gap-3 w-full bg-blue-50 text-blue-700 font-bold py-4 rounded-2xl hover:bg-blue-100 transitionall text-sm">
                                {{ $contact->value }}
                            </a>
                        @empty
                            <li>No contact information available.</li>
                        @endforelse
                    </div>
                    <p class="mt-6 text-[10px] text-center text-slate-400 fontmedium uppercase tracking-widest">Secured
                        by Zonely Cloud
                        Encryption</p>
                </div>
                <div class="bg-slate-900 p-8 rounded-[2.5rem] text-white">
                    <h3 class="text-sm font-bold uppercase tracking-widest textblue-400 mb-6">Languages</h3>
                    <div class="space-y-4">
                        @forelse($user->languages as $language)
                            <div class="flex items-center gap-3 p-3 rounded-2xl bgwhite/5 border border-white/10">
                                <div class="w-2 h-2 rounded-full bg-emerald-400"></div>
                                <span class="text-sm font-semibold">{{ $language->name }}</span>
                            </div>
                        @empty
                            <li>No languages listed.</li>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
