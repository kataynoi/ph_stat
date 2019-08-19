<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Layout
{

    var $obj;
    var $layout;
    var $left='layout/left';
    var $header ='layout/header';
    var $header_cer ='layout/header_cer';
    var $leftAdmin ='layout/left_admin';

    function Layout($layout = "default_layout")
    {
        $this->obj =& get_instance();
        $this->layout = $layout;
    }


    function setLayout($layout)
    {
        $this->layout = $layout;
    }

    function  setLeft($txt='layout/left'){
    $this->left=$txt;
}
    function  setLeftAdmin($txt='layout/left_admin'){
    $this->leftAdmin=$txt;
}
    function  setHeader($txt='layout/header'){
        $this->left=$txt;
    }
    function  setHeader_cer($txt='layout/header_cer'){
        $this->left=$txt;
    }
    function view($view, $data=null, $return=false)
    {
        $loadedData = array();
        $loadedData['content_for_layout'] = $this->obj->load->view($view,$data,true);
        $loadedData['left_for_layout'] = $this->obj->load->view($this->left,$data,true);
        $loadedData['header_for_layout'] = $this->obj->load->view($this->header,$data,true);
        $loadedData['footer_for_layout'] = $this->obj->load->view('layout/footer',$data,true);

        if($return)
        {
            $output = $this->obj->load->view($this->layout, $loadedData, true);
            return $output;
        }
        else
        {
            $this->obj->load->view($this->layout, $loadedData, false);
        }
    }
}
