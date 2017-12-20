<?php
namespace Admin\Controller;
use Think\Controller;



class SomeController extends Controller{
	public function index(){
		$some = M('lzsh_some');
    	// 使用数组条件进行分页查询(必须使用判断条件)
    	// 2.查询
    	$data = $some->getField('speech');
    	
		$this->assign('data',$data);
		$this->display();
		
	}
	public function sconup(){
		$some=M('lzsh_some');
		$data['speech']=$_POST['speech'];
		$data['id']=$_POST['id'];
		$result=$some->save($data);
		if ($result) {
            $this->ajaxReturn('1');
        }
	}
	public function purpose(){
		$some = M('lzsh_some');
    	// 使用数组条件进行分页查询(必须使用判断条件)
    	// 2.查询
    	$data = $some->getField('purpose');
    	
		$this->assign('data',$data);
		$this->display();
		
	}
	public function pconup(){
		$some=M('lzsh_some');
		$data['purpose']=$_POST['purpose'];
		$data['id']=$_POST['id'];
		$result=$some->save($data);
		if ($result) {
        
            $this->ajaxReturn('1');
        }
	}
	public function framework(){
		$some = M('lzsh_some');
    	// 使用数组条件进行分页查询(必须使用判断条件)
    	// 2.查询
    	$data = $some->getField('framework');
    	
		$this->assign('data',$data);
		$this->display();
		
	}
	public function fconup(){
		$some=M('lzsh_some');
		$data['framework']=$_POST['framework'];
		$data['id']=$_POST['id'];
		$result=$some->save($data);
		if ($result) {
        
            $this->ajaxReturn('1');
        }
	}

	


}