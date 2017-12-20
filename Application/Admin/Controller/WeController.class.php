<?php
namespace Admin\Controller;
use Think\Controller;



class WeController extends Controller{
	public function index(){
		$we = M('lzsh_we');
    	// 使用数组条件进行分页查询(必须使用判断条件)
    	// 2.查询
    	$data = $we->select();
		$this->assign('data',$data[0]);

		$this->display();
		
	}

	public function update(){
		$we = M('lzsh_we');
		$config = array(
	    		'rootPath' => 'Public/',
	    		'savePath' => 'Uploads/'	
	    	);
		$upload = new \Think\Upload($config);
		if($_FILES['respic']['name']=='' && $_FILES['cocpic']['name']==''){
			$res = $we->create();
		}else if($_FILES['respic']['name']==''){
	    	$cinfo= $upload->uploadOne($_FILES['cocpic']);
	    	if ($cinfo) {
	    		$cpath='/'.$cinfo['savepath'].$cinfo['savename'];
			} 
	    	$_POST['cocpic']=$cpath;
			$res = $we->create();	
		}else if($_FILES['cocpic']['name']==''){
			$info= $upload->uploadOne($_FILES['respic']);
	    	if ($info) {
	    		$path='/'.$info['savepath'].$info['savename'];
			} 
	    	$_POST['respic']=$path;
			$res = $we->create();
		} else{
	    	$info = $upload->uploadOne($_FILES['respic']);
	    	$cinfo= $upload->uploadOne($_FILES['cocpic']);
	    	if ($info) {
				
	    		$path = '/'.$info['savepath'].$info['savename'];
	    		$cpath='/'.$cinfo['savepath'].$cinfo['savename'];
			} 
	    	$_POST['respic']=$path;
	    	$_POST['cocpic']=$cpath;
			$res = $we->create();	
		}
		$res['content']=$_POST['content'];
		if($res){
				$r = $we->save($res);

				if($r){
					$this->success('修改成功',U('we/index'),3);
				}else{
					$this->error('修改失败',U('we/index'),3);
				}
			}

		
	}
	public function conup(){
		$we=M('lzsh_we');
		$data['content']=$_POST['content'];
		$data['id']=$_POST['id'];
		$data['cocopic']=$_POST['cocpic'];
		$data['respic']=$_POST['respic'];
		$data['addres']=$_POST['addres'];
		$data['phone']=$_POST['phone'];
		$data['email']=$_POST['email'];
		$result=$esta->save($data);
		if ($result) {
        
            $this->ajaxReturn('1');
        }
	}
	

}