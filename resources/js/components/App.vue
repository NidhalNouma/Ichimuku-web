<template>
    <div>
        <div
            class="flex flex-col sm:flex-row justify-center pt-12 my-12 sm:my-4"
        >
            <Price v-bind:value="p1" @click="selectPrice" />
            <Price v-bind:value="p2" @click="selectPrice" />
        </div>
        <Checkout v-if="p1.select === true" v-bind:pr="p1" :usr="usr" />
        <Checkout v-else-if="p2.select === true" v-bind:pr="p2" :usr="usr" />
    </div>
</template>

<script>
import Checkout from "./Checkout.vue";
import Price from "./Price.vue";
export default {
    props: ["usr", "session"],
    components: { Price, Checkout },
    mounted() {
        console.log(this.session);
    },
    data() {
        return {
            p1: {
                id: 1,
                title: "Monthly",
                price: 19.99,
                priceTxt: "/ per mounth",
                select: false
            },
            p2: {
                id: 2,
                title: "Annully",
                price: 199.99,
                priceTxt: "/ per year",
                select: false
            }
        };
    },
    methods: {
        selectPrice(p) {
            if (p.id === this.p1.id) {
                this.p1.select = true;
                this.p2.select = false;
            } else if (p.id === this.p2.id) {
                this.p2.select = true;
                this.p1.select = false;
            }
        }
    }
};
</script>
