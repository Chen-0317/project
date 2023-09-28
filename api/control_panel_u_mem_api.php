<?php
if(isset($_POST["id"]) && isset($_POST["level"]) && isset($_POST["username"]) && isset($_POST["nickname"]) && isset($_POST["email"]) && isset($_POST["phone"])){
    if($_POST["id"] != "" && $_POST["level"] != "" && $_POST["username"] != "" && $_POST["nickname"] != "" && $_POST["email"] != "" && $_POST["phone"] != "" ){
        $id         = $_POST["id"];
        $level   = $_POST["level"];
        $username   = $_POST["username"];
        $nickname   = $_POST["nickname"];
        $email      = $_POST["email"];
        $phone      = $_POST["phone"];

        require_once "dbtools.php";

        $conn = create_connect();
        $sql = "UPDATE member SET Level = '$level', Username = '$username', Nickname = '$nickname', Email = '$email', Phone = '$phone'WHERE ID = '$id'";
        if(execute_sql($conn, 'project', $sql)){
            echo '{"state" : true, "message" : "更新成功!"}';
        }else{
            echo '{"state" : false, "message" : "更新失敗!"}';
        }
        mysqli_close($conn);
    }else{
        echo '{"state" : false, "message" : "不得為空白"}';
    }
}else{
    echo '{"state" : false, "message" : "欄位錯誤"}';
}