<?php
/**
 * 密码加密方式
 * @param $password  密码
 * @param $password_code 密码额外加密字符
 * @return string
 */
function password($password, $password_code='16Aw6gvyDTsSEtv867')
{
    return md5(md5($password) . md5($password_code));
}

/**
 * 获取文章点赞数
 * */
function getZanCount($article_id,$user_id){
    if (!empty($article_id)&&!empty($user_id)){
        return \think\Db::name('zan')->where('user_id',$user_id)->where('article_id',$article_id)->count();
    }elseif (!empty($article_id)){
        return \think\Db::name('zan')->where('article_id',$article_id)->count();
    }elseif (!empty($user_id)){
        return \think\Db::name('zan')->where('user_id',$user_id)->count();
    }
}

/**
 * 获取文章收藏数
 * */
function getCangCount($article_id,$user_id){
    if (!empty($article_id)&&!empty($user_id)){
        return \think\Db::name('cang')->where('user_id',$user_id)->where('article_id',$article_id)->count();
    }elseif (!empty($article_id)){
        return \think\Db::name('cang')->where('article_id',$article_id)->count();
    }elseif (!empty($user_id)){
        return \think\Db::name('cang')->where('user_id',$user_id)->count();
    }
}




