<?php
/**
 * Created by PhpStorm.
 * User: Spider
 * Date: 7/18/2018
 * Time: 3:15 PM
 */if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'third_party/tcpdf/tcpdf.php';
require_once APPPATH.'third_party/fpdi/fpdi.php';

//require_once APPPATH.'tcpdf/tcpdf.php';
//require_once APPPATH.'fpdi2/src/autoload.php';
class Pdf extends FPDI
{
    function __construct()
    {
        parent::__construct();
    }
}