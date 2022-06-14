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
	<h1 class="tdlg">THAY ĐỔI MENU WEBSITE</h1>
    <div class="change_menu">
    	<form action="change-menu.php" method="post" name="form_menu">
        <fieldset class="field_add">
        <legend>Thêm menu chính</legend>
        	Tên menu chính: <input type="text" name="tenmenu" value="" class="ten_menu"> <input type="submit" name="ok" value="Thêm" class="them" >
            <?php
				$tenmenu = $_POST['tenmenu'];
            	if(isset($_POST['ok']))
				{
					if($tenmenu == NULL)
					{
						echo '<p class="uptc">Vui lòng điền tên menu vào!</p>';
					}
					else
					{
						$menu_query = mysqli_query($conn,"INSERT INTO menu (name_menu)
														  VALUES (N'".$tenmenu."')");
						header('location: change-menu.php');							 
					}
				}
				
				
			?>
             
            </fieldset>
        </form>
        <fieldset style="border:1px solid #fff;">
        <legend >Xóa menu</legend>
        <div class="show">
        	<ul>
       		<?php
            	$q= mysqli_query($conn,"SELECT * FROM menu");
				while($q_items = mysqli_fetch_array($q))
				{
					echo "<li>".$q_items['name_menu']."<a href='delete-menu.php?id=".$q_items['id_menu']."' class='del' title='Xóa'></a></li>";
				}
			?>
            </ul>
        </div>
        </fieldset>
    </div><!--end change menu--->
    <div class="change_menu_">
    	<form action="" method="post" name="formsua">
        	<fieldset class="field_add">
            	<legend>Sửa menu chính</legend>
                Chọn menu cần sửa: 
            		<select name="sl2">
                    <?php
                    	$menu_query =mysqli_query($conn,"SELECT * FROM menu");
						while($menu_items = mysqli_fetch_array($menu_query))
						{
							echo '<option value="'.$menu_items['id_menu'].'">'.$menu_items['name_menu'].'</option>';
						}
					?>
           			</select><br/>
                    Nhập tên menu mới: <input type="text" value="" name="sua" class="sua"/><br/>
                    
                    <input type="submit" name="yes1" value="Sửa" class="them"/><br/>
                    <?php
						$xoa = $_POST['sl2'];
						$tenmoi = $_POST['sua'];
                    	if(isset($_POST['yes1']))
						{		
							$xoa_menu = mysqli_query($conn,"UPDATE menu SET name_menu=N'".$tenmoi."' WHERE id_menu =".$xoa."");
							
						}
					?>     
            </fieldset>
        </form>
    </div><!--change_menu_-->
    
</div>

</div><!--End Wrapper---> 
</body>
</html>