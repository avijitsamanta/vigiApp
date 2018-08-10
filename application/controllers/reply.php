<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

error_reporting(E_ALL);
ini_set("display_errors", 1);


class Reply extends CI_Controller {

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
		$this->load->model("reply_model");
			
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function add_reply()
	{
		$userid = $this->input->post('user_id');

		$comment_id = $this->input->post('comment_id');


		if(!empty($userid) && !empty($comment_id))
		{
			$data['user_id'] = $userid;

			$data['cmt_id'] = $comment_id;
			
			$data['reply_desc'] = !empty($this->input->post('reply_desc')) ? ($this->input->post('reply_desc')):"";

			$data['reply_added'] = date("Y-m-d H:i:s");

			$insertid = $this->reply_model->addData('vigilant_reply',$data);	

			if(!empty($insertid))
			{
				$result = array('status'=>1,'message'=>'Reply added successfully');
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

		

   public function updateReply()
	{
	
		$userid = !empty($this->input->post('user_id'))? $this->input->post('user_id'):'';

		$reply_id = $this->input->post('reply_id');

		
		if(!empty($reply_id))
		{
		
			if(!empty($this->input->post('reply_desc')))
			{
				$data['reply_desc'] = $this->input->post('reply_desc');
			}

			$data['reply_updated'] = date("Y-m-d H:i:s");

			$where =  array("reply_id"=>$reply_id);

			$get_reply = $this->reply_model->getRow('vigilant_reply',$where); 

			if(!empty($get_reply))
			{

				$where =  array("reply_id"=>$reply_id);
			
				$update_reply=$this->reply_model->updateData('vigilant_reply',$where,$data);	

				if($update_reply)
				{
					
					$result = array('status'=>1,'message'=>'Update success');
					
				}
				else
				{
					
					$result = array('status'=>0,'message'=>'Fail');
				}
			}
			else{

				$result = array('status'=>0,'message'=>'Reply can not be updated');
			}		
		}
		else
		{
			$result = array('status'=>0,'message'=>'parameter missing.');
		}

		echo json_encode($result);
		
	}

	public function delete_reply()
	{

	 	$userid = !empty($this->input->post('user_id'))? $this->input->post('user_id'):'';

		$reply_id = $this->input->post('reply_id');

		
		if(!empty($reply_id))
		{
			$where =  array("reply_id"=>$reply_id);

			$get_reply = $this->reply_model->getRow('vigilant_reply',$where); 

			if(!empty($get_reply))
			{

				if($get_reply->user_id == $userid)
				{
					
					$where =  array("reply_id"=>$reply_id);

					$delete_reply=$this->reply_model->DeleteData('vigilant_reply',$where);	

					if($delete_reply)
					{
						
						$result = array('status'=>1,'message'=>'Delete success');
						
					}
					else
					{
						
						$result = array('status'=>0,'message'=>'Fail');
					}
				}
				else{

					$result = array('status'=>0,'message'=>'Reply Can not be deleted');
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
