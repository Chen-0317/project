<?php

if (isset($_POST["id"]) && isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
    if ($_FILES['file']['type'] == 'image/jpeg' || $_FILES['file']['type'] == 'image/png') {

        $p_photo = substr(hash('sha256', uniqid(time())), 0, 10) . '_' . $_FILES['file']['name'];

        $location = '../mem_img_upload/' . $p_photo;
        move_uploaded_file($_FILES['file']['tmp_name'], $location);

        $datainfo = array();
        $datainfo["location_name"] = $location;
        $datainfo["original_name"] = $_FILES['file']['name'];
        $datainfo["type"] = $_FILES['file']['type'];
        $datainfo["size"] = $_FILES['file']['size'];
        $datainfo["tmp_name"] = $_FILES['file']['tmp_name'];

        $p_id = $_POST["id"];

        require_once "dbtools.php";
        $conn = create_connect();
        $sql = "UPDATE member SET Photo = '$p_photo' WHERE ID = '$p_id'";

        if (execute_sql($conn, 'project', $sql)) {
            echo '{"state":true, "message":"圖片上傳成功", "datainfo":' . json_encode($datainfo) . '}';
        } else {
            echo '{"state":false, "message":"圖片上傳失敗", "datainfo":' . json_encode($datainfo) . '}';
        }

        mysqli_close($conn);

    } else {
        echo '{"state":false, "message":"檔案不符合規定 ( png or jpg )"}';
    }
} else {
    echo '{"state":false, "message":"檔案不存在"}';
}
