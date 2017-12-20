<?php
namespace Admin\Controller;
use Think\Controller;



class NavigaController extends Controller{
	//一级导航
	public function index(){
		if(empty($_SESSION)){
			$this->error('请先登录',U('Index/index'),3);
		}else{
		// 1.实例化Model类
    	$sort = M('lzsh_sort');

    	// 使用数组条件进行分页查询(必须使用判断条件)
    	$wherelist = [];
    	if (!empty($_GET['sort_name'])) {
    		$wherelist['sort_name'] = array('like', "%{$_GET['sort_name']}%");
    	}
    	$wherelist['sort_level']=array('eq',"0");
    	// 2.实例化分页类
    	// 获取数据总条数(查询数据总条数的时候必须添加条件，否则查询所有数据总条数)
    	$total = $sort->where($wherelist)->count();
   		$Page = new \Think\Page($total, 10);
   		$this->assign('show', $Page->show());

    	// 2.查询
    	$data = $sort->where($wherelist)->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('data',$data);

		$this->display();
		}

	}
	public function add(){
		$this->dispaly();
	}
	public function insert($sort_name,$sort_pid,$sort_level){
		$sort=M('lzsh_sort');                 
        $data['sort_name']=$sort_name;
		$data['sort_pid']=$sort_pid;
		$data['sort_level']=$sort_level;
		$result = $sort->add($data);
         if ($result) {
            $ver['ret'] = 1;
            $ver['data'] = $result;
            $this->ajaxReturn($ver);
        }
	}
	public function update($sort_name,$sort_pid,$sort_level,$sort_id){
		$sort=M('lzsh_sort');               
        $data['sort_name']=$sort_name;
		$data['sort_pid']=$sort_pid;
		$data['sort_level']=$sort_level;
		$result = $sort->where(array('id'=>$sort_id))->save($data);
         if ($result) {
            $ver['ret'] = 1;
            $ver['data'] = $result;
            // 如果主键是自动增长型 成功后返回值就是最新插入的值
            $this->ajaxReturn($ver);
        }

	}
	public function delete($id){
		$sort = M('lzsh_sort');
		
		$res = $sort->delete($id);

		if($res){
			$this->success('删除导航成功',U('Naviga/index'),3);
		}else{
			$this->error('删除导航失败',U('Naviga/index'),3);
		}

	}
	//二级导航
	public function navigaT(){
		if(empty($_SESSION)){
			$this->error('请先登录',U('Index/index'),3);
		}else{
		// 1.实例化Model类
    	$sort = M('lzsh_sort');
    	// 使用数组条件进行分页查询(必须使用判断条件)
    	$wherelist = [];
    	if (!empty($_GET['sort_name'])) {
    		$wherelist['sort_name'] = array('like', "%{$_GET['sort_name']}%");
    	}
    	$wherelist['sort_level']=array('eq',"1");
    	// 2.实例化分页类
    	// 获取数据总条数(查询数据总条数的时候必须添加条件，否则查询所有数据总条数)
    	$total = $sort->where($wherelist)->count();
   		$Page = new \Think\Page($total, 10);
   		$this->assign('show', $Page->show());

    	// 2.查询
    	$data = $sort->where($wherelist)->limit($Page->firstRow.','.$Page->listRows)->select();
    	$array=$sort->select();
    	for($i=0;$i<count($array);$i++){
    		for($j=0;$j<count($array);$j++){
    			if($data[$i]['sort_pid']==$array[$j]['id']){
    				$data[$i]['parent']=$array[$j]['sort_name'];
    			}
    		}	
    	}
		$this->assign('data',$data);

		$this->display();
		}

	}
	public function navTedit($id,$parent){

		$sort=M('lzsh_sort');
		$parental=$sort->where(array('sort_pid'=>'0'))->select();
		$parentid=$sort->where(array('sort_name'=>$parent))->getField('id');
		$data=$sort->find($id);
		$this->assign('parental',$parental);
		$this->assign('parentid',$parentid);
		$this->assign('data',$data);
		$this->display();
	}
	public function navTud(){
		$sort=M('lzsh_sort');
		$res=$sort->create();
		if($res){
			$r = $sort->save();
			if($r){
				$this->success('修改成功',U('Naviga/navigaT'),3);
			}else{
				$this->error('修改失败',U('Naviga/navTedit',array('id'=>$_POST['id'])),3);
			}
		}

	}
	public function navTdel($id)
	{
		
		$sort = M('lzsh_sort');
		
		$res = $sort->delete($id);

		if($res){
			$this->success('删除导航成功',U('Naviga/navigaT'),3);
		}else{
			$this->error('删除导航失败',U('Naviga/navigaT'),3);
		}
	}
	public function navTadd()
	{	
		$sort=M('lzsh_sort');
		$parental=$sort->where(array('sort_pid'=>'0'))->select();
		$this->assign('parental',$parental);
		$this->display();

	}
	public function navTinsert(){
		$sort=M('lzsh_sort');
		$res=$sort->create();

		if($res){
			$r = $sort->add();
			if($r){
				$this->success('添加成功',U('Naviga/navigaT'),3);
			}else{
				$this->error('添加失败',U('Naviga/navTedit',array('id'=>$_POST['id'])),3);
			}
		}

	}
	//三级导航
	public function navigaR(){
		if(empty($_SESSION)){
			$this->error('请先登录',U('Index/index'),3);
		}else{
		// 1.实例化Model类
    	$sort = M('lzsh_sort');
    	// 使用数组条件进行分页查询(必须使用判断条件)
    	$wherelist = [];
    	if (!empty($_GET['sort_name'])) {
    		$wherelist['sort_name'] = array('like', "%{$_GET['sort_name']}%");
    	}
    	$wherelist['sort_level']=array('eq',"2");
    	// 2.实例化分页类
    	// 获取数据总条数(查询数据总条数的时候必须添加条件，否则查询所有数据总条数)
    	$total = $sort->where($wherelist)->count();
   		$Page = new \Think\Page($total, 10);
   		$this->assign('show', $Page->show());

    	// 2.查询
    	$data = $sort->where($wherelist)->limit($Page->firstRow.','.$Page->listRows)->select();
    	$array=$sort->select();
    	for($i=0;$i<count($array);$i++){
    		for($j=0;$j<count($array);$j++){
    			if($data[$i]['sort_pid']==$array[$j]['id']){
    				$data[$i]['parent']=$array[$j]['sort_name'];
    			}
    		}	
    	}
		$this->assign('data',$data);

		$this->display();
		}

	}
	public function navRedit($id,$parent){

		$sort=M('lzsh_sort');
		$parental=$sort->where(array('sort_level'=>'1'))->select();
		$parentid=$sort->where(array('sort_name'=>$parent))->getField('id');
		$data=$sort->find($id);
		$this->assign('parental',$parental);
		$this->assign('parentid',$parentid);
		$this->assign('data',$data);
		$this->display();
	}
	public function navRud(){
		$sort=M('lzsh_sort');
		$res=$sort->create();

		if($res){
			$r = $sort->save();
			if($r){
				$this->success('修改成功',U('Naviga/navigaR'),3);
			}else{
				$this->error('修改失败',U('Naviga/navRedit',array('id'=>$_POST['id'])),3);
			}
		}

	}
	public function navRdel($id)
	{
		
		$sort = M('lzsh_sort');
		
		$res = $sort->delete($id);

		if($res){
			$this->success('删除导航成功',U('Naviga/navigaR'),3);
		}else{
			$this->error('删除导航失败',U('Naviga/navigaR'),3);
		}
	}
	public function navRadd()
	{	
		$sort=M('lzsh_sort');
		$parental=$sort->where(array('sort_level'=>'1'))->select();
		$this->assign('parental',$parental);
		$this->display();

	}
		public function navRinsert(){
		$sort=M('lzsh_sort');
		$res=$sort->create();
		
		if($res){
			$r = $sort->add();
			if($r){
				$this->success('添加成功',U('Naviga/navigaR'),3);
			}else{
				$this->error('添加失败',U('Naviga/navigaR'),3);
			}
		}

	}


	
}