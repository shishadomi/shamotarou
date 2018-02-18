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
<title>残業申請</title>
</head>
<body>
<form action="confirm/" method="post">
  <input type="time" name="time" value="18:00">
  <input type="text" name="title">
  <textarea name="message" rows="8" cols="30">メッセージを入れましょう</textarea>
  <button type="submit">そうしん</button>
</form>
</body>
</html>
