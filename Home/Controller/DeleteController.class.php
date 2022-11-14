<?php
namespace Home\Controller;
use Think\Controller;
class DeleteController extends Controller {
    public function index(){

    	//获取搜索值
    	$get = $_GET["table_id"];

    	$result = M("goods") -> where("table_id=".$get) -> delete();
		if($result){
			echo 1;
		} else {
			echo 0;
		}

    }
       
}