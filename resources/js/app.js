require('./bootstrap');
window.Vue = require('vue');
import base64encoder from './service/base64encoder.js';
Vue.component('chat-messages', require('./components/ChatMesseges.vue').default);
Vue.component('chat-form', require('./components/ChatForm.vue').default);
Vue.component('get-mess', require('./components/getmess.vue').default);

const app = new Vue({
    el: '#app',

    data: {
        messages: [],
        file:[]
    },

    created() {
        this.fetchMessages();
        Echo.private('chatroom')
          .listen('MyEvent', (e) => {
            console.log(e);
            if(e.message == null){
                axios.get('/mess/'+e.file).then(response => {
                    console.log(response.data);
                    this.messages.push({
                      message: response.data.message.message,
                      created_at: response.data.message.created_at,
                      updated_at: response.data.message.updated_at,
                      user_id: response.data.message.user_id,
                      user: response.data.user
                    });
                    
                });
            }else{
                this.messages.push({
                  message: e.message.message,
                  created_at: e.message.created_at,
                  updated_at: e.message.updated_at,
                  user_id: e.message.user_id,
                  user: e.user
                });
            }
            
          });
    },

    methods: {
        fetchMessages() {
            axios.get('/messages').then(response => {
                console.log(response.data);
                this.messages = response.data;
            });
        },

        addMessage(message) {
            this.messages.push(message);
            console.log(this.messages);

            axios.post('/messages', message).then(response => {
              console.log(response.data);
            });
        },
        FileUp(data){
            axios.post('/messages', data).then(response => {
              console.log(response.data);
            });
        }
    }
});
