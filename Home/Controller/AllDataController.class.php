<?php
namespace Home\Controller;
use Think\Controller;
class AllDataController extends Controller {
    public function index(){
        //查询所有数据
    	$all = M("goods") -> select();
    	$all_encode = json_encode($all);

        //查询仓库所有物品种类数量
        $count = M("goods") -> count();
        //查询仓库今日新增物品
        $today_before = strtotime(date('Y-m-d')." 00:00:00");
        $today_after = strtotime(date('Y-m-d')." 23:59:59");
        $today_new = M("goods") -> where("change_time>=".$today_before." AND "."change_time<=".$today_after) -> count();
        //查询今日入库数量
        $today_in = M("goods_in") -> where("change_time>=".$today_before." AND "."change_time<=".$today_after) -> count();
        //查询今日出库数量
        $today_out = M("goods_out") -> where("change_time>=".$today_before." AND "."change_time<=".$today_after) -> count();

    	//查询本周出库次数排名

        $time = time(); // 可设定日期
 
        $week_day_num = date('w', $time);
        if ($week_day_num == 0) {  
            // 当前是周日的情况
            $sdate = date('Y-m-d', strtotime("-6 day", $time));
            $edate = date('Y-m-d', $time);
        } else {
            $sdate = date('Y-m-d', strtotime("-" . ($week_day_num - 1) . " day", $time));
            $edate = date('Y-m-d', strtotime("+" . (7 - $week_day_num) . " day", $time));
        } 

        $model=M('goods_out');
        $alldata = $model->field('count(goods_id) num,goods_id,name,norms')->where("change_time>=".strtotime($sdate)." AND "."change_time<=".strtotime($edate)) -> group('goods_id')->order('num desc')->limit('7') -> select();
   
        $alldata = json_encode($alldata);


        //查询本周出库物品统计

        $model=M('goods_out');
        $alldata_sum = $model -> distinct(true) ->where("change_time>=".strtotime($sdate)." AND "."change_time<=".strtotime($edate)) -> order('change_time desc') -> select();
   
        $alldata_sum = json_encode($alldata_sum);

        $this -> assign('count', $count);
        $this -> assign('today_in', $today_in);
        $this -> assign('today_out', $today_out);
        $this -> assign('today_new', $today_new);
        $this -> assign('sdate', $sdate);
        $this -> assign('edate', $edate);
        $this -> assign('alldata_sum', $alldata_sum);
    	$this -> assign('all_encode', $all_encode);
        $this -> assign('alldata', $alldata);
        $this -> display();
    }
    public function aArea(){
        $all = M("goods") -> where("type="."'A区'") -> select();
  
        $all_encode = json_encode($all);
        //遍历表
        $this -> assign('all_encode', $all_encode);
        $this -> display();
    }
    public function bArea(){
    	$all = M("goods") -> where("type="."'B区'") -> select();
  
        $all_encode = json_encode($all);
        //遍历表
        $this -> assign('all_encode', $all_encode);
        $this -> display();
    }
    public function cArea(){
    	$all = M("goods") -> where("type="."'C区'") -> select();
  
        $all_encode = json_encode($all);
        //遍历表
        $this -> assign('all_encode', $all_encode);
        $this -> display();
    }
     public function dArea(){
    	$all = M("goods") -> where("type="."'D区'") -> select();
  
        $all_encode = json_encode($all);
        //遍历表
        $this -> assign('all_encode', $all_encode);
        $this -> display();
    }
    public function eArea(){
    	$all = M("goods") -> where("type="."'E区'") -> select();
  
        $all_encode = json_encode($all);
        //遍历表
        $this -> assign('all_encode', $all_encode);
        $this -> display();
    }
    public function fArea(){
    	$all = M("goods") -> where("type="."'F区'") -> select();
  
        $all_encode = json_encode($all);
        //遍历表
        $this -> assign('all_encode', $all_encode);
        $this -> display();
    }
}