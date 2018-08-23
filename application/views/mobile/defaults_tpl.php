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
<!--             <div class="my-car-thumbnail"><img src="<?=base_url()?>static/mobile/img/banner-car.jpg" /></div>
 -->  
 <!--       <div class="car-title">
                <div class="car-logo"><span class="car-v">汉兰达 2015款 2.0T 四驱至尊版 7座</span></div>

            </div> -->
            <div class="grids-contant3" >
                <div class="grids-grid3">
                    <div class="grids-grid3-cont">
                        <div class="grids-grid-icon"><img src="<?=base_url()?>static/mobile/images/icon-png/message.png" alt=""></div>
                        <p class="grids-grid-label">短信数量</p>
                        <p class="grids-grid-num"><?=$message['num']?></p>
                    </div>
                </div>
                <div class="grids-grid3">
                    <div class="grids-grid3-cont">
                        <div class="grids-grid-icon"><img src="<?=base_url()?>static/mobile/images/icon-png/member.png" alt=""></div>
                        <p class="grids-grid-label">今日注册</p>
                        <p class="grids-grid-num">299</p>
                    </div>
                </div>
                <div class="grids-grid3">
                    <div class="grids-grid3-cont">
                        <div class="grids-grid-icon"><img src="<?=base_url()?>static/mobile/images/icon-png/kuaidi.png" alt=""></div>
                        <p class="grids-grid-label">确认邮寄</p>
                        <p class="grids-grid-num">188</p>
                    </div>
                </div>
            </div>
            <div class="devider b-line"></div>
            <div class="item-phone b-line">
                <p class="item-phone-sub">代理商数据</p>
        
            </div>
            <div class="news-detail">
                <?php
                    $all_total = 0;
                    foreach($agent_list_data as $alk => $alv){
                            $all_total += $alv['total'];
                ?>
                <a href="javascript:void(0);">
                    <h1 class="title"><?=$agent[$alv['channel_id']]['title']?></h1>
                    <div class="news-info b-line">
                        <span class="data"><i class="news-in-time"></i><?=date("Y-m-d")?></span>
                        <span class="publi"><?=$alv['total']?></span>
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
