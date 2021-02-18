<template>
    <div
        v-bind:class="[
            value.select ? 'shadow-lg' : 'shadow-md',
            'flex flex-col w-5/6 lg:w-1/4 mx-auto lg:mx-0 rounded-none lg:rounded-l-lg bg-white mt-4'
        ]"
    >
        <div
            class="flex-1 bg-white text-gray-600 rounded-t rounded-b-none overflow-hidden shadow"
        >
            <div class="p-8 text-3xl font-bold text-center border-b-4">
                {{ value.title }}
            </div>
            <!-- <ul class="w-full text-center text-sm">
                <li class="border-b py-4">Thing</li>
                <li class="border-b py-4">Thing</li>
                <li class="border-b py-4">Thing</li>
            </ul> -->
        </div>
        <div
            class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-6"
        >
            <div
                class="w-full pt-6 text-3xl text-gray-600 font-bold text-center"
            >
                ${{ value.price }}
                <span class="text-base">{{ value.priceTxt }}</span>
            </div>
            <div class="flex items-center justify-center">
                <button
                    v-on:click="$emit('click', value)"
                    v-bind:class="value.select ? selectedClass : unselectClass"
                >
                    {{ value.select ? "Selected" : "Select" }}
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["value"],
    event: ["click"],
    mounted() {
        // console.log("price mount", this.value.title);
    },
    data() {
        return {
            unselectClass:
                "mx-auto lg:mx-0 bg-sec text-white font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out",
            selectedClass:
                "mx-auto lg:mx-0 bg-prim text-white font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline"
        };
    }
};
</script>
