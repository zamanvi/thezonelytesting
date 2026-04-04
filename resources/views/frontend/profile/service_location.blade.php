@extends('frontend.layouts.__app')

@section('content')
    <div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-2xl p-8 md:p-12 border border-slate-100">
        <form id="proSignupForm"
            action="{{ route('save.seller.profile', ['type' => $user->type, 'setup' => 'service_location']) }}" method="POST"
            class="space-y-10">
            @csrf

            <div class="step" data-step="2">
                <h2 class="text-3xl font-bold mb-6">Your Services & Service Locations</h2>
                <div class="space-y-12">
                    <div class="space-y-8" id="category-wrapper">
                        <div>
                            <label class="block text-lg font-semibold mb-3">Primary Service
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

                            <div id="category-container"></div>
                        </div>
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
                                    <input type="text" placeholder="Neighborhood or notes" name="additional_details"
                                        class="address-notes w-full px-6 py-5 rounded-2xl border border-slate-300 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-between mt-16">
                    <button type="button" class="prev-step text-slate-600 font-bold hover:text-slate-900 transition">←
                        Back</button>
                    <button type="button"
                        class="next-step bg-slate-900 text-white px-10 py-5 rounded-3xl font-bold hover:bg-blue-600 transition shadow-lg">Next
                        →</button>
                </div>
            </div>

        </form>
    </div>
@endsection

@section('script')
    <script>
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
        });

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
        const nextBtns = document.querySelectorAll('.next-step');

        function validateStep() {
            const required = document.querySelectorAll('input[required], select[required], textarea[required]');
            let valid = true;
            required.forEach(field => {
                if (!field.value.trim()) {
                    valid = false;
                    field.classList.add('border-red-500');
                } else {
                    field.classList.remove('border-red-500');
                }
            });
            return valid;
        }

        nextBtns.forEach(btn => btn.addEventListener('click', () => {
            if (validateStep()) {
                document.getElementById('proSignupForm').submit();
            } else if (!validateStep()) {
                alert('Please fill all required fields correctly.');
            }
        }));
    </script>
@endsection
