<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit ' . $item->item_name . '\'s data') }}
            </h2>
            <form method="POST" action="{{ route('items.destroy', $item->item_id) }}">
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
                    <form method="POST" action="{{ route('items.update', $item->item_id) }}" class="inline-block">
                        @csrf
                        @method('PATCH')

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="item_name" :value="old('item_name', $item->item_name)" required autofocus autocomplete="item_name" />
                            <x-input-error :messages="$errors->get('item_name')" class="mt-2" />
                        </div>

                        <!-- Category -->
                        <div class="mt-4">
                            <x-input-label for="category" :value="__('Category')" />
                            <select id="category" name="category" class="block mt-1 w-full form-select rounded-md border-gray-300 shadow-sm focus:ring-indigo-500">
                                @foreach($categories as $category)
                                <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </div>

                        <!-- Price -->
                        <div class="mt-4">
                            <x-input-label for="price" :value="__('Price')" />
                            <x-text-input id="price" class="block mt-1 w-full" type="number" name="item_price" :value="old('item_price', $item->item_price)" required min="0" step="0.01" />
                            <x-input-error :messages="$errors->get('item_price')" class="mt-2" />
                        </div>

                        <!-- Quantity -->
                        <div class="mt-4">
                            <x-input-label for="quantity" :value="__('Quantity')" />
                            <x-text-input id="quantity" class="block mt-1 w-full" type="number" name="item_quantity" :value="old('item_quantity', $item->item_quantity)" required min="0" />
                            <x-input-error :messages="$errors->get('item_quantity')" class="mt-2" />
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