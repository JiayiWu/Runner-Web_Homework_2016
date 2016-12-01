<?php
/**
 * Created by PhpStorm.
 * User: StevenWu
 * Date: 16/12/1
 * Time: 上午10:05
 */

namespace Home\Model;


use Home\Config\MessageInfo;
use Think\Model;
use Home\Util\DateUtil;

class MessageModel extends Model
{
     public function messageCreate(){
       $user = new Model();
       $message = M('message_record');
       $data['content'] = I('content');
       $data['date'] = time();
       $result =   $message->data($data)->add();
       $sql = "update user set notice = notice+1";
       if($result == true){
           $user->execute($sql);
           return new MessageInfo(true,$data,"1660:全体消息发送成功");
       }else
           return new MessageInfo(false,$data,"1620:消息推送未成功");
     }


     public function messageGet(){
         $user = session('user');
         $userdb = M('user');
         $num = $userdb->where('id='.$user['id'])->find()['notice'];
         $num = $num -1;
         if($num == 0){
             return new MessageInfo(false,null,"1660:无消息推送");
         }

         $message = M('message_record');
         $result = $message->order('date desc')->limit($num)->select();

         $dateutil = DateUtil::getInstance();
         $result = $dateutil->convert($result);

         return new MessageInfo(true,$result,"1660:消息获取成功");
     }
}