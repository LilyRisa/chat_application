@extends('layout.layout')
    @section('body')
<div class="container">
<h1 class="form-heading">Chat application</h1>
<div class="login-form">
<div class="main-div">
    <div class="panel">
   <h2 id="title">User Login</h2>
   <p id="meta">Please enter your email and password</p>
   Login
   <label class="switch">
  <input type="checkbox" id="switch">
  <span class="slider round"></span>
</label>
Register
   </div>
    <form id="Login">

        <div class="form-group">


            <input type="email" class="form-control" id="inputEmail" placeholder="Email Address" required>

        </div>

        <div class="form-group">

            <input type="password" class="form-control" id="inputPassword" placeholder="Password">

        </div>

        <button type="submit" class="btn btn-primary">Login</button>

    </form>

    <form id="register">
        <div class="form-group">


            <input type="text" class="form-control" id="regname" placeholder="User name" required>

        </div>
        <div class="form-group">


            <input type="email" class="form-control" id="regEmail" placeholder="Email Address"  required>

        </div>

        <div class="form-group">

            <input type="password" class="form-control" id="regPassword" placeholder="Password" required>

        </div>
        <div class="form-group">

            <input type="text" class="form-control" id="regPassword" placeholder="description" required>

        </div>

        <button type="submit" class="btn btn-primary" id="reg">Register</button>
    </form>
    </div>

</div></div></div>

<script>


$(document).ready(function(){
    $('#register').hide();
    $('body').attr('id','LoginForm');

});
$('#switch').on('click',function(){
    var isCheck = $('#switch').is(":checked");
    if(isCheck){
        $("#Login").hide().attr("formnovalidate");
        $("#register").toggle();
        $('#title').text('Sign up');
        $('#meta').text('fields are required');
    }else{
        $("#register").hide().attr("formnovalidate");
        $("#Login").toggle();
        $('#title').text('User login');
        $('#meta').text('Please enter your email and password');
    }
});

var form_value = [];
 $("#register").submit(function(e) {
    e.preventDefault();
}).validate({
  submitHandler: function(form) {
    //form.submit();
    $("#register").each(function(){
        var cons = $(this).find(':input');
        $.each(cons, (i,value)=>{
            form_value[i] = cons[i].value;
            console.log(form_value);
        });
        $.ajax({
            url: '/reg',
            type: 'post',
            data : {
                "_token": "{{ csrf_token() }}",
                'name' : form_value[0],
                'email' : form_value[1],
                'password' : form_value[2],
                'des' : form_value[3],
            }
        }).done(function(result){
            console.log(result);
            if(result.status == 200){
                $.notify({
                  icon: 'pe-7s-gift',
                  message: "Đăng kí thành công"

                  },{
                type: 'success',
                timer: 3000
            });
            location.reload();
            }else{
                $.notify({
                  icon: 'pe-7s-gift',
                  message: "Người dùng đã tồn tại hoặc lỗi hệ thống"

                  },{
                type: 'danger',
                timer: 3000
            });
            }
        }).fail(function() {
            $.notify({
                  icon: 'pe-7s-gift',
                  message: "Lỗi không xác định"

                  },{
                type: 'danger',
                timer: 3000
            });
          });
    });

  }
 });

$("#Login").submit(function(e) {
    e.preventDefault();
}).validate({
  submitHandler: function(form) {
    //form.submit();
    $("#Login").each(function(){
        var cons = $(this).find(':input');
        $.each(cons, (i,v)=>{
            form_value[i] = cons[i].value;
            console.log(form_value);
        });
        $.ajax({
            url: '/login',
            type: 'post',
            data : {
                "_token": "{{ csrf_token() }}",
                'email' : form_value[0],
                'password' : form_value[1],
            }
        }).done(function(result){
            console.log(result);
            if(result.status == 200){
                $.notify({
                  icon: 'pe-7s-gift',
                  message: "Đăng nhập thành công"

                  },{
                type: 'success',
                timer: 3000
            });
            location.reload();
            }else{
                $.notify({
                  icon: 'pe-7s-gift',
                  message: "Đăng nhập lỗi"

                  },{
                type: 'danger',
                timer: 3000
            });
            }
        }).fail(function() {
            $.notify({
                  icon: 'pe-7s-gift',
                  message: "Lỗi không xác định"

                  },{
                type: 'danger',
                timer: 3000
            });
          });
    });

  }
 });


</script>

@endsection