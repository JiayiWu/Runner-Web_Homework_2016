<?php
/**
 * Created by PhpStorm.
 * User: StevenWu
 * Date: 16/11/29
 * Time: 上午7:06
 */

namespace Home\Controller;


use Think\Controller;
use Home\Model\ViewDataModel as vd;
class ViewDataController extends Controller
{
 public function getSportData(){
     $vd = new vd();
     $result = $vd->getSportData();
     $this->ajaxReturn($result,"JSON");
 }

 public function getBodyData(){
     $vd = new vd();
     $result = $vd->getSleepData();
     $this->ajaxReturn($result,"JSON");
 }

 public function getSleepData(){
     $vd = new vd();
     $result = $vd->getBodyData();
     $this->ajaxReturn($result,"JSON");
 }
}