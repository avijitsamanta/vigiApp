<?php class Post_Model extends CI_Model {

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
                $this->obj = new stdClass();
        }
		
		public function getRow($table='',$where=array())
        {
				
		$query = $this->db->get_where($table,$where);

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

        public function get_num_rows($table="",$per_page,$orgLat='',$orgLong='')
        {

			$record_count_sql = "SELECT post.post_id,post.post_desc,post.user_id,post.posted_date,3956 *2 * ASIN( SQRT( POWER( SIN( ( $orgLat - hl.lat ) * PI( ) /180 /2 ) , 2 ) + COS( $orgLat * PI( ) /180 ) * COS( hl.lat * PI( ) /180 ) * POWER( SIN( ( $orgLong - hl.long ) * PI( ) /180 /2 ) , 2 ) ) ) AS distance FROM $table as post Left JOIN vigilant_user_hlocation AS hl ON post.user_id = hl.user_id having distance<10";

			$record_count_query = $this->db->query($record_count_sql);

			$num_rows = $record_count_query->num_rows();

			if($num_rows >0)
			{
				$data['total_records'] = $total_records = $num_rows;

				$data['total_pages']= $total_pages = ceil($total_records / $per_page); 

				
			}
			else
			{
				$data['total_records'] = '';

				$data['total_pages'] = '';
			}

			return $data;

        }


		public function get_all_post($table='',$where=array(),$userid='',$offset=0,$per_page,$orgLat='',$orgLong='')
		{

			$post_sql = "SELECT post.post_id,post.post_desc,post.user_id,post.posted_date,3956 *2 * ASIN( SQRT( POWER( SIN( ( $orgLat - hl.lat ) * PI( ) /180 /2 ) , 2 ) + COS( $orgLat * PI( ) /180 ) * COS( hl.lat * PI( ) /180 ) * POWER( SIN( ( $orgLong - hl.long ) * PI( ) /180 /2 ) , 2 ) ) ) AS distance FROM $table as post Left JOIN vigilant_user_hlocation AS hl ON post.user_id = hl.user_id having distance<10 order by post.posted_date Desc Limit $offset,$per_page"; 
			
			$post_query = $this->db->query($post_sql);
			
			$result =  $post_query->result();

			//echo $this->db->last_query();exit;

			//print_r($result);exit;

			$row1 = array();

			if($post_query->num_rows()>0)
			{
	   			foreach($post_query->result() as $row) //It will iterate only once or multiple times
			    {
			    	$row1['post_id']  = $row->post_id;

			    	$row1['post_desc'] = $row->post_desc;

			    	$row1['timeStamp'] = $row->posted_date;
			    	// for user_details
			    	$sql= "SELECT user.user_id,user.first_name,user.last_name,user.username,user.email,if(user.upload_path<>'',(concat('".base_url()."',upload_path,profileimage)),profileimage) as profile_image from vigilant_user as user WHERE user.user_id = '$row->user_id'";

					$query=$this->db->query($sql);

					if($query->num_rows()>0)
					{	

						$row1['user_details'] = $query->row();

					}
					else
					{
						$row1['user_details'] = array();
					}

					// for no of comments

					$where = array('post_id'=>$row->post_id);

					$this->db->select('COUNT(*) as total_comment');

					$query = $this->db->get_where('vigilant_comment',$where);

					if($query->num_rows()>0)
					{

						$result_comment = $query->row_array();

						$row1['no_of_comment'] = $result_comment['total_comment'];

					}
					else
					{
						$row1['no_of_comment'] = '0';
					}
	   			
	   				// for is editable

					if($row->user_id == $userid)
					{
						if(($row1['no_of_comment'])>0)
						{
							$row1['is_editable'] = '0';
						}
						else
						{
							$row1['is_editable'] = '1';
						}

						$row1['is_deletable'] = '1';
					}
					else
					{
						$row1['is_editable'] = '0';
						$row1['is_deletable'] = '0';
					}
						
					$data[] = $row1;
				}
					return $data;				
			}
			else
				return array();
		
	}
	
	public function get_post_details($table='',$where=array(),$userid='')
	{
		$this->db->select($table.'.*,vigilant_reported_post.reported_by');

		$this->db->join('vigilant_reported_post', $table.'.post_id = vigilant_reported_post.post_id','Left');


		$query = $this->db->get_where($table,$where);

		//echo $this->db->last_query();exit;

		if($query->num_rows()>0)
		{
   			$result_row = $query->row();

   			$row =  array();

   			$row['post_id'] = $result_row->post_id;

   			$row['post_desc'] = $result_row->post_desc;

   			$row['timeStamp'] = $result_row->posted_date;

			$sql= "SELECT user.user_id,user.first_name,user.last_name,user.username,user.email,if(user.upload_path<>'',(concat('".base_url()."',upload_path,profileimage)),profileimage) as profile_image from vigilant_user as user WHERE user.user_id = '$result_row->user_id'";

			$query=$this->db->query($sql);

			if($query->num_rows()>0)
			{	

				$row['user_details'] = $query->row();

			}

			$cmt_sql= "SELECT cmt.cmt_id,cmt.cmt_desc,cmt.user_id,cmt.cmt_posted from vigilant_comment as cmt WHERE cmt.post_id = '$result_row->post_id'";

			$cmt_query=$this->db->query($cmt_sql);

			if($cmt_query->num_rows()>0)
			{	

				//$row['comment_details'] = $cmt_query->result();

				foreach($cmt_query->result() as $cmt_row)
				{
					$row1['comment_id'] = $cmt_row->cmt_id;

					$row1['comment_desc'] = $cmt_row->cmt_desc;

					$row1['timeStamp'] = $cmt_row->cmt_posted;

					$sql= "SELECT user.user_id,user.first_name,user.last_name,user.username,user.email,if(user.upload_path<>'',(concat('".base_url()."',upload_path,profileimage)),profileimage) as profile_image from vigilant_user as user WHERE user.user_id = '$cmt_row->user_id'";

					$query=$this->db->query($sql);

					if($query->num_rows()>0)
					{	

						$row1['user_details'] = $query->row();

					}

					
					// for no of reply

					$where = array('cmt_id'=>$cmt_row->cmt_id);

					$this->db->select('COUNT(*) as total_reply');

					$query = $this->db->get_where('vigilant_reply',$where);

					if($query->num_rows()>0)
					{

						$result_replies = $query->row_array();

						$row1['no_of_replies'] = $result_replies['total_reply'];

					}
					else
					{
						$row1['no_of_replies'] = '0';
					}

					// for no of comments


					if($cmt_row->user_id == $userid)
					{

						if(($row1['no_of_replies'])>0)
						{
							$row1['is_editable'] = '0';
						}
						else
						{
							$row1['is_editable'] = '1';
						}

					}
					else
					{
						$row1['is_editable'] = '0';
						
					}

					if(($cmt_row->user_id == $userid) || ($result_row->user_id == $userid))
					{
						
						$row1['is_deletable'] = '1';
					}
					else
					{
						$row1['is_deletable'] = '0';
					}

					$row['comment_details'][] = $row1;
				}
			}

			// for no of comments

			$where = array('post_id'=>$result_row->post_id);

			$this->db->select('COUNT(*) as total_comment');

			$query = $this->db->get_where('vigilant_comment',$where);

			if($query->num_rows()>0)
			{

				$result_comment = $query->row_array();

				$row1['no_of_comment'] = $result_comment['total_comment'];

			}
			else
			{
				$row1['no_of_comment'] = '0';
			}
	   			

			if($result_row->user_id == $userid)
			{
				if(($row1['no_of_comment'])>0)
				{
					$row['is_editable'] = '0';
				}
				else
				{
					$row['is_editable'] = '1';
				}
				$row['is_deletable'] = '1';
			}
			else
			{
				$row['is_editable'] = '0';
				$row['is_deletable'] = '0';
			}

			

			return 	$row;

		}

		return array();

	}

 
}
?>

