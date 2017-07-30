<?php
namespace Ss\File;
require_once '../vendor/autoload.php';
use Qiniu\Auth;
use Qiniu\Storage\BucketManager;

class FileManager{

	private $Auth;
	private $bucketMgr;
	private $bucket;
	private $db;
	private $uid;
	function __construct($uid=-1){
		global $accessKey;
		global $secretKey;
		global $bucket;
		global $db;
		$this->Auth = new Auth($accessKey, $secretKey);
		$this->bucketMgr = new BucketManager($this->Auth);
		$this->bucket=$bucket;
		$this->db=$db;
		$this->uid=$uid;
		date_default_timezone_set('PRC');
	}
	function listFile(){
		$iterms=$this->db->select('file',['key','mimeType','putTime','fsize'],[
			'uid'=>$this->uid
			]);
		return $iterms;
	}
	function delFile($key){
		$data=$this->db->select('file',['uid'],[
			'key'=>$key]);
		if(count($data)==0)
			return false;
		$uid=$data[0]['uid'];
		if($uid==$this->uid){
			$this->db->delete('file',['key'=>$key]);
			$this->bucketMgr->delete($this->bucket, $key);
			return true;
		}else
			return false;
	}
	function upToken(){
		return $this->Auth->uploadToken($this->bucket);
	}
	function getUrl($key){
		global $domain;
		$name=substr($key,20);
		$url=$domain.$key."?attname=".urlencode($name);
		return $this->Auth->privateDownloadUrl($url);
	}
	function randomCode() {  
		$srcstr="ABCDEFGHIJKLMNPQRSTUVWXYZ123456789"; 
		$strs="";  
		for($i=0;$i<4;$i++) {  
		$strs.=$srcstr[rand(0,33)];  
		}  
		return $strs;
	}
	function getStat($key){
		list($ret, $err) =$this->bucketMgr->stat($this->bucket,$key);
		if ($err !== null) {
		  return false;
		} else {
		  return $ret;
		}
	}
	function addFile($key){
		$stat=$this->getStat($key);
		if($stat===false)
			return false;
		$this->db->insert('file',[
			'uid'=>$this->uid,
			'key'=>$key,
			'fsize'=>$stat['fsize'],
			'putTime'=>$stat['putTime'],
			'mimeType'=>$stat['mimeType']
		]);
		return true;
	}
	function getShareUrl($key){
		if(!$this->db->has('file',["and"=>['key'=>$key,'uid'=>$this->uid]]))
			return '0';
		$pwd=$this->randomCode();
		$fid=$this->db->select('file',['fid'],["and"=>['$key'=>$key,'uid'=>$this->uid]])[0]['fid'];
		$this->db->insert('share',['fid'=>$fid,'uid'=>$this->uid,'pwd'=>$pwd]);
		global $site_url;
		$ret['url']=$site_url."share/index.php?fid=$fid&uid=$this->uid";
		$ret['pwd']=$pwd;
		return $ret;
	}
	function checkShareFile($fid,$uid){
		return $this->db->has('share',["and"=>["fid"=>$fid,"uid"=>$uid]]);
	}
	function getShareFile($fid,$uid,$pwd){
		if(!$this->db->has('share',["and"=>["fid"=>$fid,"uid"=>$uid,"pwd"=>$pwd]])||!$this->db->has('file',['fid'=>$fid]))
			return false;
		$key=$this->db->select('file',['key'],["fid"=>$fid])[0]['key'];
		return $key;
	}
}