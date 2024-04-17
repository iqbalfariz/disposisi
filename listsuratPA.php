

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<?php
		//	include "header.php";
		//$app="http://";
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
		<tr style="color:#black;background-color:#2980B9;">
			<th  style="color:#fff;background-color:#2980B9; ">#</th>
			<th style="color:#fff;background-color:#2980B9; ">Nomor Agenda</th>
			<th style="color:#fff"> Sifat</th>
			<th class="hidden-xs hidden-sm" style="color:#fff">Jenis</th>
			<th class="hidden-xs hidden-sm" style="color:#fff">Kategori</th>
			<th style="color:#fff">Tgl Disposisi</th>
			<th style="color:#fff">Perihal</th>
			<th style="color:#fff">Pengirim</th>
			<th style="color:#fff">Ditujukan Ke</th>
			<th style="color:#fff">Surat Dari</th>
			<th style="color:#fff">Status</th>
	   </tr>

	</thead>
	<tbody>
		<?php
			$sql="select a.*,b.*,c.pengirim as pengirimnya from tbl_pa a left join tbl_sekertariat_disposisi b on a.nomor_agenda=b.nomor_agenda left join tbl_kode_pengirim c on b.pengirim=c.kode_pengirim where a.atasan='".substr($_SESSION[uname],3,10)."'";
		//		echo $sql;
			$eks=pg_query($sql);
			if($eks){
			$no=1;
			while($rs=pg_fetch_array($eks)){
		?>
		<tr class="odd gradeX">
			<td class="text-center hidden-xs hidden-sm"><?php echo $no;?></td>

			<td><a href="<?php echo $app;?>?detail=bacapesanPA&id=<?php echo $rs['nomor_agenda'];?>&dari=<?php echo $rs['dari'];?>&ke=<?php echo $rs['atasan'];?>"><?php echo $rs['nomor_agenda'];?></a></td>
			<td class="hidden-xs hidden-sm"><?php if($rs['sifat']=="1"){echo "Biasa";}else{echo "Segera";}?></td>
			<td class="hidden-xs hidden-sm"><?php if($rs['jenis']=="1"){echo "Asli";}elseif($rs['jenis']=="2"){echo "Copy";}else{echo "Tembusan";}?></td>
			<td class="hidden-xs hidden-sm"><?php if($rs['kategori']=="1"){echo "Eksternal";}else{echo "Internal";}?></td>
			<td class="hidden-xs hidden-sm"><?php echo $rs['tgl_terima'];?></td>
			<td class="hidden-xs hidden-sm"><?php echo $rs['perihal'];?></td>
			<td class="hidden-xs hidden-sm"><?php echo $rs['pengirim_surat'];?></td>
			<td class="hidden-xs hidden-sm"><a href="<?php echo $app;?>/?disdetail=disposisidetail&id=<?php echo $rs['atasan'];?>&no=<?php echo $rs['nomor_agenda'];?>"><?php echo $rs['atasan'];?></a></td>
			<td class="hidden-xs hidden-sm"><?php echo $rs['dari'];?></td>
			<td class="hidden-xs hidden-sm"><span class="label label-info"><?php if($rs['tgl_baca']!=""){echo "Hanya Dibaca";}else{echo "Belum Dibaca";}?></span></td>


		</tr>
		<?php
		$no++;
		}
	}
		?>
		

			</tbody>
</table>
			
		</div>
	</body>
</html>