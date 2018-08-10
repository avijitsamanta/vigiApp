<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//error_reporting(E_ALL);
//ini_set("display_errors", 1);


class Report extends CI_Controller {

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
		$this->load->model("report_model");
			
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function add_report()
	{
		$userid 		= $this->input->post('user_id');

		$pic_ids = $this->input->post('pic_ids');

		if(!empty($pic_ids))
		{
			$pic_ids_arr = explode(',',$pic_ids) ;

		}

		/* if(!empty($crime_type_ids))
		{
			$crime_type_ids_arr = explode(',',$crime_type_ids) ;

		}*/

		if(!empty($userid))
		{
				$data['user_id'] = $userid;

				if(!empty($this->input->post('gplaceid')))
				{
					$gplaceid = $data['gplaceid'] = $this->input->post('gplaceid');
				}


				$data['crime_type_id']= $crime_type_id = $this->input->post('crime_name');

				$where = array('type_id'=>$crime_type_id);

				$get_crime_type =  $this->report_model->getRow('vigilant_crime_type',$where);

				if(!empty($get_crime_type))
				{
					$crime_name = $get_crime_type->crime_name;
				}

				

				$data['crime_date']= $crime_date = date("Y-m-d",strtotime($this->input->post('crime_date')));

				$data['crime_time']= $crime_time = date("H:i:s",strtotime($this->input->post('crime_time')));

				$data['crime_location']= $crime_location = $this->input->post('crime_location');

				$data['latitude']=$latitude 		= $this->input->post('latitude');

				$data['longitude']=$longitude 		= $this->input->post('longitude');

				$data['description']=$description	= !empty($this->input->post('description')) ? ($this->input->post('description')):"";

				$data['date_added'] = date("Y-m-d H:i:s");

				if(!empty($_FILES['crime_video']['name'])){

				 $folder = "upload/crime_video/";

				  $path_parts = pathinfo($_FILES["crime_video"]["name"]);

				  $upload_image = $path_parts['filename']."_".time().".".$path_parts['extension'];

				  

				  if (!file_exists($folder)) {
				  mkdir($folder,0777);
				  }
				  /*$files = glob($folder.'/*');
					 if(count(glob($folder.'/*'))!=0) {
				    foreach($files as $file){
				    if(is_file($file)){
				    unlink($file); // delete file
				    }
				    }
				  }*/
				  $target_dir   = $folder;
				  $target_file  = $target_dir ."/". basename($upload_image);
				  if (file_exists($target_file)) {
				  unlink($target_file);
				  }

				  	/*$videoFile = $_FILES["crime_video"]["tmp_name"];

				  	$imageFile = $path_parts['filename'].".jpg";

				  	$size = "120x90";

				  	$getFromSecond = 1;

				  	$cmd = "$target_dir -i $videoFile -an -ss $getFromSecond -s $size $imageFile";

				  	if(!shell_exec($cmd))
				  	{
				  		echo "thumnail created $imageFile";
				  	}
				  	else
				  	{
				  		echo "error";
				  	}*/

				  if(move_uploaded_file($_FILES["crime_video"]["tmp_name"], $target_file))
				  {
				  	
				  	
				  	$crime_video  = $upload_image;

				  	$data['crime_video'] = $crime_video;

					$data['upload_path'] = $folder;
				  }
				  else
				  {
				  	$data['crime_video'] = "";

					$data['upload_path'] = "";

				  }
				}else{

				$data['crime_video'] = "";

				$data['upload_path'] = "";
				
				}


				$insertid = $this->report_model->addData('vigilant_report',$data);	


				if(!empty($insertid))
				{
					if(!empty($pic_ids_arr)) //For adding pics
					{
						for($i=0;$i<sizeof($pic_ids_arr);$i++)
						{
							$where = array('id'=>$pic_ids_arr[$i]);

							if($isexist=$this->report_model->getRow('vigilant_pics',$where))
							{
								$reportData['report_id'] = $insertid;

								$where = array('id'=>$pic_ids_arr[$i]);

								//$this->db->where('user_id',$userid);

								//$this->db->where('gplaceid',$gplaceid);

								$this->report_model->updateData('vigilant_pics',$where,$reportData);	
							}
						}
					}
					$where = array('report_id'=>$insertid);

					$data1['reportdetails'] = $this->report_model->get_report('vigilant_report',$where,$userid);


					$notify = @$this->sendNotification($latitude,$longitude,$userid,$insertid,$crime_type_id,$crime_name,$description);//call push notification
					
				
					$result = array('status'=>1,'message'=>'Report added successfully','result'=> $data1['reportdetails']);

				}
				else
				{
					$result = array('status'=>0,'message'=>'error','result'=> $this->obj);
				}
			}
			else{

				$result = array('status'=>0,'message'=>'parameter missing','result'=> $this->obj);
			}
			echo json_encode($result);		
	}

	public function add_crime_pics()
	{
				$data['user_id']= $userid = $this->input->post('user_id');

				if(!empty($this->input->post('gplaceid')))
				{
					$data['gplaceid'] =	$gplaceid =  $this->input->post('gplaceid');
				}


				if(!empty($userid) && !empty($_FILES['crime_pics']['name']))
				{
		

				if(!empty($_FILES['crime_pics']['name'])){

				 $folder = "upload/crime_pics/";

				  $path_parts = pathinfo($_FILES["crime_pics"]["name"]);

				  $upload_image = $path_parts['filename']."_".time().".".$path_parts['extension'];
				  

				  /*if (!file_exists($folder)) {
				  mkdir($folder,0777);
				  }
				  $files = glob($folder.'/*');
					 if(count(glob($folder.'/*'))!=0) {
				    foreach($files as $file){
				    if(is_file($file)){
				    unlink($file); // delete file
				    }
				    }
				  }*/
				  $target_dir   = $folder;
				  $target_file  = $target_dir ."/". basename($upload_image);
				  if (file_exists($target_file)) {
				  unlink($target_file);
				  }
				  if(move_uploaded_file($_FILES["crime_pics"]["tmp_name"], $target_file))
				  {
				  	$crime_pics  = $upload_image;

				  	$data['crime_pics'] = $crime_pics;

					$data['upload_path'] = $folder;
				  }
				  
				}

				$insertid = $this->report_model->addData('vigilant_pics',$data);	


				if(!empty($insertid))
				{
						$data['picsDetails'] = $this->report_model->get_crime_pics('vigilant_pics',$insertid);	


						$result = array('status'=>1,'message'=>'success','result'=> $data['picsDetails']);

				}
				else
				{
					$result = array('status'=>0,'message'=>'error','result'=> $this->obj);
				}
			}
			else{

				$result = array('status'=>0,'message'=>'parameter missing','result'=> $this->obj);
			}	
			echo json_encode($result);	
	}		

   	public function get_report_by_report_id()
	{
	
		$userid = $this->input->post('user_id');
		
		$report_id = $this->input->post('report_id');
		
		if(!empty($userid) && !empty($report_id))
		{
			
			$where = array('report_id'=>$report_id);

			$data['userdetails'] = $this->report_model->get_report('vigilant_report',$where,$userid);	

			//print_r($data['userdetails']);exit;

			if(!empty($data['userdetails']))
			{

				$where = array('report_id' => $report_id,'reported_by'=>$userid);

				$getRoportedCrime = $this->report_model->getRow('vigilant_reported_crime',$where);

				if(!empty($getRoportedCrime))
				{
					$data['userdetails'][0]->is_reported = 1;
				}
				else
				{
					$data['userdetails'][0]->is_reported = 0;
				}
				
				
				$result = array('status'=>1,'message'=>'success','result'=> $data['userdetails']);
				
			}
			else
			{
				$result = array('status'=>0,'message'=>'error','result'=> $this->obj);
			}		
		}
		else
		{
			$result = array('status'=>0,'message'=>'parameter missing.','result'=> $this->obj);
		}

		echo json_encode($result);
		
	}

	public function get_all_report()
	{
			$orglat = $this->input->post('latitude');

			$orglong = $this->input->post('longitude');

			$distance = $this->input->post('distance');

			if(!empty($orglat) && !empty($orglong) && !empty($distance))
			{


				$userid = !empty($this->input->post('user_id'))?($this->input->post('user_id')):'';

				$where = array();
				
				$data['userdetails'] = $this->report_model->get_all_report('vigilant_report',$where,$userid,$orglat,$orglong,$distance);

				

				if(!empty($data['userdetails']))
				{

					//print_r($data['userdetails']);exit;
					$result = array('status'=>1,'message'=>'success','result'=> $data['userdetails']);
					
				}
				else
				{
					$result = array('status'=>0,'message'=>'error','result'=> $this->obj);
				}		
			}
			else
			{
				$result = array('status'=>0,'message'=>'parameter missing.','result'=> $this->obj);
			}

		echo json_encode($result);
		
	}


   public function updateReport()
	{
	
		$userid = $this->input->post('user_id');

		$report_id = $this->input->post('report_id');

		$pic_ids = $this->input->post('pic_ids');

		if(!empty($pic_ids))
		{
			$pic_ids_arr = explode(',',$pic_ids) ;

		}

		//print_r($pic_ids_arr);
		//echo $pic_ids;
		//exit;

		if(!empty($userid) && !empty($report_id))
		{
		
			if(!empty($this->input->post('crime_name')))
			{
				$data['crime_type_id'] = $this->input->post('crime_name');
			}

			if(!empty($this->input->post('crime_date')))
			{
				$data['crime_date'] = date("Y-m-d",strtotime($this->input->post('crime_date')));
			}

			if(!empty($this->input->post('crime_time')))
			{
				$data['crime_time'] = date("H:i:s",strtotime($this->input->post('crime_time')));
			}

			if(!empty($this->input->post('crime_location')))
			{

				$data['crime_location'] = $this->input->post('crime_location');
			}

			if(!empty($this->input->post('latitude')))
			{
				$data['latitude'] = $this->input->post('latitude');
			}

			if(!empty($this->input->post('longitude')))
			{
				$data['longitude'] = $this->input->post('longitude');
			}

			 if(!empty($this->input->post('description')))
			 {
			 	
			 	$data['description'] = $this->input->post('description');

			 }

			if(!empty($this->input->post('gplaceid')))
			{

				$gplaceid = $data['gplaceid'] = $this->input->post('gplaceid');

			}

			$data['date_updated'] = date("Y-m-d H:i:s"); 

			$video_delete = $this->input->post('video_delete');

			if($video_delete == 'yes')
			{
				$where = array('report_id'=>$report_id);

				$data3['reportdetails'] = $this->report_model->getRow('vigilant_report',$where);

				if(!empty($data3['reportdetails']->crime_video))
				{
					$root_dir=$_SERVER['DOCUMENT_ROOT'];

					@unlink($root_dir.'/vigilant/upload/crime_video/'.$data3['reportdetails']->crime_video);

					$reportData1['crime_video'] = '';


					$this->report_model->updateData('vigilant_report',$where,$reportData1);	
				}


			}

			if($video_delete == 'no')
			{

			if(!empty($_FILES['crime_video']['name'])){
			   
				$folder = "upload/crime_video/";

				$path_parts = pathinfo($_FILES["crime_video"]["name"]);

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
				if(move_uploaded_file($_FILES["crime_video"]["tmp_name"], $target_file))
				{
					$where = array('report_id'=>$report_id);

					$data2['reportdetails'] = $this->report_model->getRow('vigilant_report',$where);

					if(!empty($data2['reportdetails']->crime_video))
					{
						$root_dir=$_SERVER['DOCUMENT_ROOT'];
						@unlink($root_dir.'/vigilant/upload/crime_video/'.$data2['reportdetails']->crime_video);
					}
					
					$data['crime_video'] = $upload_image;

					$data['upload_path'] = $folder;
				}
			}

			}
			//$data = array('first_name'=>$first_name,'last_name'=>$last_name);

			$update_report=$this->report_model->updatereport('vigilant_report',$data,$report_id);	

			//print_r($data['userdetails']);exit;
			//exit;
			if($update_report)
			{
				$where = array('report_id'=>$report_id);

				$pics_ids_data_arr =$this->report_model->get_pics_id('vigilant_pics',$where);

				//print_r($pics_ids_data_arr);exit;

				if(!empty($pic_ids_arr))
				{
					if(!empty($pics_ids_data_arr)) // calculating pics id to be deleted
					{
						$del_ids_arr = array_diff($pics_ids_data_arr,$pic_ids_arr);

						$del_ids_arr = array_values($del_ids_arr);
					}

					if(!empty($del_ids_arr)) // delete pics 
					{

						for($i=0;$i<sizeof($del_ids_arr);$i++)
						{
							$where = array('id'=>$del_ids_arr[$i]);

							if($isexist=$this->report_model->getRow('vigilant_pics',$where))
							{
								if(!empty($isexist->crime_pics))
								{
									$root_dir=$_SERVER['DOCUMENT_ROOT'];

									@unlink($root_dir.'/vigilant/upload/crime_pics/'.$isexist->crime_pics);
								}
								$where = array('id'=>$del_ids_arr[$i]);

								//$this->db->where('user_id',$userid);

								//$this->db->where('gplaceid',$gplaceid);

								$this->report_model->DeleteData('vigilant_pics',$where);	
							}
						}

					}
					//updating report with the pics ids 
					for($i=0;$i<sizeof($pic_ids_arr);$i++) 
					{
						$where = array('id'=>$pic_ids_arr[$i]);

						if($isexist=$this->report_model->getRow('vigilant_pics',$where))
						{
							$reportData['report_id'] = $report_id;

							$where = array('id'=>$pic_ids_arr[$i]);

							//$this->db->where('user_id',$userid);

							//$this->db->where('gplaceid',$gplaceid);

							$this->report_model->updateData('vigilant_pics',$where,$reportData);	
						}
					}
				}

				$where = array('report_id'=>$report_id);

				$data1['userdetails'] = $this->report_model->get_report('vigilant_report',$where,$userid);
				
				$result = array('status'=>1,'message'=>'Update success','result'=>$data1);
				
			}
			else
			{
				$where = array('report_id'=>$report_id);

				$pics_ids_data_arr =$this->report_model->get_pics_id('vigilant_pics',$where);

				//print_r($pics_ids_data_arr);exit;

				if(!empty($pic_ids_arr))
				{
					if(!empty($pics_ids_data_arr))
					{
						$del_ids_arr = array_diff($pics_ids_data_arr,$pic_ids_arr);

						$del_ids_arr = array_values($del_ids_arr);
					}
					//print_r($del_ids_arr);exit;

					if(!empty($del_ids_arr))
					{

						for($i=0;$i<sizeof($del_ids_arr);$i++)
						{
							$where = array('id'=>$del_ids_arr[$i]);

							if($isexist=$this->report_model->getRow('vigilant_pics',$where))
							{
								if(!empty($isexist->crime_pics))
								{
									$root_dir=$_SERVER['DOCUMENT_ROOT'];
									@unlink($root_dir.'/vigilant/upload/crime_pics/'.$isexist->crime_pics);
								}
								$where = array('id'=>$del_ids_arr[$i]);

								//$this->db->where('user_id',$userid);

								//$this->db->where('gplaceid',$gplaceid);

								$this->report_model->DeleteData('vigilant_pics',$where);	
							}
						}

					}

					for($i=0;$i<sizeof($pic_ids_arr);$i++)
					{
						$where = array('id'=>$pic_ids_arr[$i]);

						if($isexist=$this->report_model->getRow('vigilant_pics',$where))
						{
							$reportData['report_id'] = $report_id;

							$where = array('id'=>$pic_ids_arr[$i]);

							//$this->db->where('user_id',$userid);

							//$this->db->where('gplaceid',$gplaceid);

							$this->report_model->updateData('vigilant_pics',$where,$reportData);	
						}
					}
				}

				$where = array('report_id'=>$report_id);

				$data1['userdetails'] = $this->report_model->get_report('vigilant_report',$where,$userid);
				
				$result = array('status'=>1,'message'=>'Update success','result'=>$data1);
			}		
		}
		else
		{
			$result = array('status'=>0,'message'=>'parameter missing.','result'=> $this->obj);
		}

		echo json_encode($result);
		
	}

	public function delete_report()
	{

	 	$report_id = $this->input->post('report_id');
	 	
	 	if(!empty($report_id))
		{

			$where = array('report_id' => $report_id);

			$data2['reportdetails'] = $this->report_model->getRow('vigilant_report',$where);

			if(!empty($data2['reportdetails']->crime_video))
			{
				$root_dir=$_SERVER['DOCUMENT_ROOT'];
				@unlink($root_dir.'/vigilant/upload/crime_video/'.$data2['reportdetails']->crime_video);
			}
					
			
			$del_report = $this->report_model->DeleteData('vigilant_report',$where);

			if($del_report)
			{

				$result = array('status'=>1,'message'=>'Delete successful','result'=> $del_report);
			}
			else
			{
				$result = array('status'=>0,'message'=>'Fail','result'=> array());
			}		
	 	}
	 	else
	 	{
	 		$result = array('status'=>0,'message'=>'Parameter Missing','result'=> array());
	 	}

	 	echo json_encode($result);
		
	}

	public function delete_pics()
	{
		//echo $root_dir=$_SERVER['DOCUMENT_ROOT'];exit;
	 	$pics_id = $this->input->post('pics_id');
	 	
	 	if(!empty($pics_id))
		{

			$where = array('id' => $pics_id);

			$data2['crimepics'] = $this->report_model->getRow('vigilant_pics',$where);

			if(!empty($data2['crimepics']->crime_pics))
			{
				$root_dir=$_SERVER['DOCUMENT_ROOT'];

				@unlink($root_dir.'/vigilant/upload/crime_pics/'.$data2['crimepics']->crime_pics);
			}
					
			
			$del_pics = $this->report_model->DeleteData('vigilant_pics',$where);

			if($del_pics)
			{

				$result = array('status'=>1,'message'=>'Delete successful','result'=> $del_pics);
			}
			else
			{
				$result = array('status'=>0,'message'=>'Fail','result'=> array());
			}		
	 	}
	 	else
	 	{
	 		$result = array('status'=>0,'message'=>'Parameter Missing','result'=> array());
	 	}

	 	echo json_encode($result);
		
	}
	
	public function get_crime_type()
	{	
		$where =  array("status"=>1);

		//$get_crime_type = $this->report_model->getData('vigilant_crime_type',$where);
		$get_crime_type = $this->report_model->getCrimeType('vigilant_crime_type',$where);

		if($get_crime_type)
		{

			$result = array('status'=>1,'message'=>'successful','result'=> $get_crime_type);
		}
		else
		{
			$result = array('status'=>0,'message'=>'Fail','result'=> array());
		}		
	 	
	 	echo json_encode($result);
	}

	// get alert data

	public function get_alert_data()
	{
		$user_id = $this->input->post('user_id');

		if(!empty($user_id))
		{
			$where =  array('user_id'=>$user_id);

			$getResults =  $this->report_model->getRow('vigilant_notification_data',$where);

			if($getResults)
			{
				$get_alert_data = $this->report_model->get_alert_data_by_user('vigilant_notification_data',$where);
			}
			else
			{
				$get_alert_data = $this->report_model->get_alert_data();
			}

			if($get_alert_data)
			{
				$result = array('status'=>1,'message'=>'Successful','result'=> $get_alert_data);
			}
			else
			{
				$result = array('status'=>0,'message'=>'No record found.','result'=> array());
			}	
		}
		else
		{
			$result = array('status'=>0,'message'=>'no parameter.','result'=> array());
		}
	 	
	 	echo json_encode($result);
	}

	// set alert data

	public function set_alert_data()
	{
		$where = array();

		$crime_type_ids_arr = $this->report_model->getCrimeTypeIds('vigilant_crime_type',$where);

		if(!empty($crime_type_ids_arr))
		{
			$all_crime_type_ids = implode(',',$crime_type_ids_arr);
		}


		$data['user_id'] = $user_id = !empty($this->input->post('user_id'))?($this->input->post('user_id')):$u_id;

		$data['crime_type']	= $crime_type_ids = !empty($this->input->post('crime_type_ids'))?($this->input->post('crime_type_ids')):$all_crime_type_ids;

		$data['distance']	= $distance = !empty($this->input->post('distance'))?$this->input->post('distance'):1;

		if(!empty($user_id) && !empty($distance))
		{
			$where = array('user_id'=>$user_id);

			$getResults =  $this->report_model->getRow('vigilant_notification_data',$where);

			//print_r($getResults);exit;

			if(empty($getResults))
			{
				$instData = $this->report_model->addData('vigilant_notification_data',$data);
			}
			else
			{
				$where = array('user_id'=>$user_id);

				$data1['crime_type'] = $crime_type_ids;

				$data1['distance']	= $distance;

				$instData = $this->report_model->updateData('vigilant_notification_data',$where,$data1);
			}	

			if($instData)
			{
				$result = array('status'=>1,'message'=>'Successful');
			}
			else
			{
				$result = array('status'=>0,'message'=>'Server error');
			}		
		}
		else
		{
			$result = array('status'=>0,'message'=>'Parameter missing.','result'=> array());
		}
	 	
	 	echo json_encode($result);
	}


	// get notification listing

	public function getNotifylist()
	{
		$userid = $this->input->post('user_id');
		
		if (!empty($userid))
		{
			//$device_type = $_POST['device_type'];

			//$device_token = $_POST['device_token'];

			$where = array('user_id'=>$userid);

			$data['notifyDetails'] = $this->report_model->get_all_notfic_report('vigilant_notifications',$where,$userid);

			//print_r($data['notifyDetails']);exit;	

			if(!empty($data['notifyDetails']))
			{
			
				
				$result = array('status'=>1,'message'=>'Success','result'=> $data['notifyDetails']);				
				
			}
			else
			{
				$result = array('status'=>0,'message'=>'No record found.','result'=> new $this->obj);
			}		
		}
		else
		{
			$result = array('status'=>0,'message'=>'parameter missing.','result'=> new $this->obj);
		}

		echo json_encode($result);
		
	}

	// delete notification by user

	public function delNotificationByUser()
	{
		$userid = $this->input->post('user_id');
		
		if (!empty($userid))
		{
			//$device_type = $_POST['device_type'];

			//$device_token = $_POST['device_token'];

			$where = array('user_id'=>$userid);

			$delNotifybyUser = $this->report_model->DeleteData('vigilant_notifications',$where);	

			if(!empty($delNotifybyUser))
			{
			
				
				$result = array('status'=>1,'message'=>'Success');				
				
			}
			else
			{
				$result = array('status'=>0,'message'=>'Server Error.');
			}		
		}
		else
		{
			$result = array('status'=>0,'message'=>'parameter missing.');
		}

		echo json_encode($result);
		
	}

	// delete notification by id

	public function delNotificationById()
	{
		$notify_id = $this->input->post('notify_id');
		
		if (!empty($notify_id))
		{
			//$device_type = $_POST['device_type'];

			//$device_token = $_POST['device_token'];

			$where = array('notify_id'=>$notify_id);

			$delNotifybyId = $this->report_model->DeleteData('vigilant_notifications',$where);	

			if(!empty($delNotifybyId))
			{
			
				
				$result = array('status'=>1,'message'=>'Success');				
				
			}
			else
			{
				$result = array('status'=>0,'message'=>'Server Error.');
			}		
		}
		else
		{
			$result = array('status'=>0,'message'=>'parameter missing.');
		}

		echo json_encode($result);
		
	}

	// send push notification


	/*public function sendNotification1($userid='',$report_id='',$crime_name='',$description='',$distance='')
	{	
		$this->load->library('pushnotification');


		//$userid = $this->input->post('user_id');

		if (!empty($userid))
		{

			//$this->pushnotification->test();
			//$deviceToken = $this->input->post('tokenid');
			//$deviceToken = '16c100391c28de2d7bbe1a5b6d6278082fd40e80d5bcaecfe11fb6e4c730d657';
			// Message payload
			
			$where = array('user_id'=>$userid);

			$data['userDetails'] = $this->report_model->getHomeLocRow('vigilant_user_hlocation',$userid);
			
			//print_r($data['userDetails']);exit;

			if(!empty($data['userDetails']))
			{
					foreach($data['userDetails'] as $userDetail)
					{

						$orglat =  $userDetail->lat;

						$orglong = $userDetail->long;

						//$distance = 50;

						if(!empty($orglat) && !empty($orglong) && !empty($distance))
						{	
							$notifyUserArr = $this->report_model->get_notify_user('vigilant_user_hlocation',$orglat,$orglong,$distance,$userid);

							if(!empty($notifyUserArr))
							{
								$notiArr[] = $notifyUserArr;
							}

						}
					}
					

					if(!empty($notiArr))
					{
						$notiArr = call_user_func_array('array_merge', $notiArr);//array merge 
					}
					else
					{
						$notiArr = array();
					}

				

				if(!empty($notiArr))
				{

					$uniqueArr = array_map('unserialize', array_unique(array_map('serialize', $notiArr))); // array unique
					
				}
				else
				{
					$uniqueArr = array();
				}
				//print_r($uniqueArr);exit;
				$msg_payload = array (
					'mtitle' => $crime_name,
					'mdesc' => $description
				);


				if(!empty($uniqueArr))
				{
					foreach($uniqueArr as $notifyUser)
					{
						$dataVal['notify_msg_title'] = $msg_payload['mtitle'];

						$dataVal['notify_msg_body'] = $msg_payload['mdesc'];

						$dataVal['user_id'] = $notifyUser['user_id'];

						$dataVal['report_id'] = $report_id;

						$deviceToken[] = $notifyUser['device_token'];

						$addnotify=$this->report_model->addData('vigilant_notifications',$dataVal);

					}

					//print_r($deviceToken);exit;


					// Replace the above variable values
				}

				if(!empty($deviceToken))
				{

					$msg = $this->pushnotification->pushNoti_ios($deviceToken,$msg_payload);
				}
				else
				{
					$msg = '';
				}
				
				if($msg == 'SUCCESS')
				{
					//$result = array('status'=>1,'message'=>'Message successfully delivered','result'=> new $this->obj);

					return true;
				}
				else{
					//$result = array('status'=>0,'message'=>'Message not delivered','result'=> new $this->obj);

					return false;
				}

		}
		else
			{
				//$result = array('status'=>0,'message'=>'no record found','result'=> new $this->obj);
				return false;
			}
	}
	else
	{
		//$result = array('status'=>0,'message'=>'no record found','result'=> new $this->obj);

		return false;
	}
	//echo json_encode($result);
}*/

public function sendNotification($orglat="",$orglong="",$userid="",$report_id = "",$crime_type="",$crime_name="",$description="")
	{

		$this->load->library('pushnotification');

		//echo $orglat."---".$orglong."---".$userid."---".$report_id."---".$crime_type."---".$crime_name."---".$description;exit;
		/*$orglat="22.5866945";
		$orglong ="88.4249205";
		$userid = 3;
		$crime_type=5;

		$crime_name = "Murder";

		$report_id = 17;

		$description = "jgfkdfjgkdjghkdh ljhfdljgfhdfkj";*/

		$notifyUserArr = $this->report_model->get_notification_user('vigilant_user_hlocation',$orglat,$orglong,$userid,$crime_type);

		$msg_payload = array (
					'mtitle' => $crime_name,
					'mdesc' => $description
				);
		//print_r($notifyUserArr);exit;

				if(!empty($notifyUserArr))
				{
					foreach($notifyUserArr as $notifyUser)
					{
						$dataVal['notify_msg_title'] = $msg_payload['mtitle'];

						$dataVal['notify_msg_body'] = $msg_payload['mdesc'];

						$dataVal['user_id'] = $notifyUser->user_id;

						$dataVal['report_id'] = $report_id;

						$deviceTokenArr[] = $notifyUser->device_token;

						$where = array('user_id'=>$notifyUser->user_id,'report_id'=>$report_id);

						$getnotifyData = $this->report_model->getRow('vigilant_notifications',$where);

						if(empty($getnotifyData))
						{
							$addnotify=$this->report_model->addData('vigilant_notifications',$dataVal);

						}

						
					}

					

					// Replace the above variable values
				}

				if(!empty($deviceTokenArr))
				{

					$deviceTokenArr = array_map('unserialize', array_unique(array_map('serialize', $deviceTokenArr))); // array unique
					
				}
				else
				{
					$deviceTokenArr = array();
				}
				//print_r($deviceTokenArr);exit;
				if(!empty($deviceTokenArr))
				{
					foreach($deviceTokenArr as $deviceToken)
					{
						//echo $deviceToken;
						$msg = $this->pushnotification->iOS1($deviceToken,$msg_payload);
					}
					//exit;
				}
				
				if($msg == 'SUCCESS')
				{
					//$result = array('status'=>1,'message'=>'Message successfully delivered','result'=> new $this->obj);

					return true;
				}
				else{
					//$result = array('status'=>0,'message'=>'Message not delivered','result'=> new $this->obj);

					return false;
				}
				//echo json_encode($result);
	}

	public function get_notify_user1()
	{

		$this->load->library('pushnotification');

		$msg_payload = array (
			'mtitle' => 'Test push notification titlefsfgsdg',
			'mdesc' => 'Test push notification bodyfgdfgdfgdfgdfg',
		);


		// For iOS
		$deviceToken = '90b8014b98a9fd0840884a190108687da987a30589c3ff494a33040d83479088';

		//foreach($deviceTokenArr as $deviceToken)
		//{
			$msg = $this->pushnotification->iOS1($deviceToken,$msg_payload);
		//}

		



		if($msg == 'SUCCESS')
		{
		$result = array('status'=>1,'message'=>'Message successfully delivered','result'=> new $this->obj);

		//return true;
		}
		else{
		$result = array('status'=>0,'message'=>'Message not delivered','result'=> new $this->obj);

		//return false;
		}
		echo json_encode($result);
	}

	// report the crime

	public function reported_crime1()
	{

		$report_id = $this->input->post('report_id');

		$is_report = $this->input->post('is_reported');

		$userid = !empty($this->input->post('reported_by'))?($this->input->post('reported_by')):'';

		$reason = !empty($this->input->post('reason'))?($this->input->post('reason')):'';
	 	
	 	if(!empty($report_id) && !empty($userid) )
		{
			$where = array('report_id' => $report_id);

			$get_report_details = $this->report_model->getRow('vigilant_report',$where);

			//print_r($get_post_details);exit;

			if(!empty($get_report_details))
			{
				$data['is_reported'] = $is_report;

				$data['reported_by'] = $userid;

				$data['reason'] = $reason;

				$where1 = array('report_id' => $report_id,'reported_by'=>$userid);

				$get_reported_crime_details = $this->report_model->getRow('vigilant_report',$where1);

				//print_r($get_reported_post_details);exit;

				if(!empty($get_reported_crime_details))
				{
					$result = array('status'=>0,'message'=>'You have already reported this Crime');

					
				}
				else
				{
					$update_report=$this->report_model->updateData('vigilant_report',$where,$data);

					$result = array('status'=>1,'message'=>'Reporting of the crime is success');	
				}

				
			}
			else
			{
				$result = array('status'=>0,'message'=>'No record Found','result'=>array());
			}		
	 	}
	 	else
	 	{
	 		$result = array('status'=>0,'message'=>'Parameter Missing','result'=>array());
	 	}

	 	echo json_encode($result);

	}

	public function reported_crime()
	{

		$report_id = $this->input->post('report_id');

		$is_report = $this->input->post('is_reported');

		$userid = !empty($this->input->post('reported_by'))?($this->input->post('reported_by')):'';

		//$reason = !empty($this->input->post('reason'))?($this->input->post('reason')):'';
	 	
	 	if(!empty($report_id) && !empty($userid) )
		{
			$where = array('report_id' => $report_id);

			$get_report_details = $this->report_model->getRow('vigilant_report',$where);

			//print_r($get_post_details);exit;

			if(!empty($get_report_details))
			{
				$data['report_id'] = $report_id;

				$data['is_reported'] = $is_report;

				$data['reported_by'] = $userid;

				//$data['reason'] = $reason;

				$where1 = array('report_id' => $report_id,'reported_by'=>$userid);

				$get_reported_crime_details = $this->report_model->getRow('vigilant_reported_crime',$where1);

				//print_r($get_reported_post_details);exit;

				if(!empty($get_reported_crime_details))
				{
					$result = array('status'=>0,'message'=>'You have already reported this Crime');

					
				}
				else
				{
					$update_report=$this->report_model->addData('vigilant_reported_crime',$data);

					$result = array('status'=>1,'message'=>'Reporting of the crime is success');	
				}

				
			}
			else
			{
				$result = array('status'=>0,'message'=>'No record Found','result'=>array());
			}		
	 	}
	 	else
	 	{
	 		$result = array('status'=>0,'message'=>'Parameter Missing','result'=>array());
	 	}

	 	echo json_encode($result);

	}


}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
