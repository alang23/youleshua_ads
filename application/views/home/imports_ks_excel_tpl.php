 <!DOCTYPE html>
<html>



<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>导入excel</title>
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
                    </div>
                    <div class="ibox-content">
                    <form action="<?=base_url()?>home/logistics/imports_ks" method="post" enctype="multipart/form-data">
                      <div class="row">


                            <div class="col-sm-3">                           
                                <div class="input-group">
                                    <input type="file" class="form-control" style="height: 35px;" name="excel"> <span class="input-group-btn"> <input type="submit" value="导入Excel" class="btn btn-primary"></span>
                               </div>                            
                            </div>

                            <div class="col-sm-3">                           
                                <div class="input-group">
                                    <select name="express" id="express" class="input-sm form-control">
                                        <option value="0">物流</option>
                                        <option value="ZTO">中通</option>
                                        <option value="SF">顺丰</option>
                                    </select>                                                    
                               </div>                                                                                  
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