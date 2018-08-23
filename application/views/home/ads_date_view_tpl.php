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
                        <h5>广告名称: <font color="red"><?=$ad_name?></font></h5>


                    </div>

                    <div class="ibox-content">
                     
                        <div class="row">

                            <div class="col-sm-3">
                            <form action="<?=base_url()?>home/ads/ads_date_view/index" method='get'>
                                <div class="input-group">     
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary" onclick="history.back();"> 返回</button> 
                                        <button type="button" class="btn btn-w-sm btn-white" onclick="location.reload();"><i class="fa fa-refresh"></i> 刷新</button> 
                                        </span>
                                    <font color="red">(点击/注册)</font>
                                </div>
                             </form>
                            </div>
                        </div>

                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                   <!--  <th>广告名称</th> -->
                                    <th>日期</th>
                                    <th>01时</th>
                                    <th>02时</th>
                                    <th>03时</th>
                                    <th>04时</th>
                                    <th>05时</th>
                                    <th>06时</th>
                                    <th>07时</th>
                                    <th>08时</th>
                                    <th>09时</th>
                                    <th>10时</th>
                                    <th>11时</th>
                                    <th>12时</th>
                                    <th>13时</th>
                                    <th>14时</th>
                                    <th>15时</th>
                                    <th>16时</th>
                                    <th>17时</th>
                                    <th>18时</th>
                                    <th>19时</th>
                                    <th>20时</th>
                                    <th>21时</th>
                                    <th>22时</th>
                                    <th>23时</th>
                                    <th>00时</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($list as $k => $v){
                            ?>
                                <tr>
                                    <td><?=$v['id']?></td>
                                    <!-- <td><?=$v['ad_name']?></td> -->
                                    <td><?=$v['dates']?></td>
                                    <td><?=$v['h_01']?>/<?=$v['r_01']?></td>
                                    <td><?=$v['h_02']?>/<?=$v['r_02']?></td>
                                    <td><?=$v['h_03']?>/<?=$v['r_03']?></td>
                                    <td><?=$v['h_04']?>/<?=$v['r_04']?></td>
                                    <td><?=$v['h_05']?>/<?=$v['r_05']?></td>
                                    <td><?=$v['h_06']?>/<?=$v['r_06']?></td>
                                    <td><?=$v['h_07']?>/<?=$v['r_07']?></td>
                                    <td><?=$v['h_08']?>/<?=$v['r_08']?></td>
                                    <td><?=$v['h_09']?>/<?=$v['r_09']?></td>
                                    <td><?=$v['h_10']?>/<?=$v['r_10']?></td>
                                    <td><?=$v['h_11']?>/<?=$v['r_11']?></td>
                                    <td><?=$v['h_12']?>/<?=$v['r_12']?></td>
                                    <td><?=$v['h_13']?>/<?=$v['r_13']?></td>
                                    <td><?=$v['h_14']?>/<?=$v['r_14']?></td>
                                    <td><?=$v['h_15']?>/<?=$v['r_15']?></td>
                                    <td><?=$v['h_16']?>/<?=$v['r_16']?></td>
                                    <td><?=$v['h_17']?>/<?=$v['r_17']?></td>
                                    <td><?=$v['h_18']?>/<?=$v['r_18']?></td>
                                    <td><?=$v['h_19']?>/<?=$v['r_19']?></td>
                                    <td><?=$v['h_20']?>/<?=$v['r_20']?></td>
                                    <td><?=$v['h_21']?>/<?=$v['r_21']?></td>
                                    <td><?=$v['h_22']?>/<?=$v['r_22']?></td>
                                    <td><?=$v['h_23']?>/<?=$v['r_23']?></td>
                                    <td><?=$v['h_00']?>/<?=$v['r_00']?></td>
                                   
                                </tr>

                          
                            
                                <?php
                                    }
                                ?>
                
                            </tbody>
                             <tfoot>

                                <tr>
                                    <td colspan="30" class="footable-visible">
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