<?php



class Login extends CI_Controller
{
	


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Account_mdl','account');
		$this->load->library('Authcode','authcode');
		$this->load->helper('Common');

	}


	public function index()
	{	
		
		$ismobile = isMobile();
		
		// if($ismobile){

		// 	$this->load->view('mobile/login_tpl');

		// }else{
		// 	$this->load->view('home/login_tpl');

		// }

		$this->load->view('home/login_tpl');
		
		
	}


	public function user_login()
	{

		$username = $this->input->post('username');
		$pawd = $this->input->post('pawd');

		if(empty($username) || empty($pawd)){
			$msg = array(
				'code'=>1,
				'msg'=>'用户名和密码不能为空'
			);
			responseData($msg);
		}
		
		$check_code = $this->session->userdata('auth_code');
		$acode = $this->input->post('acode');

		if($acode != $check_code){
			
			$msg = array(
				'code'=>'1',
				'msg'=>'验证码错误'
				);
			echo json_encode($msg);
			exit;
		}
		

		//验证用户
		$config['where'] = array('username'=>$username);
		$account_info = $this->account->get_one_by_where($config);
		if(empty($account_info)){
			$msg = array(
				'code'=>2,
				'msg'=>'用户不存在'
				);
			responseData($msg);
		}

		if($account_info['isdel'] == '1'){
			$msg = array(
				'code'=>6,
				'msg'=>'限制登录'
				);
			responseData($msg);
		}

		//验证密码
		$_pawd = user_pawd($pawd);
		if($_pawd != $account_info['pawd']){
			$msg = array(
				'code'=>3,
				'msg'=>'密码错误'
				);
			responseData($msg);
		}

			//修改登录信息
		unset($account_info['pawd']);
		

		
		$user = $this->userlib->user_login($account_info);


		$msg = array(
			'code'=>0,
			'msg'=>'登陆成功'
			);
		responseData($msg);

	}

	public function logout()
	{
		$this->userlib->user_logout();
		redirect('/home/login');
	}

	public function show()
	{

		$this->authcode->show();
		
	}


	public function check_code()
	{
		$check_code = $this->session->userdata('auth_code');
		$acode = $this->input->post('acode');

		if($acode != $check_code){
			
			$msg = array(
				'code'=>'1',
				'msg'=>'验证码错误'
				);
			echo json_encode($msg);
			exit;
		}else{

			$msg = array(
				'code'=>'0',
				'msg'=>'ok'
				);
			echo json_encode($msg);
			exit;
		}
	}

	public function getauthcode()
    {
        echo  $this->authcode->show();

    }




}


