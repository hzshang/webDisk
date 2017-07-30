<?php
include_once '../lib/config.php';
include_once '../header.php';
use \Ss\File\FileManager;
use \Ss\User\UserInfo;
if(array_key_exists('fid',$_GET)&&array_key_exists ('uid',$_GET)){
	$fid=$_GET['fid'];
	$uid=$_GET['uid'];
	$fm=new FileManager();
	$ok=$fm->checkshareFile($fid,$uid);
	$U=new UserInfo($uid);
}else{
	$ok=false;
}

?>
<?php if($ok){?>

<div class="container center">
<br>
<br>
<br>
<br>
<div id="pre">
	<h5><?php echo $U->GetUserName();?>分享了一个文件，请输入提取码：</h5>
	<input id="pwd" type="text" style="width: 50%">
	<br>
	<button id="submit" class="btn btn-sm btn-danger">提交</button>
    <div id="error" style="display: none">
	    <br>
	    <center>密码输入错误</center>
    </div>
</div>
<div id="authed" style="display: none">
	<table class="table table-hover">
    <colgroup>
       <col span="1" style="width: 30%;">
       <col span="1" style="width: 15%;">
       <col span="1" style="width: 15%;">
       <col span="1" style="width: 15%;">
    </colgroup>
    <tr>
        <th>文件名</th>
        <th>文件类型</th>
        <th>文件大小</th>
        <th></th>
    </tr>
    <tr id="reload">
    </tr>
    </table> 
</div>
</div>
<script type="text/javascript">
$(document).ready(function () {
	function auth(){
		$("#error").hide();
		var formdata=new FormData();
		formdata.append('pwd',$("#pwd").val());
		formdata.append('fid',<?php echo $fid;?>);
		formdata.append('uid',<?php echo $uid;?>);
		var xhr = new XMLHttpRequest();
	    xhr.open('post','_checkFile.php');
	    xhr.onload=function(){
            if (xhr.status === 200) {
            	var str=xhr.responseText;
            	if(str=='0')
            		$("#error").show();
            	else{
            		$("#pre").hide(100);
            		$("#authed").show();
	            	$("#reload").html(str);
            	}
			}
	    };
	    xhr.send(formdata);
	};
	$("#submit").click(function(){
		auth();
	});
	$("html").keydown(function(event){
        if(event.keyCode==13){
            auth();
        }
	});
});
</script>
<?php }else{?>
<br>
<br>
<br>
<br>
<h4><center>没有人给你分享文件</center></h4>
<?php }?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php
include_once '../footer.php';
?>





