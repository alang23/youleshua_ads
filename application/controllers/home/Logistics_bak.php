<?php

class Logistics extends Zrjoboa
{
	

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Logistics_mdl','logistics');
		$this->load->library('My_excel','my_excel');
		$this->load->model('Business_mdl','business');
		$this->load->model('Common_mdl','common_mdl');
		$this->load->library('Wuliulib','wuliulib');



	}


	public function index()
	{

		$check_role = $this->userlib->check_role('search_logistics');

		$userinfo = $this->userinfo;
		$page = isset($_GET['page']) ? $_GET['page'] : 0;
        $page = ($page && is_numeric($page)) ? intval($page) : 1;
        $data['pagenum'] = $page;

        $show_time = isset($_GET['show_time']) ? $_GET['show_time'] : '';
        $end_time = isset($_GET['end_time']) ? $_GET['end_time'] : '';
        $order_id = isset($_GET['order_id']) ? $_GET['order_id'] : '';
        $realname = isset($_GET['realname']) ? $_GET['realname'] : '';
        $phone = isset($_GET['phone']) ? $_GET['phone'] : '';
        $status = isset($_GET['status']) ? $_GET['status'] : 'all';
        $cbc = isset($_GET['cbc']) ? $_GET['cbc'] : '';


        $data['show_time'] = $show_time;
        $data['end_time'] = $end_time;
        $data['order_id'] = $order_id;
        $data['realname'] = $realname;
        $data['phone'] = $phone;
        $data['status'] = $status;
        $data['cbc'] = $cbc;
       // print_r($data);

        if(!empty($show_time)){
        	$s_time = strtotime($show_time);
        	$where['where']['addtime >'] = $s_time;
        	$countwhere['addtime >'] = $s_time;
        	if(!empty($end_time)){
        		$e_time = strtotime($end_time);
        		$where['where']['addtime <'] = $e_time;
        		$countwhere['addtime <'] = $e_time;
        	}
        }

        if(!empty($order_id)){
        	$where['where']['order_id'] = $order_id;
        	$countwhere['order_id'] = $order_id;
        }

        if(!empty($realname)){
        	$where['like'] = array('key'=>'realname','value'=>$realname);
        	$countwhere['realname'] = $realname;
        }

        if(!empty($phone)){
        	$where['where']['phone'] = $phone;
        	$countwhere['phone'] = $phone;
        }

        if(!empty($cbc)){
        	$where['where']['dev_sn'] = $cbc;
        	$countwhere['dev_sn'] = $cbc;
        }

        if($status != 'all'){
        	$where['where']['status'] = $status;
        	$countwhere['status'] = $status;

        }

        $countwhere['merchant_id'] = '2';
        $countwhere['isdel'] = '0';
        $where['where']['merchant_id'] = '2';
        $where['where']['isdel'] = '0';

        $limit = 20;
        $offset = ($page - 1) * $limit;
        $pagination = '';
          
        $count = $this->logistics->get_count($countwhere);
        $data['count'] = $count;

        $pageconfig['base_url'] = base_url('/home/logistics/index?show_time='.$show_time.'&end_time='.$end_time.'&order_id='.$order_id.'&realname='.$realname.'&phone='.$phone.'&status='.$status.'&cbc='.$cbc);
        $pageconfig['count'] = $count;
        $pageconfig['limit'] = $limit;
        $data['page'] = home_page($pageconfig);

		$list = array();		
		$where['page'] = true;
        $where['limit'] = $limit;
        $where['offset'] = $offset;
        $where['order'] = array('key'=>'id','value'=>'desc');
		$list = $this->logistics->getList($where);	

		//print_r($where);

		$data['list'] = $list;
		$this->tpl('home/logistics_tpl',$data);
		

	}

	public function index_ks()
	{

		$check_role = $this->userlib->check_role('search_logistics');

		$userinfo = $this->userinfo;
		$page = isset($_GET['page']) ? $_GET['page'] : 0;
        $page = ($page && is_numeric($page)) ? intval($page) : 1;
        $data['pagenum'] = $page;

        $show_time = isset($_GET['show_time']) ? $_GET['show_time'] : '';
        $end_time = isset($_GET['end_time']) ? $_GET['end_time'] : '';
        $order_id = isset($_GET['order_id']) ? $_GET['order_id'] : '';
        $realname = isset($_GET['realname']) ? $_GET['realname'] : '';
        $phone = isset($_GET['phone']) ? $_GET['phone'] : '';
        $status = isset($_GET['status']) ? $_GET['status'] : 'all';
        $cbc = isset($_GET['cbc']) ? $_GET['cbc'] : '';


        $data['show_time'] = $show_time;
        $data['end_time'] = $end_time;
        $data['order_id'] = $order_id;
        $data['realname'] = $realname;
        $data['phone'] = $phone;
        $data['status'] = $status;
        $data['cbc'] = $cbc;
       // print_r($data);

        if(!empty($show_time)){
        	$s_time = strtotime($show_time);
        	$where['where']['addtime >'] = $s_time;
        	$countwhere['addtime >'] = $s_time;
        	if(!empty($end_time)){
        		$e_time = strtotime($end_time);
        		$where['where']['addtime <'] = $e_time;
        		$countwhere['addtime <'] = $e_time;
        	}
        }

        if(!empty($order_id)){
        	$where['where']['order_id'] = $order_id;
        	$countwhere['order_id'] = $order_id;
        }

        if(!empty($realname)){
        	$where['like'] = array('key'=>'realname','value'=>$realname);
        	$countwhere['realname'] = $realname;
        }

        if(!empty($phone)){
        	$where['where']['phone'] = $phone;
        	$countwhere['phone'] = $phone;
        }

        if(!empty($cbc)){
        	$where['where']['dev_sn'] = $cbc;
        	$countwhere['dev_sn'] = $cbc;
        }

        if($status != 'all'){
        	$where['where']['status'] = $status;
        	$countwhere['status'] = $status;

        }

        $countwhere['merchant_id'] = '3';
        $where['where']['merchant_id'] = '3';

        $limit = 20;
        $offset = ($page - 1) * $limit;
        $pagination = '';
                
        $count = $this->logistics->get_count($countwhere);
        $data['count'] = $count;

        $pageconfig['base_url'] = base_url('/home/logistics/index_ks?show_time='.$show_time.'&end_time='.$end_time.'&order_id='.$order_id.'&realname='.$realname.'&phone='.$phone.'&status='.$status.'&cbc='.$cbc);
        $pageconfig['count'] = $count;
        $pageconfig['limit'] = $limit;
        $data['page'] = home_page($pageconfig);

		$list = array();		
		$where['page'] = true;
        $where['limit'] = $limit;
        $where['offset'] = $offset;
        $where['order'] = array('key'=>'id','value'=>'desc');
		$list = $this->logistics->getList($where);	

		$data['list'] = $list;
		$this->tpl('home/logistics_ks_tpl',$data);
		

	}

	public function index_users()
	{


		$userinfo = $this->userinfo;
		$page = isset($_GET['page']) ? $_GET['page'] : 0;
        $page = ($page && is_numeric($page)) ? intval($page) : 1;
        $show_time = isset($_GET['show_time']) ? $_GET['show_time'] : '';
        $end_time = isset($_GET['end_time']) ? $_GET['end_time'] : '';
        $order_id = isset($_GET['order_id']) ? $_GET['order_id'] : '';
        $realname = isset($_GET['realname']) ? $_GET['realname'] : '';
        $phone = isset($_GET['phone']) ? $_GET['phone'] : '';
        $status = isset($_GET['status']) ? $_GET['status'] : 'all';

        $data['show_time'] = $show_time;
        $data['end_time'] = $end_time;
        $data['order_id'] = $order_id;
        $data['realname'] = $realname;
        $data['phone'] = $phone;
        $data['status'] = $status;
       // print_r($data);

        if(!empty($show_time)){
        	$s_time = strtotime($show_time);
        	$where['where']['logis.addtime >'] = $s_time;
        	//$countwhere['addtime >'] = $s_time;
        	if(!empty($end_time)){
        		$e_time = strtotime($end_time);
        		$where['where']['logis.addtime <'] = $e_time;
        		$where['addtime <'] = $e_time;
        	}
        }

        if(!empty($order_id)){
        	$where['where']['logis.order_id'] = $order_id;
        	//$countwhere['order_id'] = $order_id;
        }

        if(!empty($realname)){
        	$where['like'] = array('key'=>'logis.realname','value'=>$realname);
        	//$countwhere['realname'] = $realname;
        }

        if(!empty($phone)){
        	$where['where']['logis.phone'] = $phone;
        	//$countwhere['phone'] = $phone;
        }

        if($status != 'all'){
        	$where['where']['logis.status'] = $status;
        	//$countwhere['status'] = $status;

        }

        $where['where']['logis.isdel'] = '0';
        $where['where']['business.user_id'] = $userinfo['id'];
        $where['where']['business.isdel'] = '0';
        $where['where']['business.merchant_id'] = '2';


        $limit = 20;
        $offset = ($page - 1) * $limit;
        $pagination = '';
                
        $count = $this->logistics->get_count_by_join($where);
        $data['count'] = $count;

        $pageconfig['base_url'] = base_url('/home/logistics/index_users?show_time='.$show_time.'&end_time='.$end_time.'&order_id='.$order_id.'&realname='.$realname.'&phone='.$phone.'&status='.$status);
        $pageconfig['count'] = $count;
        $pageconfig['limit'] = $limit;
        $data['page'] = home_page($pageconfig);

		$list = array();		
		$where['page'] = true;
        $where['limit'] = $limit;
        $where['offset'] = $offset;
        $where['order'] = array('key'=>'logis.id','value'=>'desc');
		$list = $this->logistics->get_list_by_join($where);	
		$data['list'] = $list;


		$this->tpl('home/logistics_users_tpl',$data);
		

	}

	//增加物流记录
	public function add(){
		$realname = $this->input->post('realname');
		$phone = $this->input->post('phone');
		$address = $this->input->post('address');
		$order_id = $this->input->post('order_id');
		$uid = $this->input->post('uid');
		$remark = $this->input->post('remark');
		$addtime = $this->input->post('addtime');
		$a_time = strtotime($addtime);
		//var_dump($_POST);

		if(!empty($realname) && !empty($phone) && !empty($addtime)){
			$add['realname'] = $realname;
			$add['phone'] = $phone;
			$add['address'] = $address;
			$add['order_id'] = $order_id;
			$add['total'] = $remark;
			$add['uid'] = $uid;
			$add['order_no'] = json_encode($order_id);
			$add['total'] = $remark;
			$add['addtime'] = $a_time;
			//var_dump($add);
			//echo $this->db->last_query($this->logistics->add($add));
			if($this->logistics->add($add)){
				 header("Location:/home/logistics/index");
			}
		}else{
			$this->tpl('home/logistics_add_tpl');
		}

	}


	public function imports()
	{
		$check_role = $this->userlib->check_role('import_logistics');
		$files = dirname().'uploads'.'/excel';
				if(!is_dir($files)){
					mkdir($files);					
				}
					
		if(!empty($_FILES['excel']['name'])){

			$types = $this->input->post('types');
            $config['upload_path'] = FCPATH.'/uploads/excel/';
            
            $config['allowed_types'] = '*';
            $config['file_name']  =date("YmdHis").'_logis';

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('excel')){

                $error = array('error' => $this->upload->display_errors());
                echo json_encode($error);

            }else{

                $data = array('upload_data' => $this->upload->data());
                $picname = $data['upload_data']['orig_name'];
                $dir = FCPATH.$files.'/'.$picname;
				$result = $this->my_excel->imports($dir);

				$add_count = 0;
				$update_count = 0;
				for ($i=1; $i < count($result)-1 ; $i++) { 

					$dev_sn   = $result[$i][0];
					$realname = $result[$i][1];
					$phone    = $result[$i][2];
					$address  = $result[$i][6];
					$order_id = $result[$i][8];
					$order_no = $result[$i][9];
					$addtime  = $result[$i][27];
					$remark   = isset($result[$i][37]) ? $result[$i][37] : '';
					$w_type = $result[$i][40];

					$a_time = strtotime($addtime);
					$add['dev_sn'] = iconv('utf-8','gb2312',$dev_sn);
					$add['realname'] = $realname;
					$add['phone'] = $phone;
					$add['address'] = $address;
					$add['order_id'] = $order_id;
					$add['order_no'] = $order_no;
					$add['total'] = $remark;
					$add['addtime'] = $a_time;
					$add['status'] = '4';
					$add['merchant_id'] = '2';
					$add['types'] = $types;

					if(!empty($realname) && !empty($phone)){

						/*
						//检验CBC
						$check_cbc = $this->check_cbc($dev_sn);
						if($check_cbc){
							//已经有了直接标记拒收
							$update_cbc_config['dev_sn'] = $dev_sn;
							$update_cbc_data['status'] = '6';
							$this->logistics->update($update_cbc_config,$update_cbc_data);
							//重新添加
							$this->logistics->add($add);
							$update_count += 1;

						}else{

							//补发情况
							$check = $this->check_data($phone);
							if(empty($check)){

								if($this->logistics->add($add)){
									//修改申请为已寄出-4
									$update_config['phone'] = $phone;
									$update_data['status'] = '4';
									
									$this->business->update($update_config,$update_data);

									$add_count +=1;
								}

							}else{

								$update_info_config['phone'] = $phone;
								$add['status'] = '4';
								$update_data['status'] = '4';

								$this->logistics->update($update_info_config,$add);
								$this->business->update($update_info_config,$update_data);
								$update_count += 1;
							}
						}
						*/
						
						//判断订单号
						$c_order_id = $this->check_order_id($order_id);

						if(!$c_order_id){
							//新增用户
							if($w_type == '1'){
								//直接添加
								//$this->logistics->add($add);
								//$add_count += 1;
								//$bus_update['status'] = '4';
								//$bus_config['phone'] = $phone;

							}elseif($w_type == '2'){ 
								//快递原因重新发
								//把之前的标记为问题件
								$logis_config['dev_sn'] = $dev_sn;
								$logis_update['status'] = '12';
								$logis_update['remark'] = '快递问题，重新派发';
								$this->logistics->update($logis_config,$logis_update);
								//重新添加

								//改变申请表
								//$add_count += 1;
								$update_count += 1;

							}elseif($w_type == '3'){ // 机器坏，补发

								$logis_config_3['phone'] = $phone;
								$logis_update_3['remark'] = '机器损坏';
								$logis_update_3['status'] = '12';

								if($this->logistics->update($logis_config_3,$logis_update_3)){
									$update_count += 1;
								}

							}elseif($w_type == '4'){  //退回重发

								$logis_config['dev_sn'] = $dev_sn;
								$logis_update['status'] = '6';
								$logis_update['remark'] = '退回';
								$this->logistics->update($logis_config,$logis_update);
								//重新添加
								//改变申请表
								$update_count += 1;
							}

							//添加物流信息
							$this->logistics->add($add);
							$add_count += 1;
							//修改申请表
							$bus_update['status'] = '4';
							$bus_config['phone'] = $phone;
							$this->business->update($bus_config,$bus_update);

						}

					}

				}
				
		        $msg['title'] = '成功导入:<font color="red">'.$add_count.'</font>条数据,更新：<font color="red">'.$update_count.'</font>条数据';
				$msg['msg'] = '<a href="'.base_url().'home/logistics/index?">返回列表</a> ';
				$this->tpl('msg/msg_success',$msg);
		    }

		}else{    
		//$dir = FCPATH.'uploads/ex.xlsx';		
			$this->tpl('/home/imports_excel_tpl');
		} 
	}

	//快刷
	public function imports_ks()
	{
		$check_role = $this->userlib->check_role('import_logistics');
		$files = dirname().'uploads'.'/excel';
				if(!is_dir($files)){
					mkdir($files);					
				}
					
		if(!empty($_FILES['excel']['name'])){

            $config['upload_path'] = FCPATH.'/uploads/excel/';
            
            $config['allowed_types'] = '*';
            $config['file_name']  =date("YmdHis");

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('excel')){

                $error = array('error' => $this->upload->display_errors());
                echo json_encode($error);

            }else{

                $data = array('upload_data' => $this->upload->data());
                $picname = $data['upload_data']['orig_name'];
                $dir = FCPATH.$files.'/'.$picname;
				$result = $this->my_excel->imports($dir);
				
				$add_count = 0;
				$update_count = 0;
				for ($i=1; $i < count($result)-1 ; $i++) { 

					//$dev_sn   = $result[$i][0];
					$realname = $result[$i][0];
					$phone    = $result[$i][1];
					$address  = $result[$i][5];
					$order_id = $result[$i][7];
					$order_no = $result[$i][8];
					$addtime  = $result[$i][26];
					$remark   = isset($result[$i][36]) ? $result[$i][36] : '';

					$a_time = strtotime($addtime);
					$add['dev_sn'] = iconv('utf-8','gb2312',$dev_sn);
					$add['realname'] = $realname;
					$add['phone'] = $phone;
					$add['address'] = $address;
					$add['order_id'] = $order_id;
					$add['order_no'] = $order_no;
					$add['total'] = $remark;
					$add['addtime'] = $a_time;
					$add['status'] = 4;
					$add['merchant_id'] = '3';

					if(!empty($realname) && !empty($phone)){

						//校验电话
						$check = $this->check_data($phone);

						if(empty($check)){
							if($this->logistics->add($add)){
								//修改申请为已寄出-4
								$update_config['phone'] = $phone;
								$update_data['status'] = '4';								
								$this->business->update($update_config,$update_data);

								$add_count +=1;
							}
						}else{

							$update_info_config['phone'] = $phone;
							$add['status'] = '4';
							$update_data['status'] = '4';

							$this->logistics->update($update_info_config,$add);
							$this->business->update($update_info_config,$update_data);
							$update_count += 1;
						}

					}

				}
				
		        $msg['title'] = '成功导入:<font color="red">'.$add_count.'</font>条数据,更新：<font color="red">'.$update_count.'</font>条数据';
				$msg['msg'] = '<a href="'.base_url().'home/logistics/index_ks?">返回列表</a> ';
				$this->tpl('msg/msg_success',$msg);
		    }

		}else{    
		//$dir = FCPATH.'uploads/ex.xlsx';		
			$this->tpl('/home/imports_ks_excel_tpl');
		} 
	}

	public function check_data($phone)
	{
		$where['where']['phone'] = $phone;
		$where['where']['isdel'] = '0';
		$info = $this->logistics->get_one_by_where($where);
		if(!empty($info)){

			return 1;

		}else{

			return 0;

		}
	}

	public function check_cbc($cbc)
	{
		$where['where']['dev_sn'] = $cbc;
		$info = $this->logistics->get_one_by_where($where);
		if(!empty($info)){

			return 1;

		}else{

			return 0;

		}
	}

	public function check_order_id($order_id)
	{
		$where['where']['order_id'] = $order_id;
		$info = $this->logistics->get_one_by_where($where);
		if(!empty($info)){

			return 1;

		}else{

			return 0;

		}
	}



	public function dataview()
	{
		$this->tpl('home/ads_dataview_tpl');
	}


	public function del()
	{
		$id = $this->input->get('id');
		$config['id'] = $id;
		if($this->ads->del($config)){
			redirect('/home/ads/index');
		}
	}

	//详情
	public function detail()
	{

		$id = $this->input->get('id');
		$where['where'] = array('id'=>$id);
		$info = $this->logistics->get_one_by_where($where);

		$data['info'] = $info;

		$this->tpl('home/logistics_detail_tpl',$data);

	}

	//物流详情
	public function express()
	{
		$order_id = $this->input->get('order_id');

		$_data['express'] = 'zhongtong';
		$_data['trackingNo'] = $order_id;
		//$result = express($_data);
		$ret = $this->wuliulib->getOrderTracesByJson('ZTO',$order_id);
		$_arr = $ret['Traces'];
		 //print_r($_arr);
		for($i=count($_arr) ; $i >= 0 ;$i--){
			$_tmp[] = $_arr[$i];
		}
		
		$data['list'] = $_tmp;


		$where['where']['order_id'] = $order_id;
		$info = $this->logistics->get_one_by_where($where);
		$data['info'] = $info;

		$this->tpl('home/logistics_express_tpl',$data);

	}

	public function change_express()
	{

		$order_id = $this->input->post('order_id');
		$status = $this->input->post('status');
		$remark = $this->input->post('remark');

		$where['where']['order_id'] = $order_id;

		$info = $this->logistics->get_one_by_where($where);

		$data['phone'] = $info['phone'];
		$data['status'] = $status;
		$data['remark'] = $remark;

		$this->common_mdl->change_status($data);
		

		$msg = array(
			'code'=>'0',
			'msg'=>'修改成功'
			);

		echo json_encode($msg);
		exit;



		
	}



}

