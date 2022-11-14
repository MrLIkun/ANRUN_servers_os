<?php
namespace Home\Controller;
use Think\Controller;
class UpdateController extends Controller {
    public function index(){

    	$arr = array(
    				"table_id"=>$_GET['table_id'],
    				"name"=> $_GET['name'],
    				"norms"=> $_GET['norms'],
                    "unit"=> $_GET['unit'],
    				"numbers"=>$_GET['numbers'],
    				"type"=> $_GET['type'],
    				"change_time"=> strtotime(date("Y-m-d H:i:s")),
    				"remark"=> $_GET['remark']
    			);
    	
    	$result = M('goods') -> save($arr);

    	if($result){
    		echo true;
    	} else {
    		echo false;
    	}
    }
}