<div class="block block-themed">
<div class="block-title">
<div class="block-options">
<a title="" data-toggle="block-collapse" class="btn btn-option enable-tooltip" href="javascript:void(0)" data-original-title="Toggle block's content"></a>
<a title="" data-toggle="tooltip" class="btn btn-option" href="javascript:void(0)" data-original-title="Settings"></a>
</div>
<h4>Surat Masuk</h4>
</div>
<div class="block-content">
<div class="timeline-container">
<ul class="timeline">
	<?php
	//echo $_SESSION['uname'];
	$datenow=date("Y-m-d");
		$sqlsuratmasuk="select a.*,b.sifat,b.pengirim,b.no_surat,b.perihal,b.batas_surat,c.pengirim from tbl_disposisi a 
		left join tbl_sekertariat_disposisi b on a.nomor_agenda=b.nomor_agenda
		left join tbl_kode_pengirim c on b.pengirim=c.kode_pengirim
		 where a.ke='$_SESSION[uname]' and b.batas_surat>'$datenow'::date ";
		//echo $sqlsuratmasuk;
		$ekssm=pg_query($sqlsuratmasuk);
		while($rsm=pg_fetch_array($ekssm)){


	?>
		<li class="clearfix">
		<i class="timeline-meta-cat themed-background-leaf"><?php echo $rsm['dari'];?></i>
		<span class="timeline-title"><?php if($rsm['tgl_baca']==""){ echo "<b>".$rsm['pengirim']."</b>";}else{echo "<h6>".$rsm['pengirim']."</h6>";}?></br><a href="<?php if($rsm['tgl_baca']==""){?> <?php echo $app;?>/detail/bacapesan/<?php echo $rsm['nomor_agenda'];?> <?php }else{echo "#";}?>"><?php if($rsm['tgl_baca']==""){echo "<b>".$rsm['perihal']."</b>";}else{echo "<h6>".$rsm['perihal']."</h6>";}?></a></span>
		<span class="timeline-text"><?php  if($rsm['tgl_baca']==""){echo "<b>".$rsm['catatan']."</b>";}else{echo $rsm['catatan'];}?></span>
		</li>
	<?php
		}
	?>

</ul>
</div>
</div>
</div>