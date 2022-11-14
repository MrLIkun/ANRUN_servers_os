<?php
namespace Home\Controller;
use Think\Controller;
class SearchController extends Controller {
    public function index(){

    	//获取搜索值
    	$get = $_GET["table_id"];
		$where['name']=array('like','%'.$get.'%');
		$result = M("goods") -> where($where) -> select();

    	$all_encode = json_encode($result);

    	$this -> assign('all_encode', $all_encode);
    	$this -> assign('search',$get);
    	$this -> display();
    }

    //搜索入库
    public function searchGoods(){
        //获取搜索值
        $get = $_GET["table_id"];
        $where['name']=array('like','%'.$get.'%');
        $result = M("goods") -> where($where) -> select();

        $all_encode = json_encode($result);

        $this -> assign('all_encode', $all_encode);
        $this -> assign('search',$get);
        $this -> display();
    }
       
    //搜索出库
    public function searchGoods2(){
        //获取搜索值
        $get = $_GET["table_id"];
        $where['name']=array('like','%'.$get.'%');
        $result = M("goods") -> where($where) -> select();

        $all_encode = json_encode($result);

        $this -> assign('all_encode', $all_encode);
        $this -> assign('search',$get);
        $this -> display();
    }

     //搜索报警
    public function searchWarning(){
        //获取搜索值
        $get = $_GET["table_id"];
        $where['name']=array('like','%'.$get.'%');
        $result = M("goods") -> where($where) -> select();

        $all_encode = json_encode($result);

        $this -> assign('all_encode', $all_encode);
        $this -> assign('search',$get);
        $this -> display();
    }
       
}