	<?php
	$app="http://".$_SERVER['HTTP_HOST']."/360";
	include "inc/conn.php";
	//print_r($_SESSION);
	//header("Content-Type: application/x-msexcel");  
    //header("Content-Disposition: attachment; filename=lap_user.xls");
	?>
	<style type="text/css">


	.multipleSelectBoxControl span{	/* Labels above select boxes*/
		font-family:arial;
		font-size:11px;
		font-weight:bold;
	}
	.multipleSelectBoxControl div select{	/* Select box layout */
		font-family:arial;
		height:100%;
	}
	.multipleSelectBoxControl input{	/* Small butons */
		width:25px;	
	}
	
	.multipleSelectBoxControl div{
		float:left;
	}
	table{
		font-size: 12px;
		font-family: arial;
	}
	
	</style>
	<script type="text/javascript" src="<?php echo $app;?>/js/jquery.min.js"></script>
<form method="post" action="">
	<table width="1280">
		<tr>
			<td><b>No</b></td>
			<td><b>Jabatan</b></td>
			<td><b>Kode Jabatan</b></td>
			<td><b>Unit Kerja</b></td>
		
		</tr>
		<?php
			$sql="select * from tbl_jabatan_login order by jabatan asc";
			$eksql=pg_query($sql)or die($sql);
		$no=1;	
		while($rs=pg_fetch_array($eksql)){	
		?>
		<tr>
			<td><?php echo $no;?></td>
			<td><?php echo $rs['jabatan'];?></td>
			<td><?php echo $rs['kode_jabatan'];?></td>
			<td><?php echo $rs['unit_kerja'];?></td>
			
		</tr>
		<?php
		$no++;
		}
		?>
	</table>
		
</form>


