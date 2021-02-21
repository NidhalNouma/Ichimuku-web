<template>
    <div>
        <Subscription :sub="sub" v-if="sub.length > 0" />
        <div
            class="flex flex-col sm:flex-row justify-center pt-12 my-12 sm:my-4"
        >
            <Price v-bind:value="p1" @click="selectPrice" />
            <Price v-bind:value="p2" @click="selectPrice" />
        </div>
        <Checkout
            v-if="p1.select === true"
            v-bind:pr="p1"
            :ptotal="{ p1, p2 }"
            :usr="usr"
            :csrf="csrf"
            :cust="sub"
            :card="payment"
            :subs="sub"
            @setCust="setCustomer"
            @setPayment="setPayment"
        />
        <Checkout
            v-else-if="p2.select === true"
            v-bind:pr="p2"
            :ptotal="{ p1, p2 }"
            :usr="usr"
            :csrf="csrf"
            :cust="sub"
            :card="payment"
            :subs="sub"
            @setCust="setCustomer"
            @setPayment="setPayment"
        />
    </div>
</template>

<script>
import Checkout from "./Checkout.vue";
import Price from "./Price.vue";
import Subscription from "./Subscriptions.vue";

export default {
    props: ["usr", "session", "csrf", "customer", "payment"],
    components: { Price, Checkout, Subscription },
    mounted() {
        console.log(JSON.parse(this.customer));
    },
    data() {
        return {
            p1: {
                id: 1,
                title: "Monthly",
                price: 19.99,
                priceTxt: "/ per mounth",
                select: false,
                pId: process.env.MIX_PRICE_M
            },
            p2: {
                id: 2,
                title: "Annually",
                price: 199.99,
                priceTxt: "/ per year",
                select: false,
                pId: process.env.MIX_PRICE_Y
            },
            sub: this.getSub(this.customer)
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
        },
        getSub(cus) {
            let r = [];
            cus = JSON.parse(this.customer);
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
            // console.log(r);
            return r;
        },
        setCustomer(cust) {
            this.customer = JSON.stringify(cust);
        },
        setPayment(pay) {
            this.payment = JSON.stringify(pay);
        }
    }
};
</script>
