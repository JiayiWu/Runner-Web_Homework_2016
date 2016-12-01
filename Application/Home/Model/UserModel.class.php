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
        $record = M('percent_record');
        $data = I('post.');
        $data['score'] = 0;

        $num= rand(60,100)/100;
        $newNum  = sprintf("%.1f",$num);
        $dataSport['health'] = $newNum;
        $dataSport['finish'] = rand(80,100);
        $dataSport['win'] = rand(40,100);

        $result1 =   $User->data($data)->add();
        $record->data($dataSport)->add();
        if($result1 == true){
            $userResult = $User->where('username='.$data['user'])->find();
            session('user',$userResult);
            $tem = new MessageInfo(true,null,'登录成功');
            return $tem;
        }else{
            $tem = new MessageInfo(false,null,$User->getError());
            return $tem;
        }

    }

    public function login(){
        $User = M('User');
// 根据表单提交的POST数据创建数据对象
        $data = I('post.');
        $result = $User->where('username="'.$data['userName'].'"'.'AND password="'.$data['password'].'"')->find();
        if($result != null){
            $findUser = $User->data();
            session('user',$findUser);
            return new MessageInfo(true,$findUser,'登录成功');
        }else if ($result == null){
            return new MessageInfo(false,null,'账号不存在或密码错误,请重新输入!');
        }else{
            return new MessageInfo(false,null,'非法输入!');
        }
    }


    public function basicInfo(){
        $User = M('User');
        $result = $User->where('username="'.session('user')['username'].'"'.'AND password="'.session('user')['password'].'"')->find();

        if($result == null ){
            return new MessageInfo(false,null,'账户未登录');
        }

        $vo['weight'] = $result['weight'];
        $vo['height'] = $result['height'];
        $vo['nickname'] = $result['nickname'];
        $vo['sex'] = $result['sex'];
        $vo['slogan'] = $result['slogan'];

        return new MessageInfo(true,$vo,"信息获取成功");
    }

    public function userMessageReceiver(){
        $user = session('user');

        $userDB = M('user');
        $model = new Model();
        if ($userDB->where('id='.$user['id'])->find()['notice']>=2) {
           $tem = $userDB->where('id='.$user['id'])->setDec("notice",1);

        }
        return new MessageInfo(true,null,"成功");
    }

    public  function  basicInfoHome(){
        $user = session('user');

        $friendDB = M('friend_record');
        $sportDB = M('sport_data');
        $percentDB = M('percent_record');

        $result = $sportDB->where('userid='.$user['id'])->select();
        $allMile = 0;
        $allCal = 0;
        for ($i=0;$i<count($result);$i++){
            $allMile+=$result[$i]['walkmile'];
            $allCal+=$result[$i]['calorie'];
        }
        $allData['my'] = $friendDB->where('ownerid='.$user['id'])->count();
        $allData['fans'] = $friendDB->where('friendid='.$user['id'])->count();
        $allData['id'] = $user['id'];
        $allData['name'] = $user['nickname'];
        $allData['health'] = $percentDB->where("userid=".$user['id'])->find()['health'];
        $allData['walkmile'] =  $allMile ;
        $allData['calorie'] =  $allCal ;
        $allData['hour'] =  round($allMile*0.65) ;
return $allData;
//        return new MessageModel(true,$allData,"1260:查询成功");

    }



    public function modifyBasicinfo(){
        $user = session('user');
        $data = I("post.");
        $userDB = M('user');

        if($userDB->where("id=".$user['id'])->save($data)>=1)
            return new MessageInfo(true,null,"1260:修改成功");
        return new MessageInfo(false,null,"1220:修改失败");

    }

    public function modifyPassword(){
        $user = session('user');
        $userDB = M('user');
        $tem = $userDB->where("id=".$user['id'])->find();
        $data = I("post.");
        if ($data['oldpass'] != $tem['password']){
            return new MessageInfo(false,null,"1220:原密码不正确,请重新输入");
        }
        $temD['password'] = $data['newpass'];
        $tem = $userDB->where("id=".$user['id'])->save($temD);
        if($tem>=1)
            return new MessageInfo(true,null,"1260:修改成功");
        return new MessageInfo(false,null,"1220:修改失败");
    }
}