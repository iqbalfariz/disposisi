<?php
	if(isset($_POST['save'])){
		if(!empty($_POST['kd'])&&!empty($_POST['kd'])&&!empty($_POST['kat'])&&!empty($_POST['jenis'])
			&&!empty($_POST['sifat'])&&!empty($_POST['tgl_masuk'])&&!empty($_POST['tgl_surat'])&&!empty($_POST['perihal'])){
				//getdireksi//
				$kenya=array();
				$ke=$_POST[ke];
				foreach ($_POST['ke'] as $key => $value) {
					$kenya[] = $ke[$key];		

				}
				$disposisi_ke  = implode(",", $kenya);
				//endgetdireksi//
				//insert_data//
				$datetime=date("Y-m-d H:i:s");
				$ipaddress=$_SERVER['REMOTE_ADDR'];

				$sqlsimpan="INSERT into tbl_sekertariat_disposisi (id,nomor_agenda,sifat,jenis,kategori,tgl_terima,pengirim,tgl_surat,no_surat,perihal,user_add,ip_add,waktu_add,ke)
							values(nextval('tbl_sekertariat_disposisi_id_seq'::regclass),'$_POST[kd]','$_POST[sifat]','$_POST[jenis]','$_POST[kat]','$_POST[tgl_masuk]',
								'$_POST[pengirim]','$_POST[tgl_surat]','$_POST[no_surat]','$_POST[perihal]','0','$ipaddress','$datetime','$disposisi_ke')";
				echo $sqlsimpan;
				pg_query($sqlsimpan);
				echo "<script>alert('Diposisi Terkirim...');</script>";
				//endinser_data//
			
			//upload_file//
			 $errors= array();
			 $nomer_agenda=$_POST['kd'];
			foreach($_FILES['img']['tmp_name'] as $key => $tmp_name ){
				$file_name = $key.$_FILES['img']['name'][$key];
				$file_size =$_FILES['img']['size'][$key];
				$file_tmp =$_FILES['img']['tmp_name'][$key];
				$file_type=$_FILES['img']['type'][$key];	
		        		
		        $query="INSERT into tbl_upload_file (id_upload,nomor_agenda,file_name,file_type,file_size) VALUES(nextval('tbl_upload_file_id_upload_seq'::regclass),'$nomer_agenda','$file_name','$file_type','$file_size'); ";
		        $desired_dir="file/".$nomer_agenda;
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
			//endupload_file//
		}
	
	}

?>


 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript">
var app='<?php echo $app;?>';
 $(function() {
$( "#datepicker1" ).datepicker( );
$( "#tgl" ).datepicker();
});
 function tes(id){
		//alert(id);
		var tgl=new Date();
		var tanggal=tgl.toString('yy-MMdd');  
		var no_depan=id;
		var depan=id+"-"+tanggal;
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
</script>
<div class="block block-themed">
	<div class="block-title">
		<div class="block-options">
			<a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="Toggle block's content"><i class="icon-arrow-up"></i></a>
			<a href="javascript:void(0)" class="btn btn-option" data-toggle="tooltip" title="Settings"><i class="icon-cog"></i></a>
		</div>
	<h4>Surat Masuk</h4>
	</div>
		<div class="block-content">
		<form action="" method="post" class="form-horizontal" enctype="multipart/form-data" >
	
		<div class="form-group">
		<label class="control-label col-md-2" for="textarea-default">Pengirim</label>
		<div class="col-md-3">
		
			<select name="pengirim" onchange="tes(this.value)">
				<option></option>
				<?php
					$sql="select * from tbl_kode_pengirim";
					$eks=pg_query($sql);
					while($rs=pg_fetch_array($eks)){
						echo "<option value='".$rs['kode_pengirim']."'>".$rs['pengirim']."</option>";
					}
				?>
				
			</select>
			<span><b>Kode</b></span>
			<span id="kode" style="font-style:italic;"><div id="img"></div></span>
			<input type="hidden" name="kd" id="kd">
		</div>
		</div>
		<div class="form-group">
		<label class="control-label col-md-2">Sifat</label>
		<div class="col-md-3">
			<input type="radio" id="general-themed-radio1"  class="input-themed" name="sifat" value="1">&nbsp; Biasa &nbsp;&nbsp;&nbsp; <input type="radio" id="general-themed-radio1" value="2" class="input-themed" name="sifat">&nbsp; Segera
		</div>
		</div>
		<div class="form-group">
		<label class="control-label col-md-2" for="textarea-medium">Jenis</label>
		<div class="col-md-5">
		 	<input type="radio" value="2" class="input-themed" name="jenis">&nbsp; Asli&nbsp;&nbsp;&nbsp; <input type="radio" class="input-themed" value="2" name="jenis">&nbsp; Copy&nbsp;&nbsp;&nbsp; <input type="radio" class="input-themed" value="2" name="jenis">&nbsp; Tembusan
		</div>
		</div>
		<div class="form-group">
		<label class="control-label col-md-2" for="textarea-large">Kategori</label>
		<div class="col-md-10">
		<input type="radio" class="input-themed" name="kat" value="1">&nbsp; Eksternal &nbsp;&nbsp;&nbsp; <input type="radio" class="input-themed" value="2" name="kat">&nbsp; Internal
		</div>
		</div>
		<div class="form-group">
		<label class="control-label col-md-2" for="textarea-large">Tanggal Masuk Surat</label>
		<div class="col-md-10">
		<div id="datetimepicker1" class="input-append date">
    <input id="tgl"  class="form-control"type="text" name="tgl_masuk"></input>
    <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
  </div>
		</div>
		</div>

		<div class="form-group">
		<label class="control-label col-md-2" for="textarea-large">Tanggal Surat</label>
		<div class="col-md-10">
		<div id="datetimepicker" class="input-append date">
    <input id="datepicker1"  class="form-control"type="text" name="tgl_surat"></input>
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
		<input type="text" class="form-control"  id="general-text" name="no_surat">
		</div>
		</div>
		<div class="form-group">
		<label class="control-label col-md-2" for="textarea-large">Perihal</label>
		<div class="col-md-10">
		<input type="text" class="form-control"  id="general-input-grid3" name="perihal">
		</div>
		</div>
		
		<div class="form-group">
		<label class="control-label col-md-2" for="textarea-large">Lampiran</label>
		<div class="col-md-4">
<input type="file" multiple="" class="form-control" name="img[]" id="file2">
</div>
		</div>
		<div class="form-group">
		<label class="control-label col-md-2">Themed Checkboxes</label>
		<div class="col-md-3">
		<div>
		<?php 
			$sqldisposisi="select * from tbl_jabatan_login where id<=6";
			$eksdisposisi=pg_query($sqldisposisi)or die($sqldisposisi);
			while($rd=pg_fetch_array($eksdisposisi)){
				echo "<label class=''>
					<div class='icheckbox_square-grey' style='position: relative;'><input type='checkbox' value='".$rd['kode_jabatan']."' class='input-themed' name='ke[]' id='general-themed-checkbox2' style='position: absolute; opacity: 0;'><ins class='iCheck-helper' style='position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: none repeat scroll 0% 0% rgb(255, 255, 255); border: 0px none; opacity: 0;'></ins></div>&nbsp;&nbsp;".$rd['kode_jabatan']."
					</label>
					</div>
					<div>";
			}
			$sqldisposisi1="select * from tbl_jabatan_login where id<=6";
			$eksdisposisi1=pg_query($sqldisposisi1)or die($sqldisposisi);
			while($rd1=pg_fetch_array($eksdisposisi1)){
				echo "<label class=''>
					<div class='icheckbox_square-grey' style='position: relative;'><input type='checkbox' value='".$rd1['kode_jabatan']."' class='input-themed' name='ke[]' id='general-themed-checkbox2' style='position: absolute; opacity: 0;'><ins class='iCheck-helper' style='position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: none repeat scroll 0% 0% rgb(255, 255, 255); border: 0px none; opacity: 0;'></ins></div>&nbsp;&nbsp;".$rd1['kode_jabatan']."
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
		<button type="reset" class="btn btn-danger" value="teset"> Reset</button>
		<input type="submit" class="btn btn-success" name="save" value="save"></button>
		</div>
		</div>
		</form>
	</div>
</div>