<?php

/**
*@desc 密码生成
*
**/
if ( ! function_exists('user_pawd'))
{
	function user_pawd($pawd,$key='')
	{
		return md5($pawd);
	}

}


if ( ! function_exists('responseData'))
{
	function responseData($data,$type='json')
	{
		echo json_encode($data);
		exit;
	}

}


if ( ! function_exists('deal_type'))
{
     function deal_type($status)
    {
        $result = '';
        switch($status){
            case 1:
                $result = '支付宝';
                break;
            case 2:
                $result = '银行卡';
                break;
  
            default:
                $result = '未知';
                break;
        }

        return $result;
    }

}

if ( ! function_exists('grade_type'))
{
     function grade_type($status)
    {
        $result = '';
        switch($status){
            case 0:
                $result = '<span class="badge">一般</span>';
                break;
            case 1:
                $result = '<span class="badge badge-danger">紧急</span>';
                break;
            case 2:

                $result = '<span class="badge badge-primary">重要</span>';
                break;

            default:
                $result = '未知';
                break;
        }

        return $result;
    }

}

//分配状态
if ( ! function_exists('work_type'))
{
     function work_type($status)
    {
        $result = '';
        switch($status){
            case 1:
                $result = '<font style="color:#1AB394">正常分配</font>';
                break;
            case 0:
                $result = '<font style="color:#F52136">关闭分配</font>';
                break;
  
            default:
                $result = '未知';
                break;
        }

        return $result;
    }

}

//分配状态
if ( ! function_exists('adpond_status'))
{
     function adpond_status($status)
    {
        $result = '';
        switch($status){
            case 1:
                $result = '<font style="color:#1AB394">开启</font>';
                break;
            case 0:
                $result = '<font style="color:#F52136">关闭</font>';
                break;
  
            default:
                $result = '未知';
                break;
        }

        return $result;
    }

}

//状态提示
if ( ! function_exists('user_prompt'))
{
     function user_prompt($status)
    {
        $result = '';
        switch($status){
            case 0:
                $result = '<font style="color:#FD8508;">待审核</font>';
                break;
            case 1:
                $result = '<font style="color:#1AB394;">审核通过</font>';
                break;
            case 2:
                $result = '<font style="color:red;">审核不通过</font>';
                break;
            case 3:
                $result = '<font style="color:#125593;">已退还</font>';
                break;
  
            default:
                $result = '未知';
                break;
        }

        return $result;
    }

}

//刮奖方式
if(!function_exists('lottery_type')){

    function lottery_type($status)
    {
        $result = '';
        switch($status){
            case 0:
                $result = '系统刮奖';
                break;
            case 1:
                $result = '自助刮奖';
                break;
  
            default:
                $result = '系统刮奖';
                break;
        }

        return $result;
    }

}


//跟进内容类型
if(!function_exists('re_type')){

    function re_type($status)
    {
       $result = '';
        switch($status){
            case 1:
                $result = '完善资料';
                break;
            case 2:
                $result = '确认资料';
                break;
            case 3:
                $result = '签收确认';
                break;
            case 4:
                $result = '激活跟进';
                break;
            case 5:
                $result = '其他';
                break;
            default:
                $result = '未知';
                break;
        }

        return $result;
    }
}

//跟进状态
if(!function_exists('flw_status')){
    //0-未跟进、1-未接通、2-需求待定、3-确认邮寄、4-已寄出、5-已签收、6-已拒收、7-已激活、8-已达标
    function flw_status($status)
    {
       $result = '';
        switch($status){
            case 0:
                $result = '<font class="label label-default">未跟进</font>';
                break;
            case 1:
                $result = '<font class="label label-warning">未接通</font>';
                break;
            case 2:
                $result = '<font class="label label-info">需求待定</font>';
                break;
            case 3:
                $result = '<font class="label label-primary">确认邮寄</font>';
                break;
            case 4:
                $result = '<font class="label label-warning">已寄出</font>';
                break;
            case 5:
                $result = '<font class="label label-primary">已签收</font>';
                break;
            case 6:
                $result = '<font class="label label-danger">已拒收</font>';
                break;
            case 7:
                $result = '<font class="label label-primary">已激活</font>';
                break;
            case 8:
                $result = '<font class="label label-red">已达标</font>';
                break;
            case 9:
                $result = '<font class="label label-red">不需要</font>';
                break;
            case 10:
                $result = '<font class="label label-red">提交</font>';
                break;
            case 11:
                $result = '<font class="label label-red">派送中</font>';
                break;
            case 12:
                $result = '<font class="label label-red">问题件</font>';
                break;
            default:
                $result = '<font class="label label-danger">未知</font>';
                break;
        }

        return $result;
    }
}
//信息类型
if(!function_exists('msg_type')){

    function msg_type($status)
    {
       $result = '';
        switch($status){
            case 1:
                $result = '完善资料带链接';
                break;
            case 2:
                $result = '快递发出提醒';
                break;
            case 3:
                $result = '快递签收提醒';
                break;
            case 4:
                $result = 'POS激活提醒';
                break;
            case 5:
                $result = '其他';
                break;
            default:
                $result = '未知';
                break;
        }

        return $result;
    }
}

//信息类型
if(!function_exists('is_msg')){

    function is_msg($status)
    {
       $result = '';
        switch($status){
            case 0:
                $result = '<font color="red">否</font>';
                break;
            case 1:
                $result = '<font color="green">是</font>';
                break;
        }

        return $result;
    }
}

//客户类型
if( !function_exists('winning_status') ){

    function winning_status($v)
    {
        $result = '未知';
        switch($v){
            case 0:
                $result = '未中奖';
                break;
            case 1:
                $result = '已中奖';
                break;

            default:
                $resul = '未知';
                break;
        }

        return $result;
    }
}

if( !function_exists('passin_status') ){

    function passin_status($v)
    {
        $result = '未知';
        switch($v){
            case 0:
                $result = '<font color="green">正常</font>';
                break;
            case 1:
                $result = '<font color="red">流拍</font>';
                break;
            default:
                $resul = '未知';
                break;
        }

        return $result;
    }
}

if( !function_exists('view_phone')){

    function view_phone($phone,$start=3,$end=-4)
    {   
        $result = $phone;
        $result = substr_replace($phone, '****', $start, $end);

        return $result;
    }
}

//验证银行四幺四
if( !function_exists('trade_status') ){

    function trade_status($v)
    {

        $result = '未知';
        switch($v){
            case 0:
                $result = '<font color="green">正常</font>';
                break;
            case 1:
                $result = '<font color="red">售罄</font>';
                break;
            default:
                $resul = '未知';
                break;
        }

        return $result;
    }
}

if( !function_exists('kaitong_status') ){

    function kaitong_status($v)
    {

        $result = '未知';
        switch($v){
            case 0:
                $result = '<font color="blue">【未开通】</font>';
                break;
            case 1:
                $result = '<font color="red">【已开通】</font>';
                break;
            default:
                $resul = '未知';
                break;
        }

        return $result;
    }
}


if( !function_exists('jisubank4') ){

    function jisubank4($data){

        $_ci = & get_instance();

        $appcode = $_ci->config->item('appcode');

        $host = "http://jisubank4.market.alicloudapi.com";
        $path = "/bankcardverify4/verify";
        $method = "GET";
        $appcode = $appcode;
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "bankcard=".$data['access']."&idcard=".$data['card_no']."&mobile=".$data['phone']."&realname=".$data['realname'];
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $ret = curl_exec($curl);

        $result = json_decode($ret,true);

        return $result;
    }

}



if( !function_exists('express') ){

    function express($data=array()){

        $_ci = & get_instance();

        $appcode = $_ci->config->item('appcode');

        $host = "http://express.woyueche.com";
        $path = "/query.action";
        $method = "POST";
        //$appcode = "你自己的AppCode";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        //根据API的要求，定义相对应的Content-Type
        array_push($headers, "Content-Type".":"."application/x-www-form-urlencoded; charset=UTF-8");
        $querys = "";
        $bodys = "express={$data['express']}&trackingNo={$data['trackingNo']}";
        $url = $host . $path;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        curl_setopt($curl, CURLOPT_POSTFIELDS, $bodys);
       
        $ret = curl_exec($curl);
       // var_dump($ret);
        $result = json_decode($ret,true);
        
        return $result;

    }

}


if( !function_exists('newssendmsg') ){

    function newssendmsg($data=array()){

        $_ci = & get_instance();

        //$appcode = $_ci->config->item('appcode');

        $host = "http://43.254.52.253:8088/websms/smsService";

        $method = "GET";
        $headers = array();
        $pawd = '52285782';
        $querys = "action=sendsms&userId=szlhhyhy&md5password=".md5($pawd)."&content=【快刷支付】ceshi&mobile=15814073945";
        $bodys = "";
        $url = $host . "?" . $querys;
        echo $url;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $ret = curl_exec($curl);
        var_dump($ret);
        exit;
        $result = json_decode($ret,true);

        return $result;

    }

}


if ( ! function_exists('ad_type'))
{
    function ad_type($type)
    {
        $ad_type = '未知';
        switch($type){
            case 0:
                $ad_type = '图片';
                break;
            case 1:
                $ad_type = '文字';
                break;
            default :
                $ad_type = '未知';
                break;
        }

        return $ad_type;
    }
}

if ( ! function_exists('status_re'))
{
    function status_re($type)
    {
        switch($type){
            case 0:
                $type = '<span class="label label-danger">无</span>';
                break;
            case 1:
                $type = '<span class="label label-primary">有</span>';
                break;
            default :
                $type = '未知';
                break;
        }

        return $type;
    }
}

if ( ! function_exists('siyaosu'))
{
    function siyaosu($type,$v=0)
    {
        $ad_type = '<span class="label label-danger">未通过</span>';
        switch($type){
            case 0:
                $ad_type = $v == '1' ? '未通过' : '<span class="label label-danger">未通过</span>';
                break;
            case 1:
                $ad_type = $v == '1' ? '通过' :'<span class="label label-primary">通过</span>';
                break;
            default :
                $ad_type = $v == '1' ? '未通过' :'<span class="label label-danger">未通过</span>';
                break;
        }

        return $ad_type;
    }
}

if(!function_exists('yajin')){
    function yajin($type)
    {
        switch ($type) {
            case '1':
                $result = '56';
                break;
            case '2':
                $result = '99';
                break;
            case '3':
                $result = '18邮费';
                break;
            case '4':
                $result = '23邮费';
                break;
            default:
                # code...
                $result = '0';
                break;
        }

        return $result;
    }
}

//跟进状态
if ( ! function_exists('status'))
{
    function status($type)
    {

        switch($type){
            case 0:
                $type = '<span class="label label-danger">未跟进</span>';
                break;
            case 1:
                $type = '<span class="label label-primary">跟进中</span>';
                break;
            case 2:
                $type = '<span class="label label-primary">跟进结束</span>';
                break;
            case 3:
                $type = '<span class="label label-primary">确认邮寄</span>';
                break;
            case 4:
                $type = '<span class="label label-danger">未激活</span>';
                break;
            case 5:
                $ype = '<span class="label label-primary">已激活</span>';
                break;
            default :
                $type = '<span class="label label-danger">未知状态</span>';
                break;
        }

        return $type;
    }
}


    function sub_str($str,$len)//$str字符串   $len 控制长度
    {
          $one=0;
          $partstr='';
          for($i=0;$i<$len;$i++){ 
            $sstr=substr($str,$one,1);
            if(ord($sstr)>224){
                $partstr.=substr($str,$one,3);
                $one+=3;
            }elseif(ord($sstr)>192){
                $partstr.=substr($str,$one,2);
                $one+=2;
            }elseif(ord($sstr)<192){
                $partstr.=substr($str,$one,1);
                $one+=1;
            }
         }
        if(strlen($str)<$one){
           return $partstr;
        }else{
        return $partstr.'....';
        }
    }


if(!function_exists('isMobile')){

    //判断是否是手机

    /*移动端判断*/
    function isMobile()
    { 
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
        {
            return true;
        } 
        // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset ($_SERVER['HTTP_VIA']))
        { 
            // 找不到为flase,否则为true
            return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
        } 
        // 脑残法，判断手机发送的客户端标志,兼容性有待提高
        if (isset ($_SERVER['HTTP_USER_AGENT']))
        {
            $clientkeywords = array ('nokia',
                'sony',
                'ericsson',
                'mot',
                'samsung',
                'htc',
                'sgh',
                'lg',
                'sharp',
                'sie-',
                'philips',
                'panasonic',
                'alcatel',
                'lenovo',
                'iphone',
                'ipod',
                'blackberry',
                'meizu',
                'android',
                'netfront',
                'symbian',
                'ucweb',
                'windowsce',
                'palm',
                'operamini',
                'operamobi',
                'openwave',
                'nexusone',
                'cldc',
                'midp',
                'wap',
                'mobile'
                ); 
            // 从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
            {
                return true;
            } 
        } 
        // 协议法，因为有可能不准确，放到最后判断
        if (isset ($_SERVER['HTTP_ACCEPT']))
        { 
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
            {
                return true;
            } 
        } 
        return false;
    } 
}

//刮奖方式
if(!function_exists('machines_type')){

    function machines_type($status)
    {
        $result = '';
        switch($status){
            case 1:
                $result = '力活';
                break;
            case 2:
                $result = '创展';
                break;
  
            default:
                $result = '未知';
                break;
        }

        return $result;
    }

}

if(!function_exists('machines_agent')){

    function machines_agent($status)
    {
        $result = '';
        switch($status){
            case '606842':
                $result = '广州市增城粤坚商行';
                break;
            case '571544':
                $result = '江陵县光明专业合作社';
                break;
            case '640147':
                $result = '鼎龙';
                break;
  
            default:
                $result = '未划拨';
                break;
        }

        return $result;
    }

}


if ( ! function_exists('get_ip'))
{
    function get_ip()
    {
        $CI =& get_instance();
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
         }else {
            $ip=$_SERVER['REMOTE_ADDR'];
         }
        return $ip;
    }
}

