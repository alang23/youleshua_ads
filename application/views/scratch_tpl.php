<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=640,target-densitydpi=device-dpi,user-scalable=no">
<meta content="telephone=no" name="format-detection" />
<title>路上诚品</title>
<link href="<?=base_url()?>static/lushang/css/main.css" rel="stylesheet">
<link href="<?=base_url()?>static/lushang/css/animate.css" rel="stylesheet">
<style>
  
    #card {
        height: 100%;
        font-weight: bold;
        font-size: 40px;
        line-height: 75px;
        text-align: center;
        background: #FAFAFA;
    }
    
    #scratch {
        width: 100%;
        height: 75px;
        /*margin: 50px auto 0;*/
        border: 1px solid #ccc;
    }
    </style>
    <link rel="stylesheet" href="<?=base_url()?>static/dist/lucky-card.css">
    <script src="<?=base_url()?>static/dist/lucky-card.min.js"></script>
</head>
<body>
<section>
       <div class="ind_top">刮  奖<a href="javascript:void(0);" onclick="history.back();" class="left"><img src="<?=base_url()?>static/lushang/images/back.png"></a></div>
       <div class="ind_login"><p><?=$info['phone']?> 您好</p></div>
       <div class="ind_gua">
            <!--<h2><?=$info['pro_name']?></h2>-->
             <h2><?=sub_str($info['pro_name'],24)?><img src="<?=base_url()?>static/lushang/images/gua_tit.png"></h2>
            <div class="tu_db"><?=winning_status($info['winning'])?></div>
            <?php
                if($info['display']=='0'){
            ?>
            <div class="tu_sm">
              
                <div id="scratch">
                    <div id="card"><?=winning_status($info['winning'])?></div>
                </div>
                
            </div>
            <?php
              }
            ?>
       </div>
       <div class="gua_cont">
            <div class="hdgz">
                 <p class="tit">兑奖规则</p>
                 <ul>
                 <li><span>1、</span>用户必须参与本店指定商品的营销活动，才可以参加抽奖活动，具体参见商品详情页。抽奖资格及中奖记录以本平台的记录为准。</li>
                 <li><span>2、</span>月底统一开奖，抽奖形式分为自助刮奖和系统开奖，中奖者获得对应的旅游线路参加资格，不可兑换现金。</li>
                 <li><span>3、</span>用户可以在指定的查询页面查询中奖信息，中奖获得旅游套餐的用户需要提前1个月联系本店家沟通确认旅游套餐消费人和消费时间等信息，1人1年内有效。非中奖者本人消费旅游套餐，须中奖者本人书面确认。
</li>
                 <li><span>4、</span>本店客服信息<br>电邮:lushangchengpin@roadsun.cc<br>QQ:2597168959</li>

                 </ul>
            </div>
       </div>
</section>
<script src="<?=base_url()?>static/lushang/js/jquery-1.10.2.min.js"></script>
<script src="<?=base_url()?>static/lushang/js/main.js"></script>
<script src="<?=base_url()?>static/layer/layer.js"></script>

    <script>
    LuckyCard.case({
        ratio: .7
    }, function() {
        //标记开奖
        
          var aj = $.ajax( {
              url:'<?=base_url()?>lucky/lotto_self',
              data:{
                  
                  id : '<?=$id?>',
                  
              },
              contentType:"application/x-www-form-urlencoded; charset=utf-8",
              type:'post',
              cache:false,
              dataType:'json',
              success:function(data){
               
               if(data.code == 0){

                 if(data.data == 1){
                    layer.msg('恭喜您中奖了!');
                 }
               }else{
                  alert(data.msg);
               }

              },
              error : function() {
                  alert("请求失败，请重试");
              }
          });
          
        this.clearCover();
    });
    </script>
</body>
</html>
