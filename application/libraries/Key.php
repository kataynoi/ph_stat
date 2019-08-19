<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Key
{

    private $secure_key="df4gdf5ERGcv";
    public   function create_api_key(){
        return base64_encode(base64_encode($this->encrypt(time().'X'.$_SERVER['REMOTE_ADDR'])));
    }

    public  function check_api_key($key,$timeout=5){
        if(empty($key)){ exit('Invalid Key'); }

        $keys=explode('X',$this->decrypt(base64_decode(base64_decode($key))));

        if (isset($key) && isset($keys[0]) && $keys[0] >= (time()-$timeout) &&
            isset($keys[1]) && $keys[1] == $_SERVER['REMOTE_ADDR']){
            return true;
        }else{
            return false;
        }
    }

    protected function encrypt($value){
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        return mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->secure_key, $value, MCRYPT_MODE_ECB, $iv);
    }

    protected function decrypt($value){
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->secure_key, $value, MCRYPT_MODE_ECB, $iv));
    }
    public  function get_packet_id(){
        $ran=$this->rand_String(6,6);
        return $ran;
    }
    protected  function rand_String($num, $op = 1)
    { // random string
        switch ($op) {
            case 1 :
                $alp_str = "0123456789";
                break;
            case 2 :
                $alp_str = "abcdefghijklmnopqrstuvwxyz";
                break;
            case 3 :
                $alp_str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                break;
            case 4 :
                $alp_str = "abcdefghijklmnopqrstuvwxyz0123456789";
                break;
            case 5 :
                $alp_str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                break;
            case 6 :
                $alp_str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                break;
        }
        return substr(str_shuffle($alp_str), 0, $num);
    }
    /*public function test_key(){
        $key=$this->create_api_key();
        echo $key;
        $de_code=$this->check_api_key('c1NvMnQrVGo1dmhCZGJUUCtvQmF2VDFkdS9BUVhSd1lBa0phUkhQVHhUZz0=',30);
        if($de_code){
            echo "<br> Key OK";
        }else{
            echo "<br>Key Not OK";
        }
    }*/
}

// END Layout Class

/* End of file Layout.php */
/* Location: ./application/libraries/Layout.php */