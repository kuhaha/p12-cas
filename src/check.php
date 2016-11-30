<?php
include_once('db_inc.php');
$u = $_POST['uid'] ;  //ログイン画面より送信されたユーザID、例えば,'k12jk230';
$p = $_POST['pass'];  //ログイン画面より送信されたパスワード、例えば,'ar37';
$sql = "SELECT * FROM tb_user WHERE uid='$u' AND upass='$p'";
$rs = mysql_query($sql, $conn);//SQL文をサーバーに送信し実行
if (!$rs) die('エラー: ' . mysql_error());
$row= mysql_fetch_array($rs);//問合せ結果を1行受け取る

if ($row){ //問合せ結果がある場合、ログイン成功
  session_start();
	$_SESSION['uid']   = $row['uid'];
	$_SESSION['uname'] = $row['uname'];
	$_SESSION['urole'] = $row['urole'];
  if ($row['urole']==1){// 学生なら
    $sql = "SELECT * FROM tb_student WHERE uid='$u'";
    $rs = mysql_query($sql, $conn);//SQL文をサーバーに送信し実行
    if (!$rs) die('エラー: ' . mysql_error());
    $row= mysql_fetch_array($rs);//問合せ結果を1行受け取る
    if ($row){
      $_SESSION['sid'] = $row['sid'];
    }
  }
	header('Location:index.php');   // 画面転送
}else{
	include('page_header.php');
	echo '<h2>ログイン失敗！</h2>';
	echo '<h2>ユーザIDもしくはパスワードが間違いました！</h2>';
	echo '<a href="login.php">戻る</a>';	
	include('page_footer.php');//ページフッタを出力
}
?>