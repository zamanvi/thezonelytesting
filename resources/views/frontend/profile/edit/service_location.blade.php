@extends('frontend.profile.edit.layout')

@section('form')
    <h2 class="text-3xl font-bold mb-6">Your Services & Service Locations</h2>

    <form method="POST" action="{{ route('save.seller.profile', ['type' => $type, 'setup' => 'service_location']) }}">
        @csrf

        <div class="space-y-12">

            <!-- 🔷 Category -->
            <div>
                <label class="block text-lg font-semibold text-slate-800 mb-3">
                    Primary Service Category <span class="text-red-500">*</span>
                </label>

                <select name="category_id"
                    class="category-select w-full px-6 py-5 rounded-3xl border border-slate-300 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none">

                    <option value="">Select your main category</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $user->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- 🔷 Service Location (🔥 SAME AS REGISTRATION) -->
            <div>
                <label class="block text-lg font-semibold text-slate-800 mb-3">
                    Service Locations <span class="text-red-500">*</span>
                </label>

                <p class="text-sm text-slate-500 mb-6">Add precise areas you serve.</p>

                <div id="locationsContainer" class="space-y-8">

                    <div
                        class="location-block p-8 bg-gradient-to-r from-slate-50 to-blue-50 rounded-3xl border border-slate-200 shadow-sm">

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                            <!-- Country -->
                            <div>
                                <label class="block text-sm font-bold text-slate-600 mb-2">
                                    Country <span class="text-red-500">*</span>
                                </label>

                                <select name="country"
                                    class="country-select w-full px-6 py-5 rounded-2xl border border-slate-300 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none">
                                    <option value="">Select Country</option>
                                </select>
                            </div>

                            <!-- State -->
                            <div>
                                <label class="block text-sm font-bold text-slate-600 mb-2">
                                    State / Province <span class="text-red-500">*</span>
                                </label>

                                <select name="state"
                                    class="state-select w-full px-6 py-5 rounded-2xl border border-slate-300 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none"
                                    disabled>
                                    <option value="">Select State</option>
                                </select>
                            </div>

                            <!-- City -->
                            <div>
                                <label class="block text-sm font-bold text-slate-600 mb-2">
                                    City <span class="text-red-500">*</span>
                                </label>

                                <select name="city"
                                    class="city-select w-full px-6 py-5 rounded-2xl border border-slate-300 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none"
                                    disabled>
                                    <option value="">Select City</option>
                                </select>
                            </div>

                            <!-- ZIP -->
                            <div>
                                <label class="block text-sm font-bold text-slate-600 mb-2">
                                    ZIP / Postal Code <span class="text-red-500">*</span>
                                </label>

                                <select name="zip_code"
                                    class="zip-select w-full px-6 py-5 rounded-2xl border border-slate-300 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none"
                                    disabled>
                                    <option value="">Select ZIP Code</option>
                                </select>
                            </div>

                        </div>

                        <!-- Additional -->
                        <div class="mt-6">
                            <label class="block text-sm font-bold text-slate-600 mb-2">
                                Additional Details (optional)
                            </label>

                            <input type="text" name="additional_details" value="{{ $user->additional_details }}"
                                placeholder="Neighborhood or notes"
                                class="address-notes w-full px-6 py-5 rounded-2xl border border-slate-300 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition">
                        </div>

                    </div>

                </div>

                <!-- 🔥 Hidden Old Values -->
                <input type="hidden" id="old_country" value="{{ $user->country }}">
                <input type="hidden" id="old_state" value="{{ $user->state }}">
                <input type="hidden" id="old_city" value="{{ $user->city }}">
                <input type="hidden" id="old_zip" value="{{ $user->zip_code }}">
            </div>

        </div>

        <!-- Save Button -->
        <div class="mt-10 text-right">
            <button class="btn-primary">Save & Continue →</button>
        </div>

    </form>
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let oldCountry = document.getElementById('old_country').value;
            let oldState = document.getElementById('old_state').value;
            let oldCity = document.getElementById('old_city').value;
            let oldZip = document.getElementById('old_zip').value;

            if (oldCountry) {
                $('.country-select').val(oldCountry).trigger('change');

                setTimeout(() => {
                    $('.state-select').val(oldState).trigger('change');

                    setTimeout(() => {
                        $('.city-select').val(oldCity).trigger('change');

                        setTimeout(() => {
                            $('.zip-select').val(oldZip);
                        }, 500);

                    }, 500);

                }, 500);
            }

        });
    </script>
@endsection
