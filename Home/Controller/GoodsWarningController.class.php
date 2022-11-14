<?php
namespace Home\Controller;
use Think\Controller;
class GoodsWarningController extends Controller {
    public function index(){

        if($_GET){
            //获取分类和报警值
            $type = $_GET['type'];
            $numbers = $_GET['numbers'];
            //判断是否选择了分类
            if($type == "all"){
                $result = M("goods") -> where("numbers<=".$numbers) -> select();
            } else {
                $result = M("goods") -> where("type='".$type."' AND "."numbers<=".$numbers) -> select();
            }
           
            $all_encode = json_encode($result);
            $this -> assign('all_encode', $all_encode);
        } else{
            //默认搜索100一下的报警
            $all = M("goods") -> where("numbers <= 100") -> select();
            $all_encode = json_encode($all);
            $this -> assign('all_encode', $all_encode);
        }
       
        $this -> display();
    }
}