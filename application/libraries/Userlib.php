<?php



class Userlib
{


	public static $_ci;

	public function __construct()
	{
		self::$_ci = & get_instance();//php 5.3中self改为static
	}



	//用户登陆
	public function user_login($data=array())
	{

		$cookie_key = self::$_ci->config->item('admin_session');
		self::$_ci->session->set_userdata($cookie_key,json_encode($data));

		return 1;

	}

	//验证用户登陆
	public function check_user_login()
	{

		$cookie_key = self::$_ci->config->item('admin_session');
		$token = self::$_ci->session->userdata($cookie_key);

		$userinfo = array();
		if(!empty($token)){
			$userinfo = json_decode($token,true);
		}
		
		return $userinfo;

	}

	//退出登陆
	public function user_logout()
	{

		$cookie_key = self::$_ci->config->item('admin_session');
		self::$_ci->session->set_userdata($cookie_key,'');
		self::$_ci->session->unset_userdata($cookie_key);

		return 1;
	}

	//前端用户登陆
	public function guest_user_login($data=array())
	{

		$cookie_key = self::$_ci->config->item('guest_session');
		self::$_ci->session->set_userdata('guest_session',json_encode($data));

		return 1;

	}

	public function check_guest_login()
	{

		//$cookie_key = self::$_ci->config->item('guest_session');
		$token = self::$_ci->session->userdata('guest_session');
		$userinfo = array();
		if(!empty($token)){
			$userinfo = json_decode($token,true);
		}
		
		return $userinfo;

	}

	public function check_role($role_tag,$type='')
	{

		$token = $this->check_user_login();
		$_role = array();
		
		$_role_where['where'] = array('role_id'=>$token['role']);
		self::$_ci->load->model('Role_author_mdl','role_author');
		$_role = self::$_ci->role_author->getList($_role_where);
		
		if(empty($_role)){
			if(empty($type)){
				$data['msg'] = '无权限';
				redirect('/home/msgtips/check_role',$data);
			}else{
				return false;
			}


		}

		$_role_arr = array();
		foreach($_role as $_k => $_v){
			$_role_arr[] = $_v['role_tag'];
		}

		if(!in_array($role_tag, $_role_arr)){
			
			if(empty($type)){
				$data['msg'] = '无权限';
				redirect('/home/msgtips/check_role',$data);
			}else{
				return false;
			}

		}

		//return $_role;
		return $_role_arr;

	}

	public function check_hidden($role_tag)
	{
		$token = $this->check_user_login();
		$_role = array();		
		$_role_where['where'] = array('role_id'=>$token['role']);
		self::$_ci->load->model('Role_author_mdl','role_author');
		$_role = self::$_ci->role_author->getList($_role_where);		
		return $_role;
	}


}