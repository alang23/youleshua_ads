 <!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>H+ 后台主题UI框架 - 基础表格</title>
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
                        <h5>广告流量池</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="table_basic.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="table_basic.html#">选项1</a>
                                </li>
                                <li><a href="table_basic.html#">选项2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="">
                            <a  href="<?=base_url()?>home/adpond/add" class="btn btn-primary ">添加</a>
                            <button type="button" class="btn btn-w-sm btn-white" onclick="location.reload();"><i class="fa fa-refresh"></i> 刷新</button> 
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>名称</th>
                                    <th>编号</th>
                                    <th>状态</th>
                                    <th>备注</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($list as $k => $v){
                            ?>
                                <tr>
                                    <td><?=$v['id']?></td>
                                    <td><?=$v['title']?></td>
                                    <td><?=$v['p_no']?></td>
                                    <td><?=adpond_status($v['status'])?></td>    
                                    <td><?=$v['remark']?></td>                   
                                    <th>
                                    <a href="<?=base_url()?>home/adpond/update?id=<?=$v['id']?>">编辑</a> |
                                    <a href="javascript:void(0);" onclick="flush('删除后不能恢复，确定删除吗','<?=base_url()?>home/adpond/del?id=<?=$v['id']?>');">删除</a>
                                    </th>
                                </tr>
                                <?php
                                    }
                                ?>
                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>

    </div>
    <?php

        $this->load->view('widgets/main_footer_tpl');
    ?>
<script type="text/javascript" src="<?=base_url()?>static/layer/layer.js"></script>

<script>

function flush(msg,url){
  layer.confirm(msg, {
    btn: ['确定','取消'] //按钮
  }, function(){
      
      window.location=url;
      //alert(url);
  }, function(){
         

  });
}

</script>
</body>

</html>