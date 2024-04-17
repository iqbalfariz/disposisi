<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<?php
		//	include "header.php";
		$app="http://localhost/aplikasi_surat";
		include "inc/conn.php";
		?>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<title>DataTables example</title>
		
		<link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/favicon.ico" />
		<link rel="stylesheet" href="<?php echo $app;?>/css/font.css">
<link rel="stylesheet" href="<?php echo $app;?>/css/bootstrap-1.4.css">
<link rel="stylesheet" href="<?php echo $app;?>/css/plugins-1.4.css">
<link rel="stylesheet" href="<?php echo $app;?>/css/main-1.4.css">
<link rel="stylesheet" href="<?php echo $app;?>/css/themes-1.4.css">
<script src="<?php echo $app;?>/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="DT_bootstrap.css">
		<script src="<?php echo $app;?>/js/bootstrap.min.js"></script>
<script src="<?php echo $app;?>/js/plugins-1.4.js"></script>
<script src="<?php echo $app;?>/js/main-1.4.js"></script><script src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script src="<?php echo $app;?>/js/gmaps.min.js"></script>
		<script type="text/javascript" charset="utf-8" language="javascript" src="jquery.js"></script>
		<script type="text/javascript" charset="utf-8" language="javascript" src="jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8" language="javascript" src="DT_bootstrap.js"></script>
	</head>
	<body>
		<div class="container" style="margin-top: 10px">
			
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="example-table">
	<thead>
		<tr style="color:#black;background-color:#2980B9;">
			<th style="color:#fff;background-color:#2980B9; ">#</th>
			<th style="color:#fff;background-color:#2980B9; ">Nomor Agenda</th>
			<th style="color:#fff"> Sifat</th>
<th style="color:#fff">Jenis</th>
<th style="color:#fff">Kategori</th>
<th style="color:#fff">Tgl Penerima</th>
<th style="color:#fff">Pengirim</th>
<th style="color:#fff">Pengirim Surat</th>
<th style="color:#fff">Ditujukan Ke</th>
<th style="color:#fff">Status</th>
		</tr>

	</thead>
	<tbody>
		<?php
			$sql="select a.*,b.pengirim from tbl_sekertariat_disposisi a left join tbl_kode_pengirim b on a.pengirim=b.kode_pengirim order by a.id desc ";
			$eks=pg_query($sql);
			while($rs=pg_fetch_array($eks)){
				$sqlgetstatus="select * from tbl_disposisi where nomor_agenda='".$rs[nomor_agenda]."' order by id_disposisi desc limit 1";
			//echo $sqlgetstatus;
			$ekgetst=pg_query($sqlgetstatus);
			$rsg=pg_fetch_array($ekgetst);
		?>
		<tr class="odd gradeX">
			<td class="center"></td>
			<td><?php echo $rs['nomor_agenda'];?></td>
			<td><?php if($rs['sifat']=="1"){echo "Biasa";}else{echo "Segera";}?></td>
				<td><?php if($rs['jenis']=="1"){echo "Asli";}elseif($rs['jenis']=="2"){echo "Copy";}else{echo "Tembusan";}?></td>
				<td class="center"> <?php if($rs['kategori']=="1"){echo "Eksternal";}else{echo "Internal";}?></td>
				<td class="center"><?php echo substr($rs['tgl_terima'],8,2)."-".substr($rs['tgl_terima'],5,2)."-".substr($rs['tgl_terima'],0,4);?></td>
				<td class="center"><?php echo $rs['pengirim'];?></td>

					<?php
				$array = array($rs[ke]);
$comma_separated = "'".implode("','", $array)."'";
//echo $comma_separated;
			?>
				<td class="center"><a href='<?php echo $app;?>?disdetail=disposisidetail&id=<?php echo $rs[ke];?>&no=<?php echo $rs[nomor_agenda];?>'><?php echo $rs['ke'];?></a></td>
				<td class="center"><?php  if($rsg['status']=="1"){echo "Done,".$rsg['dari'];}else{echo "On Progres,".$rsg['ke']; echo "&nbsp;("; if($rsg['tgl_baca']==""){echo "Unread";}else{echo "Read";} echo ")"; if($rsg['tgl_tindak_lanjut']==""){echo "Undisposisi";} }?></td>
				<td class="center"><?php echo $rs['pengirim_surat'];?></td>


		</tr>
		<?php
			}
		?>
		

			</tbody>
</table>
			
		</div>
	</body>
</html>