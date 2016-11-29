<?php
/**
 * Created by PhpStorm.
 * User: StevenWu
 * Date: 16/11/29
 * Time: 下午2:47
 */

namespace Home\Model;


use Think\Model;
use Home\Config\MessageInfo;
class MomentsModel extends Model
{
    public function getMomenmts(){
        $user = session('user');
        $db = new Model();
        $sql = "select * from moments_record where ownerid ='".$user['id']."'or ownerid in (select friendid from friend_record where
         ownerid ='".$user['id']."')";
        $result = $db->query($sql);
        for($i = 0 ;$i<count($result);$i++){
            $result[$i]['createdate'] = date('Y-m-d H:i',$result[$i]['createdate']) ;
            if($result[$i]['ownerid']!=$user[$i]['id'])
                $result[$i]['isMy'] = false;
            else
                $result[$i]['isMy'] = true;

        }
        if($result == null){
            return new MessageInfo(true,null,"还未发表任何朋友圈");
        }
        return new MessageInfo(true,$result,"1560:获取成功");
    }

    public function momentsAdd(){
        $user = session('user');
        if($user == null)
            return new MessageInfo(false,null,"请登录");
        $db = M('moments_record');

        $tem['ownerid'] = $user['id'];
        $tem['ownername'] = $user['nickname'];
        $tem['content'] = I('post.content');
        $tem['createdate'] = time();

       $result = $db->data($tem)->add();
        if($result == false)
            return new MessageInfo(false,null,"1520:发布朋友圈失败");
        return new MessageInfo(true,$tem,"1620:发布成功" );
    }

    public function momentsDelete(){
        $user = session('user');
        $db = M('moments_record');
        $id = I('post.id');
        if($db->where('id='.$id.'AND ownerid='.$user['id'])->find()!=null){
            $db->where('id='.$id)->delete();
            return new MessageInfo(true,null,"1620:删除成功");
        }else{
            return new MessageInfo(false,null,"1520:无权限删除");
        }
    }
}