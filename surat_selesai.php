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

</tr>
	</thead>
	<tbody>
		<?php
			$sqlcek="select nomor_agenda from tbl_disposisi where dari='$_SESSION[uname]' group by nomor_agenda";
			$ekcek=pg_query($sqlcek);
			$no=1;
			while($rcek=pg_fetch_array($ekcek)){
			
				$sql="select a.nomor_agenda,a.dari,b.nomor_agenda,b.perihal,b.pengirim_surat,b.tgl_terima from tbl_disposisi a left join tbl_sekertariat_disposisi b on a.nomor_agenda=b.nomor_agenda where a.tgl_tindak_lanjut is not null and a.dari!='Sekertariat' and a.nomor_agenda='$rcek[nomor_agenda]'  group by a.nomor_agenda,a.dari,b.nomor_agenda,b.perihal,b.pengirim_surat,b.tgl_terima
				";
				
				//echo $sql;
				
			
				$rs=pg_fetch_array(pg_query($sql));
				if(!empty($rs['nomor_agenda'])){
			
			
	?>
<tr>
<td class="text-center hidden-xs hidden-sm"><?php echo $nos;?></td>

<td><a href="<?php echo $app;?>?detail=list_file&id=<?php echo $rs['nomor_agenda'];?>"><?php echo substr($rs['tgl_terima'],8,2)."-".substr($rs['tgl_terima'],5,2)."-".substr($rs['tgl_terima'],0,4);?></a></td>
<td><?php echo substr($rs['tgl_terima'],10,8);?></td>
<td><?php echo $rs['perihal'];?></td>
<td><?php echo $rs['pengirim_surat'];?></td>
<td><a href="<?php  echo $app;?>?disdetail=disposisidetail&id=<?php echo $rs[dari];?>&no=<?php echo $rs['nomor_agenda'];?>"><?php echo $rs['dari'];?></a></td>

</tr>
	
<?php
	}
		$no++;
		}
?>
			

			</tbody>
</table>
			
		</div>
	</body>
</html>