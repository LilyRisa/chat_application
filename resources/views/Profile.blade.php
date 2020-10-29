@extends('layout.layout')
@section('head_style')
<link rel="stylesheet" type="text/css" href="{{asset('css/profile.css')}}">
@endsection
@section('back')
	@include('layout.back')
@endsection
	@section('body')
<div class="container">
    <div class="row">

        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border-radius: 16px;">
                    <div class="well profile col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center h-100">

                            <div class="image_outer_container">

								<div class="green_icon"></div>
								<div class="image_inner_container">
									<img src="{{$user->avatar}}">
									<div class="overlay">
										<p>Change avatar</p>
										<input type="file" id="avatar" >
									</div>
								</div>
								
							</div>
							<div class="iconup">
								<button id="up-avatar" class="btn btn-success" style="display: none; position: absolute; top:0px"><i class="fa fa-upload" aria-hidden="true"></i></button></div>
                            <h5 style="text-align: center;"><strong id="user-name">{{$user->name}}</strong></h5>

                            <a href="mailto:{{$user->email}}" style="text-decoration: none; display: block;"><i class="fa fa-envelope" aria-hidden="true"></i><p style="text-align: center; font-size: smaller; overflow-wrap: break-word;" id="user-email">{{$user->email}}</p></a>
                            <p style="text-align: center; font-size: smaller;"><strong>Gender: </strong>
                            	
                            	<select id="gender">
                            		@if($user->gender == 0)
                            			<option value="0" selected>female</option>
	                            		<option value="1">male</option>
	                            		<option value="3">unknown</option>
                            		@elseif($user->gender == 1)
                            			<option value="0" >female</option>
	                            		<option value="1" selected>male</option>
	                            		<option value="3">unknown</option>
	                            	@else
	                            		<option value="0" >female</option>
	                            		<option value="1" >male</option>
	                            		<option value="3" selected>unknown</option>
	                            	@endif
                            	</select>

                            </p>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 divider text-center"></div>
                            <p style="text-align: center; font-size: smaller;"><strong>Décription: </strong></p>
                            <div class="row">
                            	<div class="col-md-8">
                            		<p style="text-align: center; font-size: smaller;" id="user-role">{{$user->description }}</p>
                            		<textarea id="destext" class="form-control" style="display: none"></textarea>
                            	</div>
                            	<div class="col-md-4" >
                            		<button id="editdes" class="btn btn-info"><i class="fa fa-align-left" aria-hidden="true"></i></button>
                            		<button id="cancel" class="btn btn-danger" style="display:none"><i class="fa fa-times" aria-hidden="true"></i></button>
                            		<button id="success" class="btn btn-success" style="display:none"><i class="fa fa-check" aria-hidden="true"></i></button>
                            	</div>
                            </div>
                            
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 divider text-center"></div>
                           
                            <div class="col-lg-6 left" style="text-align: center; overflow-wrap: break-word;">
                                <h4>
                                    <p style="text-align: center;"><strong id="user-college-rank">Account </strong></p>
                                </h4>
                                <div class="account">
                                	<a href="#" id="deleteaccount">
    									<p>
    										<span class="bg"></span><span class="base"></span>
    										<span class="text">Xóa tài khoản</span>
    									</p>
    								</a>
    							</div>
                                <!-- <button class="btn btn-info btn-block"><span class="fa fa-user"></span> View Profile </button>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
	$(document).ready(function(){
		$('#user-role').on('click',function(){
			var text = $('#user-role').text()
			$('#user-role').hide();
			$('#destext').attr('style','');
			$('#cancel').attr('style','');
			$('#destext').text(text);
			$('#success').attr('style','');
			$('#editdes').hide();
		});
		$('#editdes').on('click',function(){
			var text = $('#user-role').text()
			$('#user-role').hide();
			$('#destext').attr('style','');
			$('#cancel').attr('style','');
			$('#destext').val(text);
			$('#success').attr('style','');
			$('#editdes').hide();

		});
		$('#cancel').on('click',function(){
			var text = $('#user-role').text()
			$('#destext').attr('style','display:none');
			$('#user-role').show();
			$('#cancel').hide();
			$('#success').hide();
			$('#editdes').show();
			$('#destext').val(text);
		});
		$('#success').on('click',function(){
			$.ajax({
				url: '{{ route('des_profile')}}',
				type: 'post',
				data : {
					"_token": "{{ csrf_token() }}",
					des : $('#destext').val()
				}
			}).done(function(result){
				console.log(result);
				if(result.status == 200){
					$('#destext').attr('style','display:none');
					$('#user-role').show();
					$('#user-role').text(result.value);
					$('#cancel').hide();
					$('#success').hide();
					$('#editdes').show();
					$.notify({
	                  icon: 'pe-7s-gift',
	                  message: "Cập nhật thành công"

	                  },{
	                type: 'success',
	                timer: 3000
	            });
				}else{
					$.notify({
	                  icon: 'pe-7s-gift',
	                  message: "Lỗi không xác định"

	                  },{
	                type: 'danger',
	                timer: 3000
	            });
				}
				
			});
		});
		$('#gender').on('change', function(){
			var value = $('#gender option:selected').val();
			console.log(value);
			$.ajax({
				url: '{{ route('gender_profile')}}',
				type: 'post',
				data : {
					"_token": "{{ csrf_token() }}",
					gender : value,
				}
			}).done(function(result){
				console.log(result);
				if(result.status == 200){
					$.notify({
	                  icon: 'pe-7s-gift',
	                  message: "update thành công"

	                  },{
	                type: 'success',
	                timer: 3000
	            });
				}else{
					$.notify({
	                  icon: 'pe-7s-gift',
	                  message: "Lỗi không xác định"

	                  },{
	                type: 'danger',
	                timer: 3000
	            });
				}
			});
		});

		//upload avatar
		$('#avatar').on('click', function(){
			$(this).on('change',function(){
				$('#up-avatar').show();

				var file = $('#avatar')[0].files[0]
				if (file){
				  
				  	 var avatar = new AvatarImage(file);
				  	 avatar.setSize(2000000);
				  	 if(avatar.checkSize){
				  	 	if(avatar.checktype){
				  	 		avatar.Base64Encoder().then((imgbase64)=>{
				  	 			//console.log(imgbase64);
				  	 			$('.image_inner_container img').attr('src',imgbase64);
				  	 	$('#up-avatar').on('click',function(){
				  	 			$.ajax({
				  	 				url: '{{route('avatar')}}',
				  	 				type: 'post',
				  	 				data:{
				  	 					"_token": "{{ csrf_token() }}",
				  	 					avatar: imgbase64,
				  	 				}
				  	 			}).done((result)=>{
				  	 				if(result.status == 200){
				  	 					$('#up-avatar').hide();
				  	 					$.notify({
							                  icon: 'pe-7s-gift',
							                  message: "Ảnh đại diện đã được thay đổi"

							                  },{
							                type: 'success',
							                timer: 3000
							            });
				  	 				}else{
				  	 					$.notify({
							                  icon: 'pe-7s-gift',
							                  message: result.error

							                  },{
							                type: 'danger',
							                timer: 3000
							            });
				  	 				}
				  	 			});
				  	 	});//sdsd
				  	 		});

				  	 	}else{
				  	 		$.notify({
			                  icon: 'pe-7s-gift',
			                  message: "image type unknown"

			                  },{
			                type: 'danger',
			                timer: 3000
			            });
				  	 	}
				  	 }else{
				  	 	$.notify({
		                  icon: 'pe-7s-gift',
		                  message: "size large"

		                  },{
		                type: 'danger',
		                timer: 3000
		            });
				  	 }
				  
				}
				
			});
			
		});

	function AvatarImage(file){
		this.file = file;
	}
	AvatarImage.prototype.checktype = function(){
		var validImageTypes = ["image/gif", "image/jpeg", "image/png"];
		if ($.inArray(this.file.type, validImageTypes) < 0) {
		     return false;
		}else{
			return true;
		}
	}
	AvatarImage.prototype.setSize = function(size){ //byte
		this.validsize = size;
	}
	AvatarImage.prototype.checkSize = function(){
		if(this.file.size > this.validsize){
			return false;
		}else{
			return true;
		}
	}
	AvatarImage.prototype.Base64Encoder = function(){
		return new Promise((resolve, reject) => {
		    const reader = new FileReader();
		    reader.readAsDataURL(this.file);
		    reader.onload = () => resolve(reader.result);
		    reader.onerror = error => reject(error);
  		});
	}

	});
</script>
	@endsection