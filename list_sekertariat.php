	<?php
		//include "header.php";
		//include "left.php";
	?>

<form action="" method="post">
<div class="block-section">
	<div class="row"><div class="col-sm-6 col-xs-5"><div id="example-datatables_length" class="dataTables_length"><label><select  onchange="submit()" name="page" size="1" aria-controls="example-datatables" class="form-control"><option value="10" selected="selected">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></label></div></div><div class="col-sm-6 col-xs-7"><div class="dataTables_filter" id="example-datatables_filter"><label><div class="input-group"><span class="input-group-addon"><img src="<?php echo $app;?>/img/search.png" style="width:15px;height:15px;"></span><input type="text" aria-controls="example-datatables" class="form-control" name="cari" value="<?php echo $_POST['cari'];?>" placeholder="Search No Agenda"></div></label></div></div></div>
<table id="example-datatables" class="table table-bordered table-hover">
<thead>
<tr>
<th class="text-center hidden-xs hidden-sm">#</th>
<th> Nomer Agenda</th>
<th > Sifat</th>
<th class="">Jenis</th>
<th class="">Kategori</th>
<th class="hidden-xs hidden-sm">Tgl Penerima</th>
<th class="">Pengirim</th>
<th class="hidden-xs hidden-sm">Dari</th>
<th class="hidden-xs hidden-sm">Ke</th>
<th class="">Perihal</th>
<th class="">Status</th>
<?php
		if($_SESSION['uname']=="admin"){
	?>
<th class="text-center"><img src="<?php echo $app;?>/img/nav.png" style="width:15px;height:15px;"></th>
<?php
}
?>
</tr>
</thead>
<tbody>
	<?php
	$page="limit 10";
	if(isset($_POST['page'])){
		$page="limit $_POST[page]";
	}

		
		$sql="select a.*,b.pengirim,c.* from tbl_sekertariat_disposisi a left join tbl_kode_pengirim b on a.pengirim=b.kode_pengirim left join tbl_disposisi c on a.nomor_agenda=c.nomor_agenda where c.dari='$_GET[id]' and c.nomor_agenda='$_GET[no]'    order by a.nomor_agenda desc $page ";
		//echo $sql;
		$eks=pg_query($sql);
		$no=1;
		while($rs=pg_fetch_array($eks)){
			$sqlgetstatus="select * from tbl_disposisi where nomor_agenda='".$rs[nomor_agenda]."' order by id_disposisi desc limit 1";
			$ekgetst=pg_query($sqlgetstatus);
			$rsg=pg_fetch_array($ekgetst);
	?>
<tr>
<td class="text-center hidden-xs hidden-sm"><?php echo $no;?></td>
<td><a href="<?php echo $app;?>/detail/list_file/<?php echo $rs['nomor_agenda'];?>"><?php echo $rs['nomor_agenda'];?></a></td>
<td ><?php if($rs['sifat']=="1"){echo "Biasa";}else{echo "Segera";}?></td>
<td ><?php if($rs['jenis']=="1"){echo "Asli";}elseif($rs['jenis']=="2"){echo "Copy";}else{echo "Tembusan";}?></td>
<td ><?php if($rs['kategori']=="1"){echo "Eksternal";}else{echo "Internal";}?></td>
<td class="hidden-xs hidden-sm" ><?php echo $rs['tgl_terima'];?></td>
<td class="hidden-xs hidden-sm"><?php echo $rs['pengirim'];?></td>
<td ><a href="<?php  echo $app;?>/disposisidetail/disposisidetail/<?php echo $rs[dari];?>/<?php echo $rs['nomor_agenda'];?>"><?php echo $rs['dari'];?></a></td>
<td class="hidden-xs hidden-sm"><?php echo $rs['ke'];?></td>
<td ><?php echo $rs['perihal'];?></td>
<td ><span class="label label-info"><?php  if($rsg['status']=="1"){echo "Done,".$rsg['dari'];}else{echo "On Progres";}?></span></td>
<?php
		if($_SESSION['uname']=="admin"){
	?>
<td class="text-center">
<div class="btn-group">
	
<a href="javascript:void(0)" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-success"><img src="<?php echo $app;?>/img/ed.png" style="width:15px;height:15px;"></a>
<a href="javascript:void(0)" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger"><img src="<?php echo $app;?>/img/del.png" style="width:15px;height:15px;"></a>
	
</div>
</td>
<?php
		}
	?>
</tr>
	
<?php
		$no++;
		}
?>
</tbody>

</table>
<div class="row"><div class="col-sm-5 hidden-xs"><div class="dataTables_info" id="example-datatables_info"><strong>21</strong>-<strong>30</strong> of <strong>30</strong></div></div><div class="col-sm-7 col-xs-12 clearfix"><div class="dataTables_paginate paging_bootstrap"><ul class="pagination pagination-sm remove-margin"><li class="prev"><a href="javascript:void(0)"><img src="<?php echo $app;?>/img/pre.png" style="width:15px;height:15px;"> </a></li><li><a href="javascript:void(0)">1</a></li><li><a href="javascript:void(0)">2</a></li><li class="active"><a href="javascript:void(0)">3</a></li><li class="next disabled"><a href="javascript:void(0)"> <img src="<?php echo $app;?>/img/next.png" style="width:15px;height:15px;"></a></li></ul></div></div></div>

</div>


<?php
//include "footer.php";

?>
</form>