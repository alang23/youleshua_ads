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
       <a href="https://h5.youzan.com/v2/feature/10qwlqr2j" class="pro_nav"><img src="<?=base_url()?>static/lushang/images/nav_3.png"></a>
       <div class="ind_top">选择具体商品<a href="###" class="left"><img src="<?=base_url()?>static/lushang/images/back.png"></a>
       <?php
          if(empty($userinfo)){
       ?>
       <a href="https://h5.youzan.com/v2/feature/1i2j1nf32" class="right">参与活动</a></div>
       <?php
          }else{


       ?>
       <a href="javascript:;" class="right"><?=$userinfo['phone']?>,您好!</a></div>

       <?php
          }
       ?>
       <div class="ind_login"></div>
       <ul class="date_nav">
            <li class="on" id="date_1">3月</li>
            <li id="date_2">4月</li>
            <li id="date_3">5月</li>
            <li id="date_4">6月</li>
            <li id="date_5">7月</li>
        </ul>

       <ul class="pro_list" id="pro_1">
       <?php
        if(isset($list['3'])){
          $list4 = $list['3'];
          foreach($list4 as $k4 => $v4){
       ?>
           <li><a href="<?=base_url()?>quan/index?id=<?=$v4['id']?>"><div class="pic"><img src="<?=base_url()?>uploads/activity/<?=$v4['pic']?>"><p class="pic_bt"><?=sub_str($v4['name'],24)?></p></div><h2><?=sub_str($v4['name'],24)?></h2>
               <div class="surplus"></div><font><span>第<?=$v4['rounds']?>轮</span>  

               <?php
                  if($v4['enabled'] == 0){
               ?>
               活动进行中
               <?php
                  }else{
               ?>
                售罄
               <?php
                }
               ?>
               </font></a></li>
      <?php
        }

      }
      ?>
       </ul>
        




       <ul class="pro_list" id="pro_2">
       <?php
        if(isset($list['4'])){
          $list5 = $list['4'];
          foreach($list5 as $k5 => $v5){
       ?>
           <li><a href="<?=base_url()?>results"><div class="pic"><img src="<?=base_url()?>uploads/activity/<?=$v5['pic']?>"><p class="pic_bt"><?=sub_str($v5['name'],24)?></p></div><h2><?=sub_str($v5['name'],24)?></h2>
               <div class="surplus"></div><font><span>第<?=$v5['rounds']?>轮</span>  

               <?php
                  if($v5['enabled'] == 0){
               ?>
               活动进行中
               <?php
                  }else{
               ?>
                售罄
               <?php
                }
               ?>
               </font></a></li>
      <?php
        }
      }
      ?>
           
       </ul>





       <ul class="pro_list" id="pro_3">
       <?php
      if(isset($list['5'])){
          $list6 = $list['5'];
          foreach($list6 as $k6 => $v6){
       ?>
           <li><a href="<?=base_url()?>quan/index?id=<?=$v6['id']?>"><div class="pic"><img src="<?=base_url()?>uploads/activity/<?=$v6['pic']?>"><p class="pic_bt"><?=sub_str($v6['name'],24)?></p></div><h2><?=sub_str($v6['name'],24)?></h2>
               <div class="surplus"></div><font><span>第<?=$v6['rounds']?>轮</span>  

               <?php
                  if($v6['enabled'] == 0){
               ?>
               活动进行中
               <?php
                  }else{
               ?>
                售罄
               <?php
                }
               ?>
               </font></a></li>
      <?php
        }
      }
      ?>
       </ul>

       <ul class="pro_list" id="pro_4">
       <?php
    if(isset($list['6'])){
          $list7= $list['6'];
          foreach($list7 as $k7 => $v7){
       ?>
           <li><a href="<?=base_url()?>results"><div class="pic"><img src="<?=base_url()?>uploads/activity/<?=$v7['pic']?>"><p class="pic_bt"><?=sub_str($v7['name'],24)?></p></div><h2><?=sub_str($v7['name'],24)?></h2>
               <div class="surplus"></div><font><span>第<?=$v7['rounds']?>轮</span>  
               <?php
                  if($v7['enabled'] == 0){
               ?>
               活动进行中
               <?php
                  }else{
               ?>
                售罄
               <?php
                }
               ?>
               </font></a></li>
      <?php
        }
      }
      ?>
           
       </ul>



       <ul class="pro_list" id="pro_5">
       <?php
        if(isset($list['7'])){
          $list8 = $list['7'];
          foreach($list8 as $k8 => $v8){
       ?>
           <li><a href="<?=base_url()?>results"><div class="pic"><img src="<?=base_url()?>uploads/activity/<?=$v8['pic']?>"><p class="pic_bt"><?=sub_str($v8['name'],24)?></p></div><h2><?=sub_str($v8['name'],24)?></h2>
               <div class="surplus"></div><font><span>第<?=$v8['rounds']?>轮</span>  
               <?php
                  if($v8['enabled'] == 0){
               ?>
               活动进行中
               <?php
                  }else{
               ?>
                售罄
               <?php
                }
               ?>
               </font></a></li>
      <?php
        }
      }
      ?>
       </ul>

</section>
<script src="<?=base_url()?>static/lushang/js/jquery-1.10.2.min.js"></script>
<script src="<?=base_url()?>static/lushang/js/main.js"></script>
</body>
</html>
