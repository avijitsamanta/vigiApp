<?php class Service_model extends CI_Model {

        //public $title;
        //public $content;
        //public $date;

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }

        public function getServices($table)
        {
                $query = $this->db->get($table);
				
				return $query->result();
            
        }
		
		public function serviceDetails($table,$where=array()){
		
			    $query = $this->db->get_where($table,$where);
				
				return $query->result();
		
		}
		
		public function serviceUpdate($table,$id,$data=array(),$mode=''){
		
		if($mode=='edit'){
				$this->db->where('service_id',$id);
				
				$this->db->update($table, $data); 
			}
			else{
			$this->db->insert($table, $data); 
			}
		}
		
		public function serviceDelete($table,$where,$mode){

			if($mode=='single'){
				$this->db->delete($table, $where); 
			}else{
				 $this->db->where_in('service_id', $where);
        		$this->db->delete($table);
			
			}
		}
		public function changeStatus($table,$service_id,$data){
		
				$this->db->where('service_id',$service_id);
				
				$this->db->update($table, $data); 
		
		}
       
}
?>
