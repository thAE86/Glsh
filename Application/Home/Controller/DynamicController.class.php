<?php
namespace Home\Controller;
use Think\Controller;
use Think\Page;

class DynamicController extends CommonController 
{
	public function index(){
		$dna=M('lzsh_dna');
		$w=array();
		$w['istatus']=array('eq','1');
		$w['xstatus']=array('eq','1');
		//分页
		$total = $dna->where($w)->count();
   		$Page = new \Think\Page($total, 1);
   		$this->assign('show', $Page->show());

    	// 2.查询
    	$data = $dna->where($w)->limit($Page->firstRow.','.$Page->listRows)->select();
		
		$this->assign('data',$data);
		$this->display();

		
	}
	public function detail($id){
		$dna=M('lzsh_dna');
		$data=$dna->where(array('id'=>$id))->select();

		$this->assign('data',$data[0]);
		$this->display();
	}





}
?>