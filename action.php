<?php 
	header("content-type:text/html;charset=utf-8");

	require("connect.php");

	$a=$_GET['a'];

	switch ($a) {
		case 'login':
			$username=trim($_POST['username']);
			$userpass=md5($_POST['userpass']);
			$sql="select * from user where username='{$username}' and userpass='{$userpass}'";
			$result=mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)>0){
				setcookie("username",$username);
				setcookie("islogin",1);
				echo "<script>alert('サインイン成功');window.location.href='index.php';</script>";
			}else{
				echo "<script>alert('無効なユーザ名、パスワードです。');window.location.href='login.php';</script>";
			}

			mysqli_close($conn);

			break;

		case 'quit':
			if($_COOKIE['islogin']=1){
				setcookie("islogin",null);
				header("location:index.php");
			}

			break;

		case 'message':
			$message_name=$_COOKIE['username'];//コメント主
			$sql_id="select id from user where username='{$message_name}'";
			$result=mysqli_query($conn,$sql_id);

			$ID=mysqli_fetch_assoc($result);
			foreach($ID as $id){}//コメント主id
			$message_content=$_POST['message_content'];//コメント内容
			$create_time=date("Y-m-d H:i:s",time());//コメント時間

			$sql="insert into message(message_content,create_time,id,message_name) values('{$message_content}','{$create_time}',{$id},'{$message_name}')";
			mysqli_query($conn,$sql);
			
			if(mysqli_affected_rows($conn)>0){
				echo "<script>alert('コメント成功');window.location.href='index.php';</script>";
			}else{
				echo "<script>alert('コメント失敗');window.location.href='index.php';</script>";
			}

			mysqli_close($conn);
			
			break;

		case 'delete_m':
			$sql="delete from message where message_id=".$_GET['message_id'];
			mysqli_query($conn,$sql);
			if(mysqli_affected_rows($conn)>0){
				echo "<script>alert('削除成功');window.location.href='index.php';</script>";
			}else{
				echo "<script>alert('削除失敗');window.location.href='index.php';</script>";
			}
			
			mysqli_close($conn);

			break;

		case 'reply':
			$reply_content=$_POST['reply_content'];

			$create_time=date("Y-m-d H:i:s",time());

			$message_id=$_GET['message_id'];

			$reply_name=$_COOKIE['username'];

			$sql_mname="select message_name from message where message_id=".$message_id;
			$result_mname=mysqli_query($conn,$sql_mname);
			$message_Name=mysqli_fetch_assoc($result_mname);
			foreach($message_Name as $message_name){}		

			$sql_id="select id from user where username='{$reply_name}'";
			$result=mysqli_query($conn,$sql_id);
			$ID=mysqli_fetch_assoc($result);
			foreach($ID as $id){}//ユーザidを取得
			
			
			$sql="insert into reply(reply_content,message_name,create_time,message_id,id,reply_name) values('{$reply_content}','{$message_name}','{$create_time}',{$message_id},{$id},'{$reply_name}')";
			mysqli_query($conn,$sql);

			if(mysqli_affected_rows($conn)>0){
				echo "<script>alert('返信成功');window.location.href='index.php';</script>";
			}else{
				echo "<script>alert('返信失敗');window.location.href='reply.php?a=reply&message_id={$message_id}';</script>";
			}

			mysqli_close($conn);

			break;

		case 'delete_r':
			$sql="delete from reply where reply_id=".$_GET['reply_id'];
			mysqli_query($conn,$sql);
			if(mysqli_affected_rows($conn)>0){
				echo "<script>alert('削除成功');window.location.href='index.php';</script>";
			}else{
				echo "<script>alert('削除失敗');window.location.href='index.php';</script>";
			}
			
			mysqli_close($conn);

			break;

		case 'updateuser':
			$username_cookie=$_COOKIE['username'];
			$username=trim($_POST['username']);
			$userpass=$_POST['userpass'];
			$reuserpass=$_POST['reuserpass'];
			$sql_user="select * from user where username = '{$username}'";
			$result=mysqli_query($conn,$sql_user);
			$row=mysqli_fetch_assoc($result);

			if(empty($userpass)){
				echo "<script>alert('パスワード入力してください。');window.location.href='editinfo.php';</script>";
			}

			if($userpass!=$reuserpass){
				echo "<script>alert('パスワード一致しません。');window.location.href='editinfo.php';</script>";
			}

			if($username==$username_cookie){
				$userpass=md5($userpass);
				$sql="update user set username='{$username}',userpass='{$userpass}' where username='{$username_cookie}'";
				mysqli_query($conn,$sql);	
				if(mysqli_affected_rows($conn)>0){
					setcookie("username",null);
					setcookie("username",$username);
					echo "<script>alert('変更成功');window.location.href='index.php';</script>";
				}else{
					echo "<script>alert('パスワード変更失敗');window.location.href='index.php';</script>";
				}
			}else{
				if(@mysqli_num_rows($result)>0){
					echo "<script>alert('ユーザ名も存在しています');</script>";
				}else{
					$userpass=md5($userpass);
					$sql="update user set username='{$username}',userpass='{$userpass}' where username='{$username_cookie}'";
					mysqli_query($conn,$sql);	
					if(mysqli_affected_rows($conn)>0){
						setcookie("username",null);
						setcookie("username",$username);
						echo "<script>alert('変更成功');window.location.href='index.php';</script>";
					}else{
						echo "<script>alert('パスワード変更失敗');window.location.href='index.php';</script>";
					}
				}
			}

			
			

			break;
		case 'updateinfo':
			$username_cookie=$_COOKIE['username'];
			$myfile=$_FILES['imgpath'];
			//写真のサイズを設定する
			if($myfile['size']>2*1024*1024){
				echo "<script>alert('写真のサイズは最大２MBです。');</script>";
			}
			//アップロード写真のタイプを設定する
			$arr=array("image/jpg","image/jpeg","image/png","image/gif");
			if(!in_array($myfile['type'],$arr)){
				echo "<script>alert('写真を選択してください、又は写真のタイプが間違っています');</script>";
			}


			do{
				$name=time().mt_rand(1000,9999).".jpg";
			}while(file_exists("./img/".$name));

			if(move_uploaded_file($myfile['tmp_name'],"img/".$name)){
				$imgpath=$name;
				$sql="update user set imgpath='{$imgpath}' where username='{$username_cookie}'";
				mysqli_query($conn,$sql);
				header("location:editinfo.php");

			}else{
				echo "<script>alert('アバターアップロード失敗');window.location.href='editinfo.php';</script>";
			}
			break;
	}
?>