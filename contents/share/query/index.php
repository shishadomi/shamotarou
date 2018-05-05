<?php
  session_start();

  $except = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES => false);
  ini_set( 'display_errors', 1 );
  try {
    $pdo = new PDO('mysql:host=localhost;dbname=shisha;charset=utf8', 'root', '', $except);
    $stmt = $pdo -> prepare("INSERT INTO knowledge (author, date, title, contents, url) VALUES (:author, :date, :title, :contents, :url)");
    $stmt->bindParam(':author', $_SESSION['user'], PDO::PARAM_STR);
    $created_at = new DateTime("now",new DateTimeZone('Asia/Tokyo'));
    $currentTime = $created_at->format('Y-m-d H:i:s');
    $stmt->bindParam(':date', $currentTime, PDO::PARAM_STR);
    $stmt->bindParam(':title', $_SESSION['title'], PDO::PARAM_STR);
    $stmt->bindParam(':contents', $_SESSION['contents'], PDO::PARAM_STR);
    $stmt->bindParam(':url', $_SESSION['url'], PDO::PARAM_STR);
    $stmt->execute();
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
  <h2>投稿が完了しました</h2>
</body>
</html>
