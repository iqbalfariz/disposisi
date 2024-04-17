<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		
		
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
<th class="hidden-xs hidden-sm">Jenis</th>
<th class="hidden-xs hidden-sm">Kategori</th>
<th class="hidden-xs hidden-sm">Tgl Penerima</th>
<th class="hidden-xs hidden-sm">Pengirim</th>
<th class="hidden-xs hidden-sm">Dituju Ke</th>
<th class="hidden-xs hidden-sm">Status</th>
<!--<th class="hidden-xs hidden-sm">Catatan</th>-->
<!--<th class="text-center"><img src="<?php echo $app;?>/img/nav.png" style="width:15px;height:15px;"></th>-->
</tr>

	</thead>
	<tbody>
		<?php
		//backup_surat_masuk_tapi_Belum_dibaca//
	$sql="select a.*,b.pengirim,c.* from tbl_sekertariat_disposisi a left join tbl_kode_pengirim b on a.pengirim=b.kode_pengirim left join tbl_disposisi c on a.nomor_agenda=c.nomor_agenda where c.tgl_baca is not null and c.tgl_tindak_lanjut is null and c.ke='$_SESSION[uname]'  and c.status='3'   order by a.nomor_agenda desc  ";
		
	//	$sql="select a.*,b.pengirim,c.* from tbl_sekertariat_disposisi a left join tbl_kode_pengirim b on a.pengirim=b.kode_pengirim left join tbl_disposisi c on a.nomor_agenda=c.nomor_agenda where c.ke='$_SESSION[uname]'    order by a.nomor_agenda desc limit $limit offset $limitvalue ";
		
		//echo $sql;
		$eks=pg_query($sql)or die($sql);
		
		$no=1;
		while($rs=pg_fetch_array($eks)){
			



	?>


<tr>
<td class="text-center hidden-xs hidden-sm"><?php echo $no;?></td>
<!--<td><a href=""><?php echo $rs['nomor_agenda'];?></a></td>-->
<td><a href="<?php echo $app;?>?detail=bacapesan&id=<?php echo $rs['nomor_agenda'];?>"><?php echo $rs['nomor_agenda'];?></a></td>
<td class="hidden-xs hidden-sm"><?php if($rs['sifat']=="1"){echo "Biasa";}else{echo "Segera";}?></td>
<td class="hidden-xs hidden-sm"><?php if($rs['jenis']=="1"){echo "Asli";}elseif($rs['jenis']=="2"){echo "Copy";}else{echo "Tembusan";}?></td>
<td class="hidden-xs hidden-sm"><?php if($rs['kategori']=="1"){echo "Eksternal";}else{echo "Internal";}?></td>
<td class="hidden-xs hidden-sm"><?php echo substr($rs['tgl_terima'],8,2)."-".substr($rs['tgl_terima'],5,2)."-".substr($rs['tgl_terima'],0,4);?></td>
<td class="hidden-xs hidden-sm"><?php echo $rs['pengirim'];?></td>
<td class="hidden-xs hidden-sm"><?php echo $rs['ke'];?></td>
<td class="hidden-xs hidden-sm"><b><span class="label label-info"><?php if($rs['status']="3"){echo "Hanya Dibaca";}?></span></td>
<!--<td class="hidden-xs hidden-sm"><?php echo $rs['catatan'];?></td>-->

<!--<td class="text-center">
<div class="btn-group">
<a href="javascript:void(0)" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-success"><img src="<?php echo $app;?>/img/ed.png" style="width:15px;height:15px;"></a>
<a href="javascript:void(0)" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger"><img src="<?php echo $app;?>/img/del.png" style="width:15px;height:15px;"></a>
</div>
</td>-->
</tr>

<?php

		$no++;
		}
?>
			

			</tbody>
</table>
			
		</div>
	</body>
</html>
