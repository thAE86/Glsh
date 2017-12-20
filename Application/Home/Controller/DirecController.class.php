<?php
namespace Home\Controller;
use Think\Controller;
use Think\Page;

class DirecController extends CommonController 
{
	public function index(){
		$director=M('lzsh_director');
		$w=array();
		$w['pstatus']=array('eq','1');
		//分页
		$total = $director->where($w)->count();
   		$Page = new \Think\Page($total, 1);
   		$this->assign('show', $Page->show());

    	// 2.查询
    	$data = $director->where($w)->limit($Page->firstRow.','.$Page->listRows)->select();
		
		$this->assign('data',$data);
		$this->display();

		
	}
	public function detail($id){
		$director=M('lzsh_director');
		$data=$director->where(array('id'=>$id))->select();
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