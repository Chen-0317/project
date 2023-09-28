<?php
if(isset($_POST["username"]) && isset($_POST["password"])){
    if($_POST["username"] != "" && $_POST["password"] != ""){
        $username = $_POST["username"];
        $password = substr(md5($_POST["password"]), 5, 3).substr(md5($_POST["password"]), 24, 3);

        require_once "dbtools.php";

        $conn = create_connect();
        $sql = "SELECT Username ,Password FROM member where Username = '$username' AND Password = '$password'";
        
        $result = execute_sql($conn, "project", $sql);
        
        if(mysqli_num_rows($result) == 1){
            // 登入成功
            // 1. 產生 uid01 回傳至前端 ( 儲存至Cookie )
            // 2. 儲存至資料庫
            $uid = substr(hash('sha256', uniqid(time())),0,10);
            $sql = "UPDATE member SET Uid = '$uid' where Username = '$username'";

            if(execute_sql($conn, 'project', $sql)){
                // 撈取出最新的會員資料
                $sql = "SELECT Level, Username, Nickname, Email, Phone, Photo, Uid, UserState FROM member where Username = '$username' AND Password = '$password'";
                $result = execute_sql($conn, 'project', $sql);

                $mydata = array();
                while($row = mysqli_fetch_assoc($result)){
                    $mydata[] = $row;
                }

                echo '{"state" : true, "message" : "登入成功!", "data" : '.json_encode($mydata).'}';
            }else{
                echo '{"state" : false, "message" : "Uid 更新失敗"}';
            }
        }else{
            echo '{"state" : false, "message" : "登入失敗!"}';
        }
        mysqli_close($conn);
    }else{
        echo '{"state" : false, "message" : "不得為空白"}';
    }
}else{
    echo '{"state" : false, "message" : "欄位錯誤"}';
}
    
    
// "username: 帳號(不得為空白，必須存在)
// password: 密碼"



// "{""state"" : true, ""message"" : ""登入成功!""}
// {""state"" : false, ""message"" : ""登入失敗!""}
// {""state"" : false, ""message"" : ""不得為空白""}
// {""state"" : false, ""message"" : ""欄位錯誤""}"
