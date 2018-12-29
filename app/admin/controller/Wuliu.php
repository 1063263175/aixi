<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/22
 * Time: 9:25
 */

namespace app\admin\controller;

use app\admin\controller\Permissions;
use think\Db;

class Wuliu extends Permissions
{
    public function index()
    {
        $list=Db::name('wuliu')->paginate('20');
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function delete()
    {
        if($this->request->isAjax()) {
            $id = $this->request->has('id') ? $this->request->param('id', 0, 'intval') : 0;
            if(false == Db::name('wuliu')->where('id',$id)->delete()) {
                return $this->error('删除失败');
            } else {
                return $this->success('删除成功','admin/wuliu/index');
            }
        }
    }

    public function publish()
    {
        //获取菜单id
        $id = $this->request->has('id') ? $this->request->param('id', 0, 'intval') : 0;
        //是正常添加操作
        if($id > 0) {
            //是修改操作
            if($this->request->isPost()) {
                //是提交操作
                $post = $this->request->post();
                $post['add_time']=time();
                if(false == Db::name('wuliu')->update($post,['id'=>$id])) {
                    return $this->error('修改失败');
                } else {
                    return $this->success('修改成功','admin/wuliu/index');
                }
            } else {
                //非提交操作
                $date = Db::name('wuliu')->where('id',$id)->find();
                $this->assign('wuliu',$date);
                return $this->fetch();
            }
        } else {
            //是新增操作
            if($this->request->isPost()) {
                //是提交操作
                $post = $this->request->post();
                $post['add_time']=time();
                if(false == Db::name('wuliu')->insert($post)) {
                    return $this->error('添加失败');
                } else {
                    return $this->success('添加成功','admin/wuliu/index');
                }
            } else {
                //非提交操作
                return $this->fetch();
            }
        }

    }
}