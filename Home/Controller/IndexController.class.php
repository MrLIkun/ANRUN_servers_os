<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	
    	if(session('userid')){
    		//查询用户信息
    		$user = M('alluser') -> where('id = '.session('userid')) -> find();

    		$this -> assign('user', $user);
			$this -> display();
    	} else {
    		redirect("/index.php/home/login");
    	}
    	
    }
       
}