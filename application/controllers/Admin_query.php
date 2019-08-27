<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_query extends CI_Controller
{
    public $user_id;

    public function __construct()
    {
        parent::__construct();


        if ($this->session->userdata("user_type") != 1)
            redirect(site_url('user/login'));
        $this->layout->setLeft('layout/left_admin');
        $this->layout->setLayout('admin_layout');
        $this->load->model('Create_report_model', 'crud');
    }

    public function index()
    {
        $data[] = '';
        $this->layout->view('admin_query/index', $data);
    }

    public function create_report()
    {
        $data = $this->input->post('items');
        $this->create_controller($data);
        $this->create_model($data);
        $this->create_view($data);
        $this->create_js($data);
        $msg = 'Create Success ';
        $json = '{"success": true, "msg":"' . $msg . '","ctrl":"' . $data['ctrl'] . '"}';
        render_json($json);
    }

    /*#### Create Controllers Models View Js*/
    function create_controller($data)
    {
        $txt = read_file('./report/Controller.txt');
        $txt = str_replace('AAA', ucfirst($data['ctrl']), $txt);
        $txt = str_replace('aaa', $data['ctrl'], $txt);
        $txt = str_replace('ctrl', $data['ctrl'], $txt);
        $txt_select = explode(',', $data['select']);
        $txt_select_html = '';
        $txt_get_name = '';
        $txt_sl = '';

            $text = explode(",", $data['select']);
     foreach($text as $c){
         $txt_select_html .= '$sub_array[] = $row->' . $c . ';';
     }


        //$txt = str_replace('txt_get_name', $txt_get_name, $txt);
        $txt = str_replace('txt_select_html', $txt_select_html, $txt);
        $txt = str_replace('get_sl', $txt_sl, $txt);

        if (!write_file('application/controllers/' . ucfirst($data['ctrl']) . '.php', $txt)) {
            return 'Create Controller Fail';
        } else {
            return 'Create Controller Success';
        }
    }

    function create_model($data)
    {
        $txt = read_file('./report/Model.txt');
        $txt = str_replace('AAA', ucfirst($data['ctrl']), $txt);
        $txt = str_replace('aaa', $data['ctrl'], $txt);
        $txt = str_replace('sql_text', $data['sql'], $txt);
        $txt = str_replace('ctrl', $data['ctrl'], $txt);
        //echo $txt;
        $txt_search = explode(',', $data['search_txt']);
        $txt_select = explode(',', $data['select']);
        $txt_search_html = '';
        $txt_select_html = '';
        $items_insert = '';
        $items_update = '';
        $txt_sl_model = '';

        foreach ($txt_select as $s) {
            $txt_select_html .= "'" . $s . "',";
        }
        $txt_select_html = 'Array(' . $txt_select_html . ')';

        foreach ($txt_search as $k => $v) {
            if ($k == 0) {
                $txt_search_html .= '$this->db->like("' . $v . '", $_POST["search"]["value"]);';
            } else {
                $txt_search_html .= '$this->db->or_like("' . $v . '", $_POST["search"]["value"]);';
            }


        }
        $txt = str_replace('txt_search_html', $txt_search_html, $txt);
        $txt = str_replace('txt_select_html', $txt_select_html, $txt);


        foreach ($data['formcreate'] as $c) {
            $text = explode(",", $c);
            if ($text[3] != '') {
                $txt_sl_model .= 'public function get_' . $text[3] . '(){
                        $rs = $this->db
                        ->get("' . $text[3] . '")
                        ->result();
                        return $rs;}';

                $txt_sl_model .='    public function get_' . $text[0] . '_name($id)
                {
                    $rs = $this->db
                        ->where("id",$id)
                        ->get("' . $text[3] . '")
                        ->row();
                    return $rs?$rs->name:"";
                }';
            }

            $items_insert .= '->set("' . $text[0] . '", $data["' . $text[0] . '"])';
        }
        $items_update = $items_insert . '->where("id",$data["id"])';
        $txt = str_replace('get_sl_model', $txt_sl_model, $txt);
        $txt = str_replace('items_insert', $items_insert, $txt);
        $txt = str_replace('items_update', $items_update, $txt);

        if (!write_file('application/models/' . ucfirst($data['ctrl']) . '_model.php', $txt)) {
            echo 'Create Model Fail';
        } else {
            return 'Create Model Success';
        }
    }

    function create_view($data)
    {

        if (!is_dir('./application/views/' . $data['ctrl'])) {
            mkdir('./application/views/' . $data['ctrl'], 0777, TRUE);
        }
        $txt_column = explode(',', $data['column']);
        $txt_column_html = '';
        $txt_form_html = '<input type="hidden" id="action" value="insert">
        <input type="hidden" class="form-control" id="row_id" placeholder="ROWID" value="">';
        foreach ($txt_column as $c) {
            $txt_column_html .= "<th>$c</th>";

        }

        foreach ($data['formcreate'] as $c) {
            $text = explode(",", $c);

            switch ($text[2]) {
                case 'text':
                    $txt_form_html .= '<div class="form-group">
                    <label for="' . $text[0] . '">' . $text[1] . '</label>
                    <input type="text" class="form-control" id="' . $text[0] . '" placeholder="' . $text[1] . '" value=""></div>';
                    break;
                case 'select':

                    $txt_form_html .= '<div class="form-group">
                    <label for="' . $text[0] . '">' . $text[1] . '</label>
                    <select  class="form-control" id="' . $text[0] . '" placeholder="' . $text[1] . '" value="">
                        <option>-------</option>
                        <?php
                        foreach ($' . $text[3] . ' as $r) {
                                echo "<option value=$r->id > $r->name </option>";} ?>
                    </select></div>';
                    break;
                default:
                    $txt_form_html .= '<div class="form-group">
                    <label for="' . $text[0] . '">' . $text[1] . '</label>
                    <input type="text" class="form-control" id="' . $text[0] . '" placeholder="' . $text[1] . '" value=""></div>';
            }

        }


        $txt = read_file('./report/View.txt');
        $txt = str_replace('AAA', ucfirst($data['ctrl']), $txt);
        $txt = str_replace('aaa', $data['ctrl'], $txt);
        $txt = str_replace('th_column', $txt_column_html, $txt);
        $txt = str_replace('modal_body', $txt_form_html, $txt);
        $txt = str_replace('view_name', $data['view_name'], $txt);
        $txt = str_replace('ModalHeading', 'เพิ่ม' . $data['view_name'], $txt);
        //$txt = str_replace('table_name',$data['table'],$txt);
        //echo $txt;
        if (!write_file('application/views/' . $data['ctrl'] . '/index.php', $txt)) {
            return 'Crate View Fail';
        } else {
            return 'Crate View Success';
        }
    }

    function create_js($data)
    {
        $items_list = '';
        $validate_html = '';
        $row_items ='';
        $row_set ='';
        $set_data = '';
        $txt = read_file('./report/Js.txt');
        $txt = str_replace('AAA', ucfirst($data['ctrl']), $txt);
        $txt = str_replace('aaa', $data['ctrl'], $txt);
        $txt = str_replace('ctrl', $data['ctrl'], $txt);

        $n = 0;
        foreach ($data['formcreate'] as $c) {
            $text = explode(",", $c);
            $items_list .= 'items.' . $text[0] . '=$("#' . $text[0] . '").val();';
            $row_items .='row_id.find("td:eq('.$n.')").html(items.'.$text[0].');';
            $row_set .="'<td>' +items.".$text[0]."+'</td>' +";

            //'<td>'+items.name+ '</td>' +
            if ($n === 0) {
                $validate_html .= 'if (!items.' . $text[0] . ') { swal("กรุณาระบุ' . $text[1] . '");$("#' . $text[0] . '").focus();}';
            } else {
                $validate_html .= 'else if (!items.' . $text[0] . ') { swal("กรุณาระบุ' . $text[1] . '");$("#' . $text[0] . '").focus();}';
            }

            /* Set Data*/
            $set_data .= '$("#' . $text[0] . '").val(data.rows["' . $text[0] . '"]);';

            $n++;
        }
        $txt = str_replace('row_set', $row_set, $txt);
        $txt = str_replace('row_items', $row_items, $txt);
        $txt = str_replace('items_list', $items_list, $txt);
        $txt = str_replace('set_data', $set_data, $txt);
        $txt = str_replace('validate_html', $validate_html, $txt);
        if (!write_file('assets/apps/js/' . $data['ctrl'] . '.js', $txt)) {
            return 'Crate Js Fail';
        } else {
            return 'Crate Js Success';
        }
    }

    /*## End eate Controllers Models View Js##*/
    function test_query()
    {
        $sql = $this->input->post('sql');
        $rs = $this->crud->test_query($sql);
        $rows = json_encode($rs);
        if ($rs) {
            $json = '{"success": true, "rows": ' . $rows . '}';
        } else {
            $json = '{"success": false}';
        }

        render_json($json);
    }

}