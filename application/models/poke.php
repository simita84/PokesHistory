<?php 
Class Poke extends CI_model
{
   public function __construct()
   {
       $this->load->library('form_validation');
   }

   public function create_poke($poker_id,$poked_id)
   {
   		$poke_data = array(
			   'poker_id'     => $poker_id ,
			   'poked_id'     => $poked_id,
			   'created_at'   => date('m-d-y h:s:i'),
			   'updated_at'   => date('m-d-y h:i:s a')
		);
	$this->db->insert('pokes', $poke_data);
   }

   public function get_pokes_history()
   {
   		$select_query = "SELECT users.id,concat_ws(users.first_name, users.last_name) AS name ,     
       					 users.username, count(pokes.poked_id) as poke_count  
						 FROM users   
				    	 LEFT JOIN pokes   
				         ON users.id = pokes.poked_id   
				         GROUP BY pokes.poked_id ";

	    return ($this->db->query($select_query)->result_array());
   }

   public function get_poke_history_for_user($user_id)
   {
   		$select_query = "SELECT 
   		                concat_ws(poked_person.first_name,poked_person.last_name) AS 				poked_person_username,
        				concat_ws(poker.first_name,poker.last_name) AS poker_username,
       					count(pokes.poked_id) AS 'times_poked'   
   						FROM pokes
   						LEFT JOIN users  AS poked_person ON poked_person.id = pokes.poked_id   
   						LEFT JOIN users  AS poker        ON poker.id = pokes.poker_id 
  					    WHERE pokes.poked_id = ?     
  						GROUP BY pokes.poker_id ";
  	   return $this->db->query($select_query,$user_id)->result_array() ;
   }

   public function get_total_pokes_by_user($user_id)
   {
   	  $select_query = "	SELECT COUNT(pokes.poked_id) as total_poked       
 						FROM pokes         
 						WHERE pokes.poked_id = ?      
  						GROUP BY pokes.poked_id ";
  	 return $this->db->query($select_query,$user_id)->row_array();
   }


}