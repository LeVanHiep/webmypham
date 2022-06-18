<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="css/reset.css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
<title>Mỹ phẩm cao cấp | Chính hãng</title>
<script src='http://localhost:8080/webmypham/js/jquery-1.11.3.min.js' type='text/javascript'></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js' type='text/javascript'></script>

<script type='text/javascript'>
$(function() {
				 $(window).scroll(function() {
				 if ($(this).scrollTop() != 0) 
				 {
					$('.backtop').fadeIn();
				 }
				  else {
					$('.backtop').fadeOut();
				 }
 				 });
		$('.backtop').click(function() {
			$('body,html').animate({scrollTop: 0}, 700);
 		});

});
		
</script>
<!----------------------------------------ĐĂNG NHẬP-------------------------------------------->
<script type="text/javascript">
$(document).ready(function() {
	$('a.login-window').click(function() {
		
		// Getting the variable's value from a link 
		var loginBox = $(this).attr('href');

		//Fade in the Popup and add close button
		$(loginBox).fadeIn(300);
		
		//Set the center alignment padding + border
		var popMargTop = ($(loginBox).height() + 24) / 2; 
		var popMargLeft = ($(loginBox).width() + 24) / 2; 
		
		$(loginBox).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		// Add the mask to body
		$('body').append('<div id="mask"></div>');
		$('#mask').fadeIn(300);
		
		return false;
	});
	
	// When clicking on the button close or the mask layer the popup closed
	$('a.close, #mask').live('click', function() { 
	  $('#mask , .login-popup').fadeOut(300 , function() {
		$('#mask').remove();  
	}); 
	return false;
	});
});
</script>

</head>

<body>
<div id ="wrapper">
<?php 
	include("index/connect.php");
?>
<div id ="header">

	<div class ="topbar">
    <div class ="container">
    	<div class="logo">
        	<a href="index.php">
            <?php
            	$logo_query = mysqli_query($conn,"SELECT * FROM logo_website ORDER BY  id_logo DESC limit 1");
				while($logo_items = mysqli_fetch_array($logo_query))
				{
					echo '<img src="images/'.$logo_items['image_logo'].'" alt="'.$logo_items['name_logo'].'" tittle="'.$logo_items['name_logo'].'"/>';
				}
			?>
            
            </a>
        </div><!--end logo-->
    	<div class="search">
        	<form class="searchform" action="search.php" method="get">
			<input class="s" onfocus="if (this.value == 'Tìm kiếm …') {this.value = '';}" onblur="if (this.value == '') {this.value =		 		'Tìm kiếm …';}" type="text" name="timkiem" value="Tìm kiếm …" width="300px" />
        	<button class="searchsubmit" name="btTimkiem" type="submit" value=""> </button>
			</form>
        </div><!-----end search---->
        
        <!--ĐĂNG NHẬP-->
        
        
		<?php
	if(isset($_POST["btSubmit"]))
	{
		$username= $_POST["username"];
		$password =md5( $_POST["password"]);
		//lam sach thong tin
		$username = strip_tags($username);
		$username = addslashes($username);
		$password = strip_tags($password);
		$password = addslashes($password);
		if ($username == "" || $password =="")
		{
			echo '<div id="login-box" class="login-popup" style="display:block;left: 563px;top: 315px;">
				
				<a href="" class="close"><img src="../close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
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
				<a href="" class="close"><img src="../close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
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
                header('Location: index.php');
			}
		}
	}
?>
        <div class="login">
        <?php
			$sql_query =mysqli_query($conn, "select * from account where user_name=".$_SESSION['username']);
			$sql_it = mysqli_fetch_array($sql_query);
			$level = $sql_it['level'];
        	if (isset($_SESSION['username']))
			{
				if($level == '1')
				{
					echo '<a href="http://localhost/webmypham/admin/index.php" style="display:block; !important;" class="xinchao">Xin chào: '.$_SESSION['username'].'
				<div class="hv_member">
          		<span class="exit"><a href="admin/logout.php">Đăng xuất</a></span>
         		 </div><!--end member-->
				</a>';
				}
				else
				{
					
					echo '<a href="#" style="display:block; !important;" class="xinchao">Xin chào: '.$_SESSION['username'].'
				<div class="hv_member">
          		<span class="exit"><a href="admin/logout.php">Đăng xuất</a></span>
         		 </div><!--end member-->
				</a>';
				}
				echo '<a href="#login-box" class="login-window" style="display:none !important;">Đăng nhập</a><a href="#" style="display:none !important;"> / Đăng ký</a>';
			}
			else
			{
				echo '<a href="admin/index.php" style="display:none; !important;" class="xinchao">Xin chào:'.$_SESSION['username'].'</a>';
				echo '<a href="#login-box" class="login-window" style="display:block !important;">Đăng nhập/Đăng ký</a>
';

			}
			
		?>

        </div><!--end login-->
        <div id="login-box" class="login-popup">
        	<a href="" class="close"><img src="close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
          <form method="post" class="signin" action="index.php">
                <fieldset class="textbox">
            	<label class="username">
                <span>Tài khoản</span>
               <input type="text" name="username" id="username" value=""/>
                </label>
                
                <label class="password">
                <span>Mật khẩu</span>
                <input type="password" name="password" id="password" value="" />
                </label>
                
                <button class="submit button" type="submit" name="btSubmit">Đăng nhập</button>
                
                <p>
                <a class="forgot" href="#">Quên mật khẩu?</a> <a href="admin/register.php" class="register">Đăng ký</a>
                </p>
                </fieldset>
          </form>
          
		</div><!--end login-->
        
        <!--END ĐĂNG NHẬP-->
       	<div class="hotline">
        	<div class="ptittle">Hotline:</div><!--ptille-->
            <div class="pdetail">039 664 6090 - 012 345 6789</div><!--pdetail-->
        </div><!--hotline-->
        
        
     </div><!--end container-->
    </div><!--End topbar--->
    
    <div class="menu">
    	<div class="container">
        	<div class="nav">
        	<?php
				$menu_query = "SELECT * FROM menu";
				$menu_result = mysqli_query($conn,$menu_query) or die ('Cannot connect table!'.mysqli_error($conn));

				while ($menu_items = mysqli_fetch_array($menu_result,MYSQLI_ASSOC))
				{
					$submenu_query = "  SELECT * 
										FROM submenu
										WHERE parent =".$menu_items['id_menu'];
					$submenu_res = mysqli_query ($conn,$submenu_query) or die ('Cannot select menu'.mysqli_error($conn));
					
					/*--------------------------------CHAM SOC BODY-------------------------------------------*/
					
					$sub_csbd_query ="SELECT * FROM submenu WHERE type_sub=N'chăm sóc body' and parent=".$menu_items['id_menu'];
					$sub_csbd_res = mysqli_query($conn,$sub_csbd_query) or die ('cannot select menu'.mysqli_error($conn));
					
					/*-------------------------------------CHAM SOC DA MAT-------------------------------------*/
					$sub_csdm_query ="SELECT * FROM submenu WHERE type_sub=N'chăm sóc da mặt' and parent=".$menu_items['id_menu'];
					$sub_csdm_res = mysqli_query($conn,$sub_csdm_query) or die ('cannot select menu'.mysqli_error($conn));
					/*-------------------------------------TRANG ĐIỂM-------------------------------------*/
					$sub_m_query ="SELECT * FROM submenu WHERE type_sub=N'mặt' and parent=".$menu_items['id_menu'];
					$sub_m_res = mysqli_query($conn,$sub_m_query) or die ('cannot select menu'.mysqli_error($conn));
					/*----------------------------------------------------------------------------------------*/
					$sub_mt_query ="SELECT * FROM submenu WHERE type_sub=N'mắtt' and parent=".$menu_items['id_menu'];
					$sub_mt_res = mysqli_query($conn,$sub_mt_query) or die ('cannot select menu'.mysqli_error($conn));
					/*---------------------------------------UONG DEP DA-----------------------------------------*/
					$sub_udd_query ="SELECT * FROM submenu WHERE type_sub=N'uống đẹp da' and parent=".$menu_items['id_menu'];
					$sub_udd_res = mysqli_query($conn,$sub_udd_query) or die ('cannot select menu'.mysqli_error($conn));
					/*---------------------------------------làm đẹp-----------------------------------------*/
					$sub_ldep_query ="SELECT * FROM submenu WHERE type_sub=N'làm đẹp' and parent=".$menu_items['id_menu'];
					$sub_ldep_res = mysqli_query($conn,$sub_ldep_query) or die ('cannot select menu'.mysqli_error($conn));
		
					echo "<div class='menu_leve_1'><a href = '".$menu_items['link_menu']."' class='parent'>".$menu_items['name_menu']."</a>
					<ul class='menuHiden' style='display: none;margin-bottom: 0px;margin-top: 0px;padding-left: 0px;padding-H:10px;'>";
					
						if($menu_items["name_menu"] == 'Mỹ Phẩm')
						{
							echo "<li class='active'><a href='san-pham/cham-soc-da-mat.php'><br/>CHĂM SÓC DA MẶT</a>
									<ul style='padding-left:0px;padding-bottom:10px;'>";
									while($sub_csdm_items = mysqli_fetch_array($sub_csdm_res,MYSQLI_ASSOC))
									{
										echo"<li><a href='san-pham/".$sub_csdm_items['link_sub']."'>". $sub_csdm_items['name_sub']." </a></li>";
									}
							echo "
									</ul>
									</li>";
							/*------------------*/
							echo "<li class='active'><a href='san-pham/cham-soc-body.php'><br/>CHĂM SÓC BODY</a>
									<ul style='padding-left:0px;'>";
									while($sub_csbd_items = mysqli_fetch_array($sub_csbd_res,MYSQLI_ASSOC))
									{
										echo"<li><a href='san-pham/".$sub_csbd_items['link_sub']."'>". $sub_csbd_items['name_sub']." </a></li>";
									}
							echo "
									</ul>
									</li>";
						}
						/*------------------*/
						if($menu_items["name_menu"] == 'Trang Điểm')
							{
							echo "<li class='active'><a href='#'><br/>MẶT</a>
									<ul style='padding-left:0px;padding-bottom:10px;'>";
									while($sub_m_items = mysqli_fetch_array($sub_m_res,MYSQLI_ASSOC))
									{
										echo"<li><a href='#'>". $sub_m_items['name_sub']." </a></li>";
									}
							echo "
									</ul>
									</li>";
								/*------------------*/	
							echo "<li class='active'><a href='#'><br/>MẮT</a>
									<ul style='padding-left:0px;padding-bottom:10px;'>";
									while($sub_mt_items = mysqli_fetch_array($sub_mt_res,MYSQLI_ASSOC))
									{
										echo"<li><a href='#'>". $sub_mt_items['name_sub']." </a></li>";
									}
							echo "
									</ul>
									</li>";
									
							}
							/*---------------------------------------------------------*/
							if($menu_items["name_menu"] == "Dinh Dưỡng - Sức Khỏe")
							{
								echo "<li class='active'><a href='#'><br/>UỐNG ĐẸP DA</a>
									<ul style='padding-left:0px;padding-bottom:10px;'>";
									while($sub_udd_items = mysqli_fetch_array($sub_udd_res,MYSQLI_ASSOC))
									{
										echo"<li><a href='#'>". $sub_udd_items['name_sub']." </a></li>";
									}
							echo "
									</ul>
									</li>";
							}
							/*---------------------------------------------------------*/
							if($menu_items["name_menu"] == "Làm Đẹp")
							{
								echo "<li class='active'><a href='#'><br/></a>
									<ul style='padding-left:0px;padding-bottom:10px;'>";
									while($sub_ldep_items = mysqli_fetch_array($sub_ldep_res,MYSQLI_ASSOC))
									{
										echo"<li><a href='#'>". $sub_ldep_items['name_sub']." </a></li>";
									}
							echo "
									</ul>
									</li>";
							}
						//END WHILE $submenu_items
						
						/*while ($sub_csbd_items =mysqli_fetch_array($sub_csbd_res,MYSQLI_ASSOC))
						{
							echo "<li><a href ='#'>".$sub_csbd_items['name_sub']."</a></li>";
						}*/
					echo "</ul></div>";				
				}
			?>
            <div class="cart_div">
            <a href="san-pham/shopping-cart.php" class="cart_top">
            	<span class="count"><?php echo $prd; ?></span><!--end count-->
    			<span class="tit">Giỏ hàng</span><!--end tit-->
                    
    		</a>
            <div class="quick_cart">
    <?php //cap nhat lai gia khi nhap vao so luong
        if(isset($_POST['update_cart']))
        {
            foreach($_POST['num'] as $id => $prd)//prd la gia tri nhap vao.moi id tuong ung voi so luong nhap vao
            {
                if(($prd == 0) and (is_numeric($prd)))//nhap vao =0 thi xoa san pham do di
                {
                    unset($_SESSION['cart'][$id]);
                }
                elseif(($prd > 0) and (is_numeric($prd)))//nhap vao so luong >0  thi tiep tuc tinh
                {
                    $_SESSION['cart'][$id] = $prd;
                }
            }
        }
    ?>                
    <form method="post">
    <div class="cart_oder">
            <ul class="top_cart">
                <li class="sp">SẢN PHẨM </li>
                <li class="dg">ĐƠN GIÁ</li>
                <li class="sl">SỐ LƯỢNG</li>
                <li class="tt">THÀNH TIỀN</li>
            </ul>
            <?php
        $sum_all = 0;
        $sum_sp = 0;
        if($_SESSION['cart'] != NULL)
        {
            foreach($_SESSION['cart'] as $id =>$prd)
            {
                $arr_id[] = $id;
            }
            $str_id = implode(',',$arr_id);
            $item_query = "SELECT * FROM  product WHERE id_product IN ($str_id) ORDER BY id_product ASC";
            $item_result = mysqli_query($conn,$item_query) or die ('Cannot select table!');
            while ($rows = mysqli_fetch_array($item_result))
            {
    ?>
            <ul class="bottom_cart">
                <li class="sp">
                    <img src="images/<?php echo $rows['image_product']; ?>" class="cartImg">
                    <b class="Cart_title_pro"><?php echo $rows['name_product']; ?></b>
                    <div class="delete_Cart"><a href="san-pham/delcart.php?id=<?php echo $rows['id_product']; ?>" class="del_sp">Bỏ sản phẩm</a></div>
                    
                </li>
             <li class="dg"><?php echo number_format($rows['price_product']);?> VNĐ</li>
            <li class="sl"> <input type="text" name ="num[<?php echo $rows['id_product']; ?>]" value="<?php echo $_SESSION['cart'][$rows['id_product']]; ?>" size="3" class="capnhatCartTxt"/></li>
            <li class="tt"><?php echo number_format($rows['price_product']*$_SESSION['cart'][$rows['id_product']]); ?> VNĐ</li>
            </ul>    
    <?php			
            }
        }
    ?>
    
    <div class="go_shopping">
    	<input type="submit" name="update_cart" value="Cập nhật giỏ hàng" class="cap_nhat_cart"/>
    	<a href="san-pham/shopping-cart.php" class="goa_shopping">CHUYỂN TỚI TRANG ĐẶT HÀNG</a></div>
    </div><!--end cart_order-->
	</form>
                    </div><!--End Quick-->
            </div><!--end cart_div-->
            
            </div><!--end nav-->
            
        </div><!--end container-->
    </div><!---menu-->    
</div><!--End Header--->
<div class="content">
	<div class="banner">
    	<?php include("with-jquery.php"); ?>
    </div><!--end banner-->
    
    <div class="homenew">
    	<a href="#" tittle="Khuyến mãi" target="_blank">
        	<img src="images/uudai.png" alt="Khuyến mãi" class="uudai"/>
        </a>
        <div class="figure">
            <a href="#">BÍ QUYẾT LÀM ĐẸP</a>
            <b></b>
        </div><!--end figure-->
        <div class="image_figure">
        	<img src="images/medium-h4.jpg" atl="xóa tan quầng thâm mắt với 5 mẹo vặt cực đơn giản"/>
        </div><!--end image_figure-->
    </div><!--end homenew-->
    <div class="sliderows">
    	<div class="navicate">
        	<h2 class="parent">
            	<a href="#" tittle="CHĂM SÓC DA MẶT">CHĂM SÓC DA MẶT</a>
            </h2><!--end parent-->
            <div class="sub">
        		<a href="san-pham/cham-soc-da-mat.php" tittle="Xem tất cả">Xem tất cả</a>
                <i></i>
        	</div><!--end sub-->
            <?php
            	$csdamat_query="SELECT * FROM submenu where type_sub=N'chăm sóc da mặt'";/* <-----------viet them code gioi han 7 san pham */
				$csdamat_res = mysqli_query($conn,$csdamat_query) or die('Cannot select table!');
				while ($csdamat_items = mysqli_fetch_array($csdamat_res))
				{
			?>
            	<h2 class="sub">
            <?php
				echo"<a href='san-pham/".$csdamat_items['link_sub']."'>".$csdamat_items['name_sub']."</a>";
				echo"</h2>";
				}
			?>
        </div><!--end navicate-->
    <a href="#" tittle="Bộ sản phẩm trị nám" target="_blank">
        <img class="banner_rows" src="images/2a8912e92cb6c2c0ee35740f3eb0c5fa.png" alt="Bộ sản phẩm trị nám"/>
    </a>
    <div class="selling">
    	<a href="#" tittle=" Bộ sản phẩm trị mụn cao cấp Sakura Nhật Bản " target="_blank">
        	<img src="images/053b8de76e2bb58f1c691c7c6a200790.png" alt=" Bộ sản phẩm trị mụn cao cấp Sakura Nhật Bản "/>
    	</a>
    </div><!--end selling--->
   		<div class="row_product owl-carousel owl-theme" style="opacity:1; display:block; ">
    		<div class="owl-wrapper-outer">
            	<div class="owl-wrapper" style="width: 4680px; left: 0px; display: block; transition: all 300ms ease; transform: translate3d(0px, 0px, 0px);">
            	<?php
				
                	$csdamat_query="SELECT * FROM product where type_product=N'chăm sóc da mặt' limit 5";
					$csdamat_res = mysqli_query($conn,$csdamat_query) or die('Cannot select table!');
					while ($csdamat_items = mysqli_fetch_array($csdamat_res))
					{
				?>
                <div class="owl-item" style="width: 233px;">
                	<div class="row_product_h">
                <?php
					echo"
					<a href='san-pham/page-chitiet.php?id=".$csdamat_items['id_product']."' class='images'>
						<img alt='".$csdamat_items['name_product']."' src='images/".$csdamat_items['image_product']."'>
					</a>
					<h2 style='margin-top:0px;margin-bottom:0px;'>
					<a title='".$csdamat_items['name_product']."' href='san-pham/page-chitiet.php?id=".$csdamat_items['id_product']."'>".$csdamat_items['name_product']."</a>
					</h2>
					<div class='price'>".number_format($csdamat_items['price_product'])." VNĐ</div><!--end price-->
					<div class='ratings'>
						<div class='rating-box'>
							<div style='width:100%;' class='rating'></div><!--end rating-->
						</div><!--end ratingbox-->
					</div><!--end ratings-->
					<a href='san-pham/add-cart.php?id=".$csdamat_items['id_product']."'><div class='add_cart' style='display:none;'><i></i>MUA NGAY</div></a>
					";
				?>
                	</div><!--end row_product_h-->
                </div><!--end owl-item--->
                <?php
					}
				?>
                
                </div><!--end owl-wrapper-->
            </div><!--end owl-wrapper-outer-->
    	</div><!---end row_product owl-carousel owl-theme-->
    </div><!--end sliderows-->
    <div class="sliderows sliderows_t sliderows_red">
    	<div class="navicate">
        	<h2 class="parent">
            	<a href="#" tittle="CHĂM SÓC DA MẶT">TRANG ĐIỂM</a>
            </h2><!--end parent-->
            <div class="sub">
        		<a href="#" tittle="Xem tất cả">Xem tất cả</a>
                <i></i>
        	</div><!--end sub-->
            <?php
            	$csdamat_query="SELECT * FROM submenu where type_sub=N'mặt' limit 5";/* <-----------viet them code gioi han 7 san pham */
				$csdamat_res = mysqli_query($conn,$csdamat_query) or die('Cannot select table!');
				while ($csdamat_items = mysqli_fetch_array($csdamat_res))
				{
			?>
            	<h2 class="sub">
            <?php
				echo"<a href='#'>".$csdamat_items['name_sub']."</a>";
				echo"</h2>";
				}
			?>
        </div><!--end navicate-->
        <a href="#" tittle="Bộ sản phẩm trị nám" target="_blank">
        	<img class="banner_rows" src="images/c5b844108bdb8ca61298bab3a2e722c8.png" alt="Kem Trang Điểm  Sakura"/>
    	</a>
    <div class="selling">
    	<a href="#" tittle=" Bộ sản phẩm trị mụn cao cấp Sakura Nhật Bản " target="_blank">
        	<img src="images/006165e93760d0dc71ffe83e1894a190.png" alt=" Tạo dáng mi "/>
    	</a>
    </div><!--end selling--->
    <div class="row_product owl-carousel owl-theme" style="opacity:1; display:block; ">
    		<div class="owl-wrapper-outer">
            	<div class="owl-wrapper" style="width: 4680px; left: 0px; display: block; transition: all 300ms ease; transform: translate3d(0px, 0px, 0px);">
            	<?php
				
                	$csdamat_query="SELECT * FROM product where type_product=N'mặt' limit 5";
					$csdamat_res = mysqli_query($conn,$csdamat_query) or die('Cannot select table!');
					while ($csdamat_items = mysqli_fetch_array($csdamat_res))
					{
				?>
                <div class="owl-item" style="width: 233px;">
                	<div class="row_product_h">
                <?php
					echo"
					<a href='#' class='images'>
						<img alt='".$csdamat_items['name_product']."' src='images/".$csdamat_items['image_product']."'/>
					</a>
					<h2 style='margin-top:0px;margin-bottom:0px;'>
					<a title='".$csdamat_items['name_product']."' href='#'>".$csdamat_items['name_product']."</a>
					</h2>
					<div class='price'>".number_format($csdamat_items['price_product'])." VNĐ</div><!--end price-->
					<div class='ratings'>
						<div class='rating-box'>
							<div style='width:100%;' class='rating'></div><!--end rating-->
						</div><!--end ratingbox-->
					</div><!--end ratings-->
					<div class='add_cart' onclick=''><a href='san-pham/add-cart.php?id=".$csdamat_items['id_product']."'>MUA NGAY</a></div>
					";
				?>
                	</div><!--end row_product_h-->
                </div><!--end owl-item--->
                <?php
					}
				?>
                </div><!--end owl-wrapper-->
            </div><!--end owl-wrapper-outer-->
    	</div><!---end row_product owl-carousel owl-theme-->
        
    </div><!--end slidesrow slider_row_t slider_row_red-->
    <div class="sliderows sliderows_t sliderows_blue">
    	<div class="navicate">
        	<h2 class="parent">
            	<a href="#" tittle="CHĂM SÓC BODY">CHĂM SÓC BODY</a>
            </h2><!--end parent-->
            <div class="sub">
        		<a href="#" tittle="Xem tất cả">Xem tất cả</a>
                <i></i>
        	</div><!--end sub-->
            <?php
            	$csdamat_query="SELECT * FROM submenu where type_sub=N'chăm sóc body' limit 5";/* <-----------viet them code gioi han 7 san pham */
				$csdamat_res = mysqli_query($conn,$csdamat_query) or die('Cannot select table!');
				while ($csdamat_items = mysqli_fetch_array($csdamat_res))
				{
			?>
            	<h2 class="sub">
            <?php
				echo"<a href='#'>".$csdamat_items['name_sub']."</a>";
				echo"</h2>";
				}
			?>
        </div><!--end navicate-->
        <a href="#" tittle="kem dưỡng da toàn thân Sakura" target="_blank">
        	<img class="banner_rows" src="images/da2625682ed673c1de909732888e29b7.png" alt="kem dưỡng da toàn thân Sakura"/>
    	</a>
    <div class="selling">
    	<a href="#" tittle=" Tẩy tế bào chết" target="_blank">
        	<img src="images/45c0d36678741e6f1f3e90eb991bb599.png" alt="Tẩy tế bào chết"/>
    	</a>
    </div><!--end selling--->
    <div class="row_product owl-carousel owl-theme" style="opacity:1; display:block; ">
    		<div class="owl-wrapper-outer">
            	<div class="owl-wrapper" style="width: 4680px; left: 0px; display: block; transition: all 300ms ease; transform: translate3d(0px, 0px, 0px);">
            	<?php
				
                	$csdamat_query="SELECT * FROM product where type_product=N'chăm sóc body' limit 5";
					$csdamat_res = mysqli_query($conn,$csdamat_query) or die('Cannot select table!');
					while ($csdamat_items = mysqli_fetch_array($csdamat_res))
					{
				?>
                <div class="owl-item" style="width: 233px;">
                	<div class="row_product_h">
                <?php
					echo"
					<a href='#' class='images'>
						<img alt='".$csdamat_items['name_product']."' src='images/".$csdamat_items['image_product']."'>
					</a>
					<h2 style='margin-top:0px;margin-bottom:0px;'>
					<a title='".$csdamat_items['name_product']."' href='#'>".$csdamat_items['name_product']."</a>
					</h2>
					<div class='price'>".number_format($csdamat_items['price_product'])." VNĐ</div><!--end price-->
					<div class='ratings'>
						<div class='rating-box'>
							<div style='width:100%;' class='rating'></div><!--end rating-->
						</div><!--end ratingbox-->
					</div><!--end ratings-->
					<div class='add_cart'><a href='san-pham/add-cart.php?id=".$csdamat_items['id_product']."'>MUA NGAY</a></div>
					";
				?>
                	</div><!--end row_product_h-->
                </div><!--end owl-item--->
                <?php
					}
				?>
                </div><!--end owl-wrapper-->
            </div><!--end owl-wrapper-outer-->
    	</div><!---end row_product owl-carousel owl-theme-->
    </div><!--end sliderows slider_row_t slider_row_blue-->

<!----------------------------------sliderows sliderows_t sliderows_hg------------------------------------------->    
    
    <div class="sliderows sliderows_t sliderows_hg">
    	<div class="navicate">
        	<h2 class="parent">
            	<a href="#" tittle="DINH DƯỠNG SỨC KHỎE">DINH DƯỠNG SỨC KHỎE</a>
            </h2><!--end parent-->
            <div class="sub">
        		<a href="#" tittle="Xem tất cả">Xem tất cả</a>
                <i></i>
        	</div><!--end sub-->
            <?php
            	$csdamat_query="SELECT * FROM submenu where type_sub=N'Uống đẹp da' limit 5";/* <-----------viet them code gioi han 7 san pham */
				$csdamat_res = mysqli_query($conn,$csdamat_query) or die('Cannot select table!');
				while ($csdamat_items = mysqli_fetch_array($csdamat_res))
				{
			?>
            	<h2 class="sub">
            <?php
				echo"<a href='#'>".$csdamat_items['name_sub']."</a>";
				echo"</h2>";
				}
			?>
        </div><!--end navicate-->
        <div class="navicate2">
        <a href="#" tittle="Sakura HCL" target="_blank">
        	<img class="banner_rows" src="images/73edab53a905e840888f8f2ea98e82c1.png" alt="Sakura HCL"/>
    	</a>
    <div class="selling">
    	<a href="#" tittle="Sakura CHP" target="_blank">
        	<img src="images/2a4cc61106984cf28422d1ed838f0c9c.png" alt="Sakura CHP"/>
    	</a>
    </div><!--end selling--->
    	</div>

    </div><!--end sliderows slider_row_t slider_row_hg-->
    
    
</div><!--end content-->


<!------------------------------------------FOOTER------------------------------------------------------>

<div class="footer">
	<div class="homeEmail">
    	<div class="container">
        	<div class="connect">
            	KẾT NỐI VỚI MTL
                <a title="Facebook" href="#" rel="nofollow" target="_blank" class="fb"></a>
                <a title="Google+" href="#" rel="nofollow" target="_blank" class="gg"></a>
                <a title="Youtube" href="#" rel="nofollow" target="_blank" class="ytb"></a>
                <div class="backtop">
    				<b></b>
				</div><!--end backtop-->
            
            </div><!--end connect--->
            
            
        </div><!--end container footer-->
    </div><!---end homeEmail-->
    <div class="container">
    	<div class="link">
        	<div class="tittleSk">HỖ TRỢ KHÁCH HÀNG</div><!--end tittleSk-->
            <ul>
            	<li><a href="#" title="Quy định hình thức thanh toán">Quy định hình thức thanh toán</a></li>
                <li><a href="#" title="Chính sách vận chuyển, giao nhận">Chính sách vận chuyển, giao nhận</a></li>
                <li><a href="#" title=" Chính sách đổi/trả hàng và hoàn tiền "> Chính sách đổi/trả hàng và hoàn tiền </a></li>
                <li><a href="#" title=" Chính sách bảo mật "> Chính sách bảo mật </a></li>
                
            </ul>
        </div><!--end link-->
        <div class="link call"> Tổng đài tư vấn bán hàng (7:30 - 22:00) hằng ngày
        	<span class="tongtaituphone"></span><!--end tongdaituphone--><br/>
            Điện thoại
            <span class="tongtaituphone">0396646090 - Nguyễn Đức Vân</span><!--end tongdaituphone--><br/>
            Giải quyết khiếu nại từ (9:00 - 17:00) hằng ngày
        </div><!--end link call-->
		<div class="address">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.5155634190037!2d105.73587971424573!3d21.0520609923599!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454f777de8cad%3A0xef948a65db9e4dce!2zMTEyLCAxMCBQaOG7kSBOZ3V5w6puIFjDoSwgTWluaCBLaGFpLCBU4burIExpw6ptLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1645251043612!5m2!1svi!2s" width="400px" height="180px" frameborder="0" style="border:1px solid white;border-radius: 10px 10px 10px 10px;" allowfullscreen></iframe>				
						</div>
    </div><!--end container footer-->
    <div class="clear"></div><!--end clear-->
    <div class="footerAdd"> © 2022. Công Ty Mỹ Phẩm HMV<br/>
    Địa chỉ : Phường Minh Khai, Quận Bắc Từ Liêm, Thành Phố Hà Nội.
    
    </div><!--end footeradd-->
    <div class="footeraou"></div><!--footeraou-->
    
</div><!---end footer-->


</div><!--End Wrapper---> 
	
</body>
</html>