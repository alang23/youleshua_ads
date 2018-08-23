<?php


class Test extends BaseController
{
	

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Account_mdl','admin');
		$this->load->library('Smsapi','smsapi');
		$this->load->library('My_excel','my_excel');
		$this->load->library('Wuliulib','wuliulib');
		$this->load->model('Logistics_mdl','logistics');
		$this->load->model('Business_mdl','business');
		$this->load->model('Trade_mdl','trade');
		$this->load->model('Ads_mdl','ads');
		$this->load->model('Statistics_mdl','statistics');
		$this->load->model('User_channel_mdl','user_channel');


	}


	public function index()
	{

	
		// $ads = $this->ads->getList();

		// foreach($ads as $k => $v){
		// 	$update_config['aid'] = $v['id'];
		// 	$update_data['bili_pv'] = $v['pv_base'];
		// 	$update_data['bili_uv'] = $v['uv_base'];
		// 	$update_data['bili_reg'] = $v['uv_base'];
		// 	$this->statistics->update($update_config,$update_data);
		// }
				//短信剩余
		$ret = $this->smsapi->queryBalance();
		$data['message'] = $ret;
		print_r($ret);


	}

	//发送短信
	public function sendmsg()
	{
		    $data['phone'] = '18664918796,15814073945';
    		$data['msg'] = '【拉卡拉支付】';
			$ret = $this->smsapi->send_msg($data);
			var_dump($ret);
	}

	public function get_parant($url)
	{

		$pos = strpos($url, '?');
		$str = substr($url,$pos+1,strlen($url));
		$arr = explode('&', $str);
		$_url = array();
		foreach($arr as $k => $v){
			$_arr = explode('=', $v);
			$_url[$_arr[0]] = $_arr[1];
		}
		
		return $_url;

	}

	public function get_ref()
	{
		echo "<a href='/test'>链接</a>";
	}

	public function tongji()
	{
		// $sql = "select logis.*,trade.trade_total,trade.pay_type from ls_logistics as logis left join (select sum(amount) as trade_total,p_sn,pay_type from ls_trade  GROUP BY p_sn) as trade on logis.dev_sn=trade.p_sn where trade.trade_total >=3000 and trade.pay_type='贷记卡'";

		// $sql = "select * from ls_logistics where `status`=8 and phone not in(select phone from ls_business where channel_id='10003' and merchant_id=2 and `status`=8)";
	
		$sql = "select max(id) as id,dev_sn from ls_logistics where dev_sn in(
 select dev_sn from ls_standard where dabiao='是' and dev_sn not in(select dev_sn from ls_logistics where status=8) order by id desc
) group by dev_sn";

//开通单没达标
// 		$sql = " select max(id) as id,dev_sn from ls_logistics where dev_sn in(
//  select dev_sn from ls_standard where dabiao='否' order by id desc
// ) group by dev_sn";

		$query = $this->db->query($sql);
		$arr = $query->result_array();
		
		$i = 0;
		foreach($arr as $k => $v){
			$update_config['id'] = $v['id'];
			$update_data['status'] = 8;
			if($this->logistics->update($update_config,$update_data))
			{
				$i++;

			}
		}
		echo $i;
		exit;
		
		/*
		$sql = "select * from ls_logistics where status=8 group by id desc";
		$query = $this->db->query($sql);
		$arr = $query->result_array();
		$i = 0;
		foreach($arr as $k => $v){

			$update_config['phone'] = $v['phone'];
			$update_config['channel_id'] = '10003';
			$update_data['status'] = 8;
			//修改物流
			
			if($this->business->update($update_config,$update_data))
			{
				echo 'ok';
				echo '<br/>';
				$i++;
			}
			
		
		}
		
		echo $i;
		
			*/

		

	}

	public function change()
	{
		exit;
		$list = array();
		$where['where']['status'] = 0;
		$where['where']['addtime > '] = '1504195200';
		//$where['where']['user_id'] = 0;
		$where['order'] = array('key'=>'id','value'=>'asc');
		$where['page'] = true;
        $where['limit'] = 2475;
        $where['offset'] = 0;

        $list = $this->business->getList($where);
       
        foreach($list as $k => $v){

        	$update_config['id'] = $v['id'];
        	$update_data['user_id'] = 0;
        	$this->business->update($update_config,$update_data);
        }

	}

	public function excel()
	{
		$list = $this->ads_parent->getList();
		foreach($list as $k => $v){
			$_tmp['id'] = $k+1;
			$_tmp['name'] = $v['name'];
			$_tmp['url'] = base_url().'dclick/dredirect?aid='.$v['aid'].'&pos_id='.$v['pos_id'].'&pid='.$v['id'].'&redirect='.urlencode('http://app.1chuanqi.com/defaults/index');

			$arr[] = $_tmp;
		}

		$title = '百度关键字'.'.xls';
		$this->my_excel->export_ads($arr,$title);


	}


	public function xiugai()
	{
		$sql = " select * from ls_logistics_copy where dev_sn like 'GO%'";

		$query = $this->db->query($sql);
		$arr = $query->result_array();
		$count = 0;
		foreach($arr as $k => $v)
		{
			$update_config['phone'] = $v['phone'];
			$update_data['status'] = $v['status'];
			if($this->logistics->update($update_config,$update_data)){
				$count++;
			}
		}
		echo $count;

	}

	public function user_channel()
	{

		$sql_new = "select * from ls_user_channel where channel_id='10006'";
		$query_new = $this->db->query($sql_new);
		$arr_new = $query_new->result_array();
		foreach($arr_new as $k => $v){
			$ids[] = $v['id'];
		}

	

		$sql = " select * from ls_user_channel_old where group_id='10006'";
		$query = $this->db->query($sql);
		$arr = $query->result_array();
		

		foreach($arr as $kk => $vv){
			if(!in_array($vv['id'],$ids)){
				$add['id'] = $vv['id'];
				$add['title'] = $vv['title'];
				$add['username'] = $vv['username'];
				$add['pawd'] = $vv['pawd'];
				$add['addtime'] = $vv['addtime'];
				$add['channel_id'] = $vv['channel_id'];
				$add['types'] = $vv['types'];
				$add['parent_id'] = $vv['parent_id'];
				$add['group_id'] = $vv['group_id'];

				$this->user_channel->add($add);
			}
			
		}


	}


	public function wuliu()
	{
		$admin = $this->admin->getList();
		foreach($admin as $k => $v){
			$a[$v['id']] = $v['realname'];
		}
		$i = 0;
		$logis = $this->logistics->getList();
		foreach($logis as $lk => $lv){
			$info = $this->get_userid($lv['phone']);
			$update_config['id'] = $lv['id'];
			$update_data['uid'] = isset($info['user_id']) ? $info['user_id'] : 0;
			$update_data['admin_name'] = isset($a[$info['user_id']]) ? $a[$info['user_id']] : '未知';
			if($this->logistics->update($update_config,$update_data)){
				$i++;
			}
		}
		echo $i;
	}

	public function get_userid($phone)
	{
		$where['where']['phone'] = $phone;
		$info = $this->business->get_one_by_where($where);

		return $info;
	}

/*
	public function xiub()
	{
		$id_99 = array('96','97','98','99','100');
		$where['where']['addtime >='] = '1531130036';
		$where['where']['addtime<='] = '1531147018';
		$where['where']['channel_id'] = '10003';
		$list = $this->business->getList($where);

		$i = 0;
		foreach($list as $k => $v){

			if(in_array($v['frm'], $id_99)){
				$ad_name = $v['ad_name'].'(99)';
			}else{
				$ad_name = $v['ad_name'].'(18)';
			}

			$update_config['id'] = $v['id'];
			$update_data['ad_name'] = $ad_name;
			if($this->business->update($update_config,$update_data)){
				$i++;
			}
		}

		echo $i;
	}

*/






}