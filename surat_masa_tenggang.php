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
<th>Tanggal</th>
<th>Jam</th>
<th> Perihal</th>
<th> Pengirim Surat </th>
<th> Dari </th>
<th>Batas Tindak Lanjut</th>

</tr>
	</thead>
	<tbody>
		<?php
			
			$tgl=date("Y-m-d");
				//$sql="select a.nomor_agenda,a.dari,a.tgl_tindak_lanjut,b.nomor_agenda,b.perihal,b.pengirim_surat,b.tgl_terima,c.bts_tindak_lanjut from tbl_disposisi a left join tbl_sekertariat_disposisi b on a.nomor_agenda=b.nomor_agenda left join tbl_sekertariat_disposisi c on a.nomor_agenda=c.nomor_agenda where a.tgl_tindak_lanjut is null and a.ke='$_SESSION[uname]'  group by a.nomor_agenda,a.dari,a.tgl_tindak_lanjut,b.nomor_agenda,b.perihal,b.pengirim_surat,b.tgl_terima,c.bts_tindak_lanjut ";
				//echo $sql;
				$sql="select a.nomor_agenda,a.dari,a.tgl_tindak_lanjut,b.nomor_agenda,b.perihal,b.pengirim_surat,b.tgl_terima,c.bts_tindak_lanjut from tbl_disposisi a left join tbl_sekertariat_disposisi b on a.nomor_agenda=b.nomor_agenda left join tbl_sekertariat_disposisi c on a.nomor_agenda=c.nomor_agenda where a.tgl_tindak_lanjut is null and a.ke='$_SESSION[uname]' order by b.tgl_terima desc";
				$eksql=pg_query($sql)or die($sql);
				while($rs=pg_fetch_array($eksql)){
				
			
	?>
<tr>
<td class="text-center hidden-xs hidden-sm"><?php echo $nos;?></td>
<td><a href="<?php echo $app;?>?detail=bacapesan&id=<?php echo $rs['nomor_agenda'];?>"><?php echo substr($rs['tgl_terima'],8,2)."-".substr($rs['tgl_terima'],5,2)."-".substr($rs['tgl_terima'],0,4); ?></a></td>
<td><?php echo substr($rs['tgl_terima'],10,8);?></td>
<td><?php echo $rs['perihal'];?></td>
<td><?php echo $rs['pengirim_surat'];?></td>
<td><a href="<?php  echo $app;?>?disdetail=disposisidetail&id=<?php echo $rs[dari];?>&no=<?php echo $rs['nomor_agenda'];?>"><?php echo $rs['dari'];?></a></td>
<td><?php echo substr($rs['bts_tindak_lanjut'],8,2)."-".substr($rs['bts_tindak_lanjut'],5,2)."-".substr($rs['bts_tindak_lanjut'],0,4);?></td>
</tr>
	
<?php
	}
		
?>
			

			</tbody>
</table>
			
		</div>
	</body>
</html>