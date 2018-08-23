<?php
/**
*
*@dec 广告统计
*
**/


class Tongji extends Zrjoboa
{



	public function __construct()
	{
		parent::__construct();
		$this->load->model('Ads_mdl','ads');
		$this->load->model('Adsense_mdl','adsense');
	}



	public function index()
	{


		$ads = array();
		$ads = $this->ads->date_count();
		$data['ads'] = $ads;
		


	}


}