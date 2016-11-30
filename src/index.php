<?php
include ('page_header.php');
require_once('db_inc.php');  
$sql = "SELECT * FROM tb_course where cid=2";
$rs = mysql_query($sql, $conn);
$row = mysql_fetch_array($rs) ;
$cname	=		$row['cname'];
$min_credit	= $row['min_credit'];
$min_gpa		= sprintf("%.1f",$row['min_gpa']);
?>
<!-- phpでDBから要件の値を取得する -->

<div class="row">
<div class="col-sm-6 col-md-5">
<h1>登録要件</h1>
	<h3><?= $cname ?>に登録するには、１年次終了までに、次の各号に掲げる要件を満たさなければならない。</h3>
	<ul>
		<li><h3>1年次に配当されている授業科目を<?php echo $min_credit ?>単位以上修得していること。</h3></li>
		<li><h3>GPAが<?php echo $min_gpa; ?>以上であること。</h3></li>
	</ul>
</div>
<div class="col-sm-6 col-md-6">
	<img class="img-responsive center-block" src="http://www2.is.kyusan-u.ac.jp/files/uploads/modelcourses__large.png" />
</div>
</div>
<div class="row">
<?php
	$class=array(1=>'danger', 2=>'info');
	$sql = "SELECT cid, cname, detail FROM tb_course ORDER BY cid";
	$rs = mysql_query($sql, $conn);
	$row = mysql_fetch_array($rs) ;

	while ($row){
		$cid = $row['cid'];
		$myclass = $class[$cid];
		echo '<div class="col-sm-6 col-md-6 bg-'.$myclass.' row-eq-height">';
		echo '<h3 class="bg-'.$myclass.'"><strong>'.$row['cname'].'</strong><br>'. $row['detail']. '</h3>';
		$row = mysql_fetch_array($rs) ;
		echo '</div>';
	}
?>
</div>
<?php	
	include ('page_footer.php');
?>