<?php


class Common_mdl extends Zroa_Model
{
	
	var $table_name = 'ls_admin';
	var $table_logistics = 'ls_logistics';
	var $table_business = 'ls_business';


	public function __construct()
	{
		parent::__construct();
		$this->set_table_name($this->table_name);
	}


	//改变订单状态，物流状态，
	public function change_status($data = array())
	{

		//修改物流
		$sql_logistics = "UPDATE ".$this->table_logistics.' SET `status`='.$data['status'].', `remark`= " '.$data['remark'].'" WHERE `phone`="'.$data['phone'].'"';
		$sql_business = "UPDATE ".$this->table_business.' SET  `status`='.$data['status'].' WHERE `phone`="'.$data['phone'].'"';

		$this->db->query($sql_logistics);
		$this->db->query($sql_business);

	}

	//获取代理商短信数量
	public function get_agent_msg()
	{
		$sql = "select count(channel_id) as total,channel_id from ls_message_log group by channel_id";
		$query = $this->db->query($sql);
		$list = $query->result_array();

		return $list;

	}

	//获取客服发送短信
	public function get_users_msg($data)
	{
		$sql = "select count(user_id) as total,user_id from ls_message_log where channel_id='".$data['channel_id']."' group by user_id ";
		$query = $this->db->query($sql);
		$list = $query->result_array();

		return $list;

	}

	//
	public function get_users_msg_theday($data)
	{
		$theday = date("Y-m-d");
		//$theday = '2018-02-01';
        $tomorrow = mktime(0,0,0,date("m"),date("d")+1,date("Y"));
        $thedaytime = strtotime($theday);

        $sql = "select count(user_id) as total,user_id from ls_message_log where channel_id='".$data['channel_id']."' and addtime > ".$thedaytime." and addtime < ".$tomorrow." group by user_id ";
       
		$query = $this->db->query($sql);
		$list = $query->result_array();

		return $list;
	}


	
}