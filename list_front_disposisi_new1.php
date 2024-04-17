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
	<form action="" method="POST">
		<div class="row"><div class="span6">
		
			<div class="dataTables_length" id="example-table_length">
				<label>
					<select name="bln" aria-controls="example-table"  class="form-control	">
						<option>Bulan</option>
						
						<?php
							$bl1=array('01','02','03','04','05','06','07','08','09','10','11','12');
							$bl2=array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
							for($a=0;$a<=12;$a++){
								if($_POST['bln']==""){
									if($bl1[$a]==date('m')){
										$selected="selected";
									}else{
										$selected="";
									}
								}elseif($_POST['bln']==$bl1[$a]){
									$selected="selected";
								}else{
									$selected="";
								}
									echo "<option value='$bl1[$a]' $selected>$bl2[$a]</option>";
							}
						?>
						<!--<option value="01">Januari</option>
						<option value="02">Februari</option>
						<option value="03">Maret</option>
						<option value="04">April</option>
						<option value="05">Mai</option>
						<option value="06">Juni</option>
						<option value="07">Juli</option>
						<option value="08">Agustus</option>
						<option value="09">September</option>
						<option value="10">Oktober</option>
						<option value="11">November</option>
						<option value="12">Desember</option>-->
						
					</select>
				</label>
				<label>
					<select name="thn" aria-controls="example-table" class="form-control	">
						<option  >Tahun</option>
						<?php
							$tahunskrang=date('Y');
							$tahunnanti=$tahunskrang+5;
							$tahunsebelum=$tahunskrang-5;
							for($a=$tahunsebelum;$a<$tahunnanti;$a++){
							
								if($_POST['thn']==""){
									if($a==date('Y')){
										$selected="selected";
									}else{
										$selected="";
									}
								}elseif($_POST['thn']==$a){
									$selected="selected";
								}else{
									$selected="";
								}
									echo "<option value='$a' $selected>$a</option>";
							}
						?>
						
					</select>
				</label>

			</div>

		</div>

		<div class="span6">
			<div id="example-table_filter" class="dataTables_filter">
				<label>
					<!-- <input type="search" placeholder="Pencarian..." class="form-control" aria-controls="example-table"> -->
				</label>
					<label><input type="submit" class="btn btn-success" name="go" value="Go"></label>
			</div>
		</div>
	</form>
	
			
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" >
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
	$tahun=date('Y');
	$bulan=date('m');
		$sql="select a.nomor_agenda,a.dari,b.sifat,b.jenis,b.tgl_surat,b.kategori,b.perihal,b.pengirim,c.pengirim from tbl_disposisi a left join tbl_sekertariat_disposisi b on a.nomor_agenda=b.nomor_agenda left join tbl_kode_pengirim c on b.pengirim=c.kode_pengirim where a.dari='$_SESSION[uname]'  group by a.nomor_agenda,a.dari,b.sifat,b.jenis,b.tgl_surat,b.kategori,b.perihal,b.pengirim,c.pengirim order by id desc ";
		//echo $sql;
	//terakhir 	//$sql=" select a.nomor_agenda,a.dari,b.sifat,b.jenis,b.tgl_surat,b.kategori,b.perihal,b.pengirim,b.tgl_terima,c.pengirim from tbl_disposisi a left join tbl_sekertariat_disposisi b on a.nomor_agenda=b.nomor_agenda left join tbl_kode_pengirim c on b.pengirim=c.kode_pengirim where a.dari='$_SESSION[uname]' and a.tgl_tindak_lanjut is not null and a.tgl_baca is not null order by b.tgl_terima desc";
	//terakhir 12/17/14	// $sql=" select a.nomor_agenda,a.dari,a.tgl_tindak_lanjut,b.sifat,b.jenis,b.tgl_surat,b.kategori,b.perihal,b.pengirim,b.tgl_terima,c.pengirim from tbl_disposisi a left join tbl_sekertariat_disposisi b on a.nomor_agenda=b.nomor_agenda left join tbl_kode_pengirim c on b.pengirim=c.kode_pengirim where a.dari='$_SESSION[uname]' and a.tgl_tindak_lanjut is not null and a.tgl_baca is not null order by a.tgl_tindak_lanjut desc";
	if(isset($_POST['go'])){
		//echo "tess";
		//$sql1="select nomor_agenda,tgl_kirim from tbl_disposisi where dari='$_SESSION[uname]' and tgl_kirim is not null and date_part('YEAR',tgl_tindak_lanjut)='$_POST[thn]' and date_part('MONTH',tgl_tindak_lanjut)='$_POST[bln]' group by nomor_agenda,tgl_kirim order by tgl_kirim desc ";
		$sql1="select nomor_agenda,tgl_kirim from tbl_disposisi where dari='$_SESSION[uname]' and tgl_kirim is not null and date_part('YEAR',tgl_kirim)='$_POST[thn]' and date_part('MONTH',tgl_kirim)='$_POST[bln]' group by nomor_agenda,tgl_kirim order by tgl_kirim desc ";	

	}else{
		//$sql1="select nomor_agenda,tgl_kirim from tbl_disposisi where dari='$_SESSION[uname]' and tgl_kirim is not null and date_part('YEAR',tgl_tindak_lanjut)='$tahun' and date_part('MONTH',tgl_tindak_lanjut)='$bulan' group by nomor_agenda,tgl_kirim order by tgl_kirim desc ";
		$sql1="select nomor_agenda,tgl_kirim from tbl_disposisi where dari='$_SESSION[uname]' and tgl_kirim is not null and date_part('YEAR',tgl_kirim)='$tahun' and date_part('MONTH',tgl_kirim)='$bulan' group by nomor_agenda,tgl_kirim order by tgl_kirim desc ";
	
	}
	//$sql1="select nomor_agenda,tgl_kirim from tbl_disposisi where dari='$_SESSION[uname]' and tgl_kirim is not null group by nomor_agenda,tgl_kirim order by tgl_kirim desc ";
	//$sql1="select nomor_agenda,tgl_tindak_lanjut from tbl_disposisi where dari='$_SESSION[uname]' and tgl_tindak_lanjut is not null group by nomor_agenda,tgl_tindak_lanjut order by tgl_tindak_lanjut desc";
	//echo $sql1;
	$ek1=pg_query($sql1);
	while($r1=pg_fetch_array($ek1)){
		$sql=" select a.id_disposisi,a.nomor_agenda,a.dari,a.tgl_tindak_lanjut,a.tgl_kirim,b.sifat,b.jenis,b.tgl_surat,b.kategori,b.perihal,b.pengirim,b.tgl_terima,c.pengirim from tbl_disposisi a left join tbl_sekertariat_disposisi b on a.nomor_agenda=b.nomor_agenda left join tbl_kode_pengirim c on b.pengirim=c.kode_pengirim where a.dari='$_SESSION[uname]' and a.nomor_agenda='$r1[nomor_agenda]' order by a.id_disposisi desc";
		//echo $sql;
		$eks=pg_query($sql);
		$rs=pg_fetch_array($eks);
		$sqlgetstatus="select * from tbl_disposisi where nomor_agenda='".$rs[nomor_agenda]."' order by id_disposisi desc limit 1";
		//echo $sqlgetstatus;
			$ekgetst=pg_query($sqlgetstatus);
			$rsg=pg_fetch_array($ekgetst);
	?>
		
		<tr>
			<td></td>
			<td class="text-center hidden-xs hidden-sm" ><a href="<?php  echo $app;?>?disdetail=disposisidetail&id=<?php echo $rs[dari];?>&no=<?php echo $rs['nomor_agenda'];?>"><?php echo $rs['nomor_agenda'];?></a></td>
			<td><?php echo substr($rs['tgl_kirim'],8,2)."-".substr($rs['tgl_kirim'],5,2)."-".substr($rs['tgl_kirim'],0,4);?> &nbsp; <?php echo substr($rs['tgl_kirim'],11,2).":".substr($rs['tgl_kirim'],14,2).":".substr($rs['tgl_kirim'],17,2);?> </td>
			<td class="hidden-xs hidden-sm"><?php echo $rs['pengirim'];?></td>
			<td ><?php echo $rs['dari'];?></a></td>
			<td ><?php echo $rs['perihal'];?></td>
			<td ><span class="label label-<?php if($rsg['status']=="1"){echo "info";}else{echo "danger";} ?>"><?php  if($rsg['status']=="1"){echo "Done,".$rsg['dari'];}else{echo "On Progres,".$rsg['ke']; echo "</br>&nbsp;("; if($rsg['tgl_baca']==""){echo "Unread";}else{echo "Read";} echo ")"; if($rsg['tgl_tindak_lanjut']==""){echo "Undisposisi";} }?></span></td>
			<td style="text-align:center;"><a href="<?php echo $app;?>?detail=list_file&id=<?php echo $rs['nomor_agenda'];?>"><img src="img/file_download.png" width="20"></a></td>

</tr>			
	<?php
	}	
		?>

			

			</tbody>
</table>
			
		</div>
	</body>
</html>
