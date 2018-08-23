<?php

/**
*
*@dec 短信中心
*
*
**/

class Onclick extends ApiController
{
	

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Ads_mdl','ads');


	}

	public function index()
	{
		
	}


	//注册短信接口
	public function register()
	{		

			if(!empty($_POST)){
				$frm = isset($_POST['frm']) ? $_POST['frm'] : 0;
				$pid = isset($_POST['pid']) ? $_POST['pid'] : 0;
				if(!empty($frm)){

					$reg_data['aid'] = $frm;
					$reg_data['dates'] = date("Y-m-d");
					$reg_data['hour'] = 'r_'.date("H");
					$this->ads->update_reg_total($reg_data);

				}

				//子渠道
				if(!empty($pid)){
					$data['pid'] = $pid;
					$this->ads->update_parent_reg($data);
				}

				echo 'ok';
			}


	}



}