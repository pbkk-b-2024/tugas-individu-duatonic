<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit ' . $role->role_name . '\'s data') }}
            </h2>
            <form method="POST" action="{{ route('roles.destroy', $role->role_id) }}">
                @csrf
                @method('DELETE')
                <x-danger-button class="ms-4">
                    {{ __('Delete') }}
                </x-danger-button>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('roles.update', $role->role_id) }}" class="inline-block">
                        @csrf
                        @method('PATCH')

                        <!-- Name -->
                        <div class="mt-4">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="role_name" :value="old('role_name', $role->role_name)" required autofocus autocomplete="role_name" />
                            <x-input-error :messages="$errors->get('role_name')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <x-text-input id="description" class="block mt-1 w-full" type="text" name="role_description" :value="old('role_description', $role->role_description)" required autocomplete="role_description" />
                            <x-input-error :messages="$errors->get('role_description')" class="mt-2" />
                        </div>

                        <div class="flex justify-end mt-4">
                            <x-primary-button class="ms-4">
                            {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>