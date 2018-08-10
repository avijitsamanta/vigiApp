<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

error_reporting(E_ALL);
ini_set("display_errors", 1);


class Post extends CI_Controller {

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
		$this->load->model("post_model");
			
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function add_post()
	{
		$userid = $this->input->post('user_id');

		$post_desc = $this->input->post('post_desc');

		if(!empty($userid) && !empty($post_desc))
		{
			$data['user_id'] = $userid;

			$data['post_desc'] = $post_desc;

			$data['posted_date'] = date("Y-m-d H:i:s");

			$insertid = $this->post_model->addData('vigilant_posts',$data);	


			if(!empty($insertid))
			{
				
				$result = array('status'=>1,'message'=>'Post added successfully');

			}
			else
			{
				$result = array('status'=>0,'message'=>'error');
			}
		}
		else{

			$result = array('status'=>0,'message'=>'parameter missing');
		}
		echo json_encode($result);		
	}


	public function get_all_post()
	{
		
		$userid = $this->input->post('user_id');

		if(!empty($userid))
		{
			$where = array('user_id'=>$userid);

			$get_row=$this->post_model->getRow('vigilant_user_hlocation',$where);

			if($get_row)
			{
				$orgLat = $get_row->lat;
				$orgLong = $get_row->long;
			}

			$where = array();

			$per_page = 10;

	         if( !empty($_POST['page_no']) || ($_POST['page_no']) !=0) {
	            $page = $_POST['page_no'] ;
	            $offset=($page-1)*$per_page;
	            //$offset = $per_page * $page ;
	         }else {
	            $page = 0;
	            $offset = 0;
	         }

	         if(!empty($orgLat) && !empty($orgLong))
	         {
				$data['postDetalis'] = $this->post_model->get_all_post('vigilant_posts',$where,$userid,$offset,$per_page,$orgLat,$orgLong);

				//print_r($data['userdetails']);exit;

				if(!empty($data['postDetalis']))
				{
					$num_rows=$this->post_model->get_num_rows('vigilant_posts',$per_page,$orgLat,$orgLong);

					//print_r($num_rows);exit;


					$result = array('status'=>1,'message'=>'success','total_records'=>$num_rows['total_records'],'total_pages'=>$num_rows['total_pages'],'result'=> $data['postDetalis']);

				}
				else
				{
					$result = array('status'=>0,'message'=>'No records found','result'=> $this->obj);
				}

	         }
	         else
	         {
	         	$result = array('status'=>0,'message'=>'No location Found.','result'=> $this->obj);
	         }

			
		}		
		else{

			$result = array('status'=>0,'message'=>'parameter missing');
		}
		echo json_encode($result);
		
	}


   public function updatePost()
	{
	
		//$userid = $this->input->post('user_id');

		$post_id = $this->input->post('post_id');
	
		if(!empty($post_id))
		{
		
			if(!empty($this->input->post('post_desc')))
			{
				$data['post_desc'] = $this->input->post('post_desc');
			}


			$data['post_updated'] = date("Y-m-d H:i:s"); 

			$where = array('post_id' => $post_id);

			$comment_details = $this->post_model->getRow('vigilant_comment',$where); 

			if(empty($comment_details))
			{
			
				$update_post=$this->post_model->updateData('vigilant_posts',$where,$data);

				$result = array('status'=>1,'message'=>'Update success');	
				
			}
			else
			{
				//$delete_post=$this->post_model->DeleteData('vigilant_posts',$where);

				$result = array('status'=>0,'message'=>'You can not edit this post only can delete');	
			}
		}
		else
		{
			$result = array('status'=>0,'message'=>'parameter missing.');
		}

		echo json_encode($result);
		
	}

	public function delete_post()
	{

	 	$post_id = $this->input->post('post_id');
	 	
	 	if(!empty($post_id))
		{

			$where = array('post_id' => $post_id);
		
			
			$del_post = $this->post_model->DeleteData('vigilant_posts',$where);

			if($del_post)
			{

				$result = array('status'=>1,'message'=>'Post Deleted successfully');
			}
			else
			{
				$result = array('status'=>0,'message'=>'Fail');
			}		
	 	}
	 	else
	 	{
	 		$result = array('status'=>0,'message'=>'Parameter Missing');
	 	}

	 	echo json_encode($result);
		
	}

	public function post_details()
	{

		$post_id = $this->input->post('post_id');

		$userid = !empty($this->input->post('user_id'))?($this->input->post('user_id')):'';
	 	
	 	if(!empty($post_id))
		{
			$where = array('vigilant_posts.post_id' => $post_id);

			$get_post_details = $this->post_model->get_post_details('vigilant_posts',$where,$userid);

			//print_r($get_post_details);exit;

			if(!empty($get_post_details))
			{
				$where = array('post_id' => $post_id,'reported_by'=>$userid);

				$getRoportedPost = $this->post_model->getRow('vigilant_reported_post',$where);

				if(!empty($getRoportedPost))
				{
					$get_post_details['is_reported'] = 1;
				}
				else
				{
					$get_post_details['is_reported'] = 0;
				}
				

				$result = array('status'=>1,'message'=>'success','result'=>$get_post_details);
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

	public function reported_post1()
	{

		$post_id = $this->input->post('post_id');

		//$is_report = !empty($this->input->post('is_report'))?($this->input->post('is_report')):1;
		$is_report = $this->input->post('is_reported');

		$userid = !empty($this->input->post('reported_by'))?($this->input->post('reported_by')):'';

		$reason = !empty($this->input->post('reason'))?($this->input->post('reason')):'';
	 	
	 	if(!empty($post_id) && !empty($userid))
		{
			$where = array('post_id' => $post_id);

			$get_post_details = $this->post_model->getRow('vigilant_posts',$where);

			//print_r($get_post_details);exit;

			if(!empty($get_post_details))
			{
				$data['is_report'] = $is_report;

				$data['reported_user_id'] = $userid;
				
				$data['reason'] = $reason;

				$where1 = array('post_id' => $post_id,'reported_user_id'=>$userid);

				$get_reported_post_details = $this->post_model->getRow('vigilant_posts',$where1);

				//print_r($get_reported_post_details);exit;

				if(!empty($get_reported_post_details))
				{
					$result = array('status'=>0,'message'=>'You have already reported this post');
				}
				else
				{

					$update_post=$this->post_model->updateData('vigilant_posts',$where,$data);

					$result = array('status'=>1,'message'=>'Reporting of the post is success');		
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

	public function reported_post()
	{

		$post_id = $this->input->post('post_id');

		//$is_report = !empty($this->input->post('is_report'))?($this->input->post('is_report')):1;
		$is_report = $this->input->post('is_reported');

		$userid = !empty($this->input->post('reported_by'))?($this->input->post('reported_by')):'';

		$reason = !empty($this->input->post('reason'))?($this->input->post('reason')):'';
	 	
	 	if(!empty($post_id) && !empty($userid))
		{
			$where = array('post_id' => $post_id);

			$get_post_details = $this->post_model->getRow('vigilant_posts',$where);

			//print_r($get_post_details);exit;

			if(!empty($get_post_details))
			{
				$data['post_id'] = $post_id;

				$data['is_reported'] = $is_report;

				$data['reported_by'] = $userid;
				
				$data['reason'] = $reason;

				$where1 = array('post_id' => $post_id,'reported_by'=>$userid);

				$get_reported_post_details = $this->post_model->getRow('vigilant_reported_post',$where1);

				//print_r($get_reported_post_details);exit;

				if(!empty($get_reported_post_details))
				{
					$result = array('status'=>0,'message'=>'You have already reported this post');
				}
				else
				{

					$update_post=$this->post_model->addData('vigilant_reported_post',$data);

					$result = array('status'=>1,'message'=>'Reporting of the post is success');		
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
