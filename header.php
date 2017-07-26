<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title><?php echo $site_name; ?></title> 
    <link href="//fonts.lug.ustc.edu.cn/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.bootcss.com/materialize/0.100.1/css/materialize.min.css" rel="stylesheet" media="screen,projection">
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

