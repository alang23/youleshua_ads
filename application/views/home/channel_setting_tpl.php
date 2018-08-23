<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--360浏览器优先以webkit内核解析-->
    

    <title>H+ 后台主题UI框架 - 搜索建议</title>

    <link rel="shortcut icon" href="favicon.ico"> <link href="css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <?php
        $this->load->view('widgets/main_source_tpl');
    ?>

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content">

        <div class="row">
            <div class="col-sm-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>流量分发 </h5>
                    
                    </div>
                    <div class="ibox-content">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>广告位</th>
                                
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($adsense as $k => $v){
                            ?>
                                <tr>
                                    <td><input type="checkbox" name="pos_id" id="pos_id" value=<?=$v['id']?> <?php if(in_array($v['id'], $ad_source_id)){ ?> checked  <?php } ?>/></td>
                                    <td><?=$v['id']?></td>
                                    <td><?=$v['title']?></td>                                
                                </tr>
                                <?php
                                    }
                                ?>
                                <tr>
                                    <td><button class="btn btn-primary" type="button" onclick="save_source_ad();">提交</button></td>
                                    <td></td>
                                    <td></td>                                
                                </tr>
                            </tbody>
                        </table>
      
                    </div>

                </div>


                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>流量分发 </h5>
                    
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal m-t" id="commentForm" method="post" action="<?=base_url()?>home/channel/save_ads?">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">展示网址:</label>
                                <div class="col-sm-8">
                                <input id="show_url" name="show_url" value="<?=$info['show_url']?>"  class="form-control" required="" type='text'  aria-required="true" placeholder="展示网址" />
                                </div>
                            </div>                                         

                            <div class="form-group">
                                <label class="col-sm-3 control-label">每日流量:</label>
                                <div class="col-sm-8">
                                <input id="amount" name="amount" value="<?=$info['amount']?>"  class="form-control" required="" type='text'  aria-required="true" placeholder="总流量" />
                                </div>
                            </div> 
                            <div class="form-group">
                                <label class="col-sm-3 control-label">目前注册量:</label>
                                <div class="col-sm-8">
                                <input id="count_num" name="count_num" value="<?=$bus_count?>"   class="form-control" required="" type='text'  aria-required="true" placeholder="目前注册量" readonly="true" />
                                </div>
                            </div> 

                            <div class="form-group">
                                <label class="col-sm-3 control-label">总量:</label>
                                <div class="col-sm-8">
                                <input id="total" name="total" value="<?=$info['total']?>"   class="form-control" required="" type='text'  aria-required="true" placeholder="总量"  />
                                </div>
                            </div> 
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-3">
                                    <button class="btn btn-primary" type="button" onclick="save_source_count();">提交</button>
                                    <button class="btn btn-white" type="button" onclick="window.location='<?=base_url()?>home/channel/index?types=<?=$info['types']?>'">返回</button>
                                </div>
                            </div>
                        </form>
      
                    </div>

                </div>


            </div>


            <div class="col-sm-6">

                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>短信配置</h5>
                   
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal m-t" id="commentForm" method="post" action="<?=base_url()?>home/ads/add">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">短信签名：</label>
                                <div class="col-sm-8">
                                    <input id="qianming" name="qianming" minlength="2" type="text" class="form-control" required="" aria-required="true" value="<?=$msg['qianming']?>" />
                                </div>
                            </div>
                  
                            <div class="form-group">
                                <label class="col-sm-3 control-label">拨打钱预热短信：</label>
                                <div class="col-sm-8">
                                    <textarea id="msg_1" name="msg_1"  class="form-control"><?=$msg['msg_1']?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">未接通短信：</label>
                                <div class="col-sm-8">
                                    <textarea id="msg_2" name="msg_2" class="form-control"><?=$msg['msg_2']?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">无需求、不愿付费、费率高等未达成：</label>
                                <div class="col-sm-8">
                                    <textarea id="msg_3" name="msg_3" class="form-control"><?=$msg['msg_3']?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">确认邮寄短信：</label>
                                <div class="col-sm-8">
                                    <textarea id="msg_4" name="msg_4" class="form-control"><?=$msg['msg_4']?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">签收后短信催激活短信：</label>
                                <div class="col-sm-8">
                                    <textarea id="msg_5" name="msg_5" class="form-control"><?=$msg['msg_5']?></textarea>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-3">
                                    <button class="btn btn-primary" type="button" onclick="save_msg();">提交</button>
                                   

                                </div>
                            </div>
                       
                        <div class="clearfix"></div>
                        </form>
                    </div>
                </div>

<!-- 
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>代理二维码</h5>
                   
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal m-t" id="commentForm" method="post" action="<?=base_url()?>home/ads/add">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">选择：</label>
                                <div class="col-sm-8">
                                    <input id="qianming" name="qianming" minlength="2" type="text" class="form-control" required="" aria-required="true" value="<?=$msg['qianming']?>" />
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-3">
                                    <button class="btn btn-primary" type="button" onclick="save_msg();">提交</button>
                                   

                                </div>
                            </div>
                       
                        <div class="clearfix"></div>
                        </form>
                    </div>
                </div> -->



            </div>


        </div>
    </div>
    
    <?php

        $this->load->view('widgets/main_footer_tpl');
    ?>
<script type="text/javascript">
    
    function save_source_ad()
    {
         var channel_id = '<?=$info['channel_id']?>';
         var id_array=new Array();  
        $('input[name="pos_id"]:checked').each(function(){  
            id_array.push($(this).val());//向数组中添加元素  
        });  
        var idstr=id_array.join(',');//将数组元素连接起来以构建一个字符串  
        var aj = $.ajax( {

              url:'<?=base_url()?>home/channel/save_source',
              data:{
                  channel_id : channel_id,
                  ids : idstr
               
              },
              contentType:"application/x-www-form-urlencoded; charset=utf-8",
              type:'post',
              cache:false,
              dataType:'json',
              success:function(data){
                
                //alert(data.code);
               if(data.code == 0){
                    alert(data.msg);
               }else{
                
                    alert(data.msg);

               }

              },
              error : function() {
                  alert("请求失败，请重试");
              }
          });
    
    }

    function save_source_count()
    {
         var amount = $("#amount").val();
         var id = '<?=$info['id']?>'; 
         var show_url = $("#show_url").val(); 
         var total = $("#total").val(); 
       
        var aj = $.ajax( {

              url:'<?=base_url()?>home/channel/save_source_count',
              data:{
                  amount : amount,
                  id : id,
                  show_url : show_url,
                  total : total
               
              },
              contentType:"application/x-www-form-urlencoded; charset=utf-8",
              type:'post',
              cache:false,
              dataType:'json',
              success:function(data){
                
                //alert(data.code);
               if(data.code == 0){
                    alert(data.msg);
               }else{
                
                    alert(data.msg);

               }

              },
              error : function() {
                  alert("请求失败，请重试");
              }
          });
    
    }

    function save_msg()
    {

        var channel_id = '<?=$info['channel_id']?>';
        var msg_1 = $("#msg_1").val();
        var msg_2 = $("#msg_2").val();
        var msg_3 = $("#msg_3").val();
        var msg_4 = $("#msg_4").val();
        var msg_5 = $("#msg_5").val();
        var qianming = $("#qianming").val();

        var aj = $.ajax( {

              url:'<?=base_url()?>home/channel/save_msg',
              data:{
                  
                  msg_1 : msg_1,
                  msg_2 : msg_2,
                  msg_3 : msg_3,
                  msg_4 : msg_4,
                  msg_5 : msg_5,
                  channel_id : channel_id,
                  qianming : qianming
                  
              },
              contentType:"application/x-www-form-urlencoded; charset=utf-8",
              type:'post',
              cache:false,
              dataType:'json',
              success:function(data){
                
                //alert(data.code);
               if(data.code == 0){
                    alert(data.msg);
               }else{
                
                    alert(data.msg);

               }

              },
              error : function() {
                  alert("请求失败，请重试");
              }
          });


    }
</script>
</body>

</html>