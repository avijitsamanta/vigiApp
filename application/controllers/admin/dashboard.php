<?php
/**
 * ark Admin Panel for Codeigniter 
 * Author: Abhishek R. Kaushik
 * downloaded from http://devzone.co.in
 *
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

error_reporting(E_ALL);
    ini_set("display_errors", 1);

class Dashboard extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();

        $this->load->library('form_validation');

	$this->load->model('admin/common_model');

         if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }
    }

    	public function index() 
	{
        	$data['pagetitle']='dashboard';
        	$this->load->view('admin/vwDashboard',$data);
    	}

    	public function changePassword()
	{
		$this->load->view('admin/passChange');
	}

	public function update_password()
	{
		$old_password = $this->input->post('old_password');

		$new_password = $this->input->post('new_password');
		
		$updatePass = $this->common_model->updateData('vigilant_admin',array('admin_id'=>'1'),array('admin_password'=>$new_password));
        if($updatePass)
        {
            //echo "hi";exit;

		  $data['updateStatus'] = 1;
          $data['success'] = 'Password  changed succesfully';
          $this->load->view('admin/passChange',$data);
        }

      else{
             $data['error'] = '<strong>Access Denied</strong> Password  not changed';
             $this->load->view('admin/passChange',$data);
        }
	
		

	}



	public function checkPassword()
	{		

		$old_password = $this->input->post('old_password');
		$result = $this->common_model->checkAdminPassword($old_password,'1');

		echo $result;

		exit();
	}
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
