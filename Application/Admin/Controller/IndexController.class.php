<?php

namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller
{
	public function index()
	{	
		$this->display();
	}
	public function yanzheng()
	{
		$username = I('post.username');
		$password = I('post.password');
		$code     = I('post.code');
		if(!empty($username)){
			$admin=M('lzsh_user');
			$id=$admin->where(['username'=>$username])->getField('id');
			//存储用户ID;
			$_SESSION['admin']=$id;
			$res=$admin->where(['username' => $username])->find();
			if(!empty($res)){
				if(!empty($password)){
					$res1=$admin->where(['username' => $username,'password' => $password])->find();
					if(!empty($res1)){
					    if(!empty($code)){
							$yanzheng = new \Think\Verify();
					    	if ($yanzheng->check($code)) {
					    		$this->ajaxReturn('yes');
					    				}else{
					    		$this->ajaxReturn('6');
					    			}
								}else{
							$this->ajaxReturn('5');
							}
						}else{
						$this->ajaxReturn('4');
					}
				}else{
					$this->ajaxReturn('3');
				}
			}else{
				$this->ajaxReturn('2');
			}
		}else{
			$this->ajaxReturn('1');
		}
	}
	public function code()
	{
    	$config = array(
    			'fontSize' => 20,
    			'length'	=> 4,	
    			'useNoise'  => false,	
    			'useImgBg'	=> true,
    			'useCurve'	=> false,	
    			'imageW'	=> 140,
    			'imageH'	=> 40,
    			'codeSet'	=> '0123456789',
    		);
    	 ob_clean();
    	$code = new \Think\Verify($config);

    	$code->entry();
	}
}
?>




