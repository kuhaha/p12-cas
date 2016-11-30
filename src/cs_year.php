<?php
include('page_header.php'); 
require_once('db_inc.php'); 
if (!isset($_SESSION['urole']) || $_SESSION['urole']!=3){
  die ("この機能を利用する権限はありません");
}
$date1 = date('Y-m-d H:i');
$y2 = date('Y')+1;
$date2 = date($y2 . '-1-d H:i');
if (isset($_POST['dt1']) and isset($_POST['dt2'])){
  $dt1 = $_POST['dt1'];
  $dt2 = $_POST['dt2'];
  $sql = "UPDATE tb_schedule SET stime='$dt1',ltime='$dt2'";
  $rs = mysql_query($sql, $conn);
  if (mysql_affected_rows()>0){
    echo '<h3>調査期間が更新されました！</h3>';
  }
}
$sql = "SELECT * FROM tb_schedule";
$rs = mysql_query($sql, $conn);
if ($rs){
  $row = mysql_fetch_array($rs);
  if ($row){
    $date1 = substr($row['stime'],0,16);
    $date2 = substr($row['ltime'],0,16);
    echo '<h3 class="bg-info">現在の調査期間</h3>';
    echo '<div>';
    echo '<table class="table table-striped table-hover table-bordered">';
    echo '<tr><td class="text-left"><h4 class="text-success">開始日時</h4></td><td><h4 class="text-success">' . $date1 . '</h4></td></tr>';
    echo '<tr><td class="text-left"><h4 class="text-danger">終了日時</h4></td><td><h4 class="text-danger">' . $date2 . '</h4></td></tr>';  
    echo '</table>';
  }
}

echo '<h2 class="bg-primary">調査期間編集</h2>';

?>

<form class="form-inline" method="post" action="cs_year.php">
<div class="col-sm-4">
  <label for="ex1">調査開始日時（<code>YYYY-MM-DD HH:MM</code>）</label>
    <input type="text" class="form-control" name="dt1" value="<?=$date1 ?>">
</div>
<div class="col-sm-4">
  <label for="ex1">調査終了日時（<code>YYYY-MM-DD HH:MM</code>）</label>
    <input type="text" class="form-control" name="dt2" value="<?=$date2 ?>">
</div>
<div class="col-sm-4">
  <input type="submit" class="btn btn-primary btn-block" value="保存">
</div>
</form>

<?php include('page_footer.php');?>