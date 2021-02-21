<template>
    <div>
        <div class="shadow-lg w-10/12 sm:w-1/2 mx-auto my-14 p-4 bg-white">
            <input type="hidden" name="_token" :value="csrf" />
            <input type="hidden" name="user" :value="usr" />
            <div
                v-bind:style="[{ display: display }]"
                ref="card"
                class="div border-2 border-sec bg-white py-5 px-3"
            ></div>
            <ChangeCard
                v-if="card !== 'null' && card !== null && card"
                :pay="JSON.parse(card)"
                :setPay="setPay"
            />
            <button
                v-if="!isSubs"
                @click="subscribe"
                v-bind:class="sub ? selectedClass : unselectClass"
            >
                {{ buttonTxt }}
            </button>
            <p
                v-if="isSubsTxt !== null"
                class="text-green-600 px-2 py-3 mt-8 bg-green-100"
            >
                {{ isSubsTxt }}
            </p>
        </div>
        <Cancel v-if="isSubs" :usr="usr" :csrf="csrf" :pr="pr" />
    </div>
</template>

<script>
import axios from "axios";
import moment from "moment";
import ChangeCard from "./ChangeCard.vue";
import Cancel from "./Cancel.vue";

let stripe = Stripe(process.env.MIX_STRIPE_PUB_KEY),
    elements = stripe.elements(),
    card = undefined;

export default {
    props: ["pr", "usr", "csrf", "cust", "card", "subs", "ptotal"],
    components: { ChangeCard, Cancel },
    data() {
        return {
            sub: false,
            unselectClass:
                "mx-auto lg:mx-0 bg-sec text-white font-bold rounded-full mt-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out",
            selectedClass:
                "mx-auto lg:mx-0 bg-prim text-white font-bold rounded-full mt-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline"
        };
    },
    computed: {
        display() {
            return this.card === "null" || this.card === null || !this.card
                ? "block"
                : "none";
        },
        buttonTxt() {
            const card =
                this.card === "null" || this.card === null || !this.card;
            const sub = this.sub;

            return card && sub
                ? "Checking ..."
                : card && !sub
                ? "Check card"
                : !card && sub
                ? "Subscribing ..."
                : "Subscribe";
        },
        isSubs() {
            let r = false;
            const card =
                this.card === "null" || this.card === null || !this.card;
            if (card) return false;
            const vue = this;
            if (this.subs.length > 0) {
                this.subs.map(i => {
                    if (i.id === vue.pr.pId) {
                        r = true;
                    }
                });
            }
            return r;
        },
        isSubsTxt() {
            let r = null;
            const vue = this;

            if (this.subs.length > 0) {
                this.subs.map(i => {
                    if (i.id === vue.ptotal.p1.pId) {
                        const pt = moment(i.endat * 1000).format(
                            "YYYY-MM-DD [at] hh:mm"
                        );
                        r = `You have ${vue.ptotal.p1.title} subscription. Renew On ${pt}`;
                    } else if (i.id === vue.ptotal.p2.pId) {
                        const pt = moment(i.endat * 1000).format(
                            "YYYY-MM-DD [at] hh:mm"
                        );
                        r = `You have ${vue.ptotal.p2.title} subscription. Renew On ${pt}`;
                    }
                });
            }
            return r;
        }
    },
    mounted: function() {
        card = elements.create("card", { hidePostalCode: true });
        card.mount(this.$refs.card);
    },
    updated: function() {
        // console.log("update price");
        // console.log(this.pr, this.subs, this.issubs);
    },
    methods: {
        subscribe() {
            if (this.sub) return;
            this.sub = true;
            if (this.card !== "null" && this.card !== null && this.card) {
                const c = JSON.parse(this.card);
                this.createSub(c.id);
            } else {
                this.purchase();
            }
        },
        purchase() {
            const vue = this;
            console.log("validate card ...");
            stripe
                .createPaymentMethod("card", card)
                .then(function(result) {
                    // Access the token with result.token
                    if (result.error) {
                        vue.sub = false;
                        console.error(result.error);
                        return false;
                    }
                    const rpay = {
                        card: result.paymentMethod.card,
                        id: result.paymentMethod.id
                    };
                    vue.updatePay(rpay.id);
                    vue.$emit("setPayment", rpay);
                    vue.sub = false;
                    // vue.createSub(result.paymentMethod.id);
                })
                .catch(function(err) {
                    console.log(err);
                    vue.sub = false;
                });
        },
        createSub(paymentId) {
            if (this.isSubsTxt !== null) {
                this.updateSub(paymentId);
                return;
            }
            console.log("create subscription ...");
            const vue = this;
            vue.sub = true;
            if (!paymentId) {
                vue.sub = false;
                return;
            }
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
                        // vue.$emit("setCust", res.data.cus);
                    }
                    vue.sub = false;
                })
                .catch(function(err) {
                    console.error(err);
                    vue.sub = false;
                });
        },
        updateSub(paymentId) {
            console.log("modify subscription ...");
            const vue = this;
            vue.sub = true;
            if (!paymentId) {
                vue.sub = false;
                return;
            }
            axios
                .post("/update", {
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
        },
        setPay(pay) {
            this.$emit("setPayment", pay);
        },
        updatePay(pay) {
            const vue = this;
            console.log("Updating default pay card ...");
            if (!pay) {
                console.error("payId not exist ", pay);
                return;
            }
            axios
                .post("/paymethod", {
                    _token: vue.csrf,
                    user: vue.usr,
                    paymethod: pay
                })
                .then(function(res) {
                    console.log(res);
                })
                .catch(function(err) {
                    console.error(err);
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
