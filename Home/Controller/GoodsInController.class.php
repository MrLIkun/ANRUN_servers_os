<?php
namespace Home\Controller;
use Think\Controller;
class GoodsInController extends Controller {
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


    public function in(){
        $in_people =  M("alluser") -> where("id=".session("userid")) -> find()["username"];
    	//搜索要入库的这个物品
    	$in = M('goods') -> where("table_id=".$_GET['table_id']) -> find();

    
    	//将数量更改更新到数据库
    	$arr = array(
    				"table_id"=>$_GET['table_id'],
    				"name"=> $_GET['name'],
    				"goods_id"=> $_GET['goods_id'],
    				"norms"=> $_GET['norms'],
    				"numbers"=>$in["numbers"]+$_GET['numbers'],
                    "unit"=>$_GET['unit'],
    				"type"=> $_GET['type'],
    				"remark"=> $_GET['remark']
    			);
    	//更新到入库记录
    	$arrIn = array(
                    "images"=>$in["images"],
                    "goods_id"=> $_GET['goods_id'],
    				"name"=> $_GET['name'],
    				"norms"=> $_GET['norms'],
    				"numbers"=>$_GET['numbers'],
                    "unit"=>$_GET['unit'],
    				"type"=> $_GET['type'],
    				"change_time"=> strtotime(date("Y-m-d H:i:s")),
    				"remark"=> $_GET['remark'],
                    'in_people' => $in_people
    			);
        
   
    	M('goods_in') -> add($arrIn);

    

    	//将入库结构更新到物品表
    	$result = M('goods') -> save($arr);
    	if($result){
    		echo true;
    	} else {
    		echo false;
    	}
    }


    //上传图片
    public function upload(){

        
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Public/image/'; // 设置附件上传根目录
        $upload->autoSub   =   false;
        $upload->hash      =   false;
        $upload->saveNmae  = 'time';
       
        $info   =   $upload->upload();    

        if(!$info) {// 上传错误提示错误信息
            return 0;
        }else{// 上传成功
                //将所有数据写入数据库
            $in_people =  M("alluser") -> where("id=".session("userid")) -> find()["username"];
            $arr1["images"]='<img src="/Public/image/'.$info['photo']['savename'].'" width="30">';
            $arr1["name"]= $_POST['name'];
            $arr1["goods_id"]= intval($_POST['goods_id']);
            $arr1["norms"]= $_POST['norms'];
            $arr1["numbers"]= intval($_POST['numbers']);
            $arr1["unit"] = $_POST['unit'];
            $arr1["type"]= $_POST['type'];
            $arr1["change_time"]= strtotime(date("Y-m-d H:i:s"));
            $arr1["remark"]= $_POST['remark'];
            $arr1['in_people'] = $in_people;

            $res = M('goods') -> add($arr1); 
           ;
            $arr2 = array(
                "images"=>'<img src="/Public/image/'.$info['photo']['savename'].'" width="30">',
                "name"=> $_POST['name'],
                "goods_id"=> intval($_POST['goods_id']),
                "norms"=> $_POST['norms'],
                "numbers"=> intval($_POST['numbers']),
                "unit" => $_POST['unit'],
                "type"=> $_POST['type'],
                "change_time"=> strtotime(date("Y-m-d H:i:s")),
                "remark"=> $_POST['remark'],
                'in_people' => $in_people
            );
             $res = M('goods_in') -> add($arr2); 
 
            if($res){
                echo  1;
            }else {
                echo  0;
            }
            
        }
    }


    public  function  inRec(){
        //判断是否有搜索值传入
        if($_GET){
            //获取搜索值
            $get = $_GET["id"];
            $where['name']=array('like','%'.$get.'%');
            $all_encode = json_encode(M("goods_in") -> where($where) -> select());
    
            $this -> assign('all_encode', $all_encode);
            $this -> assign('search',$get);
            $this -> display();
        } else{

            $all = M("goods_in") -> order('change_time desc') ->  select();
            $all_encode = json_encode($all);
            //遍历表
            $this -> assign('all_encode', $all_encode);
            $this -> display();

        }
    }

}