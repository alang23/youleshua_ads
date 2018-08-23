<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>H+ 后台主题UI框架 - 表单验证 jQuery Validation</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">
    <?php
        $this->load->view('widgets/main_source_tpl');
    ?>

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-sm-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>编辑品牌</h5>
                      
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal m-t" id="commentForm" method="post" action="<?=base_url()?>home/brand/update">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">品牌名称：</label>
                                <div class="col-sm-8">
                                    <input id="b_name" name="b_name" minlength="2" type="text" class="form-control"  value="<?=$info['b_name']?>" required="" aria-required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">品牌编号：</label>
                                <div class="col-sm-8">
                                    <input id="b_name" name="b_no" value="<?=$info['b_no']?>" minlength="2" type="text" class="form-control" required="" aria-required="true">
                                </div>
                            </div>  
                            <div class="form-group">
                                <label class="col-sm-3 control-label">备注：</label>
                                <div class="col-sm-8">
                                    <textarea id="intro" name="intro" class="form-control" ><?=$info['intro']?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-3">
                                    <input type="hidden" name="id" value="<?=$info['id']?>" />
                                    <button class="btn btn-primary" type="submit">提交</button>
                                     <button class="btn btn-primary" type="button" onclick="window.location='<?=base_url()?>home/brand/index'">返回</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

        </div>
    </div>
    <?php

        $this->load->view('widgets/main_footer_tpl');
    ?>
</body>

</html>