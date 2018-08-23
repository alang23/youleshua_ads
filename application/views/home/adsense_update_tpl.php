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
                        <h5>修改广告</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="form_basic.html#">选项1</a>
                                </li>
                                <li><a href="form_basic.html#">选项2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal m-t" id="commentForm" method="post" action="<?=base_url()?>home/adsense/update">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">广告位名称：</label>
                                <div class="col-sm-8">
                                    <input id="title" name="title" minlength="2" type="text" class="form-control" required="" aria-required="true" value="<?=$info['title']?>">
                                </div>
                            </div>
         
                            <div class="form-group">
                                <label class="col-sm-3 control-label" >类型：</label>
                                <div class="col-sm-8">
                                   <select name="ad_type" class="form-control" >
                                        <option value="0" <?php if($info['ad_type'] == '0'){?> selected <?php }?>>图片</option>
                                        <option value="1" <?php if($info['ad_type'] == '1'){?> selected <?php }?>>文字</option>
                                   </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">URL：</label>
                                <div class="col-sm-8">
                                    <input id="url" type="url" class="form-control" name="url" value="<?=$info['url']?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">备注：</label>
                                <div class="col-sm-8">
                                    <textarea id="intro" name="intro" class="form-control" required="" aria-required="true"><?=$info['intro']?></textarea>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?=$info['id']?>" />
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-3">
                                    <button class="btn btn-primary" type="submit">提交</button>
                                    <button class="btn btn-defaults" type="button" onclick="history.back();">返回</button>
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