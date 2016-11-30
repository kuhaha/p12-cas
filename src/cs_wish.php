<?php
include('page_header.php');
require_once ('db_inc.php');  // データベース接続
?>

<?php
if ( !isset($_SESSION['urole']) || $_SESSION['urole']!=1 ) {
	echo '<h1 style="color:red;">学生以外はこの機能を利用できません!</h1>';
	include('page_footer.php');
	exit;
}
$uid   = $_SESSION['uid'];   
$uname = $_SESSION['uname']; 
$sql = "select * from tb_schedule where stime<=now() and ltime>=now()";
$rs = mysql_query($sql, $conn);
if (!$rs) die ('エラー: ' . mysql_error());
$row = mysql_fetch_array($rs) ;
if(!$row){
	echo '<h1 style="color:red;">提出期間外のため希望提出できません!</h1>';
	include('page_footer.php');
	exit;
}	

$sql = "SELECT * FROM tb_student WHERE uid='$uid'";
$rs = mysql_query($sql, $conn);
if (!$rs) die ('エラー: ' . mysql_error());
$row = mysql_fetch_array($rs) ;
if($row){
	$sid = $row['sid'];
	$my_halfgp = $row['halfgp'];
	$my_halfgpa = $row['halfgpa'];

}	

$sql = "SELECT * FROM tb_course where cid=2";
$rs = mysql_query($sql, $conn);
$row = mysql_fetch_array($rs) ;
$cname	=		$row['cname'];
$min_credit	= $row['min_credit'];
$min_gpa		= $row['min_gpa'];

$cid = 1;         //希望のコースID;
$note = '';
$act = 'insert';  //初回登録?（insert: 初回登録; update: 再登録）;
//コース決定済みでないかチェック
$sql = "select * from tb_entry where sid='$sid'";
$rs = mysql_query($sql, $conn);
if (!$rs) die ('エラー: ' . mysql_error());
$row = mysql_fetch_array($rs) ;
if($row){
	$cid = $row['cid']; // 現在登録しているコースのID
	$note = $row['note'];
	$act = 'update';    // すでに登録したため「再登録」とする
}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<style>
  .container-canvas {
    margin-right: auto;
    margin-left: auto;
    width: 400px;
  }
</style>
<h2 class="bg-info">総合コース登録要件チェック</h2>
<div class="container-fluid">
  <div class="form-group">
		<label class="control-label col-sm-1" for="gp"></label>
		<div class="container-canvas col-xs-6 col-sm-5 col-md-2">
    	<canvas id="myChart1" width="10" height="10"></canvas></div>
		<div class="container-canvas col-xs-6 col-sm-5 col-md-2">
  	  <canvas id="myChart2" width="10" height="10"></canvas></div>
  </div>
</div>

<script>

var gp = {
	title:  "総合コース登録要件（修得単位数）",
	labels: ["必要な単位数", "あなたの単位数"],
	data : [38, <?=$my_halfgp ?>]
};
var gpa = {
	title:  "総合コース登録要件（GPA）",
	labels: ["必要なGPA", "あなたのGPA"],
	data : [2.0, <?=$my_halfgpa ?>]
};

var graph　= function (options){
	return {
    type: 'bar',
    data: {
      labels: options.labels,
      datasets: [{
        data: options.data,
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)'
        ],
        borderColor: [
          'rgba(255,99,132,1)',
          'rgba(54, 162, 235, 1)'
        ],
        borderWidth: 1
      }]
    },
    options:  {
		  scales: {
        xAxes: [{
          barThickness : 80,  
        }],
		    yAxes: [{
		      ticks: {
		        beginAtZero:true
		      }
		    }]
		  },
		  title: {
        display: true,
        text: options.title,
      },
		  legend: {
		    display: false,
		  }
		}
	};
}
var ctx1 = document.getElementById("myChart1");
var ctx2 = document.getElementById("myChart2");
var myChart1 = new Chart(ctx1, graph(gp));
var myChart2 = new Chart(ctx2, graph(gpa));
</script>

<h2 class="bg-info">コース希望登録</h2>
 <form class="form-horizontal"　 action="cs_wish_save.php" method="post">
 <input type="hidden" name="act" value="<?=$act ?>"> 
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">希望コース：</label>
    <div class="col-sm-10">
  <?php
		$sql = "select * from tb_course ";
		$rs = mysql_query($sql, $conn);
		if (!$rs) die ('エラー: ' . mysql_error());
		$row = mysql_fetch_array($rs) ;
		while($row){
			if ($row['cid'] == $cid){  
				echo '<input class="radio-inline" type="radio" name="cid" value="'.$row['cid'].'" checked>'.$row['cname'];
			}else if($row['cid'] != $cid){
				echo '<input class="radio-inline" type="radio" name="cid" value="'.$row['cid'].'">'.$row['cname'];
			}
			$row = mysql_fetch_array($rs) ;
		}
	?>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">自己アピール:</label>
    <div class="col-sm-10">
      <textarea class="form-control" name ="note" rows="4" placeholder="大学生活や今後の目標ついて自己アピールしてください。例えば、数学やプログラミングに自信があります。卒業後にぜひIT系企業で働きたいです。"><?=$note ?></textarea>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">登　録</button>
    </div>
  </div>
</form>
<?php
include('page_footer.php');//画面出力終了
?>