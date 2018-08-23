<?php


class Deal extends Zrjoboa
{
	


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Deal_mdl','deal');
                $this->load->model('Deal_log_mdl','deal_log');
	}


	public function index()
	{

		$userinfo = $this->userinfo;

		$page = isset($_GET['page']) ? $_GET['page'] : 0;
                $page = ($page && is_numeric($page)) ? intval($page) : 1;
                $data['pagenum'] = $page;
        
		$p_name = $this->input->get('p_name');
		$p_mobile = $this->input->get('p_mobile');
		$p_sn = $this->input->get('p_sn');
		$status = $this->input->get('status');
		$show_time = $this->input->get('show_time');		
		$end_time = $this->input->get('end_time');
		$types = $this->input->get('types');
                $p_pay = $this->input->get('p_pay');
                $dabiao = $this->input->get('dabiao');



		$data['p_mobile'] = $p_mobile;
		$data['p_sn'] = $p_sn;
		$data['p_name'] = $p_name;
		$data['status'] = $status;
		$data['show_time'] = $show_time;
		$data['end_time'] = $end_time;
		$data['types'] = $types;
                $data['p_pay'] = $p_pay;
                $data['dabiao'] = $dabiao;

                $limit = 20;
                $offset = ($page - 1) * $limit;
                $pagination = '';
        
		$list = array();
		$where['page'] = true;
                $where['limit'] = $limit;
                $where['offset'] = $offset;
                $where['order'] = array('key'=>'id','value'=>'desc');

                $where_count = array();

                $where_str = ' 1=1 ';

                if(!empty($p_sn)){
                	$where_str .= " and p_sn='$p_sn'";
                }

                if(!empty($p_mobile)){
                	$where_str .= " and p_mobile='$p_mobile'";
                }

                if(!empty($p_name)){
                	$where_str .= " and p_name='$p_name'";
                }

                if(!empty($types)){
                	$where_str .= " and types='$types'";
                }

                if(!empty($p_mobile)){
                	$where_str .= " and p_mobile='$p_mobile'";

                }

                if(is_numeric($status)){
        	        //$where['where']['deal.status'] = $status;
        	        $where_str .= ' and status = '.$status;

                }


                if(!empty($p_pay)){
                        $where_str .= " and p_pay='$p_pay'";

                }

                if(empty($dabiao)){
                        $dabiao = 'all';
                }
                if($dabiao != 'all'){
                        $where_str .= " and stan.dabiao='$dabiao'";

                }


                if(!empty($show_time)){
                        $s_time = strtotime($show_time);
                        $where_str .= " and deal.update_time >= '$s_time'";
                }

                if(!empty($end_time)){
                        $e_time = strtotime($end_time);
                        $where_str .= " and deal.update_time <= '$e_time'";
                }

                if($status == '3'){
                        $where_str .= ' order by update_time DESC';
                }else{
                        $where_str .= ' order by id DESC';
                }

               
                $where['where'] = $where_str;

                $count = $this->deal->get_list_count($where);
                $data['count'] = $count;

                $pageconfig['base_url'] = base_url('/home/deal/index?show_time='.$show_time.'&end_time='.$end_time.'&realname='.$realname.'&status='.$status.'&p_pay='.$p_pay.'&dabiao='.$dabiao);
                $pageconfig['count'] = $count;
                $pageconfig['limit'] = $limit;
                $data['page'] = home_page($pageconfig);
       
		$list = $this->deal->get_list($where);
		$data['list'] = $list;
              

		$this->tpl('home/deal_tpl',$data);
                

	}


        public function edit_lakala(){

                $userinfo = $this->userinfo;

                $uid = $this->input->post('id');
                $status = $this->input->post('status');
                $remark = $this->input->post('remark');
                // $_POST['id'] = 1952;
                // $uid = 1952;
                // $status = 3;

                if(!empty($_POST)){

                        $update_config = array('id'=>$uid);
                        $update_data['status'] = $status;
                        $update_data['remark'] = $remark;
                        $update_data['update_time'] = time();

                        $q_arr = array('0','1','2');
                        if(in_array($status, $q_arr)){
                                $ret = $this->userlib->check_role('shenhe_deal_status','json');
                                if(!$ret){
                                        $msg = array(
                                                        'code'=>'8',
                                                        'msg' => '无权限'                                         
                                                );
                                        echo json_encode($msg);
                                        exit;
                                }
                        }

                        if($status == '3'){
                                $ret = $this->userlib->check_role('do_deal_status','json');
                                if(!$ret){
                                        $msg = array(
                                                        'code'=>'9',
                                                        'msg' => '无权限'                                         
                                                );
                                        echo json_encode($msg);
                                        exit;
                                }
                        }

                        if($this->deal->update($update_config,$update_data)){

                                //修改订单和物流信息未已达标 - 
                                if($status == '3'){

                                        //物流
                                        $where['where']['id'] = $uid;
                                        $info = $this->deal->get_one_by_where($where);

                                        // $data_msg['phone'] = $info['p_mobile'];
                                        // $data_msg['status'] = '8';
                                        // $this->common_mdl->change_status($data_msg);
                                        //添加日志

                                }

                                $log_add['admin_name'] = $userinfo['realname'];
                                $log_add['addtime'] = time();
                                $log_add['status'] = $status;
                                $log_add['did'] = $uid;
                                $this->deal_log->add($log_add);

                                $msg = array(
                                                'code'=>'0',
                                                'msg' => '执行成功'                                         
                                        );

                        }else{

                                $msg = array(
                                                'code'=>'1',
                                                'msg'=>'执行失败'
                                        );

                        }
                        echo json_encode($msg);
                        exit;
                }else{

                        $id = isset($_GET['id']) ? $_GET['id'] : '';
                        $where['where']['id'] = $id;
                        $info = $this->deal->get_one_by_where($where);

                        $data['info'] = $info;
                        $this->tpl('home/deal_lakala_edit_tpl',$data);
                }
        }

        public function del_lakala()
        {
                $id = $this->input->get('id');

                $config = array('id'=>$id);
                if($this->deal->del($config)){
                        redirect('home/deal/index');
                }
        }

        //状态修改记录
        public function deal_log()
        {
                $id = $this->input->get('id');
                $where['where']['did'] = $id;

                $list = $this->deal_log->getList($where);

                $data['list'] = $list;

                $this->tpl('home/deal_log_tpl',$data);

        }


}