<?php
/**
 * Created by PhpStorm.
 * User: StevenWu
 * Date: 16/11/30
 * Time: 下午3:18
 */

namespace Home\Model;


use Think\Model;
use Home\Config\MessageInfo;
class RaceModel extends Model
{
    public function raceCreate(){
        $db = M('race');
        $user = session('user');
        $data['userid'] = $user['id'];
        $data['createdate'] = time();
        $data['isenable'] = 0;
        $data['topic'] = I('post.topic');
        $data['content'] = I('post.content');
        $result = $db->data($data)->add();
        if($result == true){
            return new MessageInfo(true,$data,"1260:比赛创建成功");
        }else{
            return new MessageInfo(false,null,"1220:比赛创建失败");
        }
    }

    public function raceModify(){
        $db = M('race');
        $data = I('post.');
        $tem['content'] = $data['content'];

        $result = $db->where('id='.$data['id'])->save($tem);
        if($result == true){
            return new MessageInfo(true,$data,"1260:比赛修改成功");
        }else{
            return new MessageInfo(false,null,"1220:比赛修改失败");
        }
    }
    public function raceDelete(){
        $db = M('race');
        $data = I('post.id');
        $result = $db->where('id='.$data)->delete();
        if($result == true){
            return new MessageInfo(true,$data,"1260:比赛删除成功");
        }else{
            return new MessageInfo(false,null,"1220:比赛删除失败");
        }
    }

    public function raceJoin(){
        $db = M('race');
        $user = session('user');
        $data = I('post.id');
        $temRace = $db->where("userid=".$user['id']." AND "."id=".$data)->find();
        if($temRace != null){
            return new MessageInfo(false,null,"1220:自己不能参加自己创建的比赛");
        }

        $temRace1 =  $db->where("id=".$data)->find();
        $ownerid = $temRace1['userid'];
        $joinid = $user['id'];

        $timeBefore = time()-3600*24*7;
        $walk = M('sport_data');
        $map['userid'] = array('EQ', $ownerid);
        $map['date'] = array('BETWEEN',array($timeBefore,time()));
        $dataOwner = $walk->where($map)->select();
        $map['userid'] = array('EQ', $joinid);
        $dataJoin = $walk->where($map)->select();

        $dataOwnerCount =0;
        $dataJoinCount = 0;
        if($dataOwner != null){
            foreach ($dataOwner as $tem)
                $dataOwnerCount+=$tem['walkmile'];
        }else if($dataJoin != null){
            foreach ($dataJoin as $tem)
                $dataJoinCount+=$tem['walkmile'];
        }



        $userdb = M('user');
        $recorddb = M('race_record');
        $temRecord['raceid'] = $data;
        $temRecord['createuserid'] = $ownerid;
        $temRecord['joinuserid'] = $joinid;
        $temRecord['createdate'] = $temRace1['createdate'];

        $temRaceMark['isenable'] = 1;
        $db->where("id=".$data)->save($temRaceMark);

        $temResult['ownercount'] = $dataOwnerCount;
        $temResult['joincount'] = $dataJoinCount;
        $temResult['result'] = 0;
        if ($dataOwnerCount>$dataJoinCount){

            $userdb->where('id='.$ownerid)->setInc('score', 3);
            $temRecord['winnerid'] = $ownerid;
            $recorddb->data($temRecord)->add();
            $temResult['result'] = 0;
            return new MessageInfo(true,$temResult,"1260:您输掉了比赛");



        }else if ($dataOwnerCount < $dataJoinCount){
            $userdb->where('id='.$joinid)->setInc('score', 3);
            $temRecord['winnerid'] = $joinid;
            $recorddb->data($temRecord)->add();
            $temResult['result'] = 1;
            return new MessageInfo(true,$temResult,"1260:您赢得了比赛");
        }else {
            $userdb->where('id='.$joinid)->setInc('score', 1);
            $userdb->where('id='.$ownerid)->setInc('score', 1);
            $temRecord['winnerid'] = $joinid;
            $recorddb->data($temRecord)->add();
            $temRecord['winnerid'] = $ownerid;
            $recorddb->data($temRecord)->add();
            $temResult['result'] = 2;
            return new MessageInfo(true,$temResult,"1260:您与对方打成了平手");
        }

     }


     public function raceResult(){
         $user = session('user');
         $db = new Model();
        $sql = "select r.id as id, r.topic as topic , r.content as content ,ff.winnerid as winnerid from (select raceid , winnerid from race_record where joinuserid= ".$user['id']." OR createuserid=".$user['id'].") ff ,race r where r.id = ff. raceid";
         $result = $db->query($sql);
         $winCount = 0;
         for($i = 0 ;$i<count($result);$i++){
            if ($result[$i]['winnerid'] == $user['id']){
                $result[$i]['win'] = true;
                $winCount++;
            }else{
                $result[$i]['win'] = false;
            }
         }

         $param['allCom'] = count($result);
         $param['winCom'] = $winCount;
         $param['object'] = $result;

         return new MessageInfo('true',$param,"1260:结果获取成功");
     }

     public function raceList(){
         $db = new Model();
         $sql = "select r.id as id, r.topic as topic,r.content as content ,u.nickname as nickname from race r ,user u where isenable = 0 AND u.id = r.userid";
         $result = $db->query($sql);
         return new MessageInfo('true',$result,"1260:列表获取成功");
     }

     public function raceMyList(){
         $user = session('user');
         $db = M('race');
         $result = $db->where('userid='.$user['id']." AND isenable = 0" )->select();
         return new MessageInfo('true',$result,"1260:列表获取成功");
     }
}