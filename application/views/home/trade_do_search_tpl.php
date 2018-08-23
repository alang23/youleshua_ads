<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>机器交易查询</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <?php
        $this->load->view('widgets/main_source_tpl');
    ?>

</head>

<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-10">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>机器交易查询<span id="total_title"></span></h5>

                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-4 b-r">
                                <h3 class="m-t-none m-b">CBC</h3>
                                <form role="form">
                                    <div class="form-group">
                                        <input type="text" placeholder="请输入机器CBC码" id="dev_sn" class="form-control">
                                    </div>
                             
                                    <div>
                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="button" onclick="search();"><strong>查 询</strong>
                                        </button>
                                        
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-6" id="msg">
                                <h4></h4>
                                <p></p>
              
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <?php
        $this->load->view('widgets/source_footer_tpl');
    ?>
 <script type="text/javascript">
    function search()
    {
        var dev_sn = $("#dev_sn").val();

        if(dev_sn == ''){
          alert('请输入机器CBC码');
          return false;
        }


        var aj = $.ajax( {
              url:'<?=base_url()?>home/trade/do_search',
              data:{
                  
                  dev_sn : dev_sn

                  
              },
              contentType:"application/x-www-form-urlencoded; charset=utf-8",
              type:'post',
              cache:false,
              dataType:'json',
              success:function(data){
                              
               if(data.code == 0){
                  $("#msg").html(data.data.list); 
                  $("#total_title").html("<font color='red'>(总额:"+data.data.total+")</font>");
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