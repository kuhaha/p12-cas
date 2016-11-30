<?php
include('page_header.php');
include ('db_inc.php');
if (isset($_SESSION['uid'])){
	$uid = $_SESSION['uid'];
	$sql = "SELECT * FROM tb_user WHERE uid='{$uid}'";
	$rs = mysql_query($sql, $conn);
	$row = mysql_fetch_array($rs) ;
	echo '<h2>'.$row['uname'].'さんのパスワードを変更します。</h2>';
}
?>
<form class="form-horizontal" id="formEqualPass" data-smk-icon="glyphicon-remove-sign" method="post" action="passwd_save.php">
<div class="container bg-info">
			<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<input type="password" name="pass" class="form-control" id="pass" placeholder="現在のパスワード" required>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<input type="password" name="pass1" class="form-control" id="pass1" placeholder="新しいパスワード" required>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<input type="password" name="pass2" class="form-control" id="pass2" placeholder="パスワード再入力" required>
			</div>
		</div>
</div>
<div class="container">
    <div class="col-sm-offset-2 col-sm-10">
    <input type="submit" id="btn-validate" class="btn btn-primary btn-block" value="保存">
    </div>
</div>
</form>
<?php include('page_footer.php');?>