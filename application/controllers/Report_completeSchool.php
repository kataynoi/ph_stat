<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_completeSchool extends CI_Controller
{
    public $user_id;
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Report_completeSchool_model', 'crud');
    }

    public function index()
    {
        $data[] = '';
        
        $this->layout->view('report_completeSchool/index', $data);
    }


    function fetch_report_completeSchool()
    {
        $fetch_data = $this->crud->make_datatables();
        $data = array();
        foreach ($fetch_data as $row) {


            $sub_array = array();
                $sub_array[] = $row->ampcode;$sub_array[] = $row->ampurname;$sub_array[] = $row->total;$sub_array[] = $row->complete;$sub_array[] = $row->uncomplete;
                $sub_array[] = '<div class="btn-group pull-right" role="group" >';
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


    public function  get_report_completeSchool()
    {
                $id = $this->input->post('id');
                $rs = $this->crud->get_report_completeSchool($id);
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": ' . $rows . '}';
                render_json($json);
    }
}