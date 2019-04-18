<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html dir="ltr" lang="en-US">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Web 2.0 Login Form</title>
	<!--- CSS --->
	<link rel="stylesheet" href="/Public/ajaxLoginStyle/style.css" type="text/css" />
	<!--- Javascript libraries (jQuery and Selectivizr) used for the custom checkbox --->
		<script type="text/javascript" src="/Public/ajaxLoginStyle/jquery-1.7.1.min.js"></script>
		<script>
            //ajax异步登录请求
            $(document).ready(function(){
                $('#form').submit(function(){
                    var username = $("#username").val();
                    var password = $("#password").val();
                    $.ajax({
                        url:"/home.php?c=User&a=ajaxLogin",
                        type:"POST",
                        data:{
                            username:username,
                            password:password,
                        },
                        success:function (result) {
                            if (result.status == 'success'){
                                //登录成功，跳转 alert(result.message)
								if(window.parent){
								    window.parent.location.reload();
								} else {
                                    window.location.href="/home.php/home/index/index";
                                }
                            } else {
                                alert(result.message)
                            }
                        },
                        error:function (result) {
                            alert(result.message)
                        }
                    });
                    return false;
				})
			})
		</script>

	</head>

	<body>
		<div id="container">
			<form id="form">
				<div class="login">LOGIN</div>
				<div class="username-text">Username:</div>
				<div class="password-text">Password:</div>
				<div class="username-field">
					<input type="text" id="username" name="username" value="aaaa" />
				</div>
				<div class="password-field">
					<input type="password" id="password" name="password" value="123456" />
				</div>
				<input type="checkbox" name="remember-me" id="remember-me" /><label for="remember-me">Remember me</label>
				<div class="forgot-usr-pwd">Forgot <a href="#">username</a> or <a href="#">password</a>?</div>
				<input  type="submit"  name="submit" value="GO" />
			</form>
		</div>


</body>
</html>