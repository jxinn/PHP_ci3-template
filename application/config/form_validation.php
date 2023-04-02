<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

/**
 * @see http://www.ciboard.co.kr/user_guide/en/libraries/form_validation.html
 * @see http://www.ciboard.co.kr/user_guide/kr/libraries/form_validation.html
 */
$config = [
// ------------------------------------------------------------------------
// Login
    'login'=>[
        [
            'field'  => 'email',
            'rules'  => 'required|valid_email',
            'errors' => [
                'required'    => 'Please enter your email',
                'valid_email' => 'Please check your email',
            ],
        ],
        [
            'field'  => 'password',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Please enter your password',
            ],
        ],
    ],
// ------------------------------------------------------------------------
];