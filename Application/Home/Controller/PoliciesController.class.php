<?php
namespace Home\Controller;
use Think\Controller;
use Think\Page;

class PoliciesController extends CommonController 
{
	public function index(){
		$policies=M('lzsh_atpo');
		$w=array();
		$w['status']=array('eq','2');
		//分页
		$total = $policies->where($w)->count();
   		$Page = new \Think\Page($total, 1);
   		$this->assign('show', $Page->show());

    	// 2.查询
    	$data = $policies->where($w)->limit($Page->firstRow.','.$Page->listRows)->select();
		
		$this->assign('data',$data);
		$this->display();

		
	}
	public function detail($id){
		$policies=M('lzsh_atpo');
		$data=$policies->where(array('id'=>$id))->select();

		$this->assign('data',$data[0]);
		$this->display();
	}





}
?>