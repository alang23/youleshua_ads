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
                        <h5>交易数据:交易次数:  <font color="red"><?=$count?></font>,  总交易金额:<font color="red"><?=$amount?></font></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="table_basic.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                           <!--  <ul class="dropdown-menu dropdown-user">
                                <li><a href="table_basic.html#">选项1</a>
                                </li>
                                <li><a href="table_basic.html#">选项2</a>
                                </li>
                            </ul> -->
                           <!--  <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a> -->
                        </div>

                    </div>

                    <div class="ibox-content">
                    <!--     <div class="">
                            <a  href="<?=base_url()?>home/ads/add" class="btn btn-primary ">添加广告</a>
                        </div> -->
                        <form method="get" name="form" action="<?=base_url()?>home/trade/index_small?show_type=small">
                        <div class="row">

                            <div class="col-sm-4 m-b-xs">
                                     <input type="text" name="p_sn" id="p_sn"  class="input-sm form-control input-s-sm inline" placeholder="CBC码" value="<?=$p_sn?>">
                            </div>
                            <input type="hidden" name="show_type" value="<?=$show_type?>" />
                             <div class="col-sm-1">                              
                                        <button class="btn btn-sm btn-primary" type="submit"> 搜索</button>                                   
                            </div>
      
                            </form>


                        </div>
                        <div class="row">
                            <div class="col-sm-4 m-b-xs">
                                     <input type="text" name="remark" id="remark"  class="input-sm form-control input-s-sm inline" placeholder="备注" value="<?=$info['remark']?>">
                            </div>
                            <div class="col-sm-2 m-b-xs">
                                    
                                        <select name="status" id="status" class="input-sm form-control input-s-sm inline" >
                                            <option value="0" <?php if($info['status'] == '0'){ ?> selected <?php } ?> >待审核</option>
                                            <option value="1" <?php if($info['status'] == '1'){ ?> selected <?php } ?>>审核通过</option>
                                            <option value="2" <?php if($info['status'] == '2'){ ?> selected <?php } ?>>审核不通过</option>
                                            <option value="3" <?php if($info['status'] == '3'){ ?> selected <?php } ?>>已退还</option>
                                        </select>
                                  
                            </div>

                            <div class="col-sm-2">                              
                                        <button class="btn btn-sm btn-primary" type="button" onclick="change_status();"> 提交</button>                                   
                            </div>
                        </div>
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>流水号</th>
                                    <th>商户注册名</th>
                                    <th>交易日期</th>                                   
                                    <th>交易金额</th>
                                    <th>商户手续费</th>
                                    <th>借贷记标</th>
                                  
                                    <th>PSAM卡号</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($list as $k => $v){
                            ?>
                                <tr>
                                    <td><?=$v['id']?></td>
                                    <td><?=$v['order_sn']?></td>
                                    <td><?=$v['mer_name']?></td>
                                    <td><?=$v['trade_date']?></td>
                                    <td><?=$v['amount']?></td> 
                                    <td><?=$v['pay_fee']?></td> 
                                    <td><?=$v['pay_type']?></td> 
                                    <td><?=$v['p_sn']?></td>
                                   
                                    <td>
                                    <!-- <a href="<?=base_url()?>home/trade/detail?id=<?=$v['id']?>" >查看</a>| -->
                                   <!--  <a href="javascript:void(0);" onclick="flush('删除后不能恢复，确定删除吗','<?=base_url()?>home/trade/del?id=<?=$v['id']?>');">删除</a> -->
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
                
                            </tbody>
                             <tfoot>

                                <tr>
                                    <td colspan="14" class="footable-visible">
                                        <ul class="pagination pull-right">
                                   <!--          <li class="footable-page-arrow">
                                            <a data-page="first" href="#first">«</a></li>
                                            <li class="footable-page-arrow"><a data-page="prev" href="#prev">‹</a></li>
                                            <li class="footable-page active"><a data-page="0" href="#">1</a></li>
                                            <li class="footable-page"><a data-page="1" href="#">2</a></li>
                                            <li class="footable-page-arrow"><a data-page="next" href="#next">›</a></li>
                                            <li class="footable-page-arrow"><a data-page="last" href="#last">»</a></li> -->
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
    dateCell:"#start",
    format:"YYYY-MM-DD hh:mm:ss",
   // isinitVal:true,
    isTime:true, //isClear:false,
    minDate:"2014-09-19 00:00:00",
    //okfun:function(val){alert(val)}
  })
</script>    

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

function show_photo(id)
{
    layer.photos({
      photos: '#'+id
      ,anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
    }); 
}

function change_status()
{
        var id = "<?=$info['id']?>";
        var status = $("#status").val();
        var remark = $("#remark").val();

        var aj = $.ajax( {
              url:'<?=base_url()?>home/deal/edit_lakala',
              data:{
                  
                  id : id,
                  status : status,
                  remark : remark
                  
              },
              contentType:"application/x-www-form-urlencoded; charset=utf-8",
              type:'post',
              cache:false,
              dataType:'json',
              success:function(data){
                
               if(data.code == 0){
                    alert(data.msg);
                    window.location.reload();
                    

               }else{
                
                    alert(data.msg);

               }

              },
              error : function() {
                  alert("请求失败，请重试");
              }
          });
}

function alert_detail(url)
{
        //多窗口模式，层叠置顶
        layer.open({
          type: 2 //此处以iframe举例
          ,title: '申请详情'
          ,area: ['800px', '90%']
          ,shade: 0
          ,maxmin: true
          ,content: url
          ,btn: ['关闭'] //只是为了演示

          ,btn2: function(){
            layer.closeAll();
          }
          
          ,zIndex: layer.zIndex //重点1
          ,success: function(layero){
            layer.setTop(layero); //重点2
          }
        });
}

</script>
</body>

</html>