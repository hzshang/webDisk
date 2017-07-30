<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="baidu_ssp_verify" content="5afa2a249f852c9027ec36dc36199893">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title><?php echo $site_name; ?></title> 
    <link href="//fonts.lug.ustc.edu.cn/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.bootcss.com/materialize/0.100.1/css/materialize.min.css" rel="stylesheet" media="screen,projection">
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.bootcss.com/materialize/0.98.2/js/materialize.min.js"></script>
</head>
<body>
<nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="/" class="brand-logo"><?php echo $site_name; ?></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="index.php">首页</a></li>
            <li><a href="user/register.php">立即注册</a></li>
            <li><a href="user">用户中心</a></li>
        </ul>

        <ul id="nav-mobile" class="side-nav">
            <li><a href="index.php">首页</a></li>
            <li><a href="user/register.php">立即注册</a></li>
            <li><a href="user">用户中心</a></li>
        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
</nav>

