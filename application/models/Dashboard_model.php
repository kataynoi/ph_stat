<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class Dashboard_model extends CI_Model
{


    public function get_com_bybrand()
    {
        $rs = $this->db
            ->select('')
            ->get("com_survey as a")
            ->result();
        return $rs;
    }
}