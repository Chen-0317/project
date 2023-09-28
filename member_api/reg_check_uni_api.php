<?php
if(isset($_POST["username"])){
    if($_POST["username"] != "" ){
        $username = $_POST["username"];

        require_once "dbtools.php";

        $conn = create_connect();
        $sql = "SELECT Username FROM member where Username = '$username'";
        
        $result = execute_sql($conn, "project", $sql);
        
        if(mysqli_num_rows($result) == 0){
            echo '{"state" : true, "message" : "此帳號不存在，可以使用"}';
        }else{
            echo '{"state" : false, "message" : "此帳號存在，不可以使用!"}';
        }
        mysqli_close($conn);
    }else{
        echo '{"state" : false, "message" : "不得為空白"}';
    }
}else{
    echo '{"state" : false, "message" : "欄位錯誤"}';
}
    
    
// username: 帳號(不得為空白)，必須存在


// {"state" : true, "message" : "此帳號不存在，可以使用"}
// {"state" : false, "message" : "此帳號存在，不可以使用!"}
// {"state" : false, "message" : "不得為空白"}
// {"state" : false, "message" : "欄位錯誤"}"