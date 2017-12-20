<?php
namespace Home\Controller;
use Think\Controller;
use Think\Page;

class SomeController extends CommonController 
{
	public function speech(){
		$some=M('lzsh_some');
    	// 2.查询
    	$data = $some->getField('speech');
		$this->assign('data',$data);
		$this->display();

		
	}
	public function purpose(){
		$some=M('lzsh_some');
    	// 2.查询
    	$data = $some->getField('purpose');
		$this->assign('data',$data);
		$this->display();

		
	}
	public function framework(){
		$some=M('lzsh_some');
    	// 2.查询
    	$data = $some->getField('framework');
		$this->assign('data',$data);
		$this->display();

		
	}





}
?>