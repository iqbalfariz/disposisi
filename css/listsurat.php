	<?php
		//include "header.php";
		//include "left.php";
	?>


<div class="block-section">
	<div class="row"><div class="col-sm-6 col-xs-5"><div id="example-datatables_length" class="dataTables_length"><label><select name="example-datatables_length" size="1" aria-controls="example-datatables" class="form-control"><option value="10" selected="selected">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></label></div></div><div class="col-sm-6 col-xs-7"><div class="dataTables_filter" id="example-datatables_filter"><label><div class="input-group"><span class="input-group-addon"><img src="<?php echo $app;?>/img/search.png" style="width:15px;height:15px;"></span><input type="text" aria-controls="example-datatables" class="form-control" placeholder="Search"></div></label></div></div></div>
<table id="example-datatables" class="table table-bordered table-hover">
<thead>
<tr>
<th class="text-center hidden-xs hidden-sm">#</th>
<th> Nomer Agenda</th>
<th class="hidden-xs hidden-sm"> Sifat</th>
<th class="hidden-xs hidden-sm">Jenis</th>
<th class="hidden-xs hidden-sm">Kategori</th>
<th class="hidden-xs hidden-sm">Tgl Penerima</th>
<th class="hidden-xs hidden-sm">Pengirim</th>
<th class="hidden-xs hidden-sm">Dituju Ke</th>
<th class="hidden-xs hidden-sm">Status</th>
<th class="text-center"><img src="<?php echo $app;?>/img/nav.png" style="width:15px;height:15px;"></th>
</tr>
</thead>
<tbody>
	<?php
		$sql="select a.*,b.pengirim from tbl_sekertariat_disposisi a left join tbl_kode_pengirim b on a.pengirim=b.kode_pengirim order by a.nomor_agenda desc";
		$eks=pg_query($sql);
		$no=1;
		while($rs=pg_fetch_array($eks)){
	?>
<tr>
<td class="text-center hidden-xs hidden-sm"><?php echo $no;?></td>
<td><a href="<?php echo $app;?>/detail/list_file/<?php echo $rs['nomor_agenda'];?>"><?php echo $rs['nomor_agenda'];?></a></td>
<td class="hidden-xs hidden-sm"><?php if($rs['sifat']=="1"){echo "Biasa";}else{echo "Segera";}?></td>
<td class="hidden-xs hidden-sm"><?php if($rs['jenis']=="1"){echo "Asli";}elseif($rs['jenis']=="2"){echo "Copy";}else{echo "Tembusan";}?></td>
<td class="hidden-xs hidden-sm"><?php if($rs['kategori']=="1"){echo "Eksternal";}else{echo "Internal";}?></td>
<td class="hidden-xs hidden-sm"><?php echo $rs['tgl_terima'];?></td>
<td class="hidden-xs hidden-sm"><?php echo $rs['pengirim'];?></td>
<td class="hidden-xs hidden-sm"><?php echo $rs['ke'];?></td>
<td class="hidden-xs hidden-sm"><span class="label label-info">Terkirim...</span></td>
<td class="text-center">
<div class="btn-group">
<a href="javascript:void(0)" data-toggle="tooltip" title="Edit" class="btn btn-xs btn-success"><img src="<?php echo $app;?>/img/ed.png" style="width:15px;height:15px;"></a>
<a href="javascript:void(0)" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-danger"><img src="<?php echo $app;?>/img/del.png" style="width:15px;height:15px;"></a>
</div>
</td>
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