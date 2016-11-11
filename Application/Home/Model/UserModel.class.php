<?php

/**
 * Created by PhpStorm.
 * User: StevenWu
 * Date: 16/11/2
 * Time: 下午7:54
 */
namespace Home\Model;
use Think\Model;
use Home\Config\MessageInfo;
class UserModel extends Model
{
    protected $tablePrefix = '';

    // 定义自动完成


    public function add(){
//        $data['email'] = I('post.email');
//        $data['password'] = I('post.password');
//        $data['nickname'] = I('post.nickname');
//        $data['username'] = I('post.username');
        $data = I('post.');
        $result = $this->save($data);
        if(false !== $result){
            return new MessageInfo(true,null, '增加成功');
        }else{
            return new MessageInfo(true,'程序错误','程序错误');
        }
    }
}