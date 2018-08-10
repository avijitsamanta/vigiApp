<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crimes extends CI_Controller {
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
		$this->load->model('admin/crime_model');
    }

    public function index() {
        //$arr['page'] = 'cms';
        
        //$qry ='Select * from '.TABLE_PREFIX.'cms'; // select data from db
        $arr['crime'] = $this->crime_model->getCrimes(TABLE_PREFIX.'crime_type');    
		    
        $this->load->view('admin/vwCrime',$arr);
    }

     public function addcrime() {
		
        $result = $this->load->view('admin/vwAddCrime');
	
    }
	
	public function editcrime($id='') {
        //$arr['page'] = 'cms';
		$arr['type_id']=$id;

		$where=array('type_id'=>$id);
		
        $arr['crimeDetails'] = $this->crime_model->crimeDetails(TABLE_PREFIX.'crime_type',$where);  
			
        $result = $this->load->view('admin/vwEditCrime',$arr);
    }
   
    
       public function updateCrime($mode='',$id='') {

		$this->form_validation->set_error_delimiters('<span style="color:red">', '</span>');
	
		// field name, error message, validation rules
	  	$this->form_validation->set_rules('crime_name', 'banner Title', 'trim|required');

		 			if($this->form_validation->run() == FALSE)
					{
						$this->addcrime();
					}
					else
					{

						$crime_name=$this->input->post('crime_name');

						$status = !empty($this->input->post('status')) ? ($this->input->post('status')):0;

						$data=array('crime_name'=>$crime_name,'status'=>$status);
						
						$this->crime_model->crimeUpdate(TABLE_PREFIX.'crime_type',$id,$data,$mode); 

						redirect('admin/crimes');
					
					}
		 
    }
	
	public function deleteCrime(){
	
		$type_id=$this->input->post('type_id');
		
		$mode=$this->input->post('mode');
		//print_r($_POST);exit;
		
		if($mode=='single'){
		
			$where=array('type_id'=>$type_id);

		}
		else{
		
			$where=explode(",",$type_id);
				
		}
		
		$this->crime_model->crimeDelete(TABLE_PREFIX.'crime_type',$where,$mode); 
		
		$arr['crime'] = $this->crime_model->getCrimes(TABLE_PREFIX.'crime_type');
		
		$this->load->view('admin/ajax/vwCrime',$arr);
		
	}
	
	public function crimestatus(){
		
		$status=$this->input->post('stat'); 

		$type_id=$mode=$this->input->post('id');
		
		$current_status = $status == 'active' ? '1' : '0';
		
		$data=array('status'=>$current_status);
		
		$this->crime_model->changeStatus(TABLE_PREFIX.'crime_type',$type_id,$data);
		
		redirect('admin/crimes');
		
	}
    

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */