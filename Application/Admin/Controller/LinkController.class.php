<?php
namespace Admin\Controller;
use Think\Controller;

class LinkController extends Controller{
	public function index(){
		if(empty($_SESSION)){
			$this->error('请先登录',U('Index/index'),3);
		}else{
		// 1.实例化Model类
    	$link = M('lzsh_link');
    	// 2.实例化分页类
    	// 获取数据总条数(查询数据总条数的时候必须添加条件，否则查询所有数据总条数)
    	$total = $link->count();
   		$page = new \Think\Page($total, 10);
   		$this->assign('show', $page->show());

    	// 2.查询
    	$data = $link->page(I('get.p',1),10)->select();
		$this->assign('data',$data);

		$this->display();
		}

	}
	public function insert($linkname,$linkplace)
	{
		$link=M('lzsh_link');                 
        $data['linkname']=$linkname;
		$data['linkplace']=$linkplace;
		$result = $link->add($data);
        if ($result) {
            $ver['ret'] = 1;
            $ver['data'] = $result;
            $this->ajaxReturn($ver);
        }
	}
	public function update($linkname,$id,$linkplace){
		$link=M('lzsh_link');               
        $data['linkname']=$linkname;
		$data['linkplace']=$linkplace;
		$result = $link->where(array('id'=>$id))->save($data);
         if ($result) {
            $ver['ret'] = 1;
            $ver['data'] = $result;
            $this->ajaxReturn($ver);
        }

	}
	public function del($id)
	{
		
		$link = M('lzsh_link');
		
		$res = $link->delete($id);

		if($res){
			$this->success('删除用户成功',U('link/index'),3);
		}else{
			$this->error('删除用户失败',U('link/index'),3);
		}
	}
	
}