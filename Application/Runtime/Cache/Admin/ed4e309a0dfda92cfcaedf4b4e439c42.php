<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="UTF-8">
    <title>管理面板 —— Eshop</title>
    <link rel="stylesheet" type="text/css" href="/Public/Static/semantic/semantic/dist/semantic.min.css">
    <script type="text/javascript" src="/Public/Static/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/Static/semantic/semantic/dist/semantic.min.js"></script>
    <style>
    body {
        background-color: #FFFFFF;
    }
    
    .ui.menu .item img.logo {
        margin-right: 1.5em;
    }
    
    body > .grid.container {
        padding-top: 7em !important;
        min-height: 100%;
    }
    
    .wireframe {
        margin-top: 2em;
    }
    
    .ui.footer.segment {
        margin: 3em 0em 0em;
        padding: 2em 0em;
    }
    
    .three.wide.column.statistic {
        margin: 0;
    }
    
    .ui.icon.header {
        margin: 0;
    }
    
    .ui.horizontal.segments>.segment {
        flex: 1 1 100%;
    }
    
    .ui.horizontal.segments>.ui.statistic.segment {
        margin: 0;
    }

    .ui.horizontal.segments>.segment .ui.icon.header .content {
        padding: 0;
    }
    </style>
</head>

<body>
    <div class="ui fixed inverted menu">
        <div class="ui container">
            <a href="<?php echo U('Admin/dashboard/index');?>" class="header item">
                <img class="logo" src="/Public/Static/assets/images/logo.png">管理面板
            </a>
            <a href="<?php echo U('Admin/dashboard/index');?>" class="item">首页</a>
            <div class="ui simple dropdown item">
                商店管理 <i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item" href="<?php echo U('Admin/dashboard/itemCatalog');?>">商品概况</a>
                    <a class="item" href="<?php echo U('Admin/dashboard/itemList');?>">商品列表</a>
                    <div class="divider"></div>
                    <a class="item" href="<?php echo U('Admin/dashboard/orderList');?>">订单管理</a>
                </div>
            </div>
            <div class="ui simple dropdown item">
                用户管理 <i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item" href="<?php echo U('Admin/dashboard/userManage');?>">会员管理</a>
                    <div class="divider"></div>
                    <a class="item" href="<?php echo U('Admin/dashboard/adminManage');?>">管理员管理</a>
                </div>
            </div>
            <div class="right menu">
                <div class="ui simple dropdown item">
                    欢迎你，{data.adminName} <i class="dropdown icon"></i>
                    <div class="menu">
                        <a class="item" href="<?php echo U('Admin/dashboard/resetPassword');?>">更改密码</a>
                        <a class="item" href="<?php echo U('Admin/login/logout');?>">登出</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ui grid container">
        <div class="ui fourteen wide centered column">
            <div class="ui piled segments">
                <div class="ui segment">
                    <h1 class="ui header">欢迎你，Eshop管理员 {data.adminName}</h1>
                    <p>这是您第{data.adminCount}次登录本管理系统，您在本系统所拥有的权限等级为{data.adminSuperior}</p>
                    <h4>您所拥有的权限内容为：</h4>
                    <div class="ui horizontal segments">
                        <div class="ui center aligned segment" data-title="用户管理权限" data-content="拥有修改除了您和系统管理员之外所有用户的权限">
                            <h5 class="ui blue icon header">
                                <i class="users icon"></i>
                                <div class="content">
                                    用户管理
                                </div>
                                <div class="sub header">管理会员账号与限定的管理员账号</div>
                            </h5>
                        </div>
                        <div class="ui center aligned segment" data-title="商品管理权限" data-content="拥有修改任何商品信息的权限">
                            <h5 class="ui red icon header">
                                <i class="archive icon"></i>
                                <div class="content">
                                    商品管理
                                </div>
                                <div class="sub header">管理商店的商品</div>
                            </h5>
                        </div>
                        <div class="ui center aligned segment" data-title="订单管理权限" data-content="拥有修改任何订单的权限">
                            <h5 class="ui brown icon header">
                                <i class="shipping icon"></i>
                                <div class="content">
                                    订单管理
                                </div>
                                <div class="sub header">管理订单的状态</div>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="ui segment">
                    <h4>统计数据</h4>
                    <div class="ui horizontal segments">
                        <div class="ui mini statistic segment">
                            <div class="value">
                                22
                            </div>
                            <div class="label">
                                商品种类
                            </div>
                        </div>
                        <div class="ui mini statistic segment">
                            <div class="value">
                                22
                            </div>
                            <div class="label">
                                用户数量
                            </div>
                        </div>
                        <div class="ui mini statistic segment">
                            <div class="value">
                                22
                            </div>
                            <div class="label">
                                管理员数量
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="ui segment">
                    <h4>产品团队</h4>
                    <div class="ui stacked segments">
                        <p class="ui segment">本产品基于PHP开源框架Thinkphp搭建，页面采用Semantic UI渲染布局。</p>
                        <p class="ui segment">开发团队：刘昊程、徐添翼、刘丹杨、沈天辰</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ui inverted vertical footer segment">
        <div class="ui center aligned container">
            <div class="ui horizontal inverted small divided link list">
                <a class="item" href="#">Copyright &copy; Eshop.</a>
                <a class="item" href="http://www.liuhc.cn">Powered By Haocheng Liu</a>
            </div>
        </div>
    </div>
    <script>
    $('.ui.center.aligned.segment').popup({
        position: 'bottom center'
    });
    </script>
</body>

</html>