<?php
require_once '../lib/config.php';
require_once '_check.php';

require_once '../vendor/autoload.php';
use Qiniu\Auth;
use Qiniu\Storage\BucketManager;

$file=$_POST['file'];

$key=$U->GetPrefix()."/".$file;

$auth = new Auth($accessKey, $secretKey);
$bucketMgr = new BucketManager($auth);
  //你要测试的空间， 并且这个key在你空间中存在

//删除$bucket 中的文件 $key
$err = $bucketMgr->delete($bucket, $key);
if ($err !== null) {
  echo "0";
} else {
  echo "1";
}
