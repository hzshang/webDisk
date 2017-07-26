<?php
require_once '../lib/config.php';
require_once '_check.php';
require_once '../vendor/autoload.php';
date_default_timezone_set('PRC');
use Qiniu\Auth;
use Qiniu\Storage\BucketManager;
$auth = new Auth($accessKey, $secretKey);
$upToken=$auth->uploadToken($bucket);
$bucketMgr = new BucketManager($auth);
$prefix=$U->GetPrefix();
$marker='';
$limit=1000;
list($iterms, $marker, $err) = $bucketMgr->listFiles($bucket, $prefix, $marker, $limit);
if($err){
    exit();
}
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
<div class="box">
<div class="box-body table-responsive no-padding">
<table class="table table-hover">
    <colgroup>
       <col span="1" style="width: 30%;">
       <col span="1" style="width: 15%;">
       <col span="1" style="width: 15%;">
       <col span="1" style="width: 15%;">
       <col span="1" style="width: 15%;">
    </colgroup>
    <tr>
        <th>文件名</th>
        <th>文件类型</th>
        <th>文件大小</th>
        <th>上传时间</th>
        <th>操作</th>
    </tr>
    <?php foreach ($iterms as $i) {
        $authUrl=$auth->privateDownloadUrl($domain.$i['key']);
    ?>
    <tr>
        <td><?php echo substr($i['key'],21);?></td>
        <td><?php echo $i["mimeType"];?></td>
        <td><?php echo getSize($i['fsize']);?></td>
        <td><?php echo date('Y/m/d',$i['putTime']/10000000);?></td>
        <td>
            <a class="btn btn-info btn-sm" href="<?php echo $authUrl; ?>">下载</a>
            <button class="btn btn-danger btn-sm" onClick=del_File("<?php echo substr($i["key"],21);?>")>删除</button>
        </td>
    </tr>
    <?php }?>
</table>
</div>
</div>
