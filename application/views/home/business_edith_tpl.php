<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>申请详细信息</title>
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
                        <h5>编辑申请信息</h5>
   
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal" action="<?=base_url()?>home/business/edith?id=<?=$info['id']?>">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">注册姓名</label>
                                <div class="col-sm-10">
                                    <input type="text" name="ad_name" class="input-sm form-control" value="<?=$info['ad_name']?>" style='width: 200px;'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">真实姓名</label>
                                <div class="col-sm-10">
                                    <input type="text" name="realname" class="input-sm form-control" value="<?=$info['realname']?>" style='width: 200px;'>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">电话</label>
                                <div class="col-sm-10">
                                     <input type="text" name="phone" class="input-sm form-control" value="<?=$info['phone']?>" style='width: 200px;'>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">身份证</label>
                                <div class="col-sm-10">
                                     <input type="text" name="card_no" class="input-sm form-control" value="<?=$info['card_no']?>" style='width: 200px;'>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">银行账号</label>
                                <div class="col-sm-10">
                                     <input type="text" name="access" class="input-sm form-control" value="<?=$info['access']?>" style='width: 200px;'>
                                </div>
                            </div>
                            
                            <div class="hr-line-dashed"></div>
                             <div class="form-group">
                                <label class="col-sm-2 control-label">省/市/区</label>
                                <div class="col-sm-10">
                                     <input type="text" name="address" class="input-sm form-control" value="<?=$info['address']?>" style='width: 200px;'>
                                </div>
                            </div>
                 
                            <div class="hr-line-dashed"></div>
                             <div class="form-group">
                                <label class="col-sm-2 control-label">地址</label>
                                <div class="col-sm-10">
                                     <input type="text" name="street" class="input-sm form-control" value="<?=$info['street']?>" style='width: 200px;'>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">四要素验证</label>
                                <div class="col-sm-10">
                                    <select class="input-sm form-control input-s-sm inline" name="factor" style="width: 200px; height: 35px;">
                                    <option value="1" <?php if($info['factor'] == '1'){?> selected <?php } ?>>通过</option>
                                    <option value="2" <?php if($info['factor'] == '2'){?> selected <?php } ?>>未通过</option>
                                </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">客服</label>
                                <div class="col-sm-10">
                                <select class="input-sm form-control input-s-sm inline" name="user_id" style="width: 200px; height: 35px;">
                                <option value="0" >所属客服</option>
                                    <?php
                                            foreach($users as $uk => $vk){
                                    ?>
                                        <option value="<?=$vk['id']?>" <?php if($vk['id'] == $info['user_id']){?> selected <?php } ?>><?=$vk['realname']?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">申请时间</label>

                                <div class="col-sm-10">
                                     <input type="text" name="addtime" id='addtime' class="input-sm form-control input-s-sm inline" value="<?=date('Y-m-d H:i:s',$info['addtime'])?>" style='width: 200px;'>

                                     <input type="hidden" id='end' class="input-sm form-control input-s-sm inline" value="<?=date('Y-m-d H:i:s',$info['addtime'])?>" style='width: 200px;'>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                           <!--  <div class="form-group">
                                <label class="col-sm-2 control-label">跟进状态</label>

                                <div class="col-sm-10">
                                    <select class="input-sm form-control input-s-sm inline" name="status" style="width: 200px; height: 35px;">
                                    <option value="0" <?php if($info['status'] == '0'){?> selected <?php } ?>>未跟进</option>
                                    <option value="1" <?php if($info['status'] == '1'){?> selected <?php } ?>>跟进中</option>
                                    <option value="2" <?php if($info['status'] == '2'){?> selected <?php } ?>>跟进结束</option>
                                    <option value="3" <?php if($info['status'] == '3'){?> selected <?php } ?>>确认邮寄</option>
                                     <option value="4" <?php if($info['status'] == '4'){?> selected <?php } ?>>未激活</option>
                                      <option value="5" <?php if($info['status'] == '5'){?> selected <?php } ?>>已激活</option>
                                </select>
                                </div>
                            </div>                -->             
                             <div class="form-group">
                                <div class="col-sm-10" align="center">
                                        
                                        <button class="btn btn-sm btn-primary" type="submit">提交</button> 
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



    <?php

        $this->load->view('widgets/main_footer_tpl');
    ?>

</body>
</html>