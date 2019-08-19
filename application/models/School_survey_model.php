<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class School_survey_model extends CI_Model
{
    var $table = "school as a";
    var $order_column = Array('SCHOOLID', 'SCHOOLNAME', 'SUBDISTRICTCODE', 'TELEPHONE1', 'JURISDICTIONID', 'ORGANIZATIONTYPECODE', 'hospcode',);

    function make_query()
    {   $this->db->select('SCHOOLID,SCHOOLNAME, b.ampurname as AMPURCODE,c.tambonname as SUBDISTRICTCODE,TELEPHONE1,JURISDICTIONID,ORGANIZATIONTYPECODE,d.hosname as hospcode')
                ->join('campur as b','LEFT(a.SUBDISTRICTCODE,4) = b.ampurcodefull')
                ->join('ctambon as c','a.SUBDISTRICTCODE = c.tamboncodefull')
                ->join('chospital_mk as d','a.hospcode = d.hoscode','LEFT')
                ->from($this->table);
        if (isset($_POST["search"]["value"])) {
            $this->db->group_start();
            $this->db->like("a.SCHOOLNAME", $_POST["search"]["value"]);
            $this->db->or_like("b.ampurname", $_POST["search"]["value"]);
            $this->db->or_like("c.tambonname", $_POST["search"]["value"]);
            $this->db->or_like("d.hosname", $_POST["search"]["value"]);
            $this->db->or_like("a.SUBDISTRICTCODE", $_POST["search"]["value"]);
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
    public function del_school_survey($id)
    {
        $rs = $this->db
            ->where('SCHOOLID', $id)
            ->delete('school');
        return $rs;
    }

    public function get_cjurisdiction()
    {
        $rs = $this->db
            ->get("cjurisdiction")
            ->result();
        return $rs;
    }

    public function get_JURISDICTIONID_name($id)
    {
        $rs = $this->db
            ->where("SCHOOLID", $id)
            ->get("cjurisdiction")
            ->row();
        return $rs ? $rs->name : "";
    }

    public function get_corganizationtype()
    {
        $rs = $this->db
            ->get("corganizationtype")
            ->result();
        return $rs;
    }

    public function get_ORGANIZATIONTYPECODE_name($id)
    {
        $rs = $this->db
            ->where("SCHOOLID", $id)
            ->get("corganizationtype")
            ->row();
        return $rs ? $rs->name : "";
    }

    public function get_chospital_mk()
    {
        $rs = $this->db
            ->where('provcode','44')
            ->get("chospital_mk")
            ->result();
        return $rs;
    }

    public function get_hospcode_name($id)
    {
        $rs = $this->db
            ->where("hoscode", $id)
            ->get("chospital_mk")
            ->row();
        return $rs ? $rs->name : "";
    }


    public function update_school_survey($data)
    {
        $rs = $this->db
            ->set("hospcode", $data["hospcode"])
            ->where("SCHOOLID", $data["SCHOOLID"])
            ->update('school');

        return $rs;

    }

    public function get_school_survey($id)
    {
        $rs = $this->db
            ->select('SCHOOLID,SCHOOLNAME, SUBDISTRICTCODE,TELEPHONE1,JURISDICTIONID,ORGANIZATIONTYPECODE,hospcode')
            ->where('SCHOOLID', $id)
            ->get("school")
            ->row();
        return $rs;
    }
}