<?php
// 外部傳遞 pname, price, pnum, id
// 執行更新行為
// 使用 postman測試
// 四個欄位必須存在 且不為空白

// isset 必須存在

if (isset($_POST["pname"]) && isset($_POST["price"]) && isset($_POST["pnum"]) && isset($_POST["peffect"]) && isset($_POST["id"])) {
    
    if ($_POST["pname"] !== "" && $_POST["price"] !== "" && $_POST["pnum"] !== "" && $_POST["id"] !== "" && $_POST["peffect"] !== "") {

        $p_pname = $_POST["pname"];
        $p_price = $_POST["price"];
        $p_pnum = $_POST["pnum"];
        $p_peffect = $_POST["peffect"];
        $p_photo = $_FILES['file']['name'];
        $p_id = $_POST["id"];

        require_once "dbtools.php";
        $conn = create_connect();

        $sql = "UPDATE product SET P_name = '$p_pname', P_price = '$p_price', P_num = '$p_pnum', P_photo = '$p_photo', P_effect = '$p_peffect' WHERE ID = '$p_id'";

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
