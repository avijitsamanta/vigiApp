<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

error_reporting(E_ALL);
ini_set("display_errors", 1);

class report extends CI_Controller {
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

        $arr['reports'] = $this->common_model->get_report(TABLE_PREFIX.'report');    
            
        $this->load->view('admin/vwReport',$arr);
    }

    public function add_user() {
        $this->load->view('admin/vwAddUser');
    }

     public function edit_report($id='') {
         
        $arr['report_id']=$id;

        $where=array('report_id'=>$id);

        $arr['reports'] = $this->common_model->get_report(TABLE_PREFIX.'report',$where); 

       // print_r( $arr['reports']);exit;   
            
        $result = $this->load->view('admin/vwEditReport',$arr);
    }
   
    
       /*public function update_user($mode='',$userid='') {

            $this->form_validation->set_error_delimiters('<span style="color:red">', '</span>');

            $this->form_validation->set_rules('username', 'Username', 'trim|required');

            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');

            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');

            $this->form_validation->set_rules('phoneno', 'Phoneno', 'trim|required');

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

                    unlink($target_file);

                }
                if(move_uploaded_file($_FILES["profileimage"]["tmp_name"], $target_file))
                {
                    $where = array('vigilant_user.user_id'=>$userid);

                    $data2['userdetails'] = $this->common_model->getRow('vigilant_user',$where);

                    if(!empty($data2['userdetails']->profileimage))
                    {
                        unlink('/var/www/html/vigilant/upload/profile_pics/'.$data2['userdetails']->profileimage);
                    }
                    
                    $data['profileimage'] = $upload_image;
                    $data['upload_path'] = $folder;
                }
             }

               //print_r($data);exit;
               
                $this->common_model->userUpdate(TABLE_PREFIX.'user',$userid,$data,$mode); 

                redirect('admin/vig_user');

            }
         
    }*/
    
    
    public function block_user() {
        // Code goes here
    }
    
    public function delete_report() {
       $report_id=$this->input->post('reportid');
        
        $mode=$this->input->post('mode');
        //print_r($_POST);exit;
        
        if($mode=='single'){
        
            $where=array('report_id'=>$report_id);

        }
        else{
        
            $where=explode(",",$report_id);
                
        }


        

        
        if($cr_pics = $this->common_model->getData(TABLE_PREFIX.'pics',$where))
        {
            foreach($cr_pics as $cr_pic)
            {
                if(!empty($cr_pic->crime_pics))
                {
                    unlink('/var/www/html/vigilant/upload/crime_pics/'.$cr_pic->crime_pics);
                }
            }

            $this->common_model->DataDelete(TABLE_PREFIX.'pics',$where,$mode,"report_id"); 
        }

       

        if($get_report=$this->common_model->getData(TABLE_PREFIX.'report',$where))
        {
            if(!empty($get_report['0']->crime_video))
            {
                unlink('/var/www/html/vigilant/upload/crime_video/'.$get_report['0']->crime_video);
            }
            $this->common_model->DataDelete(TABLE_PREFIX.'report',$where,$mode,"report_id"); 
        }

      
        $arr['reports'] = $this->common_model->get_report(TABLE_PREFIX.'report');
        
        $this->load->view('admin/ajax/vwReport',$arr);
    }
    
    
    
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
