<?php
namespace Admin\Controller;
use Think\Controller;



class AdminController extends Controller{
	public function index(){
		if(empty($_SESSION)){
			$this->error('请先登录',U('Index/index'),3);
		}else{
		// 1.实例化Model类
    	$admin = M('lzsh_user');

    	// 使用数组条件进行分页查询(必须使用判断条件)
    	$wherelist = [];
    	if (!empty($_GET['username'])) {
    		$wherelist['username'] = array('like', "%{$_GET['username']}%");
    	}

    	// 2.实例化分页类
    	// 获取数据总条数(查询数据总条数的时候必须添加条件，否则查询所有数据总条数)
    	$total = $admin->where($wherelist)->count();
   		$page = new \Think\Page($total, 5);
   		$this->assign('show', $page->show());

    	// 2.查询
    	$data = $admin->where($wherelist)->page(I('get.p',1),5)->select();
		$this->assign('data1',$data);

		$this->display();
		}

	}

	public function add()
	{
		$this->display();
	}

	public function insert($username,$password)
	{
		$user=M('lzsh_user');                 
        $data['username']=$username;
		$data['password']=$password;
		$result = $user->add($data);
         if ($result) {
            $ver['ret'] = 1;
            $ver['data'] = $result;
            $this->ajaxReturn($ver);
        }
	}

	public function edit($id)
	{
		
		$admin = M('lzsh_user');
		
		$data = $admin->find($id);

		$this->assign('data',$data);

		$this->display();
	}

	public function update($username,$id,$password,$addtime){
		$user=M('lzsh_user');               
        $data['username']=$username;
		$data['password']=$password;
		$data['addtime']=$addtime;
		$result = $user->where(array('id'=>$id))->save($data);
         if ($result) {
            $ver['ret'] = 1;
            $ver['data'] = $result;
            // 如果主键是自动增长型 成功后返回值就是最新插入的值
            $this->ajaxReturn($ver);
        }

	}
	public function del($id)
	{
		
		$admin = M('lzsh_user');
		
		$res = $admin->delete($id);

		if($res){
			$this->success('删除用户成功',U('Admin/index'),3);
		}else{
			$this->error('删除用户失败',U('Admin/index'),3);
		}
	}
	
}