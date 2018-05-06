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

<?php
  try {
      $pdo = new PDO('mysql:host=localhost;dbname=shisha;charset=utf8', 'root', '', $except);
      $smt = $pdo->query('select * from chat_room where room_flg = 1 order by id desc limit 1');
    // 実行結果を配列に返す。
    $selectData = $smt->fetchAll();
  } catch (PDOException $e) {
      exit('データベース接続失敗。'.$e->getMessage());
  }
 ?>
<a href="../contents/chat?id=<?php echo($selectData[0]["id"].'&user='.$_SESSION['user']); ?>"><?php echo($selectData[0]["room_name"]); ?></a>
</body>
</html>



