<script setup>
import { ref, onMounted } from 'vue'; // Make sure onMounted is imported
import { usePage } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue';

const { props } = usePage();
const items = ref(props.items.data);
const search = ref(props.search || '');
const paginationLinks = ref(props.items.links);
const paginationMeta = ref(props.meta);

const fetchItems = (url = null) => {
    const options = { search: search.value, preserveState: true };
    if (url) {
        // Make sure we use Inertia.visit or Inertia.get with the correct URL
        Inertia.visit(url, {
            method: 'get',
            preserveScroll: true,
            preserveState: true,
            data: options,
        });
    } else {
        // When no URL is provided, fallback to the base route
        Inertia.get(route('items.index'), options);
    }
};

const searchItems = () => {
    Inertia.get(route('items.index'), { search: search.value }, { preserveState: true });
};

onMounted(() => {
    search.value = props.search || '';
    console.log('Components at Items.vue mounted!');
    console.log('Items:', items.value);
    console.log('Pagination Links:', paginationLinks.value);
    console.log('Pagination Meta:', paginationMeta.value);
});
</script>

<template>
    <AuthenticatedLayout>
        <!-- Header and Add New Item button -->
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Items
                </h2>
                <a v-if="props.can.isAdmin" :href="route('items.add')" class="text-white font-bold py-2 px-4 box-border bg-gray-800 rounded-md border border-gray-700 p-4">
                    Add New Item
                </a>
            </div>
        </template>

        <!-- Main Content -->
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Search Form -->
                <form @submit.prevent="searchItems" class="form-inline rounded-md py-4 flex items-center">
                    <input v-model="search" type="text" name="search" class="form-control mr-2 rounded-md border-gray-300 px-4" placeholder="Search items">
                    <button type="submit" class="btn btn-primary rounded-md bg-gray-800 text-white px-4 py-2">Search</button>
                </form>

                <!-- Items Table -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <table class="min-w-full divide-y divide-gray-200 w-full border border-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th v-if="props.can.isAdmin" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">ID</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">Name</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">Category</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">Quantity</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">Price</th>
                                    <th v-if="props.can.isAdmin" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-300">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-if="items.length === 0">
                                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center border border-gray-300">No items found</td>
                                </tr>
                                <tr v-else v-for="item in items" :key="item.item_id">
                                    <td v-if="props.can.isAdmin" class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ item.item_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ item.item_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ item.item_category }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap border border-gray-300">{{ item.item_quantity }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap border border-gray-300">Rp{{ item.item_price }}</td>
                                    <td v-if="props.can.isAdmin" class="px-6 py-4 whitespace-nowrap text-center border border-gray-300">
                                        <a :href="route('items.edit', item.item_id)" class="btn btn-sm btn-warning mr-2 bg-gray-400 rounded border px-2 py-2">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="mt-4">
                            <!-- Pagination component with event listener -->
                            <Pagination 
                                :links="paginationLinks" 
                                :meta="paginationMeta" 
                                @pageChanged="fetchItems"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>