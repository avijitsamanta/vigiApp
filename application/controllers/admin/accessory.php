<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Accessory extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
        $this->load->library('form_validation');
        
        if(!$this->session->userdata('is_admin_login')) 
        {
            redirect('admin/home');
        }
		
		$this->load->model('admin/accessory_model');
		$this->load->helper('common_helper');
    }

    public function index() 
    {
        $arr['sub_subcategory'] = $this->accessory_model->getData(TABLE_PREFIX.'sub_subcategory');    
		    
        $this->load->view('admin/vwAccessories',$arr);
    }

     public function addSubSubCategory() 
     {
					
		$arr['subcategoryList'] = $this->accessory_model->getData(TABLE_PREFIX.'product_subcategory');

        $this->load->view('admin/ajax/vwAddAccessories',$arr);
	
     }
	
	public function editSubSubCategory() 
	{
		$arr['sub_subcategory_id'] = $this->input->post('id');

		$where = array('sub_subcategory_id'=>$this->input->post('id'));

        	$arr['sub_subCategoryDetails'] = $this->accessory_model->subSubCategoryDetails(TABLE_PREFIX.'sub_subcategory',$where);    
			
		$arr['subcategoryList'] = $this->accessory_model->getData(TABLE_PREFIX.'product_subcategory');
        
        	$this->load->view('admin/ajax/vwEditAccessories',$arr);
    }
   
    
    public function updateAccessory($mode='',$id='') 
    {	 
		$config['upload_path'] = FILE_UPLOAD_PATH.'category_image/';

		$config['allowed_types'] = 'gif|jpg|jpeg';

		$this->load->library('upload', $config);					
				
		if (!$this->upload->do_upload('sub_subcategory_image'))
		{						
			$file_path="";						
		}
		else
		{
			$upload_data = $this->upload->data(); 
					
			$file_path = base_url().'assets/upload/category_image/'.$upload_data['file_name'];
		}	


					
			$subcategory_id = $this->input->post('subcategory_id');

			$sub_subcategory = $this->input->post('sub_subcategory');
						
			if($file_path == "")
			{
				$data=array('subcategory_id'=>$subcategory_id,'sub_subcategory'=>$sub_subcategory);		
			}
			else
			{
			
		$data = array('subcategory_id'=>$subcategory_id,'sub_subcategory'=>$sub_subcategory,'sub_subcategory_image'=>$file_path);			

			}
					
			$this->accessory_model->subCatUpdate(TABLE_PREFIX.'sub_subcategory',$id,$data,$mode); 
		
		 	redirect('admin/accessory');
    }
	
	public function deleteAccessory()
	{
	
		$accessory_id = $this->input->post('accessory_id');
		
		$mode = $this->input->post('mode');
		
		if($mode == 'single')
		{		
			$where = array('sub_subcategory_id'=>$accessory_id);
		}
		else
		{
			$where = explode(",",$accessory_id);		
		}
		
		$this->accessory_model->accessoryDelete(TABLE_PREFIX.'sub_subcategory',$where,$mode); 
		
		//$arr['sub_subcategory'] = $this->accessory_model->getData(TABLE_PREFIX.'sub_subcategory');    
		    
        	//$this->load->view('admin/vwAccessories',$arr);

		$arr['sub_subcategory'] = $this->accessory_model->getData(TABLE_PREFIX.'sub_subcategory');    
		    
        	$this->load->view('admin/ajax/vwAccessories',$arr);

		//redirect('admin/accessory');
		
	}
	
	
	public function changeStatus()
	{
	
		$status = $this->input->post('stat');
		
		$accessory_id = $this->input->post('id');

		$current_status = $status == 'true' ? 'Yes' : 'No';
		
		$data = array('status'=>$current_status);
		
		$this->accessory_model->changeTrendStatus(TABLE_PREFIX.'sub_subcategory',$accessory_id,$data);
		
	
	}
    

}

