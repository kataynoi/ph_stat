<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_cio extends CI_Controller
{
    public $user_id;

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata("user_type") != 2)
            redirect(site_url('user/login'));

        $this->load->model('Report_cio_model', 'crud');
    }

    public function index()
    {
        $data[] = '';

        $this->layout->view('report_cio/index', $data);
    }


    function fetch_report_cio()
    {
        $fetch_data = $this->crud->make_datatables();
        $data = array();
        foreach ($fetch_data as $row) {


            $sub_array = array();
            $sub_array[] = $row->kpi_name;
            //$sub_array[] = $row->kpi_id;
            $sub_array[] = $row->kpi_type;
            $sub_array[] = $row->month_time;
            $sub_array[] = $row->amp;
            //$sub_array[] = $row->target;
            //$sub_array[] = $row->result;
            $sub_array[] = $row->calc_result;
            $sub_array[] = $row->point;
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

    public function del_report_cio()
    {
        $id = $this->input->post('id');

        $rs = $this->crud->del_report_cio($id);
        if ($rs) {
            $json = '{"success": true}';
        } else {
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function  save_report_cio()
    {
        $data = $this->input->post('items');
        if ($data['action'] == 'insert') {
            $rs = $this->crud->save_report_cio($data);
            if ($rs) {
                $json = '{"success": true,"id":' . $rs . '}';
            } else {
                $json = '{"success": false}';
            }
        } else if ($data['action'] == 'update') {
            $rs = $this->crud->update_report_cio($data);
            if ($rs) {
                $json = '{"success": true}';
            } else {
                $json = '{"success": false}';
            }
        }

        render_json($json);
    }

    public function  get_report_cio()
    {
        $id = $this->input->post('id');
        $rs = $this->crud->get_report_cio($id);
        $rows = json_encode($rs);
        $json = '{"success": true, "rows": ' . $rows . '}';
        render_json($json);
    }
}