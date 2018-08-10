<?php class Report_Model extends CI_Model {

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

		public function updatereport($table,$data=array(),$id='')
		{
		
				$this->db->where('report_id',$id);
				
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

        public function getCrimeType($table='',$where=array())
        {
			$this->db->from($table);

			$this->db->where($where);

			$this->db->order_by("crime_name", "asc");

			$query = $this->db->get(); 
			//$query = $this->db->get_where($table,$where);
			
			//echo $this->db->last_query();exit;	

			if($query->num_rows()>0)
			{
	   			return $query->result_array(); 				
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

        public function get_pics_id($table='',$where=array()) {

			$this->db->select('id');

			$query = $this->db->get_where($table,$where);

			if($query->num_rows()>0)
			{
	   			foreach($query->result() as $result) 
	   			{

	   				 $pics_ids[] = $result->id;
	   			
	   			}

	   			return $pics_ids;
			}
			else
				return false;
			
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


		public function count_total_wishlist($table='',$where=array()) {

			$this->db->select('COUNT(*) as total_wishlist');

			$query = $this->db->get_where($table,$where);

			if($query->num_rows()>0)
			{
	   			$result_wishlist = $query->row_array();

	   			$total_wishlist = $result_wishlist['total_wishlist'];

	   			return $total_wishlist;
	   			
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

		      //echo $this->db->last_query();exit;

		      return $this->db->insert_id();
		     
		}

		public function addSize($table ='',$size=array(),$product_id)
		{
			for($i=0;$i<sizeof($size);$i++) 
			{
				$this->db->insert($table, array('product_id' => $product_id,'product_size_id' => $size[$i]));					
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

	  public function DeleteProductImage($table='',$where=array())
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
	  
	  public function addProductImages($table = '',$images = array(),$thumb_images = array(),$product_id)
	  {
	  		for($i=0;$i<sizeof($images);$i++) 
			{
				$this->db->insert($table, array('product_id' => $product_id,'product_image' => $images[$i],'product_thumb_image' => $thumb_images[$i]));					
			}
			return true;
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

	
   

    


   

    public function getColorList($table='',$where=array())
    {
    	$this->db->select('garment_product_color.color_code,garment_product_color.color_name');
		
		$this->db->from($table);

		$this->db->join('garment_product_color', $table.'.product_color_id = garment_product_color.color_id', 'left'); 

		$this->db->where($where);

		$query = $this->db->get();

		

		if($query->num_rows()>0)
		{
   			return $query->result_array(); 				
		}
		else
			return array();
    }

	
    public function get_crime_pics($table='',$pics_id='')
	{

			$sql= "SELECT id as pics_id,if(crime_pics<>'',(concat('".base_url()."',upload_path,crime_pics)),'') as crime_pics FROM $table WHERE id =  '$pics_id'";

			$query=$this->db->query($sql);


			return $results = $query->result();

	}


	public function get_report($table='',$where=array(),$userid='')
	{

			$this->db->select($table.'.*,vigilant_crime_type.crime_name');
			
			$this->db->from($table);

			$this->db->join('vigilant_crime_type', $table.'.crime_type_id = vigilant_crime_type.type_id', 'left'); 

			if(!empty($where))
			{
			
				$this->db->where($where);

			}
			
			$query = $this->db->get();

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

						$row->crime_video_path ="";
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


	public function get_all_report($table='',$where=array(),$userid='',$origLat='',$origLon='',$distance='')
	{

			//$this->db->select('report_id,user_id,crime_name,crime_date,crime_time,crime_location,latitude,longitude,upload_path,crime_video,description');

			$report_sql = "SELECT rt.report_id,rt.user_id,rt.crime_date,rt.crime_time,rt.crime_location,rt.gplaceid,rt.latitude,rt.longitude,rt.upload_path,rt.crime_video,rt.description,ct.crime_name, 3956 * 2 * ASIN(SQRT( POWER(SIN(($origLat - latitude)*pi()/180/2),2)
          +COS($origLat*pi()/180 )*COS(latitude*pi()/180)
          *POWER(SIN(($origLon-longitude)*pi()/180/2),2))) 
          as distance,DATEDIFF(CURDATE(),(rt.crime_date)) AS days FROM $table as rt  join vigilant_crime_type as ct on rt.crime_type_id = ct.type_id  having distance < $distance and days<90"; 

			
			 $report_query = $this->db->query($report_sql);

			
			
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


					$reported_sql= "SELECT * FROM vigilant_reported_crime WHERE report_id = '$row->report_id' AND reported_by='$userid'";

					$reported_query=$this->db->query($reported_sql);


					$reported_row = $reported_query->row();

					//echo $this->db->last_query();
					
					if(!empty($reported_row))
					{

						$row->is_reported = '1';
						

					}
					else
					{
						$row->is_reported = '0';
					}
						
					$data[] = $row;
				}
					return $data;				
			}
			else
				return array();
		
	}

	public function get_all_notfic_report($table='',$where=array(),$userid='')
	{
			$this->db->select($table.'.*');
			
			$this->db->from($table);

			$this->db->where($where);

			$query = $this->db->get();

			$row1= array();

			//echo $this->db->last_query();exit;

			if($query->num_rows()>0)
			{

			//$this->db->select('report_id,user_id,crime_name,crime_date,crime_time,crime_location,latitude,longitude,upload_path,crime_video,description');

			foreach($query->result() as $row)
			{	

				$report_sql = "SELECT rt.report_id,rt.user_id,rt.crime_date,rt.crime_time,rt.crime_location,rt.gplaceid,rt.latitude,rt.longitude,rt.upload_path,rt.crime_video,rt.description,ct.crime_name FROM vigilant_report as rt  join vigilant_crime_type as ct on rt.crime_type_id = ct.type_id where rt.report_id = '$row->report_id'"; 


				$report_query = $this->db->query($report_sql);

			if($report_query->num_rows()>0)
			{

				$report_result =  $report_query->row();

				$report_result->notify_id = $row->notify_id;

				if(!empty($report_result->crime_video))
				{
					 $report_result->crime_video_path = base_url().$report_result->upload_path.$report_result->crime_video;
				}


				$sql= "SELECT id as pics_id,report_id,if(crime_pics<>'',(concat('".base_url()."',upload_path,crime_pics)),'') as crime_pics FROM vigilant_pics WHERE report_id =  '$row->report_id'";

				$query=$this->db->query($sql);

				if($query->num_rows()>0)
				{


					$results = $query->result();

					$report_result->crime_pics = $results;
				}
				$row1[] = $report_result;
			}

				//echo $row->user_id;

				/*if($report_result->user_id == $userid)
				{
					$report_result->is_editable = '1';
				}
				else
				{
					$report_result->is_editable = '0';
				}*/

				
			}
					return $row1;				
				
			}
			else
				return array();
		
	}

	

	

	public function getList($table,$where=array(),$userid)
	{
		$this->db->select('*');
		
		$this->db->from($table);

		$this->db->where($where);

		$query = $this->db->get();

			if($query->num_rows()>0)
			{
	   			foreach($query->result() as $row) //It will iterate only once or multiple times
	            {
					$this->db->select('garment_product.*,garment_brand.brand_name,garment_product_style.style,garment_product_color.color_code,garment_product_color.color_name,garment_product_size.size');

					$this->db->from('garment_product');

					$this->db->join('garment_brand', 'garment_product.brand_id = garment_brand.brand_id', 'left');

					$this->db->join('garment_product_style', 'garment_product.style_id = garment_product_style.style_id', 'left'); 

					$this->db->join('garment_product_color', 'garment_product.color_id = garment_product_color.color_id', 'left'); 

					$this->db->join('garment_product_size', 'garment_product.size_id = garment_product_size.product_size_id', 'left');

					$this->db->where('garment_product.product_id',$row->product_id);
					//$this->db->where('product_id',$row->product_id);

					$query2 = $this->db->get();					

					if($query2->num_rows()>0)
					{	
   						foreach($query2->result() as $row2) //It will iterate only once or multiple times
            			{

							//$query3 = $this->db->get_where('garment_users',array('userid'=>$row2->shop_id));

							//$result = $query3->row();
					

							//$row2->distance = distance($user_latitude,$user_longitude,$result->latitude,$result->longitude, "K");


							$query_wl = $this->db->get_where('garment_wishlist',array('user_id'=>$userid,'product_id'=>$row->product_id));

							if($query_wl->num_rows()>0)
							{
								$row2->wishlist_status = '1';
							}
							else
							{
								$row2->wishlist_status = '0';
							}
					
							$data[] = $row2;

						}
				
					}
					
				}
				

				return $data;				
						
			}			
			else
				return false;

	}

	public function addWishListData($table = '',$where = array())
	{
		$this->db->select('*');
		
		$this->db->from($table);

		$this->db->where($where);

		$query = $this->db->get();

		if($query->num_rows()==0)
		{
			$this->db->insert($table, $where);

	      	return $this->db->insert_id();
		}
		else
		{			
			$this->db->where($where);
      
			$this->db->delete($table); 

			return false;
		}		
	} 

	public function addCartListData($table = '',$where = array())
	{
		$this->db->select('*');
		
		$this->db->from($table);

		$this->db->where($where);

		$query = $this->db->get();

		if($query->num_rows()==0)
		{
			$this->db->insert($table, $where);

	      	return $this->db->insert_id();
		}
		else
		{			
			$this->db->where($where);
      
			$this->db->delete($table); 

			return false;
		}		
	} 
	
	public function updateQty($table = '',$where = array(),$qty)
	{
		$this->db->select('*');
		
		$this->db->from($table);

		$this->db->where($where);

		$query = $this->db->get();

		if($query->num_rows()>0)
		{
			$this->db->where($where);

			$this->db->set('quantity',$qty, FALSE);

			$this->db->update($table);

			//echo $this->db->last_query();exit;

			return true;
		}
		else
		{	
			return false;
		}		
	} 

	public function updateCart($table = '',$where = array(),$qty,$data=array())
	{
		$this->db->select('*');
		
		$this->db->from($table);

		$this->db->where($where);

		$query = $this->db->get();

		if($query->num_rows()>0)
		{
			$this->db->where($where);

			$this->db->set('quantity',$qty, FALSE);

			$this->db->update($table);

			//echo $this->db->last_query();

			return true;
		}
		else
		{	
			$this->db->insert($table, $data);

			//echo $this->db->last_query();

	      	return $this->db->insert_id();
			
		}		
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

	public function addProductView($table = '',$data=array(),$where = array(),$product_id)
	{

		$this->db->select('*');
		
		$this->db->from($table);

		$this->db->where($where);

		$query = $this->db->get();
		
		//echo $this->db->last_query();

		if($query->num_rows()==0)
		{
				$sql="UPDATE `garment_product` SET `view_count` = `view_count`+1 WHERE `product_id` = '$product_id'";

				$query = $this->db->query($sql);

				//$this->db->where('product_id',$product_id);

				//$this->db->update('garment_product', array('view_count' => 'view_count'+1));

				//echo $this->db->last_query(); 

				$this->db->insert($table, $data);

	      		return $this->db->insert_id();
	      		
		}
		else
		{			
			$this->db->where($where);

			$update = $this->db->update($table, array('view_time' => date('Y-m-d H:i:s')));

			//echo $this->db->last_query(); exit;
			
			return $update;
			
		}		
	
	}


	public function getProductSize($product_id='')
	{
		
		$this->db->select('garment_product_size.*');
		
		$this->db->from('garment_product_size');

		$this->db->join('garment_size', 'garment_product_size.product_size_id = garment_size.product_size_id', 'left'); 

		$this->db->where('garment_size.product_id',$product_id);

		$query = $this->db->get();

		if($query->num_rows()>0)
		{
	   		return $query->result();
		}
	
	}


	public function getNewShopProdList($table='',$where=array())
	{
		
		$this->db->select($table.'.*,garment_brand.brand_name');
		
		$this->db->from($table);

		$this->db->join('garment_brand', $table.'.brand_id = garment_brand.brand_id', 'left'); 

		$this->db->where($where);

		$this->db->order_by('product_id','desc');

		$this->db->limit('20');

		$query = $this->db->get();



		if($query->num_rows()>0)
		{
   			foreach($query->result() as $row) //It will iterate only once or multiple times
            {
				
				$data[] = $row;
			}
			
			return $data;
						
		}
		else
			return false;
	}


	public function getPopularProdList($table='',$where=array())
	{
		
		$this->db->select($table.'.*,garment_brand.brand_name');
		
		$this->db->from($table);

		$this->db->join('garment_brand', $table.'.brand_id = garment_brand.brand_id', 'left'); 

		//$this->db->join('shopper_product_views', $table.'.product_id = shopper_product_views.product_id', 'left'); 

		$this->db->where($where);

		$this->db->order_by($table.'.view_count','desc');

		$this->db->limit('10');

		$query = $this->db->get();



		if($query->num_rows()>0)
		{
   			foreach($query->result() as $row) //It will iterate only once or multiple times
            {
				
				$data[] = $row;
				
			}
			
			return $data;
						
		}
		else
			return false;
	}

	
	public function get_notify_user($table='',$origLat='',$origLon='',$distance='',$userid='')
	{

			//$this->db->select('report_id,user_id,crime_name,crime_date,crime_time,crime_location,latitude,longitude,upload_path,crime_video,description');

          $sql = "SELECT rt.user_id,dd.device_token, 3956 * 2 * ASIN(SQRT( POWER(SIN(($origLat - (rt.lat))*pi()/180/2),2)
          +COS($origLat*pi()/180 )*COS((rt.lat)*pi()/180)
          *POWER(SIN(($origLon-(rt.long))*pi()/180/2),2))) 
          as distance FROM $table as rt  join vigilant_device_details as dd on rt.user_id = dd.user_id where (rt.user_id <>'$userid') AND (dd.device_token <>'') having distance < $distance 
          UNION ALL
          SELECT vl.user_id,dd.device_token, 3956 * 2 * ASIN(SQRT( POWER(SIN(($origLat - (vl.lat))*pi()/180/2),2)
          +COS($origLat*pi()/180 )*COS((vl.lat)*pi()/180)
          *POWER(SIN(($origLon-(vl.long))*pi()/180/2),2))) 
          as distance FROM vigilant_user_location as vl  join vigilant_device_details as dd on vl.user_id = dd.user_id where (vl.user_id <>'$userid') AND (dd.device_token <>'') having distance < $distance 
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

        public function get_alert_data()
        {
			$result = array();

			$dist_sql = "select * from vigilant_distance";

			//$this->db->order_by("hloc_id", "desc");	
			
			$dist_query = $this->db->query($dist_sql);

			//echo $this->db->last_query();

			if($dist_query->num_rows()>0)
			{
				$distance = $dist_query->row();

				$result['distance'] = $distance->distance_covered;
			}
			else{

				$result['distance'] = 1;
			}

        	$sql = "SELECT * from vigilant_crime_type order by crime_name asc";

			//$this->db->order_by("hloc_id", "desc");	
			
			$query = $this->db->query($sql);

			//echo $this->db->last_query();

			if($query->num_rows()>0)
			{

	   			$result['crime_type'] = $query->result(); 
	
			}

			if(!empty($result))

				return $result;
			else
				return array();
	            
        }

       public function get_alert_data_by_user($table='',$where = array())
        {
			$result_row = array();

			$this->db->select($table.'.*');

			$this->db->from($table);

			$this->db->where($where);

			$query = $this->db->get();

			if($query->num_rows()>0)
			{

				$row = $query->row();

				$result['distance'] = $row->distance;

				$crime_type = $row->crime_type;

					//print_r($crime_type_arr);exit;
				
				$crime_type_arr = explode(',',$crime_type);
				

				$sql = "SELECT * from vigilant_crime_type order by crime_name asc";

				//$this->db->order_by("hloc_id", "desc");	

				$query = $this->db->query($sql);

				//echo $this->db->last_query();

				if($query->num_rows()>0)
				{

					foreach($query->result() as $res_row)
					{
						if(in_array($res_row->type_id, $crime_type_arr))
						{
							$res_row->status =  '1';
						}
						else
						{
							$res_row->status =  '0';
						}
						$result['crime_type'][] = $res_row;
					} 

				}

			}

			if(!empty($result))
			return $result;
			else
			return array();
	            
        }

     public function get_notification_user($table='',$origLat='',$origLon='',$userid='',$crime_type='')
	{

		$sql = "SELECT rt.user_id,dd.device_token,nd.crime_type as ct,nd.distance as dist,3956 * 2 * ASIN(SQRT( POWER(SIN(($origLat - (rt.lat))*pi()/180/2),2)
          +COS($origLat*pi()/180 )*COS((rt.lat)*pi()/180)
          *POWER(SIN(($origLon-(rt.long))*pi()/180/2),2))) 
          as distance FROM $table as rt  join vigilant_device_details as dd on rt.user_id = dd.user_id join vigilant_notification_data as nd on rt.user_id = nd.user_id  where (rt.user_id <>'$userid') AND (dd.device_token <>'') 
          UNION ALL
          SELECT rt.user_id,dd.device_token,nd.crime_type as ct,nd.distance as dist,3956 * 2 * ASIN(SQRT( POWER(SIN(($origLat - (rt.lat))*pi()/180/2),2)
          +COS($origLat*pi()/180 )*COS((rt.lat)*pi()/180)
          *POWER(SIN(($origLon-(rt.long))*pi()/180/2),2))) 
          as distance FROM vigilant_user_location as rt  join vigilant_device_details as dd on rt.user_id = dd.user_id join vigilant_notification_data as nd on rt.user_id = nd.user_id  where (rt.user_id <>'$userid') AND (dd.device_token <>'') "
          ;  

          $query = $this->db->query($sql);

			//echo $this->db->last_query();exit;
          $data = array();
			if($query->num_rows()>0)
			{
	   			foreach($query->result() as $result_row)
	   			{
	   				if(!empty($result_row->ct))
	   				{
	   					$ct_arr = explode(',',$result_row->ct);
	   				}
	   				
	   				if(!empty($ct_arr) && in_array($crime_type, $ct_arr))
	   				{
	   					
						if(($result_row->distance < $result_row->dist))
						{
							$data[] = $result_row;
						}
	   				}
	   				/*else
	   				{
	   					if(($result_row->distance < $result_row->dist))
						{
							$data[] = $result_row;
						}
	   				}*/
	   				
	   				
	   			} 
	   			return 	$data;			
			}
			else
				return $data;

			
	}
	
	public function getCrimeTypeIds($table='',$where=array())
        {
			$this->db->select('type_id');

			$this->db->from($table);

			$this->db->where($where);

			$query = $this->db->get();

			if($query->num_rows()>0)
			{
	   			foreach ($query->result() as $result_row)
	   			{
	   				$data[] = $result_row->type_id;
	   			} 

	   			return 	$data;			
			}
			else
				return array();
            
        }
 
}
?>

