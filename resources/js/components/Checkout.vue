<template>
    <div class="shadow-lg w-10/12 sm:w-1/2 mx-auto my-14 p-4 bg-white">
        <input type="hidden" name="_token" :value="csrf" />
        <input type="hidden" name="user" :value="usr" />
        <div
            ref="card"
            class="div border-2 border-sec bg-white py-5 px-3"
        ></div>
        <button
            @click="subscribe"
            v-bind:class="sub ? selectedClass : unselectClass"
        >
            {{ sub ? "Subscribing ..." : "Subscribe" }}
        </button>
    </div>
</template>

<script>
import axios from "axios";
let stripe = Stripe(process.env.MIX_STRIPE_PUB_KEY),
    elements = stripe.elements(),
    card = undefined;

export default {
    data() {
        return {
            sub: false,
            unselectClass:
                "mx-auto lg:mx-0 bg-sec text-white font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out",
            selectedClass:
                "mx-auto lg:mx-0 bg-prim text-white font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline"
        };
    },
    mounted: function() {
        card = elements.create("card", { hidePostalCode: true });
        card.mount(this.$refs.card);
    },
    props: ["pr", "usr", "csrf"],
    methods: {
        subscribe() {
            if (this.sub) return;
            this.sub = true;
            this.purchase();
            // this.$refs.form.submit({ user: this.usr });
        },
        purchase() {
            const vue = this;
            // .createToken(card)
            stripe
                .createPaymentMethod("card", card)
                .then(function(result) {
                    // Access the token with result.token
                    console.log(result, vue.csrf);
                    if (result.error) {
                        vue.sub = false;
                        console.error(result.error);
                        return false;
                    }
                    axios
                        .post("/checkout", {
                            pr: vue.pr,
                            _token: vue.csrf,
                            user: vue.usr,
                            card: result,
                            paymentMethodId: result.paymentMethod.id
                        })
                        .then(function(res) {
                            console.log(res);
                            vue.sub = false;
                        })
                        .catch(function(err) {
                            console.error(err);
                            vue.sub = false;
                        });
                })
                .catch(function(err) {
                    console.log(err);
                    vue.sub = false;
                });
        }
    }
};
</script>

<style scoped>
.div {
    border-radius: 4px;
}
</style>
