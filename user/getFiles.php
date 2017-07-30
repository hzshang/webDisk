<?php
require_once '../lib/config.php';
require_once '_check.php';

use \Ss\File\FileManager;

$fm=new FileManager($U->GetUid());
$iterms=$fm->listFile();
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
       <col span="1" style="width: 3%;">
       <col span="1" style="width: 30%;">
       <col span="1" style="width: 15%;">
       <col span="1" style="width: 15%;">
       <col span="1" style="width: 15%;">
       <col span="1" style="width: 15%;">
    </colgroup>
    <tr>
        <th></th>
        <th>文件名</th>
        <th>文件类型</th>
        <th>文件大小</th>
        <th>上传时间</th>
        <th>操作</th>
    </tr>
    <?php foreach ($iterms as $i) {
        $fileName=substr($i['key'],20);
    ?>
    <tr>
        <td><input class="check" onClick="showMult(this)" value="<?php echo $i['key'];?>" type="checkbox"></td>
        <td><?php echo $fileName;?></td>
        <td><?php echo $i["mimeType"];?></td>
        <td><?php echo getSize($i['fsize']);?></td>
        <td><?php echo date('Y/m/d',$i['putTime']/10000000);?></td>
        <td>
            <a class="btn btn-info btn-sm" href="<?php echo "file_down.php?key=".$i['key']; ?>">下载</a>
            <button class="btn btn-danger btn-sm" onClick=share("<?php echo $i["key"];?>")>分享</button>
        </td>
    </tr>
    <?php }?>
</table>
</div>
</div>
