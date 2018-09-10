<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>优乐刷 - 主页</title>

    <meta name="keywords" content="优乐刷">
    <meta name="description" content="优乐刷">

    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <?php
        $this->load->view('widgets/source_tpl');
    ?>

</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <div id="wrapper">
        <!--左侧导航开始-->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="nav-close"><i class="fa fa-times-circle"></i>
            </div>
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                              <span style="font-size: 20px;">力活科技<!-- <img alt="image" class="img-circle" src="<?=base_url()?>static/ylsadmin/img/profile_small.jpg" /> --></span>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                  
                                <li class="divider"></li>
                                <li><a href="<?=base_url()?>home/login/logout">安全退出</a>
                                </li>
                            </ul>
                        </div>
                        <div class="logo-element">优乐富
                        </div>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-home"></i>
                            <span class="nav-label">主页</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                           <li>
                                <a class="J_menuItem" href="<?=base_url()?>home/main/index" data-index="0">主页</a>
                            </li>
                  
                        </ul>
                    </li>


                    <?php 
                            if(!empty(in_array('adsense_manager', $list))){
                    ?>
                    <li>
                        <a href="#">
                            <i class="fa fa fa-bar-chart-o"></i>
                            <span class="nav-label">广告管理</span>
                            <span class="fa arrow"></span>
                        </a>
                       
                        <ul class="nav nav-second-level">
                        <?php 
                            if(!empty(in_array('adsense_magr', $list))){
                        ?>
                  
                            <li>
                                <a class="J_menuItem" href="<?=base_url()?>home/adsense/index">广告位管理</a>
                            </li>

                        <?php } ?>

                        <?php
                            if(!empty(in_array('ads_magr', $list))){
                        ?>
                            <li>
                                <a class="J_menuItem" href="<?=base_url()?>home/ads/index">广告管理</a>
                            </li>

                            <li>
                                <a class="J_menuItem" href="<?=base_url()?>home/ads/ads_date">报告</a>
                            </li>
                        <?php } ?>

                        </ul>
                       
                    </li>
                    <?php } ?>

                    <?php 
                            if(!empty(in_array('business_manager', $list))){
                    ?>
                    <li>
                        <a href="mailbox.html">
                        <i class="fa fa-delicious"></i> 
                        <span class="nav-label">申请管理 </span>
                        <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                        <?php 
                            if(!empty(in_array('search_business', $list))){
                        ?>
                            <li><a class="J_menuItem" href="<?=base_url()?>home/business/index">申请列表</a>
                            </li>
                            <li><a class="J_menuItem" href="<?=base_url()?>home/business/shoukuanhe">申请列表(盒子)</a>
                            </li>
                            <li><a class="J_menuItem" href="<?=base_url()?>home/track/index">短信跟踪</a>
                            </li>
                            <li><a class="J_menuItem" href="<?=base_url()?>home/kuaishua/index">申请列表(快刷)</a>
                            </li>
                        <?php } ?>

                        <?php 
                            if(!empty(in_array('send_msg', $list))){
                        ?>
                           <li><a class="J_menuItem" href="<?=base_url()?>home/message/index">短信发送</a>
                           </li>
                        <?php } ?>
                        <li><a class="J_menuItem" href="<?=base_url()?>home/deal/index">拉卡拉退款申请</a>
                           </li>

                            <li><a class="J_menuItem" href="<?=base_url()?>home/trade/index">交易数据</a>
                            </li>
                            <li><a class="J_menuItem" href="<?=base_url()?>home/trade/shaixuan">交易金额</a>
                            </li>
                              <li><a class="J_menuItem" href="<?=base_url()?>home/trade/do_search">交易查询</a>
                            </li>
                            <?php
                                if(in_array('trade_fenxi',$list)){
                            ?>
                            <li><a class="J_menuItem" href="<?=base_url()?>home/trade/fenxi">交易分析</a>
                            </li>
                            <?php
                                }
                            ?>
                            <li><a class="J_menuItem" href="<?=base_url()?>home/standard/index">机具达标情况</a>
                            </li>
                             <li><a class="J_menuItem" href="<?=base_url()?>home/standard/do_search">机具达标查询</a>
                            </li>
                            <li><a class="J_menuItem" href="<?=base_url()?>home/machines/search_machines">机器查询(电销)</a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>

                    <?php 
                            if(!empty(in_array('flw_manager', $list))){
                    ?>
                     <li>
                        <a href="mailbox.html">
                        <i class="fa fa-qq"></i> 
                        <span class="nav-label">电销跟进</span>
                        <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                        <?php 
                            if(!empty(in_array('search_flw', $list))){
                        ?>
                            <li><a class="J_menuItem" href="<?=base_url()?>home/business/flw_index?type=cu_sever">申请列表</a>
                            </li>
                            <li><a class="J_menuItem" href="<?=base_url()?>home/kuaishua/flw_index?type=cu_sever">申请列表(快刷)</a>
                            </li>
                        <?php } ?>

                        <?php 
                            if(!empty(in_array('complete_msg', $list))){
                        ?>
                            <li><a class="J_menuItem" href="<?=base_url()?>home/business/after_index?type=cu_sever">资料补全</a>
                            </li>
                        <?php
                            }
                        ?>
                        <?php 
                            if(!empty(in_array('send_msg', $list))){
                        ?>
                           <li><a class="J_menuItem" href="<?=base_url()?>home/message/index">短信发送</a>
                           </li>
                        <?php } ?>

                        <?php 
                            if(in_array('search_logistics_users', $list)){
                        ?>
                            <li><a class="J_menuItem" href="<?=base_url()?>home/Logistics/index_users">物流列表(电销)</a>
                            </li>
                            <li><a class="J_menuItem" href="<?=base_url()?>home/Logistics/imports_test">物流导入检验(电销)</a>
                            </li>
                            <li><a class="J_menuItem" href="<?=base_url()?>home/machines/search_machines">机器查询(电销)</a>
                            </li>
                        <?php } ?>
                        
                        <?php 
                            if(!empty(in_array('standard_list', $list))){
                        ?>
                            <li><a class="J_menuItem" href="<?=base_url()?>home/standard/index">机具达标情况</a>
                            </li>
                         <?php } ?>
                        <?php 
                            if(!empty(in_array('trade_list', $list))){
                        ?>
                            <li><a class="J_menuItem" href="<?=base_url()?>home/trade/index">交易数据</a>
                            </li>
                         <?php } ?>
                         
                         <li><a class="J_menuItem" href="<?=base_url()?>home/trade/do_search">交易查询</a>
                            </li>
                        <?php 
                            if(!empty(in_array('standard_do_search', $list))){
                        ?>
                            <li><a class="J_menuItem" href="<?=base_url()?>home/standard/do_search">机具达标查询</a>
                            </li>
                         <?php } ?>

                        </ul>
                    </li>
                    <?php } ?>

                     <?php 
                            if(!empty(in_array('logistics_manager', $list))){
                    ?>
                    <li>
                        <a href="javascript:void(0);">
                        <i class="fa fa-truck"></i> 
                        <span class="nav-label">物流管理</span>
                        <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                        <?php 
                            if(!empty(in_array('search_logistics', $list))){
                        ?>
                            <li><a class="J_menuItem" href="<?=base_url()?>home/Logistics/index">物流列表(拉卡拉)</a>
                            </li>
                            <li><a class="J_menuItem" href="<?=base_url()?>home/Logistics/index_ks">物流列表(快刷)</a>
                            </li>
                        <?php } ?>




                     
                        </ul>
                    </li>
                    <?php }?>

                    <li>
                        <a href="javascript:void(0);">
                        <i class="fa fa-database"></i> 
                        <span class="nav-label">运营数据</span>
                        <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                        <?php 
                            if(in_array('xiaoer_admin', $list)){
                        ?>
                            <li><a class="J_menuItem" href="<?=base_url()?>home/trade/shaixuan">小额刷卡</a>
                            </li>
                        <?php } ?>

                        <?php 
                            if(in_array('xiaoer_user', $list)){
                        ?>
                            <li><a class="J_menuItem" href="<?=base_url()?>home/trade/shaixuan_user">小额刷卡</a>
                            </li>   
                        <?php } ?>                             
                        </ul>
                    </li>
                  

                    <?php 
                        if(!empty(in_array('setting_manager', $list))){
                    ?>
                    <li>
                        <a href="#"><i class="fa fa-cutlery"></i> <span class="nav-label">APP管理 </span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a class="J_menuItem" href="<?=base_url()?>home/myapp/ads">广告页面管理</a>
                            </li>
                            <li><a class="J_menuItem" href="<?=base_url()?>home/myapp/mynav">导航管理</a>
                            </li>
                           
                        </ul>
                    </li>


                    <li>
                        <a href="#">
                        <i class="fa fa-male"></i> 
                        <span class="nav-label">代理商管理 </span>
                        <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                   
                        <?php 
                            if(!empty(in_array('user_add', $list))){
                        ?>
                            <li><a class="J_menuItem" href="<?=base_url()?>home/agentdata/index">代理商数据</a>
                            </li>
                             <li><a class="J_menuItem" href="<?=base_url()?>home/channel/index?types=1">渠道账号(资源)</a>
                            </li>
                            <li><a class="J_menuItem" href="<?=base_url()?>home/channel/index?types=2">渠道账号(广告)</a>
                            </li>
                        <?php } ?>
  
                        </ul>
                    </li>


                    <li>
                        <a href="#">
                        <i class="fa fa-cutlery"></i> 
                        <span class="nav-label">系统设置 </span>
                        <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                        <?php 
                            if(!empty(in_array('user_add', $list))){
                        ?>
                             <li><a class="J_menuItem" href="<?=base_url()?>home/user/add">添加账号</a>
                            </li>
                        <?php } ?>
     
                        <?php 
                            if(!empty(in_array('user_list', $list))){
                        ?>
                            <li><a class="J_menuItem" href="<?=base_url()?>home/user/index">账号列表</a>
                            </li>
                        <?php } ?>

                        <?php 
                            if(!empty(in_array('role_add', $list))){
                        ?>
                             <li><a class="J_menuItem" href="<?=base_url()?>home/role/add">添加角色</a>
                            </li>
                        <?php } ?>

                        <?php 
                            if(!empty(in_array('role_list', $list))){
                        ?>
                            <li><a class="J_menuItem" href="<?=base_url()?>home/role/index">角色列表</a>
                            </li>
                            <li><a class="J_menuItem" href="<?=base_url()?>home/machines/index">机器数据</a>
                            </li>
                        <?php } ?>

                        <?php 
                            if(!empty(in_array('edit_pwd', $list))){
                        ?>
                            <li><a class="J_menuItem" href="<?=base_url()?>home/setting/changepawd">密码修改</a>
                            </li>
                        <?php }?>
                        </ul>
                    </li>
                    <?php }?>
<!--                      <li>
                        <a href="#"><i class="fa fa-cutlery"></i> <span class="nav-label">权限设置 </span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a class="J_menuItem" href="<?=base_url()?>home/user/add">添加账号</a>
                            </li>
                            <li><a class="J_menuItem" href="<?=base_url()?>home/user/index">账号列表</a>
                            </li>
                             <li><a class="J_menuItem" href="<?=base_url()?>home/role/add">添加角色</a>
                            </li>
                            <li><a class="J_menuItem" href="<?=base_url()?>home/role/index">角色列表</a>
                            </li>
                        </ul>
                    </li> -->

                </ul>
            </div>
        </nav>
        <!--左侧导航结束-->
        <!--右侧部分开始-->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                        <form role="search" class="navbar-form-custom" method="post" action="search_results.html">
                            <div class="form-group">
                                <input type="text" placeholder="请输入您需要查找的内容 …" class="form-control" name="top-search" id="top-search">
                            </div>
                        </form>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                                     
                        <li class="hidden-xs">
                            <a  class="J_menuItem"  style="color: red"> <?=$userinfo['username']?>(<?=$userinfo['realname']?>)</a>
                        </li>
                     
                    </ul>

                </nav>
            </div>
            <div class="row content-tabs">
                <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
                </button>
                <nav class="page-tabs J_menuTabs">
                    <div class="page-tabs-content">
                        <a href="javascript:;" class="active J_menuTab" data-id="index_v1.html">首页</a>
                    </div>
                </nav>
                <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
                </button>
                <div class="btn-group roll-nav roll-right">
                    <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span>

                    </button>
                    <ul role="menu" class="dropdown-menu dropdown-menu-right">
                        <li class="J_tabShowActive"><a>定位当前选项卡</a>
                        </li>
                        <li class="divider"></li>
                        <li class="J_tabCloseAll"><a>关闭全部选项卡</a>
                        </li>
                        <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
                        </li>
                    </ul>
                </div>
                <a href="<?=base_url()?>home/login/logout" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a>
            </div>
            <div class="row J_mainContent" id="content-main">
                <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="<?=base_url()?>home/main" frameborder="0" data-id="main" seamless></iframe>
            </div>
            <div class="footer">
                <div class="pull-right">&copy; 2014-2015 <a href="http://app.1chuanqi.com/" target="_blank">优乐富</a>
                </div>
            </div>
        </div>
        <!--右侧部分结束-->

        <!--mini聊天窗口开始-->


    </div>

    <?php
        $this->load->view('widgets/source_footer_tpl');
    ?>
</body>

</html>