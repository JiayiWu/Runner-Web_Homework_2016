<?php
/**
 * Created by PhpStorm.
 * User: StevenWu
 * Date: 16/11/30
 * Time: 下午9:55
 */

namespace Home\Model;


use Think\Model;
use Home\Config\MessageInfo;

class ComplaintModel extends Model
{
    public function complainGet(){
        $sql = "select cr.id as id ,cr.raceid as raceid, cr.racetopic as racetopic, cr.racecontent as racecontent,u1.nickname as cname
         ,u2.nickname as hname,cr.reason as reason, cr.date as date from complaints_record cr,user u1,user u2 where cr.state = 0 AND cr.curserid = u1.id 
         AND cr.huserid = u2.id ";
        $db = new Model();
        $result = $db->query($sql);
        for($i = 0;$i<count($result);$i++){
            $result[$i]['date']= date('Y-m-d H:i',$result[$i]['date']) ;
        }
        return new MessageInfo(true,$result,"1760:获取投诉列表成功");

    }

    public function complainCreate(){
        $db = M('complaints_record');
        $data = I('post.');
        $user = session('user');
        $dbRace = M('race');
        if ($db->where('raceid='.$data['id'])->find()!=null){
            return new MessageInfo(false,null,"1720:该活动已经被投诉过了,请耐心等待处理结果!");
        }
        $Raceid = $dbRace->where("id=".$data['id'])->find();
        if($Raceid['userid'] == $user['id'] )
            return new MessageInfo(false,null,"1720:不要自己投诉自己:)!");
        $store['raceid'] = $data['id'];
        $store['racetopic'] = $Raceid['topic'];
        $store['racecontent'] = $Raceid['content'];
        $store['curserid'] = $user['id'];
        $store['huserid'] = $Raceid['userid'];
        $store['reason'] = $data['reason'];
        $store['state'] = 0;
        $store['date'] = time();
        $result = $db->data($store)->add();
        if($result == true){
            return new MessageInfo(true,$result,"1760:投诉成功");
        }else{
            return new MessageInfo(false,null,"1720:投诉失败!");
        }
    }

    public function complainDelete(){
        $dbCR = M('complaints_record');
        $dbRC = M('race');
        $id = I('post.id');

        $raceid = $dbCR->where('id='.$id)->find()['raceid'];
        $date['state'] = 1;
        $dbCR->where('id='.$id)->save($date);
        $date['isenable'] = 2;
        $dbRC->where('id='.$raceid)->save($date);
        return new MessageInfo(true,null,"1760:投诉处理成功");
    }

    public function complaintIgonre(){
        $dbCR = M('complaints_record');
        $id = I('post.id');
        $date['state'] = 2;
        $dbCR->where('id='.$id)->save($date);
        return new MessageInfo(true,null,"1760:投诉处理成功");
    }

    public function complaintHistory(){

        $sql = "select cr.id as id ,cr.raceid as raceid, cr.racetopic as racetopic, cr.racecontent as racecontent,u1.nickname as cname
         ,u2.nickname as hname,cr.reason as reason, cr.date as date  ,cr.state as state from complaints_record cr,user u1,user u2 where cr.state <> 0 AND cr.curserid = u1.id 
         AND cr.huserid = u2.id ";

        $db = new Model();
        $result = $db->query($sql);
        for($i = 0;$i<count($result);$i++){
            $result[$i]['date']= date('Y-m-d H:i',$result[$i]['date']) ;

        }
        return new MessageInfo(true,$result,"1760:获取处理列表成功");
    }

    public function complaintRecover(){
        $dbCR = M('complaints_record');
        $dbRC = M('race');
        $id = I('post.id');
//        $id = 1;
        $raceid = $dbCR->where('id='.$id)->find()['raceid'];
        $date['state'] = 2;
        $dbCR->where('id='.$id)->save($date);
        $date['isenable'] = 0;
        $dbRC->where('id='.$raceid)->save($date);
        return new MessageInfo(true,null,"1760:恢复成功");
    }
}