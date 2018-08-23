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
		$this->load->model('Account_mdl','admin');
		$this->load->model('Ads_parent_mdl','ads_parent');
		$this->load->model('Standard_mdl','standard');
        $this->load->model('Machines_mdl','machines');


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
        $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
        $kaitong = isset($_GET['kaitong']) ? $_GET['kaitong'] : 'all';
        $types = isset($_GET['types']) ? $_GET['types'] : '0';

        $data['show_time'] = $show_time;
        $data['end_time'] = $end_time;
        $data['order_id'] = $order_id;
        $data['realname'] = $realname;
        $data['phone'] = $phone;
        $data['status'] = $status;
        $data['cbc'] = $cbc;
        $data['user_id'] = $user_id;
        $data['kaitong'] = $kaitong;
        $data['types'] = $types;

        $where_str = '';
        if(!empty($show_time)){
        	$s_time = strtotime($show_time);
        	//$where_str .= " and logis.addtime > '$s_time'";
        	$where['where']['addtime >'] = $s_time;
        	if(!empty($end_time)){
        		$e_time = strtotime($end_time);
        		//$where_str .= " and logis.addtime < '$e_time'";
        		$where['where']['addtime <'] = $e_time;
        	}
        }

        if(!empty($order_id)){
        	//$where_str .= " and logis.order_id = '$order_id'";
        	$where['where']['order_id'] = $order_id;
        }

        if(!empty($realname)){
        	//$where_str .= " and logis.realname = '$realname'";
        	$where['where']['realname'] = $realname;
        }

        if(!empty($phone)){

        	//$where_str .= " and logis.phone = '$phone'";
        	$where['where']['phone'] = $phone;
        }

        if(!empty($cbc)){

        	//$where_str .= " and logis.dev_sn = '$cbc'";
        	$where['where']['dev_sn'] = $cbc;
        }

        if($status != 'all'){

        	//$where_str .= " and logis.status = '$status'";
        	$where['where']['status'] = $status;

        }

        if(!empty($user_id)){

        	//$where_str .= " and bus.user_id = '$user_id'";
        	$where['where']['uid'] = $user_id;

        }

        if(!empty($types)){

            //$where_str .= " and bus.user_id = '$user_id'";
            $where['where']['types'] = $types;

        }

        if($kaitong != 'all'){

        	//$where_str .= " and logis.kaitong = '$kaitong'";
        	$where['where']['kaitong'] = $kaitong;

        }


        $channel_id = $userinfo['channel_id'];
        //$where_str .= " and logis.merchant_id = '2' ";
        $where['where']['merchant_id'] = 2;
        //$where['where'] = $where_str;

        $limit = 20;
        $offset = ($page - 1) * $limit;
        $pagination = '';
          
        //$count = $this->logistics->get_list_count($where);
        $count = $this->logistics->get_count($where['where']);
        $data['count'] = $count;

        $pageconfig['base_url'] = base_url('/home/logistics/index?show_time='.$show_time.'&end_time='.$end_time.'&order_id='.$order_id.'&realname='.$realname.'&phone='.$phone.'&status='.$status.'&cbc='.$cbc.'&user_id='.$user_id.'&kaitong='.$kaitong.'&types='.$types);
        $pageconfig['count'] = $count;
        $pageconfig['limit'] = $limit;
        $data['page'] = home_page($pageconfig);

		$list = array();		
		$where['page'] = true;
        $where['limit'] = $limit;
        $where['offset'] = $offset;
        $where['order'] = array('key'=>'id','value'=>'desc');
		//$list = $this->logistics->get_list($where);	
		$list = $this->logistics->getList($where);	

		$data['list'] = $list;



		$user_where['where']=array();
		$users = $this->admin->getList($user_where);
		$data['users'] = $users;

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
        $kaitong = isset($_GET['kaitong']) ? $_GET['kaitong'] : 'all';
        $types = isset($_GET['types']) ? $_GET['types'] : '0';

        $data['show_time'] = $show_time;
        $data['end_time'] = $end_time;
        $data['order_id'] = $order_id;
        $data['realname'] = $realname;
        $data['phone'] = $phone;
        $data['status'] = $status;
        $data['cbc'] = $cbc;
        $data['kaitong'] = $kaitong;
        $data['types'] = $types;
       
        $where_str = '';
        if(!empty($show_time)){
        	$s_time = strtotime($show_time);
        	$where['where']['addtime >'] = $s_time;
        	//$where_str .= " and logis.addtime > '$s_time'";
        	if(!empty($end_time)){
        		$e_time = strtotime($end_time);
        		//$where_str .= " and logis.addtime < '$e_time'";
        		$where['where']['addtime < '] = $e_time;
        	}
        }

        if(!empty($order_id)){
        	//$where_str .= " and logis.order_id = '$order_id'";
        	$where['where']['order_id'] = $order_id;
        }

        if(!empty($realname)){
        	//$where_str .= " and logis.realname = '$realname'";
        	$where['where']['realname'] = $realname;
        }

        if(!empty($phone)){

        	//$where_str .= " and logis.phone = '$phone'";
        	$where['where']['phone'] = $phone;
        }

        if(!empty($cbc)){

        	//$where_str .= " and logis.dev_sn = '$cbc'";
        	$where['where']['dev_sn'] = $cbc;
        }

        if($status != 'all'){

        	//$where_str .= " and logis.status = '$status'";
        	$where['where']['status'] = $status;
        }

        if($kaitong != 'all'){

        	//$where_str .= " and logis.kaitong = '$kaitong'";
        	$where['where']['kaitong'] = $kaitong;

        }

        if(!empty($types)){

            //$where_str .= " and logis.kaitong = '$kaitong'";
            $where['where']['types'] = $types;

        }


 

        $channel_id = $userinfo['channel_id'];
        $user_id = $userinfo['id'];
        $where_str .= " and logis.merchant_id = '2' and bus.user_id='{$user_id}'";
        $where['where']['merchant_id'] = '2';
        $where['where']['uid'] = $user_id;
       // $where['where'] = $where_str;

        $limit = 20;
        $offset = ($page - 1) * $limit;
        $pagination = '';
          
        //$count = $this->logistics->get_list_count($where);
        $count = $this->logistics->get_count($where['where']);
        $data['count'] = $count;

        $pageconfig['base_url'] = base_url('/home/logistics/index_users?show_time='.$show_time.'&end_time='.$end_time.'&order_id='.$order_id.'&realname='.$realname.'&phone='.$phone.'&status='.$status.'&cbc='.$cbc.'&types='.$types);
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



		$this->tpl('home/logistics_users_tpl',$data);
		

	}

	//增加物流记录
	public function add(){

		if(!empty($_POST)){

			$realname = $this->input->post('realname');
			$dev_sn = $this->input->post('dev_sn');
			$phone = $this->input->post('phone');
			$address = $this->input->post('address');
			$order_id = $this->input->post('order_id');
			$order_no = md5($order_id);
			$remark = $this->input->post('remark');
			$addtime = $this->input->post('addtime');
			$a_time = strtotime($addtime);
			$status = $this->input->post('status');
			$merchant_id = $this->input->post('merchant_id');
            $types = $this->input->post('types');
            $admin = $this->input->post('admin');
			
			$express = $this->input->post('express');
			
			if(!empty($realname) && !empty($phone) && !empty($dev_sn)){
                $ret = $this->check_order_id($order_id,'');
                if( $ret ){
                    $msg['title'] = '添加失败，订单号已经存在';
                    $msg['msg'] = '<a href="'.base_url().'home/logistics/index?">返回</a>';

                    $this->tpl('msg/msg_errors',$msg);
                    
                }else{
                    $_admin = explode('-', $admin);
                    $add['realname'] = $realname;
                    $add['dev_sn'] = $dev_sn;
                    $add['phone'] = $phone;
                    $add['address'] = $address;
                    $add['order_id'] = $order_id;
                    $add['order_no'] = $order_no;
                    $add['status'] = $status;           
                    $add['order_no'] = md5($order_id);
                    $add['remark'] = $remark;
                    $add['addtime'] = time();
                    $add['express'] = $express;
                    $add['m_type'] = '2';
                    $add['merchant_id'] = $merchant_id;
                    $add['uid'] = $_admin[0];
                    $add['admin_name'] = $_admin[1];
                    $add['types'] = $types;

                    if($this->logistics->add($add)){

                        redirect('/home/logistics/index');

                    }
                }



			}else{
				
			}
		}else{

            $admin = array();
            $admin = $this->admin->getList();
            $data['admin'] = $admin;

			$this->tpl('home/logistics_add_tpl',$data);

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
			$express = $this->input->post('express');
            $config['upload_path'] = FCPATH.'/uploads/excel/';
            
            $config['allowed_types'] = '*';
            $config['file_name']  =date("YmdHis").'_logis';

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('excel')){

                $error = array('error' => $this->upload->display_errors());
                echo json_encode($error);

            }else{

                $admin = $this->admin->getList();
                foreach($admin as $k => $v){
                    $a[$v['id']] = $v['realname'];
                }

                $data = array('upload_data' => $this->upload->data());
                $picname = $data['upload_data']['orig_name'];
                $dir = FCPATH.$files.'/'.$picname;

				//$result = $this->my_excel->imports($dir);			
                require_once FCPATH.'/application/libraries/phpexcel/PHPExcel.php';

				if (!file_exists($dir)) {
				    die('no file!');
				}
				$extension = strtolower( pathinfo($dir, PATHINFO_EXTENSION) );

				if ($extension =='xlsx') {
				    $objReader = new PHPExcel_Reader_Excel2007();
				    $objExcel = $objReader ->load($dir);
				} else if ($extension =='xls') {
				    $objReader = new PHPExcel_Reader_Excel5();
				    $objExcel = $objReader ->load($dir);
				} else if ($extension=='csv') {
				    $PHPReader = new PHPExcel_Reader_CSV();

				    //默认输入字符集
				    $PHPReader->setInputEncoding('GBK');

				    //默认的分隔符
				    $PHPReader->setDelimiter(',');

				    //载入文件
				    $objExcel = $PHPReader->load($dir);
				}
				
				$sheet = $objExcel->getSheet(0); // 读取第一個工作表
				$highestRow = $sheet->getHighestRow(); // 取得总行数
				$colsNum = $sheet->getHighestColumn(); // 取得总列数
				$highestColumm= PHPExcel_Cell::columnIndexFromString($colsNum); //字母列转换为数字列 

				$arr = array();
				$tmp = array();
				$result = array();
				$add_count = 0;
				for ($row = 2; $row <= $highestRow; $row++){//行数是以第1行开始
				    for ($column = 0; $column < $highestColumm; $column++) {//列数是以第0列开始
				        $columnName = PHPExcel_Cell::stringFromColumnIndex($column);
				        $arr[$column] = $sheet->getCellByColumnAndRow($column, $row)->getValue();
				    }

						
					if($express == 'ZTO'){
						$dev_sn   = trim($arr[0]);
						$realname = $arr[1];
						$phone    = trim($arr[2]);
						$address  = $arr[6];
						$order_id = trim($arr[8]);
						$order_no = $arr[9];
						$addtime  = $arr[27];
						$remark   = isset($arr[37]) ? $arr[37] : '';
						$w_type = $arr[40];
					}elseif($express == 'SF'){
						$dev_sn   = trim($arr[0]);
						$realname = $arr[14];
						$phone    = trim($arr[16]);
						$address  = $arr[17];
						$order_id = trim($arr[2]);
						$order_no = $arr[1];
						$addtime  = $arr[6];
						$remark   = isset($arr[22]) ? $arr[22] : '';
						$w_type = empty($arr[39]) ? 1 : $arr[39];
					}


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
					$add['m_type'] = '2';
					$add['express'] = $express;

					if(!empty($dev_sn)){
						//判断订单号
						$c_order_id = $this->check_order_id($order_id,$dev_sn);
                        $business_info = $this->get_business_info($phone);

						if(!$c_order_id){
							//新增用户
							if($w_type == '1'){
								//直接添加
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

                            $add['uid'] = isset($business_info['user_id']) ? $business_info['user_id'] : 0;
                            $add['admin_name'] = isset($a[$business_info['user_id']]) ? $a[$business_info['user_id']] : '未知';
							//添加物流信息
							$this->logistics->add($add);
							$add_count += 1;
							//修改申请表
							$bus_update['status'] = '4';
							$bus_config['phone'] = $phone;
							$this->business->update($bus_config,$bus_update);

						}else{

							//修改
							$logs_update_config['order_id'] = $order_id;
							unset($add['addtime']);
							$this->logistics->update($logs_update_config,$add);
							$update_count += 1;

						}
					}
					
				}

				
		        $msg['title'] = '成功导入:<font color="red">'.$add_count.'</font>条数据,更新：<font color="red">'.$update_count.'</font>条数据';
				$msg['msg'] = '<a href="'.base_url().'home/logistics/index?">返回列表</a> ';
				$this->tpl('msg/msg_success',$msg);
		    }

		}else{    
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
            $express = $this->input->post('express');
            
            $config['allowed_types'] = '*';
            $config['file_name']  =date("YmdHis").'_ks';

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
					//$dve_sn = 
					$realname = $result[$i][13];
					$phone    = $result[$i][15];
					$address  = $result[$i][16];
					$order_id = $result[$i][1];
					$order_no = md5($result[$i][1]);
					$addtime  = time();
					$remark   = isset($result[$i][4]) ? $result[$i][4] : '';

					//$a_time = strtotime($addtime);
					$add['dev_sn'] = iconv('utf-8','gb2312',$dev_sn);
					$add['realname'] = $realname;
					$add['phone'] = $phone;
					$add['address'] = $address;
					$add['order_id'] = $order_id;
					$add['order_no'] = $order_no;
					$add['total'] = $remark;
					$add['addtime'] = time();
					$add['status'] = 4;
					$add['merchant_id'] = '3';
					$add['types'] = 0;
					$add['m_type'] = '1';
					$add['express'] = $express;

					if(!empty($realname) && !empty($phone)){

						//校验电话
						$check = $this->check_order_id($order_id,'');

						if(empty($check)){

							if($this->logistics->add($add)){
								//修改申请为已寄出-4
								$update_config['phone'] = $phone;
								$update_config['merchant_id'] = '3';
								$update_data['status'] = '4';								
								$this->business->update($update_config,$update_data);

								$add_count +=1;

							}
						}else{

							$update_info_config['phone'] = $phone;
							$update_info_config['merchant_id'] = '3';
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


    public function imports_test()
    {
        //$check_role = $this->userlib->check_role('import_logistics');
        $files = dirname().'uploads'.'/excel';
                if(!is_dir($files)){
                    mkdir($files);                  
                }
                    
        if(!empty($_FILES['excel']['name'])){

            $types = $this->input->post('types');
            $express = $this->input->post('express');
            $config['upload_path'] = FCPATH.'/uploads/excel/';
            
            $config['allowed_types'] = '*';
            $config['file_name']  =date("YmdHis").'_logis_test';

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('excel')){

                $error = array('error' => $this->upload->display_errors());
                echo json_encode($error);

            }else{

                $data = array('upload_data' => $this->upload->data());
                $picname = $data['upload_data']['orig_name'];
                $dir = FCPATH.$files.'/'.$picname;

                //$result = $this->my_excel->imports($dir);
                
                require_once FCPATH.'/application/libraries/phpexcel/PHPExcel.php';

                if (!file_exists($dir)) {
                    die('no file!');
                }
                $extension = strtolower( pathinfo($dir, PATHINFO_EXTENSION) );

                if ($extension =='xlsx') {
                    $objReader = new PHPExcel_Reader_Excel2007();
                    $objExcel = $objReader ->load($dir);
                } else if ($extension =='xls') {
                    $objReader = new PHPExcel_Reader_Excel5();
                    $objExcel = $objReader ->load($dir);
                } else if ($extension=='csv') {
                    $PHPReader = new PHPExcel_Reader_CSV();

                    //默认输入字符集
                    $PHPReader->setInputEncoding('GBK');

                    //默认的分隔符
                    $PHPReader->setDelimiter(',');

                    //载入文件
                    $objExcel = $PHPReader->load($dir);
                }
                
                $sheet = $objExcel->getSheet(0); // 读取第一個工作表
                $highestRow = $sheet->getHighestRow(); // 取得总行数
                $colsNum = $sheet->getHighestColumn(); // 取得总列数
                $highestColumm= PHPExcel_Cell::columnIndexFromString($colsNum); //字母列转换为数字列 

                $arr = array();
                $tmp = array();
                $result = array();
                $add_count = 0;
                for ($row = 2; $row <= $highestRow; $row++){//行数是以第1行开始
                    for ($column = 0; $column < $highestColumm; $column++) {//列数是以第0列开始
                        $columnName = PHPExcel_Cell::stringFromColumnIndex($column);
                        $arr[$column] = $sheet->getCellByColumnAndRow($column, $row)->getValue();
                    }

                        
                    if($express == 'ZTO'){
                        $dev_sn   = trim($arr[0]);
                        $realname = $arr[1];
                        $phone    = trim($arr[2]);
                        $address  = $arr[6];
                        $order_id = trim($arr[8]);
                        $order_no = $arr[9];
                        $addtime  = $arr[27];
                        $remark   = isset($arr[37]) ? $arr[37] : '';
                        $w_type = $arr[40];
                    }elseif($express == 'SF'){
                        $dev_sn   = trim($arr[0]);
                        $realname = $arr[14];
                        $phone    = trim($arr[16]);
                        $address  = $arr[17];
                        $order_id = trim($arr[2]);
                        $order_no = $arr[1];
                        $addtime  = $arr[6];
                        $remark   = isset($arr[22]) ? $arr[22] : '';
                        $w_type = empty($arr[39]) ? 1 : $arr[39];
                    }


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
                    $add['m_type'] = '2';
                    $add['express'] = $express;

                    if(!empty($dev_sn)){
                        //判断订单号
                        $c_cbc = $this->check_machines($dev_sn);
                        if(!$c_cbc){
                            $not_in[] = $dev_sn;
                        }

                        $add_count++;

                    }
                    
                }

                
                $msg['title'] = '需要导入:<font color="red">'.$add_count.'</font>有：<font color="red">'.count($not_in).'</font>条数据CBC码不在机器列表里<br/>'.implode('<br/>',$not_in);
                $msg['msg'] = '<a href="'.base_url().'home/logistics/imports_test?">返回列表</a> ';
                $this->tpl('msg/msg_success',$msg);
            }

        }else{    
            $this->tpl('/home/imports_excel_test_tpl');
        } 
    }


    //导出
    public function export()
    {

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
        $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';
        $kaitong = isset($_GET['kaitong']) ? $_GET['kaitong'] : 'all';
        $types = isset($_GET['types']) ? $_GET['types'] : '0';

        $data['show_time'] = $show_time;
        $data['end_time'] = $end_time;
        $data['order_id'] = $order_id;
        $data['realname'] = $realname;
        $data['phone'] = $phone;
        $data['status'] = $status;
        $data['cbc'] = $cbc;
        $data['user_id'] = $user_id;
        $data['kaitong'] = $kaitong;
        $data['types'] = $types;

        $where_str = '';
        if(!empty($show_time)){
            $s_time = strtotime($show_time);
            $where['where']['addtime >'] = $s_time;
            if(!empty($end_time)){
                $e_time = strtotime($end_time);
                $where['where']['addtime <'] = $e_time;
            }
        }

        if(!empty($order_id)){
            $where['where']['order_id'] = $order_id;
        }

        if(!empty($realname)){
            $where['where']['realname'] = $realname;
        }

        if(!empty($phone)){

            $where['where']['phone'] = $phone;
        }

        if(!empty($cbc)){

            $where['where']['dev_sn'] = $cbc;
        }

        if($status != 'all'){

            $where['where']['status'] = $status;

        }

        if(!empty($user_id)){

            $where['where']['uid'] = $user_id;

        }

        if(!empty($types)){

            $where['where']['types'] = $types;

        }

        if($kaitong != 'all'){

            $where['where']['kaitong'] = $kaitong;

        }


        $channel_id = $userinfo['channel_id'];
        $where['where']['merchant_id'] = 2;
        $limit = 20;
        $offset = ($page - 1) * $limit;
        $pagination = '';
          
        $count = $this->logistics->get_count($where['where']);

        $list = array();        
        $where['order'] = array('key'=>'id','value'=>'desc');
        $list = $this->logistics->getList($where);  

        //导出   
        $export = array();  
        foreach($list as $k => $v)
        {
            $_tmp['id'] = $v['id'];
            $_tmp['realname'] = $v['realname'];
            $_tmp['dev_sn'] = $v['dev_sn'];
            $_tmp['phone'] = $v['phone'];
            $_tmp['address'] = $v['address'];
            $_tmp['remark'] = $v['remark'];
            $_tmp['user'] = $v['admin_name'];
            $_tmp['status'] = strip_tags(flw_status($v['status']));
            $_tmp['addtime'] = date('Y/m/d',$v['addtime']);
            
            $export[] = $_tmp;

        }

      
        $title = '物流表-'.date("Ymd").'.xls';
        $this->my_excel->export_logis($export,$title);


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

    public function check_machines($cbc)
    {
        $where['where']['dev_sn'] = $cbc;
        $info = $this->machines->get_one_by_where($where);
        if(!empty($info)){

            return true;

        }else{

            return false;

        }
    }

	public function check_order_id($order_id,$dev_sn)
	{
		$where['where']['order_id'] = $order_id;
		//$where['where']['dev_sn'] = $dev_sn;
		$info = $this->logistics->get_one_by_where($where);
		if(!empty($info)){

			return 1;

		}else{

			return 0;

		}
	}

    //根据手机号查找申请信息
    public function get_business_info($phone)
    {
        $where['where']['phone'] = $phone;
       
        $info = $this->business->get_one_by_where($where);

        return $info;
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
		$express = $this->input->get('express');

		$_data['express'] = 'zhongtong';
		$_data['trackingNo'] = $order_id;
		
		if($express == 'SF'){
			
			$ret = $this->wuliulib->get_order_info($express,$order_id);
			$_arr = $ret['data']['traces'];

			for($i=count($_arr) ; $i >= 0 ;$i--){
				$tmp['AcceptTime'] = $_arr[$i]['time'];
				$tmp['AcceptStation'] = $_arr[$i]['desc'];
				$_tmp[] = $tmp;
			}
		}else{
			$ret = $this->wuliulib->getOrderTracesByJson($express,$order_id);
			$_arr = $ret['Traces'];
			for($i=count($_arr) ; $i >= 0 ;$i--){
				$_tmp[] = $_arr[$i];
			}
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

		// $order_id = '539566278523';
		// $status = '8';
		// $remark = 'test';

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


	//同步开通数据
	public function kaitong()
	{
		$where['where']['kaitong'] = '0';
		$where['where']['status <>'] = '6';
		$list  = $this->logistics->getList($where);
		$i = 0;
		foreach($list as $k => $v){
			$ret = $this->get_stan($v['dev_sn']);
			if(!empty($ret)){
				
				$update_data['kaitong'] = '1';
		
			}else{
                $update_data['kaitong'] = '0';
            }

            $update_config['id'] = $v['id'];
               
            if($this->logistics->update($update_config,$update_data)){
                    $i++;
            }
		}

		echo $i;


	}

    public function xiufu()
    {
        $sql = "select id from ls_logistics  where `status`<>6 and kaitong=1 and dev_sn not in(select dev_sn from ls_standard)";
        $query = $this->db->query($sql);
        $list = $query->result_array();
        foreach($list as $k => $v)
        {
            $update_config['id'] = $v['id'];
            $update_data['kaitong'] = 0;
            if($this->logistics->update($update_config,$update_data)){
                    $i++;
            }
        }
        echo $i;
    }

	public function get_stan($dev_sn)
	{
		$where['where']['dev_sn'] = $dev_sn;
		$info = $this->standard->get_one_by_where($where);
		if(empty($info)){
			return 0;
		}else{
			return 1;
		}
	}



}

