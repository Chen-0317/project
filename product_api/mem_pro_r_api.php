<?php
$servername = "localhost";
$username = "owner01";
$password = "123456";
$dbname = "project";

//建立連線
$conn = mysqli_connect($servername, $username, $password, $dbname);

//確認連線
if (!$conn) {
    die("建立連線失敗" . mysqli_connect_error());
}

$sql = "SELECT ID, P_name, P_price, P_num, P_photo, P_effect FROM product";
$result = mysqli_query($conn, $sql);

// 改寫成陣列 -> 轉成 json 顯示
$mydata = array(); // $mydata 設為 一個陣列

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

        $mydata[] = $row;  // 要儲存 1維陣列 需使用2維陣列 才能儲存
        // echo $row["ID"];
        // echo $row["Pname"];
        // echo $row["Price"];
        // echo $row["Pnum"];
        // echo $row["Created_at"];
        // echo "<br>";
    }

    echo json_encode($mydata);
} else {
    echo "查無資料";
}




// $row = mysqli_fetch_assoc($result);
/* mysqli_fetch_assoc()這個程式 
        會將 $result (透過 $conn通道 將 $sql (從 product 使用 SELECT 查詢並撈取 ID, Pname, Price, Pnum, Created_at 的數據)) 以陣列方式 抓取導出
    */
// echo $row["ID"];
// echo $row["Pname"];
// echo $row["Price"];
// echo $row["Pnum"];
// echo $row["Created_at"];
// echo "<br>";


// $row = mysqli_fetch_assoc($result);

// echo $row["ID"];
// echo $row["Pname"];
// echo $row["Price"];
// echo $row["Pnum"];
// echo $row["Created_at"];
// echo "<br>";


// $row = mysqli_fetch_assoc($result);

// echo $row["ID"];
// echo $row["Pname"];
// echo $row["Price"];
// echo $row["Pnum"];
// echo $row["Created_at"];
// echo "<br>";

mysqli_close($conn);
    // 數據抓取完畢，務必將通道關閉
