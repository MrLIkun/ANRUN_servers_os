<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function index(){
    	$this -> display();
    }		
    public function verifi(){
    	//获取用户名和密码
    	$username = $_POST['username'];
    	$password = $_POST['password'];
    			
    	//查询是否存在此用户
    	$res = M('alluser') -> where("username="."'".$username."'"." AND "."password="."'".$password."'") -> find();

    	if($res!= null){

    		//存入session
    		session('userid',$res['id']);

    		echo 1;
    	} else {
    		echo 0;
    	}
    }
    public function oschoose(){

    	$this -> display();
    }

    public function verifiAccess(){
    	//查询用户信息
    		$user = M('alluser') -> where('id = '.session('userid')) -> find();
    		//查询用户是否拥有进入系统的权限
    		if($user['cangku']){
    			echo 1;
    		} else {
    			echo 0;
    		}
    }

    //退出登录
    public function exit(){
    	session('userid', null);
    	redirect('/index.php');
    }
       
}