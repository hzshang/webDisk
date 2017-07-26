<?php
require_once '../lib/config.php';
require_once '_check.php';

$text=$_POST['text'];
$myfile=fopen("../user/announce.php",'w+');
fwrite($myfile,$text);
fclose($myfile);