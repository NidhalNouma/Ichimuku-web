<template>
    <div>
        <button
            v-if="!ready"
            @click="cancel"
            class="mx-auto lg:mx-0 text-sec font-bold rounded-full my-6 py-4 px-8 focus:outline-none"
        >
            Cancel subscription
        </button>
        <div v-else class="w-10/12 sm:w-1/2 mx-auto mb-8">
            <div role="alert">
                <div
                    class="bg-red-500 text-white font-bold rounded-t px-4 py-2"
                >
                    Cancel Subscription
                </div>
                <div
                    class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700"
                >
                    <p>
                        If you Accept to cancel the subscription you will no
                        longer have access to our product.
                    </p>
                    <div class="flex justify-between mt-3">
                        <button
                            @click="accept"
                            class="mx-auto lg:mx-0 text-red-500 font-bold rounded-full my-0 py-2 px-8 focus:outline-none"
                        >
                            {{ acceptBtn }}
                        </button>
                        <button
                            @click="cancel"
                            class="mx-auto lg:mx-0 text-sec font-bold rounded-full my-0 py-2 px-8 focus:outline-none"
                        >
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: ["name", "pr", "csrf", "usr"],
    data() {
        return {
            ready: false,
            accepttxt: false
        };
    },
    computed: {
        acceptBtn() {
            return this.accepttxt ? "Accepting ..." : "Accept";
        }
    },
    methods: {
        cancel() {
            this.ready = !this.ready;
        },
        accept() {
            console.log("accept");
            const vue = this;
            vue.accepttxt = true;
            axios
                .post("/delete", {
                    name: vue.pr.title,
                    pr: vue.pr.pId,
                    _token: vue.csrf,
                    user: vue.usr
                })
                .then(function(response) {
                    console.log(response);
                    vue.accepttxt = false;
                    if (response.data.can) {
                        window.location.reload();
                    }
                })
                .catch(function(err) {
                    console.error("cancel subscription => ", err);
                    vue.accepttxt = false;
                });
        }
    }
};
</script>
