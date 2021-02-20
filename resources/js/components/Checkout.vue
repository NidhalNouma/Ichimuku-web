<template>
    <div class="shadow-lg w-10/12 sm:w-1/2 mx-auto my-14 p-4 bg-white">
        <input type="hidden" name="_token" :value="csrf" />
        <input type="hidden" name="user" :value="usr" />
        <div
            v-if="!card"
            ref="card"
            class="div border-2 border-sec bg-white py-5 px-3"
        ></div>
        <ChangeCard v-else :card="JSON.parse(card)" />
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
import ChangeCard from "./ChangeCard.vue";
let stripe = Stripe(process.env.MIX_STRIPE_PUB_KEY),
    elements = stripe.elements(),
    card = undefined;

export default {
    components: { ChangeCard },
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
        if (!this.card) {
            card = elements.create("card", { hidePostalCode: true });
            card.mount(this.$refs.card);
        }
    },
    props: ["pr", "usr", "csrf", "cust", "card"],
    methods: {
        subscribe() {
            if (this.sub) return;
            this.sub = true;
            this.purchase();
            // this.$refs.form.submit({ user: this.usr });
        },
        purchase() {
            const vue = this;
            stripe
                .createPaymentMethod("card", card)
                .then(function(result) {
                    // Access the token with result.token
                    console.log(result);
                    if (result.error) {
                        vue.sub = false;
                        console.error(result.error);
                        return false;
                    }
                    vue.createSub(result.paymentMethod.id);
                })
                .catch(function(err) {
                    console.log(err);
                    vue.sub = false;
                });
        },
        createSub(paymentId) {
            const vue = this;
            console.log(paymentId);
            axios
                .post("/checkout", {
                    name: vue.pr.title,
                    pr: vue.pr.pId,
                    _token: vue.csrf,
                    user: vue.usr,
                    card: vue.card,
                    paymentMethodId: paymentId
                })
                .then(function(res) {
                    console.log(res);
                    if (res.data.cus) {
                        // vue.cust = vue.getSub(res.data.cus);
                        window.location.reload();
                    }
                    vue.sub = false;
                })
                .catch(function(err) {
                    console.error(err);
                    vue.sub = false;
                });
        },
        getSub(cus) {
            let r = [];
            if (cus.subscriptions) {
                const data = cus.subscriptions.data;
                if (data.length > 0) {
                    data.map(i => {
                        i.plan._id = i.id;
                        i.plan.endat = i.current_period_end;
                        if (i.plan.id === process.env.MIX_PRICE_M)
                            i.plan.price = "p1";
                        else if (i.plan.price === process.env.MIX_PRICE_Y)
                            i.plan.id = "p2";
                        r.push(i.plan);
                    });
                }
            }
            console.log(r);
            return r;
        }
    }
};
</script>

<style scoped>
.div {
    border-radius: 4px;
}
</style>
