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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta property="fb:app_id" content="<span style="color: #ff0000;">149524728806232</span>" />
<meta property="fb:admins" content="<span style="color: #ff0000;">100002892025234</span>"/>
<link rel="stylesheet" type="text/css" href="../css/style.css"/>
<link rel="stylesheet" type="text/css" href="../css/reset.css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js' type='text/javascript'></script>

<title>Mỹ phẩm cao cấp | Chính hãng</title>
<script>	
	$(document).ready(function() {
		function goBack(){
				window.history.back();
			}

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
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.7&appId=149524728806232";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<body>

<div id ="wrapper">
<?php 
	include("../index/connect.php");

?>
<div id ="header">

	<div class ="topbar">
    <div class ="container">
    	<div class="logo">
        	<a href="#"><?php
            	$logo_query = mysqli_query($conn,"SELECT * FROM logo_website ORDER BY  id_logo DESC limit 1");
				while($logo_items = mysqli_fetch_array($logo_query))
				{
					echo '<img src="../images/'.$logo_items['image_logo'].'" alt="'.$logo_items['name_logo'].'" tittle="'.$logo_items['name_logo'].'"/>';
				}
			?></a>
        </div><!--end logo-->
    	<div class="search">
        	<form class="searchform" action="../index/search.php" method="get">
			<input class="s" onfocus="if (this.value == 'Tìm kiếm …') {this.value = '';}" onblur="if (this.value == '') {this.value =		 		'Tìm kiếm …';}" type="text" name="timkiem" value="Tìm kiếm …" width="300px" />
        	<button class="searchsubmit" name="btTimkiem" type="submit" value=""> </button>
			</form>
        </div><!-----end search---->
        <?php
	if(isset($_POST["btSubmit"]))
	{
		$username= $_POST["username"];
		$password =md5($_POST["password"]);
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
                header('Location: ../admin/set_cart.php');
			}
		}
	}
?>
        <div class="login">
        <?php
			$sql_query =mysqli_query($conn, "select * from account where user_name=".$_SESSION['user_name']);
			$sql_it = mysqli_fetch_array($sql_query);
			$level = $sql_it['level'];
        	if (isset($_SESSION['username']))
			{
				if($level == '1')
				{
					echo '<a href="../admin/admin.php" style="display:block; !important;" class="xinchao">Xin chào: '.$_SESSION['username'].'
				<div class="hv_member">
          		<span class="exit"><a href="../admin/logout.php">Đăng xuất</a></span>
         		 </div><!--end member-->
				</a>';
				}
				else
				{
					echo '<a href="#" style="display:block; !important;" class="xinchao">Xin chào: '.$_SESSION['username'].'
				<div class="hv_member">
          		<span class="exit"><a href="../admin/logout.php">Đăng xuất</a></span>
         		 </div><!--end member-->
				</a>';
				}
				echo '<a href="#login-box" class="login-window" style="display:none !important;">Đăng nhập</a><a href="#" style="display:none !important;"> / Đăng ký</a>';
			}
			else
			{
				echo '<a href="../admin/admin.php" style="display:none; !important;" class="xinchao">Xin chào:'.$_SESSION['username'].'</a>';
				echo '<a href="#login-box" class="login-window" style="display:block !important;">Đăng nhập/Đăng ký</a>
';

			}
			
		?>

        </div><!--end login-->
        <div id="login-box" class="login-popup">
        	<a href="" class="close"><img src="../close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
          <form method="post" class="signin" action="shopping-cart.php">
                <fieldset class="textbox">
                <span>Đăng nhập để đặt hàng!</span><br/>
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
                <a class="forgot" href="#">Quên mật khẩu?</a> <a href="../admin/register.php" class="register">Đăng ký</a>
                </p>
                
                
                </fieldset>
          </form>
          
		</div><!--end login-->
       	<div class="hotline">
        	<div class="ptittle">Hotline:</div><!--ptille-->
            <div class="pdetail">0984 114 827 - 0973 367 087</div><!--pdetail-->
            
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
		
					echo "<div class='menu_leve_1'><a href = '../".$menu_items['link_menu']."' class='parent'>".$menu_items['name_menu']."</a>
					<ul class='menuHiden' style='display: none;margin-bottom: 0px;margin-top: 0px;padding-left: 0px;padding-right:10px;'>";
						
						
						if($menu_items["name_menu"] == 'Mỹ Phẩm')
						{
							echo "<li class='active'><a href='cham-soc-da-mat.php'><br/>CHĂM SÓC DA MẶT</a>
									<ul style='padding-left:0px;padding-bottom:10px;'>";
									while($sub_csdm_items = mysqli_fetch_array($sub_csdm_res,MYSQLI_ASSOC))
									{
										echo"<li><a href='".$sub_csdm_items['link_sub']."'>". $sub_csdm_items['name_sub']." </a></li>";
									}
							echo "
									</ul>
									</li>";
							/*------------------*/
							echo "<li class='active'><a href='cham-soc-body.php'><br/>CHĂM SÓC BODY</a>
									<ul style='padding-left:0px;'>";
									while($sub_csbd_items = mysqli_fetch_array($sub_csbd_res,MYSQLI_ASSOC))
									{
										echo"<li><a href='". $sub_csbd_items['link_sub']."'>". $sub_csbd_items['name_sub']." </a></li>";
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
							else
							{}
						
						
							
							
					
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
                    <img src="../images/<?php echo $rows['image_product']; ?>" class="cartImg">
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
<div class="navigation">

</div>
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
	<div class="main-shopping">
<p class="cart_info"><?php if($_SESSION['cart'] != NULL) {echo "Thông tin chi tiết giỏ hàng!";} else{echo"Hiện tại bạn chưa có sản phẩm nào!";} ?></p>
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
		<!--SHOW CART-->
	
        <ul class="bottom_cart">
        	<li class="sp">
            	<a><img src="../images/<?php echo $rows['image_product']; ?>" class="cartImg"></a>
                <a class="Cart_title_pro"><?php echo $rows['name_product']; ?></a>
                <div class="delete_Cart"><a href="delcart.php?id=<?php echo $rows['id_product']; ?>">Bỏ sản phẩm</a></div>
            </li>
            <li class="dg"><?php echo number_format($rows['price_product']);?> VNĐ</li>
            <li class="sl"> <input type="text" name ="num[<?php echo $rows['id_product']; ?>]" value="<?php echo $_SESSION['cart'][$rows['id_product']]; ?>" size="3" class="capnhatCartTxt"/></li>
            <li class="tt"><?php echo number_format($rows['price_product']*$_SESSION['cart'][$rows['id_product']]); ?> VNĐ</li>
        </ul>	
<?php
$sum_all += $rows['price_product']*$_SESSION['cart'][$rows['id_product']];
$sum_sp += $_SESSION['cart'][$rows['id_product']];
		}
	}
?>
    </div><!--end cart_oder-->

<p class="update_cart">
	<input type="submit" name="update_cart" value="Cập nhật giỏ hàng" class="cap_nhat_cart"/>
    <!--<input type="button" name="dat_hang" value="Đặt hàng" class="dat_hang"/>-->
   	<?php
    	if(isset($_SESSION['username']))
		{
			echo '<a href="../admin/set_cart.php" class="dat_hang" style="display:block;">Đặt hàng</a>';
			echo '<a href="#login-box" id="dat_hang" class="login-window" style="display:none;">Đặt hàng</a>';
		}
		else
		{
			echo '<a href="../admin/set_cart.php" class="dat_hang" style="display:none;">Đặt hàng</a>';
			echo '<a href="#login-box" id="dat_hang" class="login-window" style="display:block;">Đặt hàng</a>';
		}
	?>

    
</p><!--end update-cart--->

<p class="sum_money">Tổng sản phẩm:<strong class="sum_sp"><?php echo $sum_sp; ?></strong><br/>Tổng tiền:<strong class="sum_sp"><?php echo number_format($sum_all); ?> VNĐ</strong></p>

<a href="javascript:history.go(-1)" class="back_page"> Tiếp tục mua hàng</a>

<a href="delcart.php?id=0" class="delete_all">Xóa giỏ hàng</a>



</form>
</div><!--end main shopping--> 
<div class="clear10px"></div>
    	
    	
    


<!------------------------------------------FOOTER------------------------------------------------------>

<div class="footer">
	<div class="homeEmail">
    	<div class="container">
        	<div class="connect">
            	KẾT NỐI VỚI MTL
                <a title="Facebook Lữ Quí Long" href="https://www.facebook.com/Long.Lee123" rel="nofollow" target="_blank" class="fb"></a>
                <a title="Google+ Lữ Quí Long" href="https://plus.google.com/u/1/110437871752923052188/posts" rel="nofollow" target="_blank" class="gg"></a>
                <a title="Youtube Lữ Quí Long" href="https://www.youtube.com/channel/UC57CLyFw6NgFBLzlscQReUg" rel="nofollow" target="_blank" class="ytb"></a>
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
        <div class="link call"> Tổng đài tư vấn bán hàng (7:30 - 22:00) hằng ngày<br/>
        	<span class="tongtaituphone">0984 114 827(Long) - 0973 367 087(Mẩn)</span><!--end tongdaituphone--><br/>
            Điện thoại
            <span class="tongtaituphone">0984 114 827(Long) - 0973 367 087(Mẩn)</span><!--end tongdaituphone--><br/>
            Giải quyết khiếu nại từ (9:00 - 17:00) hằng ngày
            <span class="tongtaituphone">0984 114 827(Long) - 0973 367 087(Mẩn)</span><!--end tongdaituphone-->
        </div><!--end link call-->
    </div><!--end container footer-->
    <div class="clear"></div><!--end clear-->
    <div class="footerAdd"> © 2016. Công Ty Mỹ Phẩm MTL<br/>
    Địa chỉ : 624 âu cơ,quận tân phú,TPHCM .
    
    </div><!--end footeradd-->
    <div class="footeraou"></div><!--footeraou-->
</div><!---end footer-->

</div><!--End Wrapper---> 
</body>
</html>