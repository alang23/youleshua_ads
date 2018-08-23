<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>力活科技</title>
    <link rel="stylesheet" href="<?=base_url()?>static/mobile/css/ui.css">

</head>

<body class="android" style="overflow:auto">
<div class="view-container" style="overflow:auto">

        <div class="aui-cell-input">
            <div class="aui-cell-inputs">
                <input type="text" placeholder="关键词...">
            </div>
        </div>
        <div class="devider b-line"></div>
        <div class="panel-content" style="padding-bottom:50px">
            <?php
                foreach($list as $k => $v){
            ?>
            <a class="panel-cont-finance item-ware-list" data-href="event-detail.html" target="navView" rel="service-level2">
                <div class="panel-cont-right">
                    <h2><font color="red">【<?=$v['ad_name']?>】</font><?=$v['address']?>/<?=$v['street']?></h2>
                    <h3><em><?=flw_status($v['status'])?></em><span><?=$v['phone']?></span></h3>
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
</body>
</html>
