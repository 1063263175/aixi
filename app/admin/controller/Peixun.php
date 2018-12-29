<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/21
 * Time: 16:17
 */

namespace app\admin\controller;

use app\admin\controller\Permissions;
use think\Db;

class Peixun extends Permissions
{
    public function index()
    {
        $list=Db::name('peixun')->paginate('20');
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function xuqiu()
    {
        $list=Db::name('xuqiu')->paginate('20');
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function zhaopin()
    {
        $list=Db::name('zhaopin')->paginate('20');
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function qiuzhi()
    {
        $list=Db::name('qiuzhi')->paginate('20');
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function qiudetail()
    {
        $id=input('id');
        $info=Db::name('qiuzhi')->where('id',$id)->find();
        $this->assign('info',$info);
        //dump($info);die;
        return $this->fetch();
    }
}