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
    <!-- jQuery 2.1.3 -->
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="https://cdn.bootcss.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="https://cdn.bootcss.com/iCheck/1.0.2/icheck.min.js"></script>

</head>
<body class="login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b><?php echo $site_name;  ?></b></a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">登录到用户中心</p>

            <form>
            <div class="form-group has-feedback">
                <input id="email" name="Email" type="text" class="form-control" placeholder="邮箱"/>
                <span  class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="passwd" name="Password" type="password" class="form-control" placeholder="密码"/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            </form>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input id="remember_me" value="week" type="checkbox"> 记住我
                        </label>
                    </div>
                </div><!-- /.col -->
                <div class="col-xs-4">
                    <button id="login" type="submit" class="btn btn-primary btn-block btn-flat">登录</button>
                </div><!-- /.col -->
            </div>
            <div id="msg-success" class="alert alert-info alert-dismissable" style="display: none;">
                <button type="button" class="close" id="ok-close" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-info"></i> 登录成功!</h4>
                <p id="msg-success-p"></p>
            </div>
            <div id="msg-error" class="alert alert-warning alert-dismissable" style="display: none;">
                <button type="button" class="close" id="error-close" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> 出错了!</h4>
                <p id="msg-error-p"></p>
            </div>
        <a href="resetpwd.php">忘记密码</a><br>
        <a href="register.php" class="text-center">注册个帐号</a>

    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->


<script src="src/login.js"></script>

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
