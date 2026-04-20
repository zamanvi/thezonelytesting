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
                        disabled></button>
                    <button type="submit"
                        class="bg-slate-900 text-white px-10 py-5 rounded-3xl font-bold hover:bg-blue-600 transition shadow-lg">
                        Create Account →
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('proSignupForm').addEventListener('submit', function(e) {
            const pwd = document.getElementById('password').value;
            const confirm = document.getElementById('confirmPassword').value;

            if (pwd !== confirm) {
                e.preventDefault();
                alert('Passwords do not match!');
            }
        });
    </script>
@endsection
