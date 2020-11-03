<template>
	<div v-if="usr.id != mess.user.id">
		<div class="d-flex justify-content-start mb-4"> 
			<div class="img_cont_msg">
				<img :src="mess.user.avatar" :title="mess.user.name" class="rounded-circle user_img_msg">
				
			</div>
			<div class="msg_cotainer">
				<div v-html="mess.message"></div>
				<span class="msg_time">{{ mess.created_at }}</span>
			</div>
		</div>
	</div>
	<div v-else>
		<div class="d-flex justify-content-end mb-4"> 
			<div class="msg_cotainer_send">
				<div v-html="mess.message"></div>
				<span class="msg_time">{{ mess.created_at }}</span>
			</div>
			<div class="img_cont_msg">
				<img :src="mess.user.avatar" :title="mess.user.name" class="rounded-circle user_img_msg">
			</div>
			
		</div>
	</div>
	
</template>
<script>
  export default {
    props: ['mess','usr'],
    
  };
</script>