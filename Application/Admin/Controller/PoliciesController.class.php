<?php
namespace Admin\Controller;
use Think\Controller;



class PoliciesController extends Controller{
	public function index(){
		// 1.实例化Model类
    	$policies = M('lzsh_atpo');

    	// 使用数组条件进行分页查询(必须使用判断条件)
    	$wherelist =array();	
    	$wherelist['status'] = array('eq', "2");
    	// 2.实例化分页类
    	// 获取数据总条数(查询数据总条数的时候必须添加条件，否则查询所有数据总条数)
    	$total = $policies->where($wherelist)->count();
   		$Page = new \Think\Page($total, 5);
   		$this->assign('show', $Page->show());

    	// 2.查询
    	$data = $policies->where($wherelist)->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('data',$data);

		$this->display();
	}
	public function add(){
		$this->display();
	}
	public function insert(){
		if($_FILES['pic']['name']==''){
			$policies = M('lzsh_atpo');
			$res = $policies->create();
			if($res){
				$r = $policies->add();

				if($r){
					$this->success('添加成功',U('policies/index'),3);
				}else{
					$this->error('添加失败',U('policies/index'),3);
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

			$policies = M('lzsh_atpo');

			$res = $policies->create();

			if($res){
				$r = $policies->add();

				if($r){
					$this->success('添加成功',U('policies/index'),3);
				}else{
					$this->error('添加失败',U('policies/index'),3);
				}
			}
		}
	}
	public function edit($id){
		$policies=M('lzsh_atpo');
		$data=$policies->find($id);

		$this->assign('data',$data);
		$this->display();
	}
	public function update($id){
		if($_FILES['pic']['name']==''){
			$policies = M('lzsh_atpo');
			$res = $policies->create();
			if($res){
				$r = $policies->save();

				if($r){
					$this->success('修改成功',U('policies/index'),3);
				}else{
					$this->error('修改失败',U('policies/index'),3);
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

			$policies = M('lzsh_atpo');

			$res = $policies->create();

			if($res){
				$r = $policies->save();

				if($r){
					$this->success('修改成功',U('policies/index'),3);
				}else{
					$this->error('修改失败',U('policies/index'),3);
				}
			}
		}
		
	}
	public function details($id)
	{
		$policies=M('lzsh_atpo');
		$data=$policies->find($id);

		$this->assign('data',$data);
		$this->display();
	}
	public function conup(){
		$policies=M('lzsh_atpo');
		$data['content']=$_POST['content'];
		$data['id']=$_POST['id'];
		$result=$policies->save($data);
		if ($result) {
        
            $this->ajaxReturn('1');
        }
	}
	public function del($id)
	{
		$policies = M('lzsh_atpo');
		
		$res = $policies->delete($id);

		if($res){
			$this->success('删除动态成功',U('policies/index'),3);
		}else{
			$this->error('删除动态失败',U('policies/index'),3);
		}
	}

}
?>