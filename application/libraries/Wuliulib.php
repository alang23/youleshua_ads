<?php
// //电商ID
// defined('EBusinessID') or define('EBusinessID', '1305171');
// //电商加密私钥，快递鸟提供，注意保管，不要泄漏
// defined('AppKey') or define('AppKey', '04cdd8c2-b4e1-413d-b2e5-2c167d133778');
// //请求url
// defined('ReqURL') or define('ReqURL', 'http://api.kdniao.cc/Ebusiness/EbusinessOrderHandle.aspx');

class Wuliulib{
    
    /**
     * 用户
     *
     * @access private
     * @var array
     */
    private $EBusinessID = '1305171';

    private $AppKey = '04cdd8c2-b4e1-413d-b2e5-2c167d133778';

    private $ReqURL = 'http://api.kdniao.cc/Ebusiness/EbusinessOrderHandle.aspx';
    
    /**
     * 是否已经登录
     * 
     * @access private
     * @var boolean
     */
    private $_hasLogin = NULL;
    
    /**
    * CI句柄
    * 
    * @access private
    * @var object
    */
    private $_CI;

    private $_KEY = 'WX_CMS';

        /**
     * Json方式 查询订单物流轨迹
     */
    public function getOrderTracesByJson($ShipperCode,$LogisticCode){

        $requestData= "{'OrderCode':'','ShipperCode':'".$ShipperCode."','LogisticCode':'".$LogisticCode."'}";
        
        $datas = array(
            'EBusinessID' => $this->EBusinessID,
            'RequestType' => '1002',
            'RequestData' => urlencode($requestData) ,
            'DataType' => '2',
        );
       
        $datas['DataSign'] = $this->encrypt($requestData, $this->AppKey);
        //var_dump($datas);
        $result=$this->sendPost($this->ReqURL, $datas);    
        
        $ret = array();
        if(!empty($result)){
            $ret = json_decode($result,true);
        }
        //根据公司业务处理返回的信息......
        
        return $ret;
    }
     
    /**
     *  post提交数据 
     * @param  string $url 请求Url
     * @param  array $datas 提交的数据 
     * @return url响应返回的html
     */
    public function sendPost($url, $datas) {
        $temps = array();   
        foreach ($datas as $key => $value) {
            $temps[] = sprintf('%s=%s', $key, $value);      
        }   
        $post_data = implode('&', $temps);
        $url_info = parse_url($url);
        if(empty($url_info['port']))
        {
            $url_info['port']=80;   
        }
        $httpheader = "POST " . $url_info['path'] . " HTTP/1.0\r\n";
        $httpheader.= "Host:" . $url_info['host'] . "\r\n";
        $httpheader.= "Content-Type:application/x-www-form-urlencoded\r\n";
        $httpheader.= "Content-Length:" . strlen($post_data) . "\r\n";
        $httpheader.= "Connection:close\r\n\r\n";
        $httpheader.= $post_data;
        $fd = fsockopen($url_info['host'], $url_info['port']);
        fwrite($fd, $httpheader);
        $gets = "";
        $headerFlag = true;
        while (!feof($fd)) {
            if (($header = @fgets($fd)) && ($header == "\r\n" || $header == "\n")) {
                break;
            }
        }
        while (!feof($fd)) {
            $gets.= fread($fd, 128);
        }
        fclose($fd);  
        
        return $gets;
    }

    /**
     * 电商Sign签名生成
     * @param data 内容   
     * @param appkey Appkey
     * @return DataSign签名
     */
    public function encrypt($data, $appkey) {
        return urlencode(base64_encode(md5($data.$appkey)));
    }


    //阿里云
    public function get_order_info($express,$order_id)
    {

        $host = "https://api09.aliyun.venuscn.com";
        $path = "/express/trace/query";
        $method = "GET";
        $appcode = "adf49c034cc942778d0c801ab2d52ca4";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "comid=".$express."&number=".$order_id;
        $bodys = "";
        $url = $host . $path . "?" . $querys;
        //$url = 'http://api09.aliyun.venuscn.com/express/trace/query?comid=SF&number=457367775825';
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
       // var_dump(curl_exec($curl));

        $ret = curl_exec($curl);

        $result = json_decode($ret,true);

        return $result;


    }


}