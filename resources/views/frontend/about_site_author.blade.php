@extends('frontend.layouts._app')
@php
    $site_author = 'Meet the man Behind the Tow Now';
@endphp
@section('title', 'About Site Author')
@section('content')

    <section class="bg-slate-900 text-white py-20 md:py-16 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex flex-col lg:flex-row items-center gap-16">

                <!-- IMAGE -->
                <div class="w-full lg:w-1/3">
                    <div class="relative group mx-auto max-w-sm">
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-violet-600 rounded-[2.5rem] blur opacity-30">
                        </div>

                        <div class="relative aspect-[4/5] overflow-hidden rounded-[2.5rem] border-4 border-slate-800">
                            <img src="{{ asset('frontend/img/ceo.webp') }}"
                                class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-700"
                                alt="Md. Norozzaman"
                                onerror="this.src='https://ui-avatars.com/api/?name=Md+Norozzaman&background=1e293b&color=fff&size=400'">
                        </div>
                    </div>
                </div>

                <!-- CONTENT -->
                <div class="flex-1 text-center lg:text-left">
                    <h2 class="text-blue-400 text-xs font-black uppercase tracking-[0.2em] mb-4">
                        Message from the Founder
                    </h2>

                    <h3 class="font-serif text-3xl md:text-5xl mb-6 leading-tight">
                        “Building brands through strategy, creativity, and digital excellence.”
                    </h3>

                    <div class="space-y-6 text-slate-400 text-lg leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        <p>
                            Hi, I'm <span class="text-white font-bold">Md. Norozzaman</span>,
                            Founder and CEO of
                            <span class="text-white font-semibold">
                                Tansai Consultancy & Language Center
                            </span>.
                            A graduate of <span class="text-white font-semibold">HEZHOU University, China</span>,
                            I'm professional businessman with 3 (three) years of e-commerce business experience.
                        </p>
                    </div>

                    <!-- SIGNATURE -->
                    <div class="mt-5">
                        <p class="font-serif text-2xl text-white">Md. Norozzaman</p>
                        <p class="text-blue-400 text-sm font-bold uppercase tracking-widest">
                            Founder & CEO
                        </p>
                    </div>

                    <!-- SOCIAL LINKS -->
                    <div class="mt-8 flex justify-center lg:justify-start gap-5">

                        <!-- LinkedIn -->
                        <a href="https://www.linkedin.com/" target="_blank" aria-label="LinkedIn"
                            class="group p-3 rounded-full bg-slate-800 hover:bg-blue-600 transition">
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-white" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M4.98 3.5C4.98 4.88 3.86 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1 4.98 2.12 4.98 3.5zM.22 24h4.56V7.98H.22V24zM7.91 7.98H12.3v2.19h.06c.61-1.15 2.1-2.36 4.33-2.36 4.63 0 5.48 3.05 5.48 7.01V24h-4.56v-7.59c0-1.81-.03-4.14-2.52-4.14-2.53 0-2.92 1.97-2.92 4v7.73H7.91V7.98z" />
                            </svg>
                        </a>

                        <!-- Facebook -->
                        <a href="https://www.facebook.com/" target="_blank" aria-label="Facebook"
                            class="group p-3 rounded-full bg-slate-800 hover:bg-blue-500 transition">
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-white" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24h11.495v-9.294H9.691V11.01h3.129V8.309c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.796.715-1.796 1.763v2.313h3.587l-.467 3.696h-3.12V24h6.116C23.407 24 24 23.407 24 22.676V1.325C24 .593 23.407 0 22.675 0z" />
                            </svg>
                        </a>

                        <!-- Twitter (X) -->
                        <a href="https://twitter.com/" target="_blank" aria-label="Twitter"
                            class="group p-3 rounded-full bg-slate-800 hover:bg-sky-500 transition">
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-white" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M23.954 4.569c-.885.389-1.83.654-2.825.775 1.014-.611 1.794-1.574 2.163-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-2.723 0-4.928 2.204-4.928 4.93 0 .39.045.765.127 1.124-4.094-.205-7.725-2.165-10.157-5.144-.424.722-.666 1.561-.666 2.475 0 1.708.87 3.213 2.188 4.096-.807-.026-1.566-.248-2.228-.616v.061c0 2.385 1.693 4.374 3.946 4.827-.413.111-.849.171-1.296.171-.314 0-.615-.03-.916-.086.631 1.953 2.445 3.377 4.6 3.419-1.68 1.319-3.809 2.105-6.102 2.105-.39 0-.779-.023-1.17-.067 2.189 1.394 4.768 2.209 7.557 2.209 9.054 0 14-7.496 14-13.986 0-.21 0-.42-.016-.63.961-.689 1.8-1.56 2.46-2.548z" />
                            </svg>
                        </a>

                        <!-- WhatsApp -->
                        <a href="https://wa.me/8801826192179" target="_blank" aria-label="WhatsApp"
                            class="group p-3 rounded-full bg-slate-800 hover:bg-green-500 transition">
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-white" fill="currentColor"
                                viewBox="0 0 32 32">
                                <path
                                    d="M16.003 3C9.373 3 4 8.373 4 15.003c0 2.646.861 5.083 2.318 7.057L4 29l7.11-2.262a11.92 11.92 0 0 0 4.893 1.044h.001c6.63 0 12.003-5.373 12.003-12.003C28.007 8.373 22.634 3 16.003 3zm6.728 17.348c-.282.79-1.65 1.52-2.28 1.61-.604.088-1.37.125-2.21-.14-.51-.16-1.165-.378-2.01-.73-3.536-1.52-5.844-5.1-6.02-5.336-.175-.235-1.44-1.92-1.44-3.662 0-1.74.9-2.597 1.22-2.953.32-.355.7-.445.94-.445.235 0 .47 0 .676.01.218.01.51-.084.8.61.282.678.96 2.35 1.04 2.52.08.17.14.38.03.61-.11.235-.165.38-.33.58-.165.2-.347.45-.495.605-.165.165-.338.345-.145.68.195.335.87 1.435 1.87 2.32 1.29 1.14 2.38 1.49 2.71 1.66.33.165.52.14.72-.085.2-.23.82-.96 1.04-1.29.22-.33.44-.275.75-.165.31.11 1.95.92 2.28 1.085.33.165.55.25.63.39.085.14.085.79-.2 1.58z" />
                            </svg>
                        </a>

                    </div>


                </div>
            </div>
        </div>
    </section>

@endsection
