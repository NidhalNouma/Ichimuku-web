<template>
    <div class="w-3/4 sm:w-1/2 mx-auto relative mt-5">
        <div v-if="edit" class="flex">
            <input
                type="text"
                v-model="value"
                placeholder="TradingView User Name"
                class="px-3 py-3 placeholder-gray-400 text-gray-700 relative bg-white bg-white rounded text-sm border border-gray-400 outline-none focus:outline-none focus:shadow-outline w-full pr-10"
            />
            <button @click="editUN" class="py-3 px-4 bg-sec text-prim rounded">
                Save
            </button>
            <button
                @click="editClick"
                class="py-3 px-4 bg-red-300 text-prim rounded"
            >
                Cancel
            </button>
        </div>
        <div v-else class="flex justify-center items-center">
            <label class="font-bold text-gray-400"
                >TradingView Username:
            </label>
            <label
                @click="editClick"
                class="font-bold text-green-600 ml-2 px-4 py-2 bg-green-100 rounded cursor-pointer"
                >{{ tvUser }}</label
            >
            <!-- <button class="bg-sec text-prim rounded h-full">
                <svg
                    class="w-10 h-8"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="gray"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                    />
                </svg>
            </button> -->
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    props: ["usr", "csrf"],
    data() {
        return {
            tvUser: this.usr.name,
            value: this.usr.name,
            edit: false
        };
    },
    methods: {
        editClick() {
            // console.log(this.name);
            this.edit = !this.edit;
        },
        editUN() {
            const vue = this;
            axios
                .post("/user/edit", {
                    _token: this.csrf,
                    TVuserName: this.value
                })
                .then(res => {
                    console.log("updating TV userName ...");
                    // console.log(res);
                    if (res.data.user) {
                        vue.tvUser = vue.value;
                    }
                })
                .catch(err =>
                    console.error("error with edit TVuserName => ", err)
                )
                .finally(r => (vue.edit = !vue.edit));
        }
    }
};
</script>
