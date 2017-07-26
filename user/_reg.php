<?php
require_once '../lib/config.php';
$email = $_POST['email'];
$email = strtolower($email);
$passwd = $_POST['passwd'];
$name = $_POST['name'];
$repasswd = $_POST['repasswd'];
$verCode = $_POST['verCode'];


$c = new \Ss\User\UserCheck();

if(!$c->IsEmailLegal($email)){
    $a['msg'] = "邮箱无效";
}else if($c->IsEmailUsed($email)){
    $a['msg'] = "邮箱已被使用";
}else if($repasswd != $passwd){
    $a['msg'] = "两次密码输入不符";
}else if(strlen($passwd)<8){
    $a['msg'] = "密码太短";
}else if(strlen($name)<7){
    $a['msg'] = "用户名太短";
}else if($c->IsUsernameUsed($name)){
    $a['msg'] = "用户名已经被使用";
}else if(!$c->isVcode($verCode))
{
    $a['msg']='验证码不正确';
}else{
    $passwd = \Ss\User\Comm::SsPW($passwd);
    $reg = new \Ss\User\Reg();
    $reg->Reg($name,$email,$passwd);
    $a['ok'] = '1';
    $a['msg'] = "注册成功";
}
echo json_encode($a);