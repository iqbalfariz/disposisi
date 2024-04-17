<div class="row">
<div class="col-md-<?php if($_SESSION['uname']=="admin"){echo "6";}else{echo "15";}?>" >
<div class="block block-tabs block-themed">
<div class="block-options">
<a href="javascript:void(0)" class="btn btn-option" data-toggle="tooltip" title="Settings"></a>
</div>
<ul class="nav nav-tabs" data-toggle="tabs">
<li class="active"><a href="#dashboard-notifications" data-toggle="tooltip" title="Latest Notifications"><img src="<?php echo $app;?>/img/info.png" width="20"></a></li>
<li><a href="#dashboard-messages" data-toggle="tooltip" title="Latest Messages"></a></li>
</ul>
<div class="tab-content">
<div class="tab-pane active" id="dashboard-notifications">
<div class="scrollable">
<h4 class="sub-header"><img src="<?php echo $app;?>/img/speaker.png" width="15"> Informasi</h4>
<div class="alert alert-success">
<?php
	$datenow=date("Y-m-d");
		$sqlgettot="select count(a.id_disposisi) as jml,a.ke,b.batas_surat from tbl_disposisi a left join 
		tbl_sekertariat_disposisi b on a.nomor_agenda=b.nomor_agenda where  b.batas_surat >'$datenow'::date and a.ke='$_SESSION[uname]' group by a.id_disposisi,a.ke,b.batas_surat";
	//echo $sqlgettot;
		$eksgettot=pg_query($sqlgettot);
		$rtotal=pg_fetch_array($eksgettot);
?>
| <a href="<?php echo $app;?>?menu=suratmasuk" style="none">Surat Yang Telah Masuk <strong>(<?php echo $rtotal['jml'];?>&nbsp;Surat)</strong></a>
</div>
<div class="alert badge-neutral">
<?php
		$sqlkirim="select count(id_disposisi) as jml from tbl_disposisi where dari='$_SESSION[uname]'";
		//echo $sql1;
		$ekkirim=pg_query($sqlkirim);
		$rtkirim=pg_fetch_array($ekkirim);
	?>
| Surat Terkirim <strong>(<?php echo $rtkirim[jml];?>&nbsp;Surat)</strong>
</div>
<div class="alert alert-danger">
<?php
		$sql1="select count(a.id_disposisi) as jml,a.tgl_baca,b.sifat from 
		tbl_disposisi a left join tbl_sekertariat_disposisi b on 
		a.nomor_agenda=b.nomor_agenda where a.ke='$_SESSION[uname]' and tgl_baca is null and b.sifat='2' group by a.tgl_baca,b.sifat";
		//echo $sql1;
		$eks1=pg_query($sql1);
		$r1=pg_fetch_array($eks1);
	?>
| Surat Bersifat Segera <strong>(<?php echo $r1[jml];?>&nbsp;Surat)</strong>
</div>
<div class="alert alert-info">
<?php
		$sql1="select count(a.id_disposisi) as jml,a.tgl_baca,b.sifat from 
		tbl_disposisi a left join tbl_sekertariat_disposisi b on 
		a.nomor_agenda=b.nomor_agenda where a.ke='$_SESSION[uname]' and tgl_baca is null and b.sifat='1' group by a.tgl_baca,b.sifat";
		//echo $sql1;
		$eks1=pg_query($sql1);
		$r1=pg_fetch_array($eks1);
	?>
| Surat Bersifat Biasa <strong>(<?php echo $r1[jml];?>&nbsp;Surat)</strong>
</div>
<div class="alert alert-warning">
<?php
		$sqli="select count(a.id_disposisi) as jml,a.tgl_baca,b.kategori from 
		tbl_disposisi a left join tbl_sekertariat_disposisi b on 
		a.nomor_agenda=b.nomor_agenda where a.ke='$_SESSION[uname]' and tgl_baca is null and b.kategori='2' group by a.tgl_baca,b.kategori";
	//	echo $sqli;
		$eksi=pg_query($sqli);
		$ri=pg_fetch_array($eksi);
	?>
| Surat Bersifat Internal <strong>(<?php echo $ri[jml];?>&nbsp;Surat)</strong>
</div>
<div class="alert badge-warning">
<?php
		$sqle="select count(a.id_disposisi) as jml,a.tgl_baca,b.kategori from 
		tbl_disposisi a left join tbl_sekertariat_disposisi b on 
		a.nomor_agenda=b.nomor_agenda where a.ke='$_SESSION[uname]' and tgl_baca is null and b.kategori='1' group by a.tgl_baca,b.kategori";
		//echo $sql1;
		$ekse=pg_query($sqle);
		$re=pg_fetch_array($ekse);
	?>
| Surat Bersifat Eksternal <strong>(<?php echo $re[jml];?>&nbsp;Surat)</strong>
</div>


</div>
</div>

<div class="tab-pane" id="dashboard-messages">
<div class="scrollable">
<div class="media">
<a href="javascript:void(0)" class="pull-left" data-toggle="tooltip" title="Username">
<img src="<?php echo $app;?>/img/placeholders/image_64x64_dark.png" class="media-object img-circle" alt="Image">
</a>
<div class="media-body">
<h5 class="media-heading">
<a href="javascript:void(0)" class="badge badge-neutral" data-toggle="tooltip" title="Reply"><i class="icon-reply"></i></a>
<a href="javascript:void(0)" class="badge badge-neutral" data-toggle="tooltip" title="Archive"><i class="icon-folder-open"></i></a>
<a href="javascript:void(0)" class="badge badge-danger" data-toggle="tooltip" title="Delete"><i class="icon-trash"></i></a>
<span class="label label-info">May 20, 2013</span>
<span class="label label-warning">22:43</span>
</h5>
<p>This new idea is really awesome! I can't wait till we get started.. <a href="javascript:void(0)" class="badge badge-inverse">Read more</a></p>
</div>
</div>
<div class="media">
<a href="javascript:void(0)" class="pull-left" data-toggle="tooltip" title="Username">
<img src="<?php echo $app;?>/img/placeholders/image_64x64_light.png" class="media-object img-circle" alt="Image">
</a>
<div class="media-body">
<h5 class="media-heading">
<a href="javascript:void(0)" class="badge badge-neutral" data-toggle="tooltip" title="Reply"><i class="icon-reply"></i></a>
<a href="javascript:void(0)" class="badge badge-neutral" data-toggle="tooltip" title="Archive"><i class="icon-folder-open"></i></a>
<a href="javascript:void(0)" class="badge badge-danger" data-toggle="tooltip" title="Delete"><i class="icon-trash"></i></a>
<span class="label label-info">May 20, 2013</span>
<span class="label label-warning">21:00</span>
</h5>
<p>This new idea is really awesome! I can't wait till we get started.. <a href="javascript:void(0)" class="badge badge-inverse">Read more</a></p>
</div>
</div>
<div class="media">
<a href="javascript:void(0)" class="pull-left" data-toggle="tooltip" title="Username">
<img src="<?php echo $app;?>/img/placeholders/image_64x64_dark.png" class="media-object img-circle" alt="Image">
</a>
<div class="media-body">
<h5 class="media-heading">
<a href="javascript:void(0)" class="badge badge-neutral" data-toggle="tooltip" title="Reply"><i class="icon-reply"></i></a>
<a href="javascript:void(0)" class="badge badge-neutral" data-toggle="tooltip" title="Archive"><i class="icon-folder-open"></i></a>
<a href="javascript:void(0)" class="badge badge-danger" data-toggle="tooltip" title="Delete"><i class="icon-trash"></i></a>
<span class="label label-info">May 20, 2013</span>
<span class="label label-warning">20:41</span>
</h5>
<p>This new idea is really awesome! I can't wait till we get started.. <a href="javascript:void(0)" class="badge badge-inverse">Read more</a></p>
</div>
</div>
<div class="media">
<a href="javascript:void(0)" class="pull-left" data-toggle="tooltip" title="Username">
<img src="<?php echo $app;?>/img/placeholders/image_64x64_light.png" class="media-object img-circle" alt="Image">
</a>
<div class="media-body">
<h5 class="media-heading">
<a href="javascript:void(0)" class="badge badge-neutral" data-toggle="tooltip" title="Reply"><i class="icon-reply"></i></a>
<a href="javascript:void(0)" class="badge badge-neutral" data-toggle="tooltip" title="Archive"><i class="icon-folder-open"></i></a>
<a href="javascript:void(0)" class="badge badge-danger" data-toggle="tooltip" title="Delete"><i class="icon-trash"></i></a>
<span class="label label-info">May 20, 2013</span>
<span class="label label-warning">17:14</span>
</h5>
<p>This new idea is really awesome! I can't wait till we get started.. <a href="javascript:void(0)" class="badge badge-inverse">Read more</a></p>
</div>
</div>
<div class="media">
<a href="javascript:void(0)" class="pull-left" data-toggle="tooltip" title="Username">
<img src="<?php echo $app;?>/img/placeholders/image_64x64_dark.png" class="media-object img-circle" alt="Image">
</a>
<div class="media-body">
<h5 class="media-heading">
<a href="javascript:void(0)" class="badge badge-neutral" data-toggle="tooltip" title="Reply"><i class="icon-reply"></i></a>
<a href="javascript:void(0)" class="badge badge-neutral" data-toggle="tooltip" title="Archive"><i class="icon-folder-open"></i></a>
<a href="javascript:void(0)" class="badge badge-danger" data-toggle="tooltip" title="Delete"><i class="icon-trash"></i></a>
<span class="label label-info">May 20, 2013</span>
<span class="label label-warning">15:12</span>
</h5>
<p>This new idea is really awesome! I can't wait till we get started.. <a href="javascript:void(0)" class="badge badge-inverse">Read more</a></p>
</div>
</div>
<div class="media">
<a href="javascript:void(0)" class="pull-left" data-toggle="tooltip" title="Username">
<img src="<?php echo $app;?>/img/placeholders/image_64x64_light.png" class="media-object img-circle" alt="Image">
</a>
<div class="media-body">
<h5 class="media-heading">
<a href="javascript:void(0)" class="badge badge-neutral" data-toggle="tooltip" title="Reply"><i class="icon-reply"></i></a>
<a href="javascript:void(0)" class="badge badge-neutral" data-toggle="tooltip" title="Archive"><i class="icon-folder-open"></i></a>
<a href="javascript:void(0)" class="badge badge-danger" data-toggle="tooltip" title="Delete"><i class="icon-trash"></i></a>
<span class="label label-info">May 20, 2013</span>
<span class="label label-warning">13:10</span>
</h5>
<p>This new idea is really awesome! I can't wait till we get started.. <a href="javascript:void(0)" class="badge badge-inverse">Read more</a></p>
</div>
</div>
<div class="media">
<a href="javascript:void(0)" class="pull-left" data-toggle="tooltip" title="Username">
<img src="<?php echo $app;?>/img/placeholders/image_64x64_dark.png" class="media-object img-circle" alt="Image">
</a>
<div class="media-body">
<h5 class="media-heading">
<a href="javascript:void(0)" class="badge badge-neutral" data-toggle="tooltip" title="Reply"><i class="icon-reply"></i></a>
<a href="javascript:void(0)" class="badge badge-neutral" data-toggle="tooltip" title="Archive"><i class="icon-folder-open"></i></a>
<a href="javascript:void(0)" class="badge badge-danger" data-toggle="tooltip" title="Delete"><i class="icon-trash"></i></a>
<span class="label label-info">May 20, 2013</span>
<span class="label label-warning">12:05</span>
</h5>
<p>This new idea is really awesome! I can't wait till we get started.. <a href="javascript:void(0)" class="badge badge-inverse">Read more</a></p>
</div>
</div>
<div class="media">
<a href="javascript:void(0)" class="pull-left" data-toggle="tooltip" title="Username">
<img src="<?php echo $app;?>/img/placeholders/image_64x64_light.png" class="media-object img-circle" alt="Image">
</a>
<div class="media-body">
<h5 class="media-heading">
<a href="javascript:void(0)" class="badge badge-neutral" data-toggle="tooltip" title="Reply"><i class="icon-reply"></i></a>
<a href="javascript:void(0)" class="badge badge-neutral" data-toggle="tooltip" title="Archive"><i class="icon-folder-open"></i></a>
<a href="javascript:void(0)" class="badge badge-danger" data-toggle="tooltip" title="Delete"><i class="icon-trash"></i></a>
<span class="label label-info">May 20, 2013</span>
<span class="label label-warning">11:00</span>
</h5>
<p>This new idea is really awesome! I can't wait till we get started.. <a href="javascript:void(0)" class="badge badge-inverse">Read more</a></p>
</div>
</div>
<div class="media">
<a href="javascript:void(0)" class="pull-left" data-toggle="tooltip" title="Username">
<img src="<?php echo $app;?>/img/placeholders/image_64x64_dark.png" class="media-object img-circle" alt="Image">
</a>
<div class="media-body">
<h5 class="media-heading">
<a href="javascript:void(0)" class="badge badge-neutral" data-toggle="tooltip" title="Reply"><i class="icon-reply"></i></a>
<a href="javascript:void(0)" class="badge badge-neutral" data-toggle="tooltip" title="Archive"><i class="icon-folder-open"></i></a>
<a href="javascript:void(0)" class="badge badge-danger" data-toggle="tooltip" title="Delete"><i class="icon-trash"></i></a>
<span class="label label-info">May 20, 2013</span>
<span class="label label-warning">10:23</span>
</h5>
<p>This new idea is really awesome! I can't wait till we get started.. <a href="javascript:void(0)" class="badge badge-inverse">Read more</a></p>
</div>
</div>
<div class="media">
<a href="javascript:void(0)" class="pull-left" data-toggle="tooltip" title="Username">
<img src="<?php echo $app;?>/img/placeholders/image_64x64_light.png" class="media-object img-circle" alt="Image">
</a>
<div class="media-body">
<h5 class="media-heading">
<a href="javascript:void(0)" class="badge badge-neutral" data-toggle="tooltip" title="Reply"><i class="icon-reply"></i></a>
<a href="javascript:void(0)" class="badge badge-neutral" data-toggle="tooltip" title="Archive"><i class="icon-folder-open"></i></a>
<a href="javascript:void(0)" class="badge badge-danger" data-toggle="tooltip" title="Delete"><i class="icon-trash"></i></a>
<span class="label label-info">May 20, 2013</span>
<span class="label label-warning">08:35</span>
</h5>
<p>This new idea is really awesome! I can't wait till we get started.. <a href="javascript:void(0)" class="badge badge-inverse">Read more</a></p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
