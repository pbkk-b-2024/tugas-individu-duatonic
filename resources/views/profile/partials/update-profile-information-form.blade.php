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

        <!-- Avatar Section -->
        <div>
            <x-input-label for="profile_picture"/>
            <div class="flex flex-col items-center gap-4">
                <img src="{{ Storage::url($user->avatar) }}" alt="Avatar" class="w-20 h-20 rounded-full">
                <!-- Open Modal for Updating Avatar -->
                <x-secondary-button
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'update-user-avatar')"
                    class="mt-2"
                >{{ __('Change Profile Picture') }}</x-secondary-button>
            </div>
        </div>
        
        <!-- Hidden Input Box for Avatar -->
        <input type="hidden" id="selected_avatar" name="selected_avatar" value="{{ $user->avatar }}">

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

        <!-- User's Role -->
        <div>
            <x-input-label for="role" :value="__('Role')" />
            <x-text-input id="role" name="role" type="text" class="mt-1 block w-full" :value="$role->role_name" readonly />
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

        <!-- Update Avatar Modal -->
        <x-modal name="update-user-avatar" :show="$errors->userDeletion->isNotEmpty()" focusable class="z-1">
            <div class="p-6">
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
                                <label for="picture_{{ $loop->index }}" class="mx-3">
                                    <img src="{{ Storage::url($picture) }}" alt="Available Picture" class="z-10 cursor-pointer w-20 h-20 rounded-full border-2 border-transparent peer-checked:border-indigo-500 focus:border-indigo-500 hover:border-gray-400" x-on:click="setCurrentImage('{{ Storage::url($picture) }}')">
                                </label>
                            </div>
                        @endforeach
                        </div>
                    </div>
                    
                    <x-input-error class="mt-2" :messages="$errors->get('selected_picture')" />
                
                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                        </x-secondary-button>
                
                        <x-primary-button class="ms-3" x-on:click="saveAvatarChoice()">
                            {{ __('Save') }}
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </x-modal>
    </form>
</section>

<!-- Alpine.js Slider Functionality -->
<script>
    function imageSlider() {
        return {
            currentImage: '',
            selectedAvatar: '',
            init() {
                this.currentImage = document.getElementById('avatar_preview').src;
            },
            setCurrentImage(imageUrl, avatarPath) {
                this.currentImage = imageUrl;
                this.selectedAvatar = avatarPath;
                document.getElementById('avatar_preview').src = imageUrl;
            },
            saveAvatarChoice() {
                document.getElementById('selected_avatar').value = this.selectedAvatar;
                this.$dispatch('close');
            }
        }
    }

    // Handle file input to update avatar preview
    document.getElementById('avatar').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imageUrl = e.target.result;
                document.getElementById('avatar_preview').src = imageUrl;
                imageSlider().setCurrentImage(imageUrl, '');
            }
            reader.readAsDataURL(file);
        }
    });
</script>

<style>
    .selected-avatar {
        border-color: #4f46e5; /* Highlight border color (indigo) */
        border-width: 2px;
    }
</style>