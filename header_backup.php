   
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
<li class="divider-vertical"></li>
<?php
if($_SESSION['uname']!="admin"){
		//echo $_SESSION['unit_kerja'];
	if($_SESSION['unit_kerja']=="PA"){
		$ke=substr($_SESSION['uname'],3,100);
	}else{
	
		$ke=$_SESSION['uname'];
	}

?>



<?php
	if($_SESSION['uname']!="admin"){

?>


<?php

if($_SESSION['unit_kerja']=="sekertaris"){
	
?>
<li class="dropdown dropdown-messages">
<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" >
<img src="<?php echo $app;?>/img/amplop.png" width="20" >
<?php
$sqljmlsurat="select count(id) as jml from tbl_sekertaris_lantai where lantai='".substr($_SESSION[uname],3,1)."' and tgl_baca is null";
//echo $sqljmlsurat;
$ekjml=pg_query($sqljmlsurat);
$rjml=pg_fetch_array($ekjml);

	//echo $sq;

?>
<span class="badge badge-neutral"><?php echo $rjml[jml];?></span>
</a>
<ul class="dropdown-menu pull-right">
<?php


	//$sq="select a.*,b.sifat,b.perihal,c.tgl_kirim from tbl_pa a left join tbl_sekertariat_disposisi b on a.nomor_agenda=b.nomor_agenda left join tbl_disposisi c on a.nomor_agenda=c.nomor_agenda where a.atasan='".substr($_SESSION[uname],3,10)."' and a.tgl_baca is null group by a.nomor_agenda,a.tgl_baca,a.tgl_eksekusi,a.atasan,a.dari,a.id,b.sifat,b.perihal,c.tgl_kirim";
	$sq="select a.nomor_agenda,a.tgl_baca,a.lantai,a.gm,a.id,a.tgl_kirim,b.sifat,b.nomor_agenda,b.perihal from tbl_sekertaris_lantai a 
inner join tbl_sekertariat_disposisi b on a.nomor_agenda=b.nomor_agenda
 where a.tgl_baca is null and a.lantai='".substr($_SESSION[uname],3,1)."' order by id desc
";
	//echo $sq;
	$eksq=pg_query($sq);
	while($rs=pg_fetch_array($eksq)){
?>
	<li>
	<div class="media">
	<a class="pull-left" href="<?php echo $app;?>?detail=bacapesanPA&id=<?php echo $rs['nomor_agenda'];?>&dari=<?php echo $rs['dari'];?>&ke=<?php echo $rs['atasan'];?>" data-toggle="tooltip" title="Newbie">
	<img src="<?php echo $app;?>/img/email.png" alt="fakeimg" class="img-circle">
	</a>
	<div class="media-body">
	<div class="media-heading clearfix"><span class="label label-success" style='font-size:10px;'><?php $datetime=$rs[tgl_kirim]; echo  $date = new Cokidoo_Datetime($datetime); ?></span><a href="<?php echo $app;?>?detail=bacapesanPA&id=<?php echo $rs['nomor_agenda'];?>&dari=<?php echo $rs['dari'];?>&ke=<?php echo $rs['atasan'];?>"><?php if($rs['sifat']=="2"){echo "<b style='color:red;'>Segera</b>";}else{echo "Biasa";} ?></a></div>
	<div class="media" style="font-size:10px;"><?php echo "sekertariat";?> Ke <?php echo $rs['gm'];?></div>
	<div class="media" style="font-size:10px;"><?php echo $rs['perihal'];?></div>
	<?php
		$sqlst="select tgl_baca,tgl_tindak_lanjut from tbl_disposisi where ke='".substr($_SESSION[uname],3,10)."' and nomor_agenda='".$rs['nomor_agenda']."'";
		$eksst=pg_query($sqlst);
		$rst=pg_fetch_array($eksst);
		//echo $rst['tgl_baca'];
	?>
	<div class="media" style="font-size:10px;"><h6 style='color:red;'><?php if($rst['tgl_baca']==""){echo "Disposisi Belum Dibaca Oleh".substr($_SESSION[uname],3,10);}else{echo "Disposisi Telah Dibaca Oleh ".substr($_SESSION[uname],3,10);} if($rst['tgl_tindak_lanjut']==""){echo "Disposisi Belum Ditindak Lanjut Oleh".substr($_SESSION[uname],3,10);}else{echo "Disposisi Telah Ditindak Lanjut Oleh".substr($_SESSION[uname],3,10);} if($rst['tgl_baca']=="" && $rst['tgl_tindak_lanjut']==""){echo "Harap Beritahukan Ke Atasannya";}?></h6></div>
	</div>
	</div>
	</li>
	<li class="divider"></li>
<?php
	}
?>

<li class="divider-vertical" style="color:black;">Pusat Pesan</li>
</ul>
<?php
}elseif($_SESSION['unit_kerja']=="PA"){
	
?>
<li class="dropdown dropdown-messages">
<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
<img src="<?php echo $app;?>/img/amplop.png" width="20">
<?php
$sqljmlsurat="select count(id) as jml from tbl_pa where atasan='".substr($_SESSION[uname],3,10)."' and tgl_baca is null";
//echo $sqljmlsurat;
$ekjml=pg_query($sqljmlsurat);
$rjml=pg_fetch_array($ekjml);

	//echo $sq;

?>
<span class="badge badge-neutral"><?php echo $rjml[jml];?></span>
</a>
<ul class="dropdown-menu pull-right">
<?php


	//$sq="select a.*,b.sifat,b.perihal,c.tgl_kirim from tbl_pa a left join tbl_sekertariat_disposisi b on a.nomor_agenda=b.nomor_agenda left join tbl_disposisi c on a.nomor_agenda=c.nomor_agenda where a.atasan='".substr($_SESSION[uname],3,10)."' and a.tgl_baca is null group by a.nomor_agenda,a.tgl_baca,a.tgl_eksekusi,a.atasan,a.dari,a.id,b.sifat,b.perihal,c.tgl_kirim";
	$sq="select a.nomor_agenda,a.tgl_baca,a.atasan,a.dari,a.id,a.tgl_kirim,b.sifat,b.nomor_agenda,b.perihal from tbl_pa a 
inner join tbl_sekertariat_disposisi b on a.nomor_agenda=b.nomor_agenda
 where a.tgl_baca is null and a.atasan='".substr($_SESSION[uname],3,10)."' order by id desc
";
	//echo $sq;
	$eksq=pg_query($sq);
	while($rs=pg_fetch_array($eksq)){
?>
	<li>
	<div class="media">
	<a class="pull-left" href="<?php echo $app;?>?detail=bacapesanPA&id=<?php echo $rs['nomor_agenda'];?>&dari=<?php echo $rs['dari'];?>&ke=<?php echo $rs['atasan'];?>" data-toggle="tooltip" title="Newbie">
	<img src="<?php echo $app;?>/img/email.png" alt="fakeimg" class="img-circle">
	</a>
	<div class="media-body">
	<div class="media-heading clearfix"><span class="label label-success" style='font-size:10px;'><?php $datetime=$rs[tgl_kirim]; echo  $date = new Cokidoo_Datetime($datetime); ?></span><a href="<?php echo $app;?>?detail=bacapesanPA&id=<?php echo $rs['nomor_agenda'];?>&dari=<?php echo $rs['dari'];?>&ke=<?php echo $rs['atasan'];?>"><?php if($rs['sifat']=="2"){echo "<b style='color:red;'>Segera</b>";}else{echo "Biasa";} ?></a></div>
	<div class="media" style="font-size:10px;"><?php echo $rs['dari'];?> Ke <?php echo $rs['atasan'];?></div>
	<div class="media" style="font-size:10px;"><?php echo $rs['perihal'];?></div>
	<?php
		$sqlst="select tgl_baca,tgl_tindak_lanjut from tbl_disposisi where ke='".substr($_SESSION[uname],3,10)."' and nomor_agenda='".$rs['nomor_agenda']."'";
		$eksst=pg_query($sqlst);
		$rst=pg_fetch_array($eksst);
		//echo $rst['tgl_baca'];
	?>
	<div class="media" style="font-size:10px;"><h6 style='color:red;'><?php if($rst['tgl_baca']==""){echo "Disposisi Belum Dibaca Oleh".substr($_SESSION[uname],3,10);}else{echo "Disposisi Telah Dibaca Oleh ".substr($_SESSION[uname],3,10);} if($rst['tgl_tindak_lanjut']==""){echo "Disposisi Belum Ditindak Lanjut Oleh".substr($_SESSION[uname],3,10);}else{echo "Disposisi Telah Ditindak Lanjut Oleh".substr($_SESSION[uname],3,10);} if($rst['tgl_baca']=="" && $rst['tgl_tindak_lanjut']==""){echo "Harap Beritahukan Ke Atasannya";}?></h6></div>
	</div>
	</div>
	</li>
	<li class="divider"></li>
<?php
	}
?>

<li class="divider-vertical" style="color:black;">Pusat Pesan</li>
</ul>
<?php
}else{
?>

<li class="dropdown dropdown-messages">
<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" title="Disposisi Surat">
<img src="<?php echo $app;?>/img/amplop.png" width="20">
<?php
$sqljmlsurat="select count(id_disposisi) as jml from tbl_disposisi where ke = '$_SESSION[uname]' and tgl_baca is null and tgl_tindak_lanjut is null and status='0'";
//echo $sqljmlsurat;
$ekjml=pg_query($sqljmlsurat);
$rjml=pg_fetch_array($ekjml);

	//echo $sq;

?>
<span class="badge badge-neutral"><?php echo $rjml[jml];?></span>
</a>
<ul class="dropdown-menu pull-right">
<?php


	$sq="select a.*,b.* from tbl_sekertariat_disposisi a left join tbl_disposisi b on a.nomor_agenda=b.nomor_agenda  where b.ke ='$_SESSION[uname]' and b.tgl_baca is null and tgl_tindak_lanjut is null and status='0' order by b.id_disposisi desc";
	//$sq="select a.*,b.pengirim,c.* from tbl_sekertariat_disposisi a left join tbl_kode_pengirim b on a.pengirim=b.kode_pengirim left join tbl_disposisi c on a.nomor_agenda=c.nomor_agenda where c.ke='$_SESSION[uname]' and c.tgl_tindak_lanjut is null   order by a.id desc";
	//echo $sq;
	$eksq=pg_query($sq);
	while($rs=pg_fetch_array($eksq)){
?>
	<li style="width:500px;">
	<div class="media" style="width:500px;">
	<a class="pull-left" href="<?php echo $app;?>?detail=bacapesan&id=<?php echo $rs['nomor_agenda'];?>" data-toggle="tooltip" title="Newbie">
	<img src="<?php echo $app;?>/img/email.png" alt="fakeimg" class="img-circle">
	</a>
	<div class="media-body">
	<div class="media-heading clearfix"><span class="label label-success" style='font-size:10px;'><?php $datetime=$rs[tgl_kirim]; echo  $date = new Cokidoo_Datetime($datetime); ?></span><a href="<?php echo $app;?>?detail=bacapesan&id=<?php echo $rs['nomor_agenda'];?>"><?php if($rs['sifat']=="2"){echo "<b style='color:red;'>Segera</b>";}else{echo "Biasa";} ?></a></div>
	<div class="media" style="font-size:10px;"><?php echo $rs['dari'];?> Ke <?php echo $rs['ke'];?></div>
	<div class="media" style="font-size:10px;"><?php echo $rs['perihal'];?></div>
	</div>
	</div>
	</li>
	<li class="divider"></li>
<?php
	}
?>

<li class="divider-vertical" style="color:black;">Pusat Pesan</li>
</ul>

<?php

}
?>
<?php
}
?>
<li><ul class="navbar-nav-custom pull-left visible-xs visible-sm" id="mobile-nav">
<li>
<a href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-main-collapse">
<img src="<?php echo $app;?>/img/list.png" width="15">
</a>
</li>
<li class="divider-vertical"></li>
</ul></li>
<?php
	if($_SESSION['uname']=="DU"){
	

	

?>
	<li class="dropdown dropdown-notifications">
<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" title="Notifikasi">
<img src="<?php echo $app;?>/img/monitor.png" width="25">
	<?php
		$sqlnotif="select no_surat from tbl_notif2 where dari='DU' group by no_surat ";
		$eknotif=pg_query($sqlnotif);
		while($rnotif=pg_fetch_array($eknotif)){
			$sqlvalue="select a.*,b.* from tbl_notif2 a  left join tbl_sekertariat_disposisi b on a.no_surat=b.nomor_agenda where a.no_surat='$rnotif[no_surat]' and a.dari =='DU' and penindak_lanjut='' and a.ip='0'";
			//echo $sqlvalue;
			$count="select count(id) as jml from tbl_notif2 where no_surat='$rnotif[no_surat]' and dari !='DU' and penindak_lanjut='' and ip='0' ";
			//echo $count;
			$ekcount=pg_query($count);
			$rc=pg_fetch_array($ekcount);
			$tc=$rc[jml];
			//echo $tcr=$rc[jml];	
			//echo array_sum($tcr)or die("tes");
			$total=$total+$tc;
			//echo $total;
			//$tc=$tc+$tc;
			//echo $tc;
			if($tc==0){$rc="0";}else{
			$rc=count($tc);
			}
			
			
		}
		
		//print_r($total);
		
	?>
<span class="badge badge-neutral"><?php echo $total;?></span>
</a>
<ul class="dropdown-menu pull-right" style='width:500px;'>
<li>
	<?php
		$sqlnotif="select no_surat from tbl_notif2 where dari='DU' group by no_surat ";
		$eknotif=pg_query($sqlnotif);
		
		while($rnotif=pg_fetch_array($eknotif)){
			$sqlvalue=" select a.id as idnya,a.no_surat,a.dari,a.penindak_lanjut,a.tgl_tindak_lanjut,a.ip,a.catatan,b.* from tbl_notif2 a  left join tbl_sekertariat_disposisi b on a.no_surat=b.nomor_agenda where a.no_surat='$rnotif[no_surat]' and a.dari !='DU' and penindak_lanjut=''   and a.ip='0' ";
			//echo $sqlvalue;
			$count="select count(id) as jml from tbl_notif2 where no_surat='$rnotif[no_surat]' and dari =='DU' ";
			
			$ekval=pg_query($sqlvalue);
			
			while($rval=pg_fetch_array($ekval)){
	?>
		<div class="alert alert-danger" style='width:500px;	'>
		<i class="icon-bell-" style='width:500px;'><?php echo $no;?></i><a href="<?php echo $app;?>?detail=bacapesan7&id=<?php echo $rval['nomor_agenda'];?>&idnya=<?php echo $rval['idnya']; ?>&ke=<?php echo $rval['dari'];?>">  Aktivitas Disposisi Dengan Perihal <?php echo $rval['perihal'];?> Dengan Catatan '<?php echo $rval['catatan'];?>' Oleh <?php echo $rval['dari'];?> </a>
		</div>
	<?php
			
			}
		}
	?>
<li class="divider"></li>

</ul>
</li>

<?php
	}
?>



<?php
}
?>



<li class="dropdown dropdown-notifications">
<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" title="Batas Waktu">
<img src="<?php echo $app;?>/img/warning.png" width="25">
	<?php
		$datenow=date("Y-m-d");
		$sqljmlalert="select count(a.id_disposisi) as jml,b.bts_tindak_lanjut from tbl_disposisi a left join tbl_sekertariat_disposisi b on a.nomor_agenda=b.nomor_agenda 
		where a.tgl_tindak_lanjut is null and b.bts_tindak_lanjut >'$datenow'::date and a.ke='$ke' group by a.id_disposisi,b.bts_tindak_lanjut";
		//echo $sqljmlalert;
		$eksjmlalert=pg_query($sqljmlalert);
		$rjmlalert=pg_fetch_array($eksjmlalert);
		$tjmlalert=pg_num_rows($eksjmlalert);
		//echo $tjmlalert;	
		//echo $tjmlalert['jml']."tesstingg";
	?>
<span class="badge badge-neutral"><?php echo $tjmlalert; /*$rjmlalert['jml']*/;?></span>
</a>
<ul class="dropdown-menu pull-right" style="width:500px;">
<li>
	<?php
		$sqllist="select a.*,b.bts_tindak_lanjut from tbl_disposisi a left join 
		tbl_sekertariat_disposisi b on a.nomor_agenda=b.nomor_agenda where a.tgl_tindak_lanjut is null and b.bts_tindak_lanjut >'$datenow'::date and a.ke='$ke'";
		//echo $sqllist;
		$eklist=pg_query($sqllist);
		while($rlist=pg_fetch_array($eklist)){
	?>
<div class="alert alert-danger" style="width:500px;">
<i class="icon-bell-"></i> <strong>Batas Waktu Disposisi Hampir Habis</strong> <a href="<?php echo $app;?>?detail=bacapesan&id=<?php echo $rlist['nomor_agenda'];?>"><?php echo $rlist['nomor_agenda'];?></a>
</div>
	<?php
		}
	?>
<li class="divider"></li>

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
