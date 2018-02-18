<?php

session_start();

$_SESSION['time'] = $_POST['time'];
$_SESSION['title'] = $_POST['title'];
$_SESSION['message'] = $_POST['message'];
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
      
