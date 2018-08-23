<?php


class Source extends Zrjoboa
{
	


	public function __construct()
	{
		parent::__construct();
	}


	public function index()
	{
		$this->tpl('mobile/source_tpl');
	}

}