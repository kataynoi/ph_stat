<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class Admin_user_model extends CI_Model
{
    var $table = "users";
    var $order_column = Array('id', 'username', 'password', 'name', 'user_type', 'email', 'active',);

    function make_query()
    {
        $this->db->from($this->table);
        if (isset($_POST["search"]["value"])) {
            $this->db->group_start();
            $this->db->like("username", $_POST["search"]["value"]);
            $this->db->or_like("name", $_POST["search"]["value"]);
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
    public function del_admin_user($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->delete('users');
        return $rs;
    }

    public function get_cuser_type()
    {
        $rs = $this->db
            ->get("cuser_type")
            ->result();
        return $rs;
    }

    public function get_user_type_name($id)
    {
        $rs = $this->db
            ->where("id", $id)
            ->get("cuser_type")
            ->row();
        return $rs ? $rs->name : "";
    }

    public function save_admin_user($data)
    {
        if($data['password'] !=''){
            $this->db->set('password', "PASSWORD('".$data['password']."')", false);
        }
        $rs = $this->db
            ->set("id", $data["id"])
            ->set("username", $data["username"])
            ->set("name", $data["name"])
            ->set("user_type", $data["user_type"])
            ->set("email", $data["email"])
            ->set("active", $data["active"])
            ->insert('users');

        return $rs;

    }

    public function update_admin_user($data)
    {
        if($data['password'] !=''){
            $this->db->set('password', "PASSWORD('".$data['password']."')", false);
        }
        $rs = $this->db
            ->set("id", $data["id"])
            ->set("username", $data["username"])
            ->set("name", $data["name"])
            ->set("user_type", $data["user_type"])
            ->set("email", $data["email"])
            ->set("active", $data["active"])
            ->where("id", $data["id"])
            ->update('users');

        return $rs;

    }

    public function get_admin_user($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->get("users")
            ->row();
        return $rs;
    }
}