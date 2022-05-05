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
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
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
                <li><a href="#" class="sub">Quản lí trang web</a><img src="images/up.gif" alt="" />
               		 <ul>
                        <li><a href="change-logo.php">Thay đổi logo</a></li>
                        <li><a href="change-menu.php">Thay đổi menu web</a></li>
                        <li><a href="change-banner.php">Thay đổi banner web</a></li>
                    </ul>
                </li>
                <li><a href="ad-product.php" class="sub" tabindex="1">Quản lí sản phẩm</a><img src="images/up.gif" alt="" />
                    <ul>
                        <li><a href="add-product.php" >Thêm sản phẩm</a></li>
                        <li><a href="ad-product.php" >Danh sách sản phẩm</a></li>
                    </ul>
                </li>
            </ul>

        </div>
</div><!--end adleftbar-->
<div class="right_barr">
	
	<h1 class="tdlg">SỬA SẢN PHẨM</h1>
    <p class="huongdan">Hướng dẩn: Chọn hình ảnh và ấn Upload để thêm sản phẩm</p>
    <form action="add-product.php" method="post" name="form_logo" enctype="multipart/form-data">
    	<div class="add_image">
        	Tên sản phẩm: <input type="text" name="tensp" size="20" class="tensp" id="add_"><br/>
        	Chọn hình ảnh:<input type="file" name="file" size="20" class="upload_logo" id="add_"><br/>
            <div class="gt">
            
            <br/>Miêu tả: <textarea cols="20" rows="5" name="mieuta" class="mt" id="add_"></textarea><br/>
            <p>Giá: <input type="text" name="gia" size="5" class="gia" id="add_"></p>
            Loại sản phẩm: <input type="text" name="lsp" size="15" class="lsp"  id="add_"><br/>
            <br/>Sử dụng cho: <input type="text" name="sdc" size="15" class="sdc" id="add_"><br/>
            <br/>Thuộc menu: <input type="text" name="tmn" size="15" class="tmn" id="add_"><br/>
            <br/>Xuất xứ: <input type="text" name="xx" size="15" class="xx" id="add_"><br/>
           <br/> Quy cách: <input type="text" name="qc" size="15" class="qc" id="add_"><br/>
            <br/>Tình trạng: <input type="radio" name="1" value="Còn hàng">Còn hàng</input><input type="radio" name="1" value="Hết hàng">Hết hàng</input><br/>
            Nội dung: <textarea name="noidung" id="editor1" rows="10" cols="80"></textarea>
            <script>    CKEDITOR.replace( 'editor1' );</script>
            </div><!--end gt-->
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
						$tensp = $_POST['tensp'];
						$mieuta = $_POST['mieuta'];
						$gia = $_POST['gia'];
						$loaisp = $_POST['lsp'];
						$sdc = $_POST['sdc'];
						$thuocmenu = $_POST['tmn'];
						$xx = $_POST['xx'];
						$qc = $_POST['qc'];
						$tt = $_POST['gia'];
						$nd = $_POST['noidung'];
						$tt =$_POST['1'];
						$id = $_GET['id'];
						// Upload file
						move_uploaded_file($tmp_name,$path.$name);
						echo '<p class="uptc">';
						echo "File đã được upload thành công! <br />";
						echo "Tên file : ".$tensp."<br />";
						echo "Tên file : ".$name."<br />";
						echo "Kiểu file : ".$type."<br />";
						echo "File size : ".$size;
						echo '</p>';
						$upload_query =mysqli_query($conn,"UPDATE product SET name_product=N'".$tensp."',describe_product=N'".$mieuta."',noi_dung=N'".$nd."',price_product='".$gia."',image_product='".$name."',N'".$loaisp."',N'".$sdc."',N'".$thuocmenu."',N'".$xx."',N'".$qc."',N'".$tt."') WHERE id_product=".$id);
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
    
</div><!--end right_bar-->
</div><!--End Wrapper---> 
</body>
</html>