<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/6/19
 * Time: 12:10
 */

session_start();
require_once('dbconnection.php');

class History {
    public $account;
    public $numCount;
    public $numDetail;
    public $result;
    public $createTime;
}
if(isset($_POST['data'])){
    $data = json_decode($_POST['data']);
    $result = factorial($data->n);
    $history = new History;
    if($_SESSION['userId']) {
        $history->account = $_SESSION['account'];
    } else {
        $history->account = '游客';
    }
    $history->numCount = $data->numCount;
    $history->numDetail = $data->numDetail;
    $history->result = $result['data']['result'];
    $history->createTime = date('Y-m-d H:i:s');

    $msg=mysqli_query($con,"insert into think_history(account,numCount,numDetail,result,createTime) values('$history->account','$history->numCount','$history->numDetail','$history->result','$history->createTime')");
    if($msg) {
        echo json_encode($result);
    } else {
        echo json_encode($result);
    }
}

function factorial($n) {
//    $n = json_decode($n);
    $len = count($n);
    $array = array();
    foreach ($n as $value) {
        if($value == '') {
            return array(
                'code' => -1,
                'msg' => '其中一个数字为空',
                'data' => array(
                    'result'=> ''
                ),
            );
        } else if(!is_numeric($value)) {
            return array(
                'code' => -1,
                'msg' => '当前输入内容不是数字,请输入数字',
                'data' => array(
                    'result'=> ''
                ),
            );
        } else if($value <= 0) {
            return array(
                'code' => -1,
                'msg' => '其中一个数字小于或等于0，请输入大于0的数',
                'data' => array(
                    'result'=> ''
                ),
            );
        } else if($value > 100) {
            return array(
                'code' => -1,
                'msg' => '其中一个数字大于100，请输入小于100的数',
                'data' => array(
                    'result'=> ''
                ),
            );
        } else if($len == 1) {
            $y1 = 1;
            for($x = 2; $x <= $n[0]; $x++) {
                $y1 = $y1 * $x;
            }
            return array(
                'code' => 0,
                'msg' => '操作成功',
                'data' => array(
                    'result' => $y1
                ),
            );
        } else {
            $y = 1;
            for($x = 2; $x <= $value; $x++) {
                $y = $y * $x;
            }
            array_push($array, $y);
        }
    }
    $y = 0;
    foreach ($array as $value) {
        $y += $value;
    }
    return array(
        'code' => 0,
        'msg' => '操作成功',
        'data' => array(
            'result' => $y
        ),
    );
}