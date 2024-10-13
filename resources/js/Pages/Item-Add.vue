<script setup>
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

// Get page props
const { props } = usePage();

// Initialize form state
const form = ref({
    item_id: '',
    item_name: '',
    item_category: '',
    item_price: 0,
    item_quantity: 0,
    errors: props.errors || {},
});

// Method to handle item submission
const addItem = () => {
    // Clear existing errors
    form.value.errors = {};

    // Submit form data via Inertia
    Inertia.post(route('items.store'), form.value, {
        onError: (errors) => {
            form.value.errors = errors;
        },
        onSuccess: () => {
            console.log('Item added successfully!');
            // Optionally, reset form after success
            form.value.item_id = '';
            form.value.item_name = '';
            form.value.item_category = '';
            form.value.item_price = 0;
            form.value.item_quantity = 0;
        }
    });
};
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add Item
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 flex justify-center">
                        <form @submit.prevent="addItem" class="w-full max-w-lg">
                            <!-- Item Name -->
                            <div class="mt-4">
                                <InputLabel for="item_name" value="Item Name" />
                                <TextInput 
                                    id="item_name" 
                                    class="block mt-1 w-full" 
                                    type="text" 
                                    v-model="form.item_name" 
                                    required 
                                />
                                <InputError :messages="form.errors.item_name" class="mt-2" />
                            </div>

                            <!-- Item Category -->
                            <div class="mt-4">
                                <InputLabel for="item_category" value="Item Category" />
                                <TextInput 
                                    id="item_category" 
                                    class="block mt-1 w-full" 
                                    type="text" 
                                    v-model="form.item_category" 
                                    required 
                                />
                                <InputError :messages="form.errors.item_category" class="mt-2" />
                            </div>

                            <!-- Item Price -->
                            <div class="mt-4">
                                <InputLabel for="item_price" value="Item Price (IDR)" />
                                <TextInput 
                                    id="item_price" 
                                    class="block mt-1 w-full" 
                                    type="number" 
                                    step="0.01" 
                                    v-model="form.item_price" 
                                    required 
                                />
                                <InputError :messages="form.errors.item_price" class="mt-2" />
                            </div>

                            <!-- Item Quantity -->
                            <div class="mt-4">
                                <InputLabel for="item_quantity" value="Item Quantity" />
                                <TextInput 
                                    id="item_quantity" 
                                    class="block mt-1 w-full" 
                                    type="number" 
                                    v-model="form.item_quantity" 
                                    required 
                                />
                                <InputError :messages="form.errors.item_quantity" class="mt-2" />
                            </div>

                            <!-- Submit Button -->
                            <div class="flex items-center justify-end mt-4">
                                <PrimaryButton>
                                    Add Item
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>