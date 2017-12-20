<?php
namespace Home\Controller;
use Think\Controller;
use Think\Page;

class EstaController extends CommonController 
{
	public function index(){
		$esta=M('lzsh_esta');
		$data=$esta->select();
		//var_dump($data);
		
		$this->assign('data',$data);
		$this->display();

		
	}
	public function industry($pid){
		$esta=M('lzsh_esta');
		$w=array();
		$w['pid']=array('eq',$pid);
		//分页
		$total = $esta->where($w)->count();
   		$Page = new \Think\Page($total, 2);
   		$this->assign('show', $Page->show());

    	// 2.查询
    	$data = $esta->where($w)->limit($Page->firstRow.','.$Page->listRows)->select();
		
		$this->assign('data',$data);
		$this->display();

	}
	public function detail($id){
		$esta=M('lzsh_esta');
		$data=$esta->where(array('id'=>$id))->select();
		$this->assign('data',$data[0]);
		//var_dump($data);
		$arr=array();
		// $arr['present'=>$data['present'],'operation'=>$data['operation'],'phone'=>$data['phone']];
		$arr['content']=$data[0]['content'];
		$arr['operation']=$data[0]['operation'];
		$arr['phone']=$data[0]['phone'];
		$this->assign('arr',$arr);
		$this->display();
	}






}
?>