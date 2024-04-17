<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>jQuery UI Autocomplete - Default functionality</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<script>
$(function() {
	 $.get(app+'/api_check.php', function(data){
	 	//alert(data);
	 	var availableTags = [data];
	 	//alert(availableTags);
$( "#tags" ).autocomplete({
source: availableTags
});
	 });

});
</script>
</head>


<?php
$datetime=date("Y-m-d H:i:s");
					$ipaddress=$_SERVER['REMOTE_ADDR'];
$date=date("Y-m-d H:i:s");
	if(isset($_POST['update'])){
		$tglmasuksrt=TanggalIndo($_POST['tgl_masuk']);
		$tglsurat=TanggalIndo($_POST['tgl_surat']);
		$tglbatassurat=TanggalIndo($_POST['batas']);
		if(!empty($_POST['kd'])&&!empty($_POST['kat'])&&!empty($_POST['jenis'])
			&&!empty($_POST['sifat'])&&!empty($_POST['tgl_masuk'])&&!empty($_POST['tgl_surat'])&&!empty($_POST['perihal'])&&!empty($_POST['ke'])){
			$sqlcekno="select * from tbl_sekertariat_disposisi where nomor_agenda='$_GET[id]'";
			//echo $sqlcekno;
			$ekcekno=pg_query($sqlcekno);

			$rcekno=pg_fetch_array($ekcekno);
			//echo $rcekno['nomor_agenda']."</br>";
			//echo $_POST['kd'];

			$kenya=array();
					$ke=$_POST[ke];
					foreach ($_POST['ke'] as $key => $value) {
						$kenya[] = $ke[$key];
						$sqldis="insert into tbl_disposisi (id_disposisi,nomor_agenda,tgl_masuk_surat,dari,ke,cc,catatan,status,tgl_kirim)
									values(nextval('tbl_disposisi_id_disposisi_seq'::regclass),'$_POST[kd]','$tglmasuksrt','Sekertariat','$ke[$key]','','','0','$date')";
						//echo $sqldis;
						$eks=pg_query($sqldis);	
						$sqlpa="INSERT into tbl_pa(id,nomor_agenda,atasan,dari,tgl_kirim)values(nextval('tbl_pa_id_seq'::regclass),'$_POST[kd]','$ke[$key]','Sekertariat','$date')";
							//echo $sqlpa;
							$ekspa=pg_query($sqlpa);

					}

			if($rcekno['nomor_agenda']==$_POST['kd']){
				$tglmasuksrt=TanggalIndo($_POST['tgl_masuk']);
				$tglsurat=TanggalIndo($_POST['tgl_surat']);
				$tglbatassurat=TanggalIndo($_POST['batas']);
				$tglbatastindak=TanggalIndo($_POST['batas_tindak']);

				$sqlupdate="update tbl_sekertariat_disposisi set 
				jenis='$_POST[jenis]',
				sifat='$_POST[sifat]',
				tgl_surat='$tglsurat',
				no_surat='$_POST[no_surat]',
				perihal='$_POST[perihal]',
				user_update='$_SESSION[id]',
				ip_update='$ipaddress',
				waktu_update='$datetime',
				ke,
				batas_surat,
				bts_tindak_lanjut,
				pengirim_surat
				 ";
			}else{

				//delete
					$dirname=$_GET['id'];
					$sqldelsek="delete from tbl_sekertariat_disposisi where nomor_agenda='$_GET[id]'";
					$ekdesek=pg_query($sqldelsek);
					$sqldeldis="delete from tbl_disposisi where nomor_agenda='$_GET[id]'";
					$ekdedis=pg_query($sqldeldis);
					$sqldelpa="delete from tbl_pa where nomor_agenda='$_GET[id]'";
					$eksdelpa=pg_query($sqldelpa);
					//delete_directory($dirname);

					$dir="/file/".$_GET[id];
					$id=$_GET['id'];
					$nomer_agenda=$_GET['id'];
							    $pengirimnya=substr($nomer_agenda,0,3);
						        $tahunnya=substr($nomer_agenda,4,2);
						        $bulanya=substr($nomer_agenda,7,2);
					//echo $dir;
					rm_folder_recursively('file/'.$pengirimnya."/".$tahunnya."/".$bulanya."/".$nomer_agenda);
				//enddelete

					$kenya=array();
					$ke=$_POST[ke];
					foreach ($_POST['ke'] as $key => $value) {
						$kenya[] = $ke[$key];
						$sqldis="insert into tbl_disposisi (id_disposisi,nomor_agenda,tgl_masuk_surat,dari,ke,cc,catatan,status,tgl_kirim)
									values(nextval('tbl_disposisi_id_disposisi_seq'::regclass),'$_POST[kd]','$tglmasuksrt','Sekertariat','$ke[$key]','','','0','$date')";
						//echo $sqldis;
						$eks=pg_query($sqldis);	
						$sqlpa="INSERT into tbl_pa(id,nomor_agenda,atasan,dari,tgl_kirim)values(nextval('tbl_pa_id_seq'::regclass),'$_POST[kd]','$ke[$key]','Sekertariat','$date')";
							//echo $sqlpa;
							$ekspa=pg_query($sqlpa);

					}
					//echo $kenya;
					$disposisi_ke  = '"'.implode('","',$kenya).'"';
					//echo $disposisi_ke."tesss";
					//endgetdireksi//
					//insert_data//
					$datetime=date("Y-m-d H:i:s");
					$ipaddress=$_SERVER['REMOTE_ADDR'];

					$sqlsimpan="INSERT into tbl_sekertariat_disposisi (id,nomor_agenda,sifat,jenis,kategori,tgl_terima,pengirim,tgl_surat,no_surat,perihal,user_add,ip_add,waktu_add,ke,batas_surat,bts_tindak_lanjut,pengirim_surat)
								values(nextval('tbl_sekertariat_disposisi_id_seq'::regclass),'$_POST[kd]','$_POST[sifat]','$_POST[jenis]','$_POST[kat]','$tglmasuksrt',
									'$_POST[pengirim]','$tglsurat','$_POST[no_surat]','$_POST[perihal]','0','$ipaddress','$datetime','$disposisi_ke','$tglbatassurat','$tglbatastindak','$_POST[pengirim_surat]')";
					//echo $sqlsimpan;
					$ekssimpan=pg_query($sqlsimpan);
					echo "<script>alert('Diposisi Terkirim...');</script>";
					 printf("<script>location.href='$app'</script>");
					//endinser_data//
				
				//upload_file//
				 $errors= array();
				 $nomer_agenda=$_POST['kd'];
				foreach($_FILES['img']['tmp_name'] as $key => $tmp_name ){
					$file_name =$_FILES['img']['name'][$key];
					$file_size =$_FILES['img']['size'][$key];
					$file_tmp =$_FILES['img']['tmp_name'][$key];
					$file_type=$_FILES['img']['type'][$key];	
			        		
			        $query="INSERT into tbl_upload_file (id_upload,nomor_agenda,file_name,file_type,file_size) VALUES(nextval('tbl_upload_file_id_upload_seq'::regclass),'$nomer_agenda','$file_name','$file_type','$file_size'); ";
				    $desired_dir="file/".$nomer_agenda;
				    $pengirimnya=substr($nomer_agenda,0,3);
			        $tahunnya=substr($nomer_agenda,4,2);
			        $bulanya=substr($nomer_agenda,7,2);
			        $desired_dir1=mkdir('file/'.$pengirimnya,0700);
			        $desired_dir2=mkdir('file/'.$pengirimnya.'/'.$tahunnya,0700);
			        $desired_dir3=mkdir('file/'.$pengirimnya.'/'.$tahunnya.'/'.$bulanya,0700);
			        $desired_dir='file/'.$pengirimnya.'/'.$tahunnya.'/'.$bulanya.'/'.$nomer_agenda;
			        if(empty($errors)==true){
			            if(is_dir($desired_dir)==false){
			                mkdir("$desired_dir", 0700);		// Create directory if it does not exist
			            }
			            if(is_dir("$desired_dir/".$file_name)==false){ 
			                move_uploaded_file($file_tmp,"$desired_dir/".$file_name);
			            }else{									// rename the file if another one exist
			                $new_dir="$desired_dir/".$file_name.time();
			                 rename($file_tmp,$new_dir) ;				
			            }
					 pg_query($query);			
			        }else{
			                print_r($errors);
			        }
				}
			}

		
		}else{
			echo "<script>alert('Mohon Lengkapi Isian ')</script>";
		}
	
	}


if(isset($_POST['back'])){
	printf("<script>location.href='$app'</script>");
}
?>


 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript">
var app='<?php echo $app;?>';
 $(function() {
$( "#datepicker1" ).datepicker();
$( "#batassurat" ).datepicker();
$( "#tgl" ).datepicker();

});
 function tes(id){
		//alert(id);
		var tgl=new Date();
		var tanggal=tgl.toString('yy-MMdd');  
		var tgl_surat_masuk=document.getElementById('tgl').value;
		var hari=tgl_surat_masuk.substr(3,2);
		var bulan=tgl_surat_masuk.substr(0,2);
		var tahun=tgl_surat_masuk.substr(8,4);
		//alert(tgl_surat_masuk);
		var no_depan=id;
		var depan=id+"-"+tahun+"-"+bulan+hari;
		//alert(app);
			//Internal tampungdata;
			//int tampungdata;
			//var dataya=load('http://localhost/aplikasi_surat/api_getkode.php?id='+depan);
			$.get(app+'/api_getkode.php?id='+depan, function(data){
				//document.getElementById('kode').load('<img src="http://localhost/aplikasi_surat/img/load.gif">');
  				//alert("Data: " + data);
				
		//var val.load('http://localhost/aplikasi_surat/api_getkode.php?id='+depan);
		document.getElementById('kd').value=depan+"-"+data;

		document.getElementById('kode').innerHTML=depan+"-"+data;
		});
		
	}
function sphide(radiobtn){
	if(radiobtn.checked){
		//alert('tes');
		document.getElementById("DU").style.display="none";
		document.getElementById("DO.I").style.display="none";
		document.getElementById("DO.II").style.display="none";
		document.getElementById("DK").style.display="none";
		document.getElementById("DSU").style.display="none";
		document.getElementById("DP").style.display="none";
			
	}else{
		document.getElementById("DU").style.display="inline";
		document.getElementById("DO.I").style.display="inline";
		document.getElementById("DO.II").style.display="inline";
		document.getElementById("DK").style.display="inline";
		document.getElementById("DSU").style.display="inline";
		document.getElementById("DP").style.display="inline";
	}
}

function spshow(radiobtn){
	if(radiobtn.checked){
		document.getElementById("DU").style.display="inherit";
		document.getElementById("DO.I").style.display="inherit";
		document.getElementById("DO.II").style.display="inherit";
		document.getElementById("DK").style.display="inherit";
		document.getElementById("DSU").style.display="inherit";
		document.getElementById("DP").style.display="inherit";
		/*
		document.getElementById("DU").style.display="inline";
		document.getElementById("DO.I").style.display="inline";
		document.getElementById("DO.II").style.display="inline";
		document.getElementById("DK").style.display="inline";
		document.getElementById("DSU").style.display="inline";
		document.getElementById("DP").style.display="inline";	
		*/
	}

}
function kate(val){
	  $("#pengirim").html('<img src="img/load.gif"> Load...');
	$("#pengirim").load(app+"/api_combo.php?id="+val)

}

</script>
<style type="text/css">
input[type=radio].css-checkbox {
							display:none;
						}

						input[type=radio].css-checkbox + label.css-label {
							padding-left:27px;
							height:22.5px; 
							display:inline-block;
							line-height:22px;
							background-repeat:no-repeat;
							background-position: 0 0;
							font-size:12px;
							vertical-align:middle;
							cursor:pointer;

						}

						input[type=radio].css-checkbox:checked + label.css-label {
							background-position: 0 -22px;
						}
						label.css-label {
				background-image:url(img/csscheckbox_6488f6625f8516801043511b8be871c2.png);
				-webkit-touch-callout: none;
				-webkit-user-select: none;
				-khtml-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				user-select: none;
			}
</style>
<link rel="stylesheet" href="<?php echo $app;?>/css/style.css"/>
<?php
	$sqledit="select * from tbl_sekertariat_disposisi where nomor_agenda='$_GET[id]'";
	//echo $sqledit;
	$eksedit=pg_query($sqledit);
	$redit=pg_fetch_array($eksedit);
	$tgl_masuk=$redit['tgl_terima'];
	//echo $tgl_masuk."</br>";
	//echo TanggalLuar($tgl_masuk);
?>
<div class="block block-themed">

	<div class="block-title">
		<div class="block-options">
			<a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="Toggle block's content"></a>
			<a href="javascript:void(0)" class="btn btn-option" data-toggle="tooltip" title="Settings"></a>
		</div>
	<h4>Surat Masuk</h4>
	</div>
		<div class="block-content">
		<form action="" method="post" class="form-horizontal" enctype="multipart/form-data" >
			<div class="form-group">
		<label class="control-label col-md-2" for="textarea-large">Tanggal Masuk Surat</label>
		<div class="col-md-10">
		<div id="datetimepicker1" class="input-append date">
		    <input id="tgl"  class="form-control"type="text" value="<?php if(isset($_GET['edit'])){echo TanggalLuar($tgl_masuk);}else{ echo $_POST['tgl_masuk'];}?>" name="tgl_masuk"></input>
		    <span class="add-on">
		      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
		      </i>
		    </span>
		  </div>
		</div>
		</div>

		<div class="form-group">
		<label class="control-label col-md-2" for="textarea-large">Kategori</label>
		<div class="col-md-5">
			<?php
				if($redit['kategori']=="1"){
					$stckd1='checked="checked"';
				}else{
					$stckd2='checked="checked"';
				}
			?>
			<input type="radio" name="kat" onclick="kate(this.value)" id="eks" <?php echo $stckd1;?>   class="css-checkbox" value="1" /><label style="margin:5px;" for="eks" class="css-label">External</label>
			<input type="radio" name="kat" onclick="kate(this.value)" id="int" <?php echo $stckd2;?>  class="css-checkbox" value="2" /><label style="margin:5px;" for="int" class="css-label">Internal</label>
			
			<!--
			<input type="radio" class="input-themed" name="kat" value="1">&nbsp; Eksternal &nbsp;&nbsp;&nbsp; <input type="radio" class="input-themed" value="2" name="kat">&nbsp; Internal
			-->
		</div>
		</div>

		<div class="form-group">
		<label class="control-label col-md-2" for="textarea-default">Odner</label>
		<div class="col-md-3">
			<span id="pengirim" >
			<select name="pengirim"  onchange="tes(this.value)">
				
				<?php
					if(isset($_GET['edit'])){
						$sql="select * from tbl_kode_pengirim where kode_pengirim='".$redit['pengirim']."'";
					}else{
						echo "<option></option>";
						$sql="select * from tbl_kode_pengirim";
				
					}	
					$eks=pg_query($sql);
					while($rs=pg_fetch_array($eks)){
						echo "<option value='".$rs['kode_pengirim']."'>".$rs['pengirim']."</option>";
					}
					if($redit['kategori']=="1"){
						echo "tes";
						$sqledit="select * from tbl_kode_pengirim where jenis='1' and kode_pengirim !='".$redit['pengirim']."'";
						$ekse=pg_query($sqledit);
						while($rse=pg_fetch_array($ekse)){
							echo "<option value='".$rse['kode_pengirim']."'>".$rse['pengirim']."</option>";
						}
					}else{

						$sqledit="select * from tbl_kode_pengirim where and jenis='2' and kode_pengirim !='".$redit['pengirim']."'";
						$ekse=pg_query($sqledit);
						while($rse=pg_fetch_array($ekse)){
							echo "<option value='".$rse['kode_pengirim']."'>".$rse['pengirim']."</option>";
						}
					}

				?>
				
			</select>
			</span>
			</br><span><b>Kode</b></span>
			<span id="kode" style="font-style:italic;"><?php echo $redit['nomor_agenda'];?><div id="img"></div></span>
			<input type="hidden" name="kd" value="<?php echo $redit['nomor_agenda'];?>" id="kd">
		</div>
		</div>
		<div class="form-group">
		<label class="control-label col-md-2" for="textarea-large">Pengirim</label>
		<div class="col-md-10">
		<input type="text" class="form-control" value="<?php echo $redit['pengirim_surat'];?>"  id="general-input-grid3" name="pengirim_surat">
		</div>
		</div>
		<div class="form-group">
		<label class="control-label col-md-2">Sifat</label>
		<div class="col-md-4">
			<?php
				if($redit['sifat']=="1"){
					$stckds1='checked="checked"';
				}elseif($redit['sifat']=="2"){
					$stckds2='checked="checked"';
				}elseif($redit['sifat']=="3"){
					$stckds3='checked="checked"';
				}
			?>
			<input type="radio" name="sifat" onclick="spshow(this)" id="radiob" <?php echo $stckds1;?>  class="css-checkbox" value="1" /><label style="margin:5px;" for="radiob" class="css-label">Biasa</label>
			<input type="radio" name="sifat" onclick="spshow(this)" id="radios" <?php echo $stckds2;?> class="css-checkbox" value="2" /><label style="margin:5px;" for="radios" class="css-label">Segera</label>
			<input type="radio" name="sifat" onclick="sphide(this)" id="radiou" <?php echo $stckds3;?> class="css-checkbox" value="3" /><label style="margin:5px;" for="radiou" class="css-label">Umum</label>
			<!--
			<input type="radio" id="general-themed-radio1"  class="input-themed" name="sifat" value="1">&nbsp; Biasa &nbsp;&nbsp;&nbsp; <input type="radio" id="general-themed-radio1" value="2" class="input-themed" name="sifat">&nbsp; Segera&nbsp;&nbsp;&nbsp;<input type="radio" id="general-themed-radio1" value="3" onclick="sphide(this)" class="input-themed" name="sifat">&nbsp; Umum
				-->	
		</div>
		</div>
		<div class="form-group">
		<label class="control-label col-md-2" for="textarea-medium">Jenis</label>
		<div class="col-md-5">
			<?php
				if($redit['jenis']=="1"){
					$stckdj1='checked="checked"';
				}elseif($redit['jenis']=="2"){
					$stckdj2='checked="checked"';
				}elseif($redit['jenis']=="3"){
					$stckdj3='checked="checked"';
				}
			?>
			<input type="radio" name="jenis" id="asli" class="css-checkbox" <?php echo $stckdj1;?> value="1" /><label style="margin:5px;" for="asli" class="css-label">Asli</label>
			<input type="radio" name="jenis" id="copy" class="css-checkbox" <?php echo $stckdj2;?> value="2" /><label style="margin:5px;" for="copy" class="css-label">Copy</label>
			<input type="radio" name="jenis" id="cc" class="css-checkbox" <?php echo $stckdj3;?> value="3" /><label style="margin:5px;" for="cc" class="css-label">Tembusan</label>
					
			
			<!--
		 	<input type="radio" value="2" class="iput-themed" name="jenis">&nbsp; Asli&nbsp;&nbsp;&nbsp; <input type="radio" class="input-themed" value="2" name="jenis">&nbsp; Copy&nbsp;&nbsp;&nbsp; <input type="radio" class="input-themed" value="2" name="jenis">&nbsp; Tembusan
			-->
		</div>
		</div>
		
		

		<div class="form-group">
		<label class="control-label col-md-2" for="textarea-large">Tanggal Surat</label>
		<div class="col-md-10">
		<div id="datetimepicker" class="input-append date">
    <input id="datepicker1"  class="form-control"type="text" value="<?php if(isset($_GET['edit'])){echo TanggalLuar($redit['tgl_surat']);}else{echo $_POST['tgl_surat'];}?>" name="tgl_surat"></input>
    <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
  </div>
		</div>
		</div>


		<div class="form-group">
		<label class="control-label col-md-2" for="textarea-large">Batas Waktu Surat</label>
		<div class="col-md-10">
		<div id="datetimepicker" class="input-append date">
    <input id="batassurat"  class="form-control"type="text" value="<?php if(isset($_GET['edit'])){ echo TanggalLuar($redit['batas_surat']);}else{ echo $_POST['batas'];}?>" name="batas"></input>
    <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
  </div>
		</div>
		</div>
		<div class="form-group">

		<label class="control-label col-md-2" for="textarea-large">No Surat</label>
		<div class="col-md-10">
		<input type="text" class="form-control" value="<?php if(isset($_GET['edit'])){echo $redit['no_surat'];}else{ echo $_POST['no_surat'];}?>" id="tags" name="no_surat">
		</div>
		</div>
		<div class="form-group">
		<label class="control-label col-md-2" for="textarea-large">Perihal</label>
		<div class="col-md-10">
		<input type="text" class="form-control" value="<?php if(isset($_GET['edit'])){echo $redit['perihal'];}else{ echo $_POST['perihal'];}?>"  id="general-input-grid3" name="perihal">
		</div>
		</div>
		
		<div class="form-group">
		<label class="control-label col-md-2" for="textarea-large">Lampiran</label>
		<div class="col-md-4">
<input type="file" multiple="" class="form-control" name="img[]" id="file2">
</div>
		</div>
		<div class="form-group">
		<label class="control-label col-md-2">Distribusi Ke</label>
		<div class="col-md-3">
		<div>
		<?php 
			$kode=$redit['ke'];
			$dr=str_replace('"',"'",$kode);
			//echo $dr;
			$sqldisposisi="select * from tbl_jabatan_login where kode_jabatan IN($dr) order by id asc";
			//echo $sqldisposisi;
			$eksdisposisi=pg_query($sqldisposisi)or die($sqldisposisi);
			while($rd=pg_fetch_array($eksdisposisi)){
				echo "<label class='' id='".$rd['kode_jabatan']."'>
					<div class='icheckbox_square-grey' style='position: relative;'><input type='checkbox' checked='checked' value='".$rd['kode_jabatan']."' class='input-themed' name='ke[]' id='general-themed-checkbox2' style='position: absolute; opacity: 0;'><ins class='iCheck-helper' style='position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: none repeat scroll 0% 0% rgb(255, 255, 255); border: 0px none; opacity: 0;'></ins></div>&nbsp;&nbsp;".$rd['kode_jabatan']."
					</label>
					</div>
					<div>";
					
			}
			$sqldisposisino="select * from tbl_jabatan_login where id<=7 and kode_jabatan!='admin' and unit_kerja!='PA' and kode_jabatan NOT IN($dr) order by id asc";
					//echo $sqldisposisino;
					$eksdisposisino=pg_query($sqldisposisino)or die($sqldisposisino);
					while($rdno=pg_fetch_array($eksdisposisino)){
					echo "<label class='' id='".$rdno['kode_jabatan']."'>
					<div class='icheckbox_square-grey' style='position: relative;'><input type='checkbox'  value='".$rdno['kode_jabatan']."' class='input-themed' name='ke[]' id='general-themed-checkbox2' style='position: absolute; opacity: 0;'><ins class='iCheck-helper' style='position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: none repeat scroll 0% 0% rgb(255, 255, 255); border: 0px none; opacity: 0;'></ins></div>&nbsp;&nbsp;".$rdno['kode_jabatan']."
					</label>
					</div>
					<div>";
					}

		?>
		
	
		</div>
		</div>
		</div>
		
		<div class="form-group form-actions">
		<div class="col-md-10 col-md-offset-2">
		<input type="submit" class="btn btn-danger" name="back" value="Cancel"></button>
		<input type="submit" class="btn btn-success" name="update" value="Update"></button>
		</div>
		</div>
		
		</form>
	</div>
</div>

