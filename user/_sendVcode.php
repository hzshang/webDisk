<?php
require_once '../lib/config.php';
require_once '../lib/mail/PHPMailerAutoload.php';
function randomCode() {  
	  $srcstr="ABCDEFGHIJKLMNPQRSTUVWXYZ123456789"; 
	  $strs="";  
	  for($i=0;$i<10;$i++) {  
	    $strs.=$srcstr[rand(0,33)];  
	 }  
	 return $strs;
}
function insertCode($vcode){
	global $db;
	$db->insert('vcode',[
		'vcode'=>$vcode
		]);

}
$a['msg']='';
$email = $_POST['email'];
$c = new \Ss\User\UserCheck();
if(!$c->IsEmailLegal($email)){
    $a['msg'] = "邮箱无效";
    echo json_encode($a);
}else{
	$a['ok']='1';
	$a['msg']='验证码已发送';
	echo json_encode($a);
	$email = strtolower($email);
	$vcode=randomCode();
	$mail = new PHPMailer;
	$mail->CharSet='UTF-8';
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = $smtp_server;  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = $account;                 // SMTP username
	$mail->Password = $user_pass;                           // SMTP password
	$mail->SMTPSecure =$smtp_secure;                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = $mail_port;    	                      // TCP port to connect to
	$mail->setFrom($account,$user_name);
	$mail->addAddress($email);
	$mail->isHTML(true);                                  // Set email format to HTML
	$mail->Subject = $site_name;
	$mail->Body    = '您的验证码为 <b>'.$vcode.'</b>,欢迎使用!';
	$mail->AltBody = '';
	$mail->send();
	insertCode($vcode);
}
