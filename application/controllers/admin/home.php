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

class Home extends CI_Controller 
{

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
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('admin/login_model');
    }

    public function index() 
    { 
         if ($this->session->userdata('is_admin_login')) 
         {
            redirect('admin/dashboard');
         } 
         else 
         {
            $this->load->view('admin/login');
         }
    }

    public function do_login() 
    {

        if ($this->session->userdata('is_admin_login')) 
        {
            redirect('admin/home/dashboard');
        } 
        else 
        {
            $user = $_POST['username'];
            //$password = md5($_POST['password']);
			$password = $_POST['password'];

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) 
            {
                $this->load->view('admin/login');
            } 
            else 
            {
            /*      $salt = '5&JDDlwz%Rwh!t2Yg-Igae@QxPzFTSId';
                $enc_pass  = md5($salt.$password);
                $sql = "SELECT * FROM tbl_admin_users WHERE username = ? AND password = ?";
                
				$val = $this->db->query($sql,array($user ,$enc_pass ));*/
				
				$where=array(   'admin_username' => $user,
								'admin_password' => $password);
				
				$val=$this->login_model->fetch_userinfo($where,TABLE_PREFIX.'admin');

                if ($val) 
                {
                  
                    redirect('admin/dashboard');
                } 
                else 
                {
                    $err['error'] = '<strong>Access Denied</strong> Invalid Username/Password';
                    $this->load->view('admin/login', $err);
                }
            }
        }
    }

        
    public function logout() 
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('user_type');
        $this->session->unset_userdata('is_admin_login');   
        $this->session->sess_destroy();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('admin/home', 'refresh');
    }

    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */