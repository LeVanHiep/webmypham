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
				echo '<a href="admin/index.php" style="display:none; !important;" class="xinchao">Xin chào:'.$_SESSION['username'].'</a>';
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
                <li><a href="#" class="sub" >Quản lí sản phẩm</a>
                    <ul>
						<li><a href="ad-product.php" >Danh sách sản phẩm</a></li>
                        <li><a href="add-product.php" >Thêm sản phẩm</a></li>
                        
                    </ul>
					<li><a href="hoa_don.php">Hóa đơn</a></li>
                </li>
            </ul>

        </div>
</div><!--end adleftbar-->
<div class="right_barr">
	
	<h1 class="tdlg">SỬA SẢN PHẨM</h1>
    <p class="huongdan">Hướng dẩn: Chọn hình ảnh và ấn Upload để thêm sản phẩm</p>
	
	<?php
		if(isset($_GET['id'])){
			$id = $_GET['id'];
		}
	
		$sql = "SELECT * FROM product WHERE id_product = $id";
		$qr = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($qr);
		if(isset($_POST['capnhat'])){
			$tensp = $_POST['tensp'];
			if($_FILES['file']['name'] == ''){
				$image = $row['image_product'];
			}else{
				$path = "data/";
				$image = $_FILES['image']['name'];
				$image_tmp = $_FILES['image']['tmp_name'];
				move_uploaded_file($image_tmp,$path.$name);
			}
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
			
			$upload_query =mysqli_query($conn,"UPDATE product SET name_product=N'$tensp',describe_product=N'$mieuta',noi_dung=N'$nd',price_product='$gia',image_product='$image',type_product=N'$loaisp',useful_product=N'$sdc',parent_product=N'$thuocmenu',xuatxu=N'$xx',quy_cach=N'$qc',tinh_trang=N'$tt' WHERE id_product=$id");
			header('location: ad-product.php');
		}
	?>
    <form method="post" name="form_logo" enctype="multipart/form-data">
    	<div class="add_image">
            
			<table>
				<tr>
					<td>Tên sản phẩm:</td>
					<td colspan="2"><input type="text" name="tensp" size="60" class="tensp" id="add_" value="<?php echo $row['name_product']?>"></td>
				</tr>
				<tr>
					<td >Chọn hình ảnh: </td>
					<td><input type="file" name="file" size="20" class="upload_logo" id="thumbnail" value="<?php echo $row['image_product'];?>"></td>
				</tr>
				<tr>
					<td>Miêu tả:</td>
					<td colspan="2"><textarea cols="62" style="margin-left: 0px" rows="5" name="mieuta" class="mt" id="add_"><?php echo $row['describe_product']?></textarea></td>
				</tr>
				<tr>
					<td>Giá:</td>
					<td colspan="2"><input type="text" style="margin-left: 0px; width: 143px" name="gia" size="5" class="gia" id="add_" value="<?php echo $row['price_product']?>"> VNĐ</td>
				</tr>
				<tr>
					<td>Loại sản phẩm:</td>
					<td colspan="2">
						<select name="lsp" class="lsp" id="add_" style="width: 150px">
							<option value="<?php echo $row['5']?>"><?php echo $row['type_product']?></option>
							<?php
								$sql = "SELECT * FROM type_product";
								$query = mysqli_query($conn, $sql);
								$num = mysqli_num_rows($query);
								if($num>0){
									while($row3 = mysqli_fetch_array($query)){
							?>
							<option value="<?php echo $row3['1']?>"><?php echo $row3['1']?></option>
							<?php
									}
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Sử dụng cho:</td>
					<td colspan="2"><select name="sdc" class="sdc" id="add_" style="width: 150px">
							<option value="<?php echo $row['6']?>"><?php echo $row['useful_product']?></option>
							<?php
								$sql = "SELECT * FROM useful_product";
								$query = mysqli_query($conn, $sql);
								$num = mysqli_num_rows($query);
								if($num>0){
									while($row2 = mysqli_fetch_array($query)){
							?>
							<option value="<?php echo $row2['1']?>"><?php echo $row2['1']?></option>
							<?php
									}
								}
							?>
						</select></td>
				</tr>
				<tr>
					<td>Thuộc menu:</td>
					<td colspan="2"><select name="tmn" class="tmn" id="add_" style="width: 150px">
							<option value="<?php echo $row['7']?>"><?php echo $row['parent_product']?></option>
							<?php
								$sql = "SELECT * FROM `menu` WHERE `name_menu` not in (N'Trang chủ', N'Giới Thiệu')";
								
								$query = mysqli_query($conn, $sql);
								$num = mysqli_num_rows($query);
								if($num>0){
									while($row1 = mysqli_fetch_array($query)){
							?>
							<option value="<?php echo $row1['1']?>"><?php echo $row1['1']?></option>
							<?php
									}
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Xuất xứ:</td>
					<td colspan="2"><input type="text" name="xx" style="margin-left: 0px" size="15" class="xx" id="add_" value="<?php echo $row['xuatxu']?>"></td>
				</tr>
				<tr>
					<td>Quy cách:</td>
					<td colspan="2">
						<select name="qc" class="qc" id="add_">
							<option value="<?php echo $row[9]?>"><?php echo $row['quy_cach']?></option>
							<option value="100ml">100ml</option>
							<option value="200ml">200ml</option>
							<option value="300ml">300ml</option>
							<option value="400ml">400ml</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Tình trạng:</td>
					<td colspan="2"><input type="radio" name="1" value="Còn hàng">Còn hàng</input><input type="radio" name="1" value="Hết hàng">Hết hàng</input></td>
				</tr>
				<tr>
					<td>Nội dung:</td>
					<td colspan="2"><textarea name="noidung" id="editor1" rows="10" cols="80"><?php echo $row['noi_dung']?></textarea>
            			<script>CKEDITOR.replace( 'editor1' );</script></td>
				</tr>
				<tr>
					<th colspan="3" align="center"><input type="submit" name="capnhat" value="Upload" class="upload"></th>
				</tr>
			</table>
        </div>
    </form>
    
    
</div><!--end right_bar-->
</div><!--End Wrapper---> 
</body>
</html>