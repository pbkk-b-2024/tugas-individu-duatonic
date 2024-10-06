<!-- resources/views/profile/partials/update-profile-information-form.blade.php -->
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Profile Picture Section -->
        <div>
            <x-input-label for="profile_picture" :value="__('Profile Picture')" />
            <div class="flex items-center gap-4">
                <img src="{{ Storage::url($user->avatar) }}" alt="Profile Picture" class="w-16 h-16 rounded-full">
            </div>

            <!-- Upload New Picture -->
            <div class="mt-4">
                <label for="avatar" class="block text-sm font-medium text-gray-700">{{ __('Upload New Picture') }}</label>
                <input id="avatar" name="avatar" type="file" class="mt-1 block w-full">
                <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
            </div>

            <!-- Image Slider for Available Pictures -->
            <div class="mt-4">
                <label for="selected_picture" class="block text-sm font-medium text-gray-700">{{ __('Or Select from Available Pictures') }}</label>
                
                <div x-data="imageSlider()" class="relative mt-1">
                    <!-- Slider Container -->
                    <div class="flex space-x-4 overflow-x-auto scrollbar-hide" x-ref="slider">
                        @foreach ($availablePictures as $picture)
                            <div class="relative">
                                <input type="radio" id="picture_{{ $loop->index }}" name="selected_picture" value="{{ $picture }}" class="hidden peer">
                                <label for="picture_{{ $loop->index }}" class="cursor-pointer">
                                    <img src="{{ Storage::url($picture) }}" alt="Available Picture" class="cursor-pointer w-16 h-16 rounded-full border-2 border-transparent peer-checked:border-indigo-500 focus:border-indigo-500 hover:border-gray-400">
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <x-input-error class="mt-2" :messages="$errors->get('selected_picture')" />
            </div>
        </div>

        <!-- Name Field -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <!-- Email Field -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Save Button -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>

<!-- Alpine.js Slider Functionality -->
<script>
    function imageSlider() {
        return {
            sliderWidth: 0,
            itemWidth: 0,
            visibleItems: 4,
            init() {
                this.sliderWidth = this.$refs.slider.scrollWidth;
                this.itemWidth = this.$refs.slider.children[0].offsetWidth + 16; // Adding space between items
            },
            next() {
                this.$refs.slider.scrollBy({ left: this.itemWidth, behavior: 'smooth' });
            },
            prev() {
                this.$refs.slider.scrollBy({ left: -this.itemWidth, behavior: 'smooth' });
            }
        }
    }
</script>
