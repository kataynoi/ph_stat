<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class Report_cio_model extends CI_Model
{
    var $table = "data_result";
    var $order_column = Array('kpi_name','kpi_type','month_time','amp','calc_result','point',);

    function make_query()
    {
        $this->db->from($this->table);
        if (isset($_POST["search"]["value"])) {
            $this->db->group_start();
            $this->db->like("kpi_name", $_POST["search"]["value"]);$this->db->or_like(" month_time", $_POST["search"]["value"]);$this->db->or_like(" amp", $_POST["search"]["value"]);
            $this->db->group_end();

        }

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
    public function del_report_cio($id)
        {
        $rs = $this->db
            ->where('id', $id)
            ->delete('data_result');
        return $rs;
        }

        

    public function save_report_cio($data)
            {

                $rs = $this->db
                    ->set("kpi_name", $data["kpi_name"])->set("kpi_id", $data["kpi_id"])->set("kpi_type", $data["kpi_type"])->set("month_time", $data["month_time"])->set("amp", $data["amp"])->set("target", $data["target"])->set("result", $data["result"])->set("calc_result", $data["calc_result"])->set("point", $data["point"])
                    ->insert('data_result');

                return $this->db->insert_id();

            }
    public function update_report_cio($data)
            {
                $rs = $this->db
                    ->set("kpi_name", $data["kpi_name"])->set("kpi_id", $data["kpi_id"])->set("kpi_type", $data["kpi_type"])->set("month_time", $data["month_time"])->set("amp", $data["amp"])->set("target", $data["target"])->set("result", $data["result"])->set("calc_result", $data["calc_result"])->set("point", $data["point"])->where("id",$data["id"])
                    ->update('data_result');

                return $rs;

            }
    public function get_report_cio($id)
                {
                    $rs = $this->db
                        ->where('id',$id)
                        ->get("data_result")
                        ->row();
                    return $rs;
                }
}