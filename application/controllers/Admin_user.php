<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_user extends CI_Controller
{
    public $user_id;

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata("user_type")!=1)
            redirect(site_url('user/login'));
        $this->layout->setLeft('layout/left_admin');
        $this->layout->setLayout('admin_layout');
        $this->load->model('Admin_user_model', 'crud');
    }

    public function index()
    {
        $data[] = '';
        $data["cuser_type"] = $this->crud->get_cuser_type();
        $this->layout->view('admin_user/index', $data);
    }


    function fetch_admin_user()
    {
        $fetch_data = $this->crud->make_datatables();
        $data = array();
        foreach ($fetch_data as $row) {
            $user_type_name = $this->crud->get_user_type_name($row->user_type);

            $sub_array = array();
            $sub_array[] = $row->id;
            $sub_array[] = $row->username;
            //$sub_array[] = $row->password;
            $sub_array[] = $row->name;
            $sub_array[] = $user_type_name;
            $sub_array[] = $row->email;
            $sub_array[] = $row->active==1?'ใช้งาน':'ระงับการใช้งาน';
            $sub_array[] = '<div class="btn-group" role="group" ><button class="btn btn-warning" data-btn="btn_edit" data-id="' . $row->id . '">Edit</button><button class="btn btn-danger" data-btn="btn_del" data-id="' . $row->id . '">Delete</button></div>';
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

    public function del_admin_user()
    {
        $id = $this->input->post('id');

        $rs = $this->crud->del_admin_user($id);
        if ($rs) {
            $json = '{"success": true}';
        } else {
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function  save_admin_user()
    {
        $data = $this->input->post('items');
        if ($data['action'] == 'insert') {
            $rs = $this->crud->save_admin_user($data);
        } else if ($data['action'] == 'update') {
            $rs = $this->crud->update_admin_user($data);
        }
        if ($rs) {
            $json = '{"success": true}';
        } else {
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function  get_admin_user()
    {
        $id = $this->input->post('id');
        $rs = $this->crud->get_admin_user($id);
        $rows = json_encode($rs);
        $json = '{"success": true, "rows": ' . $rows . '}';
        render_json($json);
    }
}