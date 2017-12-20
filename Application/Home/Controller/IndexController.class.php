<?php
namespace Home\Controller;
use Think\Controller;
use Think\Page;

class IndexController extends Controller 
{
    public function index()
    {
        $sort = M('lzsh_sort');
        $sort_listA = $sort->select();
        $this->assign('sort_listA',$sort_listA);

        //轮播图
        $banner = M('lzsh_carousel');
        $banner_list= $banner->select();
        $this->assign('banner_list',$banner_list);
        //商会动态
        $dna=M('lzsh_dna');
        $w=array();
        $w['istatus']=array('eq','1');
        $w['pstatus']=array('eq','1');
        $dna_d=$dna->where($w)->select();
        //动态列表
        $wd=array();
        $wd['istatus']=array('eq','1');
        $wd['hstatus']=array('eq','1');
        $dna_list=$dna->where($wd)->select();
        $this->assign('dna',$dna_d[0]);
        $this->assign('dna_list',$dna_list);
        //公告通知
        $n=array();
        $n['istatus']=array('eq','2');
        $n['pstatus']=array('eq','1');
        $notice=$dna->where($n)->select();
        //公告列表
        $nl=array();
        $nl['istatus']=array('eq','2');
        $nl['hstatus']=array('eq','1');
        $n_list=$dna->where($nl)->select();
        $this->assign('n_list',$n_list);
        $this->assign('notice',$notice[0]);

        //活动热报
        $active=M('lzsh_active');
        $active_list=$active->where(array('pstatus'=>'1'))->select();
        $this->assign('active_list',$active_list[0]);
        //企业明星
        $esta=M('lzsh_esta');
        $e=array();
        $e['status']=array('eq','1');
        $esta_list=$esta->where($e)->order('pid')->select();
        $this->assign('esta_list',$esta_list);
        //精选理事
        $director=M('lzsh_director');
        $d=array();
        $d['status']=array('eq','1');
        $dire_list=$director->where($d)->select();
        //团队图片
        $team=M('lzsh_teampic');
        $teampic=$team->select();
        $this->assign('teampic',$teampic[0]);
        //明星成员
        $stor=M('lzsh_storuser');
        $stor_list=$stor->select();
        //var_dump($stor_list);
        $this->assign('stor_list',$stor_list);
        //理事单位图片
        $direal=$director->select();
        $this->assign('direal',$direal);
        $this->assign('dire_list',$dire_list);
        //底部联系我们
        $we=M('lzsh_we');
        $we_list=$we->select();
        $this->assign('we_list',$we_list[0]);
         //友情链接
        $link=M('lzsh_link');
        $link_list=$link->select();
        $this->assign('link_list',$link_list);
       
        
        $this->display();

    }
    
    function Logout(){
        session_start();
        session_destroy();  //销毁所有session数据
        $this->GotoUrl('退出成功','?',1);
    }
    
}




















