<?php
if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["nickname"]) && isset($_POST["email"]) && isset($_POST["phone"])){
    if($_POST["username"] != "" && $_POST["password"] != "" && $_POST["nickname"] != "" && $_POST["email"] != "" && $_POST["phone"] != ""){
        $username   = $_POST["username"];
        $password   = substr(md5($_POST["password"]), 5, 3).substr(md5($_POST["password"]), 24, 3); // 從第5個數字開始取3個+從第24個數字開始取3個
        $nickname   = $_POST["nickname"];
        $email      = $_POST["email"];
        $phone      = $_POST["phone"];

        require_once "dbtools.php";

        $conn = create_connect();
        $sql = "INSERT INTO member(Username, Password, Nickname, Email, Phone) VALUES('$username', '$password', '$nickname', '$email', '$phone')";
        if(execute_sql($conn, 'project', $sql)){
            echo '{"state" : true, "message" : "註冊成功!"}';
        }else{
            echo '{"state" : false, "message" : "註冊失敗!"}';
        }
        mysqli_close($conn);
    }else{
        echo '{"state" : false, "message" : "不得為空白"}';
    }
}else{
    echo '{"state" : false, "message" : "欄位錯誤"}';
}
    
    
// username: 帳號(不得為空白，必須存在)
// password: 密碼
// nickname: 暱稱
// email: 信箱
// phone: 手機電話

// {"state" : true, "message" : "註冊成功!"}
// {"state" : false, "message" : "註冊失敗!"}
// {"state" : false, "message" : "不得為空白"}
// {"state" : false, "message" : "欄位錯誤"}
