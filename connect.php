<?php
	header("content-type:text/html;charset=utf-8");
	$conn=mysqli_connect("localhost","root","root","message_board");
	if(!$conn){
		die("データベースコレクト失敗しました。");
	}
	mysqli_query($conn,"set names 'utf8'");
