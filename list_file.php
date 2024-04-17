	<?php
		//include "header.php";
		//include "left.php";
	
	?>


<div class="block-section">
<table id="example-datatables" class="table table-bordered table-hover">
<thead>
<tr>
<th class="text-center hidden-xs hidden-sm">#</th>
<th> Nomer Agenda</th>
<th class="hidden-xs hidden-sm">Nama File</th>
<th class="hidden-xs hidden-sm">Perihal</th>
<th class="hidden-xs hidden-sm">Kategori</th>

<th class="text-center"><img src="<?php echo $app;?>/img/nav.png" style="width:15px;height:15px;"></th>
</tr>
</thead>
<tbody>
	<?php
	$id=$_GET['id'];
		$sql="select a.*,b.perihal from tbl_upload_file a left join tbl_sekertariat_disposisi b on a.nomor_agenda=b.nomor_agenda where a.nomor_agenda='$id'";
		//echo $sql;
		$eks=pg_query($sql) or die($sql);
		$no=1;
		while($rs=pg_fetch_array($eks)){
	?>
<tr>
<td class="text-center hidden-xs hidden-sm"><?php echo $no;?></td>
<td><?php echo $rs['nomor_agenda'];?></td>
<td class="hidden-xs hidden-sm"><?php echo $rs['file_name'];?></td>
<td class="hidden-xs hidden-sm"><?php echo $rs['perihal']; ?>Kb</td>
<td class="hidden-xs hidden-sm"><?php if($rs['kategori']=="1"){echo "Eksternal";}else{echo "Internal";}?></td>

<td class="text-center">
<div class="btn-group">
	<?php
					 $nomer_agenda=$_GET['id'];
				    $pengirimnya=substr($nomer_agenda,0,3);
			        $tahunnya=substr($nomer_agenda,4,2);
			        $bulanya=substr($nomer_agenda,7,2);
			        
	?>
<a href="<?php echo $app;?>/file/<?php echo $pengirimnya."/".$tahunnya."/".$bulanya."/".$_GET[id];?>/<?php echo $rs[file_name];?>" onclick="window.open('<?php echo $app;?>/file/<?php echo $pengirimnya."/".$tahunnya."/".$bulanya."/".$_GET[id];?>/<?php echo $rs[file_name];?>','popup','width=900,height=900,scrollbars=no,resizable=no,toolbar=no,directories=no,location=no,menubar=no,status=no,left=100%,top=-500%'); return false"><img src="<?php echo $app;?>/img/pdf.png"></a>

</div>
</td>
</tr>
<?php
		$no++;
		}
?>
</tbody>

</table>



<?php
//include "footer.php";

?>
