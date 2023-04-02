<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

/**
 * Extends CI_Form_validation 
 */
class MY_Form_validation extends CI_Form_validation 
{
    public function __construct($rules = array()) 
    {
        parent::__construct($rules);
    }

    /**
     * 유효성 검사 응답
     * 
     * @param string $group
     * 
     * @return array | null
     */
    public function valiCheck($group)
    {
        if ($this->run($group) == false) {
            $error_data = $this->error_array();
            $arr_key = array_key_first($error_data);
    
            return get_instance()->getResData('TP_1000', ['name' => $arr_key], $error_data[$arr_key]);
        }

        return null;
    }

    /**
     * 아이디 정규식
     * 
     * 6~20자
     * 첫글자 영문 
     * 소문자 
     * 숫자
     * 언더바(_)  
     * 대시(-)
     * 
     * @param string $str 검사할 문자
     * 
     * @return array
     */
    public function idCheck($str)
    {
        return (preg_match("/^[a-z]{1}[a-z0-9\-_]{5,20}$/", $str)) ? true : false;
    }

    /**
     * 비밀번호 정규식
     * 
     * 8~16자
     * 1개 이상의 대문자 
     * 1개 이상의 소문자
     * 1개 이상의 숫자 
     * 1개 이상의 특수문자
     * 
     * @param string $str 검사할 문자
     * 
     * @return array
     */
    public function passwordCheck($str)
    {
        return (preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^a-zA-Z0-9\s]).{8,16}$/" , $str)) ? true : false;
    }
}