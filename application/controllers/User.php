<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
	public  $user_id ;
	public  $provcode ;
	public function __construct()
	{
		parent::__construct();
		$this->layout->setLayout('default_layout');
		$this->db = $this->load->database('default', true);
		$this->load->model('User_model', 'user');
		$this->load->model('Basic_model', 'basic');
		//$this->layout->setLeft('layout/left_user');
		$this->user_id = $this->session->userdata('id');
		$this->provcode='44';
	}

	public function index()
	{
		$this->login();
	}

	public function  search_user()
	{

		$txt_search = $this->input->post('txt_search');
		$rs = $this->user->get_search_user($txt_search);
		$rows = json_encode($rs);
		$json = '{"success": true, "rows": ' . $rows . '}';
		render_json($json);
	}

	public function login()
	{
		if($this->session->userdata('online'))
		{
			redirect(site_url(), 'refresh');
		}
		else
		{
			$this->load->view('user/login');
			console_log($this->session->userdata('fullname'));
		}

	}
	public function register(){
		//Register Users
	}

	public function save_edit_profile(){
		$data=$this->input->post('items');
		$action=$this->input->post('action');
		if($data['action']=='insert'){
			$rs=$this->user->save_user($data);
		}else if($data['action']=='update'){
			$rs=$this->user->update_user($data);
		}
		if($rs){
			$json = '{"success": true}';
		}else{
			$json = '{"success": false}';
		}

		render_json($json);
	}
	public function save_edit_password(){
		$data=$this->input->post('items');

			$rs=$this->user->update_password($data);

		if($rs){
			$json = '{"success": true}';
		}else{
			$json = '{"success": false}';
		}

		render_json($json);
	}
	public function user_profile ($id){

		$rs = $this->user->get_userprofile($id);
		$data['office'] = $this->basic->sl_hospcode($this->provcode);
		$data['group'] = $this->basic->sl_group();
		$rs['fullname'] = $rs['prename'] . $rs['name'];
		$rs['hospname'] = get_hospital_name($rs['hospcode']);
		$rs['group_name'] = get_group_name($rs['group']);
		$data['employee_type'] = $this->basic->sl_employee_type();
		$data['user_profiles']= $rs;
		$this->layout->view('user/user_profile',$data);
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(site_url('user/login'),'refresh');
	}
	public function do_auth()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$rs = $this->user->do_auth($username, $password);
		//echo $rs['id'];
		if ($rs['id']) {
			$rs['login'] = true;
			$rs['fullname'] = $rs['name'];
			$rs['user_type'] = $rs['user_type'];
			$this->session->set_userdata($rs);
			$json = '{"success": true, "msg":"" }';
		} else {
			$json = '{"success": false, "msg": "Username หรือ Password ไม่ถูกต้อง"}';
		}

		render_json($json);

	}

}// ของ Class