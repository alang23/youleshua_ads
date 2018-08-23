<?php

class Standard extends Zrjoboa
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Logistics_mdl','logistics');
		$this->load->library('My_excel','my_excel');
		$this->load->model('Standard_mdl','standard');
		$this->load->model('Business_mdl','business');
		$this->load->model('Account_mdl','admin');


	}


	public function index()
	{

		$userinfo = $this->userinfo;
		$page = isset($_GET['page']) ? $_GET['page'] : 0;
        $page = ($page && is_numeric($page)) ? intval($page) : 1;
        $data['pagenum'] = $page;

        $show_time = isset($_GET['show_time']) ? $_GET['show_time'] : '';
        $end_time = isset($_GET['end_time']) ? $_GET['end_time'] : '';

        $dabiao = isset($_GET['dabiao']) ? $_GET['dabiao'] : 'all';
        $cbc = isset($_GET['cbc']) ? $_GET['cbc'] : '';
        $s_type = isset($_GET['s_type']) ? $_GET['s_type'] : '0';
        $m_type = isset($_GET['m_type']) ? $_GET['m_type'] : '0';
        $weihu = isset($_GET['weihu']) ? $_GET['weihu'] : '0';
        $kefu = isset($_GET['kefu']) ? $_GET['kefu'] : '0';
        $chuhuo = isset($_GET['chuhuo']) ? $_GET['chuhuo'] : '0';

        $data['show_time'] = $show_time;
        $data['end_time'] = $end_time;
        $data['dabiao'] = $dabiao;
        $data['cbc'] = $cbc;
        $data['s_type'] = $s_type;
        $data['m_type'] = $m_type;
        $data['weihu'] = $weihu;
        $data['kefu'] = $kefu;
        $data['chuhuo'] = $chuhuo;
       // print_r($data);
       if($s_type == '1'){  //开通时间
	        if(!empty($show_time)){
	        	$s_time = strtotime($show_time);
	        	$where['where']['open_time_int >'] = $s_time;
	        	$countwhere['open_time_int >'] = $s_time;
	        	if(!empty($end_time)){
	        		$e_time = strtotime($end_time);
	        		$where['where']['open_time_int <'] = $e_time;
	        		$countwhere['open_time_int <'] = $e_time;
	        	}
	        }
       }elseif($s_type == '2'){
       	     if(!empty($show_time)){
	        	$s_time = strtotime($show_time);
	        	$where['where']['dabiao_time_int >'] = $s_time;
	        	$countwhere['dabiao_time_int >'] = $s_time;
	        	if(!empty($end_time)){
	        		$e_time = strtotime($end_time);
	        		$where['where']['dabiao_time_int <'] = $e_time;
	        		$countwhere['dabiao_time_int <'] = $e_time;
	        	}
	        }
       }else{
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
       }





        if(!empty($cbc)){
        	$where['where']['dev_sn'] = $cbc;
        	$countwhere['dev_sn'] = $cbc;
        }

        if($dabiao != 'all'){
        	$where['where']['dabiao'] = $dabiao;
        	$countwhere['dabiao'] = $dabiao;

        }

        if(!empty($m_type)){
        	$where['where']['m_type'] = $m_type;
        	$countwhere['m_type'] = $m_type;
        }

        if(!empty($weihu)){
        	$where['where']['weihu'] = $weihu;
        	$countwhere['weihu'] = $weihu;
        }

        if(!empty($kefu)){
        	$where['where']['user_id'] = $kefu;
        	$countwhere['user_id'] = $kefu;
        }

        if(!empty($chuhuo)){
        	$where['where']['chuhuo_time'] = $chuhuo;
        	$countwhere['chuhuo_time'] = $chuhuo;
        }

        $limit = 20;
        $offset = ($page - 1) * $limit;
        $pagination = '';
        
        $count = $this->standard->get_count($countwhere);
        $data['count'] = $count;

        $pageconfig['base_url'] = base_url('/home/standard/index?show_time='.$show_time.'&end_time='.$end_time.'&dabiao='.$dabiao.'&cbc='.$cbc.'&s_type='.$s_type.'&m_type='.$m_type.'&weihu='.$weihu.'&kefu='.$kefu.'&chuhuo='.$chuhuo);

        $pageconfig['count'] = $count;
        $pageconfig['limit'] = $limit;
        $data['page'] = home_page($pageconfig);

		$list = array();		
		$where['page'] = true;
        $where['limit'] = $limit;
        $where['offset'] = $offset;
        $where['order'] = array('key'=>'open_time_int','value'=>'desc');
		$list = $this->standard->getList($where);	

		$data['list'] = $list;

		//客服
		$admin = array();
		$admin = $this->admin->getList();
		$data['admin'] = $admin;

		//出货时间
		$sql = "select chuhuo_time from ls_standard group by chuhuo_time";
        $query = $this->db->query($sql);
        $chuhuo_list = $query->result_array();
       	$data['chuhuo_list'] = $chuhuo_list;

		$this->tpl('home/standard_tpl',$data);

	}

	public function tongbu()
	{
		$where = array();
		$list = $this->standard->get_list_by_join($where);
		foreach($list as $k => $v){
			$update_config['id'] = $v['id'];
			$update_data['user_id'] = $v['uid'];
			$update_data['admin_name'] = $v['a_realname'];
			$this->standard->update($update_config,$update_data);
		}
		
	}

	public function index_bak()
	{

		$userinfo = $this->userinfo;
		$page = isset($_GET['page']) ? $_GET['page'] : 0;
        $page = ($page && is_numeric($page)) ? intval($page) : 1;
        $data['pagenum'] = $page;

        $show_time = isset($_GET['show_time']) ? $_GET['show_time'] : '';
        $end_time = isset($_GET['end_time']) ? $_GET['end_time'] : '';

        $dabiao = isset($_GET['dabiao']) ? $_GET['dabiao'] : 'all';
        $cbc = isset($_GET['cbc']) ? $_GET['cbc'] : '';
        $s_type = isset($_GET['s_type']) ? $_GET['s_type'] : '0';

        $data['show_time'] = $show_time;
        $data['end_time'] = $end_time;
        $data['dabiao'] = $dabiao;
        $data['cbc'] = $cbc;
        $data['s_type'] = $s_type;
       // print_r($data);
       if($s_type == '1'){  //开通时间
	        if(!empty($show_time)){
	        	$s_time = strtotime($show_time);
	        	$where['where']['stan.open_time_int >'] = $s_time;
	        	$countwhere['open_time_int >'] = $s_time;
	        	if(!empty($end_time)){
	        		$e_time = strtotime($end_time);
	        		$where['where']['stan.open_time_int <'] = $e_time;
	        		$countwhere['open_time_int <'] = $e_time;
	        	}
	        }
       }elseif($s_type == '2'){
       	     if(!empty($show_time)){
	        	$s_time = strtotime($show_time);
	        	$where['where']['stan.dabiao_time_int >'] = $s_time;
	        	$countwhere['dabiao_time_int >'] = $s_time;
	        	if(!empty($end_time)){
	        		$e_time = strtotime($end_time);
	        		$where['where']['stan.dabiao_time_int <'] = $e_time;
	        		$countwhere['dabiao_time_int <'] = $e_time;
	        	}
	        }
       }else{
       	    if(!empty($show_time)){
	        	$s_time = strtotime($show_time);
	        	$where['where']['stan.addtime >'] = $s_time;
	        	$countwhere['addtime >'] = $s_time;
	        	if(!empty($end_time)){
	        		$e_time = strtotime($end_time);
	        		$where['where']['stan.addtime <'] = $e_time;
	        		$countwhere['addtime <'] = $e_time;
	        	}
	        }
       }





        if(!empty($cbc)){
        	$where['where']['stan.dev_sn'] = $cbc;
        	$countwhere['dev_sn'] = $cbc;
        }

        if($dabiao != 'all'){
        	$where['where']['stan.dabiao'] = $dabiao;
        	$countwhere['dabiao'] = $dabiao;

        }

        $limit = 20;
        $offset = ($page - 1) * $limit;
        $pagination = '';
        
        $count = $this->standard->get_count($countwhere);
        $data['count'] = $count;

        $pageconfig['base_url'] = base_url('/home/standard/index?show_time='.$show_time.'&end_time='.$end_time.'&dabiao='.$dabiao.'&cbc='.$cbc.'&s_type='.$s_type);
        $pageconfig['count'] = $count;
        $pageconfig['limit'] = $limit;
        $data['page'] = home_page($pageconfig);

        $where['where']['logis.status <>'] = '6';
		$list = array();		
		$where['page'] = true;
        $where['limit'] = $limit;
        $where['offset'] = $offset;
        $where['order'] = array('key'=>'stan.open_time_int','value'=>'desc');
		$list = $this->standard->get_list_by_join($where);	
		print_r($list);
		exit;

		$data['list'] = $list;
		$this->tpl('home/standard_tpl',$data);

	}


	public function imports()
	{
		// $check_role = $this->userlib->check_role('import_logistics');
		$files = dirname().'uploads'.'/excel';
				if(!is_dir($files)){
					mkdir($files);					
				}
					
		if(!empty($_FILES['excel']['name'])){

            $config['upload_path'] = FCPATH.'/uploads/excel/';
            
            $config['allowed_types'] = '*';
            $config['file_name']  =date("YmdHis").'_stan';
            $m_type = $this->input->post('m_type');

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

					$add['weihu']   = $arr[1];
					$add['merchant_no'] = $arr[0];
					$add['merchant_name'] = $arr[2];
					$add['p_type']    = $arr[3];
					$add['dev_sn']  = $arr[4];
					$add['dev_no'] = $arr[5];
					$add['open_time_int'] = empty($arr[6]) ? 0 : strtotime($arr[6]);
					$add['open_time']  = $arr[6];
					$add['close_time_int'] = empty($arr[7]) ? 0 : strtotime($arr[7]);
					$add['close_time'] = $arr[7];
					$add['song'] = $arr[8];
					$add['dabiao'] = $arr[9];
					$add['dabiao_time_int'] = empty($arr[10]) ? 0 : strtotime($arr[10]);
					$add['dabiao_time'] = $arr[10];
					$add['addtime'] = time();
					$add['m_type'] = $m_type;
					$add['chuhuo_time'] = $arr[11];
					$add['chuhuo_time_int'] = empty($arr[11]) ? 0 : strtotime($arr[11]);

					$check = $this->check_data($add['dev_sn']);
					if(empty($check)){

						if($this->standard->add($add)){

							$add_count +=1;
						}

					}else{

						$update_info_config['dev_sn'] = $add['dev_sn'];
						if($this->standard->update($update_info_config,$add))
						{
							$update_count += 1;
						}
						

					}


					if($add['dabiao'] == '是'){

						$update_status_config['dev_sn'] = $add['dev_sn'];
						$update_status_config['status<>'] = '6';

						$update_data['status'] = '8';
						//修改物流状态
						//$update_status_config['phone'] = $add['dev_sn'];
						$this->logistics->update($update_status_config,$update_data);
						//修改申请列表状态
						//物流信息
						$logis_where['where']['dev_sn'] = $add['dev_sn'];
						$logis_where['where']['status<>'] = '6';
						$logis_info = $this->logistics->get_one_by_where($logis_where);
						$update_business_config['phone'] = $logis_info['phone'];
						//更新申请列表
						$this->business->update($update_business_config,$update_data);

					}else{

						//已激活
						$update_data['status'] = '7';

						$update_status_config['dev_sn'] = $add['dev_sn'];
						$update_status_config['status<>'] = '6';
						//修改物流状态
						$update_status_config['phone'] = $add['dev_sn'];
						if($this->logistics->update($update_status_config,$update_data)){
							//修改申请列表状态
							//物流信息
							$logis_where['where']['dev_sn'] = $add['dev_sn'];
							$logis_info = $this->logistics->get_one_by_where($logis_where);
							$update_business_config['phone'] = $logis_info['phone'];
								//更新申请列表
							$this->business->update($update_business_config,$update_data);
						}


					}
				}
			
		        $msg['title'] = '成功导入:<font color="red">'.$add_count.'</font>条数据,更新：<font color="red">'.$update_count.'</font>条数据';
				$msg['msg'] = '<a href="'.base_url().'home/standard/index?">返回列表</a> ';
				$this->tpl('msg/msg_success',$msg);

		    }

		}else{    
			
			$this->tpl('/home/standard_excel_tpl');
		} 
	}

	//物流
	public function wuliu()
	{
		$cbc = $this->input->get('cbc');
		$where['where']['dev_sn'] = $cbc;

		$list = $this->logistics->getList($where);
		$data['list'] = $list;

		$this->tpl('home/standard_wuliu_tpl',$data);


	}

	public function check_data($dev_sn)
	{
		$where['where']['dev_sn'] = $dev_sn;
		$info = $this->standard->get_one_by_where($where);
		if(!empty($info)){

			return 1;

		}else{

			return 0;

		}
	}

	public function add_info()
	{
		$remark = $this->input->post('remark');
		$id = $this->input->post('id');
		$update_config['id'] = $id;
		$update_data['remark'] = $remark;
		$this->standard->update($update_config,$update_data);
		$msg = array(
			'code'=>'0',
			'msg'=>'成功'
			);
		echo json_encode($msg);
		exit;
	}

	public function do_search()
	{
		
		if($_POST){

			$dev_sn = $this->input->post('dev_sn');

			if(!empty($dev_sn)){

				$where['where']['dev_sn'] = $dev_sn;
				$info = $this->standard->get_one_by_where($where);
				if(!empty($info)){

					$str = '<table class="table table-striped table-bordered table-hover dataTables-example"><thead><thead>
                                <tr>                                    
                                    <th></th>                                   
                                    <th></th>

                                </tr>
                            </thead> <tbody>';

					
					$str .= '<tr><td>商户号</td><td>'.$info['merchant_no'].'</td></tr>';	
					$str .= '<tr><td>商户名称</td><td>'.$info['merchant_name'].'</td></tr>';	
					$str .= '<tr><td>终端号</td><td>'.$info['dev_sn'].'</td></tr>';	
					$str .= '<tr><td>开通时间</td><td>'.$info['open_time'].'</td></tr>';	
					$str .= '<tr><td>是否达标</td><td>'.$info['dabiao'].'</td></tr>';	
					$str .= '<tr><td>达标时间</td><td>'.$info['dabiao_time'].'</td></tr>';
					$str .= '<tr><td>机构</td><td>'.machines_type($info['m_type']).'</td></tr>';			
					$str .= '</tbody></table>';
				}else{
					$str = '没有相关记录';
				}
			}else{
				$str = '请输入CBC码';
			}

			$msg = array(
				'code'=>'0',
				'msg'=>'ok',
				'data'=>$str
				);

			responseData($msg);
			
		}else{

			$this->tpl('home/standard_do_search_tpl',$data);

		}
		
	}

	
}