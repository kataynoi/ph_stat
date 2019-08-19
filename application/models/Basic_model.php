<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Basic_model extends CI_Model
{

    public function sl_hospcode($id='44'){

        $rs = $this->db
            ->where('provcode',$id)
            ->get('chospital')
            ->result();
        return $rs;
    }

    public function sl_group(){

        $rs = $this->db
            //->where('provcode',$id)
            ->get('co_workgroup')
            ->result();
        return $rs;
    }
    public function sl_employee_type(){

        $rs = $this->db
            //->where('provcode',$id)
            ->get('employee_type')
            ->result();
        return $rs;
    }
    public function sl_cars(){

        $rs = $this->db
            //->where('provcode',$id)
            ->get('car')
            ->result();
        return $rs;
    }
    public function get_user_name($id){

        $rs = $this->db
            ->where('id',$id)
            ->get('mas_users')
            ->row();
        return $rs?$rs->prename.$rs->name:'-';
    }

}