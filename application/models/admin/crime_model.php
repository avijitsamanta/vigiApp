<?php class Crime_model extends CI_Model 
{

        //public $title;
        //public $content;
        //public $date;

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }

        public function getCrimes($table)
        {

				$this->db->from($table);
				
				$this->db->order_by("crime_name", "asc");
				
				$query = $this->db->get(); 
				
				return $query->result();

               
        }
		
		public function crimeDetails($table,$where=array())
		{
		
			    $query = $this->db->get_where($table,$where);
				
				return $query->result();
		
		}
		
		public function crimeUpdate($table,$id,$data=array(),$mode='')
		{
		
			if($mode=='edit')
			{
				$this->db->where('type_id',$id);
				
				$this->db->update($table, $data); 
			}
			else
			{
				$this->db->insert($table, $data); 
			}
		}
		
		public function crimeDelete($table,$where,$mode)
		{

			if($mode=='single')
			{
					$this->db->delete($table, $where); 
					//echo $this->db->last_query();exit;
			}
			else
			{
				 	$this->db->where_in('type_id', $where);
        			
        			$this->db->delete($table);
			
			}
		}
		
		public function changeStatus($table,$type_id,$data)
		{
		
				$this->db->where('type_id',$type_id);
				
				$this->db->update($table, $data); 
				//echo $this->db->last_query();exit;
		}
       
}
?>
