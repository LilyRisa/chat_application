@extends('layout.layout')
@section('back')
	@include('layout.back')
@endsection
	@section('body')
		<div class="container-fluid" id="app">
			<div class="row justify-content-center h-100">
				
				<div class="col-md-10 col-xl-10 chat">
					<div class="card">
						<div class="card-header msg_head">
							<div class="d-flex bd-highlight">
					
								<div class="user_info">
									<span>Chat with comunity</span>
									<p>{{$count_mess}} Messages</p>
								</div>
								{{-- <div class="video_cam">
									<span><i class="fas fa-video"></i></span>
									<span><i class="fas fa-phone"></i></span>
								</div> --}}
							</div>
							<span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
							<div class="action_menu">
								<ul>
									<li><i class="fas fa-user-circle"></i> View profile</li>
									<li><i class="fas fa-users"></i> Add to close friends</li>
									<li><i class="fas fa-plus"></i> Add to group</li>
									<li><i class="fas fa-ban"></i> Block</li>
								</ul>
							</div>
						</div>
					
						<div class="card-body msg_card_body" style="scroll-behavior: smooth;">
							<chat-messages :messages="messages" :user="{{ Auth::user() }}"></chat-messages>
							
						</div>
						<div class="card-footer">
							{{-- <div class="input-group">
						        <div class="input-group-append">
						            <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
						        </div>
						        <input name="message" class="form-control type_msg" placeholder="Type your message..." >
						        <div class="input-group-append">
						            <button class="input-group-text send_btn" onclick="sendMessage()"><i class="fas fa-location-arrow"></i></button>
						        </div>
						    </div> --}}
						    <chat-form
                        v-on:sendmess="addMessage" v-on:filesend="FileUp"
                        :user="{{ Auth::user() }}"
                    ></chat-form>
						</div>
						
					</div>
				</div>
				
				</div>
				
		</div>

		<script>
	//$(document).ready(function(){
	// 	loadmess({{ $user->id }});
		
	// 	$('#action_menu_btn').click(function(){
	// 		$('.action_menu').toggle();
	// 	});
		
	// 	function loadmess(user_id){
			
	// 		$.ajax({
	// 			url : '{{route('fetchMessages')}}',
	// 			type : 'get',
	// 		}).done(result => {
	// 			//console.log(result);
	// 			$.each(result, (i,v)=>{
	// 				if(v.user.id != user_id){
	// 					var temp = `<div class="d-flex justify-content-start mb-4">
	// 									<div class="img_cont_msg" title="${v.user.name}">
	// 										<img src="${v.user.avatar}" class="rounded-circle user_img_msg" alt="${v.user.name}">
											
	// 									</div>
	// 									<div class="msg_cotainer">
	// 										${v.message}
	// 										<span class="msg_time">${v.created_at}</span>
	// 									</div>
	// 								</div>`;
	// 					$('#mess').append(temp);
	// 				}else{
	// 					var temp = `
	// 					<div class="d-flex justify-content-end mb-4">
	// 							<div class="msg_cotainer_send" title="${v.user.name}">
	// 								${v.message}
	// 								<span class="msg_time_send">${v.created_at}</span>
	// 							</div>
	// 							<div class="img_cont_msg">
	// 						<img src="${v.user.avatar}" class="rounded-circle user_img_msg">
	// 							</div>
	// 						</div>`;
	// 					$('#mess').append(temp);
	// 				}
	// 			})
	// 		});
	// 	}
	// });
	// $("input[name*='message']").keyup(function(e){
	// 	if(e.key==="Enter"){
	// 		e.preventDefault();
	// 		sendMessage();
	// 	}
	// });
	// function sendMessage(){
	// 	$.ajax({
	// 		url:'{{route('sendMessage')}}',
	// 		type: 'post',
	// 		data:{
	// 			"_token": "{{ csrf_token() }}",
	// 			"message" : $("input[name*='message']").val(),
	// 		}
	// 	}).done(result => {
	// 		//console.log(result);
	// 		$("input[name*='message']").val('');
	// 		var temp = `
	// 					<div class="d-flex justify-content-end mb-4">
	// 							<div class="msg_cotainer_send" title="{{$user->name}}">
	// 								${result.data.message}
	// 								<span class="msg_time_send">${result.data.created_at}</span>
	// 							</div>
	// 							<div class="img_cont_msg">
	// 						<img src="{{$user->avatar}}" class="rounded-circle user_img_msg">
	// 							</div>
	// 						</div>`;
	// 		$('#mess').append(temp);
	// 	});
	// }
	// var pusher = new Pusher("{{env('PUSHER_APP_KEY')}}", {
	// 	  auth: {
	// 	    params: {
	// 	      'X-CSRF-Token': '{{csrf_token()}}'
	// 	    }
	// 	  },
	// 	  cluster: '{{env('PUSHER_APP_CLUSTER')}}',
	// 		encrypted: true
	// 	  // authEndpoint: 'broadcasting/auth',
	// 	});
		// Pusher.logToConsole = true;
		// var channel = pusher.subscribe('publicmess');
		// console.log(channel);
		// channel.bind('App\\Events\\Demo', function(data) {
  //       	var temp = `
		// 				<div class="d-flex justify-content-start mb-4">
		// 						<div class="msg_cotainer_send" title="{{$user->name}}">
		// 							${datamessage}
		// 							<span class="msg_time_send"></span>
		// 						</div>
		// 						<div class="img_cont_msg">
		// 					<img src="{{$user->avatar}}" class="rounded-circle user_img_msg">
		// 						</div>
		// 					</div>`;
		// 	$('#mess').append(temp);
  //   });
		
		</script> 
@endsection
