	<?php
//print_r($_SESSION);
if($_SESSION['jabatan']=="SP"){
$numcek=1;
}else{
$cekbawahan="select * from tbl_jabatan_login where kategori='".$_SESSION['id']."'";
//echo $cekbawahan;
	$ekcekbawahan=pg_query($cekbawahan);
	$numcek=pg_num_rows($ekcekbawahan);
}
//print_r($_SESSION);	
$date=date("Y-m-d H:i:s");
	$sqlupdate="update tbl_disposisi set tgl_baca='$date',status='3' where nomor_agenda='$_GET[id]' and ke='$_SESSION[uname]' ";
	//echo $sqlupdate;
	$eksupdatedis=pg_query($sqlupdate);
		//echo $sqlupdate;
	$sqlgetdata="select * from tbl_disposisi where nomor_agenda='$_GET[id]' and ke='$_SESSION[uname]'";
	//echo $sqlgetdata;
	$ekgetdata=pg_query($sqlgetdata);
	$rgetdata=pg_fetch_array($ekgetdata);

	
	if(isset($_POST['save'])){
		if(!empty($_POST['status'])){
			if($_POST['status']=="1" &&!empty($_POST['ke'])&&!empty($_POST['dis'])){	
				$sqlupdatetindak="update tbl_disposisi set tgl_tindak_lanjut='$date' where nomor_agenda='$_GET[id]' and ke='$_SESSION[uname]'";
					//echo $sqlupdatetindak;
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


						//disposisi per lantai //
						$sqlgm="select * from tbl_jabatan_login where kode_jabatan='$ke[$di]'";
						$rgm=pg_fetch_array(pg_query($sqlgm));
						$tglnow=date("Y-m-d");
						if($rgm['lantai']!=""){
							$sqlseker="insert into tbl_sekertaris_lantai(id,nomor_agenda,lantai,gm,tgl_kirim) values(nextval('tbl_sekertaris_lantai_id_seq'::regclass),'$_GET[id]',
									'$rgm[lantai]','$ke[$di]','$tglnow')";
							$ekseker=pg_query($sqlseker);
							//echo $sqlseker;
						}

						$sqlgm="select * from tbl_jabatan_login where kode_jabatan='$ke[$di]'";
						$ekgm=pg_query($sqlgm);
						$rgm=pg_fetch_array($ekgm);
						if($rgm['lantai']==""){
							
						}
						$sqlpa="INSERT into tbl_pa(id,nomor_agenda,atasan,dari,tgl_kirim,catatan)values(nextval('tbl_pa_id_seq'::regclass),'$_GET[id]','$ke[$di]','$_SESSION[uname]','$date','$_POST[catatan]')";
					//echo $sqlpa;
						$ekspa=pg_query($sqlpa);
						//Gateway
						$sqlceknomer="select * from tbl_jabatan_login where kode_jabatan='$ke[$di]'";
						//echo $sqlceknomer;
						$eksceknomer=pg_query($sqlceknomer)or die(pg_last_error());
						$rcekno=pg_fetch_array($eksceknomer); 
						require_once('gateway/smsclass.php'); // panggil class  
						ob_start();
						$smsusername = 'zikri'; // username 
						$smspassword = 'zikri';     // password 
						$apikey      = '8c1223ae45917879d1f49a7c48dfd7f5';
						//$nohp="082125531718";
						$nohp=$rcekno['no_telp'];
						$to_mail=$rcekno['email'];
						//$nohp  = "08161969144";
						//$nohp="085782878729";
						$link="http://disposisi.hutama-karya.com";
						$pesan = "Anda   Mendapatkan Disposisi Dari ".$_SESSION[uname]." Dengan Nomor Agenda ".$_POST['kd']." untuk ".$ke[$key]." Buka Link Berikut ".$link;
						$sms = new smsreguler();
						$sms->username = $smsusername;
						$sms->password = $smspassword;
						$sms->apikey   = $apikey;
						$sms->setTo($nohp);
						$sms->setText($pesan);
						if($nohp!=""){
						$sts=$sms->smssend();
						}
						//echo $to_mail;
						if($to_mail!=""){
						$email="disposisi@hk.co.id" ;
						@mail("$to_mail","Pemberitahuan Disposisi",$pesan,"From:$email")or die("Email Bermasalah");
						}
	

					}
					$sqlupdate="update tbl_disposisi set status='0' where nomor_agenda='$_GET[id]' and ke='$_SESSION[uname]' ";
		pg_query($sqlupdate);
					echo "<script>alert('Disposisi Terkirim...')</script>";
				printf("<script>location.href='$app?menu=listfront'</script>");
			}elseif($_POST['status']=="2"){
				$sqldone="insert into tbl_disposisi (id_disposisi,nomor_agenda,tgl_masuk_surat,dari,catatan,status)
									values(nextval('tbl_disposisi_id_disposisi_seq'::regclass),'$_GET[id]','".$rgetdata['tgl_masuk_surat']."','$_SESSION[uname]','$_POST[catatan]','1')";
				//echo $sqldone;
				$tgl_tindak=date("Y-m-d H:i:s");
				$sqlup="update tbl_disposisi set tgl_tindak_lanjut='$tgl_tindak' , status='1' where nomor_agenda='$_GET[id]' and ke='$_SESSION[uname]'";
				pg_query($sqlup);
				$eksdone=pg_query($sqldone);
								foreach($_FILES['filenya']['tmp_name'] as $key => $tmp_name ){
					$file_name =$_FILES['filenya']['name'][$key];
					$file_size =$_FILES['filenya']['size'][$key];
					$file_tmp =$_FILES['filenya']['tmp_name'][$key];
					$file_type=$_FILES['filenya']['type'][$key];
				$nomer_agenda=$_GET['id'];
				if($file_name!=""){
				$queryupload="INSERT into tbl_upload_file (id_upload,nomor_agenda,file_name,file_type,file_size) VALUES(nextval('tbl_upload_file_id_upload_seq'::regclass),'$_GET[id]','$file_name','$file_type','$file_size'); ";
				//echo $queryupload;
				}
				$ekupload=pg_query($queryupload);
				$desired_dir="file/".$nomer_agenda;
				    $pengirimnya=substr($nomer_agenda,0,3);
			        $tahunnya=substr($nomer_agenda,4,2);
			        $bulanya=substr($nomer_agenda,7,2);
			        $desired_dir='file/'.$pengirimnya.'/'.$tahunnya.'/'.$bulanya.'/'.$nomer_agenda;	
				//echo $desired_dir;
				if(is_dir("$desired_dir/".$file_name)==false){ 
			                move_uploaded_file($file_tmp,"$desired_dir/".$file_name) or die("error");					
					chmod($desired_dir."/".$file_name,0777);
			            }else{									// rename the file if another one exist
			                $new_dir="$desired_dir/".$file_name.time();
			                 rename($file_tmp,$new_dir) ;				
			            }
				//move_uploaded_file($file_tmp,"$desired_dir/".$file_name) or die("error");
						
				}
				
	
				$sqlupdate="update tbl_disposisi set status='0'  where nomor_agenda='$_GET[id]' and ke='$_SESSION[uname]' ";
		pg_query($sqlupdate);
			echo "<script>alert('Disposisi Done...')</script>";
			printf("<script>location.href='$app?menu=listfront'</script>");
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
				document.getElementById('lampiran').style.display = 'none';
		}else{	
			    document.getElementById('disposisi').style.display = 'none';
			    document.getElementById('lampiran').style.display = '';
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
	function cekall(isi){
		var remember = document.getElementById(isi);
    			if (remember.checked){
        			//alert("checked") ;
				document.getElementById('DO.I').checked = true;
				document.getElementById('DO.II').checked = true;
				document.getElementById('DK').checked = true;
				document.getElementById('DSU').checked = true;
				document.getElementById('DP').checked = true;
    			}else{
     				  // alert("You didn't check it! Let me check it for you.")
				document.getElementById('DO.I').checked = false;
				document.getElementById('DO.II').checked = false;
				document.getElementById('DK').checked = false;
				document.getElementById('DSU').checked = false;
				document.getElementById('DP').checked = false;
   			}
			
			
		
		
	}
	function cekallgm(isi){
		var remember = document.getElementById(isi);
    			if (remember.checked){
        			//alert("checked") ;
				document.getElementById('GMDG').checked = true;
				document.getElementById('GMSU').checked = true;
				document.getElementById('GMAK').checked = true;
				document.getElementById('GMEPC').checked = true;
				document.getElementById('GMPJT').checked = true;
				document.getElementById('GMDJJ').checked = true;
				document.getElementById('GMKU').checked = true;
				document.getElementById('GMSR').checked = true;
				document.getElementById('GMPBS').checked = true;
				document.getElementById('GMTP').checked = true;
				document.getElementById('GMMR').checked = true;
				document.getElementById('GMW1').checked = true;
				document.getElementById('GMW2').checked = true;
				document.getElementById('GMW3').checked = true;
				document.getElementById('GMW4').checked = true;
				document.getElementById('GMW5').checked = true;
				document.getElementById('GMW6').checked = true;
				document.getElementById('GMW7').checked = true;
				document.getElementById('HKPOLE').checked = true;
				document.getElementById('HKR').checked = true;
				document.getElementById('HKASTON').checked = true;
				document.getElementById('SP').checked = true;
				document.getElementById('SPI').checked = true;
				document.getElementById('allgmw').checked = false;
				document.getElementById('allgmp').checked = false;
				document.getElementById('allgmap').checked = false;
    			}else{
     				document.getElementById('GMDG').checked = false;
				document.getElementById('GMSU').checked = false;
				document.getElementById('GMAK').checked = false;
				document.getElementById('GMEPC').checked = false;
				document.getElementById('GMPJT').checked = false;
				document.getElementById('GMDJJ').checked = false;
				document.getElementById('GMKU').checked = false;
				document.getElementById('GMSR').checked = false;
				document.getElementById('GMPBS').checked = false;
				document.getElementById('GMTP').checked = false;
				document.getElementById('GMMR').checked = false;
				document.getElementById('GMW1').checked = false;
				document.getElementById('GMW2').checked = false;
				document.getElementById('GMW3').checked = false;
				document.getElementById('GMW4').checked = false;
				document.getElementById('GMW5').checked = false;
				document.getElementById('GMW6').checked = false;
				document.getElementById('GMW7').checked = false;
				document.getElementById('HKPOLE').checked = false;
				document.getElementById('HKR').checked = false;
				document.getElementById('HKASTON').checked = false;
				document.getElementById('SP').checked = false;
				document.getElementById('SPI').checked = false;
   			}
			
			
		
		
	}

function cekallgmp(isi){
		var remember = document.getElementById(isi);
    			if (remember.checked){
        			//alert("checked") ;
				//document.getElementById('GMDG').checked = true;
				document.getElementById('GMSU').checked = true;
				document.getElementById('GMAK').checked = true;
				document.getElementById('SP').checked = true;
				document.getElementById('SPI').checked = true;
				document.getElementById('GMKU').checked = true;
				document.getElementById('GMSR').checked = true;
				document.getElementById('GMPBS').checked = true;
				document.getElementById('GMTP').checked = true;
				document.getElementById('GMMR').checked = true;
				document.getElementById('GMPJT').checked = true;
				
			
    			}else{
     				
				document.getElementById('GMSU').checked = false;
				document.getElementById('GMAK').checked = false;
				document.getElementById('SP').checked = false;
				document.getElementById('SPI').checked = false;
				document.getElementById('GMKU').checked = false;
				document.getElementById('GMSR').checked = false;
				document.getElementById('GMPBS').checked = false;
				document.getElementById('GMTP').checked = false;
				document.getElementById('GMMR').checked = false;
				document.getElementById('GMPJT').checked = false;
				

			
   			}
			
			
		
		
	}
function cekallgmw(isi){
		var remember = document.getElementById(isi);
    			if (remember.checked){
        			//alert("checked") ;
				
				document.getElementById('GMW1').checked = true;
				document.getElementById('GMW2').checked = true;
				document.getElementById('GMW3').checked = true;
				document.getElementById('GMW4').checked = true;
				document.getElementById('GMW5').checked = true;
				document.getElementById('GMW6').checked = true;
				document.getElementById('GMW7').checked = true;
				document.getElementById('GMDG').checked = true;
				document.getElementById('GMEPC').checked = true;
				document.getElementById('GMDJJ').checked = true;
				
				
    			}else{
     				document.getElementById('GMW1').checked = false;
				document.getElementById('GMW2').checked = false;
				document.getElementById('GMW3').checked = false;
				document.getElementById('GMW4').checked = false;
				document.getElementById('GMW5').checked = false;
				document.getElementById('GMW6').checked = false;
				document.getElementById('GMW7').checked = false;
				document.getElementById('GMDG').checked = false;
				document.getElementById('GMEPC').checked = false;
				document.getElementById('GMDJJ').checked = false;
				

				
   			}
			
			
		
		
}
function cekallgmap(isi){
		var remember = document.getElementById(isi);
    			if (remember.checked){
        			//alert("checked") ;
				
				document.getElementById('HKPOLE').checked = true;
				document.getElementById('HKR').checked = true;
				document.getElementById('HKASTON').checked = true;
				
    			}else{
     			
				document.getElementById('HKPOLE').checked = false;
				document.getElementById('HKR').checked = false;
				document.getElementById('HKASTON').checked = false;
				
   			}
			
			
		
		
	}



    </script>
	<link rel="stylesheet" href="<?php echo $app;?>/css/style.css"/>
<div class="block block-themed block-last">
<div class="block-title">
<h4>Detail Surat Masuk</h4>
</div>
<div class="block-content">
<form action="" class="form-horizontal" method="post" enctype="multipart/form-data" >
<h4 class="sub-header">Surat Masuk</h4>
<div class="form-group">
<label class="control-label col-md-2">Jenis</label>
<div class="col-md-3">
<p class="form-control-static"><b><?php if($rs['jenis']=="1"){echo "Asli";}elseif($rs['jenis']=="2"){echo "Copy";}else{echo "Tembusan";}?></b></p>
</div>
<label class="control-label col-md-2">Sifat</label>
<div class="col-md-3">
<p class="form-control-static"><b><?php if($rs[sifat]=="1"){echo "<b>Biasa</b>";}else{echo "<b style='color:red;'>Segera</b>";}?></b></p>
</div>
</div>
<div class="form-group">
<label class="control-label col-md-2">Diterima Sekertariat</label>
<div class="col-md-3">
<p class="form-control-static"><b><?php echo substr($rs[tgl_terima],8,2)."-".substr($rs[tgl_terima],5,2)."-".substr($rs[tgl_terima],0,4);?></b></p>
</div>
<label class="control-label col-md-2">Pengirim</label>
<div class="col-md-3">
<p class="form-control-static"><b><?php echo $rs[kiriman_dari];?></b></p>
</div>
</div><div class="form-group">
<label class="control-label col-md-2">Tanggal Surat</label>
<div class="col-md-3">
<p class="form-control-static"><b><?php echo substr($rs[tgl_surat],8,2)."-".substr($rs[tgl_surat],5,2)."-".substr($rs[tgl_surat],0,4);?></b></p>
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
<label class="control-label col-md-2">Tindak Lanjut</label>
<div class="col-md-3">
<p class="form-control-static"><select name="status" onchange="rubah(this.value)">
	<option>-Pilih Tindak Lanjut-</option>
	<?php if($numcek==0){
	}else{
	?>
	<option value="1">Disposisi</option>
	<?php
		}	
	?>
	<option value="2">Done</option></select></p>
</div>
<label class="control-label col-md-2">File</label>
<div class="col-md-3">
	
<p class="form-control-static">
	<?php
		$sqlgetfile="select * from tbl_upload_file where nomor_agenda='$_GET[id]'";
		$ekgetfile=pg_query($sqlgetfile);
		while($rfile=pg_fetch_array($ekgetfile)){
			$nomer_agenda=$_GET['id'];
				    $pengirimnya=substr($nomer_agenda,0,3);
			        $tahunnya=substr($nomer_agenda,4,2);
			        $bulanya=substr($nomer_agenda,7,2);
			        
	?>
	<a href="<?php echo $app;?>/file/<?php echo $pengirimnya."/".$tahunnya."/".$bulanya."/".$_GET[id];?>/<?php echo $rfile[file_name];?>" onclick="window.open('<?php echo $app;?>/file/<?php echo $pengirimnya."/".$tahunnya."/".$bulanya."/".$_GET[id];?>/<?php echo $rfile[file_name];?>','popup','width=900,height=900,scrollbars=no,resizable=no,toolbar=no,directories=no,location=no,menubar=no,status=no,left=100%,top=-500%'); return false"><img src="<?php echo $app;?>/img/pdf.png"></a>
	<?php
		}
	?>
</p>

</div>
</div>
<style type="text/css">
.sumput{
	display: none;
}
</style>
<div>
<?php
	
	if($numcek==0){

?>

<div class="form-group">
	<div class="block-title">
<h6>HISTORY CATATAN DISPOSISI</h6>
</div>
<label class="control-label col-md-2">Disposisi:</label>
<div class="col-md-3">
	<?php
		$sqldisposisinya="select * from tbl_keterangan_disposisi where id IN(".$rgetdata[keterangan].")";
		//echo $sqldisposisinya;
		$ekdisposisinya=pg_query($sqldisposisinya);
		while($rdnya=pg_fetch_array($ekdisposisinya)){
	?>
<p class="form-control-static"><?php echo $rdnya['ket'];?></p>
	<?php
		}
	?>
</div>

</div>
<?php



	$sqld="select * from tbl_disposisi where nomor_agenda='$_GET[id]'  order by id_disposisi asc";
	//echo $sqld;
	$eksd=pg_query($sqld);
	while($rd=pg_fetch_array($eksd)){

		$sqldr="select * from tbl_disposisi where nomor_agenda='$_GET[id]' and ke='$_SESSION[uname]' order by id_disposisi asc";
		//echo $sqldr;
	$eksdr=pg_query($sqldr);
	$rdr=pg_fetch_array($eksdr);

	$sqldk="select dari from tbl_disposisi where nomor_agenda='$_GET[id]' and ke='".$rdr['ke']."' or dari='".$rdr['ke']."' and dari ='".$rdr['dari']."' or ke='".$rdr['dari']."'  group by dari";
	//echo $sqldk;
	$eksdk=pg_query($sqldk);
	while($rdk=pg_fetch_array($eksdk)){
	}
	//if($rdk['dari']=="sekertariat"){

	//}else{
?>
<div class="form-group">
<label  class="control-label col-md-2"><?php if($rd['dari']=="Sekertariat"){echo "CATATAN DISPOSISI:";}else{ echo "</br>"; } ?></label>
<div class="col-md-5">
<p class="form-control-static"><?php echo "-&nbsp;".$rd['dari'];?> Ke <?php echo $rd['ke'];?>&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $rd['catatan'];?></p>
</div>

</div>

<?php
//}
	}
?>



<div>


<?php
}
?>



<div id="disposisi" style="display:none;">

<div class="form-group">
	<div class="block-title">
<h6>HISTORY CATATAN DISPOSISI</h6>
</div>
<label class="control-label col-md-2">Disposisi:</label>
<div class="col-md-3">
	<?php
		$sqldisposisinya="select * from tbl_keterangan_disposisi where id IN(".$rgetdata[keterangan].")";
		//echo $sqldisposisinya;
		$ekdisposisinya=pg_query($sqldisposisinya);
		while($rdnya=pg_fetch_array($ekdisposisinya)){
	?>
<p class="form-control-static"><?php echo $rdnya['ket'];?></p>
	<?php
		}
	?>
</div>

</div>
<?php



	$sqld="select * from tbl_disposisi where nomor_agenda='$_GET[id]'  order by id_disposisi asc";
	//echo $sqld;
	$eksd=pg_query($sqld);
	while($rd=pg_fetch_array($eksd)){

		$sqldr="select * from tbl_disposisi where nomor_agenda='$_GET[id]' and ke='$_SESSION[uname]' order by id_disposisi asc";
		//echo $sqldr;
	$eksdr=pg_query($sqldr);
	$rdr=pg_fetch_array($eksdr);

	$sqldk="select dari from tbl_disposisi where nomor_agenda='$_GET[id]' and ke='".$rdr['ke']."' or dari='".$rdr['ke']."' and dari ='".$rdr['dari']."' or ke='".$rdr['dari']."'  group by dari";
	//echo $sqldk;
	$eksdk=pg_query($sqldk);
	while($rdk=pg_fetch_array($eksdk)){
	}
	//if($rdk['dari']=="sekertariat"){

	//}else{
?>
<div class="form-group">
<label  class="control-label col-md-2"><?php if($rd['dari']=="Sekertariat"){echo "CATATAN DISPOSISI:";}else{ echo "</br>"; } ?></label>
<div class="col-md-5">
<p class="form-control-static"><?php echo "-&nbsp;".$rd['dari'];?> Ke <?php echo $rd['ke'];?>&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $rd['catatan'];?></p>
</div>

</div>

<?php
//}
	}
?>



<div>


<div class="form-group" >
	<div class="block-title">
<h6>ALUR DISPOSISI</h6>
</div>
<div class="col-md-15">
<p>
<?php
	if($_SESSION['uname']=="DU"){
?>
	<ul style="list-style:none;background-color:#dedede;" >
		<li><input type='checkbox' value='SD' id='SD' name='ke[]' onclick='cekall(this.id)'  class='css-checkbox lrg'/>
			<label for='SD'  name='checkbox69_lbl' class='css-label lrg vlad'>Seluruh Direksi</label></li>
	</ul>
	<ul style="list-style:none;margin-left:20px;float:left;">
		<li>
			<?php
				$sql="select * from tbl_jabatan_login where kategori='1' and unit_kerja='KP' and kode_jabatan!='SP' and kode_jabatan!='SPI' and kode_jabatan!='SEKAR' order by id asc";
				$eksql=pg_query($sql)or die($sql);
				while($rd=pg_fetch_array($eksql)){
				if($rd[kode_jabatan]=="DO.I"){
					$kode="D.I";
				}elseif($rd[kode_jabatan]=="DO.II"){
					$kode="D.II";
				}elseif($rd[kode_jabatan]=="DP"){
					$kode="D.III";
				}elseif($rd[kode_jabatan]=="DK"){
					$kode="D.IV";
				}elseif($rd[kode_jabatan]=="DSU"){
					$kode="D.V";
				}
			?>
				<input type='checkbox' value='<?php echo $rd[kode_jabatan];?>' id='<?php echo $rd[kode_jabatan];?>' name='ke[]' onclick='tes(this)'  class='css-checkbox lrg'/>
				<label for='<?php echo $rd[kode_jabatan];?>'  name='checkbox69_lbl' class='css-label lrg vlad'><?php echo $kode;?></label>
			<?php
				}
			?>
			
		</li>
	</ul>
	</br>
	</br>
	<ul style="list-style:none;background-color:#dedede;">
		<li><input type='checkbox' value='gmkp' id='gmkp' name='ke[]' onclick='cekallgmp(this.id)'  class='css-checkbox lrg'/>
			<label for='gmkp'  name='checkbox69_lbl' class='css-label lrg vlad'>Seluruh GM KP</label></li></li>
	</ul>
	<ul style="list-style:none;margin-left:20px;float:left;">
		<li>
			<?php
				$sqlgmkp="select * from tbl_jabatan_login where unit_kerja='KP'  and kode_jabatan like '%GM%' or kode_jabatan IN('SP','SPI')  order by id asc";
				$ekgmkp=pg_query($sqlgmkp)or die($sqlgmkp);
				while($rkp=pg_fetch_array($ekgmkp)){
			?>
				<input type='checkbox' value='<?php echo $rkp[kode_jabatan];?>' id='<?php echo $rkp[kode_jabatan]?>' name='[]' onclick='tes(this)'  class='css-checkbox lrg'/>
				<label for='<?php echo $rkp[kode_jabatan];?>'  name='checkbox69_lbl' class='css-label lrg vlad'><?php echo $rkp['kode_jabatan'];?></label>
			<?php
				}
			?>
			
	
		</li>
	</ul>
	</br>
	</br>
	<ul style="list-style:none;background-color:#dedede;">
		<li><input type='checkbox' value='gmw' id='gmw' name='ke[]' onclick='cekallgmw(this.id)'  class='css-checkbox lrg'/>
			<label for='gmw'  name='checkbox69_lbl' class='css-label lrg vlad'>Seluruh GMW/DIV</label></li></li>
	</ul>
	<ul style="list-style:none;margin-left:20px;float:left;">
		<li>
			<?php
				$sqlgmw="select * from tbl_jabatan_login where unit_kerja!='KP'  and kode_jabatan like '%GM%'    order by id asc";
				$ekgmw=pg_query($sqlgmw)or die($sqlgmw);
				while($rw=pg_fetch_array($ekgmw)){
			?>
					<input type='checkbox' value='<?php echo $rw[kode_jabatan];?>' id='<?php echo $rw[kode_jabatan];?>' name='ke[]' onclick='tes(this)'  class='css-checkbox lrg'/>
					<label for='<?php echo $rw[kode_jabatan];?>'  name='checkbox69_lbl' class='css-label lrg vlad'><?php echo $rw['kode_jabatan'];?></label>
			<?php
				}
			?>
				
		</li>
	</ul>
	</br>
	</br>
	<ul style="list-style:none;background-color:#dedede;">
		<li><input type='checkbox' value='ap' id='ap' name='ke[]' onclick='cekallgmap(this.id)'  class='css-checkbox lrg'/>
			<label for='ap'  name='checkbox69_lbl' class='css-label lrg vlad'>Seluruh Direksi AP</label></li></li>
	</ul>
	<ul style="list-style:none;margin-left:20px;float:left;">
		<li>

			<?php
				$sqlap="select * from tbl_jabatan_login where unit_kerja='SP'";
				$ekap=pg_query($sqlap)or die($sqlap);
				while($rp=pg_fetch_array($ekap)){
			?>
					<input type='checkbox' value='<?php echo $rp[kode_jabatan];?>' id='<?php echo $rp[kode_jabatan];?>' name='ke[]' onclick='tes(this)'  class='css-checkbox lrg'/>
					<label for='<?php echo $rp[kode_jabatan];?>'  name='checkbox69_lbl' class='css-label lrg vlad'><?php echo $rp['kode_jabatan'];?></label>

			<?php
				}
			?>
				
		</li>
	</ul>
	</br>
	</br>
	<ul style="list-style:none;background-color:#dedede;">
		<li><input type='checkbox' value='ap' id='ap' name='ke[]' onclick='cekallgmap(this.id)'  class='css-checkbox lrg'/>
			<label for='ap'  name='checkbox69_lbl' class='css-label lrg vlad'>SEKAR</label></li></li>
	</ul>
	<ul style="list-style:none;margin-left:20px;float:left;">
		<li>

			<?php
				$sqlap="select * from tbl_jabatan_login where kode_jabatan='SEKAR'";
				$ekap=pg_query($sqlap)or die($sqlap);
				while($rp=pg_fetch_array($ekap)){
			?>
					<input type='checkbox' value='<?php echo $rp[kode_jabatan];?>' id='<?php echo $rp[kode_jabatan];?>' name='ke[]' onclick='tes(this)'  class='css-checkbox lrg'/>
					<label for='<?php echo $rp[kode_jabatan];?>'  name='checkbox69_lbl' class='css-label lrg vlad'><?php echo $rp['kode_jabatan'];?></label>

			<?php
				}
			?>
				
		</li>
	</ul>



	
<?php

}elseif(substr($_SESSION['jabatan'],0,8)=="Direktur"){
?>
<ul style="list-style:none;background-color:#dedede;">
		<li><input type='checkbox' value='gmkp' id='gmkp' name='ke[]' onclick='cekallgmp(this.id)'  class='css-checkbox lrg'/>
			<label for='gmkp'  name='checkbox69_lbl' class='css-label lrg vlad'>Seluruh GM KP</label></li></li>
	</ul>
	<ul style="list-style:none;margin-left:20px;float:left;">
		<li>
			<?php
				$sqlgmkp="select * from tbl_jabatan_login where unit_kerja='KP'  and kode_jabatan like '%GM%' or kode_jabatan IN('SP','SPI')  order by id asc";
				$ekgmkp=pg_query($sqlgmkp)or die($sqlgmkp);
				while($rkp=pg_fetch_array($ekgmkp)){
			?>
				<input type='checkbox' value='<?php echo $rkp[kode_jabatan];?>' id='<?php echo $rkp[kode_jabatan]?>' name='[]' onclick='tes(this)'  class='css-checkbox lrg'/>
				<label for='<?php echo $rkp[kode_jabatan];?>'  name='checkbox69_lbl' class='css-label lrg vlad'><?php echo $rkp['kode_jabatan'];?></label>
			<?php
				}
			?>
			
	
		</li>
	</ul>
	</br>
	</br>
	<ul style="list-style:none;background-color:#dedede;">
		<li><input type='checkbox' value='gmw' id='gmw' name='ke[]' onclick='cekallgmw(this.id)'  class='css-checkbox lrg'/>
			<label for='gmw'  name='checkbox69_lbl' class='css-label lrg vlad'>Seluruh GMW/DIV</label></li></li>
	</ul>
	<ul style="list-style:none;margin-left:20px;float:left;">
		<li>
			<?php
				$sqlgmw="select * from tbl_jabatan_login where unit_kerja!='KP'  and kode_jabatan like '%GM%'    order by id asc";
				$ekgmw=pg_query($sqlgmw)or die($sqlgmw);
				while($rw=pg_fetch_array($ekgmw)){
			?>
					<input type='checkbox' value='<?php echo $rw[kode_jabatan];?>' id='<?php echo $rw[kode_jabatan];?>' name='ke[]' onclick='tes(this)'  class='css-checkbox lrg'/>
					<label for='<?php echo $rw[kode_jabatan];?>'  name='checkbox69_lbl' class='css-label lrg vlad'><?php echo $rw['kode_jabatan'];?></label>
			<?php
				}
			?>
				
		</li>
	</ul>
	</br>
	</br>
	<ul style="list-style:none;background-color:#dedede;">
		<li><input type='checkbox' value='ap' id='ap' name='ke[]' onclick='cekallgmap(this.id)'  class='css-checkbox lrg'/>
			<label for='ap'  name='checkbox69_lbl' class='css-label lrg vlad'>Seluruh Direksi AP</label></li></li>
	</ul>
	<ul style="list-style:none;margin-left:20px;float:left;">
		<li>

			<?php
				$sqlap="select * from tbl_jabatan_login where unit_kerja='SP'";
				$ekap=pg_query($sqlap)or die($sqlap);
				while($rp=pg_fetch_array($ekap)){
			?>
					<input type='checkbox' value='<?php echo $rp[kode_jabatan];?>' id='<?php echo $rp[kode_jabatan];?>' name='ke[]' onclick='tes(this)'  class='css-checkbox lrg'/>
					<label for='<?php echo $rp[kode_jabatan];?>'  name='checkbox69_lbl' class='css-label lrg vlad'><?php echo $rp['kode_jabatan'];?></label>

			<?php
				}
			?>
				
		</li>
	</ul>
	</br>
	</br>
	<ul style="list-style:none;background-color:#dedede;">
		<li><input type='checkbox' value='ap' id='ap' name='ke[]' onclick='cekallgmap(this.id)'  class='css-checkbox lrg'/>
			<label for='ap'  name='checkbox69_lbl' class='css-label lrg vlad'>SEKAR</label></li></li>
	</ul>
	<ul style="list-style:none;margin-left:20px;float:left;">
		<li>

			<?php
				$sqlap="select * from tbl_jabatan_login where kode_jabatan='SEKAR'";
				$ekap=pg_query($sqlap)or die($sqlap);
				while($rp=pg_fetch_array($ekap)){
			?>
					<input type='checkbox' value='<?php echo $rp[kode_jabatan];?>' id='<?php echo $rp[kode_jabatan];?>' name='ke[]' onclick='tes(this)'  class='css-checkbox lrg'/>
					<label for='<?php echo $rp[kode_jabatan];?>'  name='checkbox69_lbl' class='css-label lrg vlad'><?php echo $rp['kode_jabatan'];?></label>

			<?php
				}
			?>
				
		</li>
	</ul>


<?php
}else{
?>
	
</p>
<p class="form-control-static">
		<?php 
		if($_SESSION['uname']=="SP"){
		echo "<ul style='border:solid 1px #;margin:10px; list-style:none;padding:0px;float:left;'>";
									//$sqlsub2="select * from tbl_jabatan_login where jabatan like'%GM%'  order by id  asc ";
									$sqlsub2="select * from tbl_jabatan_login where kode_jabatan ='MHK' or kode_jabatan='MSKT' or kode_jabatan='MHS'  order by id  asc ";
									//echo $sqlsub2;
									$eksub2=pg_query($sqlsub2);
									$no=1;
									while($rsub2=pg_fetch_array($eksub2)){
										
										echo "<li style='float:right;padding:1px;'><input type='checkbox'  value='".$rsub2['kode_jabatan']."' id='".$rsub2['kode_jabatan']."' name='ke[]' onclick='test(this)'  class='css-checkbox lrg'/>
										<label for='".$rsub2['kode_jabatan']."'  name='checkbox69_lbl' class='css-label lrg vlad'>".$rsub2['kode_jabatan']."</label>";

										

									//categori+keterangan
										/*	echo "<ul style='border:solid 1px #eee;'>";
												$sqlsub3="select * from tbl_jabatan_login where kategori='".$rsub2[id]."'";
												$eksub3=pg_query($sqlsub3);
												while($rsub3=pg_fetch_array($eksub3)){
													echo "<li><input type='checkbox' value='".$rsub3['kode_jabatan']."' id='".$rsub3['kode_jabatan']."' name='ke[]' onclick='tes(this)'  class='css-checkbox lrg'/>
											<label for='".$rsub3['kode_jabatan']."'  name='checkbox69_lbl' class='css-label lrg vlad'>".$rsub3['kode_jabatan']."</label>";
														echo "<span id='s".$rsub3['kode_jabatan']."' style='display:none;'>
								";
												$sqlket3="select * from tbl_keterangan_disposisi";
												$eksket3=pg_query($sqlket3);
												echo "<ul>";
													while($rket3=pg_fetch_array($eksket3)){
														echo "<li>";
														echo "<input type='checkbox' value='".$rket3['ket']."' id='".$rket3['ket'].$rsub3['kode_jabatan']."' name='ket[]' onclick='showText(this)'  class='css-checkbox lrg'/>
															<label for='".$rket3['ket'].$rsub3['kode_jabatan']."'  name='checkbox69_lbl' class='css-label lrg vlad'>".$rket3['ket']."</label>
																</br>
																<input type='text' id='t".$rket3['ket'].$rsub3['kode_jabatan']."' name='t".$rket3['ket']."' class='form-control' style='display:none;'>
															";
														echo "</li>".$rket3['ket'];
													}
												echo "</ul>";

											echo "</span>";
													echo "</li>";
												}
											echo "</ul>";*/
											//end categori+keterangan
										echo "</li>";
										$no++;
									}
									
								echo "</ul>";
				echo "<ul style='border:solid 1px #;margin:10px; list-style:none;padding:0px;float:left;'>";
									$sqlsub2="select * from tbl_jabatan_login where kategori='7'  order by id  asc ";
									//echo $sqlsub2;
									$eksub2=pg_query($sqlsub2);
									
									while($rsub2=pg_fetch_array($eksub2)){

										echo "<li style='float:right;padding:1px;'><input type='checkbox'  value='".$rsub2['kode_jabatan']."' id='".$rsub2['kode_jabatan']."' name='ke[]' onclick='test(this)'  class='css-checkbox lrg'/>
										<label for='".$rsub2['kode_jabatan']."'  name='checkbox69_lbl' class='css-label lrg vlad'>".$rsub2['kode_jabatan']."</label>";

										

									//categori+keterangan
										/*	echo "<ul style='border:solid 1px #eee;'>";
												$sqlsub3="select * from tbl_jabatan_login where kategori='".$rsub2[id]."'";
												$eksub3=pg_query($sqlsub3);
												while($rsub3=pg_fetch_array($eksub3)){
													echo "<li><input type='checkbox' value='".$rsub3['kode_jabatan']."' id='".$rsub3['kode_jabatan']."' name='ke[]' onclick='tes(this)'  class='css-checkbox lrg'/>
											<label for='".$rsub3['kode_jabatan']."'  name='checkbox69_lbl' class='css-label lrg vlad'>".$rsub3['kode_jabatan']."</label>";
														echo "<span id='s".$rsub3['kode_jabatan']."' style='display:none;'>
								";
												$sqlket3="select * from tbl_keterangan_disposisi";
												$eksket3=pg_query($sqlket3);
												echo "<ul>";
													while($rket3=pg_fetch_array($eksket3)){
														echo "<li>";
														echo "<input type='checkbox' value='".$rket3['ket']."' id='".$rket3['ket'].$rsub3['kode_jabatan']."' name='ket[]' onclick='showText(this)'  class='css-checkbox lrg'/>
															<label for='".$rket3['ket'].$rsub3['kode_jabatan']."'  name='checkbox69_lbl' class='css-label lrg vlad'>".$rket3['ket']."</label>
																</br>
																<input type='text' id='t".$rket3['ket'].$rsub3['kode_jabatan']."' name='t".$rket3['ket']."' class='form-control' style='display:none;'>
															";
														echo "</li>".$rket3['ket'];
													}
												echo "</ul>";

											echo "</span>";
													echo "</li>";
												}
											echo "</ul>";*/
											//end categori+keterangan
										echo "</li>";
									}
									
								echo "</ul>";
		}else{
		echo "<ul style='float:left;margin:10px;'>";
				if($_SESSION['uname']=="DU"){
				
				echo "<li style='float:none;margin:5px;matgin-bottom:2px;'><input type='checkbox' value='".$rsub['kode_jabatan']."'  id='all' name='ke[]' onclick='cekall(this.id)'  class='css-checkbox lrg'/>
						<label for='all'  name='checkbox69_lbl' class='css-label lrg vlad'>All Direksi</label>";
				echo "</li>";
				}
				if(substr($_SESSION['uname'],0,2)!="GM" && substr($_SESSION['uname'],0,2)!="SM"){
				echo "<li style='float:none;margin:5px;'><input type='checkbox' value='".$rsub['kode_jabatan']."'  id='allgm' name='ke[]' onclick='cekallgm(this.id)'  class='css-checkbox lrg'/>
						<label for='allgm'  name='checkbox69_lbl' class='css-label lrg vlad'>All GM/KP/WIL/DIV/AP</label>";
				echo "<li style='float:none;margin:5px;'><input type='checkbox' value='".$rsub['kode_jabatan']."'  id='allgmp' name='ke[]' onclick='cekallgmp(this.id)'  class='css-checkbox lrg'/>
						<label for='allgmp'  name='checkbox69_lbl' class='css-label lrg vlad'>All GM Pusat</label>";
				echo "<li style='float:none;margin:5px;'><input type='checkbox' value='".$rsub['kode_jabatan']."'  id='allgmw' name='ke[]' onclick='cekallgmw(this.id)'  class='css-checkbox lrg'/>
						<label for='allgmw'  name='checkbox69_lbl' class='css-label lrg vlad'>All GM WIL/DIV</label>";
				
				}
				if($_SESSION['uname']=="DU"){
				echo "<li style='float:none;margin:5px;'><input type='checkbox' value='".$rsub['kode_jabatan']."'  id='allgmap' name='ke[]' onclick='cekallgmap(this.id)'  class='css-checkbox lrg'/>
						<label for='allgmap'  name='checkbox69_lbl' class='css-label lrg vlad'>All Dirut Anak Perusahaan</label>";

				echo "</li>";
				}
		echo "</ul>";
		
		echo "<ul style='float:left;margin:10px;'>";
			$sql="select * from tbl_jabatan_login where id='$_SESSION[id]' and kode_jabatan !='admin' and unit_kerja!='PA' order by id asc";
			//echo $sql;
			$eks=pg_query($sql);
			while($rs=pg_fetch_array($eks)){
			//	echo "<li style='float:left;border:solid 1px #eee;'>";
					echo "<ul style='border:solid 1px #;list-style:none;'>";
					if($_SESSION['id']=="1"){
						$sqlsub="select * from tbl_jabatan_login where kategori='".$rs[id]."' and unit_kerja!='PA' order by id asc";
					}elseif($_SESSION['id']=="2" || $_SESSION['id']=="3" || $_SESSION['id']=="4" || $_SESSION['id']=="5" ){
						$sqlsub="select * from tbl_jabatan_login where kode_jabatan like 'GM%' and unit_kerja!='PA' order by unit_kerja asc";
					}elseif($_SESSION['id']=="6" ){
						$sqlsub="select * from tbl_jabatan_login where kode_jabatan like 'GM%' or kategori='6' and unit_kerja!='PA' order by kode_jabatan asc";

					}else{
						$sqlsub="select * from tbl_jabatan_login where kategori='".$rs[id]."' and unit_kerja!='PA'";
					}
					//$sqlsub="select * from tbl_jabatan_login where kategori='".$rs[id]."' and unit_kerja!='PA'";
					//echo $sqlsub;
					$eksub=pg_query($sqlsub);
					
					
					while($rsub=pg_fetch_array($eksub)){
						//echo "tess";
						if($rsub['kode_jabatan']=="SP"){
							echo  "<p style='top:-20px;'>&nbsp;</p>";
						}elseif($rsub['kode_jabatan']=="SPI"){
							echo "<p>&nbsp;</p><p>&nbsp;</p>";

						}
						echo "<li style='float:left;margin:5px;'><input type='checkbox' value='".$rsub['kode_jabatan']."'  id='".$rsub['kode_jabatan']."' name='ke[]' onclick='test(this)'  class='css-checkbox lrg'/>
						<label for='".$rsub['kode_jabatan']."'  name='checkbox69_lbl' class='css-label lrg vlad'>".$rsub['kode_jabatan']."</label>";
						echo "</br></br>";
						
								echo "<span id='s".$rsub['kode_jabatan']."' style='display:none;'>
								";
									$sqlket1="select * from tbl_keterangan_disposisi";
									$eksket1=pg_query($sqlket1);
								if($_SESSION['uname']=="DU" && $_SESSON['uname']!="DU"){
									
									echo "<ul>";
										
										while($rket1=pg_fetch_array($eksket1)){
											echo "<li>";
												echo "<input type='checkbox' value='".$rket1['ket']."' id='".$rket1['ket'].$rsub['kode_jabatan']."' name='ke[]' onclick='showTextt(this)'  class='css-checkbox lrg'/>
											<label for='".$rket1['ket'].$rsub['kode_jabatan']."'  name='checkbox69_lbl' class='css-label lrg vlad'>".$rket1['ket']."</label>
												</br>
												<input type='text' id='t".$rket1['ket'].$rsub['kode_jabatan']."' name='t".$rket1['ket']."[][".$rsub['kode_jabatan']."]' class='form-control' style='display:none;'>
											";
																echo "</li>";
										}
									echo "</ul>";
								echo "</br></br>";
								echo "</span>";
								echo "<ul style='border:solid 1px #; list-style:none;padding:0px;'>";
									//echo "testing";
									$sqlsub2="select * from tbl_jabatan_login where kategori='".$rsub[id]."'   and unit_kerja!='PA'  order by unit_kerja  asc ";
									//echo $sqlsub2;	
									$eksub2=pg_query($sqlsub2);
									while($rsub2=pg_fetch_array($eksub2)){
										
										echo "<li style=''><input type='checkbox'  value='".$rsub2['kode_jabatan']."' id='".$rsub2['kode_jabatan']."' name='ke[]' onclick='test(this)'  class='css-checkbox lrg'/>
											<label for='".$rsub2['kode_jabatan']."'  name='checkbox69_lbl' class='css-label lrg vlad'>".$rsub2['kode_jabatan']."</label>";
									
										

										/*	echo "<span id='s".$rsub2['kode_jabatan']."' style='display:none;'>";
									
									$sqlket="select * from tbl_keterangan_disposisi";
									$eksket=pg_query($sqlket);
									echo "<ul>";
										while($rket=pg_fetch_array($eksket)){
											echo "<li>";
											echo "<input type='checkbox'  value='".$rket['ket']."' id='".$rket['ket'].$rsub2['kode_jabatan']."' name='ket[][".$rsub2['kode_jabatan']."]'  onclick='showTextt(this)'  class='css-checkbox lrg'/>
												<label for='".$rket['ket'].$rsub2['kode_jabatan']."'  name='checkbox69_lbl' class='css-label lrg vlad'>".$rket['ket']."</label>
													</br>
													<input type='text' id='t".$rket['ket'].$rsub2['kode_jabatan']."' name='t".$rket['ket']."' class='form-control' style='display:none;'>
												";
											echo "</li>";
										}
									echo "</ul>";
									
									

								echo "</span>";*/
								


									//checkbox + keterangan
										/*	echo "<ul style='border:solid 1px #eee;'>";
												$sqlsub3="select * from tbl_jabatan_login where kategori='".$rsub2[id]."'";
												$eksub3=pg_query($sqlsub3);
												while($rsub3=pg_fetch_array($eksub3)){
													echo "<li><input type='checkbox' value='".$rsub3['kode_jabatan']."' id='".$rsub3['kode_jabatan']."' name='ke[]' onclick='tes(this)'  class='css-checkbox lrg'/>
											<label for='".$rsub3['kode_jabatan']."'  name='checkbox69_lbl' class='css-label lrg vlad'>".$rsub3['kode_jabatan']."</label>";
														echo "<span id='s".$rsub3['kode_jabatan']."' style='display:none;'>
								";
												$sqlket3="select * from tbl_keterangan_disposisi";
												$eksket3=pg_query($sqlket3);
												echo "<ul>";
													while($rket3=pg_fetch_array($eksket3)){
														echo "<li>";
														echo "<input type='checkbox' value='".$rket3['ket']."' id='".$rket3['ket'].$rsub3['kode_jabatan']."' name='ket[]' onclick='showText(this)'  class='css-checkbox lrg'/>
															<label for='".$rket3['ket'].$rsub3['kode_jabatan']."'  name='checkbox69_lbl' class='css-label lrg vlad'>".$rket3['ket']."</label>
																</br>
																<input type='text' id='t".$rket3['ket'].$rsub3['kode_jabatan']."' name='t".$rket3['ket']."' class='form-control' style='display:none;'>
															";
														echo "</li>".$rket3['ket'];
													}
												echo "</ul>";

											echo "</span>";
													echo "</li>";
												}
											echo "</ul>";*/ 
											//end categori + keterangan
										echo "</li>";
									}

								echo "</ul>";
								if($rsub2['unit_kerja']!="KP"){
								echo "";
								}
								echo "<ul style='border:solid 1px #; list-style:none;padding:0px;'>";
									$sqlsub2="select * from tbl_jabatan_login where kategori='".$rsub[id]."' and unit_kerja!='KP' and unit_kerja!='PA'  order by id  asc ";
									//echo $sqlsub2;
									//$eksub2=pg_query($sqlsub2);
									while($rsub2=pg_fetch_array($eksub2)){
										echo "<li style=''><input type='checkbox'  value='".$rsub2['kode_jabatan']."' id='".$rsub2['kode_jabatan']."' name='ke[]' onclick='test(this)'  class='css-checkbox lrg'/>
											<label for='".$rsub2['kode_jabatan']."'  name='checkbox69_lbl' class='css-label lrg vlad'>".$rsub2['kode_jabatan']."</label>";
											echo "<span id='s".$rsub2['kode_jabatan']."' style='display:none;'>
								";
									$sqlket="select * from tbl_keterangan_disposisi";
									$eksket=pg_query($sqlket);
									echo "<ul>";
										while($rket=pg_fetch_array($eksket)){
											echo "<li>";
											echo "<input type='checkbox'  value='".$rket['ket']."' id='".$rket['ket'].$rsub2['kode_jabatan']."' name='ket[]'  onclick='showTextt(this)'  class='css-checkbox lrg'/>
												<label for='".$rket['ket'].$rsub2['kode_jabatan']."'  name='checkbox69_lbl' class='css-label lrg vlad'>".$rket['ket']."</label>
													</br>
													<input type='text' id='t".$rket['ket'].$rsub2['kode_jabatan']."' name='t".$rket['ket']."' class='form-control' style='display:none;'>
												";
											echo "</li>".$rket['ket'];
										}
									echo "</ul>";

								echo "</span>";


									//categori+keterangan
										/*	echo "<ul style='border:solid 1px #eee;'>";
												$sqlsub3="select * from tbl_jabatan_login where kategori='".$rsub2[id]."'";
												$eksub3=pg_query($sqlsub3);
												while($rsub3=pg_fetch_array($eksub3)){
													echo "<li><input type='checkbox' value='".$rsub3['kode_jabatan']."' id='".$rsub3['kode_jabatan']."' name='ke[]' onclick='tes(this)'  class='css-checkbox lrg'/>
											<label for='".$rsub3['kode_jabatan']."'  name='checkbox69_lbl' class='css-label lrg vlad'>".$rsub3['kode_jabatan']."</label>";
														echo "<span id='s".$rsub3['kode_jabatan']."' style='display:none;'>
								";
												$sqlket3="select * from tbl_keterangan_disposisi";
												$eksket3=pg_query($sqlket3);
												echo "<ul>";
													while($rket3=pg_fetch_array($eksket3)){
														echo "<li>";
														echo "<input type='checkbox' value='".$rket3['ket']."' id='".$rket3['ket'].$rsub3['kode_jabatan']."' name='ket[]' onclick='showText(this)'  class='css-checkbox lrg'/>
															<label for='".$rket3['ket'].$rsub3['kode_jabatan']."'  name='checkbox69_lbl' class='css-label lrg vlad'>".$rket3['ket']."</label>
																</br>
																<input type='text' id='t".$rket3['ket'].$rsub3['kode_jabatan']."' name='t".$rket3['ket']."' class='form-control' style='display:none;'>
															";
														echo "</li>".$rket3['ket'];
													}
												echo "</ul>";

											echo "</span>";
													echo "</li>";
												}
											echo "</ul>";*/
											//end categori+keterangan
										echo "</li>";
									}
									
								echo "</ul>";
							}
						echo "</li>";
					
					}

	
					echo "</ul>";


				echo "</li>";
			}
		echo "</ul>";


	}	
							
		?>
<?php
}
?>	
</p>
</br>
</br>
</div>
</div>
</div>
<div class="form-group" >
<div class="block-title">
<h6>DISPOSISI</h6>
</div>
<div class="col-md-4">
<p class="form-control-static">
	<?php 

		echo "<ul style='float:left;margin:10px;'>";
			$sql="select * from tbl_keterangan_disposisi where id <=4";
			//echo $sql;
			$eks=pg_query($sql);
			while($rs=pg_fetch_array($eks)){
			//	echo "<li style='float:left;border:solid 1px #eee;'>";
					echo "<ul style='border:solid 1px #e;list-style:none;'>";
					$sqlsub="select * from tbl_keterangan_disposisi where id='".$rs[id]."'";
					$eksub=pg_query($sqlsub);
					while($rsub=pg_fetch_array($eksub)){
						echo "<li style='float:left;margin:5px;'><input type='checkbox' value='".$rsub['id']."'  id='".$rsub['ket']."' name='dis[]' onclick='test(this)'  class='css-checkbox lrg'/>
						<label for='".$rsub['ket']."'  name='checkbox69_lbl' class='css-label lrg vlad'>".$rsub['ket']."</label>";
						
								
									
					}

	
					echo "</ul>";


				echo "</li>";
			}
		echo "</ul>";
		?>
	<?php
	/*	$sqlket="select * from tbl_keterangan_disposisi";
		$eksket=pg_query($sqlket);
		echo "<ul style='float:left;margin:15px;border:solid 1px #;list-style:none;''>Disposisi";
		while($rket=pg_fetch_array($eksket)){
			echo "<li>".$rket['ket']."</li>";
		}
		echo "</ul>";*/
	?>
</p>
</div>

<div class="col-md-4">
<p class="form-control-static">
	<?php 

		echo "<ul style='float:left;margin:10px;'>";
			$sql="select * from tbl_keterangan_disposisi where id >4";
			//echo $sql;
			$eks=pg_query($sql);
			while($rs=pg_fetch_array($eks)){
			//	echo "<li style='float:left;border:solid 1px #eee;'>";
					if($rs[id]==6){$kode="float:left;";}else{$kode="";}
					echo "<ul style='border:solid 1px #e;list-style:none;".$kode."'>";
					$sqlsub="select * from tbl_keterangan_disposisi where id='".$rs[id]."'";
					$eksub=pg_query($sqlsub);
					while($rsub=pg_fetch_array($eksub)){
						echo "<li style='float:left;margin:5px;'><input type='checkbox' value='".$rsub['id']."'  id='".$rsub['ket']."' name='dis[]' onclick='test(this)'  class='css-checkbox lrg'/>
						<label for='".$rsub['ket']."'  name='checkbox69_lbl' class='css-label lrg vlad'>".$rsub['ket']."</label>";
						
								
									
					}

	
					echo "</ul>";


				echo "</li>";
			}
		echo "</ul>";
		?>
	<?php
	/*	$sqlket="select * from tbl_keterangan_disposisi";
		$eksket=pg_query($sqlket);
		echo "<ul style='float:left;margin:15px;border:solid 1px #;list-style:none;''>Disposisi";
		while($rket=pg_fetch_array($eksket)){
			echo "<li>".$rket['ket']."</li>";
		}
		echo "</ul>";*/
	?>
</p>
</div>



</div>
</div>

<div class="form-group" id="lampiran" style="display:none">

<label for="textarea-editor" class="control-label col-md-2">File</label>
<div class="col-md-10">
<input type="file" multiple="" class="form-control" name="filenya[]">

</div>
</div>

<div class="form-group">
	<div class="block-title">
<h6>CATATAN</h6>
</div>
</br>
<label for="textarea-editor" class="control-label col-md-2">Catatan</label>
<div class="col-md-10">
<textarea placeholder="..." rows="10" class="form-control textarea-editor" name="catatan" id="textarea-editor"></textarea>

</div>
</div>
<div>
	<!--
	<div class="form-group">

<label for="textarea-editor" class="control-label col-md-2">File Lampiran</label>
<div class="col-md-10">
<input type="file" name="lampiran" class="form-control">

</div>
</div>
<div>
	-->
</div>
<div class="form-group form-actions">
		<div class="col-md-10 col-md-offset-5">
		<button type="reset" class="btn btn-danger" value="teset"> Reset</button>
		<input type="submit" class="btn btn-success" name="save" value="Save"></button>
		</div>
		</div>
</form>
</div>
</div>
</br>




<?php
//include "footer.php";

?>
