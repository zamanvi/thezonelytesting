@extends('frontend.layouts.__app')

@section('content')
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
            <div class="text-lg font-semibold">Profile Completion: <span class="text-blue-600">65%</span></div>
            <div class="text-sm text-gray-500">4 steps remaining to receive leads</div>
        </div>
        <div class="h-3 bg-gray-100 rounded-full overflow-hidden">
            <div class="h-3 bg-blue-600 rounded-full w-[65%]"></div>
        </div>
    </div>

    <!-- Wizard Steps -->
    <div class="flex gap-2 mb-10 overflow-x-auto pb-3">
        <div class="step-active cursor-pointer px-7 py-3 rounded-2xl font-medium text-sm whitespace-nowrap">1.
            Business Basics</div>
        <div
            class="cursor-pointer px-7 py-3 rounded-2xl font-medium text-sm bg-gray-100 hover:bg-gray-200 whitespace-nowrap">
            2. Contact</div>
        <div
            class="cursor-pointer px-7 py-3 rounded-2xl font-medium text-sm bg-gray-100 hover:bg-gray-200 whitespace-nowrap">
            3. Professional Info</div>
        <div 
            class="cursor-pointer px-7 py-3 rounded-2xl font-medium text-sm bg-gray-100 hover:bg-gray-200 whitespace-nowrap">
            4. About & Bio</div>
        <div 
            class="cursor-pointer px-7 py-3 rounded-2xl font-medium text-sm bg-gray-100 hover:bg-gray-200 whitespace-nowrap">
            5. Preview</div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Left Form - Unchanged -->
        <div class="lg:col-span-7 bg-white rounded-3xl p-10 shadow-sm">
            <h3 class="text-3xl font-semibold mb-2">Business Basics</h3>
            <p class="text-gray-500 mb-8">Tell us about your business so we can create your exclusive landing page.
            </p>
            <div class="space-y-8">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Business Name <span
                            class="text-red-500">*</span></label>
                    <input type="text" value="NY Family Law Group"
                        class="w-full px-6 py-4 border border-gray-200 rounded-2xl focus:outline-none focus:border-blue-500 text-lg">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Owner Name <span
                            class="text-red-500">*</span></label>
                    <input type="text" value="Johnathan Rivera, Esq."
                        class="w-full px-6 py-4 border border-gray-200 rounded-2xl focus:outline-none focus:border-blue-500 text-lg">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Professional Title <span
                            class="text-red-500">*</span></label>
                    <div class="flex flex-wrap gap-3">
                        <button onclick="selectTitle(this)"
                            class="title-btn px-6 py-3 bg-blue-600 text-white rounded-2xl font-medium">Attorney at
                            Law</button>
                        <button onclick="selectTitle(this)"
                            class="title-btn px-6 py-3 bg-gray-100 hover:bg-gray-200 rounded-2xl font-medium">CPA</button>
                        <button onclick="selectTitle(this)"
                            class="title-btn px-6 py-3 bg-gray-100 hover:bg-gray-200 rounded-2xl font-medium">Medical
                            Doctor</button>
                        <button onclick="selectTitle(this)"
                            class="title-btn px-6 py-3 bg-gray-100 hover:bg-gray-200 rounded-2xl font-medium">Real
                            Estate Agent</button>
                        <button onclick="selectTitle(this)"
                            class="title-btn px-6 py-3 bg-gray-100 hover:bg-gray-200 rounded-2xl font-medium">Other</button>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Languages Spoken <span
                            class="text-red-500">*</span></label>
                    <div class="flex flex-wrap gap-3">
                        <button onclick="toggleLanguage(this)"
                            class="lang-btn px-6 py-3 bg-blue-100 text-blue-700 rounded-2xl font-medium border-2 border-blue-500">English</button>
                        <button onclick="toggleLanguage(this)"
                            class="lang-btn px-6 py-3 bg-gray-100 hover:bg-gray-200 rounded-2xl font-medium">Spanish</button>
                        <button onclick="toggleLanguage(this)"
                            class="lang-btn px-6 py-3 bg-gray-100 hover:bg-gray-200 rounded-2xl font-medium">Mandarin</button>
                        <button onclick="toggleLanguage(this)"
                            class="lang-btn px-6 py-3 bg-gray-100 hover:bg-gray-200 rounded-2xl font-medium">Hindi</button>
                        <button onclick="toggleLanguage(this)"
                            class="lang-btn px-6 py-3 bg-gray-100 hover:bg-gray-200 rounded-2xl font-medium">Arabic</button>
                    </div>
                </div>
            </div>
            <div class="mt-12 flex gap-4">
                <button 
                    class="flex-1 py-5 bg-gray-100 hover:bg-gray-200 font-semibold rounded-2xl transition-all">
                    Save Draft
                </button>
                <button 
                    class="flex-1 py-5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-2xl transition-all">
                    Next: Contact Information →
                </button>
            </div>
        </div>

        <!-- Right Sidebar - Landing Page Preview (Unchanged) -->
        <div class="lg:col-span-5">
            <div class="bg-white rounded-3xl p-8 shadow-sm">
                <h4 class="font-semibold text-xl mb-2">Your Landing Page Preview</h4>
                <p class="text-gray-500 text-sm mb-6">This is exactly how customers will see your exclusive Zonely
                    page</p>

                <div class="landing-preview border border-gray-200 shadow-inner bg-white">
                    <!-- Hero Header -->
                    <div class="bg-gradient-to-r from-blue-700 to-indigo-700 p-8 text-white">
                        <div class="flex items-center gap-5">
                            <div class="w-24 h-24 bg-white rounded-2xl overflow-hidden border-4 border-white flex-shrink-0">
                                <img src="https://via.placeholder.com/120x120/ffffff/1e40af?text=👨‍💼" alt="Profile"
                                    class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <span
                                    class="inline-flex items-center gap-2 bg-green-400 text-green-900 text-xs px-4 py-1 rounded-full font-semibold">
                                    <i class="fas fa-check-circle"></i> VERIFIED
                                </span>
                                <h1 class="text-3xl font-bold mt-4 leading-tight">Best CPA in Bronx NY | NY Family
                                    Law Group</h1>
                                <p class="text-blue-100 mt-2">Tax, Accounting & Legal Services</p>
                            </div>
                        </div>
                    </div>
                    <!-- Services -->
                    <div class="p-8 border-b">
                        <h3 class="font-semibold mb-4 text-gray-800">Our Services</h3>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-blue-50 text-blue-700 px-5 py-2.5 rounded-2xl text-sm">Tax Preparation &
                                Filing</span>
                            <span class="bg-blue-50 text-blue-700 px-5 py-2.5 rounded-2xl text-sm">Small Business
                                Accounting</span>
                            <span class="bg-blue-50 text-blue-700 px-5 py-2.5 rounded-2xl text-sm">Bookkeeping</span>
                            <span class="bg-blue-50 text-blue-700 px-5 py-2.5 rounded-2xl text-sm">IRS Audit
                                Support</span>
                            <span class="bg-blue-50 text-blue-700 px-5 py-2.5 rounded-2xl text-sm">Financial
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
                            <div class="text-3xl font-bold text-blue-600">98%</div>
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
                                class="w-full flex items-center justify-center gap-3 bg-white border border-gray-300 hover:border-blue-500 py-5 rounded-2xl font-medium transition-all">
                                <i class="fas fa-phone text-xl text-blue-600"></i>
                                Call Now: (917) 561-0271
                            </button>
                            <button 
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-5 rounded-2xl font-semibold transition-all">
                                Submit Your Case Now
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 flex gap-4">
                    <button 
                        class="flex-1 py-4 bg-blue-600 text-white font-semibold rounded-2xl hover:bg-blue-700 transition-all">
                        ✅ Use This Design
                    </button>
                    <button 
                        class="flex-1 py-4 bg-gray-100 hover:bg-gray-200 font-semibold rounded-2xl transition-all">
                        Change Design
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
