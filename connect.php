<?php
	header("content-type:text/html;charset=utf-8");
	$conn=mysqli_connect("3.137.204.183:9036","root","123456","message_board");
	if(!$conn){
		die("データベースコレクト失敗しました。");
	}
	mysqli_query($conn,"set names 'utf8'");
