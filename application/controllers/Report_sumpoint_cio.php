<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_sumpoint_cio extends CI_Controller
{
    public $user_id;

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Report_sumpoint_cio_model', 'crud');
    }

    public function index()
    {
        $data[] = '';

        $this->layout->view('report_sumpoint_cio/index', $data);
    }


    /**
     *
     */
    function fetch_report_sumpoint_cio()
    {
        $fetch_data = $this->crud->make_datatables();
        $data = array();
        $n=1;
        foreach ($fetch_data as $row) {
            $sub_array = array();
            $sub_array[] = $n;
            $sub_array[] = $row->amp;
            $sub_array[] = number_format($row->point,2);
            $n++;
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

    public function del_report_sumpoint_cio()
    {
        $id = $this->input->post('id');

        $rs = $this->crud->del_report_sumpoint_cio($id);
        if ($rs) {
            $json = '{"success": true}';
        } else {
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function  save_report_sumpoint_cio()
    {
        $data = $this->input->post('items');
        if ($data['action'] == 'insert') {
            $rs = $this->crud->save_report_sumpoint_cio($data);
            if ($rs) {
                $json = '{"success": true,"id":' . $rs . '}';
            } else {
                $json = '{"success": false}';
            }
        } else if ($data['action'] == 'update') {
            $rs = $this->crud->update_report_sumpoint_cio($data);
            if ($rs) {
                $json = '{"success": true}';
            } else {
                $json = '{"success": false}';
            }
        }

        render_json($json);
    }

    public function  get_report_sumpoint_cio()
    {
        $id = $this->input->post('id');
        $rs = $this->crud->get_report_sumpoint_cio($id);
        $rows = json_encode($rs);
        $json = '{"success": true, "rows": ' . $rows . '}';
        render_json($json);
    }
}