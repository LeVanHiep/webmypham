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
<script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js' type='text/javascript'></script>
<script type="text/javascript" src="../js/jquery-3.1.0.min.js"></script>
<title>Mỹ phẩm cao cấp | Chính hãng</title>
<script type="text/javascript">
$(document).ready(function() {
	$('.del').click(function(){
		window.confirm("Bạn có muốn xóa không!") == true

		})
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
				<li><a href="hoa_don.php">Hóa đơn</a></li>
            </ul>

        </div>
</div><!--end adleftbar-->
<div class="right_barr">
	<div class="htsp">
<!--
    	<ul class="ulhtsp">
			<li class="stt">STT</li>
			<li class="ndh">Người đặt hàng</li>
        	<li class="date">Ngày đặt hàng</li>
            <li class="sdt">Số điện thoại</li>
            <li class="dc">Địa chỉ</li>
			<li><a></a></li>
        </ul>
-->
        
        <?php 
								// tong so records
								$result =mysqli_query($conn,"select count(id_hd) as total from hoa_don order by id_hd desc");
								$row = mysqli_fetch_assoc($result);
								$total_records = $row['total'];
								// tim limit va current 
								$current_page = isset($_GET['page']) ? $_GET['page']:1;
								$litmit =12;
								$total_page =  ceil($total_records / $litmit);
								if($current_page > $total_page )
								{
									$current_page = $total_page;
								}
								else if($current_page < 1 )
								{
									$current_page = 1;
								}
								$start = ($current_page - 1) * $litmit;
								$result = mysqli_query($conn,"SELECT * FROM hoa_don ORDER BY id_hd ASC LIMIT $start, $litmit");
								
				?>
<!--
                <?php
//					while ($row = mysqli_fetch_assoc($result))
					{
				?>
                		<ul class="ulhtsp">
							<li class="stt">
								<? $count= $count+1 ?>
							</li>
                            <li class="ndh">
                                <?php echo $row['ho_ten']; ?>
                            </li>
                            <li class="date"><?php echo $row['ngay_dat_hang']; ?></li>
                            <li class="sdt"><?php echo $row['dien_thoai']; ?></li>
                            <li class="dc"><?php echo $row['dia_chi']; ?></li>
                            <li class="ed">
                            	<a href="order-detail.php?id=<?php echo $row['id_hd'];?>" class="order"></a>
                            </li>
                        </ul>
                <?php	
					}
				?>
-->
			<?php
				
			?>
			<h1 style="color: white" align="center">HÓA ĐƠN</h1>
			<table border="1" align="center">
				<tr>
                    <th>STT</th>
					<th>Mã đơn hàng</th>
                    <th>Người đặt hàng</th>
                    <th>Ngày đặt hàng</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Thao tác</th>
                </tr>
				<?php
					$count = 1;
					while ($row = mysqli_fetch_array($result))
					{
				?>
				<tr>
					<td><?php echo $count++ ?></td>
					<td><?php echo $row['id_hd'] ?></td>
					<td><?php echo $row['ho_ten'] ?></td>
					<td><?php echo $row['ngay_dat_hang'] ?></td>
					<td><?php echo $row['dien_thoai'] ?></td>
					<td><?php echo $row['dia_chi'] ?></td>
					<td><a href="order-detail.php?id=<?php echo $row['id_hd'];?>" class="order" style="color: white"><u>Chi tiết</u></a></td>
				</tr>
				<?php }?>
			</table>

            <div class="phan_trang" style="margin-left: 280px">
            	<?php
                	if($current_page > 1 && $total_page > 1)
					{
						echo "<a href='hoa_don.php?page=".($current_page - 1)."'>
								<b class='prev'></b>
							</a>";
					}
					echo"<ul class='ul_phan_page'>";
					for($i = 1;$i <= $total_page;$i++)
					{
						
						if($i == $current_page)
						{
							echo "<li><span class='color_current'>".$i."</span></li>";
						}
						else
						echo "<li><a href='hoa_don.php?page=".$i."'>".$i."</a></li>";
						
					}
					echo"</ul>";
					if($current_page < $total_page  && $total_page > 1)
					{
						echo "<a href='ad-product.php?page=".($current_page + 1)."'>
							<b class='next'></b>
						</a>";
					}
					
				?>
            </div>
<!--		end phan_page-->
        
        
    </div><!--end htsp-->
</div><!--end right barr-->
</div><!--End Wrapper---> 
</body>
</html>