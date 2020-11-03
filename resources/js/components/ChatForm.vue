<template>
    <div class="input-group">
        <div class="input-group-append">
            <span class="input-group-text attach_btn"><input type="file" class="filestyle" name="image_src" id="image_src" data-input="false" data-iconName="fas fa-paperclip" data-buttonText="" @change="sendFile($event.target.files,$event.target.files.length)"></span>
        </div>
        <input name="message" class="form-control type_msg" placeholder="Type your message..." v-model="newMessage" @keyup.enter="sendMessage">
        <div class="input-group-append">
            <button class="input-group-text send_btn" @click="sendMessage"><i class="fas fa-location-arrow"></i></button>
        </div>
    </div>
</template>

<script>
    import base64encoder from '../service/base64encoder.js';
    export default {
        props: ['user'],

        data() {
            return {
                newMessage: ''
            }
        },

        methods: {
            sendMessage() {
                this.$emit('sendmess', {
                    user: this.user,
                    message: this.newMessage
                });

                this.newMessage = ''
            },
            sendFile(fileList, fileSize){
                fileList = fileList[0];
                var bs64 = function(file){
                    return new Promise((resolve, reject) => {
                        const reader = new FileReader();
                        reader.readAsDataURL(file);
                        reader.onload = () => resolve(reader.result);
                        reader.onerror = error => reject(error);
                    });
                }
                var image;
                // let base = new base64encoder();
                bs64(fileList).then(data => {
                    if(fileList.type == 'image/gif' || fileList.type == 'image/jpeg' || fileList.type == 'image/png'){
                        image = {
                            data : data,
                            type: 'image'
                        }
                    }else{
                        image = {
                            data : data,
                            type: 'file'
                        }
                    }
                    this.$emit('filesend',image);
                    image = null;
                });
                
            }
        }    
    }
</script>