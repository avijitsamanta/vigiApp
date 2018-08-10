<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

error_reporting(E_ALL);
ini_set("display_errors", 1);


class Vig_User extends CI_Controller {
/**
 * ark Admin Panel for Codeigniter 
 * Author: Abhishek R. Kaushik
 * downloaded from http://devzone.co.in
 *
 */
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
         if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }
        $this->load->model('admin/common_model');
    }

    public function index() { 

        $arr['users'] = $this->common_model->getUserDetails(TABLE_PREFIX.'user');    
            
        $this->load->view('admin/vwUser',$arr);
    }

    public function add_user() {
        $this->load->view('admin/vwAddUser');
    }

     public function edit_user($id='') {
         
        $arr['user_id']=$id;

        $where=array('user_id'=>$id);
        
        $arr['users'] = $this->common_model->getUserDetails(TABLE_PREFIX.'user',$where);  
            
        $result = $this->load->view('admin/vwEditUser',$arr);
    }
   
    
       public function update_user($mode='',$userid='') {

            $this->form_validation->set_error_delimiters('<span style="color:red">', '</span>');

            $this->form_validation->set_rules('username', 'Username', 'trim|required');

            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');

            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');

          //  $this->form_validation->set_rules('phoneno', 'Phoneno', 'trim|required');

            if($this->form_validation->run() == FALSE)
            {
                $this->edit_user();
            }
            else
            {
                $data['username'] = $this->input->post('username');

                $data['first_name'] = $this->input->post('first_name');

                $data['last_name'] = $this->input->post('last_name');

                $data['mobile_no'] = $this->input->post('phoneno');
                
                $data['is_premium'] = $this->input->post('is_premium');

                $password = $this->input->post('password');

                if(!empty($password))
                {
                    $data['password'] = md5($password);
                    $data['fp'] = $password;
                }

                $data['date_updated'] = date("Y-m-d H:i:s"); 

                if(!empty($_FILES['profileimage']['name'])){
               
                $folder = "upload/profile_pics/";

                $path_parts = pathinfo($_FILES["profileimage"]["name"]);

                $upload_image = $path_parts['filename']."_".time().".".$path_parts['extension'];


                if (!file_exists($folder)) {

                    mkdir($folder,0777);

                }
                $files = glob($folder.'/*');

                $target_dir   = $folder;

                $target_file  = $target_dir ."/". basename($upload_image);

                if (file_exists($target_file)) {

                    @unlink($target_file);

                }
                if(move_uploaded_file($_FILES["profileimage"]["tmp_name"], $target_file))
                {
                    $where = array('vigilant_user.user_id'=>$userid);

                    $data2['userdetails'] = $this->common_model->getRow('vigilant_user',$where);

                    if(!empty($data2['userdetails']->profileimage))
                    {
                        @unlink(FILE_UPLOAD_PATH.'profile_pics/'.$data2['userdetails']->profileimage);
                    }
                    
                    $data['profileimage'] = $upload_image;
                    $data['upload_path'] = $folder;
                }
             }

               //print_r($data);exit;
               
                $this->common_model->userUpdate(TABLE_PREFIX.'user',$userid,$data,$mode); 

                redirect('admin/vig_user');

            }
         
    }
    
    
    public function block_user() {
        // Code goes here
    }
    
    public function delete_user() {
       $user_id=$this->input->post('userid');
        
        $mode=$this->input->post('mode');
        //print_r($_POST);exit;
        
        if($mode=='single'){
        
            $where=array('user_id'=>$user_id);

        }
        else{
        
            $where=explode(",",$user_id);
                
        }


        if($get_users=$this->common_model->getData(TABLE_PREFIX.'user',$where))
        {
            if(!empty($get_users['0']->profileimage))
            {
                @unlink(FILE_UPLOAD_PATH.'profile_pics/'.$get_users['0']->profileimage);
            }

            $this->common_model->DataDelete(TABLE_PREFIX.'user',$where,$mode,"user_id"); 
        }

        if($this->common_model->getData(TABLE_PREFIX.'comment',$where))
        {
            $this->common_model->DataDelete(TABLE_PREFIX.'comment',$where,$mode,"user_id"); 
        }

        
        if($cr_pics = $this->common_model->getData(TABLE_PREFIX.'pics',$where))
        {
            foreach($cr_pics as $cr_pic)
            {
                if(!empty($cr_pic->crime_pics))
                {
                    @unlink(FILE_UPLOAD_PATH.'crime_pics/'.$cr_pic->crime_pics);
                }
            }

            $this->common_model->DataDelete(TABLE_PREFIX.'pics',$where,$mode,"user_id"); 
        }

        if($this->common_model->getData(TABLE_PREFIX.'posts',$where))
        {
            $this->common_model->DataDelete(TABLE_PREFIX.'posts',$where,$mode,"user_id"); 
        }

        if($this->common_model->getData(TABLE_PREFIX.'reply',$where))
        {
            $this->common_model->DataDelete(TABLE_PREFIX.'reply',$where,$mode,"user_id"); 
        }

        if($get_report=$this->common_model->getData(TABLE_PREFIX.'report',$where))
        {
            if(!empty($get_report['0']->crime_video))
            {
                @unlink(FILE_UPLOAD_PATH.'crime_video/'.$get_report['0']->crime_video);
            }
            $this->common_model->DataDelete(TABLE_PREFIX.'report',$where,$mode,"user_id"); 
        }

        if($this->common_model->getData(TABLE_PREFIX.'user_hlocation',$where))
        {
            $this->common_model->DataDelete(TABLE_PREFIX.'user_hlocation',$where,$mode,"user_id"); 
        }

        if($this->common_model->getData(TABLE_PREFIX.'user_location',$where))
        {
            $this->common_model->DataDelete(TABLE_PREFIX.'user_location',$where,$mode,"user_id"); 
        }

        $arr['users'] = $this->common_model->getUserDetails(TABLE_PREFIX.'user'); 
        
        $this->load->view('admin/ajax/vwUser',$arr);
    }
    
    
    
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
