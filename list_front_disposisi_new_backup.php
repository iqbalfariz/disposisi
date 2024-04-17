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
<th style="text-align:center;" ></th>
<th style="text-align:center;" >No.Agenda</th>
<th style="text-align:center;">Tanggal Tindak Lanjut</th>

<th style="text-align:center;" class="">Pengirim</th>
<th style="text-align:center;" class="hidden-xs hidden-sm">Dari</th>
<th style="text-align:center;" class="">Perihal</th>
<th style="text-align:center;" class="">Status</th>
<th style="text-align:center;" class="">Download</th>

</tr>
	</thead>
	<tbody>
		<?php
	$page="limit 10";
	
		//$sql="select a.nomor_agenda,a.dari,b.sifat,b.jenis,b.tgl_surat,b.kategori,b.perihal,b.pengirim,c.pengirim from tbl_disposisi a left join tbl_sekertariat_disposisi b on a.nomor_agenda=b.nomor_agenda left join tbl_kode_pengirim c on b.pengirim=c.kode_pengirim where a.dari='$_SESSION[uname]'  group by a.nomor_agenda,a.dari,b.sifat,b.jenis,b.tgl_surat,b.kategori,b.perihal,b.pengirim,c.pengirim order by id desc ";
		//echo $sql;
	//terakhir 	//$sql=" select a.nomor_agenda,a.dari,b.sifat,b.jenis,b.tgl_surat,b.kategori,b.perihal,b.pengirim,b.tgl_terima,c.pengirim from tbl_disposisi a left join tbl_sekertariat_disposisi b on a.nomor_agenda=b.nomor_agenda left join tbl_kode_pengirim c on b.pengirim=c.kode_pengirim where a.dari='$_SESSION[uname]' and a.tgl_tindak_lanjut is not null and a.tgl_baca is not null order by b.tgl_terima desc";
	//terakhir 12/17/14	// $sql=" select a.nomor_agenda,a.dari,a.tgl_tindak_lanjut,b.sifat,b.jenis,b.tgl_surat,b.kategori,b.perihal,b.pengirim,b.tgl_terima,c.pengirim from tbl_disposisi a left join tbl_sekertariat_disposisi b on a.nomor_agenda=b.nomor_agenda left join tbl_kode_pengirim c on b.pengirim=c.kode_pengirim where a.dari='$_SESSION[uname]' and a.tgl_tindak_lanjut is not null and a.tgl_baca is not null order by a.tgl_tindak_lanjut desc";
		
	$sql=" select a.id_disposisi,a.nomor_agenda,a.dari,a.tgl_tindak_lanjut,b.sifat,b.jenis,b.tgl_surat,b.kategori,b.perihal,b.pengirim,b.tgl_terima,c.pengirim from tbl_disposisi a left join tbl_sekertariat_disposisi b on a.nomor_agenda=b.nomor_agenda left join tbl_kode_pengirim c on b.pengirim=c.kode_pengirim where a.dari='$_SESSION[uname]' order by a.id_disposisi desc";
		
		//$sql="select a.*,b.pengirim,c.* from tbl_sekertariat_disposisi a left join tbl_kode_pengirim b on a.pengirim=b.kode_pengirim left join tbl_disposisi c on a.nomor_agenda=c.nomor_agenda where c.dari='$_SESSION[uname]' and a.nomor_agenda like '$_POST[cari]%'    order by a.nomor_agenda desc $page ";
		//echo $sql;
		$eks=pg_query($sql);
				$no=1;
		while($rs=pg_fetch_array($eks)){
			$sqlgetstatus="select * from tbl_disposisi where nomor_agenda='".$rs[nomor_agenda]."' order by id_disposisi desc limit 1";
			$ekgetst=pg_query($sqlgetstatus);
			$rsg=pg_fetch_array($ekgetst);
	?>
<tr>
<td></td>
<td class="text-center hidden-xs hidden-sm" ><a href="<?php  echo $app;?>?disdetail=disposisidetail&id=<?php echo $rs[dari];?>&no=<?php echo $rs['nomor_agenda'];?>"><?php echo $rs['nomor_agenda'];?></a></td>
<td><?php echo substr($rs['tgl_tindak_lanjut'],8,2)."-".substr($rs['tgl_tindak_lanjut'],5,2)."-".substr($rs['tgl_tindak_lanjut'],0,4);?> &nbsp; <?php echo substr($rs['tgl_tindak_lanjut'],11,2).":".substr($rs['tgl_tindak_lanjut'],14,2).":".substr($rs['tgl_tindak_lanjut'],17,2);?> </td>
<td class="hidden-xs hidden-sm"><?php echo $rs['pengirim'];?></td>
<td ><?php echo $rs['dari'];?></a></td>
<td ><?php echo $rs['perihal'];?></td>
<td ><span class="label label-<?php if($rsg['status']=="1"){echo "info";}else{echo "danger";} ?>"><?php  if($rsg['status']=="1"){echo "Done,".$rsg['dari'];}else{echo "On Progres,".$rsg['ke']; echo "</br>&nbsp;("; if($rsg['tgl_baca']==""){echo "Unread";}else{echo "Read";} echo ")"; if($rsg['tgl_tindak_lanjut']==""){echo "Undisposisi";} }?></span></td>
<td style="text-align:center;"><a href="<?php echo $app;?>?detail=list_file&id=<?php echo $rs['nomor_agenda'];?>"><img src="img/file_download.png" width="20"></a></td>

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