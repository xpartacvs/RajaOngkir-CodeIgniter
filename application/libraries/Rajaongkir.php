<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rajaongkir {
    const COURIER_ALL = 'all';
    const COURIER_JNE = 'jne';
    const COURIER_POS = 'pos';
    const COURIER_TIKI = 'tiki';
    const COURIER_PCP = 'pcp';
    const COURIER_ESL = 'esl';
    const COURIER_RPX = 'rpx';
    
    const RETURN_DEFAULT = 0;
    const RETURN_JSON = 1;
    const RETURN_ARRAY = 2;
    
    private $key_api;
    
    private $host;
    private $timeout;
    
    private $uri_province;
    private $uri_city;
    private $uri_cost;
    
    public function __construct() {
        $this->_check_compatibility();
        
        $CI =& get_instance();
        $CI->load->config('rajaongkir');
        
        $this->key_api  = ($CI->config->item('rajaongkir_key_api')!==FALSE) ? $CI->config->item('rajaongkir_key_api') : '';
        
        $this->host  = ($CI->config->item('rajaongkir_host')!==FALSE) ? $CI->config->item('rajaongkir_host') : 'http://rajaongkir.com/api/';
        $this->timeout = ($CI->config->item('rajaongkir_timeout')!==FALSE) ? $CI->config->item('rajaongkir_timeout') : 120;
        
        $this->uri_province = ($CI->config->item('rajaongkir_uri_provice')!==FALSE) ? $CI->config->item('rajaongkir_uri_provice') : 'province';
        $this->uri_city = ($CI->config->item('rajaongkir_uri_city')!==FALSE) ? $CI->config->item('rajaongkir_uri_city') : 'city';
        $this->uri_cost = ($CI->config->item('rajaongkir_uri_cost')!==FALSE) ? $CI->config->item('rajaongkir_uri_cost') : 'cost';
    }
    
    private function _check_compatibility() {
        if (!extension_loaded('curl') or !extension_loaded('json')) throw new Exception('There are missing dependant extensions - please ensure both cURL and JSON modules are installed');
    }
    
    private function _get_return($r,$return_type=Rajaongkir::RETURN_DEFAULT) {
        if ($r!==FALSE) {
            switch($return_type) {
                case Rajaongkir::RETURN_JSON: $ret = json_decode($r); break;
                case Rajaongkir::RETURN_ARRAY: $ret = json_decode($r, TRUE); break;
                default : $ret = $r;
            }
        } else $ret = FALSE;
        return $ret;
    }
    
    private function _curl_execute($url,$postdata=NULL) {
        $c = curl_init();
        curl_setopt($c,CURLOPT_URL,$url);
        curl_setopt($c,CURLOPT_HEADER, 0);
        curl_setopt($c,CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($c,CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($c,CURLOPT_TIMEOUT,$this->timeout);
        if ($postdata!==NULL) {
            $fields = (is_array($postdata)==TRUE) ? http_build_query($postdata) : strval($postdata);
            curl_setopt($c, CURLOPT_POST, count($fields));
            curl_setopt($c, CURLOPT_POSTFIELDS, $fields);
        }
        $r = curl_exec($c);
        curl_close($c);
        unset($c);
        return $r;
    }
    
    public function get_province($id_province=NULL,$return_type=Rajaongkir::RETURN_DEFAULT) {
        $data = array('key' => $this->key_api);
        if ($id_province!==NULL) $data['id'] = intval($id_province);
        $url = $this->host.$this->uri_province.'?'.http_build_query($data);
        $r = $this->_get_return($this->_curl_execute($url),$return_type);
        unset($url,$data);
        return $r;
    }
    
    public function get_city($id_province=NULL, $id_city=NULL, $return_type=Rajaongkir::RETURN_DEFAULT) {
        $data = array('key'=>$this->key_api);
        if ($id_province!==NULL) $data['province'] = intval($id_province);
        if ($id_city!==NULL) $data['id'] = intval($id_city);
        $url = $this->host.$this->uri_city.'?'.http_build_query($data);
        $r = $this->_get_return($this->_curl_execute($url),$return_type);
        unset($url,$data);
        return $r;
    }
    
    public function get_cost($id_city_origin, $id_city_dest, $weight, $courier=Rajaongkir::COURIER_ALL, $return_type=Rajaongkir::RETURN_DEFAULT) {
        $data = array(
            'key' => $this->key_api,
            'origin' => intval($id_city_origin),
            'destination' => intval($id_city_dest),
            'weight' => intval($weight),
            'courier' => $courier
        );
        $url = $this->host.$this->uri_cost;
        $r = $this->_get_return($this->_curl_execute($url,$data),$return_type);
        unset($url,$data);
        return $r;
    }
}
