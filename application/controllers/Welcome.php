<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata("login"))
            redirect(site_url('user/login'));
        $this->layout->setLayout('default_layout');
        $this->db = $this->load->database('default', true);
    }

    public function index()
    {
        /*$data['all_pc'] = $this->db->from('com_survey')->where('computertype',2)->count_all_results();
        $data['all_nb'] = $this->db->from('com_survey')->where('computertype',3)->count_all_results();;
        $data['all_employee'] = $this->db->from('employee')->where('active',1)->count_all_results();
        $data['all_printer'] = $this->db->from('printer_survey')->count_all_results();*/
        $data[]='';
        $this->layout->view('dashboard/index_view', $data);
    }
}
