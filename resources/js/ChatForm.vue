<template>
    <div class="input-group">
        <div class="input-group-append">
            <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
        </div>
        <input name="message" class="form-control type_msg" placeholder="Type your message..." v-model="newMessage" @keyup.enter="sendMessage">
        <div class="input-group-append">
            <button class="input-group-text send_btn" @click="sendMessage"><i class="fas fa-location-arrow"></i></button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],

        data() {
            return {
                newMessage: ''
            }
        },

        methods: {
            sendMessage() {
                this.$emit('messagesent', {
                    user: this.user,
                    message: this.newMessage
                });

                this.newMessage = ''
            }
        }    
    }
</script>