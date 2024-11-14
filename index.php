<?php
  //カウント数が記録してあるファイルを読み書きできるモードで開く
  $fp = fopen('count.dat', 'r+b');

  //ファイルを排他ロックする
  flock($fp, LOCK_EX);

  //ファイルからカウント数を取得する
  $count = fgets($fp);

  //カウント数を1増やす
  $count++;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>アクセスカウンター</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>アクセスカウンター</h1>
  <div class="counter-area">
    <!-- ファイルから取得したカウント数を表示する -->
    <span class="access-count"><?php echo $count; ?></span>
  </div><!-- /.counter-area -->
</body>
</html>

<?php
  //ポインターをファイルの先頭に戻す
  rewind($fp);

  //最新のアクセス数をファイルに書き込む
  fwrite($fp, $count);

  //ファイルのロックを解除する
  flock($fp, LOCK_UN);

  //ファイルを閉じる
  fclose($fp);
?>