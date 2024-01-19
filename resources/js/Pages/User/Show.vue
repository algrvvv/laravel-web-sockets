<script>
export default {
    props: [
        "user"
    ],

    methods: {
        sendLike() {
            axios.post(`/user/${this.user.id}`, {
                from_id: this.$page.props.auth.user.id
            })
                .then(res => {
                    this.message = res.data.message
                })
        }
    },


    created() {
        Echo.private(`send-like-${this.$page.props.auth.user.id}`)
            .listen('.send-like', res => {
                this.message = res.message;
            })
    },

    data() {
        return {
            message: ''
        }
    }
}
</script>

<template>
    <div class="w-1/2 mx-auto py-6">
        <div>
            Username - {{ user.name }}
        </div>
        <div>
            <a href="#" @click.prevent="sendLike" class="bg-sky-200 block rounded-lg w-48 text-white text-center py-2">Send
                like</a>
        </div>
        <div v-if="message">
            {{ message }}
        </div>
    </div>
</template>

<style scoped>

</style>
