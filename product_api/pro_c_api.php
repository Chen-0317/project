<?php
if (isset($_POST["pname"]) && isset($_POST["price"]) && isset($_POST["pnum"]) && isset($_POST["peffect"])) {
    if ($_POST["pname"] !== "" && $_POST["price"] !== "" && $_POST["pnum"] !== "" && $_POST["peffect"] !== "") {
        $p_pname = $_POST["pname"];
        // $_POST["pname"] -> 拋pname的資料進來
        $p_price = $_POST["price"];
        $p_pnum = $_POST["pnum"];
        $p_photo = $_POST['file'];
        $p_peffect = $_POST["peffect"];

        
        $servername = "localhost";
        $username = "owner01";
        $password = "123456";
        $dbname = "project";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("連線失敗" . mysqli_connect_error());
        }

        $sql = "INSERT INTO product(P_name, P_price, P_num, P_photo, P_effect) VALUE('$p_pname', '$p_price', '$p_pnum', '$p_photo', '$p_peffect')";
        if (mysqli_query($conn, $sql)) {
            echo '{"state" : true, "message" : "新增成功!"}';
            // 使用 json 格式顯示 / "state" : true 狀態為true
        } else {
            echo '{"state" : false, "message" : "新增失敗!"}';
        }

        mysqli_close($conn);
    } else {
        echo '{"state" : false, "message" : "不得為空白"}';
    }
} else {
    echo '{"state" : false, "message" : "欄位錯誤"}';
}
?>

