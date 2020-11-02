<?php
	if($_COOKIE['islogin']!=1){
		header("location:login.php");
	}
		
	require("connect.php");
	$username=$_COOKIE['username'];
	$sql="select * from user where username='{$username}'";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link href="Css/bootstrap.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="Js/jquery.js"></script>
	<script type="text/javascript" src="Js/style.js"></script>
</head>
<body>
	<div class="container">
		<h2 class="text-center" style="height:100px;line-height:100px;">ユーザ情報変更</h2>
		<table class="table">
			<tr class="row">
				<td class="col-lg-2 col-md-2 col-sm-4 col-xs-4">アバター：</td>
				<td class="col-lg-4 col-md-4 col-sm-6 col-xs-6"><img src="<?php echo './img/'.$row['imgpath']; ?>" width='150' height='150'></td>
			</tr>

			<form action="action.php?a=updateinfo" method="post" enctype="multipart/form-data">
				<tr class="row">
					<td class="col-lg-2 col-md-2 col-sm-4 col-xs-4">アバター変更：</td>
					<td class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
						<input type="file" name="imgpath" id="file">
					</td>
				</tr>

				<tr class="row">
					<td class="col-lg-2 col-md-2 col-sm-4 col-xs-4">アバタープレビュー：</td>
					<td class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
						<img src="" id="img" width="250"/>
						<input type="submit" value="アバターアップロード" />
					</td>
				</tr>
			</form>

			<form action="action.php?a=updateuser" method="post">
			<tr class="row">
				<td class="col-lg-2 col-md-2 col-sm-4 col-xs-4">ユーザ名：</td>
				<td class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
					<input type="text" name="username" value="<?php echo $row['username']; ?>" class="form-control" required placeholder="ユーザ名を入力してください">
				</td>
			</tr>

			<tr class="row">
				<td class="col-lg-2 col-md-2 col-sm-4 col-xs-4">パスワード：</td>
				<td class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
					<input type="password" name="userpass" class="form-control" required placeholder="パスワードを入力してください">
				</td>
			</tr>
			<tr class="row">
				<td class="col-lg-2 col-md-2 col-sm-4 col-xs-4">パスワード確認：</td>
				<td class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
					<input type="password" name="reuserpass" class="form-control" required placeholder="も一度パスワードを入力してください">
				</td>
			</tr>
			<tr class="row">
				<td colspan="2"></td>
			</tr>
		</table>
		<div class="row text-center">
			<input type="submit" value="変更" class="btn btn-success">
			<a href="info.php" class="btn btn-default">キャンセル</a>&nbsp;&nbsp;
			<a href="index.php" style="font-size:12px;">ホームページ</a>
		</div>
		</form>
	</div>
</body>
</html>