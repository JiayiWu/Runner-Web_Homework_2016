<?php

/**
 * Created by PhpStorm.
 * User: StevenWu
 * Date: 16/11/2
 * Time: 下午7:54
 */
namespace Home\Model;
use Think\Model;
class FormModel extends Model
{
    protected $_validate    =   array(
        array('title','require','标题必须'),
    );
    // 定义自动完成
    protected $_auto    =   array(
        array('create_time','time',1,'function'),
    );
}