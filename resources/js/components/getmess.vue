<template>
	<div v-if="usr.id != mess.user.id">
		<div class="d-flex justify-content-start mb-4"> 
			<div class="img_cont_msg">
				<h6 class="usrname">{{ mess.user.name }}</h6>
				<img :src="mess.user.avatar" class="rounded-circle user_img_msg">
				
			</div>
			<div class="msg_cotainer">
				{{ mess.message }}
				<span class="msg_time">{{ mess.created_at }}</span>
			</div>
		</div>
	</div>
	<div v-else>
		<div class="d-flex justify-content-end mb-4"> 
			<div class="msg_cotainer_send">
				{{ mess.message }}
				<span class="msg_time">{{ mess.created_at }}</span>
			</div>
			<div class="img_cont_msg">
				<h6 class="usrname">{{ mess.user.name }}</h6>
				<img :src="mess.user.avatar" class="rounded-circle user_img_msg">
			</div>
			
		</div>
	</div>
	
</template>
<script>
  export default {
    props: ['mess','usr'],
    
  };
</script>