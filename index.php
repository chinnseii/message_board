<?php
	if($_COOKIE['islogin']!=1){
		header("location:login.php");
	}
		
	require("connect.php");
	$username=$_COOKIE['username'];
	$sql_img="select * from user where username='{$username}'";
	$result_img=mysqli_query($conn,$sql_img);
	$row_img=mysqli_fetch_assoc($result_img);
	$imgpath="./img/".$row_img['imgpath'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>メッセージボート</title>
	<link href="Css/bootstrap.css" rel="stylesheet" type="text/css" />
	<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdtVUeXqtxqeUhJ22ori-IwFqeZ0rSFg8&callback=initMap&libraries=&v=weekly"
      defer
    ></script>
	<script type="text/javascript" src="Js/jquery.js"></script>
</head>
	<style type="text/css">
      #map {
        height: 100%;
		width:100%;
      }

      /* Optional: Makes the sample page fill the window. */
      html,
      body {
        height: 70%;
        margin: 0;
        padding: 0;
      }
		.reply_btn{
			border:none;
			background:none;
			color:#337ab7;
		}
		.reply_btn:hover{
			border:none;
			cursor: pointer;
			text-decoration: underline;
			color: #ba1a09;
		}
	</style>
</head>
<body>
	<div align="right" style="padding:10px 50px;background:#81A849;">
		<h6 style="height:60px;line-height:60px;color:#fff;">ようこそ&nbsp;&nbsp;<a href="info.php" target="_blank"><img src="<?php echo $imgpath; ?>" alt="头像" width="60" height="60" class="img-circle"/></a>&nbsp;&nbsp;<a href="info.php" target="_blank" style="color:#fff;"><?php echo $username; ?></a>&nbsp;メッセージボート<span>&nbsp;&nbsp;&nbsp;<a href="action.php?a=quit" style="color:#fff;">ログアウト</a></span></h6>
	</div>
	<div id="map"></div>
	<div class="container">
		<h3 align="center">メッセージボート</h3>
		<div class="col-lg-8 col-md-6 col-lg-offset-2 col-md-offset-1">
			<form action="action.php?a=message" method="post">
				<textarea name="message_content" id="message_content" cols="110" rows="5" class="form-control" placeholder="コメント..." required></textarea><br /><br />
				<input type="submit" value="コメント" class="btn btn-success">
				<button class="btn btn-success" type="button" id="pos">マイ座標</button>
				<input type="reset" value="キャンセル" class="btn btn-default">
			</form>
		</div>
	</div>
	<br />	
	<h3 align="center">メッセージ内容</h3>
	<div class="container" style="padding-left:150px;">
	<form action="search.php" method="post">
	<div class="input-group col-md-3" style="margin-top:0px ;float: right;margin-right:175px;positon:relative">
       <input type="text" class="form-control"　placeholder="検索内容を入力してください" name="search"/>
            <span class="input-group-btn">
               <button class="btn btn-info btn-search">検索</button>
            </span>
 </div>
			</form>

		<?php
		//ページを分割
		function news($pageNum=1, $pageSize=5){
			 $array=array();
			 require("connect.php");
		    $rs="select message.*,user.imgpath from message,user where user.id=message.id order by message.message_id desc limit ".(($pageNum - 1) * $pageSize).",".$pageSize;
		    $r=mysqli_query($conn,$rs);
		    while($obj=mysqli_fetch_object($r)){
		        $array[]=$obj;
		    }
		    mysqli_close($conn);
		    return $array;
		}
		 
		//ページ数
		function allNews(){
		   require("connect.php");
		    $rs="select count(*) num from message";
		    $r=mysqli_query($conn, $rs);
		    $obj=mysqli_fetch_object($r);
		    mysqli_close($conn);
		    return $obj->num;
		}
	 
	    @$allNum=allNews();
	    @$pageSize=5; //ページの最大コメント数
	    @$pageNum=empty($_GET["pageNum"])?1:$_GET["pageNum"];
	    @$endPage=ceil($allNum/$pageSize); //ページ数
	    @$array=news($pageNum,$pageSize);

		foreach($array as $key=>$values){
			echo "<div style='position:relative;padding-bottom:30px;padding-top:40px;'><img src='./img/{$values->imgpath}' width='60' height='60' class='img-circle' style='float:left;margin-right:20px;'><h4>{$values->message_name}</h4><span style='color:#777;font-size:12px;'>{$values->create_time}</span><div style='width:75%;border:1px dashed #666;margin:10px 0 15px 80px;margin-top:10px;padding:10px 20px;'>{$values->message_content}</div><button href='reply.php?message_id={$values->message_id}' id='btn{$values->message_id}' class='reply_btn' style='position:absolute;left:80px;'>返信</button></div>";  



			if($values->message_name==$username){
					echo "<a href='action.php?a=delete_m&message_id={$values->message_id}' style='position:relative;bottom:30px;left:80%;'>删除</a>";
			}

			echo "<div class='reply{$values->message_id}' style='display:none;width:70%;height:130px;margin-left:10%;margin-top:10px;'>
					<form action='action.php?a=reply&message_id={$values->message_id}' method='post'>
						<textarea name='reply_content' placeholder='コメントしませんか....' class='form-control'></textarea>
						<div class='reply_act' style='float:right;margin-top:10px'>
						<input type='submit' value='返信' class='btn btn-success'>
						<a href='index.php' class='btn btn-default'>キャンセル</a>
						</div>
					</form>
				</div>";

			echo "<script type='text/javascript'>
					$('#btn{$values->message_id}').click(function(){
						$('.reply{$values->message_id}').toggle();
						history.pushState(null,null,'index.php?message_id={$values->message_id}');
					})
				</script>";

			$sql_r="select reply.*,user.imgpath from reply,user where reply.id=user.id order by reply_id desc";
			$result_r=mysqli_query($conn,$sql_r);
						
			while($row_r=mysqli_fetch_assoc($result_r)){
				if($values->message_id==$row_r['message_id']){		
					echo "<div style='margin-left:80px;padding-bottom:10px;'><img src='./img/{$row_r['imgpath']}' width='60' height='60' class='img-circle' style='float:left;margin-right:20px;'><h5>{$row_r['reply_name']}&nbsp;to&nbsp;{$row_r['message_name']}</h5><span style='color:#777;font-size:12px;'>{$row_r['create_time']}</span><div style='width:73%;border:1px dashed #666;margin-left:80px;padding:10px 20px;margin-top:10px;'>{$row_r['reply_content']}</div></div>";

					if($row_r['reply_name']==$username){
						echo "<a href='action.php?a=delete_r&reply_id={$row_r['reply_id']}' style='float:right;margin-right:180px;'>削除</a><br />";	
					}
				}
			}
		}
		?>
	</div><br/>
	<div class="text-center">
		<ul class="pagination">
			<li><a href="?pageNum=1">１</a></li>
			<li><a href="?pageNum=<?php echo $pageNum==1?1:($pageNum-1)?>"><</a></li>
			<li><a href="?pageNum=<?php echo $pageNum==$endPage?$endPage:($pageNum+1)?>">></a></li>
			<li><a href="?pageNum=<?php echo $endPage?>">最後</a></li>
			<li><a href=""><?php echo $allNum ?>件</a></li>
		</ul>
	</div>
	<div> 
</div>
	
	
	
</body>

<script>
var map, infoWindow;
function initMap() {
   map = new google.maps.Map(document.getElementById('map'), {
	 center: {lat: 40.813078, lng: -73.046388},
	 zoom: 16
   });
   if (navigator.geolocation) {
	 navigator.geolocation.getCurrentPosition(function(position) {
		var storage = window.sessionStorage;  
	   var pos = {
		 lat: position.coords.latitude,
		 lng: position.coords.longitude
	   };
	   storage.setItem('pos', pos.lat+","+pos.lng);  
	   var marker = new google.maps.Marker({position: pos, map: map});
	   map.setCenter(pos);
	 }, function() {
	   handleLocationError(true, infoWindow, map.getCenter());
	 });
   } else {
	 handleLocationError(false, infoWindow, map.getCenter());
   }
 }

 function handleLocationError(browserHasGeolocation, infoWindow, pos) {
   infoWindow.setPosition(pos);
   infoWindow.setContent(browserHasGeolocation ?
						 'Error: The Geolocation service failed.' :
						 'Error: Your browser doesn\'t support geolocation.');
   infoWindow.open(map);
 }
 $("#pos").on("click",function () { 
	var storage = window.sessionStorage; 
	var val = $('#message_content').val();
	val+= '\r\n'+"        -----------------------------------------------from("+storage.getItem("pos")+")";
	$('#message_content').val(val);
	//alert(val);
  })
    </script>
</html>
