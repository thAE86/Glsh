<?php
namespace Admin\Controller;
use Think\Controller;

class CarouselController extends Controller{
	public function index(){
		//实例化轮播表
		$carousel = M('lzsh_carousel');
		//实例化分页表
		$page = new \Think\Page($carousel->count(),5);
		$page->setConfig('header','共 %TOTAL_ROW% 条记录');
		$page->setConfig('first','首页');
		$page->setConfig('last','末页');
		$page->setConfig('prev','上一页');
		$page->setConfig('next','下一页');
		$page->setConfig('theme',"共%TOTAL_ROW%条记录%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%");
		$this->assign('show',$page->show());
		
		$data = $carousel->page(I('get.p',1),5)->select();

		$this->assign('data',$data);

		$this->display();
	}

	public function add()
	{
		$this->display();
	}

	public function insert()
	{
		
		$config = array(
    		'rootPath' => 'Public/',
    		'savePath' => 'Uploads/'	
    	);
    	$upload = new \Think\Upload($config);

    	$info = $upload->uploadOne($_FILES['picname']);
    	
    	if ($info) {
    		
    		$img = new \Think\Image();
			
    		$path = './'.$info['savepath'].$info['savename'];
		} else {
    		
    		$this->error($upload->getError());
    	}

    	$_POST['picname']=$path;
    	
    	$carousel = M('lzsh_carousel');

		$data = $carousel->create();
	
		if($data){
			$res = $carousel->add();
			if($res){
				$this->success('添加图片成功',U('carousel/index'),3);
			}else{
				$this->error('添加图片失败',U('carousel/add'),3);
			}
		}
	}

	public function del($id)
	{
		$carousel = M('lzsh_carousel');
		
		$res = $carousel->delete($id);

		if($res){
			$this->success('删除图片成功',U('carousel/index'),3);
		}else{
			$this->error('删除图片成功',U('carousel/index'),3);
		}
	}
}