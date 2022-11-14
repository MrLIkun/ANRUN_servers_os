<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html>
 <html>
 <head>
 	<title>仓库管理系统</title>
 	<link rel="stylesheet" type="text/css" href="/Public/layui/css/layui.css">
  <link rel="stylesheet" type="text/css" href="/Public/css/index.css">
  <script type="text/javascript" src="/Public/jquery/jquery.js"></script>
 </head>
 <body>

 <div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo layui-hide-xs layui-bg-black">安润仓库管理系统</div>
    <!-- 头部区域（可配合layui 已有的水平导航） -->
    <ul class="layui-nav layui-layout-left">
      <!-- 移动端显示 -->
      <li class="layui-nav-item layui-show-xs-inline-block layui-hide-sm" lay-header-event="menuLeft">
        <i class="layui-icon layui-icon-spread-left"></i>
      </li>
      
      
    </ul>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item layui-hide layui-show-md-inline-block">
        <a href="javascript:;">
          <img src="//tva1.sinaimg.cn/crop.0.0.118.118.180/5db11ff4gw1e77d3nqrv8j203b03cweg.jpg" class="layui-nav-img">
          <?php echo ($user['username']); ?>
        </a>
        <dl class="layui-nav-child">
          <dd><a href="">用户管理</a></dd>
          <dd><a href="/index.php/home/login/oschoose">切换系统</a></dd>
          <dd><a href="/index.php/home/login/exit">退出登录</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item" lay-header-event="menuRight" lay-unselect>
        <a href="javascript:;">
          <i class="layui-icon layui-icon-more-vertical"></i>
        </a>
      </li>
    </ul>
  </div>
  
  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree" lay-filter="test">

        <li class="layui-nav-item layui-nav-itemed">
          <a class="" href="javascript:;">货区管理</a>
          <dl class="layui-nav-child">
            <dd ><a class="allData" href="javascript:;" >总览</a></dd>
            <dd ><a class="a_area"  href="javascript:;">A区（主管配件）</a></dd>
            <dd ><a class="b_area"  href="javascript:;">B区（支管配件）</a></dd>
            <dd ><a class="c_area"  href="javascript:;">C区（气动配件）</a></dd>
            <dd ><a class="d_area"  href="javascript:;">D区（加油泵配件）</a></dd>
            <dd ><a class="e_area"  href="javascript:;">E区（给油器箱配件）</a></dd>
            <dd ><a class="f_area"  href="javascript:;">F区（控制柜配件）</a></dd>
          </dl>
        </li>

        <li class="layui-nav-item">
          <a href="javascript:;">货物盘点</a>
          <dl class="layui-nav-child">
            <dd><a  class="a_goods" href="javascript:;">货物入库</a></dd>
            <dd><a  class="b_goods" href="javascript:;">货物出库</a></dd>
            <dd><a  class="c_goods" href="javascript:;">入库记录</a></dd>
            <dd><a  class="d_goods" href="javascript:;">出库记录</a></dd>
            <dd><a  class="e_goods" href="javascript:;">库存报警</a></dd>
          </dl>
        </li>
      </ul>
    </div>
  </div>
  
  <div class="layui-body">
    <!-- 内容主体区域 -->
    <div style="padding: 15px; height: 100%" >
      <iframe class="_frame"  frameborder="0" style="width: 100%;height: 100%" src="index.php/home/allData"></iframe>
    </div>
  </div>
  
  <div class="layui-footer">
    <!-- 底部固定区域 -->
    底部固定区域
  </div>
</div>
<script type="text/javascript" src="/Public/jquery/jquery.js"></script>
<script type="text/javascript">
   //获取各区的类
    $(".allData").click(function () {
      $("._frame").attr("src","index.php/home/allData");
    }) 

    $(".a_area").click(function () {
      $("._frame").attr("src","index.php/home/allData/aArea");
    })

     $(".b_area").click(function () {
      $("._frame").attr("src","index.php/home/allData/bArea");
    })

      $(".c_area").click(function () {
      $("._frame").attr("src","index.php/home/allData/cArea");
    })

       $(".d_area").click(function () {
      $("._frame").attr("src","index.php/home/allData/dArea");
    })

        $(".e_area").click(function () {
      $("._frame").attr("src","index.php/home/allData/eArea");
    })
         $(".f_area").click(function () {
      $("._frame").attr("src","index.php/home/allData/fArea");
    })


    //货物盘点链接
     $(".a_goods").click(function () {
      $("._frame").attr("src","index.php/home/goodsIn");
    })

     $(".b_goods").click(function () {
      $("._frame").attr("src","index.php/home/goodsOut");
    })

      $(".c_goods").click(function () {
      $("._frame").attr("src","index.php/home/goodsIn/inrec");
    })

       $(".d_goods").click(function () {
      $("._frame").attr("src","index.php/home/goodsOut/outrec");
    })

        $(".e_goods").click(function () {
      $("._frame").attr("src","index.php/home/goodsWarning");
    })


</script>
<script>
//JS 
layui.use(['element', 'layer', 'util'], function(){
  var element = layui.element
  ,layer = layui.layer
  ,util = layui.util
  ,$ = layui.$;
  
  //头部事件
  util.event('lay-header-event', {
    //左侧菜单事件
    menuLeft: function(othis){
      layer.msg('展开左侧菜单的操作', {icon: 0});
    }
    ,menuRight: function(){
      layer.open({
        type: 1
        ,content: '<div style="padding: 15px;">处理右侧面板的操作</div>'
        ,area: ['260px', '100%']
        ,offset: 'rt' //右上角
        ,anim: 5
        ,shadeClose: true
      });
    }
  });
  
});

</script>
 
 <script type="text/javascript" src="/Public/layui/layui.js"></script>

 </body>
 </html>