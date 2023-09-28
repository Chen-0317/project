<?php
/*
    echo $_FILES['file']['name'];
    echo '<br>';
    echo $_FILES['file']['type'];
    echo '<br>';
    echo $_FILES['file']['tmp_name']; // 暫存的名稱
    echo '<br>';
    echo $_FILES['file']['error'];
    echo '<br>';
    echo $_FILES['file']['size'];
    echo '<br>';

    // substr(hash('sha256',uniqid(time())),0,10);
    $location = 'upload/' .substr(hash('sha256',uniqid(time())),0,10).'_'. $_FILES['file']['name'];

    move_uploaded_file($_FILES['file']['tmp_name'],$location);
*/

// input: file ( png or jpeg )

// output: 
//{"state":true, "message":"檔案上傳成功", "datainfo":"檔案相關訊息 name/type/tmp_name/error/size"}
//{"state":false, "message":"檔案上傳失敗", "datainfo":"檔案相關訊息 name/type/tmp_name/error/size"}
//{"state":false, "message":"檔案不存在"}
//{"state":false, "message":"檔案不符合規定 ( png or jpg )"}

if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
    if ($_FILES['file']['type'] == 'image/jpeg' || $_FILES['file']['type'] == 'image/png') {

        $location = '../img_upload/' . substr(hash('sha256', uniqid(time())), 0, 10) . '_' . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $location);
        $uid = "id";

        $datainfo = array();
        $datainfo["location_name"] = $location;
        $datainfo["original_name"] = $_FILES['file']['name'];
        $datainfo["type"] = $_FILES['file']['type'];
        $datainfo["size"] = $_FILES['file']['size'];
        $datainfo["tmp_name"] = $_FILES['file']['tmp_name'];

        echo '{"state":true, "message":"檔案上傳成功", "datainfo":' . json_encode($datainfo) . '}';
    } else {
        echo '{"state":false, "message":"檔案不符合規定 ( png or jpg )"}';
    }
} else {
    echo '{"state":false, "message":"檔案不存在"}';
}
