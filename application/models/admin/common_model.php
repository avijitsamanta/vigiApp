<?php class Common_model extends CI_Model 
	{

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
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

		
		public function getData($table,$where = array())
		{
				if(!empty($where))
				{
					$this->db->where($where);
				}

			    $query = $this->db->get($table);

			   //echo $this->db->last_query();

			    if($query->num_rows() >0)
				{
					return $query->result();
				}
				else
					return false;
				
		
		}

		public function get_reported_post($table='',$where=array())
		{

			$this->db->select($table.'.*,vigilant_user.username,vigilant_user.first_name,vigilant_user.last_name');
			
			$this->db->from($table);

	
			$this->db->join('vigilant_user', $table.'.reported_by = vigilant_user.user_id','Left');


			if(!empty($where))
			{
			
				$this->db->where($where);

			}
			
			$query = $this->db->get();

			if($query->num_rows() >0)
			{
				return $query->result();
			}
			else
				return false;
		}

		public function get_reported_crime($table='',$where=array())
		{

			$this->db->select($table.'.*,vigilant_user.username,vigilant_user.first_name,vigilant_user.last_name');
			
			$this->db->from($table);

	
			$this->db->join('vigilant_user', $table.'.reported_by = vigilant_user.user_id','Left');


			if(!empty($where))
			{
			
				$this->db->where($where);

			}
			
			$query = $this->db->get();

			if($query->num_rows() >0)
			{
				return $query->result();
			}
			else
				return false;
		}

		public function getCrieType($table,$where = array())
		{
				if(!empty($where))
				{
					$this->db->where($where);
				}

				$this->db->order_by('crime_name','asc');

			    $query = $this->db->get($table);

			  // echo $this->db->last_query();exit;

			    if($query->num_rows() >0)
				{
					return $query->result();
				}
				else
					return false;
				
		
		}

		
		

		public function DataDelete($table,$where,$mode,$id_name="")
		{

			if($mode=='single')
			{
				$this->db->delete($table, $where);

				//echo  $this->db->last_query();exit;
			}
			else
			{
				
				$this->db->where_in($id_name, $where);

        		$this->db->delete($table);
			
			}
		}

		


		public function getUserDetails($table='',$where=array())
		{
			$this->db->select($table.'.*,');

			$this->db->from($table);

			//$this->db->join('garment_product_color', $table.'.product_color_id = garment_product_color.color_id', 'left'); 

			$this->db->where($where);

			$query = $this->db->get();


					
			return $query->result();
		}

		public function get_report($table='',$where=array())
		{

			$this->db->select($table.'.*,vigilant_crime_type.crime_name,vigilant_user.username,vigilant_user.first_name,vigilant_user.last_name,vigilant_reported_crime.is_reported,vigilant_reported_crime.reported_by');
			
			$this->db->from($table);

			$this->db->group_by($table.".report_id");

			$this->db->order_by($table.".crime_date", "desc");

			$this->db->join('vigilant_crime_type', $table.'.crime_type_id = vigilant_crime_type.type_id', 'left'); 

			$this->db->join('vigilant_user', $table.'.user_id = vigilant_user.user_id','Left');

			$this->db->join('vigilant_reported_crime', $table.'.report_id = vigilant_reported_crime.report_id','Left');

			if(!empty($where))
			{
			
				$this->db->where($where);

			}
			
			$query = $this->db->get();

			//echo $this->db->last_query();

			$row1 = array();

			if($query->num_rows()>0)
			{
				foreach($query->result() as $row) //It will iterate only once or multiple times
			    {	
					if(!empty($row->crime_video))
					{
						$row->crime_video_path = base_url().$row->upload_path.$row->crime_video;
					}
					else
					{

						$row->crime_video_path = "";
					}

					$sql = "select * from vigilant_pics where report_id='$row->report_id'";

					$query1 = $this->db->query($sql);

					if($query1->num_rows>0)
					{
						//echo $this->db->last_query();exit;
						$row->cr_pics = $query1->result();
					}


					$sql = "select * from vigilant_user where user_id='$row->reported_by'";

					$query1 = $this->db->query($sql);

					if($query1->num_rows>0)
					{
						//echo $this->db->last_query();exit;
						$res_row = $query1->row();

						$row->reported_first_name = $res_row->first_name;
						$row->reported_last_name = $res_row->last_name;
						$row->reported_username = $res_row->username;

					}
					else{
						$row->reported_first_name = '';
						$row->reported_last_name = '';
						$row->reported_username = '';
					}
						
					$data[] = $row;
				}
					return $data;				
			}
			else
				return array();

		}


		  public function addData($table='',$data=array())
		  {
		      $this->db->insert($table, $data);

		      return $this->db->insert_id();
		     
		  }

		  

		  public function updateData($table='',$where=array(),$data=array())
		  {
			$this->db->where($where);
		
			$this->db->update($table, $data); 

			if($this->db->affected_rows()>0)
			{
				return true;
			}
			else
			{
				return false;
			}

		  }

		public function userUpdate($table,$id,$data=array(),$mode='')
		{
		
			if($mode=='edit')
			{
				$this->db->where('user_id',$id);
				
				$upd=$this->db->update($table, $data);

				if($this->db->affected_rows()>0)
				{
					return $id;
				}
				else
				{
					return false;
				}

				//echo $this->db->last_query();exit; 
			}
			else
			{
				$this->db->insert($table, $data); 

				if($this->db->affected_rows()>0)
				{
					return $this->db->insert_id();
				}
				else
				{
					return false;
				}
			}
		}

		public function reportUpdate($table,$id,$data=array(),$mode='')
		{
		
			if($mode=='edit')
			{
				$this->db->where('report_id',$id);
				
				$upd=$this->db->update($table, $data);

				if($this->db->affected_rows()>0)
				{
					return $id;
				}
				else
				{
					return false;
				}

				//echo $this->db->last_query();exit; 
			}
			else
			{
				$this->db->insert($table, $data); 

				if($this->db->affected_rows()>0)
				{
					return $this->db->insert_id();
				}
				else
				{
					return false;
				}
			}
		}

		public function checkAdminPassword($old_password,$userid)
		{
			$this->db->select('*');
			$this->db->from('shopper_admin');
			$this->db->where(array('admin_id'=>$userid,'admin_password'=>$old_password));
			$query = $this->db->get();
			if ($query->num_rows() > 0) {
				return 1;
			}else{
				return 0;
			}
		}

		public function addBatchData($data = array())
		{
			$insert = $this->db->insert_batch('vigilant_pics',$data);
			return $insert?true:false;
		}

		public function get_post($table='',$where = '')
		{

			$post_sql = "SELECT post.post_id,post.post_desc,post.user_id,reported_post.is_reported,post.posted_date,user.first_name,user.last_name,user.username,reported_post.reported_by,reported_post.reason FROM $table as post left join vigilant_user as user on post.user_id = user.user_id left join vigilant_reported_post as reported_post on post.post_id = reported_post.post_id $where group by post.post_id order by post.posted_date Desc"; 
			
			$post_query = $this->db->query($post_sql);
			

					//echo $this->db->last_query();exit;

			if($post_query->num_rows()>0)
			{
	   			foreach($post_query->result() as $row) //It will iterate only once or multiple times
			    {	
					$row1['post_id'] = $row->post_id;
					$row1['post_desc'] = $row->post_desc;
					$row1['user_id'] = $row->user_id;
					$row1['is_reported'] = $row->is_reported;
					$row1['posted_date'] = $row->posted_date;
					$row1['reported_by'] = $row->reported_by;
					$row1['first_name'] = $row->first_name;
					$row1['last_name'] = $row->last_name;
					$row1['username'] = $row->username;

					$sql = "select * from vigilant_user where user_id='$row->reported_by'";

					$query1 = $this->db->query($sql);


					if($query1->num_rows>0)
					{
							//echo $this->db->last_query();exit;
							$res_row = $query1->row();
							$row1['reported_first_name'] = $res_row->first_name;
							$row1['reported_last_name'] = $res_row->last_name;
							$row1['reported_username'] = $res_row->username;

					}
					else{
							$row1['reported_first_name'] = '';
							$row1['reported_last_name'] = '';
							$row1['reported_username'] = '';
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
