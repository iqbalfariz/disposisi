<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<?php
		//	include "header.php";
		//$app="http://127.0.0.1/aplikasi_surat";
	//	include "inc/conn.php";
		?>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<title>DataTables example</title>
		



<link rel="stylesheet" type="text/css" href="<?php echo $app;?>/css/paging.css">
		<script type="text/javascript" charset="utf-8" language="javascript" src="jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8" language="javascript" src="DT_bootstrap.js"></script>
	</head>
	<body>
		
			
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="example-table">
	<thead>
		<tr>
<th class="text-center hidden-xs hidden-sm">#</th>
<th> Nomer Agenda</th>
<th class="hidden-xs hidden-sm"> Sifat</th>
<!--<th class="hidden-xs hidden-sm">Jenis</th>-->
<th class="hidden-xs hidden-sm">Kategori</th>
<th >Perihal</th>
<!--<th class="hidden-xs hidden-sm">Kode Odner</th>-->
<th >Pengirim Surat</th>
<th class="hidden-xs hidden-sm">Dari</th>
<!--<th class="hidden-xs hidden-sm">Status</th>-->
<th class="hidden-xs hidden-sm">Catatan</th>
<!--<th class="text-center"><img src="<?php echo $app;?>/img/nav.png" style="width:15px;height:15px;"></th>-->
</tr>

	</thead>
	<tbody>
		<?php
		//backup_surat_masuk_tapi_Belum_dibaca//$sql="select a.*,b.pengirim,c.* from tbl_sekertariat_disposisi a left join tbl_kode_pengirim b on a.pengirim=b.kode_pengirim left join tbl_disposisi c on a.nomor_agenda=c.nomor_agenda where c.tgl_baca is not null and c.tgl_tindak_lanjut is null and c.ke='$_SESSION[uname]'  and c.status='3'   order by a.nomor_agenda desc limit $limit offset $limitvalue ";
		
		$sql="select a.*,b.pengirim,c.* from tbl_sekertariat_disposisi a left join tbl_kode_pengirim b on a.pengirim=b.kode_pengirim left join tbl_disposisi c on a.nomor_agenda=c.nomor_agenda where c.ke='$_SESSION[uname]' and c.tgl_tindak_lanjut is null   order by a.id desc ";
		
		//echo $sql;
		$eks=pg_query($sql)or die($eks);
				$nom=1;
		while($rs=pg_fetch_array($eks)){
			



	?>

<tr>
<td class="text-center hidden-xs hidden-sm"><?php //echo $nom;?></td>
<?php
	if($rs['tgl_tindak_lanjut']!="" and $rs['tgl_tindak_lanjut']!="0"){
?>
<td><a href=""><?php echo $rs['nomor_agenda'];?></a></td>
<td class="hidden-xs hidden-sm"><?php if($rs['sifat']=="1"){echo "Biasa";}else{echo "Segera";}?></td>

<td class="hidden-xs hidden-sm"><?php if($rs['kategori']=="1"){echo "Ext";}else{echo "Int";}?></td>
<td class="hidden-xs hidden-sm"><?php echo $rs['perihal'];?></td>
<td ><?php echo $rs['pengirim_surat'];?></td>
<td class="hidden-xs hidden-sm"><?php echo $rs['dari'];?></td>

<td class="hidden-xs hidden-sm"><?php echo $rs['catatan'];?></td>
<?php
}elseif($rs['tgl_baca']!="" and $rs['tgl_tindak_lanjut']==""){
?>
<td width="15%"><b><a style="color:black;" href="<?php echo $app;?>?detail=bacapesan&id=<?php echo $rs['nomor_agenda'];?>"><?php echo $rs['nomor_agenda'];?></a></b></td>
<td class="hidden-xs hidden-sm"><?php if($rs['sifat']=="1"){echo "Biasa";}else{echo "Segera";}?></td>

<td class="hidden-xs hidden-sm"><?php if($rs['kategori']=="1"){echo "Ext";}else{echo "Int";}?></td>
<td class="hidden-xs hidden-sm"><?php echo $rs['perihal'];?></td>
<td  ><?php echo $rs['pengirim_surat'];?></td>

<td class="hidden-xs hidden-sm"><?php echo $rs['ke'];?></td>

<td class="hidden-xs hidden-sm"><?php echo $rs['catatan'];?></td>
<?php
}else{
?>
<td><b><a  href="<?php echo $app;?>?detail=bacapesan&id=<?php echo $rs['nomor_agenda'];?>"><?php echo $rs['nomor_agenda'];?></a></b></td>

<td  class="hidden-xs hidden-sm"><b><?php if($rs['sifat']=="1"){echo "Biasa";}else{echo "Segera";}?></b></td>

<td class="hidden-xs hidden-sm"><b><?php if($rs['kategori']=="1"){echo "Ext";}else{echo "Int";}?></b></td>
<td class="hidden-xs hidden-sm"><b><?php echo $rs['perihal'];?></b></td>
<td ><b><?php echo $rs['pengirim_surat'];?></b></td>

<td class="hidden-xs hidden-sm"><b><?php echo $rs['dari'];?></b></td>

<td class="hidden-xs hidden-sm"><b><?php echo $rs['catatan'];?></b></td>
<?php
}
?>

<!--<td class="text-center">
<div class="btn-group">
<a href="javascript:void(0)" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-success"><img src="<?php echo $app;?>/img/ed.png" style="width:15px;height:15px;"></a>
<a href="javascript:void(0)" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger"><img src="<?php echo $app;?>/img/del.png" style="width:15px;height:15px;"></a>
</div>
</td>-->
</tr>
<?php
	
	$nom++;
}
?>
		

			</tbody>
</table>
			
		</div>
	</body>
</html>
