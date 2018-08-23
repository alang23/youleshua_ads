<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>汽车秀</title>
    <link rel="stylesheet" href="<?=base_url()?>static/mobile/css/ui.css">
</head>
<body>

<div class="news-detail">

    <?php
        foreach($list as $k => $v){
    ?>
    <a href="news-detail.html">
        <h1 class="title"><?=$v['title']?></h1>
        <div class="news-info b-line">
            <span class="data"><i class="news-in-time"></i>2016-12-15</span>
            <!--<span class="publi">来源：汽车之家</span>-->
        </div>
    </a>
    <?php
        }
    ?>

</div>
<?php
    $this->load->view('widgets/mobile_nav_tpl');
?>
</body>
</html>