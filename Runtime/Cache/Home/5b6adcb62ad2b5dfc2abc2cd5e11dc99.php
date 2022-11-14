<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>安润登录系统</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="stylesheet" media="screen" href="/Public/css/style.css">
  <link rel="stylesheet" type="text/css" href="/Public/css/reset.css"/>
   <script type="text/javascript" src="/Public/jquery/jquery.js"></script>
</head>
<body>

<div id="particles-js">
    <div class="login">
      <div class="login-top">
        安润管理系统登录
      </div>
      <div class="login-center clearfix">
        <div class="login-center-img"><img src="/Public/image/name.png"/></div>
        <div class="login-center-input">
          <input type="text" name="username" class="username" value="" placeholder="请输入您的用户名" onfocus="this.placeholder=''" onblur="this.placeholder='请输入您的用户名'"/>
          <div class="login-center-input-text">用户名</div>
        </div>
      </div>
      <div class="login-center clearfix">
        <div class="login-center-img"><img src="/Public/image/password.png"/></div>
        <div class="login-center-input">
          <input type="password" name="password" class="password" value="" placeholder="请输入您的密码" onfocus="this.placeholder=''" onblur="this.placeholder='请输入您的密码'"/>
          <div class="login-center-input-text">密码</div>
        </div>
      </div>
      <div class="login-button">
        登录
      </div>
    </div>
    <div class="sk-rotating-plane"></div>
</div>

<!-- scripts -->

<script src="/Public/js/particles.min.js"></script>
<script src="/Public/js/app.js"></script>
<script type="text/javascript" src="/Public/jquery/jquery.js"></script>
<script type="text/javascript" src="/Public/layui/layui.js"></script>
<script type="text/javascript">
  function hasClass(elem, cls) {
    cls = cls || '';
    if (cls.replace(/\s/g, '').length == 0) return false; //当cls没有参数时，返回false
    return new RegExp(' ' + cls + ' ').test(' ' + elem.className + ' ');
  }
   
  function addClass(ele, cls) {
    if (!hasClass(ele, cls)) {
      ele.className = ele.className == '' ? cls : ele.className + ' ' + cls;
    }
  }
   
  function removeClass(ele, cls) {
    if (hasClass(ele, cls)) {
      var newClass = ' ' + ele.className.replace(/[\t\r\n]/g, '') + ' ';
      while (newClass.indexOf(' ' + cls + ' ') >= 0) {
        newClass = newClass.replace(' ' + cls + ' ', ' ');
      }
      ele.className = newClass.replace(/^\s+|\s+$/g, '');
    }
  }
  $(".login-button").click(function (){
        $.ajax({
            type: "POST",
            url: "/index.php/home/login/verifi",
            data: {username:$(".username").val(),password:$(".password").val()},
            success: function (data){
                  if(data == 1) {
                      layer.msg('登录成功！');
                      location.replace("/index.php/home/login/oschoose");
                  }else{
                       layer.msg('用户名或密码错误，请重新输入！');
                  }
                 
            },
            error:function (){
                  layer.msg('用户名或密码错误，请重新输入！');
            }
          });
  });

</script>
</body>
</html>