<?php
session_start();
require_once ('db_inc.php');  
$msg = "";
if ( !isset($_SESSION['urole']) || $_SESSION['urole']!=1 ) {
	$msg = 'エラー：この機能を利用する権限がありません。';
}else {
	$sid  = $_SESSION['sid']; 
	if (isset($_POST['cid'])){
		$cid  = $_POST['cid'] ;
		$note = $_POST['note'];
		$act  = $_POST['act'] ;
		$sql = "SELECT * FROM tb_course WHERE cid=" .$cid;
		$rs = mysql_query($sql, $conn);
		if (!$rs) $msg = 'エラー: ' . mysql_error();
		$row = mysql_fetch_array($rs) ;
		$cname = $row['cname'];
		if ($act == 'insert'){
			$sql = "INSERT INTO tb_entry VALUES('$sid','$cid',now(), '$note')";
		}else{
			$sql = "UPDATE tb_entry SET cid='$cid', etime=now(), note='$note' WHERE sid='$sid'";
		}
		$rs = mysql_query($sql, $conn); 
		if (!$rs){
			$msg = 'エラー：登録が失敗しました';
		}else{
			header('Location:cs_decide.php');
		}
	}else{ 
		$msg = 'エラー：希望コースが選択されていません';
	}
}
if (!empty($msg)){
	include("page_header.php");
	echo '<h2　class="text-danger">' . $msg . '</h2>';
	include("page_footer.php");
}
?>
