<?php
namespace Home\Controller;
use Think\Controller;


class WeController extends CommonController 
{
	public function index(){
		$we=M('lzsh_we');
    	$data = $we->select();	
		$this->assign('data',$data[0]);
		$this->display();

		
	}
	public function detail($id){
		$we=M('lzsh_we');
		$data=$we->where(array('id'=>$id))->select();

		$this->assign('data',$data[0]);
		$this->display();
	}





}
?>