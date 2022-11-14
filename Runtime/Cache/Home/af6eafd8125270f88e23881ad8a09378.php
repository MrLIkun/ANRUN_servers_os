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
  .layui-card-body p{
    margin:56px 0;
  }
  .layui-card-header{
    font-size: 24px;
    font-weight: bold;
    height: 60px;
    line-height: 60px;
  }
  span{
    display: inline-block;
  }
  .tab_title{
    font-size: 20px;
    font-weight: bold;
  }
  .tab_number{
    font-size: 20px;
    margin-left: 50%;
    width: 80px;
    text-align: center;
  }
 </style>
</head>
<body>
  <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
      <legend>数据概览区</legend>
  </fieldset>
<div class="layui-bg-gray" style="padding: 30px;">
  <div class="layui-row layui-col-space15">
    <div class="layui-col-md6">
      <div class="layui-card">
        <div class="layui-card-header">仓库概揽</div>
        <div class="layui-card-body">
          <p><span class="tab_title">共计种类：</span>  <span class="tab_number"><?php echo ($count); ?></span></p>
          <p><span class="tab_title">今日新增：</span>  <span class="tab_number"><?php echo ($today_new); ?></span><button type="button" class="layui-btn-sm layui-btn layui-btn-normal">查看<i class="layui-icon"></i></button></p>
          <p><span class="tab_title">今日入库：</span>  <span class="tab_number"><?php echo ($today_in); ?> </span><button type="button" class="layui-btn-sm layui-btn">查看<i class="layui-icon"></i></button></p>
          <p><span class="tab_title">今日出库：</span>  <span class="tab_number"><?php echo ($today_out); ?> </span><button type="button" class="layui-btn-sm layui-btn layui-btn-warm">查看<i class="layui-icon"></i></button></p>
        </div>
      </div>
    </div>
    <div class="layui-col-md6">
      <div class="layui-card">
        <div class="layui-card-header">周出库次数排名</div>
        <div class="layui-card-body"><?php echo ($sdate); ?>&nbsp; - &nbsp;<?php echo ($edate); ?>
          <div id="main" style="width: 600px;height:400px;"></div>
        </div>
      </div>
    </div>
  </div>
</div> 

<div class="layui-bg-gray" style="padding: 30px;">
  <div class="layui-row layui-col-space15">

    <div class="layui-col-md6">
      <div class="layui-card">
        <div class="layui-card-header">周出库物品统计</div>
        <div class="layui-card-body"><?php echo ($sdate); ?>&nbsp; - &nbsp;<?php echo ($edate); ?>
          <div id="main2" style="width: 600px;height:400px;">
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>




  <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
      <legend>数据展示区</legend>
  </fieldset>
  <div class="layui-input-inline">
      <input type="text" name="title" required lay-verify="required" placeholder="请输入关键字进行搜索" autocomplete="off" class="layui-input" > 
  </div>
   
	 <div class="layui-input-inline">
        <button type="button" class="layui-btn btn1">搜索</button>
  </div>

      
	<table class="layui-hide" id="demo" lay-filter="test"></table>
	<script type="text/html" id="barDemo">
  		<a class="layui-btn layui-btn-xs" lay-event="more">更多 <i class="layui-icon layui-icon-down"></i></a>
	</script>

<script type="text/javascript" src="/Public/jquery/jquery.js"></script>
<script type="text/javascript" src="/Public/layui/layui.js"></script>
<script type="text/javascript" src="/Public/echarts/echarts.min.js">></script>
<script>
/*获取周出库数据分析*/
var allData = <?php echo ($alldata); ?>;
var names = [];
var nums = [];
var test_i = 0;
/*分别获取物品的名称、规格、一周出库的频率*/
for(var value in allData){
    names[test_i] = allData[value]['name']+allData[value]['norms'];
    nums[test_i] = allData[value]['num'];
    test_i++;
}

/*获取周出库数据排名*/
var alldata_sum = <?php echo ($alldata_sum); ?>;
console.log(alldata_sum);
var sums = [];

var test_i = 0;
for(var value in alldata_sum){
   sums[test_i] = {'value': alldata_sum[value]['numbers'], 'name':alldata_sum[value]['name']+alldata_sum[value]['norms']};
   test_i++;
  }
console.log(sums);
/*echars程序*/
var chartDom = document.getElementById('main');
var chartDom2 = document.getElementById('main2');
var myChart = echarts.init(chartDom);
var myChart2 = echarts.init(chartDom2);
var option;

option = {
  xAxis: {
    type: 'category',
    data: names,
  },
  yAxis: {
    type: 'value'
  },
  series: [
    {
      name:"test",
      data: nums,
      type: 'bar'
    }
  ]
};


option2 = {
  title: {
    text: '一周内出库物品名称和数量数据分析',
    subtext: '',
    left: 'center'
  },
  tooltip: {
    trigger: 'item'
  },
  legend: {
    orient: 'vertical',
    left: 'left'
  },
  series: [
    {
      name: '出库物品',
      type: 'pie',
      radius: '50%',
      data: sums
      ,
      emphasis: {
        itemStyle: {
          shadowBlur: 10,
          shadowOffsetX: 0,
          shadowColor: 'rgba(0, 0, 0, 0.5)'
        }
      }
    }
  ]
};

myChart.setOption(option);
myChart2.setOption(option2);

$(".layui-btn").click(function (){
	location.replace("/index.php/home/search?table_id="+$(".layui-input").val());
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
      ,{field: 'change_time', title: '创建时间', sort: true, templet: function(d){
        var unixTimestamp = new Date(d.change_time * 1000);
        var commonTime = unixTimestamp.toLocaleString();
        return commonTime
      }}
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
    if(layEvent === 'detail'){
      layer.msg('查看操作');
    } else if(layEvent === 'more'){
      //下拉菜单
      dropdown.render({
        elem: this //触发事件的 DOM 对象
        ,show: true //外部事件触发即显示
        ,data: [{
          title: '编辑'
          ,id: 'edit'
        },{
          title: '删除'
          ,id: 'del'
        }]
        ,click: function(menudata){
          if(menudata.id === 'del'){
            layer.confirm('真的删除行么', function(index){
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
  				  content: '<div style="margin: 40px"> <p style="margin-top: 30px;">名称：<input type="text" class="name" value="'+data.name+'"></p><p style="margin-top: 30px;">规格：<input type="text" class="norms" value="'+data.norms+'"></p><p style="margin-top: 30px;">数量：<input type="text" class="numbers" value="'+data.numbers+'"></p><p style="margin-top: 30px;">单位：<input type="text" class="unit" value="'+data.unit+'"></p><p style="margin-top: 30px;">分类：<select name="type" class="type"><option>A区</option><option>B区</option><option>C区</option><option>D区</option><option>E区</option><option>F区</option></select></p><p style="margin-top: 30px;">备注：<input type="text" class="remark" value="'+data.remark+'"></p></div><p style="padding-left: 200px;margin-bottom: 40px;"><button class="save" style="background-color: green; color: white;width: 60px; border:1px solid gray;cursor: pointer" >保存</button></p>'
			});
			$(".save").click(function(){
					 $.ajax({
              			type: "GET",
                    url: "/index.php/home/update",

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