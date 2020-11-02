<template>
	<div >
	<div class="chat" v-for="message in messages">
		<get-mess :mess="message" :usr="user"></get-mess>
	</div>
	</div>
</template>
<script>
  export default {
    props: ['messages','user'],
  };
</script>