<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

error_reporting(E_ALL);
ini_set("display_errors", 1);


class Comment extends CI_Controller {

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
		$this->load->model("comment_model");
			
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function add_comment()
	{
		$userid = $this->input->post('user_id');

		$post_id = $this->input->post('post_id');

		if(!empty($userid) && !empty($post_id))
		{
			$data['user_id'] = $userid;

			$data['post_id'] = $post_id;
			
			$data['cmt_desc'] = !empty($this->input->post('cmt_desc')) ? ($this->input->post('cmt_desc')):"";

			$data['cmt_posted'] = date("Y-m-d H:i:s");

			$insertid = $this->comment_model->addData('vigilant_comment',$data);	

			if(!empty($insertid))
			{
				$result = array('status'=>1,'message'=>'Comment added successfully');
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

		

   	public function comment_details()
	{
	
		$userid = !empty($this->input->post('user_id'))?($this->input->post('user_id')):'';
		
		$comment_id = $this->input->post('comment_id');
		
		if(!empty($comment_id))
		{
			
			$where = array('cmt_id'=>$comment_id);

			$data['comment_details'] = $this->comment_model->get_comment_details('vigilant_comment',$where,$userid);	

			//print_r($data['comment_details']);exit;

			if(!empty($data['comment_details']))
			{
				
				$result = array('status'=>1,'message'=>'success','result'=> $data['comment_details']);
				
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


   public function updateComment()
	{
	
		$userid = !empty($this->input->post('user_id'))? $this->input->post('user_id'):'';

		$comment_id = $this->input->post('comment_id');

		
		if(!empty($comment_id))
		{
		
			if(!empty($this->input->post('comment_desc')))
			{
				$data['cmt_desc'] = $this->input->post('comment_desc');
			}

			$data['cmt_updated'] = date("Y-m-d H:i:s"); 

			$where =  array("cmt_id"=>$comment_id,"user_id"=>$userid);

			$get_comment = $this->comment_model->getRow('vigilant_comment',$where); 

			if(!empty($get_comment))
			{

				$where =  array("cmt_id"=>$comment_id);
			
				$update_comment=$this->comment_model->updateData('vigilant_comment',$where,$data);	

				if($update_comment)
				{
					
					$result = array('status'=>1,'message'=>'Update success');
					
				}
				else
				{
					
					$result = array('status'=>0,'message'=>'Fail');
				}
			}
			else{

				$result = array('status'=>0,'message'=>'Comment can not be updated');
			}		
		}
		else
		{
			$result = array('status'=>0,'message'=>'parameter missing.');
		}

		echo json_encode($result);
		
	}

	public function delete_comment()
	{

	 	$userid = !empty($this->input->post('user_id'))? $this->input->post('user_id'):'';

		$comment_id = $this->input->post('comment_id');

		
		if(!empty($comment_id))
		{
			$where =  array("cmt_id"=>$comment_id);

			$get_comment = $this->comment_model->getRow('vigilant_comment',$where); 

			if(!empty($get_comment))
			{

				$post_id = $get_comment->post_id;

				$where =  array("post_id"=>$post_id);

				$get_post = $this->comment_model->getRow('vigilant_posts',$where);

				if(($get_comment->user_id == $userid) || ($get_post->user_id == $userid))
				{
					
					$where =  array("cmt_id"=>$comment_id);

					$delete_comment=$this->comment_model->DeleteData('vigilant_comment',$where);	

					if($delete_comment)
					{
						
						$result = array('status'=>1,'message'=>'Delete success');
						
					}
					else
					{
						
						$result = array('status'=>0,'message'=>'Fail');
					}
				}
				else{

					$result = array('status'=>0,'message'=>'Comment Can not be deleted');
				} 
				
			}
			else{

				$result = array('status'=>0,'message'=>'Fail');
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
