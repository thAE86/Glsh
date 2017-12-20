<?php
namespace Admin\Controller;
use Think\Controller;



class EstaController extends Controller{
	//建筑企业增删改差
	public function arcesta(){
    	$esta = M('lzsh_esta');
    	// 使用数组条件进行分页查询(必须使用判断条件)
    	$wherelist =array();
    	// 2.实例化分页类
    	// 获取数据总条数(查询数据总条数的时候必须添加条件，否则查询所有数据总条数)
    	$total = $esta->where($wherelist)->count();
   		$Page = new \Think\Page($total, 6);
   		$this->assign('show', $Page->show());

    	// 2.查询
    	$data = $esta->where($wherelist)->order('pid')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('data',$data);

		$this->display();
	}
	public function arcadd(){
		$this->display();
	}
	public function arcinsert(){
		$esta = M('lzsh_esta');
		if($_FILES['pic']['name']==''){
			$res = $esta->create();
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
			$res = $esta->create();
		}
		if($res){
			$r = $esta->add();
			
			if($r){
				$this->success('添加成功',U('esta/arcesta'),3);
			}else{
				$this->error('添加失败',U('esta/arcesta'),3);
			}
		}
	}
	public function arcedit($id){
		$esta=M('lzsh_esta');
		$data=$esta->find($id);

		$this->assign('data',$data);
		$this->display();
	}

	public function arcupdate($id){
		if($_FILES['pic']['name']==''){
			$esta = M('lzsh_esta');
			$res = $esta->create();
			if($res){
				$r = $esta->save();

				if($r){
					$this->success('修改成功',U('esta/arcesta'),3);
				}else{
					$this->error('修改失败',U('esta/arcesta'),3);
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
	    		$path = '/'.$info['savepath'].$info['savename'];
	    		$file='./Public'.$path;
		    	$filename=rand(0,1000).'.'.$info['ext'];
		    	$filepath='./Public/'.$info['savepath'];
		    	$image = new \Think\Image(); 
				$image->open($file)->water('./logo.png')->save($filepath.$filename);
			} else {
	    		
	    		$this->error($upload->getError());
	    	}
	    	
	    	$_POST['pic']='/'.$info['savepath'].$filename;
			
			$esta = M('lzsh_esta');

			$res = $esta->create();

			if($res){
				$r = $esta->save();

				if($r){
					$this->success('修改成功',U('esta/arcesta'),3);
				}else{
					$this->error('修改失败',U('esta/arcesta'),3);
				}
			}
		}
		
	}
	public function arcpre($id)
	{
		$esta=M('lzsh_esta');
		$data=$esta->find($id);

		$this->assign('data',$data);
		$this->display();
	}

	public function preup(){
		$esta=M('lzsh_esta');
		$data['present']=$_POST['present'];
		$data['id']=$_POST['id'];
		$result=$esta->save($data);
		if ($result) {
        
            $this->ajaxReturn('1');
        }
	}
	public function arccon($id)
	{
		$esta=M('lzsh_esta');
		$data=$esta->find($id);

		$this->assign('data',$data);
		$this->display();
	}
	public function conup(){
		$esta=M('lzsh_esta');
		$data['content']=$_POST['content'];
		$data['id']=$_POST['id'];
		$result=$esta->save($data);
		if ($result) {
        
            $this->ajaxReturn('1');
        }
	}
	public function arcdel($id)
	{
		$esta = M('lzsh_esta');
		
		$res = $esta->delete($id);

		if($res){
			$this->success('删除成功',U('esta/arcesta'),3);
		}else{
			$this->error('删除失败',U('esta/arcesta'),3);
		}
	}
	
}
?>