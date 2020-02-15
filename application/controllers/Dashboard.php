<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/core/MY_Protectedcontroller.php';

class Dashboard extends MY_Protectedcontroller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('slice');
		$this->load->library('form_validation');

		if($this->session->user_login['username']){
			$this->username = $this->session->user_login['username'];			
		}

		$this->can_read = ['a01', 'd01', 'p01', 'ap01'];
		$this->can_write = ['a01', 'd01', 'p01', 'ap01'];
		
		if(!in_array($this->session->user_login['role'], $this->can_read))
		{
			show_404();
		}
	}

	public function index()
	{
		$this->slice->view('dashboard/index');
	}

	public function about()
	{
		$this->slice->view('shop/about');
	}

	public function contact()
	{
		$this->slice->view('shop/contact');
	}
}
