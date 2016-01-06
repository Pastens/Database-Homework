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
    </style>
</head>

<body>
    <div class="ui fixed inverted menu">
        <div class="ui container">
            <a href="<?php echo U('Admin/dashboard/index');?>" class="header item">
                <img class="logo" src="/Public/Static/assets/images/logo.png">管理面板
            </a>
            <a href="<?php echo U('Admin/dashboard/index');?>" class="item">面板首页</a>
            <div class="ui simple dropdown item">
                商店管理 <i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item active" href="<?php echo U('Admin/dashboard/itemCatalog');?>">商品概况</a>
                    <a class="item" href="<?php echo U('Admin/dashboard/itemList');?>">商品列表</a>
                    <div class="divider"></div>
                    <a class="item" href="<?php echo U('Admin/dashboard/orderList');?>">订单管理</a>
                </div>
            </div>
            <div class="ui simple dropdown item">
                用户管理 <i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item" href="<?php echo U('Admin/dashboard/userManage');?>">会员管理</a>
                    <a class="item" href="<?php echo U('Admin/dashboard/adminManage');?>">管理员管理</a>
                </div>
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
            </div>
        </div>
    </div>
    <div class="ui grid container">
        <div class="ui fourteen wide centered column">
            <div class="ui piled segments">
                <div class="ui segment">
                    <div class="ui breadcrumb">
                        <a class="section" href="<?php echo U('Admin/dashboard/index');?>">管理面板</a>
                        <i class="right chevron icon divider"></i>
                        <div class="section">商店管理</div>
                        <i class="right arrow icon divider"></i>
                        <div class="active section">商品概况</div>
                    </div>
                </div>
                <div class="ui segment">
                    <h4>站点商品总览</h4>
                    <div class="ui horizontal segments">
                        <div class="ui mini statistic segment">
                            <div class="value">
                                <?php echo ($data["itemType"]); ?>
                            </div>
                            <div class="label">
                                在售商品种类
                            </div>
                        </div>
                        <div class="ui mini statistic segment">
                            <div class="value">
                                <?php echo ($data["orderNumber"]); ?>
                            </div>
                            <div class="label">
                                订单数量
                            </div>
                        </div>
                        <div class="ui mini statistic segment">
                            <div class="value">
                                <?php echo ($data["orderQuantity"]); ?>
                            </div>
                            <div class="label">
                                销售量
                            </div>
                        </div>
                        <div class="ui mini statistic segment">
                            <div class="value">
                                <?php echo ($data["outStock"]); ?>
                            </div>
                            <div class="label">
                                缺货商品种类
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ui segment">
                    <h4>站点商店总览</h4>
                    <table class="ui center aligned fixed table">
                        <thead>
                            <tr>
                                <th>商店名</th>
                                <th>商品种类</th>
                                <th>销售量</th>
                                <th>销售额</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($shopItem)): $i = 0; $__LIST__ = $shopItem;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$shopItem): $mod = ($i % 2 );++$i;?><tr>
                                    <td><?php echo ($shopItem["shopName"]); ?></td>
                                    <td><?php echo ($shopItem["shopItem"]); ?></td>
                                    <td><?php echo ($shopItem["shopSale"]); ?></td>
                                    <td><?php echo ($shopItem["shopProfit"]); ?></td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>共<?php echo ($data["shopNum"]); ?>家（<?php echo ($data["shopDisabled"]); ?>家已被封禁）</th>
                            </tr>
                        </tfoot>
                    </table>
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
</body>

</html>