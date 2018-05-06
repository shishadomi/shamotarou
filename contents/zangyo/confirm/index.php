<?php
session_start();

$_SESSION['time'] = $_POST['time'];
$_SESSION['title'] = $_POST['title'];
$_SESSION['message'] = $_POST['message'];
date_default_timezone_set('Asia/Tokyo');
$y = date("y");
$m = date("m");
$d = date("d");

$except = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES => false);


//$options = array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET CHARACTER SET 'utf8'");
ini_set( 'display_errors', 1 );
try {
    $pdo = new PDO('mysql:host=localhost;dbname=shisha;charset=utf8', 'root', '', $except);
    $threadName = '【勤怠】'.$y.$m.$d;
    $stmt = $pdo -> prepare("INSERT INTO chat_room (room_name, room_flg) VALUES (:title, 1)");
    $stmt->bindParam(':title', $threadName, PDO::PARAM_STR);
    $stmt->execute();
} catch (PDOException $e) {
    exit('データベース接続失敗。'.$e->getMessage());
}



?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<meta  name="viewport" content="width=device-width,initial-scale=1">
<meta name="robots" content="noindex,nofollow">
<!-- アイコンの設定 -->
<!-- <link rel="icon" href="#" sizes="16x16" type="images/png >"-->
<!-- <link rel="apple-touch-icon-precomposed" href="#" />"-->
<link rel="stylesheet" href="index.css">
<script src="index.js"></script>
<title>入力確認画面</title>
</head>
<html>
<body>
<table>
  <tr>
    <td>時間</td>
    <td><?php echo $_POST['time']; ?></td>
  </tr>
  <tr>
    <td>件名</td>
    <td><?php echo $_POST['title']; ?></td>
  </tr>
  <tr>
    <td>メッセージ</td>
    <td><?php echo $_POST['message']; ?></td>
  </tr>
</table>
<a href="../sendMail">送信</a>
<a href="../">戻る</a>
</body>
</html>
      
