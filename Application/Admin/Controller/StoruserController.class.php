<?php
namespace Admin\Controller;
use Think\Controller;



class StoruserController extends Controller{
	//建筑企业增删改差
	public function index(){
    	$storuser = M('lzsh_storuser');
    	// 使用数组条件进行分页查询(必须使用判断条件)
    	$wherelist =array();
    	// 2.实例化分页类
    	// 获取数据总条数(查询数据总条数的时候必须添加条件，否则查询所有数据总条数)
    	$total = $storuser->where($wherelist)->count();
   		$Page = new \Think\Page($total, 6);
   		$this->assign('show', $Page->show());

    	// 2.查询
    	$data = $storuser->where($wherelist)->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('data',$data);

		$this->display();
	}
	public function add(){
		$this->display();
	}
	public function insert(){
			$config = array(
	    		'rootPath' => 'Public/',
	    		'savePath' => 'Uploads/'	
	    	);
	    	$upload = new \Think\Upload($config);
	    	$info = $upload->uploadOne($_FILES['pic']);
	    	if ($info) {
	    		
	    		$img = new \Think\Image();
				
	    		$path = '/'.$info['savepath'].$info['savename'];
			} 

	    	$_POST['pic']=$path;

			$storuser = M('lzsh_storuser');

			$res = $storuser->create();

			if($res){
				$r = $storuser->add();
				
				if($r){
					$this->success('添加成功',U('storuser/index'),3);
				}else{
					$this->error('添加失败',U('storuser/index'),3);
				}
			}
		
	}
	public function edit($id){
		$storuser=M('lzsh_storuser');
		$data=$storuser->find($id);

		$this->assign('data',$data);
		$this->display();
	}

	public function update($id){
		if($_FILES['pic']['name']==''){
			$storuser = M('lzsh_storuser');
			$res = $storuser->create();
			if($res){
				$r = $storuser->save();

				if($r){
					$this->success('修改成功',U('storuser/index'),3);
				}else{
					$this->error('修改失败',U('storuser/index'),3);
				}
			}
		}else{
			$config = array(
	    		'rootPath' => 'Public/',
	    		'savePath' => 'Uploads/'	
	    	);
	    	$upload = new \Think\Upload($config);
	    	$info = $upload->uploadOne($_FILES['pic']);
	    	if ($info) {
	    		
	    		$img = new \Think\Image();
				
	    		$path = '/'.$info['savepath'].$info['savename'];
			} else {
	    		
	    		$this->error($upload->getError());
	    	}

	    	$_POST['pic']=$path;

			$storuser = M('lzsh_storuser');

			$res = $storuser->create();

			if($res){
				$r = $storuser->save();

				if($r){
					$this->success('修改成功',U('storuser/index'),3);
				}else{
					$this->error('修改失败',U('storuser/index'),3);
				}
			}
		}
		
	}

	public function del($id)
	{
		$storuser = M('lzsh_storuser');
		
		$res = $storuser->delete($id);

		if($res){
			$this->success('删除成功',U('storuser/index'),3);
		}else{
			$this->error('删除失败',U('storuser/index'),3);
		}
	}
	public function synopsis($id)
	{
		$storuser=M('lzsh_storuser');
		$data=$storuser->find($id);

		$this->assign('data',$data);
		$this->display();
	}
	public function conup(){
		$storuser=M('lzsh_storuser');
		$data['synopsis']=$_POST['synopsis'];
		$data['id']=$_POST['id'];
		$result=$storuser->save($data);
		if ($result) {
        
            $this->ajaxReturn('1');
        }
	}
	public function team(){
		$teampic=M('lzsh_teampic');
		$data=$teampic->select();
		$this->assign('data',$data);
		$this->display();
	}
	public function tedit($id){
		$teampic=M('lzsh_teampic');
		$data=$teampic->find($id);

		$this->assign('data',$data);
		$this->display();
	}
	public function tupdate($id){

			$config = array(
	    		'rootPath' => 'Public/',
	    		'savePath' => 'Uploads/'	
	    	);
	    	$upload = new \Think\Upload($config);
	    	$info = $upload->uploadOne($_FILES['pic']);
	    	if ($info) {
	    		
	    		$img = new \Think\Image();
				
	    		$path = '/'.$info['savepath'].$info['savename'];
			} else {
	    		
	    		$this->error($upload->getError());
	    	}

	    	$_POST['pic']=$path;

			$teampic = M('lzsh_teampic');

			$res = $teampic->create();

			if($res){
				$r = $teampic->save();

				if($r){
					$this->success('修改成功',U('storuser/team'),3);
				}else{
					$this->error('修改失败',U('storuser/team'),3);
				}
			}
		
	}
	
}
?>