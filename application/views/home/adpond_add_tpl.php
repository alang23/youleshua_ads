<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>H+ 后台主题UI框架 - Bootstrap3 表单构建器</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">
    <?php
        $this->load->view('widgets/main_source_tpl');
    ?>

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content">
  <form class="form-horizontal m-t" id="commentForm" method="post" action="<?=base_url()?>home/adpond/add">
        <div class="row">
            <div class="col-sm-5">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>添加流量池</h5>
                    
                    </div>
                    <div class="ibox-content">

                      
                            <div class="form-group">
                                <label class="col-sm-3 control-label">名称：</label>
                                <div class="col-sm-8">
                                    <input id="title" name="title" minlength="2" type="text" class="form-control" required="" aria-required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">编号：</label>
                                <div class="col-sm-8">
                                    <input id="p_no" name="p_no" minlength="2" type="text" class="form-control" required="" aria-required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">状态：</label>
                                <div class="col-sm-8">
                                   <select name="status" class="form-control">
                                        <option value="1">开启</option>
                                        <option value="0">关闭</option>
                                   </select>
                                </div>
                            </div>
                         
                            <div class="form-group">
                                <label class="col-sm-3 control-label">备注：</label>
                                <div class="col-sm-8">
                                    <textarea id="remark" name="remark" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-3">
                                    <button class="btn btn-primary" type="submit">提交</button>
                                    <button class="btn btn-defaults" type="button" onclick="window.location='<?=base_url()?>home/adpond/index'">返回</button>

                                </div>
                            </div>
                       
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>广告</h5>
                   
                    </div>

                    <div class="ibox-content">
                        <div class="row form-body form-horizontal m-t">
                            
                         <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>广告名称</th>
                                    <th>渠道</th>
                                    <th>URL</th>
                                    <th>状态</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($ads as $k => $v){
                            ?>
                                <tr>
                                    <td><input type="checkbox" name="ids[]" value="<?=$v['id']?>"></td>
                                    <td><?=$v['ad_name']?></td>
                                    <td><?=$v['b_no']?></td>
                                    <td><?=$v['url']?></td>
                                    <td>
                                        
                                     <?php
                                        if($v['status'] == '0'){
                                    ?>
                                    <font style="color:red">关闭</font>
                                    <?php
                                        }else{
                                    ?>
                                    <font style="color:green">打开</font>
                                    <?php
                                        }
                                    ?>
                                    </td>
                        
                              
                                </tr>

                                <?php
                                    }
                                ?>
                
                            </tbody>
                             <tfoot>

                                <tr>
                                    <td colspan="11" class="footable-visible">
                                        <ul class="pagination pull-right">
                           
                                           
                                        </ul>
                                    </td>
                                </tr>
                                
                            </tfoot>
                        </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    <?php

        $this->load->view('widgets/main_footer_tpl');
    ?>
 
</body>

</html>