<!-- resources/views/main/partials/role-add.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Role') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('roles.store') }}">
                        @csrf
                        <!-- Role Name -->
                        <div>
                            <x-input-label for="role_name" :value="__('Role Name')" />
                            <x-text-input id="role_name" class="block mt-1 w-full" type="text" name="role_name" required autofocus />
                            <x-input-error :messages="$errors->get('role_name')" class="mt-2" />
                        </div>

                        <!-- Role Description -->
                        <div class="mt-4">
                            <x-input-label for="role_description" :value="__('Role Description')" />
                            <x-text-input id="role_description" class="block mt-1 w-full" type="text" name="role_description" required />
                            <x-input-error :messages="$errors->get('role_description')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Add Role') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>