<!-- resources/views/main/partials/item-add.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('items.store') }}">
                        @csrf
                        <!-- Item Name -->
                        <div class="mt-4">
                            <x-input-label for="item_name" :value="__('Item Name')" />
                            <x-text-input id="item_name" class="block mt-1 w-full" type="text" name="item_name" :value="old('item_name')" required />
                            <x-input-error :messages="$errors->get('item_name')" class="mt-2" />
                        </div>

                        <!-- Item Category -->
                        <div class="mt-4">
                            <x-input-label for="category" :value="__('Category')" />
                            <select id="category" name="category" class="block mt-1 w-full form-select rounded-md border-gray-300 shadow-sm focus:ring-indigo-500">
                                @foreach($categories as $category)
                                <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </div>

                        <!-- Item Price -->
                        <div class="mt-4">
                            <x-input-label for="item_price" :value="__('Item Price (IDR)')" />
                            <x-text-input id="item_price" class="block mt-1 w-full" type="number" step="0.01" name="item_price" :value="old('item_price')" required />
                            <x-input-error :messages="$errors->get('item_price')" class="mt-2" />
                        </div>

                        <!-- Item Quantity -->
                        <div class="mt-4">
                            <x-input-label for="item_quantity" :value="__('Item Quantity')" />
                            <x-text-input id="item_quantity" class="block mt-1 w-full" type="number" name="item_quantity" :value="old('item_quantity')" required />
                            <x-input-error :messages="$errors->get('item_quantity')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Add Item') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>