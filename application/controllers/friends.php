<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

error_reporting(E_ALL);
ini_set("display_errors", 1);


class Friends extends CI_Controller {

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
		$this->load->helper('common_helper');
		$this->obj = new stdClass();
		// Load form validation library
		$this->load->library('form_validation');
		$this->load->model("friend_model");
		$this->load->model("api_model");
			
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function send_request()
	{
		$receiver_id = $this->input->post('receiver_id');

		$sender_id = $this->input->post('sender_id');

		if(!empty($receiver_id) && !empty($sender_id))
		{
			$data['receiver_id'] = $receiver_id;

			$data['sender_id'] = $sender_id;

			$data['is_request'] = 1;

			$data['req_date'] = date("Y-m-d H:i:s");

			//$where = array('receiver_id'=>$receiver_id,'sender_id'=>$sender_id);

			$getfriendReq = $this->friend_model->get_friend_requests('vigilant_user_friend_req',$receiver_id,$sender_id);

			//print_r($getfriendReq);exit;

			if(empty($getfriendReq))
			{
					$insertid = $this->friend_model->addData('vigilant_user_friend_req',$data);	

					if(!empty($insertid))
					{

						$result = array('status'=>1,'message'=>'Friend Request Sent successfully');

					}
					else
					{
						$result = array('status'=>0,'message'=>'Server error');
					}

			}
			else
			{
				if(($getfriendReq->is_reject)==1)
				{
					$where = array('receiver_id'=>$receiver_id,'sender_id'=>$sender_id);

					$value = array('is_request'=>1,'is_accept'=>0,'is_reject'=>0);

					$updt = $this->friend_model->updateData('vigilant_user_friend_req',$where,$value);	

					if($updt)
					{

						$result = array('status'=>1,'message'=>'Friend Request Sent successfully');

					}
					else
					{
						$result = array('status'=>0,'message'=>'Server error');
					}
				}
				else
				{
					$result = array('status'=>0,'message'=>'Friend Request already Sent.');
				}
				
			}
			
		}
		else{

			$result = array('status'=>0,'message'=>'parameter missing');
		}
		echo json_encode($result);		
	}

   
	public function friend_list()
	{
		
		$userid = $this->input->post('user_id');
	 	
	 	if(!empty($userid))
		{
			//$where = array('receiver_id' => $userid,'is_accept'=>1);

			$get_friend_lists = $this->friend_model->get_friend_lists('vigilant_user_friend_req',$userid);

			//print_r($get_post_details);exit;

			if(!empty($get_friend_lists))
			{

				$result = array('status'=>1,'message'=>'success','result'=>$get_friend_lists);
			}
			else
			{
				$result = array('status'=>0,'message'=>'No record found','result'=>array());
			}		
	 	}
	 	else
	 	{
	 		$result = array('status'=>0,'message'=>'Parameter Missing','result'=>array());
	 	}

	 	echo json_encode($result);

	}

	public function blocked_friend_list()
	{
		
		$userid = $this->input->post('user_id');
	 	
	 	if(!empty($userid))
		{
			//$where = array('receiver_id' => $userid,'is_accept'=>1);

			$get_blocked_friend_lists = $this->friend_model->get_blocked_friend_lists('vigilant_user_friend_req',$userid);

			//print_r($get_post_details);exit;

			if(!empty($get_blocked_friend_lists))
			{

				$result = array('status'=>1,'message'=>'success','result'=>$get_blocked_friend_lists);
			}
			else
			{
				$result = array('status'=>0,'message'=>'No record found','result'=>array());
			}		
	 	}
	 	else
	 	{
	 		$result = array('status'=>0,'message'=>'Parameter Missing','result'=>array());
	 	}

	 	echo json_encode($result);

	}

	public function friend_request_list()
	{
		
		$userid = $this->input->post('user_id');
	 	
	 	if(!empty($userid))
		{
			$where = array('receiver_id' => $userid,'is_request'=>1);

			$get_request_friend_lists = $this->friend_model->get_request_friend_lists('vigilant_user_friend_req',$where);


			if(!empty($get_request_friend_lists))
			{

				$result = array('status'=>1,'message'=>'success','result'=>$get_request_friend_lists);
			}
			else
			{
				$result = array('status'=>0,'message'=>'No record found','result'=>array());
			}		
	 	}
	 	else
	 	{
	 		$result = array('status'=>0,'message'=>'Parameter Missing','result'=>array());
	 	}

	 	echo json_encode($result);

	}

	public function friend_request_count()
	{
		
		$userid = $this->input->post('user_id');
	 	
	 	if(!empty($userid))
		{
			$where = array('receiver_id' => $userid,'is_request'=>1);

			$get_friend_lists = $this->friend_model->get_request_friend_lists('vigilant_user_friend_req',$where);
			

			$count_request =  count($get_friend_lists);

			if($count_request>0)
			{

				$result = array('status'=>1,'message'=>'success','result'=>$count_request);
			}
			else
			{
				$result = array('status'=>0,'message'=>'No record found','result'=>0);
			}		
	 	}
	 	else
	 	{
	 		$result = array('status'=>0,'message'=>'Parameter Missing','result'=>0);
	 	}

	 	echo json_encode($result);

	}

	public function search_friend()
	{

		$username = $this->input->post('username');

		$userid = !empty($this->input->post('user_id'))?($this->input->post('user_id')):'';
	 	
	 	if(!empty($username))
		{
			//$where = array('post_id' => $post_id);

			$data['get_friend_details'] = $this->friend_model->get_search_friend_list('vigilant_user',$username,$userid);

			//print_r($get_post_details);exit;

			if(!empty($data['get_friend_details']))
			{

				$result = array('status'=>1,'message'=>'success','result'=>$data['get_friend_details']);
			}
			else
			{
				$result = array('status'=>0,'message'=>'No records found','result'=>array());
			}		
	 	}
	 	else
	 	{
	 		$result = array('status'=>0,'message'=>'Parameter Missing','result'=>array());
	 	}

	 	echo json_encode($result);

	}

	public function search_user_friend()
	{

		$username = $this->input->post('username');

		$userid = !empty($this->input->post('user_id'))?($this->input->post('user_id')):'';
	 	
	 	if(!empty($username))
		{
			//$where = array('post_id' => $post_id);

			$data['get_friend_details'] = $this->friend_model->get_search_user_friend_list('vigilant_user',$username,$userid);

			//print_r($get_post_details);exit;

			if(!empty($data['get_friend_details']))
			{

				$result = array('status'=>1,'message'=>'success','result'=>$data['get_friend_details']);
			}
			else
			{
				$result = array('status'=>0,'message'=>'No records found','result'=>array());
			}		
	 	}
	 	else
	 	{
	 		$result = array('status'=>0,'message'=>'Parameter Missing','result'=>array());
	 	}

	 	echo json_encode($result);

	}

	public function accept_reject_request()
	{

		$receiver_id = $this->input->post('user_id');

		$sender_id = $this->input->post('friend_id');

		$is_accept = $this->input->post('accept_request');
	 	

		if(!empty($receiver_id) && !empty($sender_id) && !empty($is_accept))
		{

				$where = array('receiver_id'=>$receiver_id,'sender_id'=>$sender_id);

				$getReq = $this->friend_model->getRow('vigilant_user_friend_req',$where);

				if(!empty($getReq))
				{
					if($is_accept == 'yes')
					{
						$data['is_request'] = 0;

						$data['is_accept'] = 1;

						$accptReq = $this->friend_model->updateData('vigilant_user_friend_req',$where,$data);

						if($accptReq)
						{
							$result = array('status'=>1,'message'=>'Friend Request accepted');
						}
						else
						{
							$result = array('status'=>0,'message'=>'Server error');
						}
					}

					if($is_accept == 'no')
					{

						$data['is_request'] = 0;

						$data['is_reject'] = 1;

						$where = array('receiver_id'=>$receiver_id,'sender_id'=>$sender_id);

						$accptReq = $this->friend_model->updateData('vigilant_user_friend_req',$where,$data);

						if($accptReq)
						{
							$result = array('status'=>1,'message'=>'Friend Request rejected');
						}
						else
						{
							$result = array('status'=>0,'message'=>'Server error');
						}
					}
				}
				else
				{
						$result = array('status'=>0,'message'=>'Server error');
				}

		}
		else{

			$result = array('status'=>0,'message'=>'parameter missing');
		}
		echo json_encode($result);
	}

	public function blocked_friend()
	{

		$receiver_id = $this->input->post('user_id');

		$sender_id = $this->input->post('friend_id');
	 	

		if(!empty($receiver_id) && !empty($sender_id))
		{

				$get_friend = $this->friend_model->get_friend('vigilant_user_friend_req',$receiver_id,$sender_id);

				//print_r($get_friend);exit;

				if(!empty($get_friend))
				{
					
						$blockedFriend = $this->friend_model->Blocked_friend('vigilant_user_friend_req',$receiver_id,$sender_id);

						if($blockedFriend)
						{
							$BlockedFriend = $this->api_model->get_blocked_freiend_lists('vigilant_user_friend_req',$receiver_id);

							if(!empty($BlockedFriend))
							{
								$BlockedFriendArray = call_user_func_array('array_merge', $BlockedFriend);
							}
							else
							{
								$BlockedFriendArray = array();
							}

							//print_r($BlockedFriendArray);
							//$BlockedUsers = $BlockedUserArray;

							$BlockedUser = $this->api_model->get_blocked_user_lists('vigilant_blocked_user',$receiver_id);

							//print_r($BlockedUser);exit;

							if(!empty($BlockedUser))
							{
								$BlockedUserArray = call_user_func_array('array_merge', $BlockedUser);
							}
							else
							{
								$BlockedUserArray = array();
							}



							if(!empty($BlockedFriendArray) && empty($BlockedUserArray))
							{
								$BlockedUsers = $BlockedFriendArray;
							}
							else if(empty($BlockedFriendArray) && !empty($BlockedUserArray))
							{
								$BlockedUsers = $BlockedUserArray;
							}
							else if(!empty($BlockedFriendArray) && !empty($BlockedUserArray))
							{
								$BlockedUsers =  array_merge($BlockedFriendArray, $BlockedUserArray);
							}
							else
							{
								$BlockedUsers = array();
							}

							$result = array('status'=>1,'message'=>'Friend is blocked succesfully','BlockedUsers'=> $BlockedUsers);
						}
						else
						{
							$result = array('status'=>0,'message'=>'Server error','result'=> array());
						}
					
				}
				else
				{
						$result = array('status'=>0,'message'=>'User not in friend lists','result'=> array());
				}

		}
		else{

			$result = array('status'=>0,'message'=>'parameter missing','result'=> array());
		}
		echo json_encode($result);
	}

	public function unblocked_friend()
	{

		$receiver_id = $this->input->post('user_id');

		$sender_id = $this->input->post('friend_id');
	 	

		if(!empty($receiver_id) && !empty($sender_id))
		{
			
					
					$unblockedFriend = $this->friend_model->Unblocked_friend('vigilant_user_friend_req',$receiver_id,$sender_id);

					if($unblockedFriend)
					{
						$BlockedFriend = $this->api_model->get_blocked_freiend_lists('vigilant_user_friend_req',$receiver_id);

						if(!empty($BlockedFriend))
						{
							$BlockedFriendArray = call_user_func_array('array_merge', $BlockedFriend);
						}
						else
						{
							$BlockedFriendArray = array();
						}

						//print_r($BlockedFriendArray);exit;

						//$BlockedUsers = $BlockedUserArray;

						$BlockedUser = $this->api_model->get_blocked_user_lists('vigilant_blocked_user',$receiver_id);

						//print_r($BlockedUser);exit;

						if(!empty($BlockedUser))
						{
							$BlockedUserArray = call_user_func_array('array_merge', $BlockedUser);
						}
						else
						{
							$BlockedUserArray = array();
						}

						if(!empty($BlockedFriendArray) && empty($BlockedUserArray))
						{
							$BlockedUsers = $BlockedFriendArray;
						}
						else if(empty($BlockedFriendArray) && !empty($BlockedUserArray))
						{
							$BlockedUsers = $BlockedUserArray;
						}
						else if(!empty($BlockedFriendArray) && !empty($BlockedUserArray))
						{
							$BlockedUsers =  array_merge($BlockedFriendArray, $BlockedUserArray);
						}
						else
						{
							$BlockedUsers = array();
						}


						$result = array('status'=>1,'message'=>'Friend is unblocked succesfully','BlockedUsers'=> $BlockedUsers);
					}
					else
					{
						$result = array('status'=>0,'message'=>'You can not unblocked this user.','result'=> array());
					}
		

		}
		else{

			$result = array('status'=>0,'message'=>'parameter missing','result'=> array());
		}
		echo json_encode($result);
	}


	public function blocked_user()
	{
		$userid = $this->input->post('user_id');

		$Blocked_qb_id = $this->input->post('qb_id');

		if (!empty($userid) && !empty($Blocked_qb_id))
		{	
				$where = array('q_userid'=>$Blocked_qb_id);

				if($get_user_by_qb_id = $this->friend_model->getRow('vigilant_user',$where))
				{

				//echo $get_user_by_qb_id->user_id;exit;
				$blocked_user_id =  $get_user_by_qb_id->user_id;

				$where =  array('user_id'=>$userid,'blocked_user'=>$blocked_user_id,'is_blocked'=>1);

				$get_blocked_user = $this->friend_model->getRow('vigilant_blocked_user',$where);
				
				if(empty($get_blocked_user))
				{
					$data1 =  array('user_id'=>$userid,'blocked_user'=>$blocked_user_id,'is_blocked'=>1);

					$AddblockedUser1 = $this->friend_model->addData('vigilant_blocked_user',$data1);

					$data2 =  array('user_id'=>$blocked_user_id,'blocked_user'=>$userid,'is_blocked'=>1);

					$AddblockedUser2 = $this->friend_model->addData('vigilant_blocked_user',$data2);


					if(!empty($AddblockedUser1) && !empty($AddblockedUser2))
					{
						$BlockedFriend = $this->api_model->get_blocked_freiend_lists('vigilant_user_friend_req',$userid);

						if(!empty($BlockedFriend))
						{
							$BlockedFriendArray = call_user_func_array('array_merge', $BlockedFriend);
						}
						else
						{
							$BlockedFriendArray = array();
						}

						//print_r($BlockedFriendArray);exit;

						//$BlockedUsers = $BlockedUserArray;

						$BlockedUser = $this->api_model->get_blocked_user_lists('vigilant_blocked_user',$userid);

						//print_r($BlockedUser);exit;

						if(!empty($BlockedUser))
						{
							$BlockedUserArray = call_user_func_array('array_merge', $BlockedUser);
						}
						else
						{
							$BlockedUserArray = array();
						}

						if(!empty($BlockedFriendArray) && empty($BlockedUserArray))
						{
							$BlockedUsers = $BlockedFriendArray;
						}
						else if(empty($BlockedFriendArray) && !empty($BlockedUserArray))
						{
							$BlockedUsers = $BlockedUserArray;
						}
						else if(!empty($BlockedFriendArray) && !empty($BlockedUserArray))
						{
							$BlockedUsers =  array_merge($BlockedFriendArray, $BlockedUserArray);
						}
						else
						{
							$BlockedUsers = array();
						}

						//print_r($BlockedUsers);exit;

						if(!empty($BlockedUsers))
						{

							$result = array('status'=>1,'message'=>'User Blocked is successfull','BlockedUsers'=> $BlockedUsers);
						}
						else
						{
							$result = array('status'=>0,'message'=>'No record found','result'=> $this->obj);
						}
					}
					else
					{
						$result = array('status'=>0,'message'=>'server error','result'=> $this->obj);
					}
				}
				else
				{
					$result = array('status'=>0,'message'=>'User already in blocked list','result'=> $this->obj);
				}
			}
			else
			{
				$result = array('status'=>0,'message'=>'No such QB User Found.','result'=> $this->obj);
			}

		}
		else
		{
			$result = array('status'=>0,'message'=>'parameter missing.');
		}	

		echo json_encode($result);

	}

	public function unblocked_user()
	{
		$userid = $this->input->post('user_id');

		$Blocked_qb_id = $this->input->post('qb_id');

		if (!empty($userid) && !empty($Blocked_qb_id))
		{	
			$where = array('q_userid'=>$Blocked_qb_id);

			if($get_user_by_qb_id = $this->friend_model->getRow('vigilant_user',$where))
			{

			//echo $get_user_by_qb_id->user_id;exit;
			$blocked_user_id =  $get_user_by_qb_id->user_id;

			$where =  array('user_id'=>$userid,'blocked_user'=>$blocked_user_id,'is_blocked'=>1);

			$get_blocked_user1 = $this->friend_model->getRow('vigilant_blocked_user',$where);

			$where =  array('user_id'=>$blocked_user_id,'blocked_user'=>$userid,'is_blocked'=>1);

			$get_blocked_user2 = $this->friend_model->getRow('vigilant_blocked_user',$where);
			
			if(!empty($get_blocked_user1) || !empty($get_blocked_user2))
			{
				//$where =  array('user_id'=>$userid,'blocked_user'=>$blocked_user_id,'is_blocked'=>1);

				if($unblockedUser = $this->friend_model->Unblocked_user('vigilant_blocked_user',$userid,$blocked_user_id))
				{
					$BlockedFriend = $this->api_model->get_blocked_freiend_lists('vigilant_user_friend_req',$userid);

					if(!empty($BlockedFriend))
					{
						$BlockedFriendArray = call_user_func_array('array_merge', $BlockedFriend);
					}
					else
					{
						$BlockedFriendArray = array();
					}

					//print_r($BlockedFriendArray);exit;

					//$BlockedUsers = $BlockedUserArray;

					$BlockedUser = $this->api_model->get_blocked_user_lists('vigilant_blocked_user',$userid);

					//print_r($BlockedUser);exit;

					if(!empty($BlockedUser))
					{
						$BlockedUserArray = call_user_func_array('array_merge', $BlockedUser);
					}
					else
					{
						$BlockedUserArray = array();
					}

					if(!empty($BlockedFriendArray) && empty($BlockedUserArray))
					{
						$BlockedUsers = $BlockedFriendArray;
					}
					else if(empty($BlockedFriendArray) && !empty($BlockedUserArray))
					{
						$BlockedUsers = $BlockedUserArray;
					}
					else if(!empty($BlockedFriendArray) && !empty($BlockedUserArray))
					{
						$BlockedUsers =  array_merge($BlockedFriendArray, $BlockedUserArray);
					}
					else
					{
						$BlockedUsers = array();
					}

					//print_r($BlockedUsers);exit;

					if(!empty($BlockedUsers))
					{

						$result = array('status'=>1,'message'=>'User Unblocked is successfull','BlockedUsers'=> $BlockedUsers);
					}
					else
					{
						$result = array('status'=>0,'message'=>'No record found','result'=> $this->obj);
					}
				}
				else
				{
					$result = array('status'=>0,'message'=>'You can not unblocked this user.','result'=> $this->obj);
				}
			}
			else
			{
				$result = array('status'=>0,'message'=>'You can not unblocked this user.','result'=> $this->obj);
			}
			
			}
			else
			{
				$result = array('status'=>0,'message'=>'NO such QB User found.','result'=> $this->obj);
			}
		}
		else
		{
			$result = array('status'=>0,'message'=>'parameter missing.');
		}	

		echo json_encode($result);

	}


}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
