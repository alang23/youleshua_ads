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
                        <h5>广告列表</h5>


                    </div>

                    <div class="ibox-content">
                      
                        <div class="row">

                            <div class="col-sm-3">
                            <form action="<?=base_url()?>home/ads/index" method='get'>
                                <div class="input-group">                              
                                 
                                        <button type="button" class="btn btn-w-sm btn-white" onclick="location.reload();"><i class="fa fa-refresh"></i> 刷新</button> 

                                    
                               
                                </div>
                             </form>
                            </div>
                        </div>

                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>位置</th>
                                    <th>tags</th>
                                    <th>图片</th>
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
                                    <td><?=$v['tags_name']?></td>
                                    <td><?=$v['tags']?></td>
                                    <td><img src="<?=base_url()?>uploads/app_page/<?=$v['filename']?>" width="200px" height="100px"/></td>
                                    <td><?=$v['remark']?></td>
                                    <td><a href="<?=base_url()?>home/myapp/ads_update?id=<?=$v['id']?>">修改</a></td>                              
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