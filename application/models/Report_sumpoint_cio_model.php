<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class Report_sumpoint_cio_model extends CI_Model
{
    var $table = "data_result";
    var $order_column = Array('kpi_id','kpi_name','month_time','point',);

    function make_query()
    {
        $this->db
            ->select('amp,sum(point) as point')
            ->group_by('amp')
            ->order_by('point','DESC')
            ->from($this->table);
        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('', '');
        }
    }

    function make_datatables()
    {
        $this->make_query();
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function get_filtered_data()
    {
        $this->make_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_all_data()
    {
        $this->db->select("*");
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }


    /* End Datatable*/

    public function get_report_sumpoint_cio($id)
                {
                    $rs = $this->db
                        ->where('id',$id)
                        ->get("data_result")
                        ->row();
                    return $rs;
                }
}