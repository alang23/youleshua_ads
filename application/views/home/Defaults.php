<?php


class Defaults extends Zrjoboa
{
	

	public function __construct()
	{
		parent::__construct();
	}


	public function index()
	{
		$userinfo = $this->userinfo;
		$data['userinfo'] = $userinfo;
		$roleinfo = $this->userlib->check_hidden('');
		$list =array();
		foreach ($roleinfo as $k => $v) {
			$list[] = $v['role_tag'];
		}
		$data['list'] = $list;	
		print_r($list);

		$this->tpl('home/defaults_tpl',$data);
	}
}