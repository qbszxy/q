<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/6/19
 * Time: 13:57
 */

session_start();
require_once('dbconnection.php');

$data = array();
$data['code'] = -1;
$data['msg'] = '';
$data['data'] = array();

$_SESSION['userId'] = null;

$data['code'] = 0;
$data['msg'] = '注销成功';

echo json_encode($data);







