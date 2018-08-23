<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>添加物流信息</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <?php
        $this->load->view('widgets/main_source_tpl');
    ?>

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>添加物流信息</h5>
   
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal" name="form1" action="<?=base_url()?>home/logistics/add">
                   
                            <div class="form-group">
                                <label class="col-sm-2 control-label">收件人<font color="red">*</font></label>
                                <div class="col-sm-10">
                                    <input type="text" name="realname" class="input-sm form-control" value="" style='width: 200px;'>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">电话<font color="red">*</font></label>
                                <div class="col-sm-10">
                                     <input type="text" name="phone" id="phone" class="input-sm form-control" value="" style='width: 200px;'>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">详细地址<font color="red">*</font></label>
                                <div class="col-sm-10">
                                     <input type="text" name="address" id="address" class="form-control" value="" style='width: 400px;'>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">设备号<font color="red">*</font></label>
                                <div class="col-sm-10">
                                     <input type="text" name="dev_sn" id="dev_sn" class="input-sm form-control" value="" style='width: 200px;'>
                                </div>
                            </div>

                                
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">状态</label>
                                <div class="col-sm-10">



                                <select class="input-sm form-control input-s-sm inline" name="status" id="status" style="width: 200px; height: 35px;">
                                    <option value="0">未跟进</option>
                                    <option value="1" >未接通</option>
                                    <option value="2" >需求待定</option>
                                    <option value="3" >确认邮寄</option>
                                    <option value="4" >已寄出</option>
                                    <option value="5" >已签收</option>
                                    <option value="6" >已拒收</option>
                                    <option value="7" >已激活</option>
                                    <option value="8" >已达标</option>
                                     <option value="9" >不需要</option>

                                     <option value="10" >提交</option>
                                     <option value="11" >派送中</option>
                                     <option value="12" >问题件</option>
                                </select>


                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">机器类型<font color="red">*</font></label>
                                <div class="col-sm-10">
                                    <select class="input-sm form-control input-s-sm inline" name="merchant_id" id="merchant_id" style="width: 200px; height: 35px;">
                                    <option value="2" >拉卡拉</option>
                                    <option value="3" >快刷</option>
                                </select>
                                </div>
                            </div>
                        <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">押金<font color="red">*</font></label>
                                <div class="col-sm-10">
                                    <select class="input-sm form-control input-s-sm inline" name="types" id="types" style="width: 200px; height: 35px;">
                                    <option value="2" >99</option>
                                    <option value="3" >18邮费</option>
                                </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">快递<font color="red">*</font></label>
                                <div class="col-sm-10">
                                    <select class="input-sm form-control input-s-sm inline" name="express" id="express" style="width: 200px; height: 35px;">
                                    <option value="ZTO" >中通</option>
                                    <option value="SF" >顺丰</option>
                                    <option value="YZ" >邮政</option>
                                </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">订单号<font color="red">*</font></label>
                                <div class="col-sm-10">
                                     <input type="text" name="order_id" id="order_id" class="input-sm form-control" value="" style='width: 200px;'>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">客服<font color="red">*</font></label>
                                <div class="col-sm-10">
                                    <select class="input-sm form-control input-s-sm inline" name="admin" id="admin" style="width: 200px; height: 35px;">
                                    <?php
                                        foreach($admin as $admink => $adminv){
                                    ?>
                                    <option value="<?=$adminv['id']?>-<?=$adminv['realname']?>" ><?=$adminv['realname']?></option>
                                   <?php
                                    }
                                   ?>
                                </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                             <div class="form-group">
                                <label class="col-sm-2 control-label">备注<font color="red">*</font></label>
                                <div class="col-sm-10">
                                     <input type="text" name="remark" id="remark" class="input-sm form-control" value="" style='width: 200px;'>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                             <div class="form-group">
                                <div class="col-sm-10" align="center">
                                        
                                        <button class="btn btn-sm btn-primary" type="button" onclick="do_post();">提交</button> 
                                        <button class="btn btn-sm btn-defaults" type="button" onclick="history.back();">返回</button> 
                              </div>
                            </div>
                         </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <script type="text/javascript" src="<?=base_url()?>static/layer/jedate/jedate.js"></script>

 <script type="text/javascript">
    //jeDate.skin('gray');
  jeDate({
    dateCell:"#end",//isinitVal:true,
    format:"YYYY-MM-DD hh:mm:ss",
    isTime:true, //isClear:false,
    minDate:"2015-10-19 00:00:00",
    maxDate:"2099-00-00 00:00:00"
  })
    jeDate({
    dateCell:"#addtime",
    format:"YYYY-MM-DD hh:mm:ss",
   // isinitVal:true,
    isTime:true, //isClear:false,
    minDate:"2014-09-19 00:00:00",
    //okfun:function(val){alert(val)}
  })
</script>    
<script type="text/javascript">
    
    function do_post()
    {
        var phone = $("#phone").val();
        var realname = $("#realname").val();
        var address = $("#address").val();
        var order_id = $("#order_id").val();
        var express = $("#express").val();
        var status = $("#status").val();
        var merchant_id = $("#merchant_id").val();
        var dev_sn = $("#dev_sn").val();
       
        if(phone==''){
            alert('请填写手机号');
            return false;
        }

        if(dev_sn==''){
            alert('请填写设备号');
            return false;
        }


        if(realname == ''){
            alert('请填写真实姓名');

            return false;
        }

        if(express == ''){
            alert('请选择快递方式');

            return false;
        }


        if(merchant_id == ''){
            alert('请选择机器类型');
            return false;
        }


        document.form1.submit();


    }
</script>


    <?php

        $this->load->view('widgets/main_footer_tpl');
    ?>

</body>
</html>