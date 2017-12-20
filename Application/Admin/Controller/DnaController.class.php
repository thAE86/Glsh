<?php
namespace Admin\Controller;
use Think\Controller;



class DnaController extends Controller{
	//商会动态增删改差
	public function dynamic(){
		// 1.实例化Model类
    	$dna = M('lzsh_dna');

    	// 使用数组条件进行分页查询(必须使用判断条件)
    	$wherelist =array();
    	
    	$wherelist['istatus'] = array('eq', "1");
    	

    	// 2.实例化分页类
    	// 获取数据总条数(查询数据总条数的时候必须添加条件，否则查询所有数据总条数)
    	$total = $dna->where($wherelist)->count();
   		$Page = new \Think\Page($total, 5);
   		$this->assign('show', $Page->show());

    	// 2.查询
    	$data = $dna->where($wherelist)->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('data',$data);

		$this->display();
	}
	public function dyadd(){
		$this->display();
	}
	public function dyinsert(){
		if($_FILES['pic']['name']==''){
			$dna = M('lzsh_dna');
			$res = $dna->create();

			if($res){
				$r = $dna->add();

				if($r){
					$this->success('添加成功',U('dna/dynamic'),3);
				}else{
					$this->error('添加失败',U('dna/dynamic'),3);
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

			$dna = M('lzsh_dna');

			$res = $dna->create();

			if($res){
				$r = $dna->add();

				if($r){
					$this->success('添加成功',U('dna/dynamic'),3);
				}else{
					$this->error('添加失败',U('dna/dynamic'),3);
				}
			}
		}

	}
	public function dyedit($id){
		$dna=M('lzsh_dna');
		$data=$dna->find($id);

		$this->assign('data',$data);
		$this->display();
	}
	public function dyupdate($id){
		if($_FILES['pic']['name']==''){
			$dna = M('lzsh_dna');
			$res = $dna->create();
			if($res){
				$r = $dna->save();

				if($r){
					$this->success('修改成功',U('dna/dynamic'),3);
				}else{
					$this->error('修改失败',U('dna/dyedit',array('id'=>$_POST['id'])),3);
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

			$dna = M('lzsh_dna');

			$res = $dna->create();

			if($res){
				$r = $dna->save();

				if($r){
					$this->success('修改成功',U('dna/dynamic'),3);
				}else{
					$this->error('修改失败',U('dna/dyedit',array('id'=>$_POST['id'])),3);
				}
			}
		}
		
	}
	public function details($id)
	{
		$dna=M('lzsh_dna');
		$data=$dna->find($id);

		$this->assign('data',$data);

		$this->display();
	}
	public function conup(){
		$dna=M('lzsh_dna');
		$data['content']=$_POST['content'];
		$data['id']=$_POST['id'];
		$result=$dna->save($data);
		if ($result) {
        
            $this->ajaxReturn('1');
        }
	}
	public function dydel($id)
	{
		$dna = M('lzsh_dna');
		
		$res = $dna->delete($id);

		if($res){
			$this->success('删除动态成功',U('dna/index'),3);
		}else{
			$this->error('删除动态失败',U('dna/index'),3);
		}
	}
	//公告通知增删改差
	public function notice(){
		// 1.实例化Model类
    	$dna = M('lzsh_dna');

    	// 使用数组条件进行分页查询(必须使用判断条件)
    	$wherelist =array();
    	
    	$wherelist['istatus'] = array('eq', "2");
    	

    	// 2.实例化分页类
    	// 获取数据总条数(查询数据总条数的时候必须添加条件，否则查询所有数据总条数)
    	$total = $dna->where($wherelist)->count();
   		$Page = new \Think\Page($total, 5);
   		$this->assign('show', $Page->show());

    	// 2.查询
    	$data = $dna->where($wherelist)->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('data',$data);

		$this->display();
	}
		public function noadd(){
		$this->display();
	}
	public function noinsert(){
		if($_FILES['pic']['name']==''){
			$dna = M('lzsh_dna');
			$res = $dna->create();
			
			if($res){
				$r = $dna->add();

				if($r){
					$this->success('添加成功',U('dna/notice'),3);
				}else{
					$this->error('添加失败',U('dna/notice'),3);
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

			$dna = M('lzsh_dna');

			$res = $dna->create();

			if($res){
				$r = $dna->add();

				if($r){
					$this->success('添加成功',U('dna/notice'),3);
				}else{
					$this->error('添加失败',U('dna/notice'),3);
				}
			}
		}

	}
	public function noedit($id){
		$dna=M('lzsh_dna');
		$data=$dna->find($id);

		$this->assign('data',$data);
		$this->display();
	}
	public function noupdate($id){
		if($_FILES['pic']['name']==''){
			$dna = M('lzsh_dna');
			$res = $dna->create();
			if($res){
				$r = $dna->save();

				if($r){
					$this->success('修改成功',U('dna/notice'),3);
				}else{
					$this->error('修改失败',U('dna/notice',array('id'=>$_POST['id'])),3);
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
			} 
	    	$_POST['pic']=$path;

			$dna = M('lzsh_dna');

			$res = $dna->create();

			if($res){
				$r = $dna->save();

				if($r){
					$this->success('修改成功',U('dna/notice'),3);
				}else{
					$this->error('修改失败',U('dna/notice',array('id'=>$_POST['id'])),3);
				}
			}
		}

	}
	public function nodetails($id)
	{
		$dna=M('lzsh_dna');
		$data=$dna->find($id);

		$this->assign('data',$data);
		$this->display();
	}
	public function noconup(){
		$dna=M('lzsh_dna');
		$data['content']=$_POST['content'];
		$data['id']=$_POST['id'];
		$result=$dna->save($data);
		if ($result) {
        
            $this->ajaxReturn('1');
        }
	}
	public function nodel($id)
	{
		$dna = M('lzsh_dna');
		
		$res = $dna->delete($id);

		if($res){
			$this->success('删除动态成功',U('dna/index'),3);
		}else{
			$this->error('删除动态失败',U('dna/index'),3);
		}
	}
	//活动热报增删改差
	public function active(){
		// 1.实例化Model类
    	$active = M('lzsh_active');

    	// 使用数组条件进行分页查询(必须使用判断条件)
    	$wherelist =array();
    	// 2.实例化分页类
    	// 获取数据总条数(查询数据总条数的时候必须添加条件，否则查询所有数据总条数)
    	$total = $active->where($wherelist)->count();
   		$Page = new \Think\Page($total, 5);
   		$this->assign('show', $Page->show());

    	// 2.查询
    	$data = $active->where($wherelist)->limit($Page->firstRow.','.$Page->listRows)->select();

		$this->assign('data',$data);

		$this->display();
	}
	public function acadd(){
		$this->display();
	}
	public function acinsert(){
		if($_FILES['pic']['name']==''){
			$active = M('lzsh_active');
			$res = $active->create();
			if($res){
				$r = $active->add();

				if($r){
					$this->success('添加成功',U('dna/active'),3);
				}else{
					$this->error('添加失败',U('dna/active'),3);
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

			$active = M('lzsh_active');

			$res = $active->create();

			if($res){
				$r = $active->add();

				if($r){
					$this->success('添加成功',U('dna/active'),3);
				}else{
					$this->error('添加失败',U('dna/active'),3);
				}
			}
		}

	}
		public function acedit($id){
		$active=M('lzsh_active');
		$data=$active->find($id);

		$this->assign('data',$data);
		$this->display();
	}
	public function acupdate($id){
		if($_FILES['pic']['name']==''){
			$active = M('lzsh_active');
			$res = $active->create();
			if($res){
				$r = $active->save();

				if($r){
					$this->success('修改成功',U('dna/active'),3);
				}else{
					$this->error('修改失败',U('dna/active',array('id'=>$_POST['id'])),3);
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
			} 
	    	$_POST['pic']=$path;

			$active = M('lzsh_active');

			$res = $active->create();

			if($res){
				$r = $active->save();

				if($r){
					$this->success('修改成功',U('dna/active'),3);
				}else{
					$this->error('修改失败',U('dna/active',array('id'=>$_POST['id'])),3);
				}
			}
		}

	}
	public function acdetail($id)
	{
		$active=M('lzsh_active');
		$data=$active->find($id);

		$this->assign('data',$data);
		$this->display();
	}
	public function acconup(){
		$active=M('lzsh_active');
		$data['content']=$_POST['content'];
		$data['id']=$_POST['id'];
		$result=$active->save($data);
		if ($result) {
        
            $this->ajaxReturn('1');
        }
	}
	public function acdel($id)
	{
		$active = M('lzsh_active');
		
		$res = $active->delete($id);

		if($res){
			$this->success('删除动态成功',U('dna/active'),3);
		}else{
			$this->error('删除动态失败',U('dna/active'),3);
		}
	}
}
?>