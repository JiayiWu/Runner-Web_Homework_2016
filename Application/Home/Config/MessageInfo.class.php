<?php
namespace Home\Config;
/**
 * Created by PhpStorm.
 * User: StevenWu
 * Date: 16/11/9
 * Time: 下午10:49
 */
class MessageInfo
{
 var $state;
 var $object;
 var $message;

    public function __construct($state,$object,$message)
    {
        $this->state = $state;
        $this->object= $object;
        $this->message = $message;
        }
}