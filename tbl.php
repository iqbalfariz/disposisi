<link rel="stylesheet" href="http://disposisi.hutamakarya.com/css/font.css">
<link rel="stylesheet" href="http://disposisi.hutamakarya.com/css/bootstrap-1.4.css">
<link rel="stylesheet" href="http://disposisi.hutamakarya.com/css/plugins-1.4.css">
<link rel="stylesheet" href="http://disposisi.hutamakarya.com/css/main-1.4.css">
<link rel="stylesheet" href="http://disposisi.hutamakarya.com/css/themes-1.4.css">
<link href="http://disposisi.hutamakarya.com/css/paging.css" type="text/css" rel="stylesheet">
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
					<!--<input type="search" placeholder="Pencarian..." class="form-control" name="cari" aria-controls="example-table">-->
				</label>
					<label><input type="submit" class="btn btn-success" name="go" value="Go"></label>
			</div>
		</div> 
	</form>
<table cellspacing="0" cellpadding="0" border="0" align="center" id="" class="table table-bordered table-hover dataTable no-footer" aria-describedby="example-table_info">
	<thead>
		<tr align="center" role="row">
			<th class="sorting_asc" style="text-align: center; width: 31px;" tabindex="0" aria-controls="example-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label=": activate to sort column ascending"></th>
			<th style="text-align: center; width: 95px;" class="sorting" tabindex="0" aria-controls="example-table" rowspan="1" colspan="1" aria-label="Tanggal: activate to sort column ascending">Tanggal</th>
			<th style="text-align: center; width: 45px;" class="sorting" tabindex="0" aria-controls="example-table" rowspan="1" colspan="1" aria-label="Jam: activate to sort column ascending">Jam</th><th class="hidden-xs hidden-sm sorting" style="text-align: center; width: 44px;" tabindex="0" aria-controls="example-table" rowspan="1" colspan="1" aria-label=" Sifat: activate to sort column ascending"> Sifat</th>
			<th class="hidden-xs hidden-sm sorting" style="text-align: center; width: 56px;" tabindex="0" aria-controls="example-table" rowspan="1" colspan="1" aria-label="Kategori: activate to sort column ascending">Kategori</th>
			<th style="text-align: center; width: 178px;" class="sorting" tabindex="0" aria-controls="example-table" rowspan="1" colspan="1" aria-label="Perihal: activate to sort column ascending">Perihal</th>
			<th style="text-align: center; width: 155px;" class="hidden-xs hidden-sm sorting" tabindex="0" aria-controls="example-table" rowspan="1" colspan="1" aria-label="Pengirim Surat: activate to sort column ascending">Pengirim Surat</th>
			<th class="hidden-xs hidden-sm sorting" style="text-align: center; width: 74px;" tabindex="0" aria-controls="example-table" rowspan="1" colspan="1" aria-label="Dari: activate to sort column ascending">Dari</th>
			<th class="hidden-xs hidden-sm sorting" style="text-align: center; width: 282px;" tabindex="0" aria-controls="example-table" rowspan="1" colspan="1" aria-label="Catatan: activate to sort column ascending">Catatan</th>
		</tr>

	</thead>
	<tbody style="background-color:#fff;">
			<?php
				$num_rec_per_page=10;
				if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
$start_from = ($page-1) * $num_rec_per_page; 
	if(empty($_GET[page])){
		$start_from=$num_rec_per_page;
	}else{
		$start_from = ($page-1) * $num_rec_per_page; 
	}
	$thn=date('Y');
	$bln=date('m');
				//backup_surat_masuk_tapi_Belum_dibaca//$sql="select a.*,b.pengirim,c.* from tbl_sekertariat_disposisi a left join tbl_kode_pengirim b on a.pengirim=b.kode_pengirim left join tbl_disposisi c on a.nomor_agenda=c.nomor_agenda where c.tgl_baca is not null and c.tgl_tindak_lanjut is null and c.ke='$_SESSION[uname]'  and c.status='3'   order by a.nomor_agenda desc limit $limit offset $limitvalue ";
		if(isset($_POST['go'])){
			$sql="select a.*,b.pengirim,c.* from tbl_sekertariat_disposisi a left join tbl_kode_pengirim b on a.pengirim=b.kode_pengirim left join tbl_disposisi c on a.nomor_agenda=c.nomor_agenda where c.ke='$_SESSION[uname]' and c.tgl_tindak_lanjut is null and date_part('YEAR',a.tgl_terima)='$_POST[thn]' and date_part('MONTH',a.tgl_terima)='$_POST[bln]'  and a.perihal like '%$_POST[cari]%'  order by a.id desc ";
		
		}else{
			$sql="select a.*,b.pengirim,c.* from tbl_sekertariat_disposisi a left join tbl_kode_pengirim b on a.pengirim=b.kode_pengirim left join tbl_disposisi c on a.nomor_agenda=c.nomor_agenda where c.ke='$_SESSION[uname]' and c.tgl_tindak_lanjut is null  and date_part('YEAR',a.tgl_terima)='$thn' and date_part('MONTH',a.tgl_terima)='$bln' order by a.id desc   ";
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
