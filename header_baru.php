   
<!DOCTYPE html>
<html class="no-js"> 
<head>

<?php
@session_start();
//print_r($_SESSION);
//echo "tess";

	include "inc/conn.php";
	$app="http://".$_SERVER['HTTP_HOST']."";
	if(empty($_SESSION['uname'])){
	header("Location: ".$app."/login.php");
	}
	if(isset($_GET[idnya])){
	$updatestatus="update tbl_notif2 set ip='1' where id='$_GET[idnya]'";
	//echo $updatestatus;
	$eks=pg_query($updatestatus)or die($updatestatus);
	}



?>

<meta charset="utf-8">
<title>Aplikasi Disposisi</title>
<meta name="description" content="Disposisi Surat">
<meta name="author" content="pixelcave">
<meta name="robots" content="noindex, nofollow">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
<!--
<link rel="shortcut icon" href="http://pixelcave.com/demo/flatapp/img/favicon.ico">
<link rel="apple-touch-icon" href="	img/icon57.png" sizes="57x57">
<link rel="apple-touch-icon" href="http://pixelcave.com/demo/flatapp/img/icon72.png" sizes="72x72">
<link rel="apple-touch-icon" href="http://pixelcave.com/demo/flatapp/img/icon76.png" sizes="76x76">
<link rel="apple-touch-icon" href="http://pixelcave.com/demo/flatapp/img/icon114.png" sizes="114x114">
<link rel="apple-touch-icon" href="http://pixelcave.com/demo/flatapp/img/icon120.png" sizes="120x120">
<link rel="apple-touch-icon" href="http://pixelcave.com/demo/flatapp/img/icon144.png" sizes="144x144">
<link rel="apple-touch-icon" href="http://pixelcave.com/demo/flatapp/img/icon152.png" sizes="152x152">-->
<link rel="stylesheet" href="<?php echo $app;?>/css/font.css">
<link rel="stylesheet" href="<?php echo $app;?>/css/bootstrap-1.4.css">
<link rel="stylesheet" href="<?php echo $app;?>/css/plugins-1.4.css">
<link rel="stylesheet" href="<?php echo $app;?>/css/main-1.4.css">
<link rel="stylesheet" href="<?php echo $app;?>/css/themes-1.4.css">
<script src="<?php echo $app;?>/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
<script src="<?php echo $app;?>/js/jquery.min.js"></script>
<script type="text/javascript">
var app=<?php echo $app;?>;
	function refresh(){
		 location.reload();
	}
</script>
</head>
<body><!--<b style="color:red;">
&nbsp;&nbsp;&nbsp;&nbsp;Pemberitahuan Bahwa Disposisi Akan Ada Perpindahan Server Pada Hari Minggu </br> &nbsp;&nbsp;&nbsp;&nbsp;Sehubungan Dengan Ini Bahwa Hari Minggu 24/08/2014 Disposisi Tidak Bisa Diakses</br>TI </b>-->
<div id="page-container" class="full-width">
<header class="navbar navbar-inverse">
<div class="row">
<div class="col-sm-4 hidden-xs">
<ul class="navbar-nav-custom pull-left">
<li class="visible-md visible-lg">
<a href="javascript:void(0)" id="toggle-side-content">
<img src="<?php echo $app;?>/img/list.png" width="25">
</a>
</li>
<li class="divider-vertical"></li>
</ul>
</div>
<div class="col-sm-4 col-xs-12 text-center">
<form id="top-search" class="pull-left" action="" method="post">
<input type="text" id="search-term" class="form-control" name="search-term" placeholder="Search..">
</form>
<a href="index.php" class="navbar-brand">
<img src="<?php echo $app;?>/img/logo2.png" alt="logo">
</a>
<div id="loading" class="display-none"><i class="icon-spinner icon-spin"></i></div>
</div>
<div id="header-nav-section" class="col-sm-4 col-xs-12 clearfix">
<ul class="navbar-nav-custom pull-right">
<li class="dropdown dropdown-theme-options">
<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Theme Options</a>
<ul class="dropdown-menu pull-right">
<li class="theme-extra visible-md visible-lg">
<label for="theme-page-full">
<input type="checkbox" id="theme-page-full" name="theme-page-full" class="input-themed">
Full width page
</label>
</li>
<li class="divider visible-md visible-lg"></li>
<li class="theme-extra visible-md visible-lg">
<label for="theme-sidebar-sticky">
<input type="checkbox" id="theme-sidebar-sticky" name="theme-sidebar-sticky" class="input-themed">
Sticky Sidebar
</label>
</li>
<li class="divider visible-md visible-lg"></li>
<li class="theme-extra">
<label for="theme-header-top">
<input type="checkbox" id="theme-header-top" name="theme-header-top" class="input-themed">
Top fixed header
</label>
<label for="theme-header-bottom">
<input type="checkbox" id="theme-header-bottom" name="theme-header-bottom" class="input-themed">
Bottom fixed header
</label>
</li>
<li></li>
<li class="divider"></li>
<li>
<ul class="theme-colors clearfix">
<li class="active">
<a href="javascript:void(0)" class="img-circle themed-background-default themed-border-default" data-theme="default" data-toggle="tooltip" title="Default"></a>
</li>
<li>
<a href="javascript:void(0)" class="img-circle themed-background-amethyst themed-border-amethyst" data-theme="<?php echo $app;?>/css/themes/amethyst.css" data-toggle="tooltip" title="Amethyst"></a>
</li>
<li>
<a href="javascript:void(0)" class="img-circle themed-background-army themed-border-army" data-theme="<?php echo $app;?>/css/themes/army.css" data-toggle="tooltip" title="Army"></a>
</li>
<li>
<a href="javascript:void(0)" class="img-circle themed-background-asphalt themed-border-asphalt" data-theme="<?php echo $app;?>/css/themes/asphalt.css" data-toggle="tooltip" title="Asphalt"></a>
</li>
<li>
<a href="javascript:void(0)" class="img-circle themed-background-autumn themed-border-autumn" data-theme="<?php echo $app;?>/css/themes/autumn.css" data-toggle="tooltip" title="Autumn"></a>
</li>
<li>
<a href="javascript:void(0)" class="img-circle themed-background-cherry themed-border-cherry" data-theme="<?php echo $app;?>/css/themes/cherry.css" data-toggle="tooltip" title="Cherry"></a>
</li>
<li>
<a href="javascript:void(0)" class="img-circle themed-background-city themed-border-city" data-theme="<?php echo $app;?>/css/themes/city.css" data-toggle="tooltip" title="City"></a>
</li>
<li>
<a href="javascript:void(0)" class="img-circle themed-background-dawn themed-border-dawn" data-theme="<?php echo $app;?>/css/themes/dawn.css" data-toggle="tooltip" title="Dawn"></a>
</li>
<li>
<a href="javascript:void(0)" class="img-circle themed-background-deepsea themed-border-deepsea" data-theme="<?php echo $app;?>/css/themes/deepsea.css" data-toggle="tooltip" title="Deepsea"></a>
</li>
<li>
<a href="javascript:void(0)" class="img-circle themed-background-diamond themed-border-diamond" data-theme="<?php echo $app;?>/css/themes/diamond.css" data-toggle="tooltip" title="Diamond"></a>
</li>
<li>
<a href="javascript:void(0)" class="img-circle themed-background-fire themed-border-fire" data-theme="<?php echo $app;?>/css/themes/fire.css" data-toggle="tooltip" title="Fire"></a>
</li>
<li>
<a href="javascript:void(0)" class="img-circle themed-background-grass themed-border-grass" data-theme="<?php echo $app;?>/css/themes/grass.css" data-toggle="tooltip" title="Grass"></a>
</li>
<li>
<a href="javascript:void(0)" class="img-circle themed-background-leaf themed-border-leaf" data-theme="<?php echo $app;?>/css/themes/leaf.css" data-toggle="tooltip" title="Leaf"></a>
</li>
<li>
<a href="javascript:void(0)" class="img-circle themed-background-night themed-border-night" data-theme="<?php echo $app;?>/css/themes/night.css" data-toggle="tooltip" title="Night"></a>
</li>
<li>
<a href="javascript:void(0)" class="img-circle themed-background-ocean themed-border-ocean" data-theme="<?php echo $app;?>/css/themes/ocean.css" data-toggle="tooltip" title="Ocean"></a>
</li>
<li>
<a href="javascript:void(0)" class="img-circle themed-background-oil themed-border-oil" data-theme="<?php echo $app;?>/css/themes/oil.css" data-toggle="tooltip" title="Oil"></a>
</li>
<li>
<a href="javascript:void(0)" class="img-circle themed-background-stone themed-border-stone" data-theme="<?php echo $app;?>/css/themes/stone.css" data-toggle="tooltip" title="Stone"></a>
</li>
<li>
<a href="javascript:void(0)" class="img-circle themed-background-sun themed-border-sun" data-theme="<?php echo $app;?>/css/themes/sun.css" data-toggle="tooltip" title="Sun"></a>
</li>
<li>
<a href="javascript:void(0)" class="img-circle themed-background-tulip themed-border-tulip" data-theme="<?php echo $app;?>/css/themes/tulip.css" data-toggle="tooltip" title="Tulip"></a>
</li>
<li>
<a href="javascript:void(0)" class="img-circle themed-background-wood themed-border-wood" data-theme="<?php echo $app;?>/css/themes/wood.css" data-toggle="tooltip" title="Wood"></a>
</li>
</ul>
</li>
</ul>
</li>

</ul>
</li>
</div>
</div>
</header>
<?php
	if($_GET['menu']=="disposisi"){
		$link="Distribusi";
		$dactv="class='active'";
	}elseif ($_GET['menu']=="list_edaran") {

		$link="List Edaran Surat";
		$lactv="class='active'";
	}elseif($_GET['menu']=="report"){
		$link="Grafik";
		$gactv="class='active'";

	}elseif ($_GET['menu']=="laporan") {
		$link="Laporan";
		$lpactv="class='active'";
	}elseif ($_GET['menu']=="listsurat") {
		$link="Surat Masuk";
		$smpactv="class='active'";
		$smactv="class='active'";
	}elseif ($_GET['menu']=="listfront") {
		$link="List Disposisi";
		$ldactv="class='active'";
	}elseif ($_GET['menu']=="listsuratPA") {
		$link="Surat Masuk";
		$smpactv="class='active'";
		//$smactv="class='active'";
	}
?>
