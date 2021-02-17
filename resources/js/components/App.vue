<template>
    <div>
        <div
            class="flex flex-col sm:flex-row justify-center pt-12 my-12 sm:my-4"
        >
            <Price title="Monthly" price="19.99" priceTxt="/ per mounth" />
            <Price title="Annully" price="199.99" priceTxt="/ per year" />
        </div>
        <Checkout />
    </div>
</template>

<script>
import Checkout from "./Checkout.vue";
import Price from "./Price.vue";
export default {
    components: { Price, Checkout }
};
</script>
