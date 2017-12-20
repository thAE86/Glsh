<?php
namespace Home\Controller;
use Think\Controller;
use Think\Page;

class AttractController extends CommonController 
{
	public function index(){
		$attract=M('lzsh_atpo');
		$w=array();
		$w['status']=array('eq','1');
		//分页
		$total = $attract->where($w)->count();
   		$Page = new \Think\Page($total, 1);
   		$this->assign('show', $Page->show());

    	// 2.查询
    	$data = $attract->where($w)->limit($Page->firstRow.','.$Page->listRows)->select();
		
		$this->assign('data',$data);
		$this->display();

		
	}
	public function detail($id){
		$attract=M('lzsh_atpo');
		$data=$attract->where(array('id'=>$id))->select();

		$this->assign('data',$data[0]);
		$this->display();
	}





}
?>