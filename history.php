<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/6/19
 * Time: 12:32
 */

session_start();
require_once('dbconnection.php');


//'code' => -1,
//    'msg' => '其中一个数字为空',
//    'data' => array(
//    'result'=> ''
//)


$data = array();
$data['code'] = -1;
$data['msg'] = '';
$data['data'] = array();
class History {
    public $id;
    public $account;
    public $numCount;
    public $numDetail;
    public $result;
    public $createTime;
}
if(isset($_SESSION['userId'])) {
    $hisgoryList = mysqli_query($con,"SELECT * FROM think_history");
    $userList = mysqli_query($con,"SELECT * FROM think_user");
    $array = array();
    foreach ($hisgoryList as $value) {
        $history = new History;
        $history->id = $value['id'];
        $history->account = $value['account'];
        $history->numCount = $value['numCount'];
        $history->numDetail = $value['numDetail'];
        $history->result = $value['result'];
        $history->createTime = $value['createTime'];
        array_push($array, $history);
    }
    $data['code'] = 0;
    $data['msg'] = 'success';
    $data['data'] = $array;
    echo json_encode($data);
//    $data['code'] = 0;
//    $data['msg'] = '';
//    $data['data'] = $hisgoryList;
//    var_dump($hisgoryList);
//    foreach ($hisgoryList as $value) {
//        $data['data']['id'] = $value['id'];
//        $data['data']['account'] = $value['account'];
//        $data['data']['numCount'] = $value['numCount'];
//        $data['data']['numDetail'] = $value['numDetail'];
//        $data['data']['result'] = $value['result'];
//        $data['data']['createTime'] = $value['createTime'];
//    }
//    echo json_encode($hisgoryList   );
} else {
    $data['code'] = 10001;
    $data['msg'] = '未登录';
    echo json_encode($data);
}



