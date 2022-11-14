<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="/Public/layui/css/layui.css">
  <link rel="stylesheet" type="text/css" href="/Public/css/allData.css">
  <style type="text/css">
  {# 设置table每一行的height #}
  .layui-table-cell {
   height: 50px;
   line-height: 50px;
  }
 .layui-table-header table .layui-table-cell {
    height: 30px;
    line-height: 30px;
  }
  .layui-input{
    width: 350px;
  }
  .layui-table-tool-temp{
    display: none;
  }

 </style>
</head>
<body>
  
  <div class="layui-input-inline">
      <input type="text" name="title" required lay-verify="required" placeholder="请输入关键字进行搜索" autocomplete="off" class="layui-input" > 
  </div>
   
  <div class="layui-input-inline">
        <button type="button" class="layui-btn">搜索</button>
  </div>
  


      
  <table class="layui-hide" id="demo" lay-filter="test"></table>
  <script type="text/html" id="barDemo">
      <a class="layui-btn layui-btn-xs" lay-event="more">更多 <i class="layui-icon layui-icon-down"></i></a>
  </script>

<script type="text/javascript" src="/Public/jquery/jquery.js"></script>
<script type="text/javascript" src="/Public/layui/layui.js"></script>

<script>

$(".btn1").click(function (){
  location.replace("/index.php/home/search/searchGoods?table_id="+$(".layui-input").val());
});
$(".btn2").click(function (){
   layer.open({
          type: 1, 
          content: '<div style="margin: 40px"> <p style="margin-top: 30px;">名称：<input type="text" class="name" value="'+data.name+'"></p><p style="margin-top: 30px;">规格：<input type="text" class="norms" value="'+data.norms+'"></p><p style="margin-top: 30px;">数量：<input type="text" class="numbers" value="'+data.numbers+'"></p><p style="margin-top: 30px;">单位：<input type="text" class="unit" value="'+data.unit+'"></p><p style="margin-top: 30px;">分类：<select name="type" class="type"><option>A区</option><option>B区</option><option>C区</option><option>D区</option><option>E区</option><option>F区</option></select></p><p style="margin-top: 30px;">备注：<input type="text" class="remark" value="'+data.remark+'"></p></div><p style="padding-left: 200px;margin-bottom: 40px;"><button class="save" style="background-color: green; color: white;width: 60px; border:1px solid gray;cursor: pointer" >保存</button></p>' 
      });


$(".save1").click(function(){

    var formdata = new FormData($("#uploadFile")[0]);
    var file1 = $("#file1")[0].files;
    formdata.append('file',file1);
    formdata.append('img',file1[0].name);

    $.ajax({
      type: "POST",
      url:"/index.php/home/goodsIn/upload",
      data: formdata,
      processData : false, //必须false才会避开jQuery对 formdata 的默认处理
      contentType : false, //必须false才会自动加上正确的Content-Type
      success: function (data){
                   layer.close(layer.index);
                      layer.msg("保存成功！");
                }
    });
  });
});

layui.use('table', function(){
  var table = layui.table
   ,dropdown = layui.dropdown;

  
  //展示已知数据

   table.render({
    elem: '#demo'
    ,toolbar: 'default' //开启工具栏，此处显示默认图标，可以自定义模板，详见文档
    ,cellMinWidth: 50
    ,cols: [[ //标题栏
      {field: 'table_id', title: 'ID',  sort: true}
     ,{field: 'goods_id', title: '物料编号'}
      ,{field: 'images', title: '缩略图'}
      ,{field: 'name', title: '名称'}
      ,{field: 'norms', title: '规格'}
      ,{field: 'numbers', title: '数量', sort: true}
      ,{field: 'unit', title: '单位', sort: true}
      ,{field: 'type', title: '分类', }
      ,{field: 'change_time', title: '创建时间', sort: true}
      ,{field: 'remark', title: '备注'}
       ,{fixed: 'right',  align:'center', toolbar: '#barDemo'}
    ]]
    ,data: <?php echo ($all_encode); ?>
    
    ,even: true,
    page: true ,//是否显示分页
  
    limit: 10
     //每页默认显示的数量
  });
     //监听行工具事件
  table.on('tool(test)', function(obj){ //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
    var data = obj.data //获得当前行数据
    ,layEvent = obj.event; //获得 lay-event 对应的值
    var data2 = data;
    if(layEvent === 'detail'){
      layer.msg('查看操作');
    } else if(layEvent === 'more'){
      //下拉菜单
      dropdown.render({
        elem: this //触发事件的 DOM 对象
        ,show: true //外部事件触发即显示
        ,data: [{
          title: '入库'
          ,id: 'edit'
        },{
          title: '删除'
          ,id: 'del'
        }]
        ,click: function(menudata){
          if(menudata.id === 'del'){
            layer.confirm('真的删除吗？', function(index){
              obj.del(); //删除对应行（tr）的DOM结构
              layer.close(index);
              //向服务端发送删除指令
              $.ajax({
                type: "GET",
                url: "/index.php/home/delete",
                data: {table_id:data.table_id},
                success: function (data){
                  layer.msg('删除成功！');
                }
              });
            });
          } else if(menudata.id === 'edit'){
            layer.open({
          type: 1, 
          content: '<div style="margin: 40px"> <p style="margin-top: 30px;">名称：<input disabled type="text" class="name" value="'+data.name+'"></p><p style="margin-top: 30px;">名称：<input disabled type="text" class="goods_id " value="'+data.goods_id+'"></p><p style="margin-top: 30px;">规格：<input  disabled type="text" class="norms" value="'+data.norms+'"></p><p style="margin-top: 30px;">入库数量：<input type="text" class="numbers" value="" placeholder="请输入入库数量"></p><p style="margin-top: 30px;">单位：<input type="text" class="unit" name="unit"  value="'+data.unit+'"></p><p style="margin-top: 30px;"><p style="margin-top: 30px;">分类：<input disabled type="text" class="type" value="'+data.type+'"></p><p style="margin-top: 30px;">备注：<input disabled type="text" class="remark" value="'+data.remark+'"></p></div><p style="padding-left: 200px;margin-bottom: 40px;"><button class="save" style="background-color: green; color: white;width: 60px; border:1px solid gray;cursor: pointer" >保存</button></p>' 
      });
      $(".save").click(function(){
           $.ajax({
                    type: "GET",
                    url: "/index.php/home/goodsIn/in",

                    data: { 
                        table_id:data.table_id,
                        name:$(".name").val(),
                        norms:$(".norms").val(),
                        numbers:$(".numbers").val(),
                        unit:$(".unit").val(),
                        type:$(".type").val(),
                        remark:$(".remark").val()},
                    success: function (data){
                      layer.close(layer.index);
                      layer.msg("保存成功！");
                  
                      obj.update({
                    name: $(".name").val(),
                    norms: $(".norms").val(),
                    numbers: $(".numbers").val(),
                    unit:$(".unit").val(),
                    type:$(".type").val(),
                    remark:$(".remark").val()
                });
                    }
                 });
        });
          }
        }
        ,align: 'right' //右对齐弹出（v2.6.8 新增）
        ,style: 'box-shadow: 1px 1px 10px rgb(0 0 0 / 12%);' //设置额外样式
      })
    }
  });
});
</script>
</body>
</html>