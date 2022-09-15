<template layout="default">
    <form @submit.prevent="submit" class="max-w-md mx-auto mt-8">
        <div class="flex">
            <div class="mb-6">
                <label
                    class="block mb-2 font-bold text-xs text-gray-700"
                    for="nth"
                    >Nth</label
                >
                <input
                    v-model="form.nth"
                    class="border border-gray-400 p-2 w-full"
                    type="number"
                    name="nth"
                    min="0"
                    max="93"
                    id="name"
                    @change="submit"
                    required
                />
                <div
                    v-if="form.errors.nth"
                    v-text="form.errors.nth"
                    class="text-red-500 text-xs mt-1"
                ></div>
            </div>
            <div class="mb-6">
                <label
                    class="block mb-2 font-bold text-xs text-gray-700"
                    for="isSeq"
                    >Show Sequence</label
                >
                <input
                    v-model="form.isSeq"
                    class="border border-gray-400 p-2 w-full"
                    type="checkbox"
                    name="isSeq"
                    id="isSeq"
                    @change="submit"
                />
            </div>
        </div>
        <div class="mb-6 flex">
            <div class="flex-1">
                <div class="text-lg bold" v-if="props.ans">Answer: {{ props.ans.fn }}</div>
            </div>
            <button
                type="submit"
                class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"
            >
                Submit
            </button>
        </div>
        <div class="flex-1">
            <table
                v-if="form.isSeq"
                class="min-w-full divide-y divide-gray-200"
            >
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div>
                                    <div
                                        class="text-sm font-medium text-gray-900"
                                    >
                                        Fn
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div>
                                    <div
                                        class="text-sm font-medium text-gray-900"
                                    >
                                        Fibonacci Number
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr v-for="row in props.fib" :key="row.id">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div>
                                    <div
                                        class="text-sm font-medium text-gray-900"
                                    >
                                        {{ row.id }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div>
                                    <div
                                        class="text-sm font-medium text-gray-900"
                                    >
                                        {{ row.fn }}
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div v-if="props.ov">
            {{ props.ov }}
        </div>
    </form>
</template>

<script setup lang="ts">
import { useForm } from "@inertiajs/inertia-vue3";

let form = useForm({
    nth: 0,
    isSeq: false,
});
let props = defineProps({
    fib: Object,
    ans: Object,
    ov: String,
});

let submit = () => {
    form.post("/");
};
</script>
