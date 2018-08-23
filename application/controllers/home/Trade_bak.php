<?php


class Trade extends Zrjoboa
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Trade_mdl','trade');
		$this->load->library('My_excel','my_excel');
		$this->load->model('Deal_mdl','deal');

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

        if(!empty($m_type)){
        	$countwhere['m_type'] = $m_type;
        	$where['where']['m_type'] = $m_type;
        	$where_str .= " and m_type='$m_type'";

        }

        if(!empty($jigou_no)){
        	$countwhere['jigou_no'] = $jigou_no;
        	$where['where']['jigou_no'] = $jigou_no;
        	$where_str .= " and jigou_no='$jigou_no'";

        }



        $count = $this->trade->get_count($countwhere);
        $data['count'] = $count;

        $pageconfig['base_url'] = base_url('/home/trade/index?p_sn='.$p_sn.'&show_type='.$show_type.'&show_time='.$show_time.'&end_time='.$end_time.'&pay_type='.$pay_type.'&jigou_no='.$jigou_no);
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

		//daili


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
				$result = $this->my_excel->imports($dir);
				
				$add_count = 0;
				$update_count = 0;
				for ($i=1; $i < count($result); $i++) { 

					$order_sn   = $result[$i][0];
					$jigou = $result[$i][1];
					$jigou_no = $result[$i][2];
					$mer_no    = $result[$i][3];
					$mer_name  = $result[$i][4];
					$dev_no = $result[$i][5];
					$trade_date = $result[$i][10];
					$trade_time  = strtotime($result[$i][9]);
					$amount  = $result[$i][7];
					$pay_fee  = $result[$i][8];
					$pay_type  = $result[$i][9];
					$card_type   = $result[$i][11];
					$p_sn = $result[$i][12];
					
					$add['order_sn'] = $order_sn;
					$add['jigou'] = $jigou;
					$add['jigou_no'] = $jigou_no;
					$add['mer_no'] = $mer_no;
					$add['mer_name'] = $mer_name;
					$add['dev_no'] = $dev_no;
					$add['trade_date'] = $trade_date;
					$add['trade_time'] = strtotime($trade_date);
					$add['amount'] = $amount;
					$add['pay_fee'] = $pay_fee;
					$add['pay_type'] = $pay_type;
					$add['card_type'] = $card_type;
					$add['p_sn'] = $p_sn;
					$add['addtime'] = time();
					$add['m_type'] = $m_type;

					if(!empty($p_sn)){

						//$where['where'] = array('p_sn'=>$p_sn,'amount'=>$amount,'trade_time'=>$trade_time);
						$where['where'] = array('order_sn'=>$order_sn);
						
						$check_info = $this->trade->get_one_by_where($where);

						if(empty($check_info)){

							if($this->trade->add($add)){
								
								$add_count +=1;
							}
						}else{
							unset($add['addtime']);
							if($this->trade->update($where['where'],$add)){
								$update_count += 1;
							}

						}



					}

				}
				
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
                                </tr>
                            </thead> <tbody>';

					foreach($list as $k => $v){
						$str .= '<tr><td>'.$v['trade_date'].'</td><td>'.$v['amount'].'</td></tr>';
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




}