<template>
    <div class="flex items-center justify-center mb-6">
        <span class="p-4 font-bold text-prim bg-sec rounded">
            {{ pay.card.brand }}
        </span>
        <div class="flex flex-col mx-4 items-start">
            <span> ****{{ pay.card.last4 }} </span>
            <span class="text-gray-400">
                Expire on {{ pay.card.exp_month }}/{{ pay.card.exp_year }}
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
    props: ["pay", "setPay"],
    mounted() {
        // console.log(this.pay);
    },
    methods: {
        change(pay) {
            this.setPay(null);
        }
    }
};
</script>
