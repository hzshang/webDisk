<?php
//检测是否登录，若没登录则转向登录界面
if(isset($_COOKIE['uid'])|| $_COOKIE['uid'] != ''){

        $uid = $_COOKIE['uid'];

        $user_pwd  = $_COOKIE['user_pwd'];

        $U = new \Ss\User\UserInfo($uid);
        //验证cookie
        $pwd = $U->GetPasswd();
        $pw = \Ss\User\Comm::CoPW($pwd);
        if($pw != $user_pwd || $pw == null || $user_pwd == null ){
           header("Location:login.php");
        }
        if(!$U->isAdmin()){
            header("Location:../user/index.php");
            exit();
        }
}else{
    header("Location:login.php");
    exit();
}