@extends('frontend.layouts.__app')

@section('content')

    <div class="text-center mb-12">
        @if (isset($type) && $type == 'seller')
            <h1 class="font-serif text-4xl md:text-6xl text-slate-900 mb-4">
                Join as a Local Expert
            </h1>
            <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                Create your professional profile in minutes and start
                receiving verified leads from customers near you.
                No upfront costs – pay only for quality leads.
            </p>
        @else
            <h1 class="font-serif text-4xl md:text-6xl text-slate-900 mb-4">
                Join as a Customer
            </h1>
            <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                Find trusted local experts near you and get your job done easily.
            </p>
        @endif

    </div>

    <div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-2xl p-8 md:p-12 border border-slate-100">
        <form id="proSignupForm" action="{{ route('user.submit.register') }}" method="POST" class="space-y-10">
            @csrf
            <!-- Step 1: Account -->
            <input type="hidden" name="type" value="{{ $type }}">
            <div class="step active" data-step="1">
                <h2 class="text-3xl font-bold mb-6">Create Your Account</h2>
                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-lg font-semibold text-slate-800 mb-2">
                            @if (isset($type) && $type == 'seller')
                                Owner Name
                            @else
                                Full Name
                            @endif
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" required name="name"
                            class="w-full px-6 py-5 rounded-3xl border border-slate-300 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition"
                            placeholder="e.g. Kaitlin Moran">
                    </div>
                    @if (isset($type) && $type == 'seller')
                        <div>
                            <label class="block text-lg font-semibold text-slate-800 mb-2">Business Name
                                (optional)</label>
                            <input type="text" name="business_name"
                                class="w-full px-6 py-5 rounded-3xl border border-slate-300 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition"
                                placeholder="e.g. Moran Legal Services">
                        </div>
                    @endif
                    <div>
                        <label class="block text-lg font-semibold text-slate-800 mb-2">Email <span
                                class="text-red-500">*</span></label>
                        <input type="email" name="email" required
                            class="w-full px-6 py-5 rounded-3xl border border-slate-300 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition"
                            placeholder="you@example.com">
                    </div>
                    <div>
                        <label class="block text-lg font-semibold text-slate-800 mb-2">Phone Number <span
                                class="text-red-500">*</span></label>
                        <input type="tel" required name="phone"
                            class="w-full px-6 py-5 rounded-3xl border border-slate-300 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition"
                            placeholder="+1 (555) 123-4567">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-lg font-semibold text-slate-800 mb-2">Password <span
                                class="text-red-500">*</span></label>
                        <input type="password" id="password" name="password" required minlength="8"
                            class="w-full px-6 py-5 rounded-3xl border border-slate-300 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition">
                        <p class="text-sm text-slate-500 mt-2">Minimum 8 characters, include a number and symbol.
                        </p>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-lg font-semibold text-slate-800 mb-2">Confirm Password <span
                                class="text-red-500">*</span></label>
                        <input type="password" id="confirmPassword" name="confirm_password" required minlength="8"
                            class="w-full px-6 py-5 rounded-3xl border border-slate-300 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition">
                    </div>
                </div>
                <div class="flex justify-between mt-12">
                    <button type="button"
                        class="prev-step text-slate-600 font-bold hover:text-slate-900 opacity-50 cursor-not-allowed"
                        disabled>← Back</button>
                    <button type="button"
                        class="next-step bg-slate-900 text-white px-10 py-5 rounded-3xl font-bold hover:bg-blue-600 transition shadow-lg">Next
                        →</button>
                </div>
            </div>

            <!-- Step 2: Services & Locations -->
            @if (isset($type) && $type == 'seller')
                <div class="step" data-step="2">
                    <h2 class="text-3xl font-bold mb-6">Your Services & Service Locations</h2>
                    <div class="space-y-12">
                        <div class="space-y-8" id="category-wrapper">
                            <div>
                                <label class="block text-lg font-semibold text-slate-800 mb-3">Primary Service
                                    Category
                                    <span class="text-red-500">*</span></label>
                                <select required id="primaryCategory"
                                    class="category-select w-full px-6 py-5 rounded-3xl border border-slate-300 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none"
                                    name="category_id[]">

                                    <option value="">Select your main category</option>

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>

                                {{-- <div id="category-container"></div> --}}
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-lg font-semibold text-slate-800 mb-2">Service Tags <span
                                    class="text-red-500">*</span></label>
                            <input type="tags" id="tags" name="tags" required
                                class="w-full px-6 py-5 rounded-3xl border border-slate-300 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition">
                            <p class="text-sm text-slate-500 mt-2">Put coma (,) for seperate tags. E.g. Divorce, Custody,
                                Mediation
                            </p>
                        </div>

                        <div class="space-y-8">
                            <label class="block text-lg font-semibold text-slate-800 mb-3">Service Locations <span
                                    class="text-red-500">*</span></label>
                            <p class="text-sm text-slate-500 mb-6">Add precise areas you serve.</p>
                            <div id="locationsContainer" class="space-y-8">
                                <div
                                    class="location-block p-8 bg-gradient-to-r from-slate-50 to-blue-50 rounded-3xl border border-slate-200 shadow-sm">
                                    <div class="grid grid-cols-4 md:grid-cols-4 lg:grid-cols-4 gap-6">
                                        <div>
                                            <label class="block text-sm font-bold text-slate-600 mb-2">Country
                                                <span class="text-red-500">*</span></label>
                                            <select required name="country"
                                                class="country-select w-full px-6 py-5 rounded-2xl border border-slate-300 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none">
                                                <option value="">Select Country</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-bold text-slate-600 mb-2">State /
                                                Province
                                                <span class="text-red-500">*</span></label>
                                            <select required name="state"
                                                class="state-select w-full px-6 py-5 rounded-2xl border border-slate-300 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none"
                                                disabled>
                                                <option value="">Select State</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-bold text-slate-600 mb-2">City <span
                                                    class="text-red-500">*</span></label>
                                            <select required name="city"
                                                class="city-select w-full px-6 py-5 rounded-2xl border border-slate-300 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none"
                                                disabled>
                                                <option value="">Select City</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-bold text-slate-600 mb-2">ZIP / Postal
                                                Code <span class="text-red-500">*</span></label>
                                            <select required name="zip_code"
                                                class="zip-select w-full px-6 py-5 rounded-2xl border border-slate-300 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none"
                                                disabled>
                                                <option value="">Select ZIP Code</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mt-6">
                                        <label class="block text-sm font-bold text-slate-600 mb-2">Additional
                                            Details
                                            (optional)</label>
                                        <input type="text" placeholder="Neighborhood or notes" name="about"
                                            class="address-notes w-full px-6 py-5 rounded-2xl border border-slate-300 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between mt-16">
                        <button type="button"
                            class="prev-step text-slate-600 font-bold hover:text-slate-900 transition">←
                            Back</button>
                        <button type="button"
                            class="next-step bg-slate-900 text-white px-10 py-5 rounded-3xl font-bold hover:bg-blue-600 transition shadow-lg">Next
                            →</button>
                    </div>
                </div>
            @endif

            <!-- Step 3: Contact Options -->
            @if (isset($type) && $type == 'seller')
                <div class="step" data-step="3">
                    <h2 class="text-3xl font-bold mb-6">How Customers Can Reach You</h2>
                    <p class="text-slate-600 mb-10">Choose the contact methods you want visible on your public profile.
                        All interactions are tracked as leads (pay-per-lead).</p>

                    <div class="space-y-10">
                        <!-- In-App Messaging -->
                        <div class="bg-gradient-to-r from-slate-900 to-blue-900 p-10 rounded-3xl text-white shadow-lg">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h3 class="text-2xl font-bold mb-4">Zonely Secure Messaging (Recommended)</h3>
                                    <p class="text-slate-200 mb-6">Customers message you directly through your profile.
                                        Instant notifications via email & SMS.</p>
                                    <ul class="text-base space-y-3 opacity-90">
                                        <li>✓ Completely free</li>
                                        <li>✓ Built-in lead tracking</li>
                                        <li>✓ Professional conversation history</li>
                                        <li>✓ Verified customers only</li>
                                    </ul>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer ml-8">
                                    <input type="checkbox" checked class="sr-only peer">
                                    <div
                                        class="w-16 h-9 bg-slate-600 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:rounded-full after:h-7 after:w-7 after:transition-all peer-checked:bg-blue-500">
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div
                            class="bg-white border-2 border-slate-200 rounded-3xl p-10 hover:border-blue-600 transition-all shadow-sm">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center gap-6 mb-6">
                                        <div
                                            class="w-16 h-16 bg-blue-100 rounded-3xl flex items-center justify-center text-blue-600 text-3xl">
                                            📞</div>
                                        <div>
                                            <h3 class="text-2xl font-bold">Customer Call Phone Number</h3>
                                            <p class="text-base text-slate-500">Show your phone for instant calls</p>
                                        </div>
                                    </div>
                                    <input type="tel" placeholder="Public phone number (optional)"
                                        class="w-full px-6 py-5 rounded-3xl border border-slate-300 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition">
                                    <p class="text-sm text-slate-500 mt-4">Tracked calls = high-intent paid leads</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer ml-8">
                                    <input type="checkbox" checked class="sr-only peer">
                                    <div
                                        class="w-16 h-9 bg-slate-600 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:rounded-full after:h-7 after:w-7 after:transition-all peer-checked:bg-blue-500">
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- WhatsApp -->
                        <div
                            class="bg-white border-2 border-slate-200 rounded-3xl p-10 hover:border-emerald-600 transition-all shadow-sm">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center gap-6 mb-6">
                                        <div
                                            class="w-16 h-16 bg-emerald-100 rounded-3xl flex items-center justify-center text-emerald-600 text-3xl">
                                            💬</div>
                                        <div>
                                            <h3 class="text-2xl font-bold">WhatsApp Consultation</h3>
                                            <p class="text-base text-slate-500">Fastest growing messaging channel</p>
                                        </div>
                                    </div>
                                    <input type="tel" name="whatsapp"
                                        placeholder="WhatsApp number (e.g. +1 555 123 4567)"
                                        class="w-full px-6 py-5 rounded-3xl border border-slate-300 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition">
                                    <p class="text-sm text-emerald-600 font-medium mt-4">Converts 3x faster than forms
                                    </p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer ml-8">
                                    <input type="checkbox" class="sr-only peer">
                                    <div
                                        class="w-16 h-9 bg-slate-600 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:rounded-full after:h-7 after:w-7 after:transition-all peer-checked:bg-emerald-500">
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Zonely Booking -->
                        {{-- <div
                                class="bg-white border-2 border-slate-200 rounded-3xl p-10 hover:border-indigo-600 transition-all shadow-sm">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-6 mb-6">
                                            <div
                                                class="w-16 h-16 bg-indigo-100 rounded-3xl flex items-center justify-center text-indigo-600 text-3xl">
                                                📅</div>
                                            <div>
                                                <h3 class="text-2xl font-bold">Zonely Built-in Booking</h3>
                                                <p class="text-base text-slate-500">Fully integrated appointment scheduling
                                                </p>
                                            </div>
                                        </div>
                                        <p class="text-slate-600 mb-8">Customers book directly on your profile.</p>

                                        <div class="space-y-7">
                                            <div>
                                                <label class="block text-lg font-semibold text-slate-800 mb-2">Default
                                                    Appointment Duration <span class="text-red-500">*</span></label>
                                                <select id="appointmentDuration"
                                                    class="w-full max-w-md px-6 py-5 rounded-3xl border border-slate-300 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100 outline-none">
                                                    <option value="15">15 minutes</option>
                                                    <option value="30" selected>30 minutes</option>
                                                    <option value="45">45 minutes</option>
                                                    <option value="60">60 minutes</option>
                                                    <option value="90">90 minutes</option>
                                                    <option value="120">120 minutes</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="block text-lg font-semibold text-slate-800 mb-2">Buffer
                                                    Time</label>
                                                <select id="bufferTime"
                                                    class="w-full max-w-md px-6 py-5 rounded-3xl border border-slate-300 focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100 outline-none">
                                                    <option value="0">None</option>
                                                    <option value="10">10 minutes</option>
                                                    <option value="15" selected>15 minutes</option>
                                                    <option value="30">30 minutes</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="block text-lg font-semibold text-slate-800 mb-2">Default
                                                    Daily Hours</label>
                                                <div class="grid grid-cols-2 gap-6 max-w-md">
                                                    <input type="time" id="startTime" value="09:00"
                                                        class="px-6 py-5 rounded-3xl border border-slate-300 focus:border-indigo-600">
                                                    <input type="time" id="endTime" value="18:00"
                                                        class="px-6 py-5 rounded-3xl border border-slate-300 focus:border-indigo-600">
                                                </div>
                                            </div>
                                            <div>
                                                <label class="block text-lg font-semibold text-slate-800 mb-4">Default
                                                    Working Days</label>
                                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                                                    <label
                                                        class="day-label flex items-center justify-center p-5 bg-slate-50 rounded-3xl border-2 border-slate-200 hover:border-indigo-600 cursor-pointer transition-all">
                                                        <input type="checkbox" name="workingDays" value="monday" checked
                                                            class="sr-only peer">
                                                        <span
                                                            class="font-semibold text-slate-700 peer-checked:text-indigo-600 peer-checked:font-bold">Monday</span>
                                                    </label>
                                                    <label
                                                        class="day-label flex items-center justify-center p-5 bg-slate-50 rounded-3xl border-2 border-slate-200 hover:border-indigo-600 cursor-pointer transition-all">
                                                        <input type="checkbox" name="workingDays" value="tuesday" checked
                                                            class="sr-only peer">
                                                        <span
                                                            class="font-semibold text-slate-700 peer-checked:text-indigo-600 peer-checked:font-bold">Tuesday</span>
                                                    </label>
                                                    <label
                                                        class="day-label flex items-center justify-center p-5 bg-slate-50 rounded-3xl border-2 border-slate-200 hover:border-indigo-600 cursor-pointer transition-all">
                                                        <input type="checkbox" name="workingDays" value="wednesday"
                                                            checked class="sr-only peer">
                                                        <span
                                                            class="font-semibold text-slate-700 peer-checked:text-indigo-600 peer-checked:font-bold">Wednesday</span>
                                                    </label>
                                                    <label
                                                        class="day-label flex items-center justify-center p-5 bg-slate-50 rounded-3xl border-2 border-slate-200 hover:border-indigo-600 cursor-pointer transition-all">
                                                        <input type="checkbox" name="workingDays" value="thursday"
                                                            checked class="sr-only peer">
                                                        <span
                                                            class="font-semibold text-slate-700 peer-checked:text-indigo-600 peer-checked:font-bold">Thursday</span>
                                                    </label>
                                                    <label
                                                        class="day-label flex items-center justify-center p-5 bg-slate-50 rounded-3xl border-2 border-slate-200 hover:border-indigo-600 cursor-pointer transition-all">
                                                        <input type="checkbox" name="workingDays" value="friday" checked
                                                            class="sr-only peer">
                                                        <span
                                                            class="font-semibold text-slate-700 peer-checked:text-indigo-600 peer-checked:font-bold">Friday</span>
                                                    </label>
                                                    <label
                                                        class="day-label flex items-center justify-center p-5 bg-slate-50 rounded-3xl border-2 border-slate-200 hover:border-indigo-600 cursor-pointer transition-all">
                                                        <input type="checkbox" name="workingDays" value="saturday"
                                                            class="sr-only peer">
                                                        <span
                                                            class="font-semibold text-slate-700 peer-checked:text-indigo-600 peer-checked:font-bold">Saturday</span>
                                                    </label>
                                                    <label
                                                        class="day-label flex items-center justify-center p-5 bg-slate-50 rounded-3xl border-2 border-slate-200 hover:border-indigo-600 cursor-pointer transition-all">
                                                        <input type="checkbox" name="workingDays" value="sunday"
                                                            class="sr-only peer">
                                                        <span
                                                            class="font-semibold text-slate-700 peer-checked:text-indigo-600 peer-checked:font-bold">Sunday</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-sm text-indigo-600 font-medium mt-8">Best conversion method –
                                            customers book instantly!</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer ml-8">
                                        <input type="checkbox" checked class="sr-only peer enable-zonely-booking">
                                        <div
                                            class="w-16 h-9 bg-slate-600 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:rounded-full after:h-7 after:w-7 after:transition-all peer-checked:bg-indigo-500">
                                        </div>
                                    </label>
                                </div>
                            </div> --}}
                    </div>

                    <div class="flex justify-between mt-16">
                        <button type="button"
                            class="prev-step text-slate-600 font-bold hover:text-slate-900 transition">←
                            Back</button>
                        <button type="button"
                            class="next-step bg-slate-900 text-white px-10 py-5 rounded-3xl font-bold hover:bg-blue-600 transition shadow-lg">Next
                            →</button>
                    </div>
                </div>
            @endif

            <!-- Step 4: Profile (Improved) -->
            <div class="step" data-step="4">
                <h2 class="text-3xl font-bold mb-4">Build Your Professional Profile</h2>
                <p class="text-slate-600 mb-10">Add details to build trust and stand out from others.</p>

                <div class="space-y-12">

                    <!-- Profile Photo -->
                    <div class="space-y-4">
                        <label class="text-lg font-semibold text-slate-800">Profile Photo <span
                                class="text-red-500">*</span></label>
                        <div
                            class="border-2 border-dashed border-slate-300 rounded-3xl p-12 text-center hover:border-blue-500 hover:bg-blue-50 transition-all cursor-pointer">
                            <input type="file" accept="image/*" required class="hidden" id="photoUpload">
                            <label for="photoUpload" class="cursor-pointer block">
                                <div id="photoPreview"
                                    class="mx-auto w-40 h-40 bg-slate-200 rounded-full flex items-center justify-center overflow-hidden mb-6 border-4 border-white shadow-lg">
                                    <svg class="w-20 h-20 text-slate-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                </div>
                                <p class="text-lg font-semibold text-blue-600 mb-1">Click to upload photo</p>
                                <p class="text-sm text-slate-500">JPG, PNG • Max 5MB • Recommended: square photo
                                </p>
                            </label>
                        </div>
                    </div>

                    @if (isset($type) && $type == 'seller')
                        <!-- Short Bio / Tagline -->
                        <div class="space-y-4">
                            <label class="text-lg font-semibold text-slate-800">Short Bio / Tagline <span
                                    class="text-red-500">*</span></label>
                            <textarea required rows="4" maxlength="200" name="bio"
                                class="w-full px-6 py-5 rounded-3xl border border-slate-300 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition resize-none text-base"
                                placeholder="e.g. Experienced family law attorney helping clients navigate divorce and custody with compassion and expertise."></textarea>
                            <p class="text-sm text-slate-500">Max 200 characters • This appears under your name on
                                search results.</p>
                        </div>

                        <!-- Years of Experience -->
                        <div class="space-y-4">
                            <label class="text-lg font-semibold text-slate-800">Years of Experience <span
                                    class="text-red-500">*</span></label>
                            <input type="number" required min="0" max="60" name="experience"
                                class="w-full max-w-md px-6 py-5 rounded-3xl border border-slate-300 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition text-base"
                                placeholder="e.g. 8">
                            <p class="text-sm text-slate-500">How many years have you been practicing professionally?
                            </p>
                        </div>
                    @endif

                    <!-- Education -->
                    {{-- <div class="space-y-6">
                            <div class="flex justify-between items-center">
                                <label class="text-lg font-semibold text-slate-800">Education</label>
                                <button type="button" id="addEducation"
                                    class="flex items-center gap-2 text-blue-600 font-semibold hover:text-blue-700 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Add
                                </button>
                            </div>
                            <div id="educationContainer" class="space-y-6">
                                <div
                                    class="education-entry p-8 bg-gradient-to-r from-slate-50 to-blue-50 rounded-3xl border border-slate-200 shadow-sm">
                                    <div class="grid md:grid-cols-3 gap-6">
                                        <input type="text" required placeholder="Degree"
                                            class="px-6 py-5 rounded-2xl border border-slate-300 focus:border-blue-600 outline-none transition">
                                        <input type="text" required placeholder="Institution"
                                            class="px-6 py-5 rounded-2xl border border-slate-300 focus:border-blue-600 outline-none transition">
                                        <input type="text" placeholder="Year (e.g. 2015)"
                                            class="px-6 py-5 rounded-2xl border border-slate-300 focus:border-blue-600 outline-none transition">
                                    </div>
                                    <button type="button"
                                        class="remove-education mt-6 text-red-600 font-medium hover:text-red-700 flex items-center gap-2 opacity-0 pointer-events-none transition-opacity">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div> --}}

                    <!-- Professional Experience -->
                    {{-- <div class="space-y-6">
                            <div class="flex justify-between items-center">
                                <label class="text-lg font-semibold text-slate-800">Professional Experience</label>
                                <button type="button" id="addExperience"
                                    class="flex items-center gap-2 text-blue-600 font-semibold hover:text-blue-700 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Add
                                </button>
                            </div>
                            <div id="experienceContainer" class="space-y-6">
                                <div
                                    class="experience-entry p-8 bg-gradient-to-r from-slate-50 to-blue-50 rounded-3xl border border-slate-200 shadow-sm">
                                    <div class="grid md:grid-cols-3 gap-6">
                                        <input type="text" required placeholder="Job Title"
                                            class="px-6 py-5 rounded-2xl border border-slate-300 focus:border-blue-600 outline-none transition">
                                        <input type="text" placeholder="Company / Organization"
                                            class="px-6 py-5 rounded-2xl border border-slate-300 focus:border-blue-600 outline-none transition">
                                        <input type="text" placeholder="Years (e.g. 2018–2022)"
                                            class="px-6 py-5 rounded-2xl border border-slate-300 focus:border-blue-600 outline-none transition">
                                    </div>
                                    <button type="button"
                                        class="remove-experience mt-6 text-red-600 font-medium hover:text-red-700 flex items-center gap-2 opacity-0 pointer-events-none transition-opacity">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div> --}}

                    <!-- Professional Memberships / Licenses -->
                    {{-- <div class="space-y-6">
                            <div class="flex justify-between items-center">
                                <label class="text-lg font-semibold text-slate-800">Professional Memberships /
                                    Licenses</label>
                                <button type="button" id="addMembership"
                                    class="flex items-center gap-2 text-blue-600 font-semibold hover:text-blue-700 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Add
                                </button>
                            </div>
                            <div id="membershipContainer" class="space-y-6">
                                <div
                                    class="membership-entry p-8 bg-gradient-to-r from-slate-50 to-blue-50 rounded-3xl border border-slate-200 shadow-sm">
                                    <div class="grid md:grid-cols-2 gap-6">
                                        <input type="text" required placeholder="Organization / Licensing Body"
                                            class="px-6 py-5 rounded-2xl border border-slate-300 focus:border-blue-600 outline-none transition">
                                        <input type="text" placeholder="License Number (optional)"
                                            class="px-6 py-5 rounded-2xl border border-slate-300 focus:border-blue-600 outline-none transition">
                                    </div>
                                    <button type="button"
                                        class="remove-membership mt-6 text-red-600 font-medium hover:text-red-700 flex items-center gap-2 opacity-0 pointer-events-none transition-opacity">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div> --}}

                </div>

                <div class="flex justify-between mt-16">
                    <button type="button" class="prev-step text-slate-600 font-bold hover:text-slate-900 transition">←
                        Back</button>
                    <button type="button"
                        class="next-step bg-slate-900 text-white px-10 py-5 rounded-3xl font-bold hover:bg-blue-600 transition shadow-lg">Next
                        →</button>
                </div>
            </div>

            <!-- Step 5: Review -->
            <div class="step" data-step="5">
                <h2 class="text-3xl font-bold mb-6">Final Review & Verification</h2>
                <p class="text-slate-600 mb-8">We’ll verify your credentials to show a “Verified” badge.</p>
                <div class="bg-blue-50 rounded-3xl p-8 mb-10 shadow-sm">
                    <h3 class="text-xl font-bold text-blue-900 mb-4">Pay-Per-Lead Model</h3>
                    <ul class="text-base text-blue-800 space-y-3">
                        <li>✓ No monthly fees</li>
                        <li>✓ Only pay for verified leads</li>
                        <li>✓ Full control</li>
                    </ul>
                </div>
                <label class="flex items-start gap-4 mb-10">
                    <input type="checkbox" required class="mt-1 w-6 h-6 text-blue-600 rounded focus:ring-blue-500">
                    <span class="text-base text-slate-700">I agree to Zonely's Terms and Privacy Policy.</span>
                </label>
                <div class="flex justify-between mt-12">
                    <button type="button" class="prev-step text-slate-600 font-bold hover:text-slate-900 transition">←
                        Back</button>
                    <button type="submit"
                        class="bg-blue-600 text-white px-12 py-6 rounded-3xl font-bold hover:bg-slate-900 transition shadow-xl text-lg">Create
                        My Profile</button>
                </div>
            </div>

        </form>
    </div>
@endsection

@section('script')
    <script>
        const steps = Array.from(document.querySelectorAll('.step'));
        const nextBtns = document.querySelectorAll('.next-step');
        const prevBtns = document.querySelectorAll('.prev-step');
        const indicators = document.querySelectorAll('.step-indicator');
        const fills = document.querySelectorAll('.progress-fill');
        let currentStep = 0;

        function updateProgress() {
            steps.forEach((step, i) => step.classList.toggle('active', i === currentStep));
            indicators.forEach((ind, i) => {
                ind.classList.remove('step-complete', 'step-active', 'step-inactive');
                if (i < currentStep) ind.classList.add('step-complete');
                else if (i === currentStep) ind.classList.add('step-active');
                else ind.classList.add('step-inactive');
            });
            fills.forEach((fill, i) => fill.style.width = i < currentStep ? '100%' : '0%');
            const backBtn = steps[currentStep].querySelector('.prev-step');
            if (backBtn) {
                backBtn.disabled = currentStep === 0;
                backBtn.classList.toggle('opacity-50', currentStep === 0);
                backBtn.classList.toggle('cursor-not-allowed', currentStep === 0);
            }
        }

        function validateStep() {
            const required = steps[currentStep].querySelectorAll('input[required], select[required], textarea[required]');
            let valid = true;
            required.forEach(field => {
                if (!field.value.trim()) {
                    valid = false;
                    field.classList.add('border-red-500');
                } else {
                    field.classList.remove('border-red-500');
                }
            });
            if (currentStep === 0) {
                const pwd = document.getElementById('password').value;
                const confirm = document.getElementById('confirmPassword').value;
                if (pwd !== confirm || !pwd) {
                    alert('Passwords do not match or are empty!');
                    valid = false;
                }
            }
            const tagsInput = document.getElementById('tags');

            if (tagsInput) {
                const rawTags = tagsInput.value.split(',').map(tag => tag.trim()).filter(tag => tag);

                if (rawTags.length > 5) {
                    alert('Maximum 5 tags allowed!');
                    tagsInput.classList.add('border-red-500');
                    valid = false;
                } else {
                    for (let tag of rawTags) {
                        if (tag.length > 30) {
                            alert('Each tag must be less than 30 characters!');
                            tagsInput.classList.add('border-red-500');
                            valid = false;
                            break;
                        }
                    }
                }

                // ✅ valid হলে border ঠিক করো
                if (valid) {
                    tagsInput.classList.remove('border-red-500');
                }
            }
            return valid;
        }

        nextBtns.forEach(btn => btn.addEventListener('click', () => {
            if (validateStep() && currentStep < steps.length - 1) {
                currentStep++;
                updateProgress();
            } else if (!validateStep()) {
                alert('Please fill all required fields correctly.');
            }
        }));

        prevBtns.forEach(btn => btn.addEventListener('click', () => {
            if (currentStep > 0) {
                currentStep--;
                updateProgress();
            }
        }));

        // Photo preview
        document.getElementById('photoUpload').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    document.getElementById('photoPreview').innerHTML =
                        `<img src="${ev.target.result}" class="w-full h-full object-cover rounded-full">`;
                };
                reader.readAsDataURL(file);
            }
        });

        /*
        document.addEventListener("change", function(e) {

            if (e.target.classList.contains("category-select")) {

                let categoryId = e.target.value;
                let wrapper = document.getElementById("category-wrapper");

                // 🔥 Remove all selects AFTER current one
                let currentDiv = e.target.closest('div');
                let next = currentDiv.nextElementSibling;
                while (next) {
                    next.remove();
                    next = currentDiv.nextElementSibling;
                }

                if (categoryId) {
                    fetch('/get-subcategories/' + categoryId)
                        .then(res => res.json())
                        .then(data => {

                            if (data.length > 0) {

                                let newDiv = document.createElement("div");

                                let options = `<option value="">Select Sub Category</option>`;
                                data.forEach(item => {
                                    options += `<option value="${item.id}">${item.title}</option>`;
                                });

                                newDiv.innerHTML = `<label class="block text-lg font-semibold text-slate-800 mb-3"> Sub Category </label>
                                <select name="category_id[]"
                                    class="category-select w-full px-6 py-5 rounded-3xl border border-slate-300 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none">
                                    ${options}
                                </select>
                            `;
                                wrapper.appendChild(newDiv);
                            }
                        });
                }
            }
        });*/
        function validateStep() {
            const required = steps[currentStep].querySelectorAll('input[required], select[required], textarea[required]');
            let valid = true;

            required.forEach(field => {
                if (!field.value.trim()) {
                    valid = false;
                    field.classList.add('border-red-500');
                } else {
                    field.classList.remove('border-red-500');
                }
            });

            // Password check
            if (currentStep === 0) {
                const pwd = document.getElementById('password').value;
                const confirm = document.getElementById('confirmPassword').value;

                if (pwd !== confirm || !pwd) {
                    alert('Passwords do not match or are empty!');
                    valid = false;
                }
            }

            // ✅ Tags validation (fixed)
            const tagsInput = document.getElementById('tags');

            if (tagsInput) {
                let tagsValid = true;

                const rawTags = tagsInput.value
                    .split(',')
                    .map(tag => tag.trim())
                    .filter(tag => tag);

                if (rawTags.length > 5) {
                    alert('Maximum 5 tags allowed!');
                    tagsValid = false;
                }

                for (let tag of rawTags) {
                    if (tag.length > 30) {
                        alert('Each tag must be less than 30 characters!');
                        tagsValid = false;
                        break;
                    }
                }

                // Apply UI
                if (!tagsValid) {
                    tagsInput.classList.add('border-red-500');
                    valid = false;
                } else {
                    tagsInput.classList.remove('border-red-500');
                }
            }

            return valid;
        }

        document.addEventListener("DOMContentLoaded", function() {
            fetch('/countries')
                .then(res => res.json())
                .then(data => {

                    let countrySelect = document.querySelector('.country-select');

                    let options = `<option value="">Select Country</option>`;
                    data.forEach(item => {
                        options += `<option value="${item.id}">${item.title}</option>`;
                    });

                    countrySelect.innerHTML = options;
                });

        });
        document.addEventListener("change", function(e) {

            if (e.target.classList.contains("country-select")) {

                let countryId = e.target.value;
                let block = e.target.closest('.location-block');

                let stateSelect = block.querySelector('.state-select');
                let citySelect = block.querySelector('.city-select');
                let zipSelect = block.querySelector('.zip-select');

                // reset
                stateSelect.innerHTML = `<option value="">Select State</option>`;
                citySelect.innerHTML = `<option value="">Select City</option>`;
                zipSelect.innerHTML = `<option value="">Select Zip</option>`;
                stateSelect.disabled = true;
                citySelect.disabled = true;
                zipSelect.disabled = true;

                if (countryId) {
                    fetch('/states/' + countryId)
                        .then(res => res.json())
                        .then(data => {

                            let options = `<option value="">Select State</option>`;
                            data.forEach(item => {
                                options += `<option value="${item.id}">${item.title}</option>`;
                            });

                            stateSelect.innerHTML = options;
                            stateSelect.disabled = false;
                        });
                }
            }

        });
        document.addEventListener("change", function(e) {

            if (e.target.classList.contains("state-select")) {

                let stateId = e.target.value;
                let block = e.target.closest('.location-block');

                let citySelect = block.querySelector('.city-select');
                let zipSelect = block.querySelector('.zip-select');

                // reset
                citySelect.innerHTML = `<option value="">Select City</option>`;
                zipSelect.innerHTML = `<option value="">Select Zip</option>`;
                citySelect.disabled = true;
                zipSelect.disabled = true;

                if (stateId) {
                    fetch('/cities/' + stateId)
                        .then(res => res.json())
                        .then(data => {

                            let options = `<option value="">Select City</option>`;
                            data.forEach(item => {
                                options += `<option value="${item.id}">${item.title}</option>`;
                            });

                            citySelect.innerHTML = options;
                            citySelect.disabled = false;
                        });
                }
            }

        });

        document.addEventListener("change", function(e) {

            if (e.target.classList.contains("city-select")) {

                let cityId = e.target.value;
                let block = e.target.closest('.location-block');

                let zipSelect = block.querySelector('.zip-select');

                // reset
                zipSelect.innerHTML = `<option value="">Select ZIP Code</option>`;
                zipSelect.disabled = true;

                if (cityId) {
                    fetch('/postal-codes/' + cityId)
                        .then(res => res.json())
                        .then(data => {

                            let options = `<option value="">Select ZIP Code</option>`;

                            data.forEach(item => {
                                options += `<option value="${item.id}">${item.title}</option>`;
                            });

                            zipSelect.innerHTML = options;
                            zipSelect.disabled = false;
                        });
                }
            }

        });

        // Booking toggle
        // const bookingToggle = document.querySelector('.enable-zonely-booking');
        // const bookingFields = document.querySelectorAll(
        //     '#appointmentDuration, #bufferTime, #startTime, #endTime, .day-label input');
        // const dayLabels = document.querySelectorAll('.day-label');

        // if (bookingToggle) {
        //     bookingToggle.addEventListener('change', e => {
        //         bookingFields.forEach(f => f.disabled = !e.target.checked);
        //         dayLabels.forEach(l => l.classList.toggle('opacity-50', !e.target.checked));
        //         dayLabels.forEach(l => l.classList.toggle('cursor-not-allowed', !e.target.checked));
        //     });
        // }

        // dayLabels.forEach(label => {
        //     label.addEventListener('click', () => {
        //         if (bookingToggle && !bookingToggle.checked) return;
        //         const cb = label.querySelector('input');
        //         cb.checked = !cb.checked;
        //     });
        // });

        // Dynamic add/remove for education, experience, membership
        ['Education', 'Experience', 'Membership'].forEach(type => {
            const lower = type.toLowerCase();
            const btn = document.getElementById(`add${type}`);
            if (btn) {
                btn.addEventListener('click', () => {
                    const container = document.getElementById(`${lower}Container`);
                    const entry = container.querySelector(`.${lower}-entry`).cloneNode(true);
                    entry.querySelectorAll('input').forEach(i => i.value = '');
                    const removeBtn = entry.querySelector(`.remove-${lower}`);
                    removeBtn.classList.remove('opacity-0', 'pointer-events-none');
                    container.appendChild(entry);
                });
            }
        });

        document.addEventListener('click', e => {
            if (e.target.classList.contains('remove-education') || e.target.classList.contains(
                    'remove-experience') || e.target.classList.contains('remove-membership')) {
                const container = e.target.closest('[id$="Container"]');
                if (container.children.length > 1) {
                    e.target.closest('[class$="-entry"]').remove();
                }
            }
        });

        // Form submit
        // document.getElementById('proSignupForm').addEventListener('submit', e => {
        //     e.preventDefault();    
        // });

        // Initialize
        updateProgress();
    </script>
@endsection
