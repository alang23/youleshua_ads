<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=640,target-densitydpi=device-dpi,user-scalable=no">
<meta content="telephone=no" name="format-detection" />
<title>路上诚品</title>
<link href="<?=base_url()?>static/lushang/css/main.css" rel="stylesheet">
<link href="<?=base_url()?>static/lushang/css/animate.css" rel="stylesheet">

</head>
<body>
<section>
       <div class="ind_top">我的优惠券<a href="<?=base_url()?>products" class="left"><img src="<?=base_url()?>static/lushang/images/back.png"></a></div>
       <div class="ind_login"><p>您好，您总共有<?=count($q)?>张代金券</p></div>
       <div class="my_kk"></div>
       <?php
            foreach($q as $k => $v){
       ?>
       <div class="my_cark">
            <p class="date">有效期：<?=date("Y-m-d",$v['start_time'])?>至<?=date("Y-m-d",$v['end_time'])?></p>
            <p class="dd"> <?=$v['order_no']?></p>
       </div>
       <?php
            }
       ?>
   
      <div class="cark_btn">
            <a href="<?=base_url()?>lucky/index?id=<?=$id?>" class="left">刮奖</a>
            <a href="<?=base_url()?>/quan/index?id=<?=$id?>" class="right">我的优惠券</a>
       </div>
</section>
<script src="<?=base_url()?>static/lushang/js/jquery-1.10.2.min.js"></script>
<script src="<?=base_url()?>static/lushang/js/main.js"></script>
</body>
</html>
