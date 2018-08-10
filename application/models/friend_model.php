<?php class Friend_Model extends CI_Model {

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                $this->obj = new stdClass();
        }
		
		public function getRow($table='',$where=array())
        {
				
		$query = $this->db->get_where($table,$where);

		//echo $this->db->last_query();exit;

		if($query->num_rows()>0)
		{
   			return $query->row(); 				
		}
		else
			return array();
            
        }

       
        

		public function getData($table='',$where=array())
        {
        	
			$query = $this->db->get_where($table,$where);
			
			//echo $this->db->last_query();exit;	

			if($query->num_rows()>0)
			{
	   			return $query->result_array(); 				
			}
			else
				return array();
            
        }

        
		public function avg_review($table='',$where=array()) {

			$this->db->select('AVG(rating) as average_rating');

			$query = $this->db->get_where($table,$where);

			if($query->num_rows()>0)
			{
	   			$data_rating = $query->row_array(); 

	   			return $avg_rating = number_format($data_rating['average_rating'], 1,'.',',');
	   			
	   			//return $avg_rating = number_format($avg_rating, 1, '.', ',');


			}
			else
				return false;
			
		}

		public function count_total_review($table='',$where=array()) {

			$this->db->select('COUNT(*) as total_review');

			$query = $this->db->get_where($table,$where);

			if($query->num_rows()>0)
			{
	   			$result_review = $query->row_array();

	   			$total_review = $result_review['total_review'];

	   			return $total_review;
	   			
	   			//return $avg_rating = number_format($avg_rating, 1, '.', ',');


			}
			else
				return false;
			
		}


		
		
		public function addData($table='',$data=array())
		{
		      $this->db->insert($table, $data);

		      //echo $this->db->last_query();exit;

		      return $this->db->insert_id();
		     
		}


	  public function updateData($table = '',$where = array(),$data = array())
	  {
		
		$this->db->where($where);
		
		$this->db->update($table, $data); 
		//echo $this->db->last_query();exit;
		if($this->db->affected_rows() > 0) 
		{
			return true;
		}
		else
			return false;
		

	  }

	  public function DeleteData($table='',$where=array())
	  {
		$this->db->where($where);
		
		$this->db->delete($table); 

		if($this->db->affected_rows() > 0) 
		{
			return true;
		}
		else
			return false;

	  }

	  
		public function sendMail($table='',$where=array())
        {
				
			$query = $this->db->get_where($table,$where);

			$result = $query->result();

			if($query->num_rows()>0)
			{
	   			
				$to = $result[0]->email; // Send email to our user

				$subject = 'garment\'s Eye:Password'; // Give the email a subject 

				$message = 'Your account Details.
					 
				------------------------
				Username: '.$result[0]->email.'
				Password: '.$result[0]->password.'
				------------------------';

	                     
				$headers = 'From:noreply@yourwebsite.com' . "\r\n"; // Set from headers
					
				if(mail($to, $subject, $message, $headers))
					return 1;
				else
					return 2;
				
			}
			else
				return 0;
            
        }


	

	public function get_friend_lists($table='',$userid = '')
	{
			
			$where = " Where 1 ";

			if(!empty($userid) || $userid != '')
			{

				$where.=" AND (receiver_id = '$userid' OR sender_id = '$userid') AND (is_accept = '1') AND (is_blocked = 0)"; 
			}

			
			$sql = "SELECT * FROM $table "; 

			
			$sql .=$where; 

			$query = $this->db->query($sql);	

			
			$row1 = array();

			if($query->num_rows()>0)
			{	

				$results = $query->result();

				foreach($results as $result_row)
				{
					$where =" Where 1 ";

					$where .= "AND (user_id = '$result_row->sender_id' OR user_id = '$result_row->receiver_id') AND (user_id != '$userid')";

					$user_sql = "SELECT user_id,q_userid,username,first_name,last_name,email,upload_path,profileimage FROM vigilant_user ";

					$user_sql .=$where; 


					$user_query = $this->db->query($user_sql);

					//echo $this->db->last_query();exit;

					if($user_query->num_rows()>0)
					{
						$user_row = $user_query->row();

						$row1['user_id'] = $user_row->user_id;

						$row1['username'] = $user_row->username;

						$row1['first_name'] = $user_row->first_name;

						$row1['last_name'] = $user_row->last_name;

						$row1['email'] = $user_row->email;

						$folder = "upload/profile_pics/";

						if($user_row->profileimage!='' && $user_row->upload_path!='')
						{
							$row1['profile_image_url'] = base_url().$folder.$user_row->profileimage;	
						}
						else if($user_row->profileimage!='' && $user_row->upload_path ==''){

							$row1['profile_image_url'] = $user_row->profileimage;	
						}
						else
						{
							$row1['profile_image_url'] = '';
						}

						$tokenAuth = quickAuth();

						//echo $quickUser->user;exit;

						if(!empty($user_row->q_userid))
						{
						//echo "hi";
							$q_userid = $user_row->q_userid;

							$quickUser =  @quickGetUserbyId($tokenAuth->session->token,$q_userid);

							if(!empty($quickUser->user))
							{
								$row1['QBUser'] = $quickUser->user;
							}
							else{

								$row1['QBUser'] = "";

							}

						}
						else{
							$row1['QBUser'] = "";
						}

						$row1['is_blocked'] = $result_row->is_blocked;
						
						$data[] = $row1;
					}
					else
					{
						$data =array();
					}
					
				}


				return 	$data;	

			}
			else
				return array();
	}

	public function get_blocked_friend_lists($table='',$userid = '')
	{
			
			$where = " Where 1 ";

			if(!empty($userid) || $userid != '')
			{

				$where.=" AND (receiver_id = '$userid' OR sender_id = '$userid') AND (is_accept = '1') AND (is_blocked = 1) AND (blocked_by = $userid)"; 
			}

			
			$sql = "SELECT * FROM $table "; 

			
			$sql .=$where; 

			$query = $this->db->query($sql);	

			
			$row1 = array();

			if($query->num_rows()>0)
			{	

				$results = $query->result();

				foreach($results as $result_row)
				{
					$where =" Where 1 ";

					$where .= "AND (user_id = '$result_row->sender_id' OR user_id = '$result_row->receiver_id') AND (user_id != '$userid')";

					$user_sql = "SELECT user_id,q_userid,username,first_name,last_name,email,upload_path,profileimage FROM vigilant_user ";

					$user_sql .=$where; 


					$user_query = $this->db->query($user_sql);

					//echo $this->db->last_query();exit;

					if($user_query->num_rows()>0)
					{
						$user_row = $user_query->row();

						$row1['user_id'] = $user_row->user_id;

						$row1['username'] = $user_row->username;

						$row1['first_name'] = $user_row->first_name;

						$row1['last_name'] = $user_row->last_name;

						$row1['email'] = $user_row->email;

						$folder = "upload/profile_pics/";

						if($user_row->profileimage!='' && $user_row->upload_path!='')
						{
							$row1['profile_image_url'] = base_url().$folder.$user_row->profileimage;	
						}
						else if($user_row->profileimage!='' && $user_row->upload_path ==''){

							$row1['profile_image_url'] = $user_row->profileimage;	
						}
						else
						{
							$row1['profile_image_url'] = '';
						}

						$tokenAuth = quickAuth();

						//echo $quickUser->user;exit;

						if(!empty($user_row->q_userid))
						{
						//echo "hi";
							$q_userid = $user_row->q_userid;

							$quickUser =  @quickGetUserbyId($tokenAuth->session->token,$q_userid);

							if(!empty($quickUser->user))
							{
								$row1['QBUser'] = $quickUser->user;
							}
							else{

								$row1['QBUser'] = "";

							}

						}
						else{
							$row1['QBUser'] = "";
						}

						$row1['is_blocked'] = $result_row->is_blocked;
						
						$data[] = $row1;
					}
					else
					{
						$data =array();
					}
					
				}


				return 	$data;	

			}
			else
				return array();
	}

	public function get_request_friend_lists($table='',$where = array())
	{
			$query = $this->db->get_where($table,$where);
			
			//echo $this->db->last_query();exit;	

			
			$row1 = array();

			if($query->num_rows()>0)
			{	

				$results = $query->result();

				foreach($results as $result_row)
				{
					$where =" Where 1 ";

					$where .= "AND user_id =".$result_row->sender_id;

					$user_sql = "SELECT user_id,q_userid,username,first_name,last_name,email,upload_path,profileimage FROM vigilant_user "; 
					$user_sql .=$where; 


					$user_query = $this->db->query($user_sql);

					if($user_query->num_rows()>0)
					{
						$user_row = $user_query->row();

						$row1['user_id'] = $user_row->user_id;

						$row1['username'] = $user_row->username;

						$row1['first_name'] = $user_row->first_name;

						$row1['last_name'] = $user_row->last_name;

						$row1['email'] = $user_row->email;

						$folder = "upload/profile_pics/";

						if($user_row->profileimage!='' && $user_row->upload_path!='')
						{
							$row1['profile_image_url'] = base_url().$folder.$user_row->profileimage;	
						}
						else if($user_row->profileimage!='' && $user_row->upload_path ==''){

							$row1['profile_image_url'] = $user_row->profileimage;	
						}
						else
						{
							$row1['profile_image_url'] = '';
						}

						$tokenAuth = quickAuth();

						//echo $quickUser->user;exit;

						if(!empty($user_row->q_userid))
						{
						//echo "hi";
							$q_userid = $user_row->q_userid;

							$quickUser =  @quickGetUserbyId($tokenAuth->session->token,$q_userid);

							if(!empty($quickUser->user))
							{
								$row1['QBUser'] = $quickUser->user;
							}
							else{

								$row1['QBUser'] = "";

							}
							//$row1['QBUser'] = $quickUser->user;

						}
						else{
							$row1['QBUser'] = "";
						}
					}

					$data[] = $row1;
				}


				return 	$data;	

			}
			else
				return array();
	}

	public function get_friend_requests($table='',$receiver_id='',$sender_id='')
	{
		
			$where = " Where 1 ";

			if(!empty($receiver_id) || $receiver_id != '' && !empty($sender_id) || $sender_id != '')
			{

				$where.=" AND (receiver_id = '$receiver_id' OR receiver_id = '$sender_id') AND (sender_id = '$receiver_id' OR sender_id = '$sender_id')"; 
			}

			
			$sql = "SELECT * FROM $table "; 

			
			$sql .=$where; 

			$query = $this->db->query($sql);

			if($query->num_rows()>0)
			{
				return $query->row();
			}
			else
				return array();

	}
	
	public function get_search_friend_list($table='',$username='',$userid='')
	{
		
			$where = " Where user_id !='$userid' ";

			if(!empty($username) || $username != '')
			{

				$where.=" AND (username like '%$username%' OR first_name like '%$username%' OR last_name like '%$username%' OR email like '%$username%')"; 
			}

			
			$sql = "SELECT user_id,q_userid,username,first_name,last_name,email,upload_path,profileimage FROM $table "; 

			
			$sql .=$where; 

			$query = $this->db->query($sql);

			//echo $this->db->last_query();exit;

			$row1 = array();

			if($query->num_rows()>0)
			{	

				$results = $query->result();

				foreach($results as $result_row)
				{
					$row1['user_id'] = $result_row->user_id;

					$row1['username'] = $result_row->username;

					$row1['first_name'] = $result_row->first_name;

					$row1['last_name'] = $result_row->last_name;

					$row1['email'] = $result_row->email;

					//$row1['q_userid'] = $result_row->q_userid;

					$tokenAuth = quickAuth();

					//echo $quickUser->user;exit;

					
					$folder = "upload/profile_pics/";

					if($result_row->profileimage!='' && $result_row->upload_path!='')
					{
						$row1['profile_image_url'] = base_url().$folder.$result_row->profileimage;	
					}

					else if($result_row->profileimage!='' && $result_row->upload_path ==''){

						$row1['profile_image_url'] = $result_row->profileimage;	
					}
					else
					{
						$row1['profile_image_url'] = '';
					}

					if(!empty($result_row->q_userid))
					{
					//echo "hi";
						$q_userid=$result_row->q_userid;

						$quickUser =  @quickGetUserbyId($tokenAuth->session->token,$q_userid);

						if(!empty($quickUser->user))
						{
							$row1['QBUser'] = $quickUser->user;
						}
						else{

							$row1['QBUser'] = "";

						}

					}
					else{
						$row1['QBUser'] = "";
					}


					//$query_invited = $this->db->get_where('vigilant_user_friend_req',array('receiver_id'=>$result_row->user_id,'sender_id'=>$userid,'is_reject'=>0));

					$where = " Where 1 ";

					
					$where.=" AND (receiver_id = '$result_row->user_id' OR receiver_id = '$userid') AND (sender_id = '$result_row->user_id' OR sender_id = '$userid') AND (is_reject='0') "; 
					

					$sql = "SELECT * FROM vigilant_user_friend_req "; 


					$sql .=$where; 

					$query_invited = $this->db->query($sql);


					if($query_invited->num_rows()>0)
					{
						$row1['is_invited'] = '1';
					}
					else
					{
						$row1['is_invited'] = '0';
					}


					$data[] = $row1;
				}


				return 	$data;	

			}
			else
				return array();
	}

	public function get_search_user_friend_list($table='',$username='',$userid='')
	{
		
			$where1 = " Where user_id in (select receiver_id from vigilant_user_friend_req where sender_id = '$userid' AND is_accept=1 AND is_blocked=0)";

			if(!empty($username) || $username != '')
			{

				$where1.=" AND (username like '%$username%' OR first_name like '%$username%' OR last_name like '%$username%' OR email like '%$username%') "; 
			}

			
			$sql1 = "SELECT user_id,q_userid,username,first_name,last_name,email,upload_path,profileimage FROM $table "; 

			
			$sql1 .=$where1; 

			$where2 = " Where user_id in (select sender_id from vigilant_user_friend_req where receiver_id = '$userid' AND is_accept=1 AND is_blocked=0)";

			if(!empty($username) || $username != '')
			{

				$where2.=" AND (username like '%$username%' OR first_name like '%$username%' OR last_name like '%$username%' OR email like '%$username%') "; 
			}

			
			$sql2 = "SELECT user_id,q_userid,username,first_name,last_name,email,upload_path,profileimage FROM $table "; 

			
			$sql2 .=$where2;

			$sql = $sql1.' UNION '.$sql2; 

			$query = $this->db->query($sql);

			//echo $this->db->last_query();exit;

			$row1 = array();

			if($query->num_rows()>0)
			{	

				$results = $query->result();

				foreach($results as $result_row)
				{
					$row1['user_id'] = $result_row->user_id;

					$row1['username'] = $result_row->username;

					$row1['first_name'] = $result_row->first_name;

					$row1['last_name'] = $result_row->last_name;

					$row1['email'] = $result_row->email;

					//$row1['q_userid'] = $result_row->q_userid;

					$tokenAuth = quickAuth();

					//echo $quickUser->user;exit;

					
					$folder = "upload/profile_pics/";

					if($result_row->profileimage!='' && $result_row->upload_path!='')
					{
						$row1['profile_image_url'] = base_url().$folder.$result_row->profileimage;	
					}
					else if($result_row->profileimage!='' && $result_row->upload_path ==''){

						$row1['profile_image_url'] = $result_row->profileimage;	
					}
					else
					{
						$row1['profile_image_url'] = '';
					}

					if(!empty($result_row->q_userid))
					{
					//echo "hi";
						$q_userid=$result_row->q_userid;

						$quickUser =  @quickGetUserbyId($tokenAuth->session->token,$q_userid);

						if(!empty($quickUser->user))
						{
							$row1['QBUser'] = $quickUser->user;
						}
						else{

							$row1['QBUser'] = "";

						}

					}
					else{
						$row1['QBUser'] = "";
					}


					//$query_invited = $this->db->get_where('vigilant_user_friend_req',array('receiver_id'=>$result_row->user_id,'sender_id'=>$userid,'is_reject'=>0));

					$where = " Where 1 ";

					
					$where.=" AND (receiver_id = '$result_row->user_id' OR receiver_id = '$userid') AND (sender_id = '$result_row->user_id' OR sender_id = '$userid') AND (is_reject='0') "; 
					

					$sql = "SELECT * FROM vigilant_user_friend_req "; 


					$sql .=$where; 

					$query_invited = $this->db->query($sql);


					if($query_invited->num_rows()>0)
					{
						$row1['is_invited'] = '1';
					}
					else
					{
						$row1['is_invited'] = '0';
					}


					$data[] = $row1;
				}


				return 	$data;	

			}
			else
				return array();
	}

	public function get_friend($table='',$receiver_id='',$sender_id='')
	{
		
			$where = " Where 1 ";

			if(!empty($receiver_id) || $receiver_id != '' && !empty($sender_id) || $sender_id != '')
			{

				$where.=" AND (receiver_id = '$receiver_id' OR receiver_id = '$sender_id') AND (sender_id = '$receiver_id' OR sender_id = '$sender_id') AND (is_accept=1) AND (is_blocked = 0)"; 
			}

			
			$sql = "SELECT * FROM $table "; 

			
			$sql .=$where; 

			$query = $this->db->query($sql);

			if($query->num_rows()>0)
			{
				return $query->row();
			}
			else
				return array();

	}

	public function get_blocked_friend($table='',$receiver_id='',$sender_id='')
	{
		
			$where = " Where 1 ";

			if(!empty($receiver_id) || $receiver_id != '' && !empty($sender_id) || $sender_id != '')
			{

				$where.=" AND (receiver_id = '$receiver_id' OR receiver_id = '$sender_id') AND (sender_id = '$receiver_id' OR sender_id = '$sender_id') AND (is_accept=1) AND (is_blocked = 1)"; 
			}

			
			$sql = "SELECT * FROM $table "; 

			
			$sql .=$where; 

			$query = $this->db->query($sql);

			if($query->num_rows()>0)
			{
				return $query->row();
			}
			else
				return array();

	}

	public function Blocked_friend($table = '',$receiver_id,$sender_id)
	  {
		
			$where = " Where 1 ";

			if(!empty($receiver_id) || $receiver_id != '' && !empty($sender_id) || $sender_id != '')
			{

				$where.=" AND (receiver_id = '$receiver_id' OR receiver_id = '$sender_id') AND (sender_id = '$receiver_id' OR sender_id = '$sender_id') AND (is_accept=1)"; 

			}

			$sql = "UPDATE $table SET is_blocked = 1,blocked_by='$receiver_id' "; 

			
			$sql .=$where; 

			$query = $this->db->query($sql);
			
			if($this->db->affected_rows())
			{
				return true;
			}
			else
			{
				return false;
			}
			

	  }

	  public function Unblocked_friend($table = '',$receiver_id,$sender_id)
	  {
		
			$where = " Where 1 ";

			$where1 = " Where 1 ";

			if(!empty($receiver_id) || $receiver_id != '' && !empty($sender_id) || $sender_id != '')
			{

				$where1.=" AND (receiver_id = '$receiver_id' OR receiver_id = '$sender_id') AND (sender_id = '$receiver_id' OR sender_id = '$sender_id') AND (is_accept=1) AND (blocked_by='$receiver_id') "; 

				$where.=" AND (receiver_id = '$receiver_id' OR receiver_id = '$sender_id') AND (sender_id = '$receiver_id' OR sender_id = '$sender_id') AND (is_accept=1)  "; 


			}

			$sql1 = "SELECT * from $table "; 

			
			$sql1 .=$where1; 

			$query1 = $this->db->query($sql1);

			//echo $this->db->last_query();exit;


			if($query1->num_rows()>0)
			{
				$sql = "UPDATE $table SET is_blocked = 0,blocked_by=0 "; 


				$sql .=$where; 

				$query = $this->db->query($sql);

				

				if($this->db->affected_rows())
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			else
				return false;

			
			

	  }

	  public function Unblocked_user($table = '',$userid='',$blocked_user_id='')
	  {
		
			$where = " Where 1 ";

			if(!empty($userid) || $userid != '' && !empty($blocked_user_id) || $blocked_user_id != '')
			{

				$where.=" AND (user_id = '$userid' OR user_id = '$blocked_user_id') AND (blocked_user = '$userid' OR blocked_user = '$blocked_user_id') AND (is_blocked=1)"; 

			}

			$sql = "DELETE from $table "; 

			
			$sql .=$where; 

			$query = $this->db->query($sql);

			//echo $this->db->last_query();exit;
			
			return true;
			

	  }
 
}
?>

