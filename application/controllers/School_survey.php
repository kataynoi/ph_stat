<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class School_survey extends CI_Controller
{
    public $user_id;

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata("user_type") != 2)
            redirect(site_url('user/login'));
        $this->load->model('School_survey_model', 'crud');
    }

    public function index()
    {
        $data[] = '';
        $data["cjurisdiction"] = $this->crud->get_cjurisdiction();
        $data["corganizationtype"] = $this->crud->get_corganizationtype();
        $data["chospital_mk"] = $this->crud->get_chospital_mk();
        $this->layout->view('school_survey/index', $data);
    }


    function fetch_school_survey()
    {
        $fetch_data = $this->crud->make_datatables();
        $data = array();
        foreach ($fetch_data as $row) {


            $sub_array = array();
            //$sub_array[] = $row->ACADEMICYEAR;
            $sub_array[] = $row->SCHOOLID;
            $sub_array[] = $row->SCHOOLNAME;
            //$sub_array[] = $row->SCHOOLNAMEENG;
            /*$sub_array[] = $row->HOUSEID;
            $sub_array[] = $row->HOUSENUMBER;
            $sub_array[] = $row->VILLAGENUMBER;
            $sub_array[] = $row->TROK;
            $sub_array[] = $row->SOI;
            $sub_array[] = $row->STREET;*/
            $sub_array[] = $row->AMPURCODE;
            $sub_array[] = $row->SUBDISTRICTCODE;
            /*$sub_array[] = $row->POSTCODE;*/
            $sub_array[] = $row->TELEPHONE1;
           /* $sub_array[] = $row->TELEPHONE2;
            $sub_array[] = $row->FAX;
            $sub_array[] = $row->EMAIL;
            $sub_array[] = $row->WEBSITE;
            $sub_array[] = $row->ESTABLISHEDDATE;*/
/*            $sub_array[] = $row->JURISDICTIONID;
            $sub_array[] = $row->ORGANIZATIONTYPECODE;*/
            /*$sub_array[] = $row->SCHOOLSTATUSCODE;
            $sub_array[] = $row->ORGANIZATIONREMARK;
            $sub_array[] = $row->MUNICIPALCODE;
            $sub_array[] = $row->ADMINISTRATORNAME;
            $sub_array[] = $row->LATITUDE;
            $sub_array[] = $row->LONGITUDE;
            $sub_array[] = $row->EDUCATIONSYSTEMTYPECODE;
            $sub_array[] = $row->EDUCATIONLEVELCODE;
            $sub_array[] = $row->ELECTRICTYPECODE;
            $sub_array[] = $row->INTERNETTYPECODE;
            $sub_array[] = $row->MEDIATYPECODE;
            $sub_array[] = $row->COMPUTERTEACHNUMBER;
            $sub_array[] = $row->COMPUTERMANAGENUMBER;
            $sub_array[] = $row->MALETOILETNUMBER;
            $sub_array[] = $row->FEMALETOILETNUMBER;
            $sub_array[] = $row->TOTALTOILETNUMBER;
            $sub_array[] = $row->ClassroomNumber;*/
            $sub_array[] = $row->hospcode;
            $sub_array[] = '<div class="btn-group pull-right" role="group" >
                  <button class="btn btn-outline btn-warning" data-btn="btn_edit" data-id="' . $row->SCHOOLID . '"><i class="fa fa-edit"></i></button>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $this->crud->get_all_data(),
            "recordsFiltered" => $this->crud->get_filtered_data(),
            "data" => $data
        );
        echo json_encode($output);
    }

    public function del_school_survey()
    {
        $id = $this->input->post('id');

        $rs = $this->crud->del_school_survey($id);
        if ($rs) {
            $json = '{"success": true}';
        } else {
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function  save_school_survey()
    {
        $data = $this->input->post('items');
        if ($data['action'] == 'insert') {
            $rs = $this->crud->save_school_survey($data);
            if ($rs) {
                $json = '{"success": true,"id":' . $rs . '}';
            } else {
                $json = '{"success": false}';
            }
        } else if ($data['action'] == 'update') {
            $rs = $this->crud->update_school_survey($data);
            if ($rs) {
                $json = '{"success": true}';
            } else {
                $json = '{"success": false}';
            }
        }

        render_json($json);
    }

    public function  get_school_survey()
    {
        $id = $this->input->post('id');
        $rs = $this->crud->get_school_survey($id);
        $rows = json_encode($rs);
        $json = '{"success": true, "rows": ' . $rows . '}';
        render_json($json);
    }
}