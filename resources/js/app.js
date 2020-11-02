require('./bootstrap');
window.Vue = require('vue');
Vue.component('chat-messages', require('./components/ChatMesseges.vue').default);
Vue.component('chat-form', require('./components/ChatForm.vue').default);
Vue.component('get-mess', require('./components/getmess.vue').default);

const app = new Vue({
    el: '#app',

    data: {
        messages: []
    },

    created() {
        this.fetchMessages();
    },

    methods: {
        fetchMessages() {
            axios.get('/messages').then(response => {
                this.messages = response.data;
            });
        },

        addMessage(message) {
            this.messages.push(message);

            axios.post('/messages', message).then(response => {
              console.log(response.data);
            });
        }
    }
});
Echo.private('chatroom')
  .listen('MyEvent', (e) => {
    this.messages.push({
      message: e.message.message,
      user: e.user
    });
  });