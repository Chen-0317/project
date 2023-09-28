<?php

require_once "dbtools.php";

$conn = create_connect();
$sql = "SELECT ID, Level, Username, Nickname, Email, Phone, Photo, UserState, Created_at FROM member ORDER BY ID DESC";  // ORDER BY ID DESC 依照ID (DESC)遞減(ASC)遞增
$result = execute_sql($conn, 'project', $sql);

if ( mysqli_num_rows($result) > 0) {
    $mydata = array();
    while( $row = mysqli_fetch_assoc($result)){
        $mydata[] = $row;
    }
    echo '{"state" : true, "message" : "取得會員資料成功!","data" : '.json_encode($mydata).'}';
} else {
   echo '{"state" : false, "message" : "查無會員資料!"}';
}
mysqli_close($conn);
