<?php

namespace Ss\User;


class UserInfo {

    public  $uid;
    private $db;


    function __construct($uid=0){
        global $db;
        $this->uid = $uid;
        $this->db  = $db;
    }

    //user info array
    function UserArray(){
        $datas = $this->db->select("user","*",[
            "uid" => $this->uid,
            "LIMIT" => "1"
        ]);
        return $datas['0'];
    }

    function GetPasswd(){
        return $this->UserArray()['pass'];
    }
    function UpdatePwd($pass){
        $this->db->update("user",[
            "pass" => $pass
        ],[
            "uid" => $this->uid
        ]);
    }

    function GetEmail(){
        return $this->UserArray()['email'];
    }
    function GetPrefix(){
        return substr(md5($this->GetEmail()),10,20);
    }

    function GetUserName(){
        return $this->UserArray()['user_name'];
    }

    function RegDate(){
        return $this->UserArray()['reg_date'];
    }
    function isAdmin(){
        if($this->db->has("admin",[
            "uid" => $this->uid
        ])){
            return true;
        }else{
            return false;
        }
    }

    function DelMe(){
        $this->db->delete("user",[
            "uid" => $this->uid
        ]);
    }
    function get_last_login_time(){
        return $this->UserArray()['show_login_time'];
    }

    function set_last_login_time(){
        $last_login_time=$this->get_last_login_time();
        if(time()-$last_login_time>3600){
            $this->db->update("user",[
            '#last_login_time'=>"NOW()"
            ],[
            'uid'=>$this->uid
            ]);
            $this->db->update("user",[
            'show_login_time'=>$last_login_time
            ],[
            'uid'=>$this->uid
            ]);
        }
    }
}