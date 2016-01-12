<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="UTF-8">
    <title>管理员管理 —— Eshop</title>
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
                        <i class="right chevron icon divider"></i>
                        <div class="section">商店管理</div>
                        <i class="right arrow icon divider"></i>
                        <div class="active section">管理员管理</div>
                    </div>
                </div>
                <div class="ui segment">
                    <h4>管理员列表</h4>
                    <table class="ui sortable center aligned fixed table">
                        <thead>
                            <tr>
                                <th>管理员ID</th>
                                <th>系统角色</th>
                                <th>用户名</th>
                                <th>昵称</th>
                                <th>登录次数</th>
                                <th>用户状态</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($adminInfo)): $i = 0; $__LIST__ = $adminInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$adminInfo): $mod = ($i % 2 );++$i;?><tr>
                                    <td class="selectable" data-sort-value="<?php echo ($adminInfo["adminId"]); ?>"><a href="#"><?php echo ($adminInfo["adminId"]); ?></a></td>
                                    <td class="selectable" data-sort-value="<?php echo ($adminInfo["adminSuper"]); ?>"><a href="#"><?php echo ($adminInfo["adminSuperior"]); ?></a></td>
                                    <td class="selectable" data-sort-value="<?php echo ($adminInfo["adminName"]); ?>"><a href="#"><?php echo ($adminInfo["adminName"]); ?></a></td>
                                    <td class="selectable" data-sort-value="<?php echo ($adminInfo["adminNickname"]); ?>"><a href="#"><?php echo ($adminInfo["adminNickname"]); ?></a></td>
                                    <td class="selectable" data-sort-value="<?php echo ($adminInfo["adminLog"]); ?>"><a href="#"><?php echo ($adminInfo["adminLog"]); ?></a></td>
                                    <td class="selectable" data-sort-value="<?php echo ($adminInfo["adminStatus"]); ?>"><a href="#"><?php echo ($adminInfo["adminStatus"]); ?></a></td>
                                    
                                    <?php if($adminInfo["adminStatus"] == '正常'): ?><td data-value="<?php echo ($adminInfo["adminId"]); ?>" data-sort-value="<?php echo ($adminInfo["adminStatus"]); ?>"><div class="ui tiny red button">禁止管理员</div></td>
                                    <?php else: ?>
                                        <td data-value="<?php echo ($adminInfo["adminId"]); ?>" data-sort-value="<?php echo ($adminInfo["adminStatus"]); ?>"><div class="ui tiny green button">解禁管理员</div></td><?php endif; ?>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>共<?php echo ($data["adminCount"]); ?>名管理员</th>
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
    <script>
    //initialize
    jQuery(document).ready(function($) {
        $('table').tablesort();

        $('.ui.modal').modal();

        $('.selectable a').on('click', function(event) {
            $('.error').removeClass('error');
            $('.ui.toggle.checked').removeClass('checked');

            var Nodes = this.parentNode.parentNode;
            var Childs = Nodes.querySelectorAll('.selectable');
            $('#itemName').val(Childs[1].getAttribute('data-sort-value'));
            $('#itemIntro').val(Childs[2].getAttribute('data-sort-value'));
            $('#itemPrice').val(Childs[3].getAttribute('data-sort-value'));
            $('#itemStock').val(Childs[4].getAttribute('data-sort-value'));
            console.log(Childs[0].getAttribute('data-sort-value'));
            if(Childs[0].getAttribute('data-sort-value')==1){
                $(".ui.toggle.checkbox").checkbox('set checked');
            }else{
                $(".ui.toggle.checkbox").checkbox('set unchecked');
            }
            $('.ui.modal').modal('show');
        });

        $('.ui.form').form({
            on: 'blur',
            fields: {
                itemName: {
                    identifier: 'itemName',
                    rules: [{
                        type: 'empty',
                        prompt: '请输入商品名'
                    }]
                },
                itemIntro: {
                    identifier: 'itemIntro',
                    rules: [{
                        type: 'empty',
                        prompt: '请输入商品介绍'
                    }]
                },
                itemPrice: {
                    identifier: 'itemPrice',
                    rules: [{
                        type: 'integer[1..10000000]',
                        prompt: '请输入有效的商品价格'
                    }]
                },
                itemStock: {
                    identifier: 'itemStock',
                    rules: [{
                        type: 'integer[0..10000000]',
                        prompt: '请输入有效的商品库存'
                    }]
                }
            }
        }).submit( function (e){
            e.preventDefault();
        });
    });
    </script>
</body>

</html>