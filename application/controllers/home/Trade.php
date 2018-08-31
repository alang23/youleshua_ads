<?php


class Trade extends Zrjoboa
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Trade_mdl','trade');
		$this->load->model('Trade_xiaoer_mdl','trade_xiaoer');
		$this->load->library('My_excel','my_excel');
		$this->load->model('Deal_mdl','deal');
		$this->load->model('Account_mdl','admin');
		$this->load->model('Logistics_mdl','logis');

	}


	public function index()
	{

		$userinfo = $this->userinfo;
		$page = isset($_GET['page']) ? $_GET['page'] : 0;
        $page = ($page && is_numeric($page)) ? intval($page) : 1;
        $pay_type = isset($_GET['pay_type']) ? $_GET['pay_type'] : '';
        $show_type = $this->input->get('show_type');
        $show_time = $this->input->get('show_time');		
		$end_time = $this->input->get('end_time');
		$m_type = isset($_GET['m_type']) ? $_GET['m_type'] : '0';
		$jigou_no = isset($_GET['jigou_no']) ? $_GET['jigou_no'] : '0';
		$bijiao = isset($_GET['bijiao']) ? $_GET['bijiao'] : '0';
		$jiner = isset($_GET['jiner']) ? $_GET['jiner'] : '0';

        $p_sn = isset($_GET['p_sn']) ? $_GET['p_sn'] : '';
        $p_name = isset($_GET['p_name']) ? $_GET['p_name'] : '';
        $p_mobile = isset($_GET['p_mobile']) ? $_GET['p_mobile'] : '';
        $data['p_sn'] = $p_sn;
        $data['p_name'] = $p_name;
        $data['p_mobile'] = $p_mobile;
        $data['pay_type'] = $pay_type;
        $data['show_time'] = $show_time;
        $data['end_time'] = $end_time;	
		$data['m_type'] = $m_type;
		$data['jigou_no'] = $jigou_no;
		$data['bijiao'] = $bijiao;
		$data['jiner'] = $jiner;
		$kefu = isset($_GET['kefu']) ? $_GET['kefu'] : '0';
        $chuhuo = isset($_GET['chuhuo']) ? $_GET['chuhuo'] : '0';

        $limit = 20;
        $offset = ($page - 1) * $limit;
        $pagination = '';
        
        $where_str = '1=1';
        $countwhere['isdel'] = 0;
        if(!empty($p_sn)){
        	$countwhere['p_sn'] = $p_sn;
        	$where['where']['trade.p_sn'] = $p_sn;
        	$where_str .= " and trade.p_sn='$p_sn'";

        }

                //搜索条件
        if(!empty($show_time)){
        	$s_time = strtotime($show_time);
        	$where['where']['trade.trade_time >'] = $s_time;
        	$countwhere['trade_time >'] = $s_time;
        	$where_str .= " and trade.trade_time >'$s_time'";
        	if (!empty($end_time)) {
        		$e_time = strtotime($end_time);
        		$where['where']['trade.trade_time <'] = $e_time;
        		$countwhere['trade_time <'] = $e_time;
        		$where_str .= " and trade.trade_time < '$e_time'";
        	}
        }

       if(!empty($p_name)){
        	$countwhere['p_name'] = $p_name;
        	$where['where']['trade.p_name'] = $p_name;
        	$where_str .= " and trade.p_name='$p_name'";

        }

        if(!empty($pay_type)){
        	$countwhere['pay_type'] = $pay_type;
        	$where['where']['trade.pay_type'] = $pay_type;
        	$where_str .= " and trade.pay_type='$pay_type'";
        	
        }

        if(!empty($p_mobile)){
        	$countwhere['p_mobile'] = $p_mobile;
        	$where['where']['trade.p_mobile'] = $p_mobile;
        	$where_str .= " and trade.p_mobile='$p_mobile'";

        }

        if(!empty($m_type)){
        	$countwhere['m_type'] = $m_type;
        	$where['where']['trade.m_type'] = $m_type;
        	$where_str .= " and trade.m_type='$m_type'";

        }

        if(!empty($jigou_no)){
        	$countwhere['jigou_no'] = $jigou_no;
        	$where['where']['trade.jigou_no'] = $jigou_no;
        	$where_str .= " and trade.jigou_no='$jigou_no'";

        }

        // if(!empty($chuhuo)){
        // 	$countwhere['jigou_no'] = $jigou_no;
        // 	$where['where']['stan.'] = $jigou_no;
        // 	$where_str .= " and trade.jigou_no='$jigou_no'";

        // }

        if(!empty($jiner) && !empty($bijiao)){

        	if($bijiao == '1'){
        		$countwhere['amount > '] = $jigou_no;
        		$where['where']['trade.amount > '] = $jiner;
        		$where_str .= " and trade.amount > $jiner";
        	}elseif($bijiao == '2'){
        		$countwhere['amount < '] = $jigou_no;
        		$where['where']['trade.amount < '] = $jiner;
        		$where_str .= " and trade.amount < $jiner";
        	}elseif($bijiao == '3'){
        		$countwhere['amount = '] = $jigou_no;
        		$where['where']['trade.amount'] = $jiner;
        		$where_str .= " and trade.amount = $jiner";
        	}


        }



        $count = $this->trade->get_count_by_join($where);
        $data['count'] = $count;

        $pageconfig['base_url'] = base_url('/home/trade/index?p_sn='.$p_sn.'&show_type='.$show_type.'&show_time='.$show_time.'&end_time='.$end_time.'&pay_type='.$pay_type.'&jigou_no='.$jigou_no.'&m_type='.$m_type.'&bijiao='.$bijiao.'&amount='.$amount);
        $pageconfig['count'] = $count;
        $pageconfig['limit'] = $limit;
        $data['page'] = home_page($pageconfig);

		$list = array();
		$where['page'] = true;
        $where['limit'] = $limit;
        $where['offset'] = $offset;
        $where['where']['isdel'] = '0';

        $where['order'] = array('key'=>'trade.id','value'=>'DESC');
		$list = $this->trade->get_list_by_join($where);	
		$data['list'] = $list;
		
		$ret = $this->trade->total_amount($where_str);
		
		$data['amount'] = $ret['total'];

		//有交易的机器数
		$sql = "select * from ls_trade as trade left join ls_standard as stan on(stan.dev_sn = trade.p_sn) where ".$where_str.' GROUP BY trade.p_sn';
		$query = $this->db->query($sql);
		$arr = $query->result_array();
		$trade_total = count($arr);
		$data['trade_total'] = $trade_total;
		
		//$data['amount'] = 100;
		//$data['trade_total'] = 999999999;

		//daili

		//客服
		/*
		$admin = array();
		$admin = $this->admin->getList();
		$data['admin'] = $admin;
		*/

		//出货时间
		/*
		$sql = "select chuhuo_time from ls_standard group by chuhuo_time";
        $query = $this->db->query($sql);
        $chuhuo_list = $query->result_array();
       	$data['chuhuo_list'] = $chuhuo_list;
       	*/
       	$data['chuhuo_list'] = [];
		if($show_type == 'small'){

			$this->tpl('home/trade_small_tpl',$data);

		}else{

			$this->tpl('home/trade_tpl',$data);

		}

	}

	public function index_small()
	{

		$userinfo = $this->userinfo;
		$page = isset($_GET['page']) ? $_GET['page'] : 0;
        $page = ($page && is_numeric($page)) ? intval($page) : 1;
        $pay_type = isset($_GET['pay_type']) ? $_GET['pay_type'] : '';
        $show_type = $this->input->get('show_type');
        $show_time = $this->input->get('show_time');		
		$end_time = $this->input->get('end_time');

        $p_sn = isset($_GET['p_sn']) ? $_GET['p_sn'] : '';
        $p_name = isset($_GET['p_name']) ? $_GET['p_name'] : '';
        $p_mobile = isset($_GET['p_mobile']) ? $_GET['p_mobile'] : '';
        $data['p_sn'] = $p_sn;
        $data['p_name'] = $p_name;
        $data['p_mobile'] = $p_mobile;
        $data['pay_type'] = $pay_type;
        $data['show_time'] = $show_time;
		$data['end_time'] = $end_time;

        $limit = 20;
        $offset = ($page - 1) * $limit;
        $pagination = '';
        
        $where_str = '1=1';
        $countwhere['isdel'] = 0;
        if(!empty($p_sn)){
        	$countwhere['p_sn'] = $p_sn;
        	$where['where']['p_sn'] = $p_sn;
        	$where_str .= " and p_sn='$p_sn'";

        }

                //搜索条件
        if(!empty($show_time)){
        	$s_time = strtotime($show_time);
        	$where['where']['trade_time >'] = $s_time;
        	$countwhere['trade_time >'] = $s_time;
        	$where_str .= " and trade_time >'$s_time'";
        	if (!empty($end_time)) {
        		$e_time = strtotime($end_time);
        		$where['where']['trade_time <'] = $e_time;
        		$countwhere['trade_time <'] = $e_time;
        		$where_str .= " and trade_time < '$e_time'";
        	}
        }

       if(!empty($p_name)){
        	$countwhere['p_name'] = $p_name;
        	$where['where']['p_name'] = $p_name;
        	$where_str .= " and p_name='$p_name'";

        }

        if(!empty($pay_type)){
        	$countwhere['pay_type'] = $pay_type;
        	$where['where']['pay_type'] = $pay_type;
        	$where_str .= " and pay_type='$pay_type'";
        	
        }

        if(!empty($p_mobile)){
        	$countwhere['p_mobile'] = $p_mobile;
        	$where['where']['p_mobile'] = $p_mobile;
        	$where_str .= " and p_mobile='$p_mobile'";

        }

        $count = $this->trade->get_count($countwhere);
        $data['count'] = $count;

        $pageconfig['base_url'] = base_url('/home/trade/index_small?p_sn='.$p_sn.'&show_type='.$show_type.'&show_time='.$show_time.'&end_time='.$end_time.'&pay_type='.$pay_type);
        $pageconfig['count'] = $count;
        $pageconfig['limit'] = $limit;
        $data['page'] = home_page($pageconfig);

		$list = array();
		$where['page'] = true;
        $where['limit'] = $limit;
        $where['offset'] = $offset;
        $where['where']['isdel'] = '0';

        $where['order'] = array('key'=>'id','value'=>'DESC');
		$list = $this->trade->getList($where);	
		$data['list'] = $list;

		$ret = $this->trade->total_amount($where_str);
		
		$data['amount'] = $ret['total'];

		//有交易的机器数
		$sql = "select p_sn from ls_trade  where ".$where_str.' GROUP BY p_sn';
		$query = $this->db->query($sql);
		$arr = $query->result_array();
		$trade_total = count($arr);
		$data['trade_total'] = $trade_total;

		//物流信息查询
		$deal_where['where']['p_sn'] = $p_sn;
		$deal_info = $this->deal->get_one_by_where($deal_where);
		$data['info'] = $deal_info;
		//print_r($inf);
		
		$this->tpl('home/trade_small_tpl',$data);

	}


	//交易查询，跟进人员查询
	public function index_search()
	{

		$userinfo = $this->userinfo;
		$page = isset($_GET['page']) ? $_GET['page'] : 0;
        $page = ($page && is_numeric($page)) ? intval($page) : 1;
        $pay_type = isset($_GET['pay_type']) ? $_GET['pay_type'] : '';
        $show_type = $this->input->get('show_type');
        $show_time = $this->input->get('show_time');		
		$end_time = $this->input->get('end_time');

        $p_sn = isset($_GET['p_sn']) ? $_GET['p_sn'] : '';
        $p_name = isset($_GET['p_name']) ? $_GET['p_name'] : '';
        $p_mobile = isset($_GET['p_mobile']) ? $_GET['p_mobile'] : '';
        $data['p_sn'] = $p_sn;
        $data['p_name'] = $p_name;
        $data['p_mobile'] = $p_mobile;
        $data['pay_type'] = $pay_type;
        $data['show_time'] = $show_time;
		$data['end_time'] = $end_time;

        $limit = 20;
        $offset = ($page - 1) * $limit;
        $pagination = '';
        
        $where_str = '1=1';
        $countwhere['isdel'] = 0;
        $countwhere['p_sn'] = $p_sn;
        $where['where']['p_sn'] = $p_sn;


        $count = $this->trade->get_count($countwhere);
        $data['count'] = $count;

        $pageconfig['base_url'] = base_url('/home/trade/index_search?show_type='.$show_type.'show_time='.$show_time.'&end_time='.$end_time.'&pay_type='.$pay_type);
        $pageconfig['count'] = $count;
        $pageconfig['limit'] = $limit;
        $data['page'] = home_page($pageconfig);

		$list = array();
		$where['page'] = true;
        $where['limit'] = $limit;
        $where['offset'] = $offset;
        $where['where']['isdel'] = '0';

        $where['order'] = array('key'=>'id','value'=>'DESC');
		$list = $this->trade->getList($where);	
		$data['list'] = $list;

		$this->tpl('home/trade_search_tpl',$data);


	}

	public function imports()
	{
		$files = dirname().'uploads'.'/trade';
			if(!is_dir($files)){
					mkdir($files);					
		}
					
		if(!empty($_FILES['excel']['name'])){

            $config['upload_path'] = FCPATH.'/uploads/trade/';
            
            $config['allowed_types'] = '*';
            $config['file_name']  =date("YmdHis");

            $this->load->library('upload', $config);
            $m_type = $this->input->post('m_type');

            if ( ! $this->upload->do_upload('excel')){

                $error = array('error' => $this->upload->display_errors());
                echo json_encode($error);

            }else{

                $data = array('upload_data' => $this->upload->data());
                $picname = $data['upload_data']['orig_name'];
                $dir = FCPATH.$files.'/'.$picname;

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

						$add['order_sn'] = $arr[1];
						$add['jigou'] = $arr[2];
						$add['jigou_no'] = $arr[3];
						$add['mer_no'] = $arr[4];
						$add['mer_name'] = $arr[5];
						$add['dev_no'] = $arr[6];
						$add['trade_date'] = $arr[13];
						$add['trade_time'] = strtotime($arr[13]);
						$add['amount'] = $arr[8];
						$add['pay_fee'] = $arr[9];
						$add['pay_type'] = $arr[10];
						$add['card_type'] = $arr[14];
						$add['p_sn'] = $arr[15];
						$add['addtime'] = time();
						$add['m_type'] = $m_type;
						if(!empty($arr[1]) && !empty($arr[15])){

							try {

								if($this->trade->add($add)){
									$add_count +=1;
								}

								//小额
								// if($add['amount'] < 14){
								// 	$logis_info = array();
								// 	$logis_info = $this->get_logis($add['p_sn']);
								// 	$add['realname'] = isset($logis_info['realname']) ? $logis_info['realname'] : '未知';
								// 	$add['phone'] = isset($logis_info['phone']) ? $logis_info['phone'] : '未知';
								// 	$add['address'] = isset($logis_info['address']) ? $logis_info['address'] : '未知';
								// 	$add['uid'] = isset($logis_info['uid']) ? $logis_info['uid'] : '0';
								// 	$add['admin_name'] = isset($logis_info['admin_name']) ? $logis_info['admin_name'] : '未知';
								// 	$this->trade_xiaoer->add($add);
								// }
								
							}catch(Exception $e){
								print $e->getMessage();
								exit();
							}
							
						}



						
				}
				
				$update_count = 0;
		        $msg['title'] = '成功导入:<font color="red">'.$add_count.'</font>条数据,更新：<font color="red">'.$update_count.'</font>条数据';
				$msg['msg'] = '<a href="'.base_url().'home/trade/index?">返回列表</a> ';
				$this->tpl('msg/msg_success',$msg);
		    }

		}else{    
			$this->tpl('/home/imports_trade_tpl');
		} 
	}

	//添加订单
	public function add()
	{
		if(!empty($_POST)){
			$act_id = $this->input->post('act_id');
			$add['order_no'] = $this->input->post('order_no');
			$add['realname'] = $this->input->post('realname');
			$add['price'] = $this->input->post('price');
			$add['phone'] = $this->input->post('phone');
			
			$_act_id = explode(':', $act_id);
			$add['act_id'] = $_act_id[0];
			$add['pro_name'] = $_act_id[1];
			$add['addtime'] = time();
			if($this->trade->add($add)){
				redirect('/admin/trade/index');
			}
		}else{

			$data['activity'] = $this->get_activity();
			
			$this->tpl('admin/trade_add_tpl',$data);
		}

	}

	public function add_batch()
	{
		if(!empty($_POST)){

			$act_id = $this->input->post('act_id');
			$num = 0;
			if(!empty($_FILES['userfile']['name'])){

					$this->load->library('My_excel');

	                $config['upload_path'] = FCPATH.'/uploads/execl/';
	                
	                $config['allowed_types'] = '*';
	                $config['file_name']  =date("YmdHis");

	                $this->load->library('upload', $config);

	                if ( ! $this->upload->do_upload('userfile')){

	                    $error = array('error' => $this->upload->display_errors());
	                    echo json_encode($error);

	                }else{

	                    $data = array('upload_data' => $this->upload->data());
	                    $picname = $data['upload_data']['orig_name'];
	                    $dir = $config['upload_path'].$picname;
	                    $arr = array();
						$arr = $this->my_excel->read_csv($dir);
						if(count($arr) > 0){
							foreach($arr as $k => $v){
								$add['order_no'] = (string)$v['order_no'];
								$add['phone'] = (string)$v['phone'];
								$add['realname'] = (string)$v['realname'];
								$add['pro_name'] = (string)$v['pro_name'];
								$add['act_id'] = $act_id;
								$add['price'] = (string)$v['price'];
								$add['addtime'] = time();
								if($this->trade->add($add)){
									$num++;
								}
							}
						}

					echo '共导入:'.$num.' 条数据';
	                }

	        }else{
	           	exit('no file');
	        }
		}else{

			$data['activity'] = $this->get_activity();
			
			$this->tpl('admin/trade_add_batch_tpl',$data);

		}
	}

	public function edit()
	{
		if(!empty($_POST)){
			$act_id = $this->input->post('act_id');
			$id = $this->input->post('id');
			$add['order_no'] = $this->input->post('order_no');
			$add['realname'] = $this->input->post('realname');
			$add['price'] = $this->input->post('price');
			$add['phone'] = $this->input->post('phone');
			
			$_act_id = explode(':', $act_id);
			$add['act_id'] = $_act_id[0];
			$add['pro_name'] = $_act_id[1];
			$add['addtime'] = time();
			$update_config = array('id'=>$id);

			if($this->trade->update($update_config,$add)){

				redirect('/admin/trade/index');
			}
		}else{

			$id = $this->input->get('id');
			$where['where'] = array('id'=>$id);
			$data['info'] = $this->trade->get_one_by_where($where);

			$data['activity'] = $this->get_activity();
			
			$this->tpl('admin/trade_edit_tpl',$data);
		}

	}

	public function del()
	{
		$id = $this->input->get('id');
		$config = array('id'=>$id);
		if($this->trade->del($config)){
			redirect('/home/trade/index');
		}
	}

	public function delall()
	{
		$id = $this->input->post('id');
		$where = array('key'=>'id','value'=>$id);
		$this->trade->del(array(),$where);
		redirect('/admin/trade/index');
	}

	private function get_activity()
	{
		$activity = array();
		$activity = $this->activity->getList();

		return $activity;
	}


	public function do_search()
	{
		
		if($_POST){
			$dev_sn = $this->input->post('dev_sn');

			if(!empty($dev_sn)){
				$where['where']['p_sn'] = $dev_sn;
				$list = $this->trade->getList($where);
				$total = 0;
				if(!empty($list)){
					$str = '<table class="table table-striped table-bordered table-hover dataTables-example"><thead><thead>
                                <tr>                                    
                                    <th>交易日期</th>                                   
                                    <th>交易金额</th>
                                    <th>借贷记标</th>
                                </tr>
                            </thead> <tbody>';

					foreach($list as $k => $v){
						$str .= '<tr><td>'.$v['trade_date'].'</td><td>'.$v['amount'].'</td><td>'.$v['pay_type'].'</td></tr>';
						$total = $total+$v['amount'];
					}
					$str .= '</tbody></table>';
				}else{
					$str = '没有相关交易记录';
				}
			}else{
				$str = '请输入CBC码';
			}

			$msg = array(
				'code'=>'0',
				'msg'=>'ok',
				'data'=>array(
					'list'=>$str,
					'total' => $total
					)
				);

			responseData($msg);

		}else{
			$this->tpl('home/trade_do_search_tpl',$data);
		}
		
	}


	//导出
	public function export()
	{
		$userinfo = $this->userinfo;
		$page = isset($_GET['page']) ? $_GET['page'] : 0;
        $page = ($page && is_numeric($page)) ? intval($page) : 1;
        $pay_type = isset($_GET['pay_type']) ? $_GET['pay_type'] : '';
        $show_type = $this->input->get('show_type');
        $show_time = $this->input->get('show_time');		
		$end_time = $this->input->get('end_time');
		$m_type = isset($_GET['m_type']) ? $_GET['m_type'] : '0';
		$jigou_no = isset($_GET['jigou_no']) ? $_GET['jigou_no'] : '0';
		$bijiao = isset($_GET['bijiao']) ? $_GET['bijiao'] : '0';
		$jiner = isset($_GET['jiner']) ? $_GET['jiner'] : '0';

        $p_sn = isset($_GET['p_sn']) ? $_GET['p_sn'] : '';
        $p_name = isset($_GET['p_name']) ? $_GET['p_name'] : '';
        $p_mobile = isset($_GET['p_mobile']) ? $_GET['p_mobile'] : '';
        $data['p_sn'] = $p_sn;
        $data['p_name'] = $p_name;
        $data['p_mobile'] = $p_mobile;
        $data['pay_type'] = $pay_type;
        $data['show_time'] = $show_time;
        $data['end_time'] = $end_time;	
		$data['m_type'] = $m_type;
		$data['jigou_no'] = $jigou_no;
		$data['bijiao'] = $bijiao;
		$data['jiner'] = $jiner;
		$kefu = isset($_GET['kefu']) ? $_GET['kefu'] : '0';
        $chuhuo = isset($_GET['chuhuo']) ? $_GET['chuhuo'] : '0';

        $limit = 20;
        $offset = ($page - 1) * $limit;
        $pagination = '';
        
        $where_str = '1=1';
        $countwhere['isdel'] = 0;
        if(!empty($p_sn)){
        	$countwhere['p_sn'] = $p_sn;
        	$where['where']['trade.p_sn'] = $p_sn;
        	$where_str .= " and trade.p_sn='$p_sn'";

        }

                //搜索条件
        if(!empty($show_time)){
        	$s_time = strtotime($show_time);
        	$where['where']['trade.trade_time >'] = $s_time;
        	$countwhere['trade_time >'] = $s_time;
        	$where_str .= " and trade.trade_time >'$s_time'";
        	if (!empty($end_time)) {
        		$e_time = strtotime($end_time);
        		$where['where']['trade.trade_time <'] = $e_time;
        		$countwhere['trade_time <'] = $e_time;
        		$where_str .= " and trade.trade_time < '$e_time'";
        	}
        }

       if(!empty($p_name)){
        	$countwhere['p_name'] = $p_name;
        	$where['where']['trade.p_name'] = $p_name;
        	$where_str .= " and trade.p_name='$p_name'";

        }

        if(!empty($pay_type)){
        	$countwhere['pay_type'] = $pay_type;
        	$where['where']['trade.pay_type'] = $pay_type;
        	$where_str .= " and trade.pay_type='$pay_type'";
        	
        }

        if(!empty($p_mobile)){
        	$countwhere['p_mobile'] = $p_mobile;
        	$where['where']['trade.p_mobile'] = $p_mobile;
        	$where_str .= " and trade.p_mobile='$p_mobile'";

        }

        if(!empty($m_type)){
        	$countwhere['m_type'] = $m_type;
        	$where['where']['trade.m_type'] = $m_type;
        	$where_str .= " and trade.m_type='$m_type'";

        }

        if(!empty($jigou_no)){
        	$countwhere['jigou_no'] = $jigou_no;
        	$where['where']['trade.jigou_no'] = $jigou_no;
        	$where_str .= " and trade.jigou_no='$jigou_no'";

        }

        if(!empty($jiner) && !empty($bijiao)){

        	if($bijiao == '1'){
        		$countwhere['amount > '] = $jigou_no;
        		$where['where']['trade.amount > '] = $jiner;
        		$where_str .= " and trade.amount > $jiner";
        	}elseif($bijiao == '2'){
        		$countwhere['amount < '] = $jigou_no;
        		$where['where']['trade.amount < '] = $jiner;
        		$where_str .= " and trade.amount < $jiner";
        	}elseif($bijiao == '3'){
        		$countwhere['amount = '] = $jigou_no;
        		$where['where']['trade.amount'] = $jiner;
        		$where_str .= " and trade.amount = $jiner";
        	}


        }

		$list = array();
        $where['where']['isdel'] = '0';

        $where['order'] = array('key'=>'trade.id','value'=>'DESC');
		$list = $this->trade->get_list_by_join($where);	
		$this->my_excel->export_trade($list, '交易数据'.date("Ymd").'.xlsx');


	}

	//分析
	public function fenxi()
	{

		$userinfo = $this->userinfo;
		$page = isset($_GET['page']) ? $_GET['page'] : 0;
        $page = ($page && is_numeric($page)) ? intval($page) : 1;
        $show_time = $this->input->get('show_time');		
		$end_time = $this->input->get('end_time');
		$p_sn = isset($_GET['p_sn']) ? $_GET['p_sn'] : '';

		$data['show_time'] = $show_time;
        $data['end_time'] = $end_time;	
        $data['p_sn'] = $p_sn;

		
        //搜索条件
        $where_str  = '1=1';
        if(!empty($show_time)){
        	$s_time = strtotime($show_time);   
        	$where_str .= " and trade.trade_time >= '$s_time'";
        	if (!empty($end_time)) {
        		$e_time = strtotime($end_time);
        		$where_str .= " and trade.trade_time <= '$e_time'";
        	}
        }

        if(!empty($p_sn)){
        	$where_str .= " and trade.p_sn='$p_sn'";
        }

       	$sql_count = "select trade.p_sn from ls_trade as trade 
					left join ls_logistics as logis on(logis.dev_sn=trade.p_sn) 
					where logis.`status`<>6 and ".$where_str." group by trade.p_sn order by total desc";
		
		$query_count = $this->db->query($sql_count);
        $list_count = $query_count->result_array();

        $count = intval(count($list_count));
        $limit = 20;
        $offset = ($page - 1) * $limit;
        $pagination = '';

        $data['count'] = $count;
        $pageconfig['base_url'] = base_url('/home/trade/fenxi?p_sn='.$p_sn.'&show_time='.$show_time.'&end_time='.$end_time);
        $pageconfig['count'] = $count;
        $pageconfig['limit'] = $limit;
        $data['page'] = home_page($pageconfig);

		$sql = "select sum(amount) as total,p_sn,logis.realname,logis.phone,logis.address from ls_trade as trade 
					left join ls_logistics as logis on(logis.dev_sn=trade.p_sn) 
					where logis.`status`<>6 and ".$where_str." group by trade.p_sn  order by total desc  limit ".$offset.",20";

		$query = $this->db->query($sql);
        $list = $query->result_array();

        $data['list'] = $list;

        $this->tpl('home/trade_fenxi_tpl',$data);

	}

	public function shaixuan()
	{

		$userinfo = $this->userinfo;
		$page = isset($_GET['page']) ? $_GET['page'] : 0;
        $page = ($page && is_numeric($page)) ? intval($page) : 1;
        $show_time = $this->input->get('show_time');		
		$end_time = $this->input->get('end_time');

        $p_sn = isset($_GET['p_sn']) ? $_GET['p_sn'] : '';

        $data['p_sn'] = $p_sn;
        $data['show_time'] = $show_time;
        $data['end_time'] = $end_time;	

        $countwhere = array();
        $where = array();

        if(!empty($p_sn)){
        	$countwhere['p_sn'] = $p_sn;
        	$where['where']['p_sn'] = $p_sn;

        }

         //搜索条件
        if(!empty($show_time)){
        	$s_time = strtotime($show_time);
        	$where['where']['trade_time >'] = $s_time;
        	$countwhere['trade_time >'] = $s_time;
        	if (!empty($end_time)) {
        		$e_time = strtotime($end_time);
        		$where['where']['trade_time <'] = $e_time;
        		$countwhere['trade_time <'] = $e_time;
        	}
        }

        $limit = 20;
        $offset = ($page - 1) * $limit;
        $pagination = '';

                
        $count = $this->trade_xiaoer->get_count($countwhere);
        $data['count'] = $count;

        $pageconfig['base_url'] = base_url('/home/trade/shaixuan?show_time='.$show_time.'&end_time='.$end_time.'&p_sn='.$p_sn);
        $pageconfig['count'] = $count;
        $pageconfig['limit'] = $limit;
        $data['page'] = home_page($pageconfig);

		$list = array();
		$where['page'] = true;
        $where['limit'] = $limit;
        $where['offset'] = $offset;
        $where['order'] = array('key'=>'id','value'=>'desc');


		$list = $this->trade_xiaoer->getList($where);	
		$data['list'] = $list;


		$this->tpl('home/trade_shaixuan_tpl',$data);

	}

	//添加备注
	public function remarks()
	{
		$id = $this->input->post('id');
		$remarks = $this->input->post('remarks');
		if(!empty($id)){
			$update_config['id'] = $id;
			$update_data['remarks'] = $remarks;
			if($this->trade_xiaoer->update($update_config,$update_data)){
				$msg = array(
					'code'=>'0',
					'msg'=>'添加成功'
					);

			}else{
				$msg = array(
					'code'=>'1',
					'msg'=>'无任何修改'
					);
			}
		}else{
				$msg = array(
					'code'=>'2',
					'msg'=>'缺少参数'
					);
		}

		echo json_encode($msg);
		exit;
		
	}

	//查物流
	public function get_logis($dev_sn)
	{
		$where['where']['dev_sn'] = $dev_sn;
		$info = array();
		$info = $this->logis->get_one_by_where($where);

		return $info;
	}




}