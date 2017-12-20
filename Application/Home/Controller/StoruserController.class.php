<?php
namespace Home\Controller;
use Think\Controller;
use Think\Page;

class StoruserController extends CommonController 
{	
	public function index($status){
		$storuser=M('lzsh_storuser');
		$w['status']=array('eq',$status);
				//分页
		$total = $storuser->where($w)->count();
   		$Page = new \Think\Page($total, 8);
   		$this->assign('show', $Page->show());

    	// 2.查询
    	$data = $storuser->where($w)->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('data',$data);
		$this->display();
	}
	public function detail($id){
		$storuser=M('lzsh_storuser');
		$data=$storuser->where(array('id'=>$id))->select();

		$this->assign('data',$data[0]);
		$this->display();
	}





}
?>