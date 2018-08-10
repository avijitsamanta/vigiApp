<?php class Location_Model extends CI_Model {

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

				if($this->db->affected_rows() > 0) 
				{
					 return $this->db->insert_id();
				}
				else
					return false;

		     
		     
		}

		public function countData($table='',$where=array())
		{
		      $this->db->select('*');

		      $query = $this->db->get_where($table,$where);

		          //echo $this->db->last_query();
		          //echo $query->num_rows();exit;
				if($query->num_rows()>0)
				{
					return $query->num_rows(); 				
				}
				else
					return 0;
		      
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

	   public function updateHomeData($table = '',$where = array(),$data = array())
	  {
		
		$this->db->where($where);
		
		$this->db->update($table, $data); 
		//echo $this->db->last_query();exit;
		if($this->db->affected_rows() > 0) 
		{
			$query = $this->db->get_where($table,$where);

			if($query->num_rows()>0)
			{
	   			return $query->row()->hloc_id; 				
			}
			//return $this->db->get($table)->row()->hloc_id;
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

	  public function search_location($table='',$where=array(),$userid='',$origLat='',$origLon='',$radius='',$crime_date='',$crime_type_id='',$time_frame='')
	{
			
			$join = "join vigilant_crime_type as ct on rt.crime_type_id = ct.type_id ";

			$where = " Where 1 ";

			if(!empty($crime_date) || $crime_date != '')
			{

				$where.=" AND rt.crime_date = '$crime_date'"; 
			}
			
			if(!empty($crime_type_id) || $crime_type_id != '')
			{

				$where.=" AND rt.crime_type_id = '$crime_type_id'"; 
			}

			if(!empty($time_frame) || $time_frame != '')
			{
				$cur_date = date('Y-m-d');

				switch ($time_frame) {
					case "1":
					$where.=" AND rt.crime_date = '$cur_date'"; 
					break;
					case "2":
					$where.=" AND  YEARWEEK(rt.crime_date,1) = YEARWEEK(CURDATE(), 1)"; 
					break;
					case "3":
					$where.=" AND  MONTH(rt.crime_date) = MONTH(CURDATE())"; 
					break;
					case "4":
					$where.=" AND  YEAR(rt.crime_date) = YEAR(CURDATE())"; 
					break;
				}
			}
			

			if(!empty($radius) || $radius != '')
			{

				$having = " having radius < $radius ";

			}


			$report_sql = "SELECT rt.report_id,rt.user_id,rt.crime_date,rt.crime_time,rt.crime_location,rt.gplaceid,rt.latitude,rt.longitude,rt.upload_path,rt.crime_video,rt.description,ct.crime_name, 3956 * 2 * ASIN(SQRT( POWER(SIN(($origLat - latitude)*pi()/180/2),2)
          +COS($origLat*pi()/180 )*COS(latitude*pi()/180)
          *POWER(SIN(($origLon-longitude)*pi()/180/2),2))) 
          as radius FROM $table as rt "; 

			
			$report_sql .=$join.$where.$having; 

			

			 $report_query = $this->db->query($report_sql);

			//echo $this->db->last_query();exit;
			
			$result =  $report_query->result();

			//print_r($result);exit;

			if($report_query->num_rows()>0)
			{
	   			
				foreach($report_query->result() as $row) //It will iterate only once or multiple times
			    {	
					if(!empty($row->crime_video))
					{
						$row->crime_video_path = base_url().$row->upload_path.$row->crime_video;
					}

					$sql= "SELECT id as pics_id,report_id,if(crime_pics<>'',(concat('".base_url()."',upload_path,crime_pics)),'') as crime_pics FROM vigilant_pics WHERE report_id =  '$row->report_id'";

					$query=$this->db->query($sql);


					$results = $query->result();

					$row->crime_pics = $results;
					
					if($row->user_id == $userid)
					{
						$row->is_editable = '1';
					}
					else
					{
						$row->is_editable = '0';
					}
						
					$data[] = $row;
				}
					return $data;		
			}
			else
				return array();
		
	}

  /*public function get_location($table='',$where=array())
	{

			$post_sql = "SELECT post.post_id,post.post_desc,post.user_id,post.posted_date FROM $table as post order by post.posted_date Desc"; 
			
			$post_query = $this->db->query($post_sql);
			
			$result =  $post_query->result();

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
			    	$sql= "SELECT user.user_id,user.first_name,user.last_name,user.username,user.email,if(user.profileimage<>'',(concat('".base_url()."',upload_path,profileimage)),'') as profile_image from vigilant_user as user WHERE user.user_id = '$row->user_id'";

					$query=$this->db->query($sql);

					if($query->num_rows()>0)
					{	

						$row1['user_details'] = $query->row();

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
		
	}*/
 
}
?>

