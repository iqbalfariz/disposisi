	<?php
	$date=date("Y-m-d H:i:s");
	if($_SESSION['unit_kerja']=="sekertaris"){
	$sqlupdate="update tbl_sekertaris_lantai set tgl_baca='$date' where nomor_agenda='$_GET[id]'";
echo $sqlupdate;
	pg_query($sqlupdate);
	}else{
	$sqlupdate="update tbl_pa set tgl_baca='$date' where nomor_agenda='$_GET[id]'";
		pg_query($sqlupdate);
	//echo $sqlupdate;
	}
	$sqlgetdata="select * from tbl_disposisi where nomor_agenda='$_GET[id]' and ke='$_SESSION[uname]'";
	//echo $sqlgetdata;
	$ekgetdata=pg_query($sqlgetdata);
	$rgetdata=pg_fetch_array($ekgetdata);

	
	if(isset($_POST['save'])){
		if(!empty($_POST['status'])){
			if($_POST['status']=="1" &&!empty($_POST['ke'])&&!empty($_POST['dis'])){	
				$sqlupdatetindak="update tbl_disposisi set tgl_tindak_lanjut='$date' where nomor_agenda='$_GET[id]' and ke='$_SESSION[uname]'";
				$eksupdate=pg_query($sqlupdatetindak);
					//print_r($_POST[ke]);
					$dis=array();
					$di=$_POST['dis'];
					foreach ($_POST['dis'] as $ble => $va) {
								$dis[] = $di[$ble];
								
					}
					$disposisi=implode(",",$dis);
					
					$kenya=array();
					$ke=$_POST['ke'];
					foreach ($_POST['ke'] as $di => $v) {
						$kenya[] = $ke[$di];
						//echo $ke[$di];
						$sqldis="insert into tbl_disposisi (id_disposisi,nomor_agenda,tgl_masuk_surat,dari,ke,cc,catatan,status,keterangan,tgl_kirim)
									values(nextval('tbl_disposisi_id_disposisi_seq'::regclass),'$_GET[id]','".$rgetdata['tgl_masuk_surat']."','$_SESSION[uname]','$ke[$di]','','$_POST[catatan]','0','$disposisi','$date')";
						//echo $sq
						$eks=pg_query($sqldis);		

					}
					$sqlupdate="update tbl_disposisi set status='0' where nomor_agenda='$_GET[id]' and ke='$_SESSION[uname]' ";
		pg_query($sqlupdate);
					echo "<script>alert('Disposisi Terkirim...')</script>";
			}elseif($_POST['status']=="2"){
				$sqldone="insert into tbl_disposisi (id_disposisi,nomor_agenda,tgl_masuk_surat,dari,catatan,status)
									values(nextval('tbl_disposisi_id_disposisi_seq'::regclass),'$_GET[id]','".$rgetdata['tgl_masuk_surat']."','$_SESSION[uname]','$_POST[catatan]','1')";
				//echo $sqldone;
				$eksdone=pg_query($sqldone);
				$sqlupdate="update tbl_disposisi set status='0' where nomor_agenda='$_GET[id]' and ke='$_SESSION[uname]' ";
		pg_query($sqlupdate);
			echo "<script>alert('Disposisi Terkirim...')</script>";
			printf("<script>location.href='$app/menu/listfront'</script>");
			}else{
				echo "<script>alert('Disposisi Harap Dilengkapi')</script>";
			}		

		}else{
			echo "<script>alert('Tindak Lanjut Harap Dilengkapi')</script>";
		}
	}


		$sqldetail="select a.*,b.pengirim as kiriman_dari from tbl_sekertariat_disposisi a left join tbl_kode_pengirim b on a.pengirim=b.kode_pengirim where a.nomor_agenda='$_GET[id]'";
		//echo $sqldetail;
		$eksdetail=pg_query($sqldetail);
		$rs=pg_fetch_array($eksdetail);
		
		

	?>
<script type="text/javascript">
	function rubah(id){
		if(id=="1"){
				document.getElementById('disposisi').style.display = '';
		}else{	
			    document.getElementById('disposisi').style.display = 'none';
		}
	}
	
</script>
<script type="text/javascript">
        function tes(checkbox) {
            var id = checkbox.id;
            if (checkbox.checked){
            	//alert(id);
               document.getElementById('s'+id).style.display= '';
            }
            else {
               document.getElementById('s'+id).style.display= 'none';
            }
        }
         function showText(checkbox) {
            var id = checkbox.id;
            if (checkbox.checked){
            	//alert(id);
               document.getElementById('t'+id).style.display= '';
            }
            else {
               document.getElementById('t'+id).style.display= 'none';
            }
        }
    </script>
	<link rel="stylesheet" href="<?php echo $app;?>/css/style.css"/>
<div class="block block-themed block-last">
<div class="block-title">
<h4>Detail Surat Masuk PA</h4>
</div>
<div class="block-content">
<form action="" class="form-horizontal" method="post" >
<h4 class="sub-header">Surat Masuk</h4>
<div class="form-group">
<label class="control-label col-md-2">Jenis</label>
<div class="col-md-3">
<p class="form-control-static"><b><?php if($rs['jenis']=="1"){echo "Asli";}elseif($rs['jenis']=="2"){echo "Copy";}else{echo "Tembusan";}?></b></p>
</div>
<label class="control-label col-md-2">Sifat</label>
<div class="col-md-3">
<p class="form-control-static"><b><?php if($rs[perihal]=="1"){echo "<b>Biasa</b>";}else{echo "<b style='color:red;'>Segera</b>";}?></b></p>
</div>
</div>
<div class="form-group">
<label class="control-label col-md-2">Diterima Sekertariat</label>
<div class="col-md-3">
<p class="form-control-static"><b><?php echo $rs[tgl_terima];?></b></p>
</div>
<label class="control-label col-md-2">Pengirim</label>
<div class="col-md-3">
<p class="form-control-static"><b><?php echo $rs[kiriman_dari];?></b></p>
</div>
</div><div class="form-group">
<label class="control-label col-md-2">Tanggal Surat</label>
<div class="col-md-3">
<p class="form-control-static"><b><?php echo $rs[tgl_surat];?></b></p>
</div>
<label class="control-label col-md-2">No Surat</label>
<div class="col-md-3">
<p class="form-control-static"><b><?php echo $rs[no_surat];?></b></p>
</div>
</div><div class="form-group">
<label class="control-label col-md-2">Perihal</label>
<div class="col-md-3">
<p class="form-control-static"><b><?php echo $rs[perihal];?></b></p>
</div>
<label class="control-label col-md-2">Kategori</label>
<div class="col-md-3">
<p class="form-control-static"><b><?php if($rs[kategori]=="1"){echo "Eksternal";}else{echo "Internal";}?></b></p>
</div>
</div>
<div class="form-group">
<label class="control-label col-md-2">Alur Disposisi</label>
<div class="col-md-3">
<p class="form-control-static"><b><?php echo $_GET['dari']."&nbsp;KE&nbsp;&nbsp;".$_GET['ke'];?></b></p>
</div>
<label class="control-label col-md-2">Catatan</label>
<div class="col-md-3">
	<?php
		$get_catatan="select * from tbl_pa where atasan='$_GET[ke]' and dari='$_GET[dari]' and nomor_agenda='$_GET[id]'";
		//echo $get_catatan;
		$ekgc=pg_query($get_catatan);
		$rgetc=pg_fetch_array($ekgc);
	?>
<p class="form-control-static"><?php  if($_GET['dari']=="Sekertariat"){echo "Tidak Ada Catatan Karena Surat Dari Sekertariat";}else{ echo $rgetc['catatan'];}?></p>
</div>

</div>
<div class="form-group">

<label class="control-label col-md-2">File</label>
<div class="col-md-3">
	<?php
		$sqlgetfile="select * from tbl_upload_file where nomor_agenda='$_GET[id]'";
		$ekgetfile=pg_query($sqlgetfile);
		$rfile=pg_fetch_array($ekgetfile);
	?>
<?php
					 $nomer_agenda=$_GET['id'];
				    $pengirimnya=substr($nomer_agenda,0,3);
			        $tahunnya=substr($nomer_agenda,4,2);
			        $bulanya=substr($nomer_agenda,7,2);
			        
	?>
<a href="<?php echo $app;?>/file/<?php echo $pengirimnya."/".$tahunnya."/".$bulanya."/".$_GET[id];?>/<?php echo $rfile[file_name];?>" onclick="window.open('<?php echo $app;?>/file/<?php echo $pengirimnya."/".$tahunnya."/".$bulanya."/".$_GET[id];?>/<?php echo $rfile[file_name];?>','popup','width=900,height=900,scrollbars=no,resizable=no,toolbar=no,directories=no,location=no,menubar=no,status=no,left=100%,top=-500%'); return false"><img src="<?php echo $app;?>/img/pdf.png"></a>
</div>

</div>

<style type="text/css">
.sumput{
	display: none;
}
</style>

<!--
<div class="row"><div class="col-sm-5 hidden-xs"><div class="dataTables_info" id="example-datatables_info"><strong>21</strong>-<strong>30</strong> of <strong>30</strong></div></div><div class="col-sm-7 col-xs-12 clearfix"><div class="dataTables_paginate paging_bootstrap"><ul class="pagination pagination-sm remove-margin"><li class="prev"><a href="javascript:void(0)"><img src="<?php echo $app;?>/img/pre.png" style="width:15px;height:15px;"> </a></li><li><a href="javascript:void(0)">1</a></li><li><a href="javascript:void(0)">2</a></li><li class="active"><a href="javascript:void(0)">3</a></li><li class="next disabled"><a href="javascript:void(0)"> <img src="<?php echo $app;?>/img/next.png" style="width:15px;height:15px;"></a></li></ul></div></div></div>
-->
</div>


<?php
//include "footer.php";

?>