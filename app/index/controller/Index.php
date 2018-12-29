<?php
namespace app\index\controller;

use app\index\controller\Base;
use app\index\model\Article;
use think\Db;
use think\Session;
use think\Validate;

class Index extends Base
{
    public function _initialize()
    {
        error_reporting(E_ERROR);
        //文章分类
        $Acate=Db::name('article_cate')->select();
        $this->assign('Acate',$Acate);
        $webconfig=Db::name('webconfig')->find();
        $this->assign('webconfig',$webconfig);
        /*foreach ($Acate as $k=>$v){
            $list[$k]=Db::name('article')
                ->where('article_cate_id',$v['id'])
                ->where('status',1)
                ->where('is_top',1)
                ->order('id','desc')
                ->select();
        }
        //dump($list);die;
        $this->assign('list',$list);*/
    }
    public function index()
    {
        $article=new Article;
        //首页banner
        $banner=Db::name('adv')
            ->where('class',1)
            ->order('id','desc')
            ->limit('3')
            ->select();
        $this->assign('banner',$banner);
        //企业俱乐部下方广告
        $adv=Db::name('adv')
            ->where('class',2)
            ->order('id','desc')
            ->find();
        $this->assign('adv',$adv);
        //新闻资讯
        $newstop=Db::name('article')
            ->where('article_cate_id',1)
            ->where('status',1)
            ->where('is_top',1)
            ->order('id','desc')
            ->select();
        $this->assign('newstop',$newstop);
        //行业交流
        $jiaoliu=Db::name('article')
            ->where('article_cate_id',2)
            ->where('status',1)
            ->where('is_top',1)
            ->order('id','desc')
            ->select();
        $this->assign('jiaoliu',$jiaoliu);
        //传奇人生
        $people=Db::name('article')
            ->where('article_cate_id',3)
            ->where('status',1)
            ->where('is_top',1)
            ->order('id','desc')
            ->select();
        $this->assign('people',$people);
        //企业俱乐部
        $club=Db::name('article')
            ->where('article_cate_id',4)
            ->where('status',1)
            ->where('is_top',1)
            ->order('id','desc')
            ->select();
        $this->assign('club',$club);
        //培训信息
        $peiwhere['is_top']=1;
        $peiwhere['article_cate_id']=13;
        $pei=$article->getlist($peiwhere,'id desc','4');
        $this->assign('pei',$pei);
        return $this->fetch();
    }

    /**
     * 业态
     * */
    public function indexRight()
    {
        //banner
        $banner=Db::name('adv')
            ->where('class',4)
            ->order('id','desc')
            ->limit('3')
            ->select();
        $this->assign('banner',$banner);
        $cate=Db::name('article_cate')
            ->where('id','in','7,8,9,10,11')
            ->select();
        //dump($cate);die;
        foreach ($cate as $k=>$v){
            $ylist[$k]['data']=Db::name('article')
                ->where('article_cate_id',$v['id'])
                ->where('status',1)
                ->where('is_top',1)
                ->order('id','desc')
                ->select();
            $ylist[$k]['cate']=$v['name'];
        }
        //dump($ylist);die;
        $this->assign('ylist',$ylist);
        return $this->fetch();
    }

    /**
     * 业态分类列表
     * */
    public function ytlist()
    {
        $cate=input('cate');
        //面包屑
        $mm=Db::name('article_cate')->where('id',$cate)->value('name');
        $this->assign('mm',$mm);
        $list=Db::name('article')
            ->where('article_cate_id',$cate)
            ->where('status',1)
            ->paginate('50');
        $this->assign('list',$list);
        return $this->fetch();
    }

    /**
     * 业态详情
     * */
    public function ytdetail()
    {
        $id=input('id');
        $date=Db::name('article')
            ->where('id',$id)
            ->find();
        $this->assign('date',$date);
        return $this->fetch();
    }

    /**
     * 行业交流列表
     * */
    public function jiaoliulist()
    {
        $jiaoliulist = Db::name('article')
            ->where('article_cate_id',2)
            ->where('status',1)
            ->order('id','desc')
            ->paginate('15');
        $this->assign('jiaoliulist',$jiaoliulist);
        return $this->fetch();
    }

    /**
     * 传奇人生列表
     * */
    public function peoplelist()
    {
        $peoplelist = Db::name('article')
            ->where('article_cate_id',3)
            ->where('status',1)
            ->order('id','desc')
            ->select();
        $this->assign('peoplelist',$peoplelist);
        return $this->fetch();
    }

    /**
     * 传奇人生详情
     * */
    public function ren()
    {
        $id=input('id');
        $date=Db::name('article')
            ->where('id',$id)
            ->find();
        $this->assign('date',$date);
        return $this->fetch();
    }

    /**
     * 新闻资讯
     * */
    public function newslist()
    {

        $newslist = Db::name('article')
            ->where('status',1)
            ->where('article_cate_id',1)
            ->order('id','desc')
            ->paginate('15');
        //dump($newslist);die;
        $this->assign('newslist',$newslist);
        return $this->fetch();
    }

    /**
     * 新闻详情
     * */
    public function newdetail()
    {
        $id=input('id');
        $date=Db::name('article')
            ->where('id',$id)
            ->order('id','desc')
            ->find();
        $this->assign('date',$date);

        //点赞和收藏
        $zan=Db::name('zan')->where('article_id',$id)->count();
        $this->assign('zan',$zan);
        $cang=Db::name('cang')->where('article_id',$id)->count();
        $this->assign('cang',$cang);
        //dump($date);die;
        return $this->fetch();
    }

    /**
     * 食品安全列表
     * */
    public function foodlist()
    {
        //banner
        $banner=Db::name('adv')
            ->where('class',3)
            ->order('id','desc')
            ->limit('3')
            ->select();
        $this->assign('banner',$banner);
        $foodlist=Db::name('article')
            ->where('article_cate_id',6)
            ->where('status',1)
            ->order('id','desc')
            ->select();
        $this->assign('foodlist',$foodlist);
        return $this->fetch();
    }

    /**
     * 在线课堂列表 10
     * */
    public function classlist()
    {
        $list=Db::name('article_cate')
            ->where('pid',5)
            ->limit('10')
            ->order('id','desc')
            ->select();
        $this->assign('cl',$list);
        return $this->fetch();
    }

    /**
     * 物流信息港
     * */
    public function wuliu()
    {
        //adv
        $adv=Db::name('adv')
            ->where('class',5)
            ->order('id','desc')
            ->find();
        $this->assign('adv',$adv);
        $list=Db::name('wuliu')
            ->select();
        $this->assign('list',$list);
        return $this->fetch();
    }

    /**
     * 已登录页面
     * */
    public function isdeng()
    {
        return $this->fetch();
    }
    /**
     * 退出登录
     * */
    public function tui()
    {
        Session::clear();
        $this->redirect('login');
    }
    /**
     * 培训报名
     * */
    public function peixun()
    {
        if ($this->request->isPost()){
            $post=request()->post();
            $validate = new Validate([
                ['name','require','姓名不能为空'],
                ['sex','require','性别不能为空'],
                ['danwei','require','单位不能为空'],
                ['dizhi','require','地址不能为空'],
                ['code','require','邮编不能为空'],
                ['tel','require','电话不能为空'],
                ['qq','require','QQ不能为空'],
                ['email','email|require','请填写正确的邮箱|邮箱不能为空'],
            ]);
            if (!$validate->check($post)) {
                $this->error('提交失败：' . $validate->getError());
            }

            $post['add_time']=time();
            if (true == Db::name('peixun')->insert($post)){
                $this->success('报名成功');
            }else{
                $this->error('报名失败');
            }
        }

        $id=input('id');
        $date=Db::name('article')->where('id',$id)->find();
        $this->assign('date',$date);
        return $this->fetch();
    }

    /**
     * 登录
     * */
    public function login()
    {
        //登录判定
         $session=Session::get('user_id');
         if ($session>0){
             //重定向到已登录页面
             $this->redirect('isdeng');
         }
        if ($this->request->isPost()){
            $post=$this->request->post();
            $user=Db::name('user')->where('username',$post['username'])->find();
            if (!empty($user)){
                if (password($post['password']) == $user['password']){
                    Session::set('username',$post['username']);
                    Session::set('user_id',$user['id']);
                    $this->success('登录成功','index');
                }else{
                    $this->error('密码错误');
                }
            }else{
                $this->error('该用户不存在');
            }
        }
        return $this->fetch();
    }
    /**
     * 注册
     * */
    public function zhuce()
    {
        if ($this->request->isPost()){
            $post=$this->request->post();
            if (Db::name('user')->where('username',$post['username'])->value('id')>0){
                $this->error('用户已存在');
            }
            $post['password']=password($post['password']);
            unset($post['code']);
            if (false == Db::name('user')->insert($post)){
                $this->error('注册失败');
            }else{
                $this->success('注册成功','index');
            }
        }
        return $this->fetch();
    }


    /**
     * 客服列表
     * */
    public function kefu()
    {
        $list=Db::name('admin')
            ->where('admin_cate_id',20)
            ->select();
        $this->assign('list',$list);
        return $this->fetch();
    }

    /**
     * 企业俱乐部列表
     * */
    public function clublist()
    {
        //传奇人生
        $people=Db::name('article')
            ->where('article_cate_id',3)
            ->where('status',1)
            ->order('id','desc')
            ->select();
        $this->assign('people',$people);
        //企业俱乐部
        $club=Db::name('article')
            ->where('article_cate_id',4)
            ->where('status',1)
            ->order('id','desc')
            ->select();
        $this->assign('club',$club);
        return $this->fetch();
    }

    /**
     * 企业俱乐部详情
     * */
    public function clubdetail()
    {
        $id=input('id');
        $date=Db::name('article')
            ->where('id',$id)
            ->order('id','desc')
            ->find();
        $this->assign('date',$date);
        //相关
        $xiang=Db::name('article')
            ->where('article_cate_id',4)
            ->where('id','not in',$id)
            ->order('id','desc')
            ->limit('5')
            ->select();
        $this->assign('xiang',$xiang);
        $zan=Db::name('zan')->where('article_id',$id)->count();
        $this->assign('zan',$zan);
        $cang=Db::name('cang')->where('article_id',$id)->count();
        $this->assign('cang',$cang);
        return $this->fetch();
    }

    /**
     * 在线留言
     * */
    public function liuyan()
    {
        if ($this->request->isPost()){
            $post=request()->post();
            //验证
            $validate = new \think\Validate([
                ['name', 'require', '姓名不能为空'],
                ['email','email','请填写正确的邮箱'],
                ['tel', 'require', '联系方式不能为空'],
                ['content', 'require', '留言内容不能为空'],
            ]);
            //验证部分数据合法性
            if (!$validate->check($post)) {
                $this->error('提交失败：' . $validate->getError());
            }
            $post['add_time']=time();
            if (false == Db::name('liuyan')->insert($post)){
                return $this->error('提交失败');
            }else{
                return $this->success('提交成功','index');
            }
        }
        return $this->fetch();
    }

    /**
     * 点赞
     * */
    public function zan()
    {
        //登录判断
        $user_id=Session::get('user_id');
        if (empty($user_id)){
            return $this->error('请先登录');
        }
        $article_id=request()->post('article_id');
        $info=Db::name('zan')->where('user_id',$user_id)->where('article_id',$article_id)->find();
        if (!empty($info)){
            return $this->error('您已经点过了');
        }elseif (true == Db::name('zan')->insert(['user_id'=>$user_id,'article_id'=>$article_id])){
            $res['count']=Db::name('zan')->where('article_id',$article_id)->count();
            $res['msg']="点赞成功";
            return $res;
        }else{
            return $this->error('操作失败');
        }

    }

    /**
     * 收藏与取消
     * */
    public function cang()
    {
        //登录判断
        $user_id=Session::get('user_id');
        if (empty($user_id)){
            return $this->error('请先登录');
        }
        $article_id=request()->post('article_id');
        $info=Db::name('cang')->where('user_id',$user_id)->where('article_id',$article_id)->find();
        if (!empty($info)){
            //取消收藏
            if (true == Db::name('cang')->where(['user_id'=>$user_id,'article_id'=>$article_id])->delete()){
                $res['count']=Db::name('cang')->where('article_id',$article_id)->count();
                $res['msg']="取消收藏成功";
                return $res;
            }
        }elseif (true == Db::name('cang')->insert(['user_id'=>$user_id,'article_id'=>$article_id])){
            $res['count']=Db::name('cang')->where('article_id',$article_id)->count();
            $res['msg']="收藏成功";
            return $res;
        }else{
            return $this->error('操作失败');
        }
    }

    /**
     * 在线地图
     * */

    public function map()
    {
        return $this->fetch();
    }
    
    /**
     * 企业俱乐部发帖
     * */
    public function fatie()
    {
        //判断登录
        $user_id=Session::get('user_id');
        if (empty($user_id)){
            $this->error('请先登录','login');
        }
        if ($this->request->isPost()){
            $post=request()->post();
            //dump($post);die;
            unset($post['file']);
            if (empty($post['title'])){
                $this->error('标题不能为空');
            }elseif (empty($post['content'])){
                $this->error('内容不能为空');
            }else{
                $post['create_time']=time();
                if (true == Db::name('article')->insert($post)){
                    $this->success('发布成功,请等待审核','clublist');
                }else{
                    $this->error('发布失败');
                }
            }
        }
        return $this->fetch();
    }

    /**
     * 图片上传方法
     * @return [type] [description]
     */
    public function upload($module='club',$use='admin_thumb')
    {
        if($this->request->file('file')){
            $file = $this->request->file('file');
        }else{
            $res['code']=1;
            $res['msg']='没有上传文件';
            return json($res);
        }
        $module = $this->request->has('module') ? $this->request->param('module') : $module;//模块
        $web_config = Db::name('webconfig')->where('web','web')->find();
        $info = $file->validate(['size'=>$web_config['file_size']*1024,'ext'=>$web_config['file_type']])->rule('date')->move(ROOT_PATH . 'public' . DS . 'uploads' . DS . $module . DS . $use);
        if($info) {
            //写入到附件表
            $data = [];
            $data['module'] = $module;
            $data['filename'] = $info->getFilename();//文件名
            $data['filepath'] = DS . 'uploads' . DS . $module . DS . $use . DS . $info->getSaveName();//文件路径
            $data['fileext'] = $info->getExtension();//文件后缀
            $data['filesize'] = $info->getSize();//文件大小
            $data['create_time'] = time();//时间
            $data['uploadip'] = $this->request->ip();//IP
            $data['user_id'] = Session::has('admin') ? Session::get('admin') : 0;
            if($data['module'] = 'admin') {
                //通过后台上传的文件直接审核通过
                $data['status'] = 1;
                $data['admin_id'] = $data['user_id'];
                $data['audit_time'] = time();
            }
            $data['use'] = $this->request->has('use') ? $this->request->param('use') : $use;//用处
            $res['id'] = Db::name('attachment')->insertGetId($data);
            $res['src'] = DS . 'uploads' . DS . $module . DS . $use . DS . $info->getSaveName();
            $res['code'] = 2;
            return json($res);
        } else {
            // 上传失败获取错误信息
            return $this->error('上传失败：'.$file->getError());
        }
    }

    /**
     * 搜索
     * */
    public function sou()
    {
        $title=input('title');
        $list=Db::name('article')->where(['title'=>['like','%' . $title . '%']])->select();
        $this->assign('list',$list);
        return $this->fetch();
    }
}
