<?php
session_start();
ini_set("session.bug_compat_42", 0);
ini_set("session.bug_compat_warn", 0);
include ('db_inc.php');
date_default_timezone_set('Asia/Tokyo');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>コース希望</title>

<!-- Bootstrap -->
<link rel="stylesheet" type="text/css" media="screen"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link href="css/smoke.min.css" rel="stylesheet">
<!-- CSS -->
<link rel="stylesheet" href="../common/css/common.css">
<link rel="stylesheet" href="css/style.css">
<script	src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<link rel="stylesheet" href="../lib/yycountdown/common/css/reset.css">
<link rel="stylesheet" href="../lib/yycountdown/common/css/common.css">
<link rel="stylesheet" href="../lib/yycountdown/css/jquery.yycountdown.css">
<script type="text/javascript" src="../lib/yycountdown/js/jquery.yycountdown.min.js"></script>
<link rel="stylesheet" href="../css/stylesheet.css">
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container-fluid">
<div class="clearfix">
  <div class="pull-left">
    <a href="index.php"><img src="../img/Course Selection System-logo.png" class="img-responsive" alt="title" align="left"> </a>
  </div>
  <div class="pull-right">
<?php
  $sql = "SELECT * FROM tb_schedule";
  $rs = mysql_query($sql, $conn);
  if (!$rs) die ('エラー: ' . mysql_error());
  $row = mysql_fetch_array($rs) ;
  $ltime=$row['ltime'];
  list($y,$m,$d) = explode('-',substr($ltime,0,10));
  $dlt = "{$m}月${d}日";
?>
  <div id="contents">
    <div class="inner">
      <div id="countdownDate">締め切り<?= $dlt ?>まで</div>
      <div id="timer"></div>
    </div>
  </div>
  <script type="text/javascript">
    $("#timer").yycountdown({
      endDateTime   : '<?= $ltime ?>',
      unit          : {d: '日', h: '時間', m: '分', s: '秒'},
      complete : function(_this){
        _this.find('.yycountdown-box').text('調査期間外です');
      }
    });
  </script>
  </div>
</div>

<!-- ナビバー -->
<nav class="navbar navbar-inverse">

<div class="navbar-header">
  <button type="button" class="navbar-toggle collapsed"
    data-toggle="collapse" data-target="#navbarEexample3">
    <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span>
    <span class="icon-bar"></span> <span class="icon-bar"></span>
  </button>
</div>
<div class="collapse navbar-collapse" id="navbarEexample3">
<?php
$menu = array(
  0 => array(  //共通メニュー:未ログイン
    'ホーム'  => 'index.php',
  ),
  -2 => array(  //共通メニュー:ログイン中
    'パスワード変更' => 'passwd_change.php',
    'ログアウト'  => 'logout.php'
  ),
  -1 => array(  //共通メニュー:未ログイン
    'ログイン'  => 'login.php',
  ),
  -2 => array(  //共通メニュー:ログイン中
    'パスワード変更' => 'passwd_change.php',
    'ログアウト'  => 'logout.php'
  ),
  1 => array(  //学生メニュー
    '希望提出' => 'cs_wish.php' , 
    '希望状況' => 'cs_decide.php',
  ),
  2 => array(  //教員メニュー
    '希望状況' => 'cs_decide.php',
  ),
  3 => array(  //教員メニュー
   '年度設定'  => 'cs_year.php',
   'コース決定'  => 'cs_decide.php',
  )
);
make_menu($menu[0], 'left');
 if (isset($_SESSION['urole'])){
    $urole = $_SESSION['urole']; 
    make_menu($menu[$urole], 'left');
    make_menu($menu[-2], 'right');
 }else{//未ログインの場合
    make_menu($menu[-1],'right');
 }

 function make_menu($m,$d){
  echo '<ul class="nav navbar-nav navbar-'.$d.'">';
  foreach($m as $label=>$url){
    echo '<li><a href="'.$url.'">'.$label.'</a></li>';
  }
  echo '</ul>';
 }
 ?>

</div>
</nav>
<br>
