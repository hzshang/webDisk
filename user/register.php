<?php
require_once '../lib/config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $site_name;  ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="https://cdn.bootcss.com/admin-lte/2.3.11/css/AdminLTE.min.css" rel="stylesheet">

    <link href="https://cdn.bootcss.com/iCheck/1.0.1/skins/square/blue.css" rel="stylesheet">

</head>
<body class="register-page">
<div class="register-box">
    <div class="register-logo">
        <a href="../"><b><?php echo $site_name;  ?></b></a>
    </div>

    <div class="register-box-body">
        <p class="login-box-msg">注册，然后变成一只猫。</p>

            <div class="form-group has-feedback">
                <input type="text" id="name" class="form-control" placeholder="昵称"/>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" id="email" class="form-control" placeholder="邮箱"/>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" id="passwd" class="form-control" placeholder="密码"/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" id="repasswd" class="form-control" placeholder="重复密码"/>
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" id="verCode" class="form-control" placeholder="验证码"/>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <button type="submit" id="checkMail" class="btn btn-primary btn-block btn-flat">获取验证码</button>
            </div>
            <div class="form-group has-feedback">
                <button type="submit" id="reg" class="btn btn-primary btn-block btn-flat">提交注册</button>
            </div>

            <div class="form-group has-feedback">
               <p>注册即代表同意<a href="tos.php">服务条款</a></p>
            </div>
            <div id="msg-success" class="alert alert-info alert-dismissable" style="display: none;">
                <button type="button" class="close" id="ok-close" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-info"></i> 成功!</h4>
                <p id="msg-success-p"></p>
            </div>
            <div id="msg-vcode" class="alert alert-info alert-dismissable" style="display: none;">
                <button type="button" class="close" id="vcode-close" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-info"></i>验证码发送成功!</h4>
                <p id="msg-vCode-p"></p>
            </div>
    
            <div id="msg-error" class="alert alert-warning alert-dismissable" style="display: none;">
                <button type="button" class="close" id="error-close" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> 出错了!</h4>
                <p id="msg-error-p"></p>
            </div>
            <div class="form-group has-feedback">
               <p>使用qq邮箱有可能收不到邮件;如未收到,请查看垃圾箱</p>
            </div>
        <a href="login.php" class="text-center">已经注册？请登录</a>
    </div><!-- /.form-box -->
</div><!-- /.register-box -->
<!-- jQuery 2.1.3 -->
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>

<!-- Bootstrap 3.3.2 JS -->
    <script src="https://cdn.bootcss.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

<!-- iCheck -->
    <script src="https://cdn.bootcss.com/iCheck/1.0.2/icheck.min.js"></script>

<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
<script>
    $(document).ready(function(){
         function register(){
            $.ajax({
                type:"POST",
                url:"_reg.php",
                dataType:"json",
                data:{
                    email: $("#email").val(),
                    name: $("#name").val(),
                    passwd: $("#passwd").val(),
                    repasswd: $("#repasswd").val(),
                    verCode: $("#verCode").val()
                },
                success:function(data){
                    if(data.ok){
                        $("#msg-error").hide(10);
                        $("#msg-vcode").hide(10);
                        $("#msg-success").show(100);
                        $("#msg-success-p").html(data.msg);
                        window.setTimeout("location.href='login.php'", 2000);
                    }else{
                        $("#msg-error").hide(10);
                        $("#msg-vcode").hide(10);
                        $("#msg-error").show(100);
                        $("#msg-error-p").html(data.msg);
                    }
                },
                error:function(jqXHR){
                    $("#msg-error").hide(10);
                    $("#msg-error").show(100);
                    $("#msg-error-p").html("发生错误："+jqXHR.status);
                    // 在控制台输出错误信息
                    console.log(removeHTMLTag(jqXHR.responseText));
                }
            });
        };
        function sendVerCode(){
            $.ajax({
                type:"POST",
                url:"_sendVcode.php",
                dataType:"json",
                data:{
                    email: $("#email").val()
                },
                success:function(data){
                	$("#checkMail").html("发送验证码");
                    if(data.ok){
                        $("#msg-error").hide(10);
                        $("#msg-success").hide(10);
                        $("#msg-vcode").show(100);
                        $("#msg-vCode-p-p").html(data.msg);
                    }else{
                        $("#msg-error").hide(10);
                        $("#msg-error").show(100);
                        $("#msg-error-p").html(data.msg);
                    }
                },
                error:function(jqXHR){
                    $("#msg-error").hide(10);
                    $("#msg-error").show(100);
                    $("#msg-error-p").html("发生错误："+jqXHR.status);
                    console.log(removeHTMLTag(jqXHR.responseText));
                }
            });
        }
        $("html").keydown(function(event){
            if(event.keyCode==13){
                register();
            }
        });
        $("#reg").click(function(){
            register();
        });
        $("#checkMail").click(function(){
        	$("#checkMail").html("发送中.....");
            sendVerCode();
        });
        $("#ok-close").click(function(){
            $("#msg-success").hide(100);
        });
        $("#error-close").click(function(){
            $("#msg-error").hide(100);
        });

        $("#vcode-close").click(function(){
            $("#msg-vcode").hide(100);
        });
    })
</script>
<script type="text/javascript">
    

</script>
<script type="text/javascript">
            // 过滤HTML标签以及&nbsp 来自：http://www.cnblogs.com/liszt/archive/2011/08/16/2140007.html
            function removeHTMLTag(str) {
                    str = str.replace(/<\/?[^>]*>/g,''); //去除HTML tag
                    str = str.replace(/[ | ]*\n/g,'\n'); //去除行尾空白
                    str = str.replace(/\n[\s| | ]*\r/g,'\n'); //去除多余空行
                    str = str.replace(/&nbsp;/ig,'');//去掉&nbsp;
                    return str;
            }
</script>
</body>
</html>
