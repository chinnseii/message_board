<?php 
	header("content-type:text/html;charset=utf-8");
    require("connect.php");
    $myfile=$_FILES['imgpath'];
    //アバターのサイズを設定する
    if($myfile['size']>2*1024*1024){
        echo "<script>alert('写真のサイズは最大2Mです。');window.location.href='register.php';</script>";
    }
    //アップロード写真のタイプを設定する
    $arr=array("image/jpg","image/jpeg","image/png","image/gif");
    if(!in_array($myfile['type'],$arr)){
        echo "<script>alert('写真のタイプが間違っています。');window.location.href='register.php';</script>";
    }


    do{
        $name=time().mt_rand(1000,9999).".jpg";
    }while(file_exists("./img/".$name));

    if(!is_dir("./img")){
        mkdir("./img/",0777,true);
    }
    if(move_uploaded_file($myfile['tmp_name'],"img/".$name)){
        $username=trim($_POST['username']);
        $userpass=md5($_POST['userpass']);
        $confirm_pass=md5($_POST['confirm_pass']);
        $imgpath=$name;
        $create_time=time();

        /*var_dump($imgpath);*/
        if($userpass!=$confirm_pass){
            echo "<script>alert('パスワード一致しません。');window.location.href='register.php';</script>";
        }else{
            $sql="select * from user where username=".$username;
            $result=mysqli_query($conn,$sql);
            if(@mysqli_num_rows($result)>0){
                echo "<script>alert('ユーザ名も存在しています，サインインしてください。');window.location.href='login.php';</script>";
            }else{
                $sql="insert into user(username,userpass,create_time,imgpath) values('{$username}','{$userpass}','{$create_time}','{$imgpath}')";
                mysqli_query($conn,$sql);
                if(mysqli_affected_rows($conn)>0){
                    echo "<script>alert('新規登録成功');window.location.href='login.php';</script>";
                }else{
                    echo "<script>alert('新規登録失敗');window.location.href='register.php';</script>";
                }
            }

        }
    }
    mysqli_close($conn);












    ?>