<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

error_reporting(E_ALL);
ini_set("display_errors", 1);


class Location extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->obj = new stdClass();
		// Load form validation library
		$this->load->library('form_validation');
		$this->load->model("location_model");
			
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function add_home_location()
	{
		$userid = $this->input->post('user_id');

		if(!empty($userid))
		{
			$data['user_id'] = $userid;

			
			$latitude = $data['lat'] = !empty($this->input->post('lat')) ? ($this->input->post('lat')):"";

			$longitude = $data['long'] = !empty($this->input->post('long')) ? ($this->input->post('long')):"";

			$address = $data['address'] = !empty($this->input->post('address')) ? ($this->input->post('address')):"";

			$where = array('user_id'=>$userid);

			$getData = $this->location_model->getRow('vigilant_user_hlocation',$where);

			if(empty($getData))
			{
				$inserId = $this->location_model->addData('vigilant_user_hlocation',$data);

			}
			else{

				$upData['lat'] = $latitude;

				$upData['long'] =$longitude;

				$upData['address'] =$address;

				$modificId = $this->location_model->updateHomeData('vigilant_user_hlocation',$where,$upData);
			} 
			 

			if(!empty($inserId))
			{
				//echo $modificId;exit;
				$where =  array('hloc_id'=>$inserId);

				$data['homeDetails'] = $this->location_model->getRow('vigilant_user_hlocation',$where);


				$result = array('status'=>1,'message'=>'Home Location added successfully','result'=> $data['homeDetails']);
			}
			else if(!empty($modificId))
			{
				$where =  array('hloc_id'=>$modificId);

				$data['homeDetails'] = $this->location_model->getRow('vigilant_user_hlocation',$where);


				$result = array('status'=>1,'message'=>'Home Location updated successfully','result'=> $data['homeDetails']);
			}
			else
			{
				$result = array('status'=>0,'message'=>'Not modified.','result'=> $this->obj);
			}
		}
		else{

			$result = array('status'=>0,'message'=>'parameter missing');
		}
		echo json_encode($result);		
	}

	public function add_location()
	{
		$userid = $this->input->post('user_id');

		if(!empty($userid))
		{
			$data['user_id'] = $userid;

			
			$data['lat'] = !empty($this->input->post('lat')) ? ($this->input->post('lat')):"";

			$data['long'] = !empty($this->input->post('long')) ? ($this->input->post('long')):"";

			$data['address'] = !empty($this->input->post('address')) ? ($this->input->post('address')):"";


			$data['gplaceid'] = !empty($this->input->post('gplaceid')) ? ($this->input->post('gplaceid')):"";


			$data['custom_name'] = !empty($this->input->post('custom_name')) ? ($this->input->post('custom_name')):"";

			$where = array("user_id"=>$userid);

			$countdata=$this->location_model->countData("vigilant_user_location",$where);

			if($countdata >= 5)
			{

					$result = array('status'=>0,'message'=>'You can not add more than five location.');
			}
			else{

				$insertid = $this->location_model->addData('vigilant_user_location',$data);	

				if(!empty($insertid))
				{
					$result = array('status'=>1,'message'=>'Location added successfully');
				}
				else
				{
					$result = array('status'=>0,'message'=>'Server error. Please try again later');
				}
			}
			
		}
		else{

			$result = array('status'=>0,'message'=>'parameter missing');
		}
		echo json_encode($result);		
	}	

   	


   public function update_location()
	{
	
		$userid = !empty($this->input->post('user_id'))? $this->input->post('user_id'):'';

		$loc_id = $this->input->post('loc_id');

		
		if(!empty($loc_id) && !empty($userid))
		{
		
			if(!empty($this->input->post('lat')))
			{
				$data['lat'] = $this->input->post('lat');
			}

			if(!empty($this->input->post('long')))
			{
				$data['long'] = $this->input->post('long');
			}

			if(!empty($this->input->post('address')))
			{
				$data['address'] = $this->input->post('address');
			}

			if(!empty($this->input->post('gplaceid')))
			{
				$data['gplaceid'] = $this->input->post('gplaceid');
			}

			if(!empty($this->input->post('custom_name')))
			{
				$data['custom_name'] = $this->input->post('custom_name');
			}

			
			$where =  array("loc_id"=>$loc_id,"user_id"=>$userid);

			$get_location = $this->location_model->getRow('vigilant_user_location',$where); 

			if(!empty($get_location))
			{

				$where =  array("loc_id"=>$loc_id);
			
				$update_location=$this->location_model->updateData('vigilant_user_location',$where,$data);	

				if($update_location)
				{
					
					$result = array('status'=>1,'message'=>'Update success');
					
				}
				else
				{
					
					$result = array('status'=>0,'message'=>'Server error. Please try again later');
				}
			}
			else{

				$result = array('status'=>0,'message'=>'No such location found.');
			}		
		}
		else
		{
			$result = array('status'=>0,'message'=>'parameter missing.');
		}

		echo json_encode($result);
		
	}

	public function delete_location()
	{

	 	$userid = !empty($this->input->post('user_id'))? $this->input->post('user_id'):'';

		$loc_id = $this->input->post('loc_id');

		
		if(!empty($loc_id))
		{
			$where =  array("loc_id"=>$loc_id);

			$get_location = $this->location_model->getRow('vigilant_user_location',$where); 

			if(!empty($get_location))
			{
					
				$where =  array("loc_id"=>$loc_id);

				$delete_location=$this->location_model->DeleteData('vigilant_user_location',$where);	

				if($delete_location)
				{
					
					$result = array('status'=>1,'message'=>'Delete success');
					
				}
				else
				{
					
					$result = array('status'=>0,'message'=>'Server error. Please try again later');
				}
				
			}
			else{

				$result = array('status'=>0,'message'=>'Server error. Please try again later');
			}		
		}
		else
		{
			$result = array('status'=>0,'message'=>'parameter missing.');
		}

		echo json_encode($result);
		
	}

	public function get_all_location()
	{
		
		$userid = $this->input->post('user_id');

		if(!empty($userid))
		{

			$where = array('user_id'=>$userid);

			$data['locationDetails'] = $this->location_model->getData('vigilant_user_location',$where);

			//print_r($data['userdetails']);exit;

			if(!empty($data['locationDetails']))
			{
				
				$result = array('status'=>1,'message'=>'success','result'=> $data['locationDetails']);
				
			}
			else
			{
				$result = array('status'=>0,'message'=>'No location found.','result'=> $this->obj);
			}		
		}
		else
		{
			$result = array('status'=>0,'message'=>'parameter missing.');
		}
		echo json_encode($result);
		
	}

	public function search_location()
	{
		//print_r($_POST);exit;

		$orglat = $this->input->post('latitude');

		$orglong = $this->input->post('longitude');

		$radius = $this->input->post('radius');

		if(!empty($orglat) && !empty($orglong) && !empty($radius))
		{


			$userid = !empty($this->input->post('user_id'))?($this->input->post('user_id')):'';

			$crime_type_id = !empty($this->input->post('crime_type_id'))?($this->input->post('crime_type_id')):'';

			$time_frame = !empty($this->input->post('time_frame'))?($this->input->post('time_frame')):'';

			//echo $crime_date1 = $this->input->post('crime_date');

			$crime_date="";
			
			if(!empty($this->input->post('crime_date')))
				{
					$crime_date = date('Y-m-d',strtotime(str_replace('/','-',$this->input->post('crime_date'))));
				}

			//echo  $crime_date;exit;
			
			$where = array();

			$data['reportdetails'] = $this->location_model->search_location('vigilant_report',$where,$userid,$orglat,$orglong,$radius,$crime_date,$crime_type_id,$time_frame);

			//print_r($data['userdetails']);exit;

			if(!empty($data['reportdetails']))
			{

				$result = array('status'=>1,'message'=>'success','result'=> $data['reportdetails']);

			}
			else
			{
				$result = array('status'=>0,'message'=>'No record found','result'=> $this->obj);
			}		
		}
		else
		{
			$result = array('status'=>0,'message'=>'parameter missing.','result'=> $this->obj);
		}

		echo json_encode($result);
	}




}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
