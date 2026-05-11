@extends('frontend.layouts.' . $layout)

@section('content')
    @if ($layout === '__app')
        <div class="p-10">
            <div class="text-center mb-10">
                <h3 class="text-3xl font-bold text-slate-800">What type of business do you run?</h3>
                <p class="text-slate-600 mt-3">Choose the best category so we can customize your profile and lead
                    forms properly.</p>
            </div>

            <!-- Categories Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6" id="categoryGrid">

                <!-- 1 Professional Services -->
                <div class="category-card border-2 border-transparent bg-white rounded-3xl p-7 cursor-pointer"
                    onclick="selectCategory(this)">
                    <div class="text-5xl mb-4">💼</div>
                    <h4 class="font-semibold text-xl mb-2">Professional Services</h4>
                    <p class="text-sm text-slate-500 mb-5">High-value & trust-based businesses</p>
                    <ul class="text-xs text-slate-600 space-y-1.5">
                        <li>• Lawyers / Attorneys</li>
                        <li>• CPAs & Accountants</li>
                        <li>• Tax Consultants</li>
                        <li>• Business Consultants</li>
                        <li>• Financial Advisors</li>
                        <li>• Real Estate Agents</li>
                        <li>• Tutors & Coaches</li>
                        <li>• Immigration Consultants</li>
                        <li>• Notary Public</li>
                    </ul>
                </div>

                <!-- 2 Healthcare & Wellness -->
                <div class="category-card border-2 border-transparent bg-white rounded-3xl p-7 cursor-pointer"
                    onclick="selectCategory(this)">
                    <div class="text-5xl mb-4">🩺</div>
                    <h4 class="font-semibold text-xl mb-2">Healthcare & Wellness</h4>
                    <p class="text-sm text-slate-500 mb-5">Medical, health & wellness services</p>
                    <ul class="text-xs text-slate-600 space-y-1.5">
                        <li>• Doctors & Medical Clinics</li>
                        <li>• Dentists & Dental Clinics</li>
                        <li>• Physiotherapists</li>
                        <li>• Chiropractors</li>
                        <li>• Psychologists & Therapists</li>
                        <li>• Gyms & Personal Trainers</li>
                        <li>• Nutritionists</li>
                        <li>• Yoga Studios</li>
                        <li>• Veterinary Clinics</li>
                    </ul>
                </div>

                <!-- 3 Home Services & Repairs -->
                <div class="category-card border-2 border-transparent bg-white rounded-3xl p-7 cursor-pointer"
                    onclick="selectCategory(this)">
                    <div class="text-5xl mb-4">🔧</div>
                    <h4 class="font-semibold text-xl mb-2">Home Services & Repairs</h4>
                    <p class="text-sm text-slate-500 mb-5">On-demand & emergency services</p>
                    <ul class="text-xs text-slate-600 space-y-1.5">
                        <li>• Plumbers</li>
                        <li>• Electricians</li>
                        <li>• HVAC Technicians</li>
                        <li>• Carpenters & Painters</li>
                        <li>• Cleaners & Housekeepers</li>
                        <li>• Locksmiths</li>
                        <li>• Pest Control</li>
                        <li>• Appliance Repair</li>
                        <li>• Tow Truck & Roadside Assistance</li>
                        <li>• Roofers & Movers</li>
                    </ul>
                </div>

                <!-- 4 Beauty & Personal Care -->
                <div class="category-card border-2 border-transparent bg-white rounded-3xl p-7 cursor-pointer"
                    onclick="selectCategory(this)">
                    <div class="text-5xl mb-4">💇‍♀️</div>
                    <h4 class="font-semibold text-xl mb-2">Beauty & Personal Care</h4>
                    <p class="text-sm text-slate-500 mb-5">Beauty, grooming & self-care</p>
                    <ul class="text-xs text-slate-600 space-y-1.5">
                        <li>• Hair Salons</li>
                        <li>• Nail Salons</li>
                        <li>• Barber Shops</li>
                        <li>• Spas & Massage Centers</li>
                        <li>• Makeup Artists</li>
                        <li>• Tattoo Studios</li>
                        <li>• Lashes & Eyebrows</li>
                        <li>• Bridal Makeup</li>
                        <li>• Aesthetic & Skin Clinics</li>
                    </ul>
                </div>

            </div>

            <form action="{{ route('profile.update.dashboard') }}" method="post">
                @csrf
                <!-- Other Option -->
                <div class="space-y-8 mt-2" id="category-wrapper">
                    <div>
                        <label class="block text-lg font-semibold text-slate-800 mb-3">Choose Your Service Category
                            <span class="text-red-500">*</span></label>
                        <select required id="primaryCategory"
                            class="category-select w-full px-6 py-5 rounded-3xl border border-slate-300 focus:border-teal-700 focus:ring-4 focus:ring-teal-100 outline-none"
                            name="seller_service_type">

                            <option value="">Select your service type</option>
                            <option value="professional">Professional</option>
                            <option value="health">Health</option>
                            <option value="home">Home</option>
                            <option value="beauty">Beauty</option>
                        </select>

                        {{-- <div id="category-container"></div> --}}
                    </div>
                </div>

                <!-- Next Button -->
                <div class="mt-12 flex justify-center">
                    <button
                        class="bg-teal-700 hover:bg-teal-800 text-white px-14 py-5 rounded-2xl text-lg font-semibold flex items-center gap-3 shadow-lg">
                        Continue to Next Step
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </form>

            <p class="text-center text-xs text-slate-500 mt-6">Step 1 of 3 • Takes less than 2 minutes</p>
        </div>
    @else
        <!-- Verified Banner -->
        <div class="bg-white rounded-3xl p-8 mb-8 shadow-sm flex items-center gap-6">
            <div class="bg-green-100 text-green-700 px-6 py-2 rounded-2xl flex items-center gap-2 font-semibold">
                <i class="fas fa-check-circle"></i> Verified
            </div>
            <div>
                <h2 class="text-4xl font-semibold text-gray-900">You're logged in!</h2>
                <p class="text-gray-600 mt-1">Complete your profile to start receiving exclusive verified leads.</p>
            </div>
        </div>

        <!-- Progress -->
        <div class="bg-white rounded-3xl p-6 mb-8 shadow-sm">
            <div class="flex justify-between mb-3">
                <div class="text-lg font-semibold">Profile Completion: <span class="text-teal-700">65%</span></div>
                <div class="text-sm text-gray-500">4 steps remaining to receive leads</div>
            </div>
            <div class="h-3 bg-gray-100 rounded-full overflow-hidden">
                <div class="h-3 bg-teal-700 rounded-full w-[65%]"></div>
            </div>
        </div>

        <!-- Wizard Steps -->
        <div class="flex gap-2 mb-10 overflow-x-auto pb-3">
            <div class="{{ $_next === 'business' ? 'step-active' : '' }} cursor-pointer px-7 py-3 rounded-2xl font-medium text-sm whitespace-nowrap">1.
                Business Basics</div>
            <div
                class="{{ $_next === 'contact' ? 'step-active' : '' }} cursor-pointer px-7 py-3 rounded-2xl font-medium text-sm bg-gray-100 hover:bg-gray-200 whitespace-nowrap">
                2. Contact</div>
            <div
                class="{{ $_next === 'personal_info' ? 'step-active' : '' }} cursor-pointer px-7 py-3 rounded-2xl font-medium text-sm bg-gray-100 hover:bg-gray-200 whitespace-nowrap">
                3. Professional Info</div>
            <div
                class="{{ $_next === 'about_bio' ? 'step-active' : '' }} cursor-pointer px-7 py-3 rounded-2xl font-medium text-sm bg-gray-100 hover:bg-gray-200 whitespace-nowrap">
                4. About & Bio</div>
            <div
                class="{{ $_next === 'review' ? 'step-active' : '' }} cursor-pointer px-7 py-3 rounded-2xl font-medium text-sm bg-gray-100 hover:bg-gray-200 whitespace-nowrap">
                5. Preview</div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left Form - Unchanged -->
            <div class="lg:col-span-7 bg-white rounded-3xl p-10 shadow-sm">
                <h3 class="text-3xl font-semibold mb-2">Business Basics</h3>
                <p class="text-gray-500 mb-8">Tell us about your business so we can create your exclusive landing page.
                </p>
                <form action="{{ route('profile.update.dashboard') }}" method="post">
                    @csrf
                    @if ($_next === 'business')
                        <div class="space-y-8">
                            <input type="hidden" name="_next" value="contact">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Business Name <span
                                        class="text-red-500">*</span></label>
                                <input name="business_name" type="text" value="{{ $user->business_name }}"
                                    class="w-full px-6 py-4 border border-gray-200 rounded-2xl focus:outline-none focus:border-teal-600 text-lg">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Owner Name <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="name" value="{{ $user->name }}"
                                    class="w-full px-6 py-4 border border-gray-200 rounded-2xl focus:outline-none focus:border-teal-600 text-lg">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3">Professional Title <span class="text-red-500">*</span></label>
                                <input type="text" name="title" value="{{ $user->title }}"
                                    class="w-full px-6 py-4 border border-gray-200 rounded-2xl focus:outline-none focus:border-teal-600 text-lg">
                            </div>
                            {{-- <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3">Languages Spoken <span
                                        class="text-red-500">*</span></label>
                                <div class="flex flex-wrap gap-3">
                                    <button
                                        class="lang-btn px-6 py-3 bg-teal-100 text-teal-800 rounded-2xl font-medium border-2 border-teal-600">English</button>
                                    <button
                                        class="lang-btn px-6 py-3 bg-gray-100 hover:bg-gray-200 rounded-2xl font-medium">Spanish</button>
                                    <button
                                        class="lang-btn px-6 py-3 bg-gray-100 hover:bg-gray-200 rounded-2xl font-medium">Mandarin</button>
                                    <button
                                        class="lang-btn px-6 py-3 bg-gray-100 hover:bg-gray-200 rounded-2xl font-medium">Hindi</button>
                                    <button
                                        class="lang-btn px-6 py-3 bg-gray-100 hover:bg-gray-200 rounded-2xl font-medium">Arabic</button>
                                </div>
                            </div> --}}
                        </div>
                    @elseif ($_next === 'contact')
                        <div class="space-y-8">
                            <input type="hidden" name="_next" value="personal_info">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="text" name="email" readonly value="{{ $user->email }}"
                                    class="w-full px-6 py-4 border border-gray-200 rounded-2xl focus:outline-none focus:border-teal-600 text-lg">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                                <input type="text" name="phone" value="{{ $user->phone }}"
                                    class="w-full px-6 py-4 border border-gray-200 rounded-2xl focus:outline-none focus:border-teal-600 text-lg">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">WhatsApp</label>
                                <input type="text" name="whatsapp" value="{{ $user->whatsapp }}"
                                    class="w-full px-6 py-4 border border-gray-200 rounded-2xl focus:outline-none focus:border-teal-600 text-lg">
                            </div>
                        </div>
                    @elseif ($_next === 'personal_info')
                        <div class="space-y-8">
                            <input type="hidden" name="_next" value="about_bio">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Designation</label>
                                <input type="text" name="designation" value="{{ $user->designation }}"
                                    class="w-full px-6 py-4 border border-gray-200 rounded-2xl focus:outline-none focus:border-teal-600 text-lg">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Work Address</label>
                                <input type="text" name="work_address" value="{{ $user->work_address }}"
                                    class="w-full px-6 py-4 border border-gray-200 rounded-2xl focus:outline-none focus:border-teal-600 text-lg">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">About</label>
                                <input type="text" name="about" value="{{ $user->about }}"
                                    class="w-full px-6 py-4 border border-gray-200 rounded-2xl focus:outline-none focus:border-teal-600 text-lg">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Experience</label>
                                <input type="text" name="experience" value="{{ $user->experience }}"
                                    class="w-full px-6 py-4 border border-gray-200 rounded-2xl focus:outline-none focus:border-teal-600 text-lg">
                            </div>
                        </div>
                    @elseif ($_next === 'about_bio')
                        <div class="space-y-8">
                            <input type="hidden" name="_next" value="review">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Business Name </label>
                                <input name="business_name" type="text" value="{{ $user->business_name }}"
                                    class="w-full px-6 py-4 border border-gray-200 rounded-2xl focus:outline-none focus:border-teal-600 text-lg">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Owner Name </label>
                                <input type="text" name="name" value="{{ $user->name }}"
                                    class="w-full px-6 py-4 border border-gray-200 rounded-2xl focus:outline-none focus:border-teal-600 text-lg">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3">Professional Title</label>
                                <input type="text" name="title" value="{{ $user->title }}"
                                    class="w-full px-6 py-4 border border-gray-200 rounded-2xl focus:outline-none focus:border-teal-600 text-lg">
                            </div>
                        </div>
                    @elseif ($_next === 'review')
                        <div class="space-y-8">
                            <input type="hidden" name="_next" value="business">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Business Name</label>
                                <input name="business_name" type="text" value="{{ $user->business_name }}"
                                    class="w-full px-6 py-4 border border-gray-200 rounded-2xl focus:outline-none focus:border-teal-600 text-lg">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Owner Name</label>
                                <input type="text" name="name" value="{{ $user->name }}"
                                    class="w-full px-6 py-4 border border-gray-200 rounded-2xl focus:outline-none focus:border-teal-600 text-lg">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3">Professional Title</label>
                                <input type="text" name="title" value="{{ $user->title }}"
                                    class="w-full px-6 py-4 border border-gray-200 rounded-2xl focus:outline-none focus:border-teal-600 text-lg">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3">Phone</label>
                                <input type="text" name="phone" value="{{ $user->phone }}"
                                    class="w-full px-6 py-4 border border-gray-200 rounded-2xl focus:outline-none focus:border-teal-600 text-lg">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3">Email</label>
                                <input type="text" name="email" value="{{ $user->email }}"
                                    class="w-full px-6 py-4 border border-gray-200 rounded-2xl focus:outline-none focus:border-teal-600 text-lg">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3">Work Address</label>
                                <input type="text" name="work_address" value="{{ $user->work_address }}"
                                    class="w-full px-6 py-4 border border-gray-200 rounded-2xl focus:outline-none focus:border-teal-600 text-lg">
                            </div>
                        </div>
                    @endif
                    <div class="mt-12 flex gap-4">
                        <button type="submit"
                            class="flex-1 py-5 bg-teal-700 hover:bg-teal-800 text-white font-semibold rounded-2xl transition-all">
                            Save & Next →
                        </button>
                    </div>
                </form>
            </div>

            <!-- Right Sidebar - Landing Page Preview (Unchanged) -->
            <div class="lg:col-span-5">
                <div class="bg-white rounded-3xl p-8 shadow-sm">
                    <h4 class="font-semibold text-xl mb-2">Your Landing Page Preview</h4>
                    <p class="text-gray-500 text-sm mb-6">This is exactly how customers will see your exclusive Zonely
                        page</p>

                    <div class="landing-preview border border-gray-200 shadow-inner bg-white">
                        <!-- Hero Header -->
                        <div class="bg-gradient-to-r from-teal-800 to-indigo-700 p-8 text-white">
                            <div class="flex items-center gap-5">
                                <div
                                    class="w-24 h-24 bg-white rounded-2xl overflow-hidden border-4 border-white flex-shrink-0">
                                    <img src="https://via.placeholder.com/120x120/ffffff/1e40af?text=👨‍💼" alt="Profile"
                                        class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <span
                                        class="inline-flex items-center gap-2 bg-green-400 text-green-900 text-xs px-4 py-1 rounded-full font-semibold">
                                        <i class="fas fa-check-circle"></i> VERIFIED
                                    </span>
                                    <h1 class="text-3xl font-bold mt-4 leading-tight"></h1>
                                    <p class="text-teal-100 mt-2">Tax, Accounting & Legal Services</p>
                                </div>
                            </div>
                        </div>
                        <!-- Services -->
                        <div class="p-8 border-b">
                            <h3 class="font-semibold mb-4 text-gray-800">Our Services</h3>
                            <div class="flex flex-wrap gap-2">
                                <span class="bg-teal-50 text-teal-800 px-5 py-2.5 rounded-2xl text-sm">Tax Preparation &
                                    Filing</span>
                                <span class="bg-teal-50 text-teal-800 px-5 py-2.5 rounded-2xl text-sm">Small Business
                                    Accounting</span>
                                <span class="bg-teal-50 text-teal-800 px-5 py-2.5 rounded-2xl text-sm">Bookkeeping</span>
                                <span class="bg-teal-50 text-teal-800 px-5 py-2.5 rounded-2xl text-sm">IRS Audit
                                    Support</span>
                                <span class="bg-teal-50 text-teal-800 px-5 py-2.5 rounded-2xl text-sm">Financial
                                    Consulting</span>
                            </div>
                        </div>
                        <!-- Stats -->
                        <div class="grid grid-cols-3 gap-4 px-8 py-6 bg-gray-50 border-b">
                            <div class="text-center">
                                <div class="text-3xl font-bold">5+</div>
                                <div class="text-xs text-gray-500">Years Experience</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-teal-700">98%</div>
                                <div class="text-xs text-gray-500">Success Rate</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold">450+</div>
                                <div class="text-xs text-gray-500">Happy Clients</div>
                            </div>
                        </div>
                        <!-- About -->
                        <div class="p-8 border-b">
                            <h3 class="font-semibold mb-3">About Us</h3>
                            <p class="text-gray-600 leading-relaxed text-sm">
                                NY Family Law Group is a trusted professional services firm based in New York.
                                We provide expert legal and accounting support with a focus on personalized service and
                                outstanding results.
                            </p>
                        </div>
                        <!-- Contact Section -->
                        <div class="p-8">
                            <h3 class="font-semibold mb-5">Get In Touch</h3>
                            <div class="space-y-4">
                                <button
                                    class="w-full flex items-center justify-center gap-3 bg-white border border-gray-300 hover:border-teal-600 py-5 rounded-2xl font-medium transition-all">
                                    <i class="fas fa-phone text-xl text-teal-700"></i>
                                    Call Now: (917) 561-0271
                                </button>
                                <button
                                    class="w-full bg-teal-700 hover:bg-teal-800 text-white py-5 rounded-2xl font-semibold transition-all">
                                    Submit Your Case Now
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-6 flex gap-4">
                        <button
                            class="flex-1 py-4 bg-teal-700 text-white font-semibold rounded-2xl hover:bg-teal-800 transition-all">
                            ✅ Use This Design
                        </button>
                        <button class="flex-1 py-4 bg-gray-100 hover:bg-gray-200 font-semibold rounded-2xl transition-all">
                            Change Design
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
