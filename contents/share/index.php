<?php
session_start();
	try {
		$except = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES => false);
		$pdo = new PDO('mysql:host=localhost;dbname=shisha;charset=utf8', 'root', '', $except);
		$stmt = $pdo -> prepare("select * from urlLink");
		$stmt->execute();
		$imgData = $stmt->fetchAll();
	} catch (PDOException $e) {
	    exit('データベース接続失敗。'.$e->getMessage());
	}
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
    <h2>画像</h2>
    <select name="img">
      <?php 
      foreach ($imgData as $img) { 
      	echo "<option value=" . $img["url"]. ">" . $img["title"] . "</option>";
      }
      ?>
      <option></option>
    </select>
    <button type="submit">確認</button>
  </form>
</body>
</html>
