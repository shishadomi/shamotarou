<?php
session_start();

$_SESSION['title'] = $_POST['title'];
$_SESSION['contents'] = $_POST['contents'];
$_SESSION['url'] = $_POST['url'];
?>

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
<title>ナレッジシェア投稿確認</title>
</head>
<body>
  <form class="inputArea" method="post" action="../query/">
    <h2>タイトル</h2>
    <div><?php echo $_POST['title']; ?></div>
    <h2>コンテンツ</h2>
    <div><?php echo $_POST['contents']; ?></div>
    <h2>参考URL</h2>
    <div><?php echo $_POST['url']; ?></div>
    <button type="button" onclick="history.back()">戻る</button>
    <button type="submit">投稿する</button>
  </form>
</body>
</html>
