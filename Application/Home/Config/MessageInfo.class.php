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
 var $objct;
 var $message;

    function _construct($state,$objct,$message)
    {
        $this->state = $state;
        $this->objct= $objct;
        $this->message = $message;
        }
}