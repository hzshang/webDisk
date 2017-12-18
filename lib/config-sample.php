<?php
//定义流量
$tokb = 1024;
$tomb = 1024*1024;
$togb = $tomb*1024;
//Define DB Connection  数据库信息
define('DB_HOST','localhost');
define('DB_USER','user');
define('DB_PWD','pass');
define('DB_DBNAME','db_name');
define('DB_CHARSET','utf8');
define('DB_TYPE','mysql'); 
/*
 * 下面的东西根据需求修改
 */

//注册用户的初始化
//默认5GiB
$a_space=$togb*5;

//name
$site_name = "WEB DISK";
$site_url  = "http://your.domain/";


/**
 * 站点盐值，用于加密密码
 * 第一次安装请修改此值，安装后请勿修改！！否则会使所有密码失效，仅限加密方式不为1的时候有效
 */
$salt = "web-disk";
/**
 * 密码加密方式，注意： 2.4以前的版本，请修改加密方式为「1」，否则会使密码失效！
 * 更多说明见wiki https://github.com/orvice/ss-panel/wiki/Install-Guide-zh_cn
 * 加密方式:
 * 1 md5
 * 2 带salt的Sha256加密，新安装建议使用此加密方式！
 */
$pwd_mode = 1;


//配置邮箱，用来发送验证码
$account ='admin@email.com';
$user_pass='your_password';
$smtp_server='smtp.email.com';
$user_name='admin';
$smtp_secure='ssl';//支持'tsl'
$mail_port=465;

//从七牛云获取accessKey 和secretKey
$accessKey = 'XXXXXXXXXXXXXXXXXXX';
$secretKey = 'XXXXXXXXXXXXXXXXXXX';
//七牛云存储空间名字
$bucket='webapp';
//七牛云存储空间域名
$domain='http://otmq261fm.bkt.clouddn.com/';
//七牛云文件上传地址
$upRegion='http://up-z0.qiniu.com/';

require_once 'do.php';


