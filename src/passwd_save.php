<?php
include('page_header.php');
require_once ('db_inc.php');  // データベース接続

if (!isset($_SESSION['uid'])){
  die ("ログインしないとパスワードを変更できません");
}else{
  $uid = $_SESSION['uid'];
}
if (isset($_POST['pass'])){
  $pass = $_POST['pass']; //パスワード
  $pass1 = $_POST['pass1'];	//パスワード
  $pass2 = $_POST['pass2'];

  if($pass1==$pass2){
    $sql = "UPDATE tb_user SET upass='{$pass1}' WHERE uid='{$uid}' and upass='{$pass}'";
    include ('db_inc.php');
    $rs = mysql_query($sql, $conn);
    $n = mysql_affected_rows();
    if ($n > 0){
      echo '<h2>パスワードを変更しました。</h2>';
    }else{
      echo '<h2>パスワードが間違いました。</h2>';
    }
  }else{
  	echo 'パスワードが一致しません<br>';
  }
}else{
  echo '<h2>削除するユーザIDが与えられていません</h2>';

}


include('page_footer.php');
?>