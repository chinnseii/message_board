<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ログイン</title>
	<link href="Css/bootstrap.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="Js/jquery.js"></script>
	<script type="text/javascript" src="Js/style.js"></script>
</head>
<body style="margin-top:5%">
	<center >
		<h5>アカウントありますん？<a href="register.php">新規登録</a></h5>
		<h3 style="line-height:80px;height:80px;">ログイン</h3>
		<form action="action.php?a=login" method="post">
			<div class="col-lg-4 col-md-4 col-lg-offset-4">
			<table border="0" width="450" class="table">
				<tr>
					<td>ユーザ名：</td>
					<td><input type="text" name="username" class="form-control" required id="username"></td>
				</tr>
				<tr>
					<td>パスワード：</td>
					<td><input type="password" name="userpass" class="form-control" required></td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" value="サインイン" class="btn btn-success">
						<input type="reset" value="キャンセル" class="btn btn-default">
					</td>
				</tr>
			</table>
		</div>
		</form>
	</center>
</body>
</html>