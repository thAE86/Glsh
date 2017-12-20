<?php
namespace Admin\Controller;
use Think\Controller;



class DownlController extends Controller{
	public function index(){
		// 1.实例化Model类
    	$file = M('lzsh_file');
    	// 2.实例化分页类
    	// 获取数据总条数(查询数据总条数的时候必须添加条件，否则查询所有数据总条数)
    	$total = $file->where($wherelist)->count();
   		$Page = new \Think\Page($total, 5);
   		$this->assign('show', $Page->show());

    	// 2.查询
    	$data = $file->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('data',$data);

		$this->display();
	}
	public function add(){
		$this->display();
	}
	public function insert(){
		
		$upload = new \Think\Upload();// 实例化上传类
		$upload->exts=array('jpg', 'gif', 'png', 'jpeg','xls','xlsx','doc','txt','zip','rar','7z','pdf');// 设置附件上传类型
	    $upload->rootPath='Public/'; // 设置附件上传根目录
	    $upload->savePath='Uploads/'; // 设置附件上传（子）目录
	     // 上传文件
	    $info= $upload->upload();
	   	if($info){
	    	$path = './'.$info['docurl']['savepath'].$info['docurl']['savename'];
	    }
	    if($info['docurl']['ext']=='doc'){
	    	$_POST['status']='1';
	    }elseif($info['docurl']['ext']=='pdf'){
	    	$_POST['status']='2';
	    }
	    
	    $_POST['docurl']=$path;
	    $file=M('lzsh_file');
	    $res = $file->create();
	    if($res){
	    	$r=$file->add();
	    	if($r){
					$this->success('上传成功',U('Downl/index'),3);
				}else{
					$this->error('上传失败',U('Downl/index'),3);
				}
	    }

	}
	public function edit($id){
		$file=M('lzsh_file');
		$data=$file->find($id);
		$this->assign('data',$data);
		$this->display();

	}
	public function update(){

		if($_FILES['docurl']['name']==''){
			$file = M('lzsh_file');
			$res = $file->create();
			if($res){
				$r = $file->save();
				if($r){
					$this->success('修改成功',U('Downl/index'),3);
				}else{
					$this->error('修改失败',U('downl/index'),3);
				}
			}
		}else{
			$config = array(
	    		'rootPath' => 'Public/',
	    		'savePath' => 'Uploads/',
	    		'exts'=>array('jpg', 'gif', 'png', 'jpeg','xls','xlsx','doc','txt','zip','rar','7z','pdf')
	    	);
	    	$upload = new \Think\Upload($config);
	    	$info = $upload->upload();
	    	if($info){
	    		$path = './'.$info['docurl']['savepath'].$info['docurl']['savename'];
		    }
		    if($info['docurl']['ext']=='doc'){
		    	$_POST['status']='1';
		    }elseif($info['docurl']['ext']=='pdf'){
		    	$_POST['status']='2';
		    }
		    
		    $_POST['docurl']=$path;
		    $file=M('lzsh_file');
		    $res = $file->create();
		    if($res){
		    	$r=$file->save();
		    	if($r){
						$this->success('修改成功',U('Downl/index'),3);
					}else{
						$this->error('修改失败',U('Downl/index'),3);
					}
		    }

		}
	}
	public function del($id)
	{
		$file = M('lzsh_file');
		
		$res = $file->delete($id);

		if($res){
			$this->success('删除成功',U('Downl/index'),3);
		}else{
			$this->error('删除失败',U('Downl/index'),3);
		}
	}








}
	