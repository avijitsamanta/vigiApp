<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

error_reporting(E_ALL);
ini_set("display_errors", 1);

class post extends CI_Controller {
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

    	$where = ''; 

        $arr['posts'] = $this->common_model->get_post(TABLE_PREFIX.'posts',$where); 

        //print_r($arr['posts']);exit;   
            
        $this->load->view('admin/vwPost',$arr);
    }

    
    
  
    
    public function block_user() {
        // Code goes here
    }

    public function get_reported_post() {
       
        $where = ' Where reported_post.is_reported =1 ';

        $arr['posts'] = $this->common_model->get_post(TABLE_PREFIX.'posts',$where);
        
        $this->load->view('admin/vwPost',$arr);
    }
    
    public function delete_post() {



        $post_id=$this->input->post('post_id');
        
        $mode=$this->input->post('mode');
        //print_r($_POST);exit;
        
        if($mode=='single'){
        
            $where=array('post_id'=>$post_id);

        }
        else{
        
            $where=explode(",",$post_id);
                
        }

        $this->common_model->DataDelete(TABLE_PREFIX.'posts',$where,$mode,"post_id"); 

        $where = '';

        $arr['posts'] = $this->common_model->get_post(TABLE_PREFIX.'posts',$where);
        
        $this->load->view('admin/ajax/vwPost',$arr);
    }
    
    public function detailsPost() {
        //$arr['page'] = 'cms';
        
        $id=$this->input->post('id');

        //$arr['id']=$id;

       // $where=array('id'=>$id);
        $where=array('post_id'=>$id);

        
        $arr['reportedPosts'] = $this->common_model->get_reported_post(TABLE_PREFIX.'reported_post',$where);
        
        $this->load->view('admin/ajax/vwReportedPost',$arr);
    }
    
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
