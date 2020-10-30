<template>
	<div class="d-flex justify-content-start mb-4">
		<div class="img_cont_msg">
			<img src="{{ message.user.avatar }}" class="rounded-circle user_img_msg">
			{{ message.user.name }}
		</div>
		<div class="msg_cotainer">
			{{ message.message }}
			<span class="msg_time">{{ message.created_at }}</span>
		</div>
	</div>
</template>
<script>
  export default {
    props: ['messages']
  };
</script>