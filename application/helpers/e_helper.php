<?php

if ( ! function_exists('render_json'))
{
    function render_json($json)
    {
        ini_set('display_errors', 0);
        header('Content-Type: application/json');
        echo $json;
    }

}
if ( ! function_exists('console_log'))
{
    function console_log( $data ) {
        $output = $data;
        if ( is_array( $output ) )
            $output = implode( ',', $output);

        echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
    }

}
if ( ! function_exists('get_current_thai_date'))
{
    function get_current_thai_date()
    {
        $d = explode('/', date('d/m/Y'));
        $day = $d[0];
        $month = $d[1];
        $year = (int) $d[2] + 543;

        $current_thai_date = $day . '/' . $month . '/' . $year;

        return $current_thai_date;

    }

}

if ( ! function_exists('version'))
{
    function version()
    {
        $version=' Public Health Statistics 1.0.0';

        return $version;

    }

}
if ( ! function_exists('sys_id'))
{
    function sys_id()
    {
        $sys_id='2';

        return $sys_id;

    }

}

/**
 * Generate serial
 *
 * @param   string  $t Type of serial
 * @return  string
 */
if ( ! function_exists('year'))
{
    function year()
    {
        $year=2019;

        return $year;

    }

}
if ( ! function_exists('get_provcode'))
{
    function get_provcode()
    {
        $CI = get_instance();
        $CI->load->model('Basic_model');
        $provcode=$CI->Basic_model->get_provcode();

        return $provcode;

    }

}
if ( ! function_exists('get_provname'))
{
    function get_provname()
    {
        $CI = get_instance();
        $CI->load->model('Basic_model');
        $provname=$CI->Basic_model->get_provname();

        return $provname;

    }
}

if(!function_exists('to_thai_date'))
{
    function to_thai_date($eng_date)
    {
        if(strlen($eng_date) != 10)
        {
            return ' ';
        }
        else
        {
            $new_date = explode('-', $eng_date);

            $new_y = (int) $new_date[0] + 543;
            $new_m = $new_date[1];
            $new_d = $new_date[2];

            $thai_date = $new_d . '/' . $new_m . '/' . $new_y;

            return $thai_date;
        }
    }
}

if(!function_exists('get_thai_month'))
{
    function get_thai_month()
    {
        $strMonth = Array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน",'กรกฎาคม',"สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    return$strMonth;
    }

}

if(!function_exists('to_thai_date_full'))
{
    function to_thai_date_full($eng_date)
    {
        $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน",'กรกฎาคม',"สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        if(strlen($eng_date) != 10)
        {
            return ' ';
        }
        else
        {
            $new_date = explode('-', $eng_date);
            $new_y = (int) $new_date[0] + 543;
            $new_m = (string)$strMonthCut[(int)$new_date[1]];
            $new_d = $new_date[2];
            $thai_date = to_thai_number((int)$new_d) . ' ' . $new_m . ' ' . to_thai_number($new_y);
            return $thai_date;
        }
    }
}
if(!function_exists('to_thai_date_short'))
{
    function to_thai_date_short($eng_date)
    {
        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย","ธ.ค.");
        if(strlen($eng_date) != 10)
        {
            return ' ';
        }
        else
        {
            $new_date = explode('-', $eng_date);

            $new_y = (int) $new_date[0] + 543;

            $new_m = (string)$strMonthCut[(int)$new_date[1]];

            $new_d = $new_date[2];

            $thai_date = (int)$new_d . '  ' . $new_m . '  ' . $new_y;

            return $thai_date;
        }
    }
}
if(!function_exists('to_thai_month'))
{
    function to_thai_month($eng_date)
    {
        if(strlen($eng_date) != 7)
        {
            return ' ';
        }
        else
        {
            $new_date = explode('-', $eng_date);

            $new_y = (int) $new_date[0] + 543;
            $new_m = $new_date[1];

            $thai_date =  $new_m . '/' . $new_y;

            return $thai_date;
        }
    }
}
if(!function_exists('to_thai_date_time'))
{
    function to_thai_date_time($eng_date_time)
    {
        if(strlen($eng_date_time) == 0)
        {
            return null;
        }
        else
        {
            $new_date = explode('-', $eng_date_time);
            $new_y = (int) $new_date[0] + 543;
            $new_m = $new_date[1];
            $new_d = substr($new_date[2],0,2);
            $new_time=substr($new_date[2],3,5);
            $thai_date = $new_d . '/' . $new_m . '/' . $new_y.' '.$new_time;

            return $thai_date;
        }
    }
}
if(!function_exists('to_mysql_date'))
{
    function to_mysql_date($thai_date)
    {
        if(strlen($thai_date) != 10)
        {
            return null;
        }
        else
        {
            $new_date = explode('/', $thai_date);

            $new_y = (int)$new_date[2] - 543;
            $new_m = $new_date[1];
            $new_d = $new_date[0];

            $mysql_date = $new_y . '-' . $new_m . '-' . $new_d;

            return $mysql_date;
        }
    }
}
if(!function_exists('to_mysql_date_without'))
{
    function to_mysql_date_without($thai_date)
    {
        if(strlen($thai_date) != 10)
        {
            return null;
        }
        else
        {
            $new_date = explode('/', $thai_date);

            $new_y = (int)$new_date[2] - 543;
            $new_m = $new_date[1];
            $new_d = $new_date[0];

            $mysql_date = $new_y . $new_m . $new_d;

            return $mysql_date;
        }
    }
}
if(!function_exists('to_mysql_date_dash'))
{
    function to_mysql_date_dash($thai_date)
    {
        if(strlen($thai_date) != 10)
        {
            return null;
        }
        else
        {
            $new_date = explode('/', $thai_date);

            $new_y = (int)$new_date[2] - 543;
            $new_m = $new_date[1];
            $new_d = $new_date[0];

            $mysql_date = $new_y ."-". $new_m ."-". $new_d;

            return $mysql_date;
        }
    }
}

if(! function_exists('count_age'))
{
    function count_age($date)
    {
        $c_y = (int) date('Y');
        $o_y = explode('-', $date);
        $n_y = (int) $o_y[0];

        $age = $c_y - $n_y;

        return $age;
    }
}

if(!function_exists('to_string_date'))
{
    function to_string_date($date)
    {
        if(empty($date))
        {
            return null;
        }
        else
        {
            $d = explode('/', $date);
            // $d[0] = d, $d[1] = m, $d[2] = y
            $new_date = (int)$d[2] - 543 . $d[1] . $d[0];
            return $new_date;
        }
    }
}

if(!function_exists('get_sex'))
{
    function get_sex($id)
    {
        if(!empty($id))
        {
            if($id == '1') return 'ชาย';
            else if($id == '2') return 'หญิง';
            else return 'ไม่ระบุ';
        }
        else
        {
            return '-';
        }
    }
}
if(!function_exists('to_thai_number_with_comma'))
{
    function to_thai_number_with_comma($txt)

    {
        $l = strlen($txt);
        $re_txt='';
        if(!empty($txt))
        {
            for($i=0; $i<$l; $i++) {
                if(($i+2)%3==0){
                    $re_txt.=',';
                }
                switch (substr($txt, $i, 1)) {
                    case 1:
                        $re_txt .= '๑';
                        break;
                    case 2:
                        $re_txt .= '๒';
                        break;
                    case 3:
                        $re_txt .= '๓';
                        break;
                    case 4:
                        $re_txt .= '๔';
                        break;
                    case 5:
                        $re_txt .= '๕';
                        break;
                    case 6:
                        $re_txt .= '๖';
                        break;
                    case 7:
                        $re_txt .= '๗';
                        break;
                    case 8:
                        $re_txt .= '๘';
                        break;
                    case 9:
                        $re_txt .= '๙';
                        break;
                    case 0:
                        $re_txt .= '๐';
                        break;
                }
            }
        return $re_txt;
        }
        else
        {
            return '-';
        }
    }
}
if(!function_exists('to_thai_number'))
{
    function to_thai_number($txt)

    {
        $l = strlen($txt);
        $re_txt='';
        if(!empty($txt))
        {
            for($i=0; $i<$l; $i++) {
                switch (substr($txt, $i, 1)) {
                    case 1:
                        $re_txt .= '๑';
                        break;
                    case 2:
                        $re_txt .= '๒';
                        break;
                    case 3:
                        $re_txt .= '๓';
                        break;
                    case 4:
                        $re_txt .= '๔';
                        break;
                    case 5:
                        $re_txt .= '๕';
                        break;
                    case 6:
                        $re_txt .= '๖';
                        break;
                    case 7:
                        $re_txt .= '๗';
                        break;
                    case 8:
                        $re_txt .= '๘';
                        break;
                    case 9:
                        $re_txt .= '๙';
                        break;
                    case 0:
                        $re_txt .= '๐';
                        break;
                }
            }

            return $re_txt;
        }
        else
        {
            return '-';
        }
    }
}

if(!function_exists('to_thai_number_text'))
{
    function to_thai_number_text($txt)

    {
        $l = strlen($txt);
        //$re_txt='';
        $txt = str_replace('1','๑',$txt);
        $txt = str_replace('2','๒',$txt);
        $txt = str_replace('3','๓',$txt);
        $txt = str_replace('4','๔',$txt);
        $txt = str_replace('5','๕',$txt);
        $txt = str_replace('6','๖',$txt);
        $txt = str_replace('7','๗',$txt);
        $txt = str_replace('8','๘',$txt);
        $txt = str_replace('9','๙',$txt);
        $txt = str_replace('0','๐',$txt);
       return $txt;
    }
}
if(!function_exists('get_sex'))
{
    function get_sex($id)
    {
        if(!empty($id))
        {
            if($id == '1') return 'ชาย';
            else if($id == '2') return 'หญิง';
            else return 'ไม่ระบุ';
        }
        else
        {
            return '-';
        }
    }
}
if(!function_exists('get_address'))
{
    /**
     * @param $addr_code    Address code in ccaattmm
     *
     * @return string
     */
    function get_address($addr_code)
    {
        $ci =& get_instance();
        $ci->load->model('Basic_model', 'basic');

        $chw = substr($addr_code, 0, 2);
        $amp = substr($addr_code, 2, 2);
        $tmb = substr($addr_code, 4, 2);
        $moo = substr($addr_code, 6, 2);

        $chw_name = $ci->basic->get_province_name($chw);
        $amp_name = $ci->basic->get_ampur_name($chw, $amp);
        $tmb_name = $ci->basic->get_tmb_name($chw, $amp, $tmb);
        $moo_name = $ci->basic->get_moo_name($chw, $amp, $tmb, $moo);

        $address = 'หมู่ ' . $moo . ' '. $moo_name . ' ต.' . $tmb_name . ' อ.' . $amp_name . ' จ.' . $chw_name;

        return $address;
    }
}

if(!function_exists('get_diag_name'))
{
    function get_diag_name($code)
    {
        $ci =& get_instance();
        $rs = $ci->db
            ->where(array('diagcode' => $code))
            ->get('cdisease')
            ->row();
        return $rs ? $rs->diseasenamethai : '-';
    }

}

if(!function_exists('get_hospital_name'))
{
    function get_hospital_name($code)
    {
        $ci =& get_instance();
        $rs = $ci->db
            ->where(array('hoscode' => $code))
            ->get('chospital')
            ->row();
        return $rs ? $rs->hosname : '-';
    }
}
if(!function_exists('get_group_name'))
{
    function get_group_name($code)
    {
        $ci =& get_instance();
        $rs = $ci->db
            ->where(array('id' => $code))
            ->get('co_workgroup')
            ->row();
        return $rs ? $rs->name : '-';
    }
}

if ( ! function_exists('get_user_name'))
{
    function get_user_name($id)
    {
        $CI = get_instance();
        $CI->load->model('Basic_model');
        $user_name=$CI->Basic_model->get_user_name($id);

        return $user_name;

    }
}
if(!function_exists('get_nation_nhso_name'))
{
    function get_nation_nhso_name($code)
    {
        $ci =& get_instance();
        $rs = $ci->db
            ->where(array('code' => $code))
            ->get('ref_nhso_nation')
            ->row();
        return $rs ? $rs->name : '-';
    }
}

if(!function_exists('check_role'))
{
    function check_role($role_id,$user_id)
    {
        $ci =& get_instance();
        $rs = $ci->db
            ->where('user_id',$user_id)
            ->where('role_id',$role_id)
            ->count_all_results('user_role');
        return $rs>=1 ? true : false;
    }
}

if(!function_exists('get_group_name_by_user'))
{
    function get_group_name_by_user($user_id)
    {
        $ci =& get_instance();
        $rs = $ci->db
            ->where('a.id',$user_id)
            ->join('co_workgroup b','a.group = b.id')
            ->get('mas_users a')
            ->row();
        return $rs? $rs->name : '-';
    }
}
/**
* Get current age
*
* @param    date    yyyy-mm-dd
* @return   array
**/
if(!function_exists('get_current_age')) 
{
    function get_current_age($birth)
    {
        $birth = explode('-', $birth);
        $year = (int) $birth[0];
        $month = (int) $birth[1];
        $day = (int) $birth[2];

        $cyear = (int) date('Y');
        $cmonth = (int) date('m');
        $cday = (int) date('d');
        
        $age = array();

        if($cday < $day)
        {
            $cday = $cday + 30;
            $cmonth--;
            $age['day'] = $cday - $day;
        }
        else 
        {
            $age['day'] = $cday - $day;
        }
        
        if($cmonth < $month)
        {
            $cmonth = $cmonth + 12;
            $cyear--;
            $age['month'] = $cmonth - $month;
        }
        else 
        {
            $age['month'] = $cmonth - $month;
        }

        $age['year'] = $cyear - $year;


        return $age;
    } 
}

if(!function_exists('DateTimeDiff'))
{

    function DateTimeDiff($strDateTime1, $strDateTime2) {
        if (strtotime ( $strDateTime1 ) > strtotime ( $strDateTime2 )) {
            $second = strtotime ( $strDateTime1 ) - strtotime ( $strDateTime2 );
        } else {
            $second = strtotime ( $strDateTime2 ) - strtotime ( $strDateTime1 );
        }
        return $second;
    }
}

if(!function_exists('DateFormatDiff'))
{

    function DateFormatDiff($second) {
/*        if (strtotime ( $strDateTime1 ) > strtotime ( $strDateTime2 )) {
            $second = strtotime ( $strDateTime1 ) - strtotime ( $strDateTime2 );
            echo "เหลือเวลา : ";
        } else {
            $second = strtotime ( $strDateTime2 ) - strtotime ( $strDateTime1 );
            echo "ผ่านมาแล้ว : ";
        }*/
        $re=array();
        	/*if($second>60){
        		$re[]=($second%60)." วินาที ";}*/
        if ($second >= 60) {
            $re [] = (floor ( $second / 60 ) % 60) . " นาที ";
        }
        if ($second >= 3600) {
            $re [] = (floor ( $second / 3600 ) % 24) . " ชั่วโมง ";
        }
        if ($second >= 86400) {
            $re [] = (floor ( $second / 86400 ) % 30.5) . " วัน ";
        }
        if ($second >= 2592000) {
            $re [] = (floor ( $second / 2592000 ) % 12) . " เดือน ";
        }
        if ($second >= 31536000) {
            $re [] = floor ( $second / 31536000 ) . " ปี ";
        }
        $text='';
        for($i = sizeof ( $re ); $i > 0; $i --) {
            $text.= $re [$i - 1];
        }
        return $text;
    }
}

/* End of file epidem_helper.php */
/* Location: ./application/helpers/epidem_helper.php */