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
                                    <th>用户</th>
                                
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($channel_user as $k => $v){
                            ?>
                                <tr>
                                    <td>
                            <input type="checkbox" name="channel_id" id="channel_id" value="<?=$v['channel_id']?>" <?php if(in_array($v['channel_id'],$ids)){ ?> checked <?php } ?>/>
                                    </td>
                                    <td><?=$v['title']?></td>                                
                                </tr>
                                <?php
                                    }
                                ?>
                                <tr>
                                    <td><button class="btn btn-primary" type="button" onclick="save_source_ad();">提交</button>
<button class="btn btn-defaults" type="button" onclick="history.back();">返回</button>
                                    </td>
                                    <td></td>
                                    <td></td>                                
                                </tr>
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
<script type="text/javascript">
    
    function save_source_ad()
    {
         var pos_id = '<?=$pos_id?>';
         var id_array=new Array();  
        $('input[name="channel_id"]:checked').each(function(){  
            id_array.push($(this).val());//向数组中添加元素  
        });  
        var idstr=id_array.join(',');//将数组元素连接起来以构建一个字符串  
        // alert(pos_id);
        // alert(idstr);
        // return false;
        var aj = $.ajax( {

              url:'<?=base_url()?>home/adsense/save_source',
              data:{
                  pos_id : pos_id,
                  channel_id : idstr
               
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