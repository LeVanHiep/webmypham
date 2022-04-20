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
	function ativeMenuLoaiDa(var_e,var_t)
	{
		$('#loaida').find('.iconE').removeClass("iconEavtive");$(var_e).find('.iconE').addClass("iconEavtive");$('#loaidaval').val("Da "+var_t);
	}

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
        	<a href="#">
            <?php
            	$logo_query = mysqli_query($conn,"SELECT * FROM logo_website ORDER BY  id_logo DESC limit 1");
				while($logo_items = mysqli_fetch_array($logo_query))
				{
					echo '<img src="../images/'.$logo_items['image_logo'].'" alt="'.$logo_items['name_logo'].'" tittle="'.$logo_items['name_logo'].'"/>';
				}
			?>
            </a>
        </div><!--end logo-->
    	<div class="search">
        	<form class="searchform" action="../index/search.php" method="get">
			<input class="s" onfocus="if (this.value == 'Tìm kiếm …') {this.value = '';}" onblur="if (this.value == '') {this.value =		 		'Tìm kiếm …';}" type="text" name="timkiem" value="Tìm kiếm …" width="300px" />
        	<button class="searchsubmit" name="btTimkiem" type="submit" value=""> </button>
			</form>
        </div><!-----end search---->
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
            <span class="home">
            	<?php
					$id = $_GET['id'];
					$mypham_query ="SELECT * FROM product where id_product=".$id;
					$mypham_res = mysqli_query($conn,$mypham_query) or die("Cannot select table!");
					while ($mypham_items = mysqli_fetch_array($mypham_res))
					{
						echo'
								'.$mypham_items["parent_product"].'
							';
					
				echo '›';
				?>
            </span><!--home-->
            <span class="home">
            	<?php 
					echo ''.$mypham_items["type_product"].'';
					echo ' ›';
					
				?>
            </span><!--home-->
            <span class="tittleRum">
            	<?php 
					echo ''.$mypham_items["name_product"].'';
					}
				?>
            </span><!--tittle rum-->
        </div><!--end blackRum-->
    </div> <!--end navigation-->
    <section class="product_d content_ld">
    	<div class="detailP">
        	<aside class="images_d">
            	<div class="images_d_list owl-carousel owl-theme" style="opacity: 1; display: block;">
                	<div class="owl-wrapper-outer">
                    	<div class="owl-wrapper" style="width: 712px; left: 0px; display: block; transition: all 1000ms ease; transform: translate3d(0px, 0px, 0px);">
                        	<div class="owl-item" style="width: 356px;">
                            	<?php
                                	$id = $_GET['id'];
									$mypham_query ="SELECT * FROM product where id_product=".$id;
									$mypham_res = mysqli_query($conn,$mypham_query) or die("Cannot select table!");
									while ($mypham_items = mysqli_fetch_array($mypham_res))
									{
										echo'<img src="../images/'.$mypham_items["image_product"].'">';
									
								?>
                            </div>
                        </div>
                    </div>
                </div>
            </aside><!--end images_d-->
            <aside class="desProduct">
            	<h1 class="detailPT">
                	<?php
                    	echo $mypham_items["name_product"];
						
					?>
                </h1>
                <div class="des">
                	<?php
									echo $mypham_items['describe_product'];
									
					?>
                </div><!--des-->
                <div class="proFtiter">
                	<?php
									echo 'Xuất xứ:';
									echo "<span>".$mypham_items['xuatxu']."</span>";
									echo '&nbsp;&nbsp;Quy cách:';
									echo "<span>".$mypham_items['quy_cach']."</span>";
									echo '&nbsp;&nbsp;Tình trạng:';
									echo "<span>".$mypham_items['tinh_trang']."</span>";
									
					?>
                </div><!--proFtiter-->
                <div class="pr_det_price ">
                	<span class="tittle">Giá bán:</span><!--tittle-->
                    <div class="price">
                	<?php
									echo "".number_format($mypham_items['price_product'])." VNĐ";
									}
					?>
                    </div><!--end price-->
                </div><!--pr_det_price -->
                <div class="pro_dg">
                	<div class="pro_dg_tt">
                    	<div class="pro_dg_tt">
                        	<div class='ratings'>
								<div class='rating-box'>
									<div style='width:100%;' class='rating'></div><!--end rating-->
								</div><!--end ratingbox-->
							</div><!--end ratings-->
                        </div><!--end pro_dg_tt-->
                    </div><!--end pro_dg_tt-->
                    <a target="_blank" href="http://www.facebook.com/sharer.php?u=http://localhost:3030/webmypham/san-pham/page-chitiet.php?id=<?php echo $id; ?>" class="fb shareFa"></a>
                    <a target="_blank" href="http://twitter.com/share?url=http://myphammtlpro.16mb.com/san-pham/page-chitiet.php?id=<?php echo $id; ?>" class="tw shareFa"></a>
                    <a target="_blank" href="http://www.facebook.com/sharer.php?u=http://myphammtlpro.16mb.com/san-pham/page-chitiet.php?id=<?php echo $id; ?>" class="gg shareFa"></a>
                </div><!--end pro_dg-->
                <div class="proDha">
                	<div class="btDah">
                    	<span class="bttOp">ĐẶT HÀNG NHANH GIAO HÀNG NGAY</span>
                        <span class="btBt">Xem hàng tại nhà không mua không sao</span>
                    </div><!--end btDah-->
                    	
                    <div class="btYctuv"> YÊU CẦU TƯ VẤN </div><!--end btYctuv-->
                </div><!--end proDha-->
                <div class="goiTongDa">
                	<i class="icon"></i>GỌI TƯ VẤN
                    <span>0984 114 827 - 0973 367 087</span>
                </div><!--goiTongDa-->
                <div class="hotroMnd">
                	<span>Để chuyên viên nhiều kinh nghiệm hỗ trợ bạn cách chăm sóc da cũng như chọn mua sản phẩm phù hợp với tình trạng da của bạn.</span>
                </div><!--end hotroMnd-->
            </aside><!--desProduct-->
            <aside class="ckProduct">
            	<div class="titile">
                	CAM KẾT KHI MUA HÀNG TẠI <span>MTL.VN</span>
                    
                </div><!--titile-->
                <div class="deCk deCkTtct">
                	<span class="icon"></span><!--end icon-->
                    <span class="ttCK">Nhận hàng trong <b class="30p">30 phút</b> tại TP.Hồ Chí Minh (Thanh toán Tiền mặt hoặc cà thẻ)</span><!--end ttCK-->
                </div><!--deCk deCkTtct-->
                <div class="deCk deCkGhMpTq">
                	<span class="icon"></span><!--end icon-->
                    <span class="ttCK">Giao hàng miễn phí toàn Quốc</span><!--end ttCK-->
                </div><!--Endd eCk deCkGhMpTq-->
                
                <div class="deCk deCkHln">
                	<span class="icon"></span><!--end icon-->
                    <span class="ttCK">Xem hàng tại nhà hài lòng mới thanh toán</span><!--end ttCK-->
                </div><!--end deCk deCkHln-->
                <div class="deCk deCkHlndt">
                	<span class="icon"></span><!--end icon-->
                    <span class="ttCK">Được đổi trả trong vòng 7 ngày với chính sách đặc biệt thuận lợi</span><!--end ttCK-->
                </div><!--end deCk deCkHlndt-->
                
                <div class="deCk deCkTlnq">
                	<span class="icon"></span><!--end icon-->
                    <span class="ttCK">Nhận ngay mẫu thử miễn phí - Tích lũy nhận quà</span><!--end ttCK-->
                </div><!--end deCk deCkTlnq-->
            </aside><!--end ckProduct-->
        </div><!--end detailP-->
        <div class="clear10px"></div><!--end clear10px-->
        <aside class="product">
        	<article>
            	<?php
                	$id = $_GET['id'];
					$mypham_query ="SELECT * FROM product where id_product=".$id;
					$mypham_res = mysqli_query($conn,$mypham_query) or die("Cannot select table!");
					while ($mypham_items = mysqli_fetch_array($mypham_res))
					{
						echo '<h2 style="text-align: center;" class="uppercaseh2"><strong><span style="font-size:20px">'.$mypham_items['name_product'].'</span></strong></h2>';
						echo $mypham_items["noi_dung"];
					}
				?>
            </article><!---end article-->
            <!--Bình luận -->
            <div class="rightDetailHA">
            	<b class="cmt">MỜI CÁC BẠN BÌNH LUẬN</b>
                <div class="fb-comments" data-href="page-chitiet.php?id=<?php echo $id; ?>" data-width="100%" data-numposts="10">
                
                </div>
            </div>
        </aside><!--end product-->
        <aside class="productEditQri">
        	<div class="pright_product_pos">
            	<div class="right_roduct_hd">
                	<div class="btDah">
                    	<span class="bttOp">ĐẶT HÀNG NHANH GIAO HÀNG NGAY</span>
                        <span class="btBt">Xem hàng tại nhà không mua không sao </span>
                    </div><!--end btDah-->
                    <div class="btYctuv">
                    	<span class="bttOp">YÊU CẦU CHUYÊN GIA TƯ VẤN </span>
                        <span class="btBt">Chuyên viên sẽ gọi lại và tư vấn cách chăm sóc da tốt nhất cho bạn.</span>
                    </div>
                    <div class="phone_product">
                    	0984 114 827 - 0973 367 087
                    </div>
                    <a href="#" target="_blank" class="detRight_ban_bt">
                    	<img src="../images/f224839c5d5b232bd30c69ef624c028f.png"/>
                    </a>
                </div><!--end right_roduct_hds-->
            </div><!--end pright_product_pos-->
            
        </aside><!--end productEditQri-->
    </section>
    	
    


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