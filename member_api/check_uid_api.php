<?php
if (isset($_POST["uid"])) {
    if ($_POST["uid"] != "") {
        $uid = $_POST["uid"];

        require_once "dbtools.php";

        $conn = create_connect();
        $sql = "SELECT ID, Level, Username, Nickname, Email, Phone, Photo, Uid, Created_at FROM member where Uid = '$uid'";
        $result = execute_sql($conn, 'project', $sql);

        if (mysqli_num_rows($result) == 1) {
            $mydata = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $mydata[] = $row;
            }
            echo '{"state" : true, "message" : "Uid驗證成功!","data" : ' . json_encode($mydata) . '}';
        } else {
            echo '{"state" : false, "message" : "Uid驗證失敗!"}';
        }
        mysqli_close($conn);
    } else {
        echo '{"state" : false, "message" : "不得為空白"}';
    }
} else {
    echo '{"state" : false, "message" : "欄位錯誤"}';
}
