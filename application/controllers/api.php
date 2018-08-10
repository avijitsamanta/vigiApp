<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

error_reporting(E_ALL);
ini_set("display_errors", 1);


class Api extends CI_Controller {

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
		$this->load->model("api_model");
		$this->load->model("report_model");
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");
		header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
			
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function checkusername()
	{
	    if(isset($_POST['username']) && !empty($_POST['username']) )
	    { 
	    	 $user_name =  $_POST['username'];
		  
			 $result = mysql_query("SELECT * FROM vigilant_user where username = '".$user_name."'");

		     $records = array();

			if(mysql_num_rows($result)) 
			{

			/*$records[] = array('message'=>'Username already exist!!!' ,'status'=>'1');*/
				$records['message']='Username already exist!!!' ;
				$records['status'] = '0' ;

			}
			else
			{
				$records['message']='Username Available.' ;	
				$records['status'] = '1' ;    
			} 
	 

	    }
	   	 header('Content-type: application/json');
		    echo json_encode($records);

	}

  /*public function signin()
  {
     //print_r($_POST);
  	if(isset($_POST['email']) && !empty($_POST['email']) &&  isset($_POST['password']) && !empty($_POST['password'])){  //required arguments
        $useremail =  $_POST['email'];
		$user_password =  md5($_POST['password']);
        //$devicetoken =  $_POST['devicetoken']);

        $where = array(
					'email'=>$useremail,
					'password'=>$user_password
					);

        	$updatelogin = $this->api_model->updateData('vigilant_user',$where,array('login_status'=>'1'));	
         
		 $query = "SELECT user_id, username, email , mobile_no as phoneno,login_status FROM vigilant_user where email = '".$useremail."' and 	password = '".$user_password."'  " ;
		
        $result = mysql_query($query);
        $records = array();
        if(mysql_num_rows($result)) {

        	

            //$records[] = array('message'=>'User Logged in successfully' ,'status'=>'1');
            $records['message'] = "User Logged in successfully" ;
            $records['status'] = "1" ;
            while($record = mysql_fetch_assoc($result)) {
                $records['userdetails'] = $record ;
            }
        }else{
            //$records[] = array('message'=>'Wrong Username/Password');
			$records['message'] = "The username/password you entered is incorrect. Please try again." ;
            $records['title'] = "Incorrect username or password" ;

            $records['status'] = "0" ;
			
        }
         header('Content-type: application/json');
            echo json_encode($records);
       
    }
  }*/

  public function signin()
  {
     //print_r($_POST);
  	if(isset($_POST['email']) && !empty($_POST['email']) &&  isset($_POST['password']) && !empty($_POST['password'])){  
  		//required arguments
        $useremail =  $_POST['email'];

		$user_password =  md5($_POST['password']);

		$device_type = !empty($_POST['device_type'])?($_POST['device_type']):'';

		$device_token = !empty($_POST['device_token'])?($_POST['device_token']):'';

		$where = array(
			'email'=>$useremail,
			'password'=>$user_password
			);

        //$devicetoken =  $_POST['devicetoken']);
		$data['users'] = $this->api_model->getRow('vigilant_user',$where);	

		if(!empty($data['users']))
		{
			
				//print_r($quickUser);exit;

			
			$where = array(
			'email'=>$useremail,
			'password'=>$user_password
			);

			$data['updatelogin'] = $this->api_model->updateData('vigilant_user',$where,array('login_status'=>'1'));	

			$data['userdetails'] = $this->api_model->getUserDetails('vigilant_user',$where);


			$where = array('user_id' => $data['userdetails']->user_id,'device_type'=>$device_type);

			$data['deviceDetails'] = $this->api_model->getRow('vigilant_device_details',$where);

			$BlockedFriend = $this->api_model->get_blocked_freiend_lists('vigilant_user_friend_req',$data['userdetails']->user_id);

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

			$BlockedUser = $this->api_model->get_blocked_user_lists('vigilant_blocked_user',$data['userdetails']->user_id);

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

			$data['userdetails']->BlockedUsers = $BlockedUsers;
		
			$tokenAuth = quickAuth();

			//echo $data['userdetails']->q_userid;exit;

			if(!empty($data['userdetails']->q_userid))
			{
				//echo "hi";

				$quickUser =  @quickGetUserbyId($tokenAuth->session->token,$data['userdetails']->q_userid);

				//print_r($quickUser);exit;

				if(!empty($quickUser))
				{
					$data['userdetails']->QBUser = $quickUser->user;
				}
				else{
					$data['userdetails']->QBUser = "";
				}

			}
			else
			{
				$quickGetUsersByemail = @quickGetUsersbyEmail($tokenAuth->session->token,$useremail);
					//print_r($quickGetUsersByemail);exit;
					if(!empty($quickGetUsersByemail))
					{
						$q_userid = $quickGetUsersByemail->user->id;

						$where = array('user_id'=>$userid);

						$data['updateQuid'] = $this->api_model->updateData('vigilant_user',$where,array('q_userid'=>$q_userid));
						if($data['updateQuid'])
						{
							$data['userdetails'] = $this->api_model->getUserDetails('vigilant_user',$where);


							$quickUser =  @quickGetUserbyId($tokenAuth->session->token,$data['userdetails']->q_userid);

							//print_r($quickUser);exit;

							if(!empty($quickUser))
							{
								$data['userdetails']->QBUser = $quickUser->user;
							}
							else{
								$data['userdetails']->QBUser = "";
							}
						
						}
					}
					else
					{
						$data['userdetails']->QBUser = "";
					}

			}

				


			if(!empty($data['deviceDetails']))
			{
				$value = array('device_token'=>$device_token);

				$device_id = $this->api_model->updateData('vigilant_device_details',$where,$value);
			}
			else
			{
				$value = array('user_id'=>$data['userdetails']->user_id,'device_type'=>$device_type,'device_token'=>$device_token);

				$device_id = $this->api_model->addData('vigilant_device_details',$value);
			}

			$records = array('status'=>1,'message'=>'User successfully logged in.','userdetails'=>$data['userdetails']);
    	}
        else
        {
            //$records[] = array('message'=>'Wrong Username/Password');
			$records = array('status'=>0,'message'=>'Invalid Credential');
			
        }
         header('Content-type: application/json');
            echo json_encode($records);
       
    }
  }


// THIRD PARTY LOGIN

  public function third_party_login()
  {
  	$tokenAuth = quickAuth();

    $email = !empty($_POST['email']) ? $_POST['email']:'';
    //$third_party_id =  $_POST['third_party_id'];

	$device_type = !empty($_POST['device_type'])?($_POST['device_type']):'';

	$device_token = !empty($_POST['device_token'])?($_POST['device_token']):'';
   
    $records = array();

    if(isset($email) && !empty($email) ){  //required arguments
         
        $where = array(
			'email'=>$email
			);
     
        if($result = $this->api_model->getRow('vigilant_user',$where)) {

            //$third_party_id =  $_POST['third_party_id'];
            //$third_party_type =  $_POST['third_party_type'];
				$data['updatelogin'] = $this->api_model->updateData('vigilant_user',$where,array('login_status'=>'1'));	

				$data['userdetails'] = $this->api_model->getUserDetails('vigilant_user',$where);


				$where = array('user_id' => $data['userdetails']->user_id,'device_type'=>$device_type);

				$data['deviceDetails'] = $this->api_model->getRow('vigilant_device_details',$where);
				

				//echo $data['userdetails']->q_userid;exit;

				if(!empty($data['userdetails']->q_userid))
				{
					//echo "hi";

					if(!empty($data['userdetails']->profileimage))
					{
						$profile_image_url = $data['userdetails']->profile_image_url;

						$upd_body1 = array(
						'user[website]' 	=> 	$profile_image_url
						);

						$qBUSER=@quickUpdateUserbyId($tokenAuth->session->token,$data['userdetails']->q_userid,$upd_body1);
					}

					$quickUser =  @quickGetUserbyId($tokenAuth->session->token,$data['userdetails']->q_userid);

					//print_r($quickUser);exit;

					if(!empty($quickUser))
					{
						$data['userdetails']->QBUser = $quickUser->user;
					}
					else{
						$data['userdetails']->QBUser = "";
					}

				}
				else
				{
					$quickGetUsersByemail = @quickGetUsersbyEmail($tokenAuth->session->token,$email);
					//print_r($quickGetUsersByemail);exit;
					if(!empty($quickGetUsersByemail))
					{
						$q_userid = $quickGetUsersByemail->user->id;

						$where = array('user_id'=>$userid);

						$data['updateQuid'] = $this->api_model->updateData('vigilant_user',$where,array('q_userid'=>$q_userid));
						if($data['updateQuid'])
						{
							$data['userdetails'] = $this->api_model->getUserDetails('vigilant_user',$where);


							$quickUser =  @quickGetUserbyId($tokenAuth->session->token,$data['userdetails']->q_userid);

							//print_r($quickUser);exit;

							if(!empty($quickUser))
							{
								$data['userdetails']->QBUser = $quickUser->user;
							}
							else{
								$data['userdetails']->QBUser = "";
							}
						
						}
					}
					else
					{
						$data['userdetails']->QBUser = "";
					}

				}

				if(!empty($data['deviceDetails']))
				{
					$value = array('device_token'=>$device_token);

					$device_id = $this->api_model->updateData('vigilant_device_details',$where,$value);
				}
				else
				{
					$value = array('user_id'=>$data['userdetails']->user_id,'device_type'=>$device_type,'device_token'=>$device_token);

					$device_id = $this->api_model->addData('vigilant_device_details',$value);
				}

				$BlockedFriend = $this->api_model->get_blocked_freiend_lists('vigilant_user_friend_req',$data['userdetails']->user_id);

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

				$BlockedUser = $this->api_model->get_blocked_user_lists('vigilant_blocked_user',$data['userdetails']->user_id);

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

				$data['userdetails']->BlockedUsers = $BlockedUsers;

				$records = array('status'=>1,'message'=>'User successfully logged in.','userdetails'=>$data['userdetails']);
           
        }else{

              $data['third_party_id'] = $third_party_id =  !empty($_POST['third_party_id']) ? ($_POST['third_party_id']):'';

		        $data['first_name'] = $first_name = !empty($_POST['first_name'])?$_POST['first_name']:'';

				$data['last_name'] = $last_name = !empty($_POST['last_name'])?$_POST['last_name']:'';

              $data['username']=$third_party_user = !empty($_POST['username']) ? $_POST['username']:'';

              $data['email']=$third_party_email = !empty($_POST['email']) ? $_POST['email']:'';

              $data['mobile_no']=$third_party_mobile = !empty($_POST['phone']) ? $_POST['phone']:'';

              $data['profileimage'] = !empty($_POST['profileimage']) ? $_POST['profileimage']:'';

              $data['date_added'] = date("Y-m-d H:i:s");

			$post_body = array(
				'user[login]' 		=> 	$email,
				'user[password]' 	=> 	12345678,
				'user[email]' 		=> 	$email,
				'user[full_name]'	=>	$first_name." ".$last_name
			);

			$tokenAuth = quickAuth();

			$quickAddUser =  @quickAddUsers($tokenAuth->session->token,$post_body);

			if(empty($quickAddUser->errors))
			{
				$data['q_userid'] = $quickAddUser->user->id;
			}

			$userid = $this->api_model->addData('vigilant_user',$data);

			if($userid)
			{
					// set default notification data

					$where = array();

					$crime_type_ids_arr = $this->report_model->getCrimeTypeIds('vigilant_crime_type',$where);

					if(!empty($crime_type_ids_arr))
					{
					$all_crime_type_ids = implode(',',$crime_type_ids_arr);
					}


					$noti_data['user_id'] = $userid ;

					$noti_data['crime_type']	= $crime_type_ids = $all_crime_type_ids;

					$noti_data['distance']	= $distance = 1;


					$where = array('user_id'=>$userid);

					$getResults =  $this->report_model->getRow('vigilant_notification_data',$where);

					//print_r($getResults);exit;

					if(empty($getResults))
					{
					$instData = $this->report_model->addData('vigilant_notification_data',$noti_data);
					}
					else
					{
					$where = array('user_id'=>$userid);

					$noti_data1['crime_type'] = $crime_type_ids;

					$noti_data1['distance']	= $distance;

					$instData = $this->report_model->updateData('vigilant_notification_data',$where,$noti_data1);
					}	


				$where = array('user_id'=>$userid);

				$data['updatelogin'] = $this->api_model->updateData('vigilant_user',$where,array('login_status'=>'1'));	

				$data['userdetails'] = $this->api_model->getUserDetails('vigilant_user',$where);


				$where = array('user_id' => $data['userdetails']->user_id,'device_type'=>$device_type);

				$data['deviceDetails'] = $this->api_model->getRow('vigilant_device_details',$where);

				if(!empty($data['userdetails']->q_userid))
				{
					//echo "hi";

					if(!empty($data['userdetails']->profileimage))
					{
						$profile_image_url = $data['userdetails']->profile_image_url;

						$upd_body1 = array(
						'user[website]' 	=> 	$profile_image_url
						);

						$qBUSER=@quickUpdateUserbyId($tokenAuth->session->token,$data['userdetails']->q_userid,$upd_body1);
					}
					

					$quickUser =  @quickGetUserbyId($tokenAuth->session->token,$data['userdetails']->q_userid);

					//print_r($quickUser);exit;

					if(!empty($quickUser))
					{
						$data['userdetails']->QBUser = $quickUser->user;
					}
					else{
						$data['userdetails']->QBUser = "";
					}

				}
				else
				{
					$quickGetUsersByemail = @quickGetUsersbyEmail($tokenAuth->session->token,$third_party_email);
					//print_r($quickGetUsersByemail);exit;
					if(!empty($quickGetUsersByemail))
					{
						$q_userid = $quickGetUsersByemail->user->id;

						$where = array('user_id'=>$userid);

						$data['updateQuid'] = $this->api_model->updateData('vigilant_user',$where,array('q_userid'=>$q_userid));
						if($data['updateQuid'])
						{
							$data['userdetails'] = $this->api_model->getUserDetails('vigilant_user',$where);


							$quickUser =  @quickGetUserbyId($tokenAuth->session->token,$data['userdetails']->q_userid);

							//print_r($quickUser);exit;

							if(!empty($quickUser))
							{
								$data['userdetails']->QBUser = $quickUser->user;
							}
							else{
								$data['userdetails']->QBUser = "";
							}
						
						}
					}
					else
					{
						$data['userdetails']->QBUser = "";
					}

					
				}

				if(!empty($data['deviceDetails']))
				{
					$value = array('device_token'=>$device_token);

					$device_id = $this->api_model->updateData('vigilant_device_details',$where,$value);
				}
				else
				{
					$value = array('user_id'=>$data['userdetails']->user_id,'device_type'=>$device_type,'device_token'=>$device_token);

					$device_id = $this->api_model->addData('vigilant_device_details',$value);
				}

				$BlockedFriend = $this->api_model->get_blocked_freiend_lists('vigilant_user_friend_req',$data['userdetails']->user_id);

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

			$BlockedUser = $this->api_model->get_blocked_user_lists('vigilant_blocked_user',$data['userdetails']->user_id);

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

			$data['userdetails']->BlockedUsers = $BlockedUsers;

				$records = array('status'=>1,'message'=>'User successfully logged in.','userdetails'=>$data['userdetails']);
			}
			else
			{
				$records = array('status'=>0,'message'=>'User Login Fail');
			}
      
        }
       
    }
    else
    {
        $records['message'] = 'parameter missing' ;
        $records['status'] = '0' ;
    } 

     echo json_encode($records);
  }

  public function signup()
  {
	//echo "sdfsf";exit;
       if(isset($_POST['username']) && !empty($_POST['username']) &&  isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['email']) && !empty($_POST['email']) )
    { 
		$user_name =  $_POST['username'];

		$user_password =  $_POST['password'];

		$user_email =  $_POST['email'];

	 	$phoneno =  !empty($_POST['phoneno'])?$_POST['phoneno']:'';

        $first_name = !empty($_POST['first_name'])?$_POST['first_name']:'';

		$last_name = !empty($_POST['last_name'])?$_POST['last_name']:'';

		$cur_date = date("Y-m-d H:i:s");

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
					$profileimage = $upload_image;
					$upload_path = $folder;
            	}
            }else{
                $profileimage = '';
                $upload_path = '';
            }
       		
       		
            	$post_body = array(
					    'user[login]' 		=> 	$user_email,
					    'user[password]' 	=> 	12345678,
					    'user[email]' 		=> 	$user_email,
					    'user[full_name]'	=>	$first_name." ".$last_name
					);

            	$tokenAuth = quickAuth();

				$quickAddUser =  @quickAddUsers($tokenAuth->session->token,$post_body);

				//print_r($quickAddUser);exit;

				//echo $quickAddUser->user->id;exit;


				if(empty($quickAddUser->errors))
				{

	            	$data = array(
	            				'q_userid'		=>	$quickAddUser->user->id,
								'first_name'	=>	$first_name,
								'last_name'		=>	$last_name,
								'username'		=>	addslashes($user_name),
								'password'		=>	md5($user_password),
								'fp'			=>	$user_password,
								'email'			=>	$user_email,
								'mobile_no'		=>	$phoneno,
								'profileimage' 	=> $profileimage,
								'upload_path' 	=> $upload_path,
								'date_added' 	=> $cur_date
								);
	            	$where = array('email' => $user_email);
	            	
					$getemails = $this->api_model->getRow('vigilant_user',$where);

					if(!empty($getemails))
					{
						$records = array('status'=>0,'message'=>'Email already exist.');
					}
					else
					{

						$userid = $this->api_model->addData('vigilant_user',$data);


						if($userid)
						{
							// set default notification data

							$where = array();

							$crime_type_ids_arr = $this->report_model->getCrimeTypeIds('vigilant_crime_type',$where);

							if(!empty($crime_type_ids_arr))
							{
								$all_crime_type_ids = implode(',',$crime_type_ids_arr);
							}


							$noti_data['user_id'] = $userid ;

							$noti_data['crime_type']	= $crime_type_ids = $all_crime_type_ids;

							$noti_data['distance']	= $distance = 1;

							
							$where = array('user_id'=>$userid);

							$getResults =  $this->report_model->getRow('vigilant_notification_data',$where);

							//print_r($getResults);exit;

							if(empty($getResults))
							{
								$instData = $this->report_model->addData('vigilant_notification_data',$noti_data);
							}
							else
							{
								$where = array('user_id'=>$userid);

								$noti_data1['crime_type'] = $crime_type_ids;

								$noti_data1['distance']	= $distance;

								$instData = $this->report_model->updateData('vigilant_notification_data',$where,$noti_data1);
							}	


							$records = array('status'=>1,'message'=>'User successfully registered');
						}
						else
						{
							$records = array('status'=>0,'message'=>'error in database insertion');	
						}
	            	}
             	}
             	else
				{
					//print_r($quickAddUser);exit;

					if(!empty($quickAddUser->errors->email))
					{
						$records = array('status'=>0,'message'=>'Email '.$quickAddUser->errors->email[0],'result'=> $this->obj);
					}
					else if(!empty($quickAddUser->errors->password))
					{
						$records = array('status'=>0,'message'=>'Password is too short (minimum is 8 characters)','result'=> $this->obj);
					}
					else
					{
						$records = array('status'=>0,'message'=>'error in quickblox insertion.','result'=> $this->obj);
					}
				}  

        } 
   
		else 
		{
			$records = array('status'=>0,'message'=>'parameter missing');
				
		}	

     header('Content-type: application/json');
            echo json_encode($records);
    }

public function forgotpassword()
   {
     if(isset($_POST['email']) && !empty($_POST['email']))
       {
	       	$user_email =  $_POST['email']; 
	        $query = "SELECT * FROM vigilant_user where email = '".$user_email."'" ;
		    $result = mysql_query($query) or die(mysql_error());
	        $records = array();
	        if(mysql_num_rows($result)) 
			{
				while($record = mysql_fetch_array($result)) 
				 {
                             $name = $record['username'] ;
		                     $emailto = $record['email'] ;
		                     $freashpassword = $record['fp'];
		                     $third_party_id = $record['third_party_id'];
		                    
		                      
                 }

                
                /* $message = '<html>
									<head></head>
									<body>
									<div style="margin:0;padding:0; background:#A71E22; padding-bottom:35px; display:block;">
										<table width="100%" cellspacing="0" cellpadding="0">
											<tr>
												<td align="center"><a href="#" style="text-align:center; padding:35px 25%; float:left;"><img src="" /></a></td>
											</tr>
											<tr>
												<td>
													<table width="70%" cellspacing="0" cellpadding="0" style="background:#FBB816; margin:0 0 25px 14%;-webkit-box-shadow: 0px 0px 5px 0px rgba(197,197,197,1);
								-moz-box-shadow: 0px 0px 5px 0px rgba(197,197,197,1);
								box-shadow: 0px 0px 5px 0px rgba(197,197,197,1); border-radius:6px;">
														<tr>
															<td style="padding: 35px 40px; color: rgb(147, 144, 145); font-size: 14px; font-family: arial; line-height: 18px; text-align:center; color:#FFFFFF;">
															<strong style="font-size:16px; line-height:25px; color:#FFFFFF">Hi '.$name.',</strong><br />
															<br /><br />Your Password  is '.$freashpassword.'</td>
															
															
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</div></body></html>';	*/

									/*if($third_party_id == '' ||  $third_party_id == 0)
									{
										$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
										<html xmlns="http://www.w3.org/1999/xhtml">
										<head>
										<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
										<title>Forgot Password</title>
										</head>

										<body>
										<div style="width:600px; float:left; background:#F3F3F3; border:0px solid #388E1A;">

										<div style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:15px; color:#333; padding:20px; margin: 0; border-top:0px solid #0BB1E0;">

										<div>
										<strong style="font-size:16px; line-height:25px; color:#00000">Hi '.$name.',</strong><br />
										<br />Your Password  is '.$freashpassword.'</div>


										<p style="color:#388E1A;">Don\'t Reply this Mail. This is Automatic Generated Mail from Vigilant Team.</p>
										</div>

										</div></body>
										</html>';
									}
									else
									{

										$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
										<html xmlns="http://www.w3.org/1999/xhtml">
										<head>
										<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
										<title>Forgot Password</title>
										</head>

										<body>
										<div style="width:600px; float:left; background:#F3F3F3; border:0px solid #388E1A;">
										
										<div style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:15px; color:#333; padding:20px; margin: 0; border-top:0px solid #0BB1E0;">

										<div>
										<strong style="font-size:16px; line-height:25px; color:#00000">Hi '.$name.',</strong><br />
										<br />You are login with Facebook or Gmail.Your login id is '.$emailto.'</div>


										<p style="color:#388E1A;">Don\'t Reply this Mail. This is Automatic Generated Mail from Vigilant Team.</p>
										</div>

										</div></body>
										</html>';
									}*/


									if($third_party_id == '' ||  $third_party_id == 0)
									{
										$message = "Hi $name, Your password is $freashpassword.\nDon't Reply this Mail. This is Automatic Generated Mail from Vigilant Team.";

										/*$message = 'Your account Details.

										------------------------
											Hi '.$name.' your password is '.$freashpassword.'.
										------------------------';*/
									}
									else
									{

										$message = "Hi $name, you are login with Facebook or Gmail.Your login id is $emailto.\nDon't Reply this Mail. This is Automatic Generated Mail from Vigilant Team.";
									}

									

									$subject = "Password Reset for Vigilant" ;
									$fromemail = "contact@myvigilantapp.com" ;
									$fromname   = "vigilant Registration Team" ;
									$this->load->library('email'); // load email library
                                   // $this->email->from( $fromemail, $fromname);
    							    $this->email->from($fromemail,'Vigilant Registration Team');
    								$this->email->to($emailto);
   
    								$this->email->subject($subject);

    								$this->email->message($message);
    								if ($this->email->send())
    								{

    									 $records['message'] = "Password recovery email sent to your mailbox :" ;
                                         $records['status'] = "1" ;
                  
			                 	   }
                                else{
        								$records['message'] = "Email Sending Failed :" ;
                                         $records['status'] = "0" ;
				                    }

	                  }
	                  else{
							$records['message'] = "This Email is not Register With Us" ;
			                $records['status'] = "0" ;
	                  }	

			}
			else
			{
				$records['message'] = "No parameter pass" ;
                $records['status'] = "0" ;
			}	

			header('Content-type: application/json');
            echo json_encode($records);

       }

       ///change password

    public function changePassword()
	{
		$userid = $this->input->post('user_id');

		$new_pass = $this->input->post('new_password');

		$oldpassword = md5($this->input->post('old_password'));

		$newpassword = md5($new_pass);
		
		if (!empty($userid))
		{
			$where = array('user_id'=>$userid);

			$data['userdetails'] = $this->api_model->getRow('vigilant_user',$where);

			$oldPassworddb = $data['userdetails']->password;

			if($oldPassworddb == $oldpassword)
			{
				
					$where = array('user_id' => $userid);

					$param = array('password'=>$newpassword,'fp'=>$new_pass);

					$data['updateUser'] = $this->api_model->updateData('vigilant_user',$where,$param);	

					$result = array('status'=>1,'message'=>'Your password has changed succesfully.','result'=> new $this->obj);
				
			}
			else
			{
				$result = array('status'=>0,'message'=>'Old Password does not match','result'=> new $this->obj);
			}		
		}
		else
		{
			$result = array('status'=>0,'message'=>'parameter missing.','result'=> new $this->obj);
		}

		echo json_encode($result);
		
	}	

   	public function getUserDetails()
	{
		$tokenAuth = quickAuth();

		$userid = $this->input->post('user_id');
		
		
		if(!empty($userid))
		{
			
			$where = array('vigilant_user.user_id'=>$userid);

			$data['userdetails'] = $this->api_model->getUserDetails('vigilant_user',$where);	

			//print_r($data['userdetails']);exit;

			if(!empty($data['userdetails']))
			{
				/*$folder = "upload/profile_pics/";
				
				if($data['userdetails']->profileimage!='')
				{
					$data['userdetails']->profile_image_url = base_url().$folder.$data['userdetails']->profileimage;	
				}
				else
				{
					$data['userdetails']->profile_image_url = '';
				}*/

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

			$data['userdetails']->BlockedUsers = $BlockedUsers;
				
				if(!empty($data['userdetails']->q_userid))
				{
					//echo "hi";

					$quickUser =  @quickGetUserbyId($tokenAuth->session->token,$data['userdetails']->q_userid);

					if(!empty($quickUser->user))
					{
						$data['userdetails']->QBUser = $quickUser->user;
					}
					else{
						$data['userdetails']->QBUser = "";
					}

				}
				else
				{
					$data['userdetails']->QBUser = "";
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


   public function editUser()
	{
		$tokenAuth = quickAuth();

		$userid = $this->input->post('user_id');

		if(!empty($userid))
		{
		
			if(!empty($this->input->post('first_name')))
			{
				$data['first_name'] = $this->input->post('first_name');
			}

			if(!empty($this->input->post('last_name')))
			{
				$data['last_name'] = $this->input->post('last_name');
			}

			if(!empty($this->input->post('username')))
			{

				$data['username'] = $this->input->post('username');
			}

			if(!empty($this->input->post('phoneno')))
			{

				$data['mobile_no'] = $this->input->post('phoneno');
			}

			$data['date_updated'] = date("Y-m-d H:i:s"); 

			if(!empty($_FILES['profileimage']['name'])){

			$folder = "upload/profile_pics/";

			$path_parts = pathinfo($_FILES["profileimage"]["name"]);

			$size = $_FILES['profileimage']['size'];

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

				$data2['userdetails'] = $this->api_model->getRow('vigilant_user',$where);

				if(!empty($data2['userdetails']->profileimage))
				{
					$is_exist_file = $_SERVER['DOCUMENT_ROOT'].'/vigilant/upload/profile_pics/'.$data2['userdetails']->profileimage;

						if (file_exists($is_exist_file)) {

							@unlink($is_exist_file);
						}

				//unlink('/var/www/html/vigilant/upload/profile_pics/'.$data2['userdetails']->profileimage);
				}

				$where = array('vigilant_user.user_id'=>$userid);

				$userdetails = $this->api_model->getRow('vigilant_user',$where);

				if(!empty($userdetails))
				{
					$q_userid = $userdetails->q_userid;

					$file_name_with_full_path =  $_SERVER['DOCUMENT_ROOT'].'/vigilant/upload/profile_pics/'.$upload_image;

					$cFile = '@' . $file_name_with_full_path;

					if(!empty($q_userid))
					{

						$q_login = $userdetails->email;

						$q_password = 12345678;

						$ext = $path_parts['extension'];

						$post_body = array(
						'blob[content_type]' 		=> 	"image/$ext",
						'blob[name]' 				=> 	$upload_image
						);

						$tokenAuthbyUser  = @quickAuthbyUser($q_login,$q_password);

						//print_r($tokenAuthbyUser);exit;
						$tokenAuthUser=$tokenAuthbyUser->session->token;

						$quickAddBlob =  @quickAddBlob($tokenAuthUser,$post_body);
						
						//print_r($quickAddBlob);exit;

						if(empty($quickAddBlob->errors))
						{
							

							$blob_id = $quickAddBlob->blob->id;

							if(!empty($quickAddBlob->blob->blob_object_access->params))
							{
								$explode1=explode('?',$quickAddBlob->blob->blob_object_access->params);
								$url=$explode1[0];
								$explode2=explode('&',$explode1[1]);
								$curlString="curl -X POST ";
								foreach($explode2 as $key=>$value)
								{
									$curlString.='-F "'.urldecode($value).'" ';
								}
								$curlString.='-F "file='.$cFile.'" '.$url;
								$responseAWS=@exec($curlString);

								$size_body = array(
									'blob[size]' 	=> 	$size
								); 
								
								$completeUpload = @quickUpdateBlobSize($tokenAuthUser,$blob_id,$size_body);

							}

							$upd_body = array(
							'user[blob_id]' 	=> 	$blob_id
							);

							$qBUSER=@quickUpdateUserbyId($tokenAuth->session->token,$q_userid,$upd_body);
							
						}

					}
				}

				$data['profileimage'] = $upload_image;
				$data['upload_path'] = $folder;
				}
			}


			$updateuser=$this->api_model->updateuser('vigilant_user',$data,$userid);	

			//print_r($data['userdetails']);exit;

			if($updateuser)
			{
				$where = array('vigilant_user.user_id'=>$userid);

				$data1['userdetails'] = $this->api_model->getUserDetails('vigilant_user',$where);
				
				

				if(!empty($data1['userdetails']->q_userid))
				{
					if(!empty($data['userdetails']->profileimage))
					{

						$profile_image_url = $data1['userdetails']->profile_image_url;

						$upd_body1 = array(
						'user[website]' 	=> 	$profile_image_url
						);

						$qBUSER=@quickUpdateUserbyId($tokenAuth->session->token,$data1['userdetails']->q_userid,$upd_body1);
					}
					//echo "hi";

					$quickUser =  quickGetUserbyId($tokenAuth->session->token,$data1['userdetails']->q_userid);

					if(!empty($quickUser->user))
					{
						$data1['userdetails']->QBUser = $quickUser->user;
					}
					else{
						$data1['userdetails']->QBUser = "";
					}

				}
				else
				{
					$data1['userdetails']->QBUser = "";
				}


				$result = array('status'=>1,'message'=>'Update success','result'=>$data1);

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


	//-------------------------------------------------------Start User sign out-------------------------------------------//	
	public function logOut()
	{
		$userid = $this->input->post('user_id');
		
		if (!empty($userid))
		{
			//$device_type = $_POST['device_type'];

			//$device_token = $_POST['device_token'];

			$where = array('user_id'=>$userid);

			$data['userdetails'] = $this->api_model->getRow('vigilant_user',$where);	

			if(!empty($data['userdetails']))
			{
			
				$where = array('user_id' => $userid);

				$param = array('login_status'=>'0');

				$data['updateUser'] = $this->api_model->updateData('vigilant_user',$where,$param);

				$where = array('user_id' => $userid);

				$data['deviceDetails'] = $this->api_model->getRow('vigilant_device_details',$where);

				if(!empty($data['deviceDetails']))
				{
					$value = array('device_token'=>'');

					$device_id = $this->api_model->updateData('vigilant_device_details',$where,$value);
				}

				$result = array('status'=>1,'message'=>'user logged out successfully','result'=> new $this->obj);				
				
			}
			else
			{
				$result = array('status'=>0,'message'=>'no user found.','result'=> new $this->obj);
			}		
		}
		else
		{
			$result = array('status'=>0,'message'=>'parameter missing.','result'=> new $this->obj);
		}

		echo json_encode($result);
		
	}

	// update for premium user

	public function update_premium()
	{
		$tokenAuth = quickAuth();
		
		$userid = $this->input->post('user_id');
		
		if (!empty($userid))
		{
			//$device_type = $_POST['device_type'];

			//$device_token = $_POST['device_token'];

			$where = array('user_id'=>$userid);

			$data['userdata'] = $this->api_model->getRow('vigilant_user',$where);	

			if(!empty($data['userdata']))
			{
			
				$where = array('user_id' => $userid);

				$param = array('is_premium'=>'1');

				$data['updateUser'] = $this->api_model->updateData('vigilant_user',$where,$param);

				if(!empty($data['updateUser']))
				{
					$data['userdetails'] = $this->api_model->getUserDetails('vigilant_user',$where);

					if(!empty($data['userdetails']->q_userid))
					{
					//echo "hi";

						$quickUser =  @quickGetUserbyId($tokenAuth->session->token,$data['userdetails']->q_userid);

						if(!empty($quickUser->user))
						{
							$data['userdetails']->QBUser = $quickUser->user;
						}
						else{
							$data['userdetails']->QBUser = "";
						}

					}
					else
					{
						$data['userdetails']->QBUser = "";
					}

					$result = array('status'=>1,'message'=>'premium  user update successful','result'=> $data['userdetails']);		
				}
				else
				{
					$result = array('status'=>0,'message'=>'premium  user not update','result'=> new $this->obj);		
				}	
				
			}
			else
			{
				$result = array('status'=>0,'message'=>'no user found.','result'=> new $this->obj);
			}		
		}
		else
		{
			$result = array('status'=>0,'message'=>'parameter missing.','result'=> new $this->obj);
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

			$data['notifyDetails'] = $this->api_model->getData('vigilant_notifications',$where);	

			if(!empty($data['notifyDetails']))
			{
			
				
				$result = array('status'=>1,'message'=>'Success','result'=> $data['notifyDetails']);				
				
			}
			else
			{
				$result = array('status'=>0,'message'=>'no record found.','result'=> new $this->obj);
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

			$delNotifybyUser = $this->api_model->DeleteData('vigilant_notifications',$where);	

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

			$delNotifybyId = $this->api_model->DeleteData('vigilant_notifications',$where);	

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

	public function sendNotification()
	{	
		$this->load->library('pushnotification');


		$userid = $this->input->post('user_id');

		if (!empty($userid))
		{

			//$this->pushnotification->test();
			//$deviceToken = $this->input->post('tokenid');
			//$deviceToken = '16c100391c28de2d7bbe1a5b6d6278082fd40e80d5bcaecfe11fb6e4c730d657';
			// Message payload
			
			$where = array('user_id'=>$userid);

			$data['userDetails'] = $this->api_model->getHomeLocRow('vigilant_user_hlocation',$userid);
			
			//print_r($data['userDetails']);exit;

			if(!empty($data['userDetails']))
			{
					foreach($data['userDetails'] as $userDetail)
					{

						$orglat =  $userDetail->lat;

						$orglong = $userDetail->long;

						$distance = 50;

						if(!empty($orglat) && !empty($orglong) && !empty($distance))
						{	
							$notifyUserArr[] = $this->api_model->get_notify_user('vigilant_user_hlocation',$orglat,$orglong,$distance);

						}
					}

				if(!empty($notifyUserArr))
				{
					$notifyUserArr = call_user_func_array('array_merge', $notifyUserArr);//array merge 
				}
				else
				{
					$notifyUserArr = array();
				}

				if(!empty($notifyUserArr))
				{

					$uniqueArr = array_map('unserialize', array_unique(array_map('serialize', $notifyUserArr))); // array unique
					//print_r($uniqueArr);
				}

				$msg_payload = array (
				'mtitle' => 'Test push notification title',
				'mdesc' => 'Test push notification body',
				);


				if(!empty($uniqueArr))
				{
					foreach($uniqueArr as $notifyUser)
					{
						$dataVal['notify_msg_title'] = $msg_payload['mtitle'];

						$dataVal['notify_msg_body'] = $msg_payload['mdesc'];

						$dataVal['user_id'] = $notifyUser['user_id'];

						$deviceToken[] = $notifyUser['device_token'];

						$addnotify=$this->api_model->addData('vigilant_notifications',$dataVal);

					}

					//print_r($deviceToken);exit;


							// Replace the above variable values

					$msg = $this->pushnotification->pushNoti_ios($deviceToken,$msg_payload);
				}

				
				if($msg == 'SUCCESS')
				{
					$result = array('status'=>1,'message'=>'Message successfully delivered','result'=> new $this->obj);
				}
				else{
					$result = array('status'=>0,'message'=>'Message not delivered','result'=> new $this->obj);
				}

		}
		else
			{
				$result = array('status'=>0,'message'=>'no record found','result'=> new $this->obj);
				
			}
	}
	else
	{
		$result = array('status'=>0,'message'=>'parameter missing.');
	}
	echo json_encode($result);
}

// add emergency contact

	public function add_contact()
	{	

		$userid = $this->input->post('user_id');

		if (!empty($userid))
		{
			$contact_no =  !empty($this->input->post('contact_no'))?($this->input->post('contact_no')):'';
			$emergency_name =  !empty($this->input->post('emergency_name'))?($this->input->post('emergency_name')):'';
			$data = array(
					'user_id'		=>	$userid,
					'contact_no'	=>	$contact_no,
					'emerg_name'	=>	$emergency_name
				);
			$contact = $this->api_model->addData('vigilant_emergency_contact',$data);

			if($contact)
			{
				$result = array('status'=>1,'message'=>'Emergency contact added successfully');
			}
			else
			{
				$result = array('status'=>0,'message'=>'error in database insertion');	
			}
		}
		else
		{
			$result = array('status'=>0,'message'=>'parameter missing.');
		
		}
		echo json_encode($result);
	}
// edit emergency contact

	public function edit_contact()
	{	

		$contact_id = $this->input->post('contact_id');

		if (!empty($contact_id))
		{
			if(!empty($this->input->post('contact_no')))
			{

				$data['contact_no'] = $this->input->post('contact_no');
			}

			if(!empty($this->input->post('emergency_name')))
			{

				$data['emerg_name'] = $this->input->post('emergency_name');
			}

			$where = array('contact_id'=>$contact_id); 

			$update_contact=$this->api_model->updateData('vigilant_emergency_contact',$where,$data);	


			if($update_contact)
			{
				$result = array('status'=>1,'message'=>'Emergency contact updated successfully');
			}
			else
			{
				$result = array('status'=>0,'message'=>'error in database insertion');	
			}
		}
		else
		{

			$result = array('status'=>0,'message'=>'parameter missing.');
		
		}
		echo json_encode($result);
	}

	// delete emergency contact

	public function delete_contact()
	{	

		$contact_id = $this->input->post('contact_id');


		if(!empty($contact_id))
		{

			$where = array('contact_id'=>$contact_id); 

			$delete_contact=$this->api_model->DeleteData('vigilant_emergency_contact',$where);	

			//print_r($update_tournament);exit;

			if($delete_contact)
			{

				$result = array('status'=>1,'message'=>'Delete success');

			}
			else
			{
				$result = array('status'=>0,'message'=>'error');
			}		
		}
		else
		{
			$result = array('status'=>0,'message'=>'parameter missing.');
		}

		echo json_encode($result);
	}

	public function get_all_contact()
	{
			$userid = $this->input->post('user_id');

			if (!empty($userid))
			{	
				$where = array('vigilant_emergency_contact.user_id'=>$userid); 

				$data['contact_details'] = $this->api_model->getContact('vigilant_emergency_contact',$where);	
				

				if(!empty($data['contact_details']))
				{

					$result = array('status'=>1,'message'=>'success','result'=> $data['contact_details']);
				}
				else
				{
					$result = array('status'=>0,'message'=>'No record found','result'=> $this->obj);
				}
			}
			else
			{
				$result = array('status'=>0,'message'=>'parameter missing.');
			}	

			echo json_encode($result);
	}

	public function managed_friend()
	{
		$userid = $this->input->post('user_id');

		//$userarrs = array('24387681','25330093','80989876');

		$user_arrs = $this->input->post('q_userid');

        $userarrs = explode(',',$user_arrs);

		//print_r($userarrs);exit;

		if (!empty($userid) && !empty($userarrs))
		{	

			$friend_details = $this->api_model->get_freiend_lists('vigilant_user_friend_req',$userid);

			if(!empty($friend_details))
			{
				$friendArray = call_user_func_array('array_merge', $friend_details);
			}
			else
			{
				$friendArray = array();
			}	
			//print_r($friendArray);exit;
			$row1 = array();

			$row2 = array();

			if(!empty($friendArray))
			{
				foreach($userarrs as $key=>$val)
				{
					if (in_array($val, $friendArray))
					{
						array_push($row1,$val);
					}
					else
					{
						$row1 = array();
					}

					$frArr[] = $row1;
				}
				//print_r($frArr);exit;
				if(!empty($frArr))
				{
					$frArrs = call_user_func_array('array_merge', $frArr);

					$frndArrs = array_map("unserialize", array_unique(array_map("serialize", $frArrs)));

					//print_r($frndArrs);exit;

					if(!empty($frndArrs))
					{
						foreach($frndArrs as $frndArrKey=>$frndArrVal)
						{

							$where = array('q_userid'=>$frndArrVal);

							$get_user = $this->api_model->getRow('vigilant_user',$where);

							$u_id = $get_user->user_id;

							$frndArrVal= ltrim($frndArrVal," ");

							$row2[$frndArrVal]=$u_id;

						}

						$result = array('status'=>1,'message'=>'Friend found','result'=> $row2);
					}
					else
					{
						$result = array('status'=>0,'message'=>'No record found','result'=> $this->obj);
					}
					
				}
				else
				{
					$result = array('status'=>0,'message'=>'No record found','result'=> $this->obj);
				}
				
			}
			else
			{
				$result = array('status'=>0,'message'=>'No friend found','result'=> $this->obj);
			}

		}
		else
		{
			$result = array('status'=>0,'message'=>'parameter missing.');
		}	

		echo json_encode($result);
	}

	public function chatDetails()
	{

		$userid = $this->input->post('user_id');
		
		if(!empty($userid))
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

			if(!empty($BlockedUsers))
			{
				$result = array('status'=>1,'message'=>'success','BlockedUsers'=> $BlockedUsers);
				
			}

			else
			{
				$result = array('status'=>0,'message'=>'No record Found','BlockedUsers'=> array());
			}
				
		}
		else
		{
			$result = array('status'=>0,'message'=>'parameter missing.','BlockedUsers'=> $this->obj);
		}

		echo json_encode($result);
		
	}


}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
