<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>汽车秀</title>
    <link rel="stylesheet" href="<?=base_url()?>static/mobile/css/ui.css">

</head>
<body>


<body class="android" style="overflow:auto">
<div class="view-container" style="overflow:auto">

        <div class="aui-cell-input">
            
                代理商
            
        </div>
        <div class="devider b-line"></div>
        <div class="panel-content" style="padding-bottom:50px">
            <?php
                foreach($list as $k => $v){
            ?>
            <a class="panel-cont-finance item-ware-list" data-href="event-detail.html" target="navView" rel="service-level2" onclick="do_edit();">
                <div class="panel-cont-right">
                    <h2><?=$v['title']?></h2>
                    <h3><em><?=$v['username']?></em><span><?=$v['channel_id']?></span><span>状态:【<?=work_type($v['status'])?>】</span></h3>
                </div>
                <div class="address-right address-ad">
                   
                        <?php
                            if($v['status'] == '0'){
                        ?>
                            <p>打开</p>
                        <?php
                            }else{
                        ?>
                            <p>关闭</p>
                        <?php
                            }
                        ?>
                                    
                </div>
            </a>
            <?php
                }
            ?>

        </div>


    </div>

<?php
    $this->load->view('widgets/mobile_nav_tpl');
?>
<script type="text/javascript">
    
    function do_edit()
    {
        alert('ok');
    }
</script>
</body>
</html>