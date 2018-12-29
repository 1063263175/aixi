<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/19
 * Time: 14:17
 */
namespace app\index\model;
use think\Model;

class Article extends Model
{
    public function getlist($where, $order,$limit)
    {
        return $this->where($where)->where('status',1)->order($order)->limit($limit)->select();
    }
    public function getlistpage($where, $order,$page)
    {
        return $this->where($where)->where('status',1)->order($order)->paginate($page);
    }
}