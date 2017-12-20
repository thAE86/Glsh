<?php
namespace Admin\Controller;
use Think\Controller;



class DirectorController extends Controller{
	//建筑企业增删改差
	public function index(){
    	$director = M('lzsh_director');
    	// 使用数组条件进行分页查询(必须使用判断条件)
    	$wherelist =array();
    	// 2.实例化分页类
    	// 获取数据总条数(查询数据总条数的时候必须添加条件，否则查询所有数据总条数)
    	$total = $director->where($wherelist)->count();
   		$Page = new \Think\Page($total, 6);
   		$this->assign('show', $Page->show());

    	// 2.查询
    	$data = $director->where($wherelist)->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('data',$data);

		$this->display();
	}
	public function add(){
		$this->display();
	}
	public function insert(){
		if($_FILES['pic']['name']==''){
			$director = M('lzsh_director');
			$res = $director->create();
			if($res){
				$r =$director->add();
				if($r){
					$this->success('添加成功',U('director/index'),3);
				}else{
					$this->error('添加失败',U('director/index'),3);
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

			$director = M('lzsh_director');

			$res = $director->create();

			if($res){
				$r = $director->add();
				
				if($r){
					$this->success('添加成功',U('director/index'),3);
				}else{
					$this->error('添加失败',U('director/index'),3);
				}
			}
		}
	}
	public function edit($id){
		$director=M('lzsh_director');
		$data=$director->find($id);

		$this->assign('data',$data);
		$this->display();
	}

	public function update($id){
		if($_FILES['pic']['name']==''){
			$director = M('lzsh_director');
			$res = $director->create();
			if($res){
				$r = $director->save();

				if($r){
					$this->success('修改成功',U('director/index'),3);
				}else{
					$this->error('修改失败',U('director/index'),3);
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

			$director = M('lzsh_director');

			$res = $director->create();

			if($res){
				$r = $director->save();

				if($r){
					$this->success('修改成功',U('director/index'),3);
				}else{
					$this->error('修改失败',U('director/index'),3);
				}
			}
		}
		
	}
	public function operation($id)
	{
		$director=M('lzsh_director');
		$data=$director->find($id);

		$this->assign('data',$data);
		$this->display();
	}

	public function preup(){
		$director=M('lzsh_director');
		$data['present']=$_POST['present'];
		$data['id']=$_POST['id'];
		$result=$director->save($data);
		if ($result) {
        
            $this->ajaxReturn('1');
        }
	}
	public function content($id)
	{
		$director=M('lzsh_director');
		$data=$director->find($id);

		$this->assign('data',$data);
		$this->display();
	}
	public function conup(){
		$director=M('lzsh_director');
		$data['content']=$_POST['content'];
		$data['id']=$_POST['id'];
		$result=$director->save($data);
		if ($result) {
        
            $this->ajaxReturn('1');
        }
	}
	public function del($id)
	{
		$director = M('lzsh_director');
		
		$res = $director->delete($id);

		if($res){
			$this->success('删除成功',U('director/index'),3);
		}else{
			$this->error('删除失败',U('director/index'),3);
		}
	}
	
}
?>