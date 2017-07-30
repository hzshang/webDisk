<?php
include_once '../lib/config.php';
use \Ss\File\FileManager;

$fid=$_POST['fid'];
$uid=$_POST['uid'];
$pwd=$_POST['pwd'];
$fm=new FileManager();
$key=$fm->getShareFile($fid,$uid,$pwd);
if($key==false){
  echo '0';
  exit();
}
$fileName=substr($key,20);
$stat=$fm->getStat($key);
function getSize($fsize){
    global $togb;
    global $tomb;
    global $tokb;
    if($fsize>$togb)
        return number_format($fsize/$togb,2)."GB";
    else if($fsize>$tomb)
        return number_format($fsize/$tomb,2)."MB";
    else
        return number_format($fsize/$tokb,2)."KB";
}
?>

<td><?php echo $fileName;?></td>
<td><?php echo $stat['mimeType'];?></td>
<td><?php echo getSize($stat['fsize']);?></td>
<td><a class="btn btn-info btn-sm" href="<?php echo $fm->getUrl($key); ?>">下载</a></td>