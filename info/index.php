<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta  name="viewport" content="width=device-width,initial-scale=1">
<meta name="robots" content="noindex,nofollow">
<!-- アイコンの設定 -->
<!-- <link rel="icon" href="#" sizes="16x16" type="images/png >"-->
<!-- <link rel="apple-touch-icon-precomposed" href="#" />"-->
<link rel="stylesheet" href="index.css">
<script src="index.js"></script>
<title>うぇるかめ</title>
</head>
<body>

<?php
    session_start();

    if ($_SESSION['user'] == 'ryo' || $_POST['user'] == 'ryo') {
        $_SESSION['user'] = 'ryo';
        print "あざとい、いい加減やめたら？";
    } elseif ($_SESSION['user'] == 'meyou' || $_POST['user'] == 'meyou') {
        $_SESSION['user'] = 'meyou';
        print "舞茸";
    } else {
        print "error";
    }
?>

  <a href="../contents/zangyo">残業申請</a>
  <a href="../contents/share">ナレッジシェア</a>
  <a href="../contents/chat">チャット</a>
</body>
</html>



