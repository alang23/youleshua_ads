<?php


class Lakala extends BaseController
{
	


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Business_mdl','business');
		$this->load->library('Messagelib','messagelib');

	}

	public function index()
	{
		
		$this->tpl('lakala_tpl');
	}



}