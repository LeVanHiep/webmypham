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
            <span class="tittleRum">
            	<?php 
					$mypham_query ="SELECT * FROM menu where name_menu=N'Mỹ Phẩm'";
					$mypham_res = mysqli_query($conn,$mypham_query) or die("Cannot select table!");
					while ($mypham_items = mysqli_fetch_array($mypham_res))
					{
						echo'
								'.$mypham_items["name_menu"].'
							';
					}
				echo '›';
				?>
            </span><!--tittle rum-->
            <span class="tittleRum">
            	<?php 
					$mypham_query ="SELECT * FROM submenu where name_sub=N'Kem Trị Nám'";
					$mypham_res = mysqli_query($conn,$mypham_query) or die("Cannot select table!");
					while ($mypham_items = mysqli_fetch_array($mypham_res))
					{
						echo'
								'.$mypham_items["name_sub"].'
							';
					}
				?>
            </span><!--tittle rum-->
        </div><!--end blackRum-->
    </div> <!--end navigation-->
    <section class="content_ld">
    	
        <aside class="filter" id="filter_cate">
        	<div class="filter_v">
            	<div class="general" id="loaida">
                <ul class="menu_left">
                <?php
					$menu_left_query ="select * from submenu where type_sub =N'chăm sóc da mặt'";
					$menu_left_res =mysqli_query($conn,$menu_left_query);
					echo "<li><a href='cham-soc-da-mat.php' class='tittlea'>CHĂM SÓC DA MẶT</a>
									<ul class='menu_in_left'>";
									while($menu_left_items = mysqli_fetch_array($menu_left_res))
									{
										echo"<li><a href='".$menu_left_items['link_sub']."'>".$menu_left_items['name_sub']." </a></li>";
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
					echo "<li><a href='cham-soc-body.php' class='tittlea'>CHĂM SÓC BODY</a>
									<ul class='menu_in_left'>";
									while($menu_left2_items = mysqli_fetch_array($menu_left2_res))
									{
										echo"<li><a href='".$menu_left2_items['link_sub']."'>".$menu_left2_items['name_sub']." </a></li>";
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
										echo"<li><a href='#'>".$menu_left3_items['name_sub']." </a></li>";
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
										echo"<li><a href='#'>".$menu_left4_items['name_sub']." </a></li>";
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
										echo"<li><a href='#'>".$menu_left5_items['name_sub']." </a></li>";
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
								// tong so records
								$result =mysqli_query($conn,"select count(id_product) as total from product where useful_product=N'kem trị nám'");
								$row = mysqli_fetch_assoc($result);
								$total_records = $row['total'];
								// tim limit va current 
								$current_page = isset($_GET['page']) ? $_GET['page']:1;
								$litmit =4;
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
								$result = mysqli_query($conn,"SELECT * FROM product where useful_product=N'kem trị nám' LIMIT $start, $litmit");
								
				?>
                <?php
					while ($row = mysqli_fetch_assoc($result))
					{
						echo"<div class='product_item'>";
						echo"
							<a href='#' class='images'>
							<img alt='".$row['name_product']."' src='../images/".$row['image_product']."'>
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
							<div class='add_cart' onclick='clickme()'><i></i>MUA NGAY</div>
							";
							echo "</div><!--end product_items-->";
					}
				?>
                
            </div><!--end product_boder-->
            <div class="phan_trang">
            	<?php
                	if($current_page > 1 && $total_page > 1)
					{
						echo "<a href='kem-tri-nam.php?page=".($current_page - 1)."'>
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
						echo "<li><a href='kem-tri-nam.php?page=".$i."'>".$i."</a></li>";
						
					}
					echo"</ul>";
					if($current_page < $total_page  && $total_page > 1)
					{
						echo "<a href='kem-tri-nam.php?page=".($current_page + 1)."'>
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