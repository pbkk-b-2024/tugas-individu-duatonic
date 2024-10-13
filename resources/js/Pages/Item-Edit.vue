<script setup>
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';

const { props } = usePage();
const item = ref(props.item);
const form = ref({
    item_name: item.value?.item_name || '',
    item_category: item.value?.item_category || '',
    item_price: item.value?.item_price || 0,
    item_quantity: item.value?.item_quantity || 0,
    errors: props.errors || {},
});

const updateItem = () => {
    Inertia.patch(route('items.update', item.value.item_id), form.value, {
        onError: (errors) => {
            form.value.errors = errors;
        },
    });
};

const deleteItem = () => {
    Inertia.delete(route('items.destroy', item.value.item_id));
};
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Edit {{ item.item_name }}'s data
                </h2>
                <form @submit.prevent="deleteItem">
                    <DangerButton class="ms-4">
                        Delete
                    </DangerButton>
                </form>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 flex justify-center">
                        <form @submit.prevent="updateItem" class="w-full max-w-lg">
                            <!-- Name -->
                            <div>
                                <InputLabel for="name" value="Name" />
                                <TextInput id="name" class="block mt-1 w-full" type="text" v-model="form.item_name" required autofocus autocomplete="item_name" />
                                <InputError :messages="form.errors.item_name" class="mt-2" />
                            </div>

                            <!-- Category -->
                            <div class="mt-4">
                                <InputLabel for="category" value="Category" />
                                <TextInput id="category" class="block mt-1 w-full" type="text" v-model="form.item_category" required autocomplete="item_category" />
                                <InputError :messages="form.errors.item_category" class="mt-2" />
                            </div>

                            <!-- Price -->
                            <div class="mt-4">
                                <InputLabel for="price" value="Price" />
                                <TextInput id="price" class="block mt-1 w-full" type="number" v-model="form.item_price" required min="0" step="0.01" />
                                <InputError :messages="form.errors.item_price" class="mt-2" />
                            </div>

                            <!-- Quantity -->
                            <div class="mt-4">
                                <InputLabel for="quantity" value="Quantity" />
                                <TextInput id="quantity" class="block mt-1 w-full" type="number" v-model="form.item_quantity" required min="0" />
                                <InputError :messages="form.errors.item_quantity" class="mt-2" />
                            </div>

                            <div class="flex justify-end mt-4">
                                <PrimaryButton class="ms-4">
                                    Save
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>