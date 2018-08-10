<?php class Api_Model extends CI_Model {

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

        public function getHomeLocRow($table='',$userid='')
        {
			
        	$sql = "Select vh.lat,vh.long from vigilant_user_hlocation vh where vh.user_id = '$userid' 
        			UNION ALL
        			Select vl.lat,vl.long from vigilant_user_location vl where vl.user_id = '$userid'
        	";


			//$this->db->order_by("hloc_id", "desc");	
			
			$query = $this->db->query($sql);

			//echo $this->db->last_query();

			if($query->num_rows()>0)
			{
	   			return $query->result(); 				
			}
			else
				return array();
	            
        }


        public function updateuser($table,$data=array(),$id='')
		{
		
				$this->db->where('user_id',$id);
				
				$this->db->update($table, $data); 

				//echo $this->db->last_query();exit;

				if($this->db->affected_rows())
				{
					return true;
				}
				else
				{
					return false;
				}
			
		}

        public function getResults($table='',$where=array())
        {
				
			$query = $this->db->get_where($table,$where);

			if($query->num_rows()>0)
			{
	   			return $query->result_array(); 				
			}
			else
				return array();
            
        }

        public function getContact($table='',$where=array())
        {
				$this->db->select("$table.contact_id,$table.contact_no,$table.emerg_name");

				$this->db->from($table);

				$this->db->join('vigilant_user', $table.'.user_id = vigilant_user.user_id', 'left');

				$this->db->where($where);
				
				$query = $this->db->get();

				//echo $this->db->last_query();exit;	

				if($query->num_rows()>0)
				{
					return $query->result_array(); 				
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

        public function getUserDetails($table='',$where=array())
		{
			
			$this->db->select('user_id,q_userid,username,first_name,last_name,email,mobile_no as phoneno,profileimage,upload_path,login_status,is_premium');

			$this->db->from($table);

			$this->db->where($where);
				
			$query = $this->db->get();


			if($query->num_rows()>0)
			{	

				$result_row = $query->row();

				$folder = "upload/profile_pics/";
				
				if($result_row->profileimage!='' && $result_row->upload_path!='')
				{
					$result_row->profile_image_url = base_url().$folder.$result_row->profileimage;	
				}
				else if($result_row->profileimage!='' && $result_row->upload_path ==''){

					$result_row->profile_image_url = $result_row->profileimage;	
				}
				else
				{
					$result_row->profile_image_url = '';
				}


				// for home location detalis

				$hloc_sql= "SELECT hloc.hloc_id,hloc.lat,hloc.long,hloc.address from vigilant_user_hlocation as hloc WHERE hloc.user_id = '$result_row->user_id' order by hloc.hloc_id Desc" ;

				$hloc_query=$this->db->query($hloc_sql);

				if($hloc_query->num_rows()>0)
				{	

					$result_row->home_location = $hloc_query->row();

				} 
				else
				{
					$result_row->home_location = "";
				}

				return 	$result_row;	

			}
			else
				return array();
	   	}

        public function getReviewData($table='',$where=array())
        {
        	$this->db->order_by('review_id','DESC');

        	$this->db->limit(5,0);
				
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


		

        public function getAllReview($table='',$where=array())
        {
        	$this->db->order_by('review_id','DESC');


				
			$query = $this->db->get_where($table,$where);
			
			if($query->num_rows()>0)
			{
	   			return $query->result_array(); 				
			}
			else
				return array();
            
        }

       

        public function getOrderData($table='',$where=array(),$col_name,$order_by)
        {
			$this->db->order_by($col_name,$order_by);

			$query = $this->db->get_where($table,$where);

			if($query->num_rows()>0)
			{
	   			return $query->result_array(); 				
			}
			else
				return array();
            
        }

		
		public function addData($table='',$data=array())
		{
		    $this->db->insert($table, $data);

			if($this->db->affected_rows())
			{
				return $this->db->insert_id();
			}
			else
			{
				return false;
			}
		     
		}

		

	  public function updateData($table = '',$where = array(),$data = array())
	  {
		
		$this->db->where($where);
		
		$this->db->update($table, $data); 
		//echo $this->db->last_query();
		return true;
		

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

	
   

   
	public function addReservedListData($table = '',$data = array(),$where=array())
	{
		$this->db->select('*');
		
		$this->db->from($table);

		$this->db->where($where);

		$query = $this->db->get();

		if($query->num_rows()==0)
		{
			$this->db->insert($table, $data);

			$this->db->last_query();

	      	return $this->db->insert_id();
		}
		else
		{			
			$this->db->where($data);
      
			$this->db->delete($table); 

			return false;
		}		
	} 

	

	public function addReview($table = '',$data=array(),$where = array())
	{

		$this->db->select('*');
		
		$this->db->from($table);

		$this->db->where($where);

		$query = $this->db->get();


		if($query->num_rows()==0)
		{
				$this->db->insert($table, $data);

	      		return $this->db->insert_id();
		}
		else
		{			
			$this->db->where($where);

			return $this->db->update($table, $data);
			
		}		
	
	}

	public function get_notify_user($table='',$origLat='',$origLon='',$distance='')
	{

			//$this->db->select('report_id,user_id,crime_name,crime_date,crime_time,crime_location,latitude,longitude,upload_path,crime_video,description');

          $sql = "SELECT rt.user_id,dd.device_token, 3956 * 2 * ASIN(SQRT( POWER(SIN(($origLat - (rt.lat))*pi()/180/2),2)
          +COS($origLat*pi()/180 )*COS((rt.lat)*pi()/180)
          *POWER(SIN(($origLon-(rt.long))*pi()/180/2),2))) 
          as distance FROM $table as rt  join vigilant_device_details as dd on rt.user_id = dd.user_id where (dd.device_token <>'') having distance < $distance 
          UNION ALL
          SELECT vl.user_id,dd.device_token, 3956 * 2 * ASIN(SQRT( POWER(SIN(($origLat - (vl.lat))*pi()/180/2),2)
          +COS($origLat*pi()/180 )*COS((vl.lat)*pi()/180)
          *POWER(SIN(($origLon-(vl.long))*pi()/180/2),2))) 
          as distance FROM vigilant_user_location as vl  join vigilant_device_details as dd on vl.user_id = dd.user_id where (dd.device_token <>'') having distance < $distance 
          ";  

			
			 $query = $this->db->query($sql);

			 //echo $this->db->last_query();

			$result =  $query->result();

			//print_r($result);exit;
			 $row = array();
			
			if($query->num_rows() > 0)
			{
				foreach($query->result() as $result)
				{
					$row['device_token'] = $result->device_token;

					$row['user_id'] = $result->user_id;

					$data[] = $row;
				}
				return $data;
			}
			else
				return false;


	}

	
	public function get_blocked_freiend_lists($table='',$userid = '')
	{
			
			$where = " Where 1 ";

			if(!empty($userid) || $userid != '')
			{

				$where.=" AND (receiver_id = '$userid' OR sender_id = '$userid') AND (is_blocked = '1')"; 
			}

			
			$sql = "SELECT * FROM $table "; 

			
			$sql .=$where; 

			$query = $this->db->query($sql);	

			//echo $this->db->last_query();exit;
			
			$row1 = array();

			if($query->num_rows()>0)
			{	

				$results = $query->result();

				foreach($results as $result_row)
				{
					$where =" Where 1 ";

					$where .= "AND (user_id = '$result_row->sender_id' OR user_id = '$result_row->receiver_id') AND (user_id != '$userid')";

					$user_sql = "SELECT q_userid FROM vigilant_user ";

					$user_sql .=$where; 


					$user_query = $this->db->query($user_sql);

					//echo $this->db->last_query();exit;

					$row1 = array();

					if($user_query->num_rows()>0)
					{
						$user_row = $user_query->row();

						$tokenAuth = quickAuth();

						//echo $quickUser->user;exit;

						if(!empty($user_row->q_userid))
						{
						//echo "hi";
							$q_userid = $user_row->q_userid;

							$quickUser =  @quickGetUserbyId($tokenAuth->session->token,$q_userid);

							if(!empty($quickUser->user))
							{
								//$row1['QBUserId'] = $quickUser->user;

								array_push($row1,$quickUser->user->id);
							}
							
						}
						else{
							$row1 = array();
						}
						
					}
					else
					{
						$row1 = array();
					}
					 
					 $data[] = $row1;
				}


				return $data;	

			}
			else
				return array();
	}
	
	public function get_blocked_user_lists($table='',$userid = '')
	{
			
			$where = " Where 1 ";

			if(!empty($userid) || $userid != '')
			{

				$where.=" AND (user_id = '$userid') AND (is_blocked = '1')"; 
			}

			
			$sql = "SELECT * FROM $table "; 

			
			$sql .=$where; 

			$query = $this->db->query($sql);	

			//echo $this->db->last_query();exit;
			
			$row1 = array();

			if($query->num_rows()>0)
			{	

				$results = $query->result();

				foreach($results as $result_row)
				{
					$where =" Where 1 ";

					$where .= "AND (user_id = '$result_row->blocked_user') ";

					$user_sql = "SELECT q_userid FROM vigilant_user ";

					$user_sql .=$where; 


					$user_query = $this->db->query($user_sql);

					//echo $this->db->last_query();exit;

					$row1 = array();

					if($user_query->num_rows()>0)
					{
						$user_row = $user_query->row();

						$tokenAuth = quickAuth();

						//echo $quickUser->user;exit;

						if(!empty($user_row->q_userid))
						{
						//echo "hi";
							$q_userid = $user_row->q_userid;

							$quickUser =  @quickGetUserbyId($tokenAuth->session->token,$q_userid);

							if(!empty($quickUser->user))
							{
								//$row1['QBUserId'] = $quickUser->user;

								array_push($row1,$quickUser->user->id);
							}
							
						}
						else{
							$row1 = array();
						}
						
					}
					else
					{
						$row1 = array();
					}
					 
					 $data[] = $row1;
				}


				return $data;	

			}
			else
				return array();
	}

	public function get_freiend_lists($table='',$userid = '')
	{
			
			$where = " Where 1 ";

			if(!empty($userid) || $userid != '')
			{

				$where.=" AND (receiver_id = '$userid' OR sender_id = '$userid') AND (is_accept = '1') "; 
			}

			
			$sql = "SELECT * FROM $table "; 

			
			$sql .=$where; 

			$query = $this->db->query($sql);	

			//echo $this->db->last_query();exit;
			
			$row1 = array();

			if($query->num_rows()>0)
			{	

				$results = $query->result();

				foreach($results as $result_row)
				{
					$where =" Where 1 ";

					$where .= "AND (user_id = '$result_row->sender_id' OR user_id = '$result_row->receiver_id') AND (user_id != '$userid')";

					$user_sql = "SELECT q_userid FROM vigilant_user ";

					$user_sql .=$where; 


					$user_query = $this->db->query($user_sql);

					//echo $this->db->last_query();exit;

					$row1 = array();

					if($user_query->num_rows()>0)
					{
						$user_row = $user_query->row();

						$tokenAuth = quickAuth();

						//echo $quickUser->user;exit;

						if(!empty($user_row->q_userid))
						{
						//echo "hi";
							$q_userid = $user_row->q_userid;

							$quickUser =  @quickGetUserbyId($tokenAuth->session->token,$q_userid);

							if(!empty($quickUser->user))
							{
								//$row1['QBUserId'] = $quickUser->user;

								array_push($row1,$quickUser->user->id);
							}
							
						}
						else{
							$row1 = array();
						}
						
					}
					else
					{
						$row1 = array();
					}
					 
					$data[] = $row1;
				}


				return $data;	

			}
			else
				return array();
	}
 
}
?>

