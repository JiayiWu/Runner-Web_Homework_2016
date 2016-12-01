<?php
/**
 * Created by PhpStorm.
 * User: StevenWu
 * Date: 16/12/1
 * Time: 上午10:04
 */

namespace Home\Controller;


use Think\Controller;
use Home\Model\MessageModel as mm;
class MessageController extends Controller
{
      public function messageCreate(){
          $mm = new mm();
          $this->ajaxReturn( $mm->messageCreate(),"JSON");
      }

    public function messageGet(){
        $mm = new mm();
        $this->ajaxReturn( $mm->messageGet(),"JSON");
    }
}