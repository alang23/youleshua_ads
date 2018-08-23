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
                        <h5>申请详细信息</h5>
   
                    </div>
                    <div class="ibox-content">
                        <form method="get" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">注册姓名</label>

                                <div class="col-sm-10">
                                    <p class="form-control-static"><?=$info['ad_name']?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">真实姓名</label>

                                <div class="col-sm-10">
                                    <p class="form-control-static"><?=$info['realname']?></p>
                                </div>
                            </div>
                           
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">电话</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?=$info['phone']?></p>
                                </div>
                            </div>                            
                            <?php if($type != 'cu_sever?v=4.0'){?>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">身份证</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?=$info['card_no']?></p>
                                </div>
                            </div>
                            <?php }?>
                            <?php if($type != 'cu_sever?v=4.0'){?>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">银行账号</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?=$info['access']?></p>
                                </div>
                            </div>
                            <?php }?>
                             <div class="hr-line-dashed"></div>
                             <div class="form-group">
                                <label class="col-sm-2 control-label">地区</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?=$info['address']?></p>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                             <div class="form-group">
                                <label class="col-sm-2 control-label">地址</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?=$info['street']?></p>
                                </div>
                            </div>
<!--                             <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">四要素验证</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?=siyaosu($info['factor'])?></p>
                                </div>
                            </div> -->
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">申请时间</label>

                                <div class="col-sm-10">
                                    <p class="form-control-static"><?=date("Y-m-d H:i:s",$info['addtime'])?></p>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">跟进状态</label>

                                <div class="col-sm-10">
                                    <p class="form-control-static"><span><?=flw_status($info['status'])?></span></p>
                                </div>
                            </div>
 
        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <?php

        $this->load->view('widgets/main_footer_tpl');
    ?>

</body>

</html>