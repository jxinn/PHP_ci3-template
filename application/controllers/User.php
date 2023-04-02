<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User controller.
 */
class User extends CI_Controller
{
// ------------------------------------------------------------------------
    /**
     * Response message. 
     * 
     * @var array
     */
    protected $add_message = [
        'TP_1100' => 'Please check your ID or password', // Login failed (password_verify).
    ];
// ------------------------------------------------------------------------
    public function __construct()
    {
        parent::__construct();

        $this->load->model('user_model');
        $this->load->library('form_validation');
    }
// ------------------------------------------------------------------------
    /**
     * Login
     * 
     * @param  string $using
     * @return void
     */
    public function login(string $using = ''): void
    {
        switch ($using) { 
            case 'proc': // Login Process.
                if (!empty($validation = $this->form_validation->valiCheck('login'))) {
                    echo json_encode($validation);
                    exit;
                }

                $email    = $this->input->post('email', true);    // User Email.
                $password = $this->input->post('password', true); // User Password.
                $code     = 'TP_0001';

                $user_data = $this->user_model->selectUserById($email);

                if (!password_verify($sign_pw, $user_data['password'])) {
                    $code = 'TP_1100';
                    echo getResData($code, $this->return_message[$code]);
                    exit;
                }

                $this->session->set_userdata([
                    'user_id' => $user_data['id'],
                    'email'   => $user_data['email'],
                ]);
                
                echo getResData($code, $this->return_message[$code], [
                    'url'=>'/report/summary' // Redirect url.
                ]); 
                break;

            default: // Login Page.
                $this->load->view('/layout/header');
                $this->load->view('/user/login');
                $this->load->view('/layout/footer');
        }
    }
// ------------------------------------------------------------------------
}