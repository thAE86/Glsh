<?php
namespace Admin\Controller;
use Think\Controller;



class NewsController extends Controller{
	public function index(){
    	$news = M('lzsh_news');
    	// 使用数组条件进行分页查询(必须使用判断条件)
    	$wherelist =array();
    	// 2.实例化分页类
    	// 获取数据总条数(查询数据总条数的时候必须添加条件，否则查询所有数据总条数)
    	$total = $news->where($wherelist)->count();
   		$Page = new \Think\Page($total, 10);
   		$this->assign('show', $Page->show());

    	// 2.查询
    	$data = $news->where($wherelist)->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('data',$data);

		$this->display();
	}
	public function add(){
		$this->display();
	}
	public function insert(){
		$news=M('lzsh_news');
		$data['news_content']=$_POST['content'];
		$data['news_title']=$_POST['title'];
		$data['news_time']=$_POST['time'];
		$data['news_show']=$_POST['show'];
		$result=$news->add($data);
		if ($result) {
        
            $this->ajaxReturn($result);
        }
	}
	public function text($id){
		$news=M('lzsh_news');
		$data=$news->find($id);

		$this->assign('data',$data);
		$this->display();
	}
	public function textup(){
		$news=M('lzsh_news');
		$data['news_content']=$_POST['content'];
		$data['id']=$_POST['id'];
		$result=$news->save($data);
		if ($result) {
        
            $this->ajaxReturn('1');
        }
	}
	public function update($id,$news_title,$news_time,$news_show){
		$news=M('lzsh_news');               
        $data['news_title']=$news_title;
		$data['news_time']=$news_time;
		$data['news_show']=$news_show;
		$result = $news->where(array('id'=>$id))->save($data);
         if ($result) {
            $ver['ret'] = 1;
            $ver['data'] = $result;
            // 如果主键是自动增长型 成功后返回值就是最新插入的值
            $this->ajaxReturn($ver);
        }

	}
	public function del($id){
		$news = M('lzsh_news');
		
		$res = $news->delete($id);

		if($res){
			$this->success('删除成功',U('News/index'),3);
		}else{
			$this->error('删除失败',U('News/index'),3);
		}
	}
}
?>