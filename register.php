<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link href="Css/bootstrap.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="Js/jquery.js"></script>
	<script type="text/javascript" src="Js/style.js"></script>
</head>
<body style="margin-top:5%">
	<center>
		<h5>アカウント持っています？<a href="login.php">ログイン</a></h5>
		<h3 style="line-height:80px;height:80px;">新規登録</h3>
		<form action="action.php?a=register" method="post" enctype="multipart/form-data">
		<div class="col-lg-4 col-md-4 col-lg-offset-4">
			<table border="0" width="450" class="table">
				<tr>
					<td>アバター：</td>
					<td><input type="file" name="imgpath" id="file" required><span style="font-size:12px;color:#888;">(写真タイプ：jpg,jpeg,png,gif)</span></td>
				</tr>
				<tr>
					<td>アバタープレビュー：</td>
					<td><img src=""  id="img" width="250" /></td>
				</tr>
				<tr>
					<td>ユーザ名：</td>
					<td><input type="text" name="username" class="form-control" required id="username"></td>
				</tr>
				<tr>
					<td>パスワード：</td>
					<td><input type="password" name="userpass" class="form-control" required></td>
				</tr>
				<tr>
					<td>パスワード確認：</td>
					<td><input type="password" name="confirm_pass" class="form-control"></td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" value="新規登録" class="btn btn-success">
						<input type="reset" value="キャンセル" class="btn btn-default">
					</td>
				</tr>
			</table>
		</div>
		</form>
	</center>

</body>
</html>