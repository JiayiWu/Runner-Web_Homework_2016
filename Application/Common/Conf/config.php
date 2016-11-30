<?php
return array(
	//'配置项'=>'配置值'

    'URL_MODEL' => '2',
    'URL_ROUTER_ON'   => true,
    'URL_ROUTE_RULES'=>array(
        'user/add'=>'Home/user/userAdd',
        'user/login'=>'Home/user/login',
        'user/basicinfo'=>'Home/user/userBasicInfo',
         'runner/data/sport'=>'Home/viewdata/getSportData',
        'runner/data/body'=>'Home/viewdata/getBodyData',
        'runner/data/sleep'=>'Home/viewdata/getSleepData',
        'runner/data'=>'Home/data/dataDeal',
        'moments/add'=>'Home/friends/momentsAdd',
        'moments/delete'=>'Home/friends/momentsDelete',
        'moments'=>'Home/friends/momentsList',
        'friends/search'=>'Home/friends/friendSearch',
        'friends/canclef'=>'Home/friends/friendCancle',
        'friends/fans'=>'Home/friends/friendFansList',
        'friends/focus'=>'Home/friends/friendFocus',
        'friends/recommend'=>'Home/friends/recommendFriend',
        'friends'=>'Home/friends/friendList',
        'race/create'=>'Home/race/raceCreate',
        'race/modify'=>'Home/race/raceModify',
        'race/result'=>'Home/race/raceResult',
        'race/delete'=>'Home/race/raceDelete',
        'race/join'=>'Home/race/raceJoin',
        'race/mylist'=>'Home/race/racemyList',
        'race'=>'Home/race/raceList',
        'complaint/create'=>'Home/complaint/complainCreate',
        'complaint/datele'=>'Home/complaint/complainDelete',
        'complaint/ignore'=>'Home/complaint/complainIgnore',
        'complaint/recover'=>'Home/complaint/complainRecover',
        'complaint/history'=>'Home/complaint/complaintHistory',
        'complaint'=>'Home/complaint/complainGet',


        'user/acc'=>'index.php/Home/index/index'
    )



);