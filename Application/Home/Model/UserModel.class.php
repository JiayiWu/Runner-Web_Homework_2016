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
        $User = M('User');
// 根据表单提交的POST数据创建数据对象
         $User->create();
        $result1 =   $User->add();
        if($result1 == true){
            $tem = new MessageInfo(true,null,'登录成功');
            return $tem;
        }else{
            $tem = new MessageInfo(false,null,$User->getError());
            return $tem;
        }

    }
}