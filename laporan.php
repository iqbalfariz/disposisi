<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<?php
		//	include "header.php";
		//$app=$_SERVER['HTTP_HOST']."/aplikasi_surat";
	//	include "inc/conn.php";
			if(isset($_GET['delete'])){
		$dirname=$_GET['id'];
		$sqldelsek="delete from tbl_sekertariat_disposisi where nomor_agenda='$_GET[id]'";
		//echo $sqldelsek;
		$ekdesek=pg_query($sqldelsek) or die(pg_last_error());
		$sqldeldis="delete from tbl_disposisi where nomor_agenda='$_GET[id]'";
		$ekdedis=pg_query($sqldeldis)or die(pg_last_error());
		
		$sqldelsek="delete from tbl_sekertaris_lantai where nomor_agenda='$_GET[id]'";
		$ekdesek=pg_query($sqldelsek)or die(pg_last_error());

		$sqldelpa="delete from tbl_pa where nomor_agenda='$_GET[id]'";
		$eksdelpa=pg_query($sqldelpa)or die(pg_last_error());
		//delete_directory($dirname);
		$sqldelfile="delete from tbl_upload_file where nomor_agenda='$_GET[id]'";
		$eksdelfile=pg_query($sqldelfile);
		$dir="/file/".$_GET[id];
		$id=$_GET['id'];
		$nomer_agenda=$_GET['id'];
				    $pengirimnya=substr($nomer_agenda,0,3);
			        $tahunnya=substr($nomer_agenda,4,2);
			        $bulanya=substr($nomer_agenda,7,2);
		//echo $dir;
		rm_folder_recursively('file/'.$pengirimnya."/".$tahunnya."/".$bulanya."/".$nomer_agenda);
		echo "<script>alert('Disposisi Terhapus')</script>";
			 printf("<script>location.href='$app'</script>");
		
	}

		?>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<title>DataTables example</title>
		<style type="text/css">
@media print{
		a{
			display: none !important;
		}
}
</style>



<link rel="stylesheet" type="text/css" href="<?php echo $app;?>/css/paging.css">
		<script type="text/javascript" charset="utf-8" language="javascript" src="jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8" language="javascript" src="DT_bootstrap.js"></script>
	</head>
	<body>
<div id="example-datatables_length" class="dataTables_length">
							</div></br>
		
			
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="example-table">
	<thead>
		<tr style="color:#black;background-color:#2980B9;">
			<th  style="color:#fff;background-color:#2980B9; ">#</th>
			<th style="color:#fff;background-color:#2980B9; ">Nomor Agenda</th>
			<th style="color:#fff"> Sifat</th>
<th  style="color:#fff">Batas Waktu</th>
<th  style="color:#fff">Kategori</th>
<th style="color:#fff">Tgl Penerima</th>
<th style="color:#fff">Perihal</th>
<th style="color:#fff">Pengirim Surat</th>
<th style="color:#fff">Ditujukan Ke</th>
<th style="color:#fff">Status</th>

		</tr>

	</thead>
	<tbody>
		<?php
			$no=1;
			$sql="select a.*,b.pengirim from tbl_sekertariat_disposisi a left join tbl_kode_pengirim b on a.pengirim=b.kode_pengirim order by a.id desc ";
			
$eks=pg_query($sql) or die($sql);
			while($rs=pg_fetch_array($eks)){
				$sqlgetstatus="select * from tbl_disposisi where nomor_agenda='".$rs[nomor_agenda]."' order by id_disposisi desc limit 1";
			//echo $sqlgetstatus;
			$ekgetst=pg_query($sqlgetstatus);
			$rsg=pg_fetch_array($ekgetst);
		$date=date("Y-m-d");
		?>
		<tr class="odd gradeX">
			<td class="center"><?php echo $no;?></td>
			<td><?php echo $rs['nomor_agenda'];?></td>
			<td><?php if($rs['sifat']=="1"){echo "Biasa";}else{echo "Segera";}?></td>
				<td><?php if($rs['batas_surat']>=$date){echo "Berjalan";}else{echo " Expired";} //echo substr($rs['batas_surat'],8,2)."-".substr($rs['batas_surat'],5,2)."-".substr($rs['batas_surat'],0,4);  // if($rs['jenis']=="1"){echo "Asli";}elseif($rs['jenis']=="2"){echo "Copy";}else{echo "Tembusan";}?></td>
				<td class="center"> <?php if($rs['kategori']=="1"){echo "Eksternal";}else{echo "Internal";}?></td>
				<td class="center"><?php echo substr($rs['tgl_terima'],8,2)."-".substr($rs['tgl_terima'],5,2)."-".substr($rs['tgl_terima'],0,4);?></td>
				<td class="center"><?php echo $rs['perihal'];?></td>

					<?php
				$array = array($rs[ke]);
$comma_separated = "'".implode("','", $array)."'";
//echo $comma_separated;
			?>
				<td class="center"><?php echo $rs['pengirim_surat'];?></td>
				<td class="center"><?php echo $rs['ke'];?></td>
				
				<td class="center"><span class="label label-<?php if($rsg['status']=="1"){echo "info";}else{echo "danger";} ?>"><?php  if($rsg['status']=="1"){echo "Done,".$rsg['dari'];}else{echo "On Progres,".$rsg['ke']; echo "&nbsp;("; if($rsg['tgl_baca']==""){echo "Unread";}else{echo "Read";} echo ")"; if($rsg['tgl_tindak_lanjut']==""){echo "Undisposisi";} }?></span></td>


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