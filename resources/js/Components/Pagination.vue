<template>
    <nav
        role="navigation"
        aria-label="Pagination Navigation"
        class="flex items-center justify-between"
    >
        <div
            v-if="links.length > 0"
            class="flex justify-between flex-1 sm:hidden"
        >
            <span
                v-if="links[0].url"
                @click="changePage(links[0].url)"
                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 leading-5 rounded-md cursor-pointer hover:text-gray-400 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
            >
                Previous
            </span>
            <span
                v-else
                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md"
            >
                Previous
            </span>
            <span
                v-if="links[links.length - 1].url"
                @click="changePage(links[links.length - 1].url)"
                class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 leading-5 rounded-md cursor-pointer hover:text-gray-400 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
            >
                Next
            </span>
            <span
                v-else
                class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md"
            >
                Next
            </span>
        </div>

        <div
            class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between"
        >
            <div>
                <p class="text-sm text-gray-700 leading-5">
                    Showing
                    <span class="font-medium">{{ meta.from }}</span>
                    to
                    <span class="font-medium">{{ meta.to }}</span>
                    of
                    <span class="font-medium">{{ meta.total }}</span>
                    results
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex shadow-sm rounded-md">
                    <span
                        v-for="link in links"
                        :key="link.label"
                        :class="[
                            { 'cursor-pointer': link.url },
                            { 'cursor-default': !link.url },
                            link.active
                                ? 'bg-indigo-50 border-indigo-500 text-indigo-600'
                                : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-100',
                        ]"
                        @click="link.url && changePage(link.url)"
                        v-html="link.label"
                        :aria-current="link.active ? 'page' : null"
                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium border leading-5 rounded-md focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
                    >
                    </span>
                </span>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { defineProps, defineEmits, onMounted } from "vue";

const props = defineProps({
    links: Array,
    meta: Object,
});

const emit = defineEmits(["pageChanged"]);

const changePage = (url) => {
    if (url) {
        emit('pageChanged', url);  // Emit the 'pageChanged' event with the correct URL
    }
};

onMounted(() => {
    console.log('Components at Pagination.vue mounted!');
    console.log('Props Links:', props.links); // Check if the array has pagination links
    console.log('Props Meta:', props.meta); // Check if the object has pagination meta
});
</script>

<style scoped>
.cursor-pointer {
    cursor: pointer;
}
.cursor-default {
    cursor: default;
}
</style>
