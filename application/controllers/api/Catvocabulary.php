<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'libraries/REST_Controller.php');

class Catvocabulary extends REST_Controller
{
    public function index_get()
    {
        $this->response($this->db
            ->where('level','8')
            ->order_by('order','ASC')
            ->join('level b','a.level = b.level_id')
            ->get('cat_vocabulary a ')
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
        // สร้างรายการข่าวใหม่
    }

    public function index_put()
    {
        // แก้ไขรายการข่าว
    }

    public function index_delete()
    {
        // ลบรายการข่าว
    }
}