<template>
    <div class="shadow-lg w-10/12 sm:w-1/2 mx-auto my-14 p-4 bg-white">
        <div
            ref="card"
            class="div border-2 border-sec bg-white py-5 px-3"
        ></div>
        <button
            @click="subscribe"
            class="mx-auto lg:mx-0 hover:underline bg-sec text-white font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out"
        >
            Subscribe
        </button>
    </div>
</template>

<script>
let stripe = Stripe(process.env.MIX_STRIPE_PUB_KEY),
    elements = stripe.elements(),
    card = undefined;

export default {
    mounted: function() {
        card = elements.create("card");
        card.mount(this.$refs.card);
    },
    purchase: function() {
        stripe.createToken(card).then(function(result) {
            // Access the token with result.token
        });
    },
    props: ["pr", "usr"],
    methods: {
        subscribe() {
            console.log("price", this.pr);
            console.log("user", this.usr);
        }
    }
};
</script>

<style scoped>
.div {
    border-radius: 4px;
}
</style>
