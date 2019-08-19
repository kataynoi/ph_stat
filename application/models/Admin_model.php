<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class Admin_model extends CI_Model
{
    var $table = "admin_dashboard";
    var $order_column = Array('id','equipment_id','total','status1','status2','status3','status4','status5','status6',);

    function make_query()
    {
        $this->db->from($this->table);
        if (isset($_POST["search"]["value"])) {
            $this->db->group_start();
            $this->db->like("equipment_id", $_POST["search"]["value"]);
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
    public function del_admin($id)
        {
        $rs = $this->db
            ->where('id', $id)
            ->delete('admin_dashboard');
        return $rs;
        }

        public function get_cequipment(){
                        $rs = $this->db
                        ->get("cequipment")
                        ->result();
                        return $rs;}public function get_use_status(){
                        $rs = $this->db
                        ->get("cuse_status")
                        ->result();
                        return $rs;}

    public function save_admin($data)
            {

                $rs = $this->db
                    ->set("id", $data["id"])->set("equipment_id", $data["equipment_id"])->set("total", $data["total"])->set("status", $data["status"])->set("id", $data["id"])->set("equipment_id", $data["equipment_id"])->set("total", $data["total"])->set("status1", $data["status1"])->set("status2", $data["status2"])
                    ->insert('admin_dashboard');

                return $rs;

            }
    public function update_admin($data)
            {
                $rs = $this->db
                    ->set("id", $data["id"])->set("equipment_id", $data["equipment_id"])->set("total", $data["total"])->set("status", $data["status"])->set("id", $data["id"])->set("equipment_id", $data["equipment_id"])->set("total", $data["total"])->set("status1", $data["status1"])->set("status2", $data["status2"])->where("id",$data["id"])
                    ->update('admin_dashboard');

                return $rs;

            }
    public function get_admin($id)
                {
                    $rs = $this->db
                        ->where('id',$id)
                        ->get("admin_dashboard")
                        ->row();
                    return $rs;
                }
}