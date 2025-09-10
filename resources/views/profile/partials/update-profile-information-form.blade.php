<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Your email address: <b>{{ $user->email }}</b> <br>
            {{ __("Update your profile information.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text"
                    class="mt-1 block w-full"
                    :value="old('name', $user->name)"
                    required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" name="title" type="text"
                    class="mt-1 block w-full"
                    :value="old('title', $user->title)"
                    autocomplete="title" />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div>
                <x-input-label for="designation" :value="__('Designation')" />
                <x-text-input id="designation" name="designation" type="text"
                    class="mt-1 block w-full"
                    :value="old('designation', $user->designation)" required autocomplete="designation" />
                <x-input-error class="mt-2" :messages="$errors->get('designation')" />
            </div>
            <div>
                <x-input-label for="phone" :value="__('Phone')" />
                <x-text-input id="phone" name="phone" type="number"
                    class="mt-1 block w-full"
                    :value="old('phone', $user->phone)"
                    autocomplete="tel" />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div>
                <x-input-label for="whatsapp" :value="__('WhatsApp')" />
                <x-text-input id="whatsapp" name="whatsapp" type="text"
                    class="mt-1 block w-full"
                    :value="old('whatsapp', $user->whatsapp)"
                    autocomplete="tel" />
                <x-input-error class="mt-2" :messages="$errors->get('whatsapp')" />
            </div>
            <div>
                <x-input-label for="work_address" :value="__('Work Address')" />
                <x-text-input id="work_address" name="work_address" type="text"
                    class="mt-1 block w-full"
                    :value="old('work_address', $user->work_address)"
                    autocomplete="street-address" />
                <x-input-error class="mt-2" :messages="$errors->get('work_address')" />
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-6">
            <div>
                <x-input-label for="about" :value="__('About')" />
                <textarea id="about" 
                        name="about" 
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        rows="4"
                        autocomplete="about">{{ old('about', $user->about) }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('about')" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
