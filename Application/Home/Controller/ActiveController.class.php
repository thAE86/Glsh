<?php
namespace Home\Controller;
use Think\Controller;
use Think\Page;

class ActiveController extends CommonController 
{
	public function index(){
		$active=M('lzsh_active');
		
		
		//分页
		$total = $active->count();
   		$Page = new \Think\Page($total, 1);
   		$this->assign('show', $Page->show());

    	// 2.查询
    	$data = $active->where($w)->limit($Page->firstRow.','.$Page->listRows)->select();
		
		$this->assign('data',$data);
		$this->display();

		
	}
	public function detail($id){
		$active=M('lzsh_active');
		$data=$active->where(array('id'=>$id))->select();

		$this->assign('data',$data[0]);
		$this->display();
	}





}
?>