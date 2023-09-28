<?php
if(isset($_POST["id"]) && isset($_POST["userstate"])){
    if($_POST["id"] != "" && $_POST["userstate"] != ""){

        $id         = $_POST["id"];
        $userstate  = $_POST["userstate"];

        require_once "dbtools.php";

        $conn = create_connect();
        $sql = "UPDATE member SET UserState = '$userstate' WHERE ID = '$id'";
        if(execute_sql($conn, 'project', $sql)){
            echo '{"state" : true, "message" : "狀態更新成功!"}';
        }else{
            echo '{"state" : false, "message" : "狀態更新失敗!"}';
        }
        mysqli_close($conn);
    }else{
        echo '{"state" : false, "message" : "不得為空白"}';
    }
}else{
    echo '{"state" : false, "message" : "欄位錯誤"}';
}