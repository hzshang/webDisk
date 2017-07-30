<?php
require_once '../lib/config.php';
require_once '_check.php';


use \Ss\File\FileManager;
$fm=new FileManager($U->GetUid());

$key=$_POST['key'];
echo json_encode($fm->getShareUrl($key));
