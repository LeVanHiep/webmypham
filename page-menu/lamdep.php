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
	function ativeMenuLoaiDa(var_e,var_t)
	{
		$('#loaida').find('.iconE').removeClass("iconEavtive");$(var_e).find('.iconE').addClass("iconEavtive");$('#loaidaval').val("Da "+var_t);
	}

	});
</script>
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js' type='text/javascript'></script>
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
        	<form class="searchform" action="../search.php" method="get">
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
		
					echo "<div class='menu_leve_1'><a href = '../".$menu_items['link_menu']."' class='parent'>".$menu_items['name_menu']."</a>
					<ul class='menuHiden' style='display: none;margin-bottom: 0px;margin-top: 0px;padding-left: 0px;padding-right:10px;'>";
						
						
						if($menu_items["name_menu"] == 'Mỹ Phẩm')
						{
							echo "<li class='active'><a href='#'><br/>CHĂM SÓC DA MẶT</a>
									<ul style='padding-left:0px;padding-bottom:10px;'>";
									while($sub_csdm_items = mysqli_fetch_array($sub_csdm_res,MYSQLI_ASSOC))
									{
										echo"<li><a href='#'>". $sub_csdm_items['name_sub']." </a></li>";
									}
							echo "
									</ul>
									</li>";
							/*------------------*/
							echo "<li class='active'><a href='#'><br/>CHĂM SÓC BODY</a>
									<ul style='padding-left:0px;'>";
									while($sub_csbd_items = mysqli_fetch_array($sub_csbd_res,MYSQLI_ASSOC))
									{
										echo"<li><a href='#'>". $sub_csbd_items['name_sub']." </a></li>";
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
    	<div class="blackRum">
        	<span class="home">
            	<a href="../index.php">Trang chủ</a>
                 › 
            </span><!--end home-->
            <span class="tittleRum">
            	<?php 
					$mypham_query ="SELECT * FROM menu where name_menu=N'Làm Đẹp'";
					$mypham_res = mysqli_query($conn,$mypham_query) or die("Cannot select table!");
					while ($mypham_items = mysqli_fetch_array($mypham_res))
					{
						echo'
								'.$mypham_items["name_menu"].'
							';
					}
				?>
            </span><!--tittle rum-->
        </div><!--end blackRum-->
    </div> <!--end navigation-->
    <section class="content_ld">
		<aside class="content_top">
        	<?php
            	$res=mysqli_query($conn,"select * from news where type_news= 1");
				while($items = mysqli_fetch_array($res))
				{
					echo '<div class="item">';
					echo '<a class="center_img" title="title="“Thoát” khỏi nám da sau “5 năm” chạy chữa khổ sở" href="#""><img src="../images/'.$items["image_news"].'" alt="“Thoát” khỏi nám da sau “5 năm” chạy chữa khổ sở"></a>';
					echo '  <h2>
								<a title="“Thoát” khỏi nám da sau “5 năm” chạy chữa khổ sở" href="#">'.$items["tittle_news"].'</a>
							</h2>';
					echo '</div><!--end item-->';
				}
			?>
        </aside><!--end content-top--> 
        <div class="clear10px"></div><!--end clear-->
        <aside class="content_pro_hot">
        	<div class="titile_hot">
            	<?php
                	$mypham_query ="SELECT * FROM menu where name_menu=N'Làm Đẹp'";
					$mypham_res = mysqli_query($conn,$mypham_query) or die("Cannot select table!");
					while ($mypham_items = mysqli_fetch_array($mypham_res))
					{
						echo'
								'.$mypham_items["name_menu"].'
							';
					}
				?>
                <span></span>
            </div><!--end titile_hot-->
            <ul class="nav_content" style="position: static; top: auto; left: 0px; width: 190px; margin-top: 0px;padding-left: 0px;">
            	<?php 
					$make_bf =mysqli_query($conn,"SELECT * FROM submenu where type_sub =N'làm đẹp'");
					while($items_bf = mysqli_fetch_array($make_bf))
					{
						echo '<li><a href="http://hoaanhdao.vn/lam-dep/cach-duong-trang-da">'.$items_bf["name_sub"].'</a></li>';
					}
				?>
            </ul><!--end nav_content-->
        </aside><!--end content_pro_hot-->
        <aside class="content_list">
        	<?php
            	$res=mysqli_query($conn,"select * from news where type_news =2 ");
				while($items = mysqli_fetch_array($res))
				{
					echo '<div class="allV">';
					echo '<div class="images">
						<a href="#"><img src="../images/'.$items["image_news"].'" alt=""></a>
					</div>';
					echo '<h2 class="titile">
						<a href="#" title="'.$items["tittle_news"].'">'.$items["tittle_news"].'</a>
					</h2>';
					echo '<figure style="margin-top: 0px;margin-bottom: 0px;font-size: 13px;color: crimson;">'.$items["content"].'</figure>';
					echo '</div><!--end allV-->';
				}
			?>
        </aside><!--content_list-->
        <aside class="right_content">
        	<div class="titile_h">
            	<span>TIN LÀM ĐẸP ĐƯỢC XEM NHIỀU</span>
            </div><!--end titile_h-->
            <div class="filter filterLq">
            	<?php
                	$res=mysqli_query($conn,"select * from news where type_news =1 ");
					while($items = mysqli_fetch_array($res))
					{
						echo '<div class="content_v">';
							echo '<div class="images">
									<a href="#"><img src="../images/'.$items["image_news"].'" width="120"></a>	
								</div>';
							echo '<h3 class="detail"><a title="'.$items["tittle_news"].'" href="#">'.$items["tittle_news"].'</a></h3>';
						echo '</div>';
					}
				?>
            </div><!--filter filterLq-->
        </aside>
    </section><!--end content ld-->


<!------------------------------------------FOOTER------------------------------------------------------>

<div class="footer">
	<div class="homeEmail">
    	<div class="container">
        	<div class="connect">
            	KẾT NỐI VỚI HMV
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