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
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js' type='text/javascript'></script>
<title>Mỹ phẩm cao cấp | Chính hãng</title>
<script>	
	$(document).ready(function() {
	function ativeMenuLoaiDa(var_e,var_t)
	{
		$('#loaida').find('.iconE').removeClass("iconEavtive");$(var_e).find('.iconE').addClass("iconEavtive");$('#loaidaval').val("Da "+var_t);
	}

	});
</script>

<script type='text/javascript'>
$(function() {
				 $(window).scroll(function() {
				 if ($(this).scrollTop() != 0) 
				 {
					$('.backtop').fadeIn();
				 } else {
					$('.backtop').fadeOut();
				 }
 				 });
		$('.backtop').click(function() {
			$('body,html').animate({scrollTop: 0}, 800);
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
        	<a href="#">
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
					<ul class='menuHiden' style='display: none;margin-bottom: 0px;margin-top: 0px;padding-left: 0px;padding-right:10px;'>";
						
						
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
										echo"<li><a href='san-pham/". $sub_csbd_items['link_sub']."'>". $sub_csbd_items['name_sub']." </a></li>";
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
            <a href="#" class="cart_top">
            	<span class="count">0</span><!--end count-->
    			<span class="tit">Giỏ hàng</span><!--end tit-->
    		</a>
            </div><!--end nav-->
            
        </div><!--end container-->
    </div><!---menu-->    
</div><!--End Header--->

	<div class="navigation">
    </div> <!--end navigation-->
    <section class="content_ld">
    	
        <aside class="filter" id="filter_cate">
        	<div class="filter_v">
            	<div class="general" id="loaida">
                <ul class="menu_left">
                <?php
					$menu_left_query ="select * from submenu where type_sub =N'chăm sóc da mặt'";
					$menu_left_res =mysqli_query($conn,$menu_left_query);
					echo "<li><a href='san-pham/cham-soc-da-mat.php' class='tittlea'>CHĂM SÓC DA MẶT</a>
									<ul class='menu_in_left'>";
									while($menu_left_items = mysqli_fetch_array($menu_left_res))
									{
										echo"<li><a href='san-pham/".$menu_left_items['link_sub']."'>".$menu_left_items['name_sub']." </a></li>";
									}
					echo "
									</ul>
						</li>";
				?>
                </ul>
                </div><!--end general loaida-->
                
                <div class="clear15px"></div>
                <div class="general" id="loaida">
                <ul class="menu_left" >
                <?php
					$menu_left2_query ="select * from submenu where type_sub =N'chăm sóc body'";
					$menu_left2_res =mysqli_query($conn,$menu_left2_query);
					echo "<li><a href='san-pham/cham-soc-body.php' class='tittlea'>CHĂM SÓC BODY</a>
									<ul class='menu_in_left'>";
									while($menu_left2_items = mysqli_fetch_array($menu_left2_res))
									{
										echo"<li><a href='san-pham/".$menu_left2_items['link_sub']."'>".$menu_left2_items['name_sub']." </a></li>";
									}
					echo "
									</ul>
						</li>";
				?>
                </ul>
                </div><!--end general loaida-->
                
                <div class="clear15px"></div>
                <div class="general" id="loaida">
                <ul class="menu_left" >
                <?php
					$menu_left3_query ="select * from submenu where type_sub =N'mặt'";
					$menu_left3_res =mysqli_query($conn,$menu_left3_query);
					echo "<li><a href='#' class='tittlea'>MẶT</a>
									<ul class='menu_in_left'>";
									while($menu_left3_items = mysqli_fetch_array($menu_left3_res))
									{
										echo"<li><a href='san-pham/".$menu_left3_items['link_sub']."'>".$menu_left3_items['name_sub']." </a></li>";
									}
					echo "
									</ul>
						</li>";
				?>
                </ul>
                </div><!--end general loaida-->
                
                <div class="clear15px"></div>
                 <div class="general" id="loaida">
                <ul class="menu_left" >
                <?php
					$menu_left4_query ="select * from submenu where type_sub =N'mắtt'";
					$menu_left4_res =mysqli_query($conn,$menu_left4_query);
					echo "<li><a href='#' class='tittlea'>MẮT</a>
									<ul class='menu_in_left'>";
									while($menu_left4_items = mysqli_fetch_array($menu_left4_res))
									{
										echo"<li><a href='san-pham/".$menu_left4_items['link_sub']."'>".$menu_left4_items['name_sub']." </a></li>";
									}
					echo "
									</ul>
						</li>";
				?>
                </ul>
                </div><!--end general loaida-->
                
                <div class="clear15px"></div>
                <div class="general" id="loaida">
                <ul class="menu_left" >
                <?php
					$menu_left5_query ="select * from submenu where type_sub =N'uống đẹp da'";
					$menu_left5_res =mysqli_query($conn,$menu_left5_query);
					echo "<li><a href='#' class='tittlea'>DINH DƯỠNG - SỨC KHỎE</a>
									<ul class='menu_in_left'>";
									while($menu_left5_items = mysqli_fetch_array($menu_left5_res))
									{
										echo"<li><a href='san-pham/".$menu_left5_items['link_sub']."'>".$menu_left5_items['name_sub']." </a></li>";
									}
					echo "
									</ul>
						</li>";
				?>
                </ul>
                </div><!--end general loaida-->
                
                <div class="clear15px"></div>
                
                
            </div><!--end filter_v-->
        </aside><!--end filter -->
        <aside class="product_l">
        	<div class="product_boder">
            	<?php 
								$search = isset($_GET['timkiem']) ? $_GET['timkiem'] : "";
								// tong so records
								if($search){
									$result =mysqli_query($conn,"select count(id_product) as total from product where name_product LIKE '%".$search."%' ");
								}
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
								$result = mysqli_query($conn,"SELECT * FROM product where name_product LIKE '%".$search."%' LIMIT $start, $litmit");
								
				?>
                <?php
					while ($row = mysqli_fetch_assoc($result))
					{
						echo"<div class='product_item'>";
						echo"
							<a href='#' class='images'>
							<img alt='".$row['name_product']."' src='images/".$row['image_product']."'>
							</a>
							<h2 style='margin-top:0px;margin-bottom:0px;'>
							<a title='".$row['name_product']."' href='#'>".$row['name_product']."</a>
							</h2>
							<div class='price'>".number_format($row['price_product'])." VNĐ</div><!--end price-->
							<div class='ratings'>
								<div class='rating-box'>
									<div style='width:100%;' class='rating'></div><!--end rating-->
								</div><!--end ratingbox-->
							</div><!--end ratings-->
							<a href='san-pham/add-cart.php?id=".$row['id_product']."'><div class='add_cart'><i></i>MUA NGAY</div></a>
							";
							echo "</div><!--end product_items-->";
					}
				?>
            </div><!--end product_boder-->
            <div class="phan_trang">
            	<?php
                	if($current_page > 1 && $total_page > 1)
					{
						echo "<a href='search.php?page=".($current_page - 1)."'>
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
						echo "<li><a href='search.php?page=".$i."'>".$i."</a></li>";
						
					}
					echo"</ul>";
					if($current_page < $total_page  && $total_page > 1)
					{
						echo "<a href='my-pham.php?page=".($current_page + 1)."'>
							<b class='next'></b>
						</a>";
					}
					
				?>
            </div><!--end phan_page-->
            
        </aside><!--end product_l-->
    </section><!--end content ld-->


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