<?php
	session_start();
	ini_set("display_errors","0");
?>
<?php

 // so san pham da add vao cart
	$prd = 0;
	if(isset($_SESSION['cart']))
	{
		$prd = count($_SESSION['cart']);
	}
?>
<?php
session_start();
//tiến hành kiểm tra là người dùng đã đăng nhập hay chưa
//nếu chưa, chuyển hướng người dùng ra lại trang đăng nhập
if (!isset($_SESSION['username'])) {
	 header('Location: ../index.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="../css/style.css"/>
<link rel="stylesheet" type="text/css" href="../css/reset.css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
<title>Mỹ phẩm cao cấp | Chính hãng</title>
<script>	
	$(document).ready(function() {
		function goBack(){
				window.history.back();
			}

	});
	
</script>
</head>
<body>
<div id ="wrapper">
<?php 
	include("../index/connect.php");
?>
<div class="ad_leftbar">
        <?php
	if(isset($_POST["btSubmit"]))
	{
		$username= $_POST["username"];
		$password = $_POST["password"];
		//lam sach thong tin
		$username = strip_tags($username);
		$username = addslashes($username);
		$password = strip_tags($password);
		$password = addslashes($password);
		if ($username == "" || $password =="")
		{
			echo '<div id="login-box" class="login-popup" style="display:block;left: 563px;top: 315px;">
				
				<a href="" class="close"><img src="close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
				Không được để trống!
				</div>
				<div id="mask" style="display:block;opacity: 0.7 !important;background: #000 !important;"></div>';
		}
		else
		{
			$sql = "select * from account where user_name = '$username' and password = '$password' ";
			$query = mysqli_query($conn,$sql);
			$num_rows = mysqli_num_rows($query);
			if ($num_rows==0) {
				echo '<div id="login-box" class="login-popup" style="display:block;left: 495px;top: 315px;">
				<a href="" class="close"><img src="close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
				Tên đăng nhập hoặc mật khẩu không đúng !
				</div>
				<div id="mask" style="display:block;opacity: 0.7 !important;background: #000 !important;"></div>';
			}
			else
			{
				//tiến hành lưu tên đăng nhập vào session để tiện xử lý sau này
				$_SESSION['username'] = $username;
                // Thực thi hành động sau khi lưu thông tin vào session
                // ở đây mình tiến hành chuyển hướng trang web tới một trang gọi là index.php
                header('Location: admin/admin.php');
			}
		}
	}
?>
<div class="ad_login">
		<div class="back_index">
        	<a href="../index.php">Quay về trang chủ</a>
        </div><!--back index-->	
        <div class="login">
        <?php
        	if (isset($_SESSION['username']))
			{
				echo '<a href="admin/admin.php" style="display:block; !important;" class="xinchao">Xin chào: '.$_SESSION['username'].'
				<div class="hv_member">
          		<span class="exit"><a href="logout.php">Đăng xuất</a></span>
         		 </div><!--end member-->
				
				</a>';
				echo '<a href="#login-box" class="login-window" style="display:none !important;">Đăng nhập</a><a href="#" style="display:none !important;"> / Đăng ký</a>';
			}
			else
			{
				echo '<a href="admin/admin.php" style="display:none; !important;" class="xinchao">Xin chào:'.$_SESSION['username'].'</a>';
				echo '<a href="#login-box" class="login-window" style="display:block !important;">Đăng nhập/Đăng ký</a>
';

			}
			
		?>
        </div><!--end ad_login-->
</div><!--end ad_login-->
<div class="containerR">

            <ul id="nav">
                <li><a href="#" class="sub">Quản lí trang web</a>
               		 <ul>
                        <li><a href="change-logo.php">Thay đổi logo</a></li>
                        <li><a href="change-menu.php">Thay đổi menu web</a></li>
                        <li><a href="change-banner.php">Thay đổi banner web</a></li>
                    </ul>
                </li>
                <li><a href="#" class="sub">Quản lí sản phẩm</a>
                    <ul>
						<li><a href="ad-product.php" >Danh sách sản phẩm</a></li>
                        <li><a href="add-product.php" >Thêm sản phẩm</a></li>
                        
                    </ul>
                </li>
            </ul>

        </div>
</div><!--end adleftbar-->
<div class="right_bar">
	<h1 class="tdlg">THAY ĐỔI BANNER</h1>
    <p class="huongdan">Hướng dẩn: Chọn hình ảnh và ấn Upload để thêm sản phẩm</p>
     <form action="change-banner.php" method="post" name="form_logo" enctype="multipart/form-data">
    	<div class="add_image">
        	Chọn hình ảnh:<input type="file" name="file" size="20" class="upload_logo"><br/>
            Tên banner: <input type="text" name="ten" size="20" class="upload_logo"><br/>
            <input type="submit" name="ok" value="Upload" class="upload">
            
        </div>
    </form>
    <?php
    	if(isset($_POST['ok']))// neu bien ok ton tai	
		{
			if($_FILES['file']['name'] != NULL) //da chon file
			{
				if($_FILES['file']['type'] == "image/jpeg" || $_FILES['file']['type'] == "image/png" || $_FILES['file']['type'] == "image/gif")
				{
					if($_FILES['file']['size'] > 1048576 )
					{
						echo '<p class="uptc">File không được lớn hơn 1mb!</p>';
					}
					else
					{// file hợp lệ, tiến hành upload
						$path = "data/"; // file sẽ lưu vào thư mục data
						$tmp_name = $_FILES['file']['tmp_name'];
						$name = $_FILES['file']['name'];
						$type = $_FILES['file']['type']; 
						$size = $_FILES['file']['size']; 
						$ten = $_GET['ten'];
						// Upload file
						move_uploaded_file($tmp_name,$path.$name);
						echo '<p class="uptc">';
						echo "File đã được upload thành công! <br />";
						echo "Tên file : ".$name."<br />";
						echo "Kiểu file : ".$type."<br />";
						echo "File size : ".$size;
						echo '</p>';
						$upload_query =mysqli_query($conn,"INSERT INTO banner (name_banner,image_banner)
											   VALUES('".$ten."','".$name."') ");
					}
				}
				else
				{
					echo '<p class="uptc">Kiểu file không hợp lệ!</p>';
				}
			}
			else
			{
				echo '<p class="uptc">THÔNG BÁO: Bạn chưa chọn tệp hình ảnh!</p>';
			}
		}
	?>
</div>

</div><!--End Wrapper---> 
</body>
</html>