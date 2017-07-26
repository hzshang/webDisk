<?php
namespace Ss\User;

class Reg {
    private $db;
    private $table = "user";
    function __construct(){
        global $db;
        $this->db = $db;
    }

    function Reg($username,$email,$pass){
        $this->db->insert($this->table,[
            "user_name" => $username,
            "email" => $email,
            "pass" => $pass,
            "enable" =>1,
            "#reg_date" =>  'NOW()'
        ]);
    }

}