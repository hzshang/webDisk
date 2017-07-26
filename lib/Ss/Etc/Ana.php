<?php


namespace Ss\Etc;


class Ana extends Db {

    //统计用户
    function allUserCount(){
        $c = $this->db->count("user","uid");
        return $c;
    }

}