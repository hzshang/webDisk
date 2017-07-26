<?php
namespace Ss\File;
require_once '../vendor/autoload.php';
require_once '_sign.php';
use Qiniu\Auth;
use Qiniu\Storage\BucketManager;

class FileManager{
	private $accessKey;
	private $secretKey;
	private $prefix;
	private $bucket;
	function __construct($email){
		global $accessKey;
		global $secretKey;
		global $bucket;
		$x=md5($uid);
		$this->prefix=substr($x,10,20);
		$this->accessKey=$accessKey;
		$this->secretKey=$secretKey;
		$this->bucket=$bucket;
	}
	function listFile(){
		
	}
	function delFile($Filekey){

	}
	function uplaodFile(){

	}
}