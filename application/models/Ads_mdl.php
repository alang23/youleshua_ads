<?php


class Ads_mdl extends Zroa_Model
{
	
	var $table_name = 'ls_ads';
	var $table_statistics = 'ls_statistics';
    var $table_ad_parent = 'ls_ads_parent';
    var $table_click = 'ls_click';

	public function __construct()
	{
		parent::__construct();
		$this->set_table_name($this->table_name);
	}


	public function proccess($data)
	{

		$update_ads = 'UPDATE '.$this->table_name.' SET `total`=`total`+1 WHERE id='.$data['aid'];
		$this->db->query($update_ads);

        $ad_info_where = array('id'=>$data['aid']);
        $this->db->where($ad_info_where);
        $ad_info = $this->db->get($this->table_name)->row_array();
        $ad_pv = $ad_info['pv_base'];
        $ad_uv = $ad_info['uv_base'];
        $ad_reg = $ad_info['reg_base'];

		$config = array('aid'=>$data['aid'],'dates'=>$data['dates']);
        $this->db->where($config);
        $info = $this->db->get($this->table_statistics)->row_array();
        $h = date("H");
        if(empty($info)){
            
        	$add['aid'] = $data['aid'];
            $add['pos_id'] = $data['pos_id'];
        	$add['month'] = $data['month'];
        	$add['days'] = $data['days'];
        	$add['year'] = $data['year'];
        	$add['hours'] = $data['hours'];
        	$add['dates'] = $data['dates'];
            $add['total'] = 1;
            $add['uv_total'] = 0;
            $add['h_'.$h] = 1;
        	$add['addtime'] = time();
            /*
            $add['bili_pv'] = $ad_pv;
            $add['bili_uv'] = $ad_uv;
            $add['bili_reg'] = $ad_reg;
            */
            $this->db->insert($this->table_statistics,$add);

        }else{
        	$update_ads_days = "UPDATE ".$this->table_statistics.' SET `'.$data['field'].'`='.'`'.$data['field'].'`+1 , `total`=`total`+1 WHERE aid='.$data['aid']." AND dates='{$data['dates']}'";
        	$this->db->query($update_ads_days);

        }

        //UV
        $ip = $data['ip'];
        $ip2 = ip2long($ip);
        $ip_where = array('aid'=>$data['aid'],'ip2'=>$ip2);
        $this->db->where($ip_where);
        $click_info = $this->db->get($this->table_click)->row_array();

        if(empty($click_info)){

            $ip_add['aid'] = $data['aid'];
            $ip_add['dates'] = date("Ymd");
            $ip_add['ip'] = $ip;
            $ip_add['ip2'] = $ip2;
            $ip_add['addtime'] = time();

            $this->db->insert($this->table_click,$ip_add);
            //更新UV
            $update_uv = 'UPDATE '.$this->table_name.' SET `uv_total`=`uv_total`+1 WHERE id='.$data['aid'];
            $this->db->query($update_uv);

            $update_ads_uv = "UPDATE ".$this->table_statistics.' SET `uv_total`=`uv_total`+1  WHERE aid='.$data['aid']." AND dates='{$data['dates']}'";
            $this->db->query($update_ads_uv);

        }

	}


        //今日流量
    public function date_count()
    {
        $theday = date("Y-m-d");
        $tomorrow = mktime(0,0,0,date("m"),date("d")+1,date("Y"));
        $thedaytime = strtotime($theday);

        $sql = "select count(frm) as total,bus.id,bus.phone,bus.frm ,ads.id as aid,ads.ad_name from ls_business as bus 
                    left join ls_ads as ads on(ads.id=bus.frm) 
                    where bus.addtime > ".$thedaytime." and bus.addtime < ".$tomorrow." group by frm";
        $query = $this->db->query($sql);
        $arr = $query->result_array();

        return $arr;
    }

    public function update_reg_total($data)
    {
            
            $update_ads_days = "UPDATE ".$this->table_name.' SET `reg_total`=`reg_total`+1  WHERE id='.$data['aid'];
            $this->db->query($update_ads_days);


            $update_ads_uv = "UPDATE ".$this->table_statistics.' SET `reg_total`=`reg_total`+1  WHERE aid='.$data['aid']." AND dates='{$data['dates']}'";
            $this->db->query($update_ads_uv);

            //时刻注册

            $update_ads_h_reg =  "UPDATE ".$this->table_statistics.' SET `'.$data['hour'].'`='.'`'.$data['hour'].'`+1  WHERE aid='.$data['aid']." AND dates='{$data['dates']}'";
            $this->db->query($update_ads_h_reg);

    }


    public function update_cpa_total($data)
    {
            
            $update_ads_days = "UPDATE ".$this->table_name.' SET `cpa_total`=`cpa_total`+1  WHERE id='.$data['aid'];
            $this->db->query($update_ads_days);

            $check_sql = "SELECT * FROM ".$this->table_statistics." WHERE aid=".$data['aid']." AND dates='{$data['dates']}'";
            $query = $this->db->query($check_sql);
            $row = $query->row();

            if(empty($row)){

                $filed = 'h_'.date("H");
                $add_data['aid'] = $data['aid'];
                $add_data['pos_id'] = $data['pos_id'];
                $add_data['dates'] = date("Y-m-d");
                $add_data['pos_id'] = $data['aid'];
                $add_data['year'] = date("Y");
                $add_data['month'] = date("m");
                $add_data['days'] = date("d");
                $add_data['hours'] = date("H");
                $add_data['total'] = 1;
                $add_data['uv_total'] = 1;
                $add_data['cpa_total'] = 1;
                $add_data['h_'.$filed] = 1;
                
                $this->db->insert($this->table_statistics,$data);

            }else{

                $update_ads_uv = "UPDATE ".$this->table_statistics.' SET `reg_total`=`reg_total`+1  WHERE aid='.$data['aid']." AND dates='{$data['dates']}'";
                $this->db->query($update_ads_uv);
            }

    }

    //
    public function update_parent_reg($data)
    {
        //更新子渠道数据
            $update_parent_num = "UPDATE ".$this->table_ad_parent.' SET `reg_num`=`reg_num`+1  WHERE id='.$data['pid'];
            $this->db->query($update_parent_num);
    }


	
}