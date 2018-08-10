<?php class Comment_Model extends CI_Model {

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

	

	public function get_comment_details($table='',$where=array(),$userid='')
	{
		$this->db->select($table.'.*,vigilant_posts.user_id as post_user ,vigilant_posts.post_id as p_id,vigilant_posts.post_desc,vigilant_posts.posted_date');
		
		$this->db->from($table);

		$this->db->join('vigilant_posts', $table.'.post_id = vigilant_posts.post_id', 'left');

		$this->db->where($where);

		$query = $this->db->get();

		//echo $this->db->last_query();exit;

		if($query->num_rows()>0)
		{
   			$result_row = $query->row();

   			$row =  array();

   			$row['post_id'] = $result_row->p_id;

   			$row['post_desc'] = $result_row->post_desc;

   			$row['post_timestamp'] = $result_row->posted_date;

   			// for post user detalis

   			$post_user_sql= "SELECT user.user_id,user.first_name,user.last_name,user.username,user.email,if(user.upload_path<>'',(concat('".base_url()."',upload_path,profileimage)),profileimage) as profile_image from vigilant_user as user WHERE user.user_id = '$result_row->post_user'";

			$post_user_query=$this->db->query($post_user_sql);

			if($post_user_query->num_rows()>0)
			{	

				$row['post_user_details'] = $post_user_query->row();

			}


   			$row['comment_id'] = $result_row->cmt_id;

   			$row['comment_desc'] = $result_row->cmt_desc;

   			$row['comment_timestamp'] = $result_row->cmt_posted;

   			// for cooment user details

			$sql= "SELECT user.user_id,user.first_name,user.last_name,user.username,user.email,if(user.upload_path<>'',(concat('".base_url()."',upload_path,profileimage)),profileimage) as profile_image from vigilant_user as user WHERE user.user_id = '$result_row->user_id'";

			$query=$this->db->query($sql);

			if($query->num_rows()>0)
			{	

				$row['user_details'] = $query->row();

			}

			//$row['listOfReplies'] = array();

			$reply_sql= "SELECT rpl.* from vigilant_reply as rpl WHERE rpl.cmt_id = '$result_row->cmt_id'";

			$reply_query=$this->db->query($reply_sql);

			if($reply_query->num_rows()>0)
			{	

				//$row['comment_details'] = $cmt_query->result();

				foreach($reply_query->result() as $rpl_row)
				{
					$row1['reply_id'] = $rpl_row->reply_id;

					$row1['reply_desc'] = $rpl_row->reply_desc;

					$row1['rep_timeStamp'] = $rpl_row->reply_added;

					$sql= "SELECT user.user_id,user.first_name,user.last_name,user.username,user.email,if(user.upload_path<>'',(concat('".base_url()."',upload_path,profileimage)),profileimage) as profile_image from vigilant_user as user WHERE user.user_id = '$rpl_row->user_id'";

					$query=$this->db->query($sql);

					if($query->num_rows()>0)
					{	

						$row1['user_details'] = $query->row();

					}

					if($rpl_row->user_id == $userid)
					{
						
						$row1['is_editable'] = '1';

						$row1['is_deletable'] = '1';
					}
					else
					{
						$row1['is_editable'] = '0';
						$row1['is_deletable'] = '0';
					}

					$row['listOfReplies'][] = $row1;
				}
			}
			else
			{
				$row['listOfReplies'] = array();
			}

			if($result_row->user_id == $userid)
			{
				
						if($reply_query->num_rows()>0)
						{
							$row['is_editable'] = '0';
						}
						else
						{
							$row['is_editable'] = '1';
						}
				//$row['is_editable'] = '1';

				
			}
			else
			{
				$row['is_editable'] = '0';
				
			}

			if(($result_row->user_id == $userid) || ($result_row->post_user == $userid))
			{

				$row['is_deletable'] = '1';
			}
			else
			{
				
				$row['is_deletable'] = '0';
			}

			return 	$row;

		}

		return array();

	}
 
}
?>

