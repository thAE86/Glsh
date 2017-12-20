<?php
namespace Home\Controller;
use Think\Controller;



class DownlController extends CommonController {
	public function index(){
		// 1.实例化Model类
    	$file = M('lzsh_file');
    	// 2.实例化分页类
    	// 获取数据总条数(查询数据总条数的时候必须添加条件，否则查询所有数据总条数)
    	$total = $file->count();
   		$Page = new \Think\Page($total, 5);
   		$this->assign('show', $Page->show());

    	// 2.查询
    	$data = $file->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('data',$data);
		$this->display();
	}
	public function down($id){
		$file=M('lzsh_file');
		$docurl=$file->where(array('id'=>$id))->getField('docurl');
		$file_url='./Public'.$docurl;
		if(is_file($file_url)){
			$length = filesize($file_url);
            $type = mime_content_type($file_url);
            $showname =  ltrim(strrchr($file_url,'/'),'/');
            header("Content-Description: File Transfer");
            header('Content-type: ' . $type);
            header('Content-Length:' . $length);
            if (preg_match('/MSIE/', $_SERVER['HTTP_USER_AGENT'])) { //for IE
                header('Content-Disposition: attachment; filename="' . rawurlencode($showname) . '"');
            } else {
                header('Content-Disposition: attachment; filename="' . $showname . '"');
            }
            readfile($file_url);
        } else {
            $this->error('源文件不存在！');
        }
	}






}
	