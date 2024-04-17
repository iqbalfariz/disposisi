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
		
		<form action="" method="POST">
		<div class="row"><div class="span6">
		
			<div class="dataTables_length" id="example-table_length">
				<label>
					<select name="bln" aria-controls="example-table"  class="form-control	">
						<option  >Bulan</option>
						
						<?php
							$bl1=array('01','02','03','04','05','06','07','08','09','10','11','12');
							$bl2=array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
							for($a=0;$a<=12;$a++){
								if($_POST[bln]==$bl1[$a]){
									echo "<option value='$bl1[$a]' selected>$bl2[$a]</option>";
								}else{
									echo "<option value='$bl1[$a]'>$bl2[$a]</option>";
								}
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
							for($a=$tahunsebelum;$a<$tahunskrang;$a++){
								if($_POST[thn]==$a){
									echo "<option value='$a' selected>$a</option>";
								}else{
									echo "<option value='$a'>$a</option>";
								}
								
							}
							for($a=$tahunskrang;$a<=$tahunnanti;$a++){
								
								if($_POST[thn]==$a){
									echo "<option value='$a' selected>$a</option>";
								}else{
									echo "<option value='$a'>$a</option>";
								}
							}
						?>
						
					</select>
				</label>

			</div>

		</div>

		<div class="span6">
			<div id="example-table_filter" class="dataTables_filter">
				<label>
					<input type="search" placeholder="Pencarian..." class="form-control" aria-controls="example-table">
				</label>
					<label><input type="submit" class="btn btn-success" name="go" value="Go"></label>
			</div>
		</div>
	</form>
	
<table cellpadding="0" cellspacing="0" align="center" border="0" class="table table-bordered table-hover" >
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
		$year=date('Y');
		$month=date('m');
		//backup_surat_masuk_tapi_Belum_dibaca//$sql="select a.*,b.pengirim,c.* from tbl_sekertariat_disposisi a left join tbl_kode_pengirim b on a.pengirim=b.kode_pengirim left join tbl_disposisi c on a.nomor_agenda=c.nomor_agenda where c.tgl_baca is not null and c.tgl_tindak_lanjut is null and c.ke='$_SESSION[uname]'  and c.status='3'   order by a.nomor_agenda desc limit $limit offset $limitvalue ";
		
		if(isset($_POST[go])){
			$sql="select a.*,b.pengirim,c.* from tbl_sekertariat_disposisi a left join tbl_kode_pengirim b on a.pengirim=b.kode_pengirim left join tbl_disposisi c on a.nomor_agenda=c.nomor_agenda where c.ke='$_SESSION[uname]' and c.tgl_tindak_lanjut is null and date_part('Year',a.tgl_terima)='$_POST[thn]' and date_part('month',a.tgl_terima)='$_POST[bln]'   order by a.id desc limit 10 offset 1 ";
		}else{
			$sql="select a.*,b.pengirim,c.* from tbl_sekertariat_disposisi a left join tbl_kode_pengirim b on a.pengirim=b.kode_pengirim left join tbl_disposisi c on a.nomor_agenda=c.nomor_agenda where c.ke='$_SESSION[uname]' and c.tgl_tindak_lanjut is null and date_part('Year',a.tgl_terima)='$year' and date_part('month',a.tgl_terima)='$month'    order by a.id desc  ";
		}
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
