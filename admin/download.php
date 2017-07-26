<?php
$path=$_GET['path'];
if(file_exists($path)){
	header("Content-Type: appli cation/force-download"); 
	header("Content-Disposition: attachment; filename=".basename('payCode.txt'));
	readfile($path);
}else{
	echo "No such file.";
}

?>