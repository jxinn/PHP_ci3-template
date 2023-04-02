<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 

/**
 * 404_override Controller.
 */
class My404 extends CI_Controller 
{
// ------------------------------------------------------------------------
   public function __construct() 
   {
      parent::__construct(); 
   } 
// ------------------------------------------------------------------------
   public function index() 
   { 
      $this->output->set_status_header('404');
        
      $data = array();
      $this->load->view('layout/error_404', $data);
   } 
// ------------------------------------------------------------------------
} 
?>