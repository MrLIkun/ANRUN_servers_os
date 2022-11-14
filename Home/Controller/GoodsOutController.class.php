<?php
namespace Home\Controller;
use Think\Controller;
class GoodsOutController extends Controller {
    public function index(){
    	//获取搜索值
        $get = $_GET["id"];
        $where['name']=array('like','%'.$get.'%');
        $result = M("goods") -> where($where) -> select();

        $all_encode = json_encode($result);

        $this -> assign('all_encode', $all_encode);
        $this -> assign('search',$get);
        $this -> display();
    }


    public function out(){
   
    	//搜索要入库的这个物品
    	$out = M('goods') -> where("table_id=".$_GET['table_id']) -> find();

    
    	//将数量更改更新到数据库
    	$arr = array(
    				"table_id"=>$_GET['table_id'],
    				"name"=> $_GET['name'],
    				"goods_id"=> $_GET['goods_id'],
    				"norms"=> $_GET['norms'],
    				"numbers"=>$out["numbers"]-$_GET['numbers'],
    				"type"=> $_GET['type'],
    				"remark"=> $_GET['remark']
    			);
    	//更新到出库记录
        $in_people =  M("alluser") -> where("id=".session("userid")) -> find()["username"];

    	$arrout = array(
                    "images"=>$out["images"],
                    "unit" => $_GET["unit"],
                    "goods_id"=> $_GET['goods_id'],
    				"name"=> $_GET['name'],
    				"norms"=> $_GET['norms'],
    				"numbers"=>$_GET['numbers'],
    				"type"=> $_GET['type'],
    				"change_time"=> strtotime(date("Y-m-d H:i:s")),
    				"remark"=> $_GET['remark'],
                    'in_people' => $in_people
    			);
        
   
    	M('goods_out') -> add($arrout);

   
    	//将入库结构更新到物品表
    	$result = M('goods') -> save($arr);
    	if($result){
    		echo true;
    	} else {
    		echo false;
    	}
    }



    public  function  outrec(){
        //判断是否有搜索值传入
        if($_GET){
            //获取搜索值
            $get = $_GET["id"];
            $where['name']=array('like','%'.$get.'%');
            $all_encode = json_encode(M("goods_out") -> where($where) -> select());
    
            $this -> assign('all_encode', $all_encode);
            $this -> assign('search',$get);
            $this -> display();
        } else{

            $all = M("goods_out") -> order('change_time desc') ->  select();
            $all_encode = json_encode($all);
            //遍历表
            $this -> assign('all_encode', $all_encode);
            $this -> display();

        }
    }

       
}