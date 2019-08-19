<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public $user_id;
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata("user_type")!=1)
                    redirect(site_url('user/login'));
        $this->layout->setLeft('layout/left_admin');
        $this->layout->setLayout('admin_layout');
        $this->load->model('Admin_model', 'crud');
    }

    public function index()
    {
        $data[] = '';
        //$data["cequipment"] = $this->crud->get_cequipment();$data["use_status"] = $this->crud->get_use_status();
        $this->layout->view('admin/index', $data);
    }


    function fetch_admin()
    {
        $fetch_data = $this->crud->make_datatables();
        $data = array();
        foreach ($fetch_data as $row) {


            $sub_array = array();
                $sub_array[] = $row->id;$sub_array[] = $row->equipment_id;$sub_array[] = $row->total;$sub_array[] = $row->status1;$sub_array[] = $row->status2;$sub_array[] = $row->status3;$sub_array[] = $row->status4;$sub_array[] = $row->status5;$sub_array[] = $row->status6;
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

    public function del_admin(){
        $id = $this->input->post('id');

        $rs=$this->crud->del_admin($id);
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function  save_admin()
    {
            $data = $this->input->post('items');
            if($data['action']=='insert'){
                $rs=$this->crud->save_admin($data);
            }else if($data['action']=='update'){
                $rs=$this->crud->update_admin($data);
            }
            if($rs){
                $json = '{"success": true}';
            }else{
                $json = '{"success": false}';
            }

            render_json($json);
        }

    public function  get_admin()
    {
                $id = $this->input->post('id');
                $rs = $this->crud->get_admin($id);
                $rows = json_encode($rs);
                $json = '{"success": true, "rows": ' . $rows . '}';
                render_json($json);
    }

    public function get_qrcode($text='http://localhost:8888/comsurvey/index.php/admin/get_qrcode',$id='12345'){

            $code=$text;
            $img = $id.'.png';
            $qrcode = $this->_code($code,$id);
            $data['info'] = "<img src=".base_url('assets/images/'.$img)." class='rounded mx-auto d-block'>";
            $data['success'] = true;
            //$data['redirect'] = base_url();


        echo json_encode($data);


    }

    function _code($nim,$id)
    {

        $this->load->library('ciqrcode'); //pemanggilan library QR CODE

        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/images/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name=$id.'.png'; //buat name dari qr code sesuai dengan nim

        $params['data'] = $nim; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
    }
}