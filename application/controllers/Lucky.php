<?php


class Lucky extends BaseController
{
	


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Lottery_mdl','lottery');
	}

	public function index()
	{
		$userinfo = $this->userinfo;
		//$userinfo['phone'] = '15889724231';
		$phone = $userinfo['phone'];

		$data['userinfo'] = $userinfo;

		//检查时间
		$c_where['where']['display'] = '0';
		$c_list = $this->lottery->getList($c_where);
		$_id = array();
		if(count($c_list) > 0){
			foreach($c_list as $k => $v){
				$time = time();
				$end_time = $v['addtime']+604800;
				if($end_time < $time){
					$_data['display'] = '1';
					$_data['lottery_type'] = '1';
					$_data['display_time'] = $end_time;
					$_update_config['id'] = $v['id'];
					$this->lottery->update($_update_config,$_data);
				}
			
			}
		} 

		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$data['id'] = $id;

		$lottery = array();

		if(!empty($id)){
			$where['where']['act_id'] = $id;
		}

		//中奖
		if(isset($_GET['winning'])){
			$where['where']['winning'] = intval($_GET['winning']);
		}

		//开奖
		if(isset($_GET['display'])){
			$where['where']['display'] = intval($_GET['display']);
		}
		$where['where']['phone'] = $phone;
		$lottery = $this->lottery->getList($where);
		$data['lottery'] = $lottery;

		$this->tpl('lucky_tpl',$data);
	}

	//开奖-系统
	public function lotto()
	{
		//$phone = $this->input->get('phone');
		$id = $this->input->get('id');
		$userinfo = $this->userinfo;
		//$userinfo['phone'] = '15889724231';
		$phone = $userinfo['phone'];
		$update_config = array('phone'=>$phone,'act_id'=>$id,'display'=>'0');
		$display_time = time();
		$update_data = array('display'=>1,'lottery_type'=>2,'display_time'=>time());
		$this->lottery->update($update_config,$update_data);
		//print_R($update_config);
		redirect('/lucky/index?id='.$id);

	}

	//个人刮奖
	public function lotto_self()
	{
		$userinfo = $this->userinfo;
		$phone = $userinfo['phone'];
		$id = $this->input->post('id');
		
		$config = array('id'=>$id,'phone'=>$phone);
		$update_data['display'] = 1;
		$update_data['lottery_type'] = 1;
		$update_data['display_time'] = time();
		if($this->lottery->update($config,$update_data)){

			$where['where'] = $config;
			$info = $this->lottery->get_one_by_where($where);

			$msg = array(
				'code'=>'0',
				'msg'=>'刮奖成功',
				'data'=>$info['winning']
				);
			
	
		}else{
			$msg = array(
				'code'=>'1',
				'msg'=>'系统有误,请联系客服',
				'data'=>'0'
				);
		}

		echo json_encode($msg);
	}
}