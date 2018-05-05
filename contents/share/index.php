<?php
session_start();
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
<title>ナレッジシェア投稿画面</title>
</head>
<body>
  <form class="inputArea" method="post" action="confirm/">
    <h2>タイトル</h2>
    <input type="text" name="title" value="" placeholder="タイトル">
    <h2>コンテンツ</h2>
    <textarea name="contents" rows="15" cols="30"></textarea>
    <h2>参考URL</h2>
    <input type="text" name="url" value="">
    <button type="submit">確認</button>
  </form>
</body>
</html>
