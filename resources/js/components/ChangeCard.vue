<template>
    <div class="flex items-center justify-center mb-6">
        <span class="p-4 font-bold text-prim bg-sec rounded">
            {{ card.brand }}
        </span>
        <div class="flex flex-col mx-4 items-start">
            <span> ****{{ card.last4 }} </span>
            <span class="text-gray-400">
                Expire on {{ card.exp_month }}/{{ card.exp_year }}
            </span>
        </div>
        <div>
            <button
                @click="change"
                class="bg-gray-500 text-white p-3 rounded transform transition hover:scale-105 duration-300 ease-in-out"
            >
                Change Payment Method
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: ["card"],
    mounted() {
        // console.log(this.card);
    },
    methods: {
        change() {
            console.log(this.card);
        }
    }
};
</script>
