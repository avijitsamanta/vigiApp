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

        //print_r($arr['reports']);exit;   
            
        $this->load->view('admin/vwReport',$arr);
    }

    public function add_report() {

        $where = array();

        $arr['crime_types'] = $this->common_model->getCrieType(TABLE_PREFIX.'crime_type',$where);  

        //print_r( $arr['crime_types'] );exit;

        $this->load->view('admin/vwAddReport',$arr);
    }

     public function edit_report($id='') {
         
        $arr['report_id']=$id;

        $where = array();

        $arr['crime_types'] = $this->common_model->getCrieType(TABLE_PREFIX.'crime_type',$where);  

        $where=array('report_id'=>$id);

        $arr['reports'] = $this->common_model->get_report(TABLE_PREFIX.'report',$where); 

       // print_r( $arr['reports']);exit;   
            
        $result = $this->load->view('admin/vwEditReport',$arr);
    }
   
    
      public function update_report($mode='',$reportid='') {

            $this->form_validation->set_error_delimiters('<span style="color:red">', '</span>');

            $this->form_validation->set_rules('crime_name', 'crime_name', 'trim|required');

           $this->form_validation->set_rules('latitude', 'Latitude', 'trim|required');

            $this->form_validation->set_rules('longitude', 'Longitude', 'trim|required');

           // $this->form_validation->set_rules('phoneno', 'Phoneno', 'trim|required');

            if($this->form_validation->run() == FALSE)
            {
               // echo $mode;exit;

             
                    $this->add_report();
             
                
            }
            else
            {

               // print_r($_FILES);exit;
               if($mode == 'add')
                {
                    $data['user_id'] = 0;

                    $data['user_type']  = 'admin';
                }
                
                if($mode == 'add')
                {
                 $data['date_added'] = date('Y-m-d H:i:s');
                }
                else
                {
                    $data['date_updated'] = date('Y-m-d H:i:s');
                }

                if(!empty($this->input->post('crime_name')))
                {

                  $data['crime_type_id'] = $this->input->post('crime_name');
                }

                if(!empty($this->input->post('crime_date')))
                {

                    $crime_date = date('Y-m-d',strtotime($this->input->post('crime_date')));

                    $data['crime_date'] = $crime_date;
                }

                if(!empty($this->input->post('crime_time')))
                {

                   $crime_time = date('H:i:s',strtotime($this->input->post('crime_time'))); 

                   $data['crime_time'] = $crime_time;
                }

                if(!empty($this->input->post('crime_location')))
                {
                    $data['crime_location'] = $this->input->post('crime_location');
                }
                
                if(!empty($this->input->post('description')))
                {
                    $data['description'] = $this->input->post('description');
                }

                if(!empty($this->input->post('latitude')))
                {
                    $data['latitude'] = $this->input->post('latitude');
                }

                if(!empty($this->input->post('longitude')))
                {
                    $data['longitude'] = $this->input->post('longitude');
                }


                $report_id = $this->common_model->reportUpdate(TABLE_PREFIX.'report',$reportid,$data,$mode);

                $where = array('report_id'=>$report_id);

                $getResult = $this->common_model->getRow(TABLE_PREFIX.'report',$where);
               
                $user_id = $getResult->user_id;

                if($report_id)
                {
                    if(!empty($_FILES['crimeimages']['name'])){

                        $filesCount = count($_FILES['crimeimages']['name']);

                        for($i = 0; $i < $filesCount; $i++){

                            $_FILES['crimeimage']['name'] = time().$_FILES['crimeimages']['name'][$i];

                            $_FILES['crimeimage']['type'] = $_FILES['crimeimages']['type'][$i];

                            $_FILES['crimeimage']['tmp_name'] = $_FILES['crimeimages']['tmp_name'][$i];

                            $_FILES['crimeimage']['error'] = $_FILES['crimeimages']['error'][$i];

                            $_FILES['crimeimage']['size'] = $_FILES['crimeimages']['size'][$i];

                            $uploadPath = 'upload/crime_pics/';

                            $config['upload_path'] = $uploadPath;

                            $config['allowed_types'] = 'gif|jpg|png|jpeg';

                            $this->load->library('upload', $config);

                            $this->upload->initialize($config);

                            if($this->upload->do_upload('crimeimage')){

                                $fileData = $this->upload->data();

                                $uploadData[$i]['crime_pics'] = $fileData['file_name'];

                                $uploadData[$i]['upload_path'] = $uploadPath;

                                if($mode == 'add')
                                {
                                    $uploadData[$i]['user_type'] = 'admin';

                                    $uploadData[$i]['user_id'] = 0;
                                }
                                else
                                {
                                    $uploadData[$i]['user_type'] = 'custom';

                                    $uploadData[$i]['user_id'] = $user_id;
                                }

                                $uploadData[$i]['report_id'] = $report_id;

                            }
                        }
                    }

                }



               //print_r($uploadData);exit;

                if(!empty($uploadData)){
               
                    $insert = $this->common_model->addBatchData($uploadData);

                    $statusMsg = $insert?'Files uploaded successfully.':'Some problem occurred, please try again.';
                    $this->session->set_flashdata('statusMsg',$statusMsg);
                }
               
                 
                redirect('admin/report');

            }
         
    }
    
    public function get_reported_crime()
    {
        $where=array('is_reported'=>1);

        $arr['reports'] = $this->common_model->get_report(TABLE_PREFIX.'report',$where); 
        
        $this->load->view('admin/vwReport',$arr);
    }
    
    public function block_user() {
        // Code goes here
    }

    public function deleteimage(){

            $deleteid  = $this->input->post('image_id');

            $where = array('id' => $deleteid);

            if($cr_pics = $this->common_model->getData(TABLE_PREFIX.'pics',$where))
            {
                foreach($cr_pics as $cr_pic)
                {
                    if(!empty($cr_pic->crime_pics))
                    {
                         @unlink(FILE_UPLOAD_PATH.'crime_pics/'.$cr_pic->crime_pics);
                    }
                }

            }

            $this->db->delete('vigilant_pics', array('id' => $deleteid)); 

            $verify = $this->db->affected_rows();
            
            echo $verify;

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
                    @unlink(FILE_UPLOAD_PATH.'crime_pics/'.$cr_pic->crime_pics);
                }
            }

            $this->common_model->DataDelete(TABLE_PREFIX.'pics',$where,$mode,"report_id"); 
        }

       

        if($get_report=$this->common_model->getData(TABLE_PREFIX.'report',$where))
        {
            if(!empty($get_report['0']->crime_video))
            {
                @unlink(FILE_UPLOAD_PATH.'crime_video/'.$get_report['0']->crime_video);
            }
            $this->common_model->DataDelete(TABLE_PREFIX.'report',$where,$mode,"report_id"); 
        }

      
        $arr['reports'] = $this->common_model->get_report(TABLE_PREFIX.'report');
        
        $this->load->view('admin/ajax/vwReport',$arr);
    }
    
    public function detailsCrime() {
        //$arr['page'] = 'cms';
        
        $id=$this->input->post('id');

        //$arr['id']=$id;

       // $where=array('id'=>$id);
        $where=array('report_id'=>$id);

        
        $arr['reportedCrimes'] = $this->common_model->get_reported_crime(TABLE_PREFIX.'reported_crime',$where);
        
        $this->load->view('admin/ajax/vwReportedCrime',$arr);
    }
    
    
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
