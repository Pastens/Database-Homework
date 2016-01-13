<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="UTF-8">
    <title>更改密码 —— Eshop</title>
    <link rel="stylesheet" type="text/css" href="/Public/Static/semantic/semantic/dist/semantic.min.css">
    <script type="text/javascript" src="/Public/Static/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/Static/jquery.tablesort.js"></script>
    <script type="text/javascript" src="/Public/Static/semantic/semantic/dist/semantic.min.js"></script>
    <style>
    body {
        background-color: #FFFFFF;
    }
    
    .ui.menu .item img.logo {
        margin-right: 1.5em;
    }
    
    .wireframe {
        margin-top: 2em;
    }
    
    body > .ui.grid.container {
        padding-top: 100px !important;
        padding-bottom: 100px !important;
    }
    
    .ui.footer.segment {
        position: fixed;
        bottom: 0;
        width: 100%;
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
    
    tr {
        white-space: nowrap;
    }
    
    .ui.animated.fade.green.button {
        margin: 100px;
    }
    .ui.center.aligned.grid{
        margin: 10px;
    }

    </style>
</head>

<body>
    <div class="ui fixed inverted menu">
        <div class="ui container">
            <a href="<?php echo U('Admin/dashboard/index');?>" class="header item">
                <img class="logo" src="/Public/Static/assets/images/logo.png">管理面板
            </a>
            <a href="<?php echo U('Admin/dashboard/index');?>" class="item">面板首页</a>
            <?php switch($data["adminSuperior"]): case "0": case "1": ?><div class="ui simple dropdown item">
                        商店管理 <i class="dropdown icon"></i>
                        <div class="menu">
                            <a class="item" href="<?php echo U('Admin/dashboard/itemCatalog');?>">商品概况</a>
                            <a class="item" href="<?php echo U('Admin/dashboard/shopList');?>">店铺管理</a>
                            <a class="item" href="<?php echo U('Admin/dashboard/itemList');?>">商品管理</a>
                            <div class="divider"></div>
                            <a class="item" href="<?php echo U('Admin/dashboard/orderList');?>">订单管理</a>
                        </div>
                    </div>
                    <div class="ui simple dropdown item">用户管理 <i class="dropdown icon"></i>
                        <div class="menu"><a class="item" href="<?php echo U('Admin/dashboard/userManage');?>">会员管理</a><a class="item" href="<?php echo U('Admin/dashboard/adminManage');?>">管理员管理</a></div>
                    </div>
                    <div class="ui simple dropdown item">
                        系统管理 <i class="dropdown icon"></i>
                        <div class="menu">
                            <a class="item" href="<?php echo U('Admin/dashboard/systemLog');?>">系统日志</a>
                            <div class="divider"></div>
                            <a class="item" href="<?php echo U('Admin/dashboard/apiList');?>">API列表</a>
                            <a class="item" href="<?php echo U('Admin/dashboard/devDocument');?>">开发文档</a>
                        </div>
                    </div>
                    <div class="right menu">
                        <div class="ui simple dropdown item">
                            欢迎你，<?php echo ($data["adminName"]); ?> <i class="dropdown icon"></i>
                            <div class="menu">
                                <a class="item" href="<?php echo U('Admin/dashboard/adminInfo');?>">更改资料</a>
                                <a class="item" href="<?php echo U('Admin/dashboard/resetPassword');?>">更改密码</a>
                                <a class="item" href="<?php echo U('Admin/login/logout');?>">登出</a>
                            </div>
                        </div>
                    </div><?php break;?>
                <?php case "2": ?><div class="ui simple dropdown item">
                        商店管理 <i class="dropdown icon"></i>
                        <div class="menu">
                            <a class="item" href="<?php echo U('Admin/dashboard/itemCatalog');?>">商品概况</a>
                            <a class="item" href="<?php echo U('Admin/dashboard/shopList');?>">店铺管理</a>
                            <a class="item" href="<?php echo U('Admin/dashboard/itemList');?>">商品管理</a>
                        </div>
                    </div>
                    <div class="right menu">
                        <div class="ui simple dropdown item">
                            欢迎你，<?php echo ($data["adminName"]); ?> <i class="dropdown icon"></i>
                            <div class="menu">
                                <a class="item" href="<?php echo U('Admin/dashboard/adminInfo');?>">更改资料</a>
                                <a class="item" href="<?php echo U('Admin/dashboard/resetPassword');?>">更改密码</a>
                                <a class="item" href="<?php echo U('Admin/login/logout');?>">登出</a>
                            </div>
                        </div>
                    </div><?php break;?>
                <?php case "3": ?><div class="ui simple dropdown item">
                        商店管理 <i class="dropdown icon"></i>
                        <div class="menu">
                            <a class="item" href="<?php echo U('Admin/dashboard/itemCatalog');?>">商品概况</a>
                            <a class="item" href="<?php echo U('Admin/dashboard/shopList');?>">店铺管理</a>
                            <a class="item" href="<?php echo U('Admin/dashboard/itemList');?>">商品管理</a>
                            <div class="divider"></div>
                            <a class="item" href="<?php echo U('Admin/dashboard/orderList');?>">订单管理</a>
                        </div>
                    </div>
                    <div class="right menu">
                        <div class="ui simple dropdown item">
                            欢迎你，<?php echo ($data["adminName"]); ?> <i class="dropdown icon"></i>
                            <div class="menu">
                                <a class="item" href="<?php echo U('Admin/dashboard/adminInfo');?>">更改资料</a>
                                <a class="item" href="<?php echo U('Admin/dashboard/resetPassword');?>">更改密码</a>
                                <a class="item" href="<?php echo U('Admin/login/logout');?>">登出</a>
                            </div>
                        </div>
                    </div><?php break;?>
                <?php case "4": ?><div class="ui simple dropdown item">用户管理 <i class="dropdown icon"></i>
                        <div class="menu"><a class="item" href="<?php echo U('Admin/dashboard/userManage');?>">会员管理</a><a class="item" href="<?php echo U('Admin/dashboard/adminManage');?>">管理员管理</a></div>
                    </div>
                    <div class="right menu">
                        <div class="ui simple dropdown item">
                            欢迎你，<?php echo ($data["adminName"]); ?> <i class="dropdown icon"></i>
                            <div class="menu">
                                <a class="item" href="<?php echo U('Admin/dashboard/adminInfo');?>">更改资料</a>
                                <a class="item" href="<?php echo U('Admin/dashboard/resetPassword');?>">更改密码</a>
                                <a class="item" href="<?php echo U('Admin/login/logout');?>">登出</a>
                            </div>
                        </div>
                    </div><?php break;?>
                <?php case "5": ?><div class="ui simple dropdown item">
                        商店管理 <i class="dropdown icon"></i>
                        <div class="menu">
                            <a class="item" href="<?php echo U('Admin/dashboard/itemCatalog');?>">商品概况</a>
                            <a class="item" href="<?php echo U('Admin/dashboard/shopList');?>">店铺管理</a>
                            <a class="item" href="<?php echo U('Admin/dashboard/itemList');?>">商品管理</a>
                            <div class="divider"></div>
                            <a class="item" href="<?php echo U('Admin/dashboard/orderList');?>">订单管理</a>
                        </div>
                    </div>
                    <div class="right menu">
                        <div class="ui simple dropdown item">
                            欢迎你，<?php echo ($data["adminName"]); ?> <i class="dropdown icon"></i>
                            <div class="menu">
                                <a class="item" href="<?php echo U('Admin/dashboard/adminInfo');?>">更改商店资料</a>
                                <a class="item" href="<?php echo U('Admin/dashboard/resetPassword');?>">更改密码</a>
                                <a class="item" href="<?php echo U('Admin/login/logout');?>">登出</a>
                            </div>
                        </div>
                    </div><?php break; endswitch;?>
        </div>
    </div>
    <div class="ui grid container">
        <div class="ui fourteen wide centered column">
            <div class="ui piled segments">
                <div class="ui segment">
                    <div class="ui breadcrumb">
                        <a class="section" href="<?php echo U('Admin/dashboard/index');?>">管理面板</a>
                        <i class="right arrow icon divider"></i>
                        <div class="active section">更改密码</div>
                    </div>
                </div>
                <div class="ui segment">
                    <div class="ui center aligned grid">
                        <div class="ui form">
                            <div class="field">
                                <label>原密码</label>
                                <input rows="1" type="text" name="userName" id="userName" placeholder="请输入原密码">
                            </div>
                            <div class="field">
                                <label>原用户名</label>
                                <input rows="1" type="text" name="userName" id="userName" placeholder="请输入新的密码">
                            </div>
                        </div>
                        <div class="row">
                            <div class="ui animated fade red button">
                                <div class="visible content">
                                    <i class="warning icon"></i> 修改密码
                                </div>
                                <div class="hidden content">
                                    <i class="checkmark box icon"></i> 确认修改
                                </div>
                            </div>
                        </div>
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
    //initialize
    jQuery(document).ready(function($) {
        $('table').tablesort();
    });
    </script>
</body>

</html>