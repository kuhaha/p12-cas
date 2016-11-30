<?php
include('page_header.php');  //画面出力開始
require_once('db_inc.php');  //データベース接続

$year = date('Y');
$min_credit = array();
$min_gpa 		= array();
$courses 		= array(0=>'未決定');

$sql="SELECT * FROM tb_course";
$rs = mysql_query($sql, $conn);
if (!$rs) die ('エラー: ' . mysql_error());
$row = mysql_fetch_array($rs) ;
while($row){
	$cid = $row['cid'];
	$courses[$cid] =$row['cname'];
	$min_credit[$cid] = $row['min_credit'];
	$min_gpa   [$cid] = $row['min_gpa'];
	$row = mysql_fetch_array($rs) ;
}
$sql = "SELECT * FROM vw_kibo";
$rs = mysql_query($sql, $conn);
if (!$rs) die ('エラー: ' . mysql_error());
$row = mysql_fetch_array($rs) ;
echo "<h2>希望状況・決定状況一覧</h3>";
echo '<table class="table table-striped table-hover table-bordered">';
echo '<tr class="info"><th>学籍番号</th><th>氏名</th><th>希望コース</th><th>決定コース</th>';
if (isset($_SESSION['urole'])){
	if ($_SESSION['urole'] ==2 || $_SESSION['urole'] ==3){
		echo '<th>取得単位</th><th>累積GPA</th>';
	}
	if ($_SESSION['urole'] ==1 || $_SESSION['urole'] ==2){
		echo '<th>自己アピール</th></th>';
	}
	if  ($_SESSION['urole'] ==3 ){
		echo '<form action="cs_decide_save.php" name="frmPeropero" class="form-horizontal" method="POST">';
		echo '<input type="hidden" name="year" value="'.$year.'">';
		echo '<th>コース決定</th></tr>';
	}
}
$class = array('danger','active','success');

while($row){
	$cid   = $row['cid'];
	$sid   = $row['sid'];
	$credit = $row['allgp'];
	$gpa    = $row['allgpa'];
	$j  		= judge($min_credit,$min_gpa,$credit,$gpa);
	$did 		= $row['decision'];
	$decision = $courses[$did];
	echo '<tr>';
	//echo '<input type="hidden" name="uid[]" value="'.$row['uid'].'">';
	echo '<td>' . $row['sid'] . '</td>';
	echo '<td>' . $row['sname']. '</td>';
	echo '<td class="'.$class[$cid].'">' . $row['cname']  . '</td>';
	echo '<td class="'.$class[$did].'">' . $decision  . '</td>';
	if (isset($_SESSION['urole'])){
		if ($_SESSION['urole'] ==2 || $_SESSION['urole'] ==3){
			echo '<td class="'.$class[$j]  .'">' . $row['allgp'] . '</td>';
			echo '<td class="'.$class[$j]  .'">' . $row['allgpa'] . '</td>';
		}
		if ($_SESSION['urole'] ==1 || $_SESSION['urole'] ==2){
			echo '<td class="'.$class[$j]  .'">' . $row['note'] . '</td>';
		}

		if ($_SESSION['urole'] ==3 ){
			echo '<td>';
			$not_checked = true;
			foreach ($courses as $id => $val){
				if ($id > 0) {
					$checked = "";	
					if ($not_checked and ($id==$did || $id==$cid || $id==$j)) {
						$checked = "checked";
						$not_checked = false;
					}
					radio("decision[$sid]",$id, $val, $checked);
				}
			}
			echo '</td>';
		}
	}
	echo '</tr>';
	$row = mysql_fetch_array($rs) ;
}
echo '</table>';
if (isset($_SESSION['urole']) and $_SESSION['urole'] ==3 ){
	echo '<input type="submit" class="btn btn-primary btn-block" value="決定">';
	echo'</form>';
}
include('page_footer.php');  //画面出力終了

function radio($name,$id, $val, $checked){
	echo '<input class="radio-inline" type="radio" name="'.$name.'" value="'.$id.'" '.$checked.'>' . $val;
}
function judge($min_credit,$min_gpa,$credit,$gpa){
	arsort($min_credit);
	$cid = 1;
	foreach ($min_credit as $cid => $m_credit){
		if ($credit>=$m_credit and $gpa>=$min_gpa[$cid])
			return $cid;
	}
	return $cid;
}
?>