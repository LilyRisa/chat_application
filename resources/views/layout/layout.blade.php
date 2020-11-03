<!DOCTYPE html>
<html>
	<head>
		<title>Chat</title>
		<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" >
		<script src="https://kit.fontawesome.com/395a09f10a.js" crossorigin="anonymous"></script>
		<script src="{{asset('js/jquery.min.js')}}"></script>
		<link rel="stylesheet" type="text/css" href="{{asset('css/jquery.mCustomScrollbar.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('css/homechat.css')}}">
		<script type="text/javascript" src="{{asset('js/jquery.mCustomScrollbar.min.js')}}"></script>
		<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" id="bootstrap-css">
		<link href="{{asset('css/login-form.css')}}" rel="stylesheet" id="bootstrap-css">
		<script src="{{asset('js/bootstrap.min.js')}}"></script>
		<script src="{{asset('js/jquery.min.js')}}"></script>
		<script src="{{asset('js/notify.min.js')}}"></script>
		<script src="{{asset('js/bootstrap-notify.min.js')}}"></script>
		<script src="{{asset('js/bootstrap-filestyle.min.js')}}"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
		<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
		@yield('head_style')
	</head>
	<body>
		<script>
			$(":file").filestyle({htmlIcon: '<i class="fa fa-paperclip" aria-hidden="true"></i>'});
		</script>
			@yield('back')
			@yield('body')
		<script src="{{ mix('/js/app.js') }}"></script>
	</body>
</html>