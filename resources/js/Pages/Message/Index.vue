<script>
export default {
    props: [
        "messages"
    ],

    data() {
        return {
            body: ''
        }
    },

    created() {
        Echo.channel('store-message')
            .listen('.store-message', res => {
                this.messages.unshift(res.message);
                this.body = '';
            });
    },

    methods: {
        store() {
            axios.post('/messages', {body: this.body})
                .then(res => {
                    this.messages.unshift(res.data);
                })
        }
    }
}
</script>

<template>
    <div class="w-1/2 mx-auto py-6">
        <div class="mb-4">
            Messages
        </div>

        <div class="mb-4">
            <input type="text" v-model="body" placeholder="Your message" name="body"
                   class="rounded-full border border-gray-400">
        </div>

        <div class="mb-4">
            <a href="#" @click.prevent="store" class="bg-sky-200 block rounded-lg w-48 text-white text-center py-2">Send</a>
        </div>

        <div v-for="message in messages">
            <div class="border-b-2 p-2">
                <span class="flex">
                    <p class="mr-4"> {{ message.id }} </p>
                    <p> {{ message.body }} </p>
                </span>
                <p class="text-right"> {{ message.time }} </p>
            </div>
        </div>

    </div>
</template>

<style scoped>

</style>
