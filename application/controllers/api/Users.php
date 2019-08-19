<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/REST_Controller.php');

class Users extends REST_Controller
{
    public function index_get()
    {
        $this->response($this->db
            ->get('mas_users ')
            ->result());
    }

    public function index_post()
    {
        $json = file_get_contents('php://input');
        $obj = json_decode($json);
        $rs = $this->db
            ->where('level',$obj->level)
            ->join('level b','a.level = b.level_id')
            ->order_by('order','ASC')
            ->get('cat_vocabulary a ')
            ->result();
        $this->response($rs);

    }

    public function index_put()
    {

    }

    public function index_delete()
    {

    }
}