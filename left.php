<aside id="page-sidebar" class="collapse navbar-collapse navbar-main-collapse">
<div class="side-scrollable" style="font-size:14px;">
<div class="mini-profile">
<div class="mini-profile-options" >
<a href="" onclick="refresh()" class="badge badge-info loading-on"  title="Refresh">
<img src="<?php echo $app;?>/img/refresh.png" style="width:15px;height:15px;">
</a>
<!--
<a href="<?php echo $app;?>/menu/setting" class="badge badge-success enable-tooltip" role="button" data-toggle="modal" data-placement="right" title="Settings">
-->
<a href="<?php echo $app;?>?menu=setting" class="badge badge-success enable-tooltip" role="button" data-toggle="tooltip" data-placement="right" title="Settings">
<img src="<?php echo $app;?>/img/setting.png" style="width:15px;height:15px;"></a>
<a href="<?php echo $app;?>?menu=logout" class="badge badge-danger" data-toggle="tooltip" data-placement="right" title="Log out">
<!--
<a href="<?php echo $app;?>/menu/logout" class="badge badge-danger" data-toggle="tooltip" data-placement="right" title="Log out">
-->
<img src="<?php echo $app;?>/img/Lout.png" style="width:15px;height:15px;">
</a>
</div>
<a href="page_ready_user_profile.php">
<img src="<?php echo $app;?>/img_profile/<?php echo $_SESSION['uname'];?>.png" alt="Avatar" class="img-circle">
</a>
</div>
<div class="sidebar-tabs-con">
<ul class="sidebar-tabs" data-toggle="tabs">
<li class="active">
<a href="#side-tab-menu"><img src="<?php echo $app;?>/img/menus.png" width="25"></a>
</li>
<li>
<a href="#side-tab-extra"><img src="<?php echo $app;?>/img/diag.png" width="25"></a>
</li>
</ul>
<div class="tab-content" style="font-size:14px;">
<div class="tab-pane active" id="side-tab-menu">
<nav id="primary-nav">
<ul>
<li>
<?php
$sqlcount="select a.*,b.pengirim,c.* from tbl_sekertariat_disposisi a left join tbl_kode_pengirim b on a.pengirim=b.kode_pengirim left join tbl_disposisi c on a.nomor_agenda=c.nomor_agenda where c.ke='$_SESSION[uname]' and c.tgl_tindak_lanjut is null   order by a.id desc";

$ekc=pg_query($sqlcount)or die("error");
while($rs=pg_fetch_array($ekc)){
	if($rs['tgl_tindak_lanjut']!="" and $rs['tgl_tindak_lanjut']!="0"){
		echo "";
	}elseif($rs['tgl_baca']!="" and $rs['tgl_tindak_lanjut']==""){
		echo "";
	}elseif($rs['tgl_baca']=="" and $rs['tgl_tindak_lanjut']=="" and $rs['status_srt']=="1" ){
		echo "";
	}elseif($rs['tgl_baca']!="" and $rs['tgl_tindak_lanjut']!="" and $rs['status_srt']=="1" ){
		echo "";
	}elseif($rs['status_srt']!="1"){
		echo "";
	}
}
$sqljmlsurat="select count(id_disposisi) as jml from tbl_disposisi where ke = '$_SESSION[uname]' and tgl_baca is null and tgl_tindak_lanjut is null and status='0'";
//echo $sqljmlsurat;
$ekjml=pg_query($sqljmlsurat)or die("error");
$rjml=pg_fetch_array($ekjml);

	//echo $sq;

?>
<a href="<?php echo $app;?>" class="<?php  if($_GET['menu']==""){echo "active";}?>"><img src="<?php echo $app;?>/img/monitor.png"  width="20">&nbsp;Inbox &nbsp; <b>(<?php echo $rjml['jml']; ?>)</b></a>
</li>
<?php 
	if($_SESSION['uname']=="admin"){
?>
<li>
<a href="#" class="menu-link"><img src="<?php echo $app;?>/img/user.png" width="22">Sekertariat</a>
<ul style="display:inherit;">
<li>


<a <?php echo $dactv; ?> href="<?php echo $app;?>?menu=disposisigm">Distribusi GM</a>
</li>
<!--<li>

	<a href="<?php echo $app;?>/menu/disposisi">Distribusi</a>

<a <?php echo $dactv; ?> href="<?php echo $app;?>?menu=disposisi">Distribusi</a>
</li>
-->
<li>
<!--<a href="<?php echo $app;?>/menu/list_edaran">List Edaran Surat</a>-->
<a <?php echo $lactv; ?> href="<?php echo $app;?>?menu=list_edaran">List Edaran Surat</a>
</li>
<li>
<!--<a href="<?php echo $app;?>/menu/report">Report</a>-->
<a <?php echo $gactv; ?> href="<?php echo $app;?>?menu=report">Grafik</a>
</li>
<li>
<!--<a href="<?php echo $app;?>/menu/report">Report</a>-->
<a <?php echo $lpactv; ?> href="<?php echo $app;?>?menu=laporan">Laporan</a>
</li>

</ul>
</li>
<?php
}elseif($_SESSION['uname']=="SEKDEKOM" && $_SESSION['uname']=="STAFI" && $_SESSION['uname']=="STAFII"){
?>

<li>
<a href="#" class="menu-link"><img src="<?php echo $app;?>/img/user.png" width="22">DEKOM</a>
<ul style="display:inherit;">
<li>


<a <?php echo $dactv; ?> href="<?php echo $app;?>?menu=disposisigm">Distribusi Komisaris</a>
</li>
<!--<li>

	<a href="<?php echo $app;?>/menu/disposisi">Distribusi</a>

<a <?php echo $dactv; ?> href="<?php echo $app;?>?menu=disposisi">Distribusi</a>
</li>
-->
<li>
<!--<a href="<?php echo $app;?>/menu/list_edaran">List Edaran Surat</a>-->
<a <?php echo $lactv; ?> href="<?php echo $app;?>?menu=list_edaran">List Edaran Surat</a>
</li>
<li>
<!--<a href="<?php echo $app;?>/menu/report">Report</a>-->
<a <?php echo $gactv; ?> href="<?php echo $app;?>?menu=report">Grafik</a>
</li>
<li>
<!--<a href="<?php echo $app;?>/menu/report">Report</a>-->
<a <?php echo $lpactv; ?> href="<?php echo $app;?>?menu=laporan">Laporan</a>
</li>

</ul>
</li>


<?php
}else{
?>
<li>
<!--<a href="#" ><img src="<?php echo $app;?>/img/direksi.png" width="25">Menu</a>-->
<ul style="display:inherit; font-size:14px;" >
<li>
<!--<a href="<?php echo $app;?>/menu/listsurat">Surat</a>-->
<?php
//echo $_SESSION['unit_kerja'];
 if($_SESSION['unit_kerja']!="PA" && $_SESSION['unit_kerja']!="sekertaris"  ){?>
<!--<a <?php echo $smactv;?> href="<?php echo $app;?>?menu=listsurat">Surat Sudah Dibaca</a>-->
<?php
}elseif($_SESSION['unit_kerja']=="sekertaris"){
?>
<a href="<?php echo $app;?>?menu=listsuratSK">Surat</a>
<?php
}else{
?>
<a href="<?php echo $app;?>?menu=listsuratPA">Surat</a>
<?php
}
?>

</li>
<li>
<!--<a href="<?php echo $app;?>/menu/listfront">List Disposisi</a>-->
<?php if($_SESSION['unit_kerja']!="PA" && $_SESSION['unit_kerja']!="sekertaris" ){?>
<a <?php echo $ldactv;?> href="<?php echo $app;?>?menu=listfront">Tracking Disposisi</a>
<?php }?>
</li>

<li>
<!--<a href="<?php echo $app;?>/menu/listfront">List Disposisi</a>-->
<?php if($_SESSION['unit_kerja']!="PA" && $_SESSION['unit_kerja']!="sekertaris" ){?>
<!--<a <?php echo $ldactv;?> href="<?php echo $app;?>?menu=listexpired">Surat On Progress</a>-->
<?php }?>
</li>

<li>
<!--<a href="<?php echo $app;?>/menu/listfront">List Disposisi</a>-->
<?php if($_SESSION['unit_kerja']!="PA" && $_SESSION['unit_kerja']!="sekertaris" ){?>
<!--<a <?php echo $ldactv;?> href="<?php echo $app;?>?menu=listselesai">Surat Selesai(DONE)</a>-->
<?php }?>
</li>



</ul>
</li>
<?php
}
?>
<!--
<li>
<a href="#" class="menu-link"><i class="glyphicon-more_windows"></i>Forms</a>
<ul>
<li>
<a href="page_forms_general.php">General</a>
</li>
<li>
<a href="page_forms_layouts_styles.php">Layouts &amp; Styles</a>
</li>
<li>
<a href="page_forms_pickers_grid.php">Pickers &amp; Grid</a>
</li>
<li>
<a href="page_forms_textareas_wysiwyg.php">Textareas &amp; WYSIWYG</a>
</li>
<li>
<a href="page_forms_upload_dropzone.php">File Upload &amp; Dropzone</a>
</li>
<li>
<a href="page_forms_validation.php">Validation</a>
</li>
<li>
<a href="page_forms_wizard.php">Wizard</a>
</li>
</ul>
</li>
<li>
<a href="#" class="menu-link"><i class="glyphicon-fire"></i>Components</a>
<ul>
<li>
<a href="page_comp_inbox.php">Inbox</a>
</li>
<li>
<a href="page_comp_chat.php">Chat</a>
</li>
<li>
<a href="page_comp_timeline.php">Timeline</a>
</li>
<li>
<a href="page_comp_tiles.php">Tiles</a>
</li>
<li>
<a href="page_comp_gallery.php">Gallery</a>
</li>
<li>
<a href="page_comp_charts.php">Charts</a>
</li>
<li>
<a href="page_comp_calendar.php">Calendar</a>
</li>
<li>
<a href="#" class="submenu-link">Maps</a>
<ul>
<li>
<a href="page_comp_vector_maps.php">Vector Maps</a>
</li>
<li>
<a href="page_comp_google_maps.php">Google Maps</a>
</li>
</ul>
</li>
<li>
<a href="page_comp_syntax_highlighting.php">Syntax Highlighting</a>
</li>
</ul>
</li>
<li>
<a href="#" class="menu-link"><i class="glyphicon-pizza"></i>Icon Packs</a>
<ul>
<li>
<a href="page_icons_glyphicons_pro.php">Glyphicons Pro</a>
</li>
<li>
<a href="page_icons_fontawesome.php">FontAwesome</a>
</li>
<li>
<a href="page_icons_gemicon.php">Gemicon</a>
</li>
</ul>
</li>
<li>
<a href="#" class="menu-link"><i class="glyphicon-certificate"></i>Ready UI</a>
<ul>
<li>
<a href="page_ready_search_results.php">Search Results</a>
</li>
<li>
<a href="page_ready_user_profile.php">User Profile</a>
</li>
<li>
<a href="page_ready_pricing_tables.php">Pricing Tables</a>
</li>
<li>
<a href="#" class="submenu-link">Forum</a>
<ul>
<li>
<a href="page_ready_forum_categories.php">Categories</a>
</li>
<li>
<a href="page_ready_forum_topics.php">Topics</a>
</li>
<li>
<a href="page_ready_forum_conversation.php">Conversation</a>
</li>
</ul>
</li>
<li>
<a href="#" class="submenu-link">e-Shop</a>
<ul>
<li>
<a href="page_ready_product.php">Product</a>
</li>
<li>
<a href="page_ready_products_list.php">Products List</a>
</li>
<li>
<a href="page_ready_shopping_cart.php">Shopping Cart</a>
</li>
</ul>
</li>
<li>
<a href="page_ready_invoice.php">Invoice</a>
</li>
<li>
<a href="page_ready_article.php">Article</a>
</li>
<li>
<a href="page_ready_faq.php">FAQ</a>
</li>
<li>
<a href="#" class="submenu-link">Errors</a>
<ul>
<li>
<a href="page_ready_errors.php">In-Page</a>
</li>
<li>
<a href="page_ready_standalone_error.php">Standalone</a>
</li>
</ul>
</li>
<li>
<a href="page_ready_blank.php">Blank</a>
</li>
</ul>
</li>
<li>
<a href="#" class="menu-link"><i class="glyphicon-power"></i>Login Pages</a>
<ul>
<li>
<a href="page_login.php">Login with animation</a>
</li>
<li>
<a href="page_login_alt.php">Login without animation</a>
</li>
</ul>
</li>
<li>
<a href="page_landing.php"><i class="glyphicon-leaf"></i>Landing Page</a>
</li>-->
</ul>
</nav>
</div>
<div class="tab-pane tab-pane-side" id="side-tab-extra">
<h5><i class="icon-briefcase pull-right"></i><a href="javascript:void(0)" class="side-link">Balance</a></h5>
<div>$25.230,00</div>
<h5><i class="icon-dollar pull-right"></i><a href="javascript:void(0)" class="side-link">Earnings (today)</a></h5>
<div>$1.752,00</div>
<h5><i class="icon-shopping-cart pull-right"></i><a href="javascript:void(0)" class="side-link">Sales (today)</a></h5>
<div>368</div>
<h5><i class="icon-shopping-cart pull-right"></i><a href="javascript:void(0)" class="side-link">Sales (this month)</a></h5>
<div class="text-success">+38%</div>
<h5><i class="icon-ticket pull-right"></i><a href="javascript:void(0)" class="side-link">Open Tickets</a></h5>
<div>23</div>
<h5><i class="icon-bug pull-right"></i><a href="javascript:void(0)" class="side-link">Bugs to fix</a></h5>
<div>2 important</div>
<div>5 normal</div>
</div>
</div>
</div>
</div>
</aside>
