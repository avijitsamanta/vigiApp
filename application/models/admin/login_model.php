<?php class Login_model extends CI_Model {

        public $title;
        public $content;
        public $date;

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }

        public function fetch_userinfo($where=array(),$table)
        {
                $query = $this->db->get_where($table, $where);
                $val=$query->num_rows();
				if ($val) {
				 foreach ($query->result_array() as $recs => $res) {
                        $this->session->set_userdata(array(
                            'id' => $res['admin_id'],
                            'username' => $res['admin_username'],
                            'is_admin_login' => true,
                            'user_type' => $res['admin_type']
                                )
                        );
                    }
					return true;
				}else{
					return false;
				}
        }

       
}
?>
