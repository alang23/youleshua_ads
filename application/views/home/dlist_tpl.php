 <!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>申请列表</title>
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
                        <h5>广告数据</h5>


                    </div>

                    <div class="ibox-content">
                        <div class="">
                            
                        </div>
                        <div class="row">

                            <div class="col-sm-3">
                            <form action="<?=base_url()?>home/ads/index" method='get'>
                                <div class="input-group">                              
                                    
                                       
                                        <button type="button" class="btn btn-w-sm btn-white" onclick="location.reload();"><i class="fa fa-refresh"></i> 刷新</button> 
                                        <button type="button" class="btn btn-sm btn-primary" onclick="window.location='<?=base_url()?>home/ads'"> 返回</button> 
                                        </span>
                               
                                </div>
                             </form>
                            </div>
                        </div>

                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>日期</th>
                                    <th>总点击</th>
                                    <th>UV</th>
                                    <th>注册</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($list as $k => $v){
                            ?>
                                <tr>
                                    <td><?=$v['id']?></td>
                                    <td><?=$v['dates']?></td>
                                    <td><?=$v['total']?></td>
                                    <td><?=$v['uv_total']?></td>
                                    <td><?=$v['reg_total']?></td>
                                    <th>
                                    <a href="<?=base_url()?>home/ads/d_update?id=<?=$v['id']?>&aid=<?=$v['aid']?>"><i class="fa fa-pencil-square-o text-navy"></i> 编辑</a> 
                                  
                                  
                                    </th>
                                </tr>

                                                    
                                <?php
                                    }
                                ?>
                
                            </tbody>
                             <tfoot>

                                <tr>
                                    <td colspan="11" class="footable-visible">
                                        <ul class="pagination pull-right">
                           
                                            <?=$page?>
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