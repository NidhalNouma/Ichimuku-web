<template>
    <div class="flex mx-auto justify-center mt-3">
        <div
            class="bg-green-100 border-t border-b border-green-500 text-green-700 px-4 py-3"
            role="alert"
        >
            <p class="font-bold mb-2">Subscriptions</p>
            <p class="text-sm" v-for="i in sub" :key="i._id">
                You have
                {{ i.price === "p1" ? "Monthly" : "Annually" }} subscription.
                Renew On {{ timestamp(i.endat) }}
            </p>
        </div>
    </div>
</template>

<script>
import moment from "moment";

export default {
    props: ["sub"],
    methods: {
        timestamp: function(t) {
            return moment(t * 1000).format("YYYY-MM-DD [at] hh:mm");
        }
    }
};
</script>
