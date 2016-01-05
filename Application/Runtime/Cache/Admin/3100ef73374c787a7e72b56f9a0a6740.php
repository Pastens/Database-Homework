<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="UTF-8">
    <title>管理员登录 —— Eshop</title>
    <link rel="stylesheet" type="text/css" href="/Public/Static/semantic/semantic/dist/semantic.min.css">
    <style>
    body {
        background-color: #232323;
    }
    
    body > .grid {
        height: 100%;
    }
    
    .image {
        margin-top: -100px;
    }
    
    .column {
        max-width: 450px;
    }
    </style>
</head>

<body>
    <div class="ui middle aligned center aligned grid">
        <div class="column">
            <h2 class="ui teal image header">
                <img src="/Public/Static/assets/images/logo.png" class="image">
                <div class="content">
                    管理员后台登录
                </div>
            </h2>
            <div class="ui large form">
                <div class="ui piled segment">
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="user icon"></i>
                            <input type="text" name="adminName" placeholder="请输入管理员用户名">
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input type="password" name="adminPassword" placeholder="请输入密码">
                        </div>
                    </div>
                    <div class="field" style="text-align: right">
                        <div class="ui slider checkbox">
                            <input type="checkbox" name="adminAutologin">
                            <label>自动登录</label>
                        </div>
                    </div>
                    <button type="submit" class="ui fluid large teal submit button">登录</button>
                    <div class="ui error message"></div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/Public/Static/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/Static/semantic/semantic/dist/semantic.min.js"></script>
    <script type="text/javascript" src="/Public/Static/jquery.md5.min.js"></script>
    <script>
    jQuery(document).ready(function($) {
        $('.ui.large.form').form({
            on: 'blur',
            fields: {
                adminName: {
                    identifier: 'adminName',
                    rules: [{
                        type: 'empty',
                        prompt: '请输入用户名'
                    }]
                },
                adminPassword: {
                    identifier: 'adminPassword',
                    rules: [{
                        type: 'empty',
                        prompt: '请输入密码'
                    }]
                }
            }
        }).submit( function (e) {
            e.preventDefault();
        });

        $('.ui.large.form').on('click',  function(event) {
            $(this).removeClass('error');
        });

        $('.ui.large.form .submit').click(function(){
            var $form = $('.ui.large.form'),
                adminName = $form.form('get value','adminName'),
                adminPassword = $form.form('get value','adminPassword'),
                adminAutologin = $form.form('get value','adminAutologin');
            if((adminName&&adminPassword)== ''){
                return false;
            }else{
                $.ajax({
                    url: '<?php echo U("Admin/login/loginAdmin");?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        adminName: adminName,
                        adminPassword: $.md5(adminPassword),
                        adminAutologin: adminAutologin
                    },
                    success: function(data){
                        if(data.status == 1){
                            location.href = "<?php echo U('Admin/dashboard/index');?>";
                        }else if(data.status == 0){
                            var message = "<p>"+data.info+"</p>";
                            $('.ui.error.message').html(message);
                            $('.ui.large.form').addClass('error');
                        }
                    }
                })
                .done(function() {
                    console.log("success");
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });
                
            }
        });
    });
    </script>
</body>

</html>