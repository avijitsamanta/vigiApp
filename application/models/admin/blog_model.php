<?php class Blog_model extends CI_Model {

        //public $title;
        //public $content;
        //public $date;

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }

        public function getData($table)
        {
                $query = $this->db->get($table);
				
				return $query->result();
            
        }
		
		public function blogDetails($table,$where=array()){
		
			    $query = $this->db->get_where($table,$where);
				
				return $query->result();
		
		}
		
		public function blogUpdate($table,$id,$data=array(),$mode=''){
		
		if($mode=='edit'){
				$this->db->where('blog_id',$id);
				
				$this->db->update($table, $data); 
			
			}
			else{
			$this->db->insert($table, $data); 
			}
		}
		
		public function blogDelete($table,$where,$mode){

			if($mode=='single'){
				$this->db->delete($table, $where); 
			}else{
				 $this->db->where_in('blog_id', $where);
        		$this->db->delete($table);
			
			}
		}
		public function changeStatus($table,$blog_id,$data){
		
				$this->db->where('blog_id',$blog_id);
				
				$this->db->update($table, $data); 
		
		}
		public function blogReplyDetails($table1,$table2,$id){
		
				$this->db->select($table2.'.*,'.$table1.'.blog_title');
				$this->db->from($table2);
               	$this->db->join($table1, $table1.'.blog_id = '.$table2.'.blog_id', 'left');
				
                $this->db->where($table2.'.blog_id',$id);
                $query = $this->db->get();
				
				return $query->result();

		
		}
		
		public function replyUpdate($table,$id,$data=array()){
		

				$this->db->where('reply_id',$id);
				
				$this->db->update($table, $data); 
		
			
		}
				public function changeReplyStatus($table,$reply_id,$data){
		
				$this->db->where('reply_id',$reply_id);
				
				$this->db->update($table, $data); 
				
			
		
		}

       
}
?>
