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
		
			
<table cellpadding="0" cellspacing="0" align="center" border="0" class="table table-bordered table-hover" id="example-table">
	<thead>
		<tr align="center">
<th style="text-align:center;" class=""></th>
<th style="text-align:center;">Tanggal</th>
<th style="text-align:center;">Jam</th>
<th style="text-align:center;" class="hidden-xs hidden-sm"> Sifat</th>
<!--<th class="hidden-xs hidden-sm">Jenis</th>-->
<th style="text-align:center;" class="hidden-xs hidden-sm">Kategori</th>
<th style="text-align:center;" >Perihal</th>
<!--<th class="hidden-xs hidden-sm">Kode Odner</th>-->
<th class="hidden-xs hidden-sm" style="text-align:center;" >Pengirim Surat</th>
<th style="text-align:center;" class="hidden-xs hidden-sm">Dari</th>
<!--<th class="hidden-xs hidden-sm">Status</th>-->
<th style="text-align:center;" class="hidden-xs hidden-sm">Catatan</th>
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

<?php


	if($rs['tgl_tindak_lanjut']!="" and $rs['tgl_tindak_lanjut']!="0"){
?>
<td class="text-center hidden-xs hidden-sm"><?php //echo $nom;?>tes</td>
<td><a href=""><?php echo $rs['nomor_agenda'];?></a></td>
<td><?php echo $rs['tgl_terima'];?></td>
<td class="hidden-xs hidden-sm"><?php if($rs['sifat']=="1"){echo "Biasa";}else{echo "Segera";}?></td>

<td class="hidden-xs hidden-sm"><?php if($rs['kategori']=="1"){echo "Ext";}else{echo "Int";}?></td>
<td class="hidden-xs hidden-sm"><?php echo $rs['perihal'];?></td>
<td ><?php echo $rs['pengirim_surat'];?></td>
<td class="hidden-xs hidden-sm"><?php echo $rs['dari'];?></td>

<td class="hidden-xs hidden-sm"><?php echo $rs['catatan'];?></td>
<?php
}elseif($rs['tgl_baca']!="" and $rs['tgl_tindak_lanjut']==""){

?>
<td class=""><?php //echo $nom;?><?php //echo $nom;?><a style="color:black;" href="<?php echo $app;?>?detail=bacapesan&id=<?php echo $rs['nomor_agenda'];?>"><img src="img/open_email2.png" width="25"></a></td>
<td width="10%"><?php echo substr($rs['tgl_terima'],8,2)."-".substr($rs['tgl_terima'],5,2)."-".substr($rs['tgl_terima'],0,4);?></td>
<td><?php echo substr($rs['tgl_terima'],10,8);?></td>
<td class="hidden-xs hidden-sm"><?php if($rs['sifat']=="1"){echo "Biasa";}else{echo "Segera";}?></td>

<td class="hidden-xs hidden-sm"><?php if($rs['kategori']=="1"){echo "Ext";}else{echo "Int";}?></td>
<td class="hidden-xs hidden-sm"><?php echo $rs['perihal'];?></td>
<td  ><?php echo $rs['pengirim_surat'];?></td>

<td class="hidden-xs hidden-sm"><?php echo $rs['dari'];?></td>

<td class="hidden-xs hidden-sm"><?php echo $rs['catatan'];?></td>
<?php
}elseif($rs['tgl_baca']=="" and $rs['tgl_tindak_lanjut']=="" and $rs['status_srt']=="1" ){
?>
<td style="background-color:#61e2b6" class=""><?php //echo $nom;?><a  href="<?php echo $app;?>?detail=bacapesan7&id=<?php echo $rs['nomor_agenda'];?>&ke=<?php echo $rs['dari'];?>"><img src="img/close_email3.png" width="30"></a></td>
<td style="background-color:#61e2b6"><b><?php echo substr($rs['tgl_terima'],8,2)."-".substr($rs['tgl_terima'],5,2)."-".substr($rs['tgl_terima'],0,4);?></b></td>
<td style="background-color:#61e2b6"><b><?php echo substr($rs['tgl_terima'],10,8);?></b></td>

<td style="background-color:#61e2b6"  class="hidden-xs hidden-sm"><b><?php if($rs['sifat']=="1"){echo "Biasa";}else{echo "Segera";}?></b></td>

<td style="background-color:#61e2b6" class="hidden-xs hidden-sm"><b><?php if($rs['kategori']=="1"){echo "Ext";}else{echo "Int";}?></b></td>
<td style="background-color:#61e2b6" class="hidden-xs hidden-sm"><b><?php echo $rs['perihal'];?></b></td>
<td style="background-color:#61e2b6" ><b><?php echo $rs['pengirim_surat'];?></b></td>

<td style="background-color:#61e2b6" class="hidden-xs hidden-sm"><b><?php echo $rs['dari'];?></b></td>

<td style="background-color:#61e2b6" class="hidden-xs hidden-sm"><b><?php echo $rs['catatan'];?></b></td>

<?php
}elseif($rs['tgl_baca']!="" and $rs['tgl_tindak_lanjut']!="" and $rs['status_srt']=="1" ){
?>
<td style="background-color:#61e2b6" class=""><?php //echo $nom;?><a  href="<?php echo $app;?>?detail=bacapesan&id=<?php echo $rs['nomor_agenda'];?>"><img src="img/open_email2.png" width="25"></a></td>
<td style="background-color:#61e2b6"><b><?php echo substr($rs['tgl_terima'],8,2)."-".substr($rs['tgl_terima'],5,2)."-".substr($rs['tgl_terima'],0,4);?></b></td>
<td style="background-color:#61e2b6"><b><?php echo substr($rs['tgl_terima'],10,8);?></b></td>

<td style="background-color:#61e2b6"  class="hidden-xs hidden-sm"><b><?php if($rs['sifat']=="1"){echo "Biasa";}else{echo "Segera";}?></b></td>

<td style="background-color:#61e2b6" class="hidden-xs hidden-sm"><b><?php if($rs['kategori']=="1"){echo "Ext";}else{echo "Int";}?></b></td>
<td style="background-color:#61e2b6" class="hidden-xs hidden-sm"><b><?php echo $rs['perihal'];?></b></td>
<td style="background-color:#61e2b6" ><b><?php echo $rs['pengirim_surat'];?></b></td>

<td style="background-color:#61e2b6" class="hidden-xs hidden-sm"><b><?php echo $rs['dari'];?></b></td>

<td style="background-color:#61e2b6" class="hidden-xs hidden-sm"><b><?php echo $rs['catatan'];?></b></td>


<?php
}elseif($rs['status_srt']!="1"){
?>
<td ><a  href="<?php echo $app;?>?detail=bacapesan&id=<?php echo $rs['nomor_agenda'];?>"><img src="img/close_email3.png" width="30"><?php if($rs['urgnt']=="1"){echo '<img src="img/alert.png" width="20">';}else{echo '';}?></a></td>
<td><b><?php echo substr($rs['tgl_terima'],8,2)."-".substr($rs['tgl_terima'],5,2)."-".substr($rs['tgl_terima'],0,4);?></b></td>
<td><b><?php echo substr($rs['tgl_terima'],10,8);?></b></td>

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
