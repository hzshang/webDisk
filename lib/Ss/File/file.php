<?php

namespace Ss\File;


class File{

	public string $key;
	public int $fsize;
	public string $mimeType;
	public int $putTime;

	public string $fileName;
	public string $prefix;

	function __construct($array){
		$this->key=$array["key"];
		$this->fsize=$array["fsize"];
		$this->mimeType=$array["mimeType"];
		$this->putTime=$array["putTime"];
		splitKey();
	}
	function splitKey(){
		$pos=strrpos($this->key,'/')+1;
		$this->prefix=substr($this->key,0,$pos);
		$this->fileName=substr($this->key,$pos+1);
	}

}