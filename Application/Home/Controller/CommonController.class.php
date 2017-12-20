<?php
namespace Home\Controller;
use Think\Controller;



class CommonController extends Controller{
        public function _initialize()
	{	//导航
                $sort = M('lzsh_sort');
                $sort_listA = $sort->select();
                $this->assign('sort_listA',$sort_listA);

                //轮播图
                $banner = M('lzsh_carousel');
                $banner_list= $banner->select();
                $this->assign('banner_list',$banner_list);
                //理事单位图片
                $director=M('lzsh_director');
                $direal=$director->select();
                $this->assign('direal',$direal);
                //底部联系我们
                $we=M('lzsh_we');
                $we_list=$we->select();
                $this->assign('we_list',$we_list[0]);
                //友情链接
                $link=M('lzsh_link');
                $link_list=$link->select();
                $this->assign('link_list',$link_list);

    

	}




}
?>