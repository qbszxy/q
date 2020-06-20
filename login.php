<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/6/19
 * Time: 13:01
 */

session_start();
require_once('dbconnection.php');

$data = array();
$data['code'] = -1;
$data['msg'] = '';
$data['data'] = array();
if(isset($_POST['account']) && isset($_POST['password'])){
    $account = $_POST['account'];
    $password = $_POST['password'];
    if($account == '') {
        $data['msg'] = '用户名不能为空';
        echo json_encode($data);
        return false;
    } else if($password == '') {
        $data['msg'] = '密码不能为空';
        echo json_encode($data);
        return false;
    } else {
//        $user = new UserModel;
//        $userList = UserModel::all();
        $userList = mysqli_query($con,"SELECT * FROM think_user");
        foreach ($userList as $value) {
            if($value['account'] == $account && $value['password'] == $password) {
                $userId = $value['id'];
                $account = $value['account'];
                $_SESSION['userId'] = $userId;
                $_SESSION['account'] = $account;
                $data['code'] = 0;
                $data['msg'] = '登录成功';
                echo json_encode($data);
                return false;
            }
        }
        $data['msg'] = '用户名或密码错误';
        echo json_encode($data);
        return false;
    }
} else {
    $data['msg'] = '请输入用户名或密码';
    echo json_encode($data);
    return false;
}






