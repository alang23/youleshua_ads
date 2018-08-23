<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title>H+ 后台主题UI框架 - 首页示例二</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <?php
        $this->load->view('widgets/main_source_tpl');
    ?>

</head>

<body class="gray-bg">

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
                
        </div>
        <div class="col-sm-4">
            <div class="title-action">
                <button type="button" class="btn btn-w-sm btn-primary" onclick="location.reload();"><i class="fa fa-refresh"></i> 刷新</button>            
                </div>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <span class="label label-success pull-right">短信</span>
                        <h5>短信剩余数量</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?=$message['num']?></h1>
                        <div class="stat-percent font-bold text-success"> <i class="fa fa-bolt"></i>
                        </div>
                       
                    </div>
                </div>
            </div>



        </div>


        </div>
    </div>
            <?php
                if($userinfo['id'] == '4'){
            ?>
            <div class="col-sm-8">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5 style="color: red;">代理商流量</h5>
                                <div class="ibox-tools">
                               
                                </div>
                            </div>
                            <div class="ibox-content">
                                <table class="table table-hover no-margins">
                                    <thead>
                                        <tr>
                                            <th>名称</th>
                                            <th>日期</th>
                                            <th>注册量</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $all_total = 0;
                                        foreach($agent_list_data as $alk => $alv){
                                           $all_total += $alv['total'];
                                    ?>
                                        <tr>
                                            <td><?=$agent[$alv['channel_id']]['title']?></td>
                                            <td><i class="fa fa-clock-o"></i> <?=date("Y-m-d")?></td>
                                            <td><?=$alv['total']?></td>
                                        </tr>
                                    <?php
                                        }
                                    ?>
                                       
                                            <tr>
                                            <td style="color: red;">总量</td>
                                            <td></td>
                                            <td style="color: red;"><?=$all_total?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5 style="color: red;">广告注册统计</h5>
                                <div class="ibox-tools">
                               
                                </div>
                            </div>
                            <div class="ibox-content">
                                <table class="table table-hover no-margins">
                                    <thead>
                                        <tr>
                                            <th>广告名称</th>
                                            <th>注册数</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $ad_num = 0;
                                        foreach($ads as $adsk => $adsv){
                                            $ad_num += $adsv['total'];
                                    ?>
                                        <tr>
                                            <td>
                                                <?php
                                                    if(empty($adsv['ad_name'])){
                                                        echo '未知';
                                                    }else{
                                                        echo $adsv['ad_name'];
                                                    }
                                                ?>
                                            </td>
                                            <td style="font-size: 14px;"><?=$adsv['total']?></td>
                                        </tr>
                                    <?php
                                        }
                                    ?>
                                       
                                    <tr>
                                            <td style="color: red;">总量</td>
                                            <td></td>
                                            <td style="color: red;"><?=$all_total?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>
                    <div class="col-sm-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5 style="color: red;">短信</h5>
                                <div class="ibox-tools">
                               
                                </div>
                            </div>
                            <div class="ibox-content">
                                <table class="table table-hover no-margins">
                                    <thead>
                                        <tr>
                                            <th>代理</th>
                                            <th>数量</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        foreach($agent_msg as $amk => $amv){
                                    ?>
                                        <tr>
                                            <td><?=$agent[$amv['channel_id']]['title']?></td>
                                            <td style="font-size: 20px;"><span class="label label-primary"><?=$amv['total']?></span></td>
                                        </tr>
                                    <?php
                                        }
                                    ?>
                                       
                                  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5 style="color: red;">短信-客服</h5>
                                <div class="ibox-tools">
                               
                                </div>
                            </div>
                            <div class="ibox-content">
                                <table class="table table-hover no-margins">
                                    <thead>
                                        <tr>
                                            <th>账号</th>
                                            <th>总数量</th>
                                            <th>当日</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        foreach($users_msg as $umk => $umv){
                                    ?>
                                        <tr>
                                            <td><?=$users[$umv['user_id']]?></td>
                                            <td style="font-size: 14px;"><?=$umv['total']?></td>
                                            <td style="font-size: 14px;"><?=intval($user_day[$umv['user_id']])?></td>
                                        </tr>
                                    <?php
                                        }
                                    ?>
                                       
                                  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        <?php
            }
        ?>






    <?php

        $this->load->view('widgets/main_footer_tpl');
    ?>
</body>

</html>