<?php
session_start();
require_once ('db_inc.php');  // データベース接続
if ( !isset($_SESSION['urole']) || $_SESSION['urole']!=3 ) {
	// 教員としてログインしていなければ
	die('<h2>エラー：この機能を利用する権限がありません</h2>');
}
if(isset($_POST['decision'])){
	$decision = $_POST['decision'];
	//echo '<pre>';
	//print_r($decision);
	foreach ($decision as $sid=>$cid){
		$sql = "update tb_student set decision={$cid} where sid='{$sid}'";
		mysql_query($sql, $conn);
	}
}
header("Location:cs_decide.php");
?>