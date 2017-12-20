<?php
namespace Admin\Controller;
use Think\Controller;



class AttractController extends Controller{
	public function index(){
		// 1.实例化Model类
    	$attract = M('lzsh_atpo');

    	// 使用数组条件进行分页查询(必须使用判断条件)
    	$wherelist =array();	
    	$wherelist['status'] = array('eq', "1");
    	// 2.实例化分页类
    	// 获取数据总条数(查询数据总条数的时候必须添加条件，否则查询所有数据总条数)
    	$total = $attract->where($wherelist)->count();
   		$Page = new \Think\Page($total, 5);
   		$this->assign('show', $Page->show());

    	// 2.查询
    	$data = $attract->where($wherelist)->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('data',$data);

		$this->display();
	}
	public function add(){
		$this->display();
	}
	public function insert(){
		if($_FILES['pic']['name']==''){
			$attract = M('lzsh_atpo');
			$res = $attract->create();
			if($res){
				$r = $attract->add();

				if($r){
					$this->success('添加成功',U('attract/index'),3);
				}else{
					$this->error('添加失败',U('attract/index'),3);
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

			$attract = M('lzsh_atpo');

			$res = $attract->create();

			if($res){
				$r = $attract->add();

				if($r){
					$this->success('添加成功',U('attract/index'),3);
				}else{
					$this->error('添加失败',U('attract/index'),3);
				}
			}
		}
	}
	public function edit($id){
		$attract=M('lzsh_atpo');
		$data=$attract->find($id);

		$this->assign('data',$data);
		$this->display();
	}
	public function update($id){
		if($_FILES['pic']['name']==''){
			$attract = M('lzsh_atpo');
			$res = $attract->create();
			if($res){
				$r = $attract->save();

				if($r){
					$this->success('修改成功',U('attract/index'),3);
				}else{
					$this->error('修改失败',U('attract/index'),3);
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

			$attract = M('lzsh_atpo');

			$res = $attract->create();

			if($res){
				$r = $attract->save();

				if($r){
					$this->success('修改成功',U('attract/index'),3);
				}else{
					$this->error('修改失败',U('attract/index'),3);
				}
			}
		}
		
	}
	public function details($id)
	{
		$attract=M('lzsh_atpo');
		$data=$attract->find($id);

		$this->assign('data',$data);
		$this->display();
	}
	public function conup(){
		$attract=M('lzsh_atpo');
		$data['content']=$_POST['content'];
		$data['id']=$_POST['id'];
		$result=$attract->save($data);
		if ($result) {
        
            $this->ajaxReturn('1');
        }
	}
	public function del($id)
	{
		$attract = M('lzsh_atpo');
		
		$res = $attract->delete($id);

		if($res){
			$this->success('删除动态成功',U('attract/index'),3);
		}else{
			$this->error('删除动态失败',U('attract/index'),3);
		}
	}

}
?>