@extends('layout.layout')
@section('head_style')
<link rel="stylesheet" type="text/css" href="{{asset('css/search.css')}}">
@endsection
@section('back')
	@include('layout.back')
@endsection
	@section('body')
		<div class="container">
	<div class="row">
        <div class="col-md-12">
            <input id='search-btn' type='checkbox'/>
			<label for='search-btn'></label>
			<input id='search-bar' type='text' placeholder='search for and retrieve user profiles ...'/>
			
        </div>
        <div class="col-md-12">
        	<main>
        		<ol class="gradient-list">

        		</ol>
        	</main>
        	
        </div>
	</div>
</div>
<script>
	$('#search-bar').on('keyup',function(){
		$('.gradient-list').html('');
		var keywords = $(this).val();
		$.ajax({
			url: '{{route('postsearch')}}',
			type: 'post',
			data:{
				"_token": "{{ csrf_token() }}",
				keywords: keywords
			}
		}).done((result)=>{
			console.log(result);
			$.each(result, (i,v)=>{
				$('.gradient-list').append(`<li>name: ${v.name} | email: ${v.email} | description: ${v.description}</li>`);
			});
		});
	});
</script>
	@endsection