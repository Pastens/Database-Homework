<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="UTF-8">
    <title>商品管理 —— Eshop</title>
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
                        <div class="active section">商品管理</div>
                    </div>
                </div>
                <div class="ui segment">
                    <h4>商品列表</h4>
                    <table class="ui sortable center aligned fixed table">
                        <thead>
                            <tr>
                                <th class="no-sort"></th>
                                <th>商品名</th>
                                <th>商品介绍</th>
                                <th>商铺</th>
                                <th>定价</th>
                                <th>库存量</th>
                                <th>销售量</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($shopItem)): $i = 0; $__LIST__ = $shopItem;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$shopItem): $mod = ($i % 2 );++$i;?><tr>
                                    <td class="collapsing selectable" data-sort-value="<?php echo ($shopItem["enable"]); ?>">
                                        <div class="ui fitted slider checkbox">
                                            <!-- <?php echo ($shopItem["enable?checked:''"]); ?> -->
                                            <?php if($shopItem["enable"] == '1'): ?><input type="checkbox" checked disabled>
                                                <?php else: ?>
                                                <input type="checkbox" disabled><?php endif; ?>
                                            <label></label>
                                        </div>
                                    </td>
                                    <td class="selectable" data-sort-value="<?php echo ($shopItem["itemName"]); ?>"><a href="#"><?php echo ($shopItem["itemName"]); ?></a></td>
                                    <td class="selectable" data-sort-value="<?php echo ($shopItem["itemIntro"]); ?>"><a href="#"><?php echo ($shopItem["itemIntro"]); ?></a></td>
                                    <td data-sort-value="<?php echo ($shopItem["itemShop"]); ?>" data-sort-value="<?php echo ($shopItem["itemName"]); ?>"><?php echo ($shopItem["itemShop"]); ?></td>
                                    <td class="selectable" data-sort-value="<?php echo ($shopItem["itemPrice"]); ?>"><a href="#"><?php echo ($shopItem["itemPrice"]); ?></a></td>
                                    <td class="selectable" data-sort-value="<?php echo ($shopItem["itemStock"]); ?>"><a href="#"><?php echo ($shopItem["itemStock"]); ?></a></td>
                                    <td data-sort-value="<?php echo ($shopItem["itemSales"]); ?>"><?php echo ($shopItem["itemSales"]); ?></td>
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
                                <th>共<?php echo ($data["itemType"]); ?>种</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="ui small modal">
        <i class="close icon"></i>
        <div class="header">
            修改商品信息
        </div>
        <div class="content center aligned ">
            <div class="ui form">
                <div class="field">
                    <label>商品名</label>
                    <input rows="1" name="itemName" id="itemName">
                </div>
                <div class="field">
                    <label>商品介绍</label>
                    <input rows="4" name="itemIntro" id="itemIntro">
                </div>
                <div class="field">
                    <label>销售价</label>
                    <input rows="1" name="itemPrice" id="itemPrice">
                </div>
                <div class="field">
                    <label>库存量</label>
                    <input rows="1" name="itemStock" id="itemStock">
                </div>
                <div class="field">
                    <div class="ui toggle checkbox">
                        <label>销售状态</label>
                        <input type="checkbox" name="itemStatus" id="itemStatus">
                    </div>
                </div>
            </div>
        </div>
        <div class="actions">
            <div class="ui button">取消</div>
            <div class="ui button">提交</div>
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