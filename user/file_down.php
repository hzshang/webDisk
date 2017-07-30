<?php
require_once '../lib/config.php';
require_once '_check.php';

use \Ss\File\FileManager;

$fm=new FileManager($U->GetUid());
$key=$_GET['key'];
$url=$fm->getUrl($key);
header("Location:$url");
