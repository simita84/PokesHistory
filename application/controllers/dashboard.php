<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('main.php');

class Dashboard extends Main {	 
	public function __construct()
	{
		parent::__construct();
		$this->load->Model('User');
		$this->load->Model('Poke');
		 
		if(! $this->is_login())
		{
			$this->session->set_flashdata("error_message","Please login");
			redirect(base_url('/'));
		} 
		 
		//$this->output->enable_profiler();
	}

	public function index()
	{ 
		$poke_history_for_all_users     = $this->Poke->get_pokes_history();
		$current_user                   = $this->current_user;
		$poke_history_for_a_user        = $this->Poke->get_poke_history_for_user($current_user['user_id']);
		$total_pokes_for_current_user   = $this->Poke->get_total_pokes_by_user($current_user['user_id']);
		//var_dump($poke_history_for_a_user );
		$this->load->view("dashboard/index" ,array(
											 'current_user'                 => $this->current_user,
											 'all_users_pokes'              => $poke_history_for_all_users,
											 'current_poke_history'         => $poke_history_for_a_user,
											 'total_pokes_for_current_user' => $total_pokes_for_current_user
		 				 					)
		 			     );
	}

	public function create_poke($poker_id,$poked_id)
	{
		if($this->Poke->create_poke($poker_id,$poked_id))
		{

		}
		redirect(base_url('/'));
	} 


	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('/'));
	}
}