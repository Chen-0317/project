<?php

if (isset($_POST["nickname"]) && isset($_POST["email"]) && isset($_POST["phone"]) && isset($_POST["id"])) {
    
    if ($_POST["nickname"] !== "" && $_POST["email"] !== "" && $_POST["phone"] !== "" && $_POST["id"] !== "") {
        $p_nickname = $_POST["nickname"];
        $p_email = $_POST["email"];
        $p_phone = $_POST["phone"];
        // $p_photo = substr(hash('sha256', uniqid(time())), 0, 10) . '_' . $_FILES['file']['name'];
        $p_id = $_POST["id"];

        require_once "dbtools.php";
        $conn = create_connect();

        $sql = "UPDATE member SET Nickname = '$p_nickname', Email = '$p_email', Phone = '$p_phone' WHERE ID = '$p_id'";

        if (execute_sql($conn, 'project', $sql)) {
            echo '{"state" : true, "message" : "更新成功!"}';
        } else {
            echo '{"state" : false, "message" : "更新失敗!"}';
        }

        mysqli_close($conn);

    } else {
        echo '{"state" : false, "message" : "不得為空白"}';
    }
} else {
    echo '{"state" : false, "message" : "欄位錯誤"}';
}
