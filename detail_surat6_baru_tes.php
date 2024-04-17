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

	
	if(isset($_POST['done'])){

		$sqldone="insert into tbl_disposisi (id_disposisi,nomor_agenda,tgl_masuk_surat,dari,catatan,status,tgl_kirim,status_srt)
									values(nextval('tbl_disposisi_id_disposisi_seq'::regclass),'$_GET[id]','".$rgetdata['tgl_masuk_surat']."','$_SESSION[uname]','$_POST[catatan]','1',$date,'urgnt')";
				//echo $sqldone;
				$tgl_tindak=date("Y-m-d H:i:s");
				$sqlup="update tbl_disposisi set tgl_tindak_lanjut='$date' , status='0' where nomor_agenda='$_GET[id]' and dari='$_SESSION[uname]'";
				//echo $sqlup;
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
				//$sqldari="select * from tbl_disposisi where nomor_agenda='$_GET[id]' and ke='$_SESSION[uname]'";
					
					$sqldari="select * from tbl_disposisi where nomor_agenda='$_GET[id]' and ke='$_SESSION[uname]'";
					$rdari=pg_fetch_array(pg_query($sqldari));
					$dari=$rdari['dari'];
					$simpannotif="insert into tbl_notif2 values(nextval('tbl_notif_id_seq'::regclass),'$_GET[id]','$_SESSION[uname]','','$date','0')";
					$eksimpannotif=pg_query($simpannotif)or die($simpannotif);

			echo "<script>alert('Disposisi Done...')</script>";




	}elseif(isset($_POST['save'])){
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
					
					
						$sqldis="insert into tbl_disposisi (id_disposisi,nomor_agenda,tgl_masuk_surat,dari,ke,cc,catatan,status,keterangan,tgl_kirim)
									values(nextval('tbl_disposisi_id_disposisi_seq'::regclass),'$_GET[id]','".$rgetdata['tgl_masuk_surat']."','$_SESSION[uname]','$_GET[ke]','','$_POST[catatan]','0','','$date')";
						//echo $sq
						$eks=pg_query($sqldis);
						$sqldari="select * from tbl_disposisi where nomor_agenda='$_GET[id]' and ke='$_SESSION[uname]'";
					$rdari=pg_fetch_array(pg_query($sqldari));
					$dari=$rdari['dari'];
					$simpannotif="insert into tbl_notif2 values(nextval('tbl_notif_id_seq'::regclass),'$_GET[id]','$_SESSION[uname]','$_GET[ke]'$date','0')";
					//echo $simpannotif;
					$eksimpannotif=pg_query($simpannotif);


						//disposisi per lantai //
						$sqlgm="select * from tbl_jabatan_login where kode_jabatan='$_GET[ke]'";
						$rgm=pg_fetch_array(pg_query($sqlgm));
						$tglnow=date("Y-m-d");
						if($rgm['lantai']!=""){
							$sqlseker="insert into tbl_sekertaris_lantai(id,nomor_agenda,lantai,gm,tgl_kirim) values(nextval('tbl_sekertaris_lantai_id_seq'::regclass),'$_GET[id]',
									'$rgm[lantai]','$_GET[ke]','$tglnow')";
							$ekseker=pg_query($sqlseker);
							//echo $sqlseker;
						}

						$sqlgm="select * from tbl_jabatan_login where kode_jabatan='$_GET[ke]'";
						$ekgm=pg_query($sqlgm);
						$rgm=pg_fetch_array($ekgm);
						if($rgm['lantai']==""){
							
						}
						$sqlpa="INSERT into tbl_pa(id,nomor_agenda,atasan,dari,tgl_kirim,catatan)values(nextval('tbl_pa_id_seq'::regclass),'$_GET[id]','$_GET[ke]','$_SESSION[uname]','$date','$_POST[catatan]')";
					//echo $sqlpa;
						$ekspa=pg_query($sqlpa);
						//Gateway
						$sqlceknomer="select * from tbl_jabatan_login where kode_jabatan='$_GET[ke]'";
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
	

					
					$sqlupdate="update tbl_disposisi set status='0' where nomor_agenda='$_GET[id]' and ke='$_SESSION[uname]' ";
					pg_query($sqlupdate);
					//$sqldari="select * from tbl_disposisi where nomor_agenda='$_GET[id]' and ke='$_SESSION[uname]'";
					
					

					echo "<script>alert('Disposisi Terkirim...')</script>";
				printf("<script>location.href='$app?menu=listfront'</script>");
		

	}
	



	/*if(isset($_POST['save'])){
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
						$sqldari="select * from tbl_disposisi where nomor_agenda='$_GET[id]' and ke='$_SESSION[uname]'";
					$rdari=pg_fetch_array(pg_query($sqldari));
					$dari=$rdari['dari'];
					$simpannotif="insert into tbl_notif values(nextval('tbl_notif_id_seq'::regclass),'$_GET[id]','$_SESSION[uname]','$ke[$di]','$date','0')";
					//echo $simpannotif;
					$eksimpannotif=pg_query($simpannotif);


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
					//$sqldari="select * from tbl_disposisi where nomor_agenda='$_GET[id]' and ke='$_SESSION[uname]'";
					
					

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
				//$sqldari="select * from tbl_disposisi where nomor_agenda='$_GET[id]' and ke='$_SESSION[uname]'";
					
					$sqldari="select * from tbl_disposisi where nomor_agenda='$_GET[id]' and ke='$_SESSION[uname]'";
					$rdari=pg_fetch_array(pg_query($sqldari));
					$dari=$rdari['dari'];
					$simpannotif="insert into tbl_notif values(nextval('tbl_notif_id_seq'::regclass),'$_GET[id]','$_SESSION[uname]','','$date','0')";
					$eksimpannotif=pg_query($simpannotif)or die($simpannotif);

			echo "<script>alert('Disposisi Done...')</script>";
			printf("<script>location.href='$app?menu=listfront'</script>");
			}else{
				echo "<script>alert('Disposisi Harap Dilengkapi')</script>";
			}		

		}else{
			echo "<script>alert('Tindak Lanjut Harap Dilengkapi')</script>";
		}
	}*/


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
	
function cekalldir(isi){
		var remember = document.getElementById(isi);
    			if (remember.checked){
        		
				document.getElementById('D.I').checked = true;
				document.getElementById('D.II').checked = true;
				document.getElementById('D.V').checked = true;
				document.getElementById('D.IV').checked = true;
				document.getElementById('D.III').checked = true;
    			}else{
     				
				document.getElementById('D.I').checked = false;
				document.getElementById('D.II').checked = false;
				document.getElementById('D.V').checked = false;
				document.getElementById('D.IV').checked = false;
				document.getElementById('D.III').checked = false;
   			}
}
function cekalldir1(isi){
		var remember = document.getElementById(isi);
    			if (remember.checked){
        		
				document.getElementById('GMPB').checked = true;
				document.getElementById('GMTP').checked = true;
				document.getElementById('GMDG').checked = true;
				document.getElementById('HKASTON').checked = true;
				document.getElementById('HKPRECAST').checked = true;
    			}else{
     				
				document.getElementById('GMPB').checked = false;
				document.getElementById('GMTP').checked = false;
				document.getElementById('GMDG').checked = false;
				document.getElementById('HKASTON').checked = false;
				document.getElementById('HKPRECAST').checked = false;
   			}
}
function cekalldir2(isi){
		var remember = document.getElementById(isi);
    			if (remember.checked){
        		
				document.getElementById('GMPJT').checked = true;
				document.getElementById('GMPB1').checked = true;
				document.getElementById('GMTP1').checked = true;
				document.getElementById('GMDJJ').checked = true;
				document.getElementById('GMEPC').checked = true;
				document.getElementById('HKSPV').checked = true;
    			}else{
     				
				document.getElementById('GMPJT').checked = false;
				document.getElementById('GMPB1').checked = false;
				document.getElementById('GMTP1').checked = false;
				document.getElementById('GMDJJ').checked = false;
				document.getElementById('GMEPC').checked = false;
				document.getElementById('HKSPV').checked = false;
   			}
}
function cekalldir3(isi){
		var remember = document.getElementById(isi);
    			if (remember.checked){
        		
				document.getElementById('GMPB2').checked = true;
				document.getElementById('GMTP2').checked = true;
				document.getElementById('GMW1').checked = true;
				document.getElementById('GMW2').checked = true;
				document.getElementById('GMW3').checked = true;
				document.getElementById('GMW4').checked = true;
				document.getElementById('GMW5').checked = true;
				document.getElementById('GMW6').checked = true;
				document.getElementById('GMW7').checked = true;
    			}else{
     				
				document.getElementById('GMPB2').checked = false;
				document.getElementById('GMTP2').checked = false;
				document.getElementById('GMW1').checked = false;
				document.getElementById('GMW2').checked = false;
				document.getElementById('GMW3').checked = false;
				document.getElementById('GMW4').checked = false;
				document.getElementById('GMW5').checked = false;
				document.getElementById('GMW6').checked = false;
				document.getElementById('GMW7').checked = false;
   			}
}
function cekalldir4(isi){
		var remember = document.getElementById(isi);
    			if (remember.checked){
        		
				document.getElementById('GMPJT1').checked = true;
				document.getElementById('GMPB3').checked = true;
				document.getElementById('GMTP3').checked = true;
				document.getElementById('GMSU').checked = true;
				document.getElementById('EM').checked = true;
    			}else{
     				
				document.getElementById('GMPJT1').checked = false;
				document.getElementById('GMPB3').checked = false;
				document.getElementById('GMTP3').checked = false;
				document.getElementById('GMSU').checked = false;
				document.getElementById('EM').checked = false;
   			}
}
function cekalldir5(isi){
		var remember = document.getElementById(isi);
    			if (remember.checked){
        		
				document.getElementById('GMSR').checked = true;
				document.getElementById('GMKU').checked = true;
				document.getElementById('GMAK').checked = true;
				document.getElementById('HKR').checked = true;
				document.getElementById('HKPOLE').checked = true;
    			}else{
     				
				document.getElementById('GMSR').checked = false;
				document.getElementById('GMKU').checked = false;
				document.getElementById('GMAK').checked = false;
				document.getElementById('HKR').checked = false;
				document.getElementById('HKPOLE').checked = false;
   			}
}

function cekallkp(isi){
		var remember = document.getElementById(isi);
    			if (remember.checked){
        		
				document.getElementById('GMPJT').checked = true;
				document.getElementById('GMPJT1').checked = true;
				document.getElementById('GMPB').checked = true;
				document.getElementById('GMPB1').checked = true;
				document.getElementById('GMPB2').checked = true;
				document.getElementById('GMPB3').checked = true;
				document.getElementById('GMTP').checked = true;
				document.getElementById('GMTP1').checked = true;
				document.getElementById('GMTP2').checked = true;
				document.getElementById('GMTP3').checked = true;
				document.getElementById('GMSR').checked = true;
				document.getElementById('GMKU').checked = true;
				document.getElementById('GMAK').checked = true;
				document.getElementById('GMSU').checked = true;

    			}else{
     				
				document.getElementById('GMPJT').checked = false;
				document.getElementById('GMPJT1').checked = false;
				document.getElementById('GMPB').checked = false;
				document.getElementById('GMPB1').checked = false;
				document.getElementById('GMPB2').checked = false;
				document.getElementById('GMPB3').checked = false;
				document.getElementById('GMTP').checked = false;
				document.getElementById('GMTP1').checked = false;
				document.getElementById('GMTP2').checked = false;
				document.getElementById('GMTP3').checked = false;
				document.getElementById('GMSR').checked = false;
				document.getElementById('GMKU').checked = false;
				document.getElementById('GMAK').checked = false;
				document.getElementById('GMSU').checked = false;   			}
}
function cekallaw(isi){
		var remember = document.getElementById(isi);
    			if (remember.checked){
        		
				document.getElementById('GMDG').checked = true;
				document.getElementById('GMDJJ').checked = true;
				document.getElementById('GMEPC').checked = true;
				document.getElementById('GMW1').checked = true;
				document.getElementById('GMW2').checked = true;
				document.getElementById('GMW3').checked = true;
				document.getElementById('GMW4').checked = true;
				document.getElementById('GMW5').checked = true;
				document.getElementById('GMW6').checked = true;
				document.getElementById('GMW7').checked = true;

    			}else{
     				
				document.getElementById('GMDG').checked = false;
				document.getElementById('GMDJJ').checked = false;
				document.getElementById('GMEPC').checked = false;
				document.getElementById('GMW1').checked = false;
				document.getElementById('GMW2').checked = false;
				document.getElementById('GMW3').checked = false;
				document.getElementById('GMW4').checked = false;
				document.getElementById('GMW5').checked = false;
				document.getElementById('GMW6').checked = false;
				document.getElementById('GMW7').checked = false;
   			}
}
function cekallap(isi){
		var remember = document.getElementById(isi);
    			if (remember.checked){
        		
				document.getElementById('HKR').checked = true;
				document.getElementById('HKASTON').checked = true;
				document.getElementById('HKPOLE').checked = true;
				document.getElementById('HKSPV').checked = true;
				document.getElementById('HKPRECAST').checked = true;
				document.getElementById('EM').checked = true;
				
    			}else{
     				
				document.getElementById('HKR').checked = false;
				document.getElementById('HKASTON').checked = false;
				document.getElementById('HKPOLE').checked = false;
				document.getElementById('HKSPV').checked = false;
				document.getElementById('HKPRECAST').checked = false;
				document.getElementById('EM').checked = false;   			}
}




function allgmkp(isi){
	var remember = document.getElementById(isi);
    			if (remember.checked){
				document.getElementById('gmr').checked = true;
				document.getElementById('gmr1').checked = true;
				document.getElementById('gmtp').checked = true;
				document.getElementById('gmtp1').checked = true;
				document.getElementById('sekper').checked = true;
				document.getElementById('sekper1').checked = true;
				document.getElementById('sekper2').checked = true;
				document.getElementById('sekper3').checked = true;
				document.getElementById('gmsu').checked = true;
				document.getElementById('gmak').checked = true;
				document.getElementById('sp').checked = true;
				document.getElementById('sp1').checked = true;
				document.getElementById('sp2').checked = true;
				document.getElementById('sp3').checked = true;
				document.getElementById('gmpb').checked = true;
				document.getElementById('gmpjt').checked = true;
				document.getElementById('gmku').checked = true;
				document.getElementById('gmsr').checked = true;
				
				
				
			
    			}else{
     				
				document.getElementById('gmr').checked = false;
				document.getElementById('gmr1').checked = false;
				document.getElementById('gmtp').checked = false;
				document.getElementById('gmtp1').checked = false;
				document.getElementById('sekper').checked = false;
				document.getElementById('sekper1').checked = false;
				document.getElementById('sekper2').checked = false;
				document.getElementById('sekper3').checked = false;
				document.getElementById('sp').checked = false;
				document.getElementById('sp1').checked = false;
				document.getElementById('sp2').checked = false;
				document.getElementById('sp3').checked = false;
				document.getElementById('gmpb').checked = false;
				document.getElementById('gmpjt').checked = false;
				document.getElementById('gmku').checked = false;
				document.getElementById('gmsr').checked = false;
				document.getElementById('gmsu').checked = false;
				document.getElementById('gmak').checked = false;
				
				

			
   			}

}
function allwd(isi){
	var remember = document.getElementById(isi);
    			if (remember.checked){
				
				document.getElementById('gmw1').checked = true;
				document.getElementById('gmw2').checked = true;
				document.getElementById('gmw3').checked = true;
				document.getElementById('gmw4').checked = true;
				document.getElementById('gmw5').checked = true;
				document.getElementById('gmdg').checked = true;
				document.getElementById('gmepc').checked = true;
				document.getElementById('gmdjj').checked = true;
				
				
				
			
    			}else{
     				
				document.getElementById('gmw1').checked = false;
				document.getElementById('gmw2').checked = false;
				document.getElementById('gmw3').checked = false;
				document.getElementById('gmw4').checked = false;
				document.getElementById('gmw5').checked = false;
				document.getElementById('gmdg').checked = false;
				document.getElementById('gmepc').checked = false;
				document.getElementById('gmdjj').checked = false;				

			
   			}

}

function allap(isi){
	var remember = document.getElementById(isi);
    			if (remember.checked){
				document.getElementById('hr').checked = true;
				document.getElementById('hkp').checked = true;
				document.getElementById('hk').checked = true;
		
				
				
				
			
    			}else{
     				
				document.getElementById('hr').checked = false;
				document.getElementById('hkp').checked = false;
				document.getElementById('hk').checked = false;
						

			
   			}

}
function allsekar(isi){
	var remember = document.getElementById(isi);
    			if (remember.checked){
				document.getElementById('SEKAR2').checked = true;
				document.getElementById('SEKAR3').checked = true;
				document.getElementById('SEKAR4').checked = true;
				document.getElementById('SEKAR5').checked = true;
		
				
				
				
			
    			}else{
     				
				document.getElementById('SEKAR2').checked = false;
				document.getElementById('SEKAR3').checked = false;
				document.getElementById('SEKAR4').checked = false;
				document.getElementById('SEKAR5').checked = false;						

			
   			}

}
function alld2(isi){
	var remember = document.getElementById(isi);
    			if (remember.checked){
				document.getElementById('allwilDO.I').checked = true;
				document.getElementById('apDO.I').checked = true;
				document.getElementById('sekper').checked = true;
				document.getElementById('sp').checked = true;
				document.getElementById('gmr').checked = true;
				document.getElementById('gmtp').checked = true;
				document.getElementById('gmpb').checked = true;
				document.getElementById('gmw1').checked = true;
				document.getElementById('gmw2').checked = true;
				document.getElementById('gmdg').checked = true;
				document.getElementById('hk').checked = true;
				document.getElementById('hkp').checked = true;
			
				
				
				
			
    			}else{
     				
				document.getElementById('allwilDO.I').checked = false;
				document.getElementById('apDO.I').checked = false;
				document.getElementById('sekper').checked = false;
				document.getElementById('sp').checked = false;
				document.getElementById('gmr').checked = false;
				document.getElementById('gmtp').checked = false;
				document.getElementById('gmpb').checked = false;
				document.getElementById('gmw1').checked = false;
				document.getElementById('gmw2').checked = false;
				document.getElementById('gmdg').checked = false;
				document.getElementById('hk').checked = false;
				document.getElementById('hkp').checked = false;
									

			
   			}

}
function alld3(isi){
	var remember = document.getElementById(isi);
    			if (remember.checked){
				document.getElementById('allwilDO.II').checked = true;
				document.getElementById('apDO.II').checked = true;
				document.getElementById('sekper1').checked = true;
				document.getElementById('sp1').checked = true;
				document.getElementById('gmr1').checked = true;
				document.getElementById('gmtp1').checked = true;
				document.getElementById('gmpjt').checked = true;
				document.getElementById('gmw3').checked = true;
				document.getElementById('gmw4').checked = true;
				document.getElementById('gmw5').checked = true;
				document.getElementById('gmdjj').checked = true;
				document.getElementById('gmepc').checked = true;
				
				
				
				
			
    			}else{
     				
				document.getElementById('allwilDO.II').checked = false;
				document.getElementById('apDO.II').checked = false;
				document.getElementById('sekper1').checked = false;
				document.getElementById('sp1').checked = false;
				document.getElementById('gmr1').checked = false;
				document.getElementById('gmtp1').checked = false;
				document.getElementById('gmpjt').checked = false;
				document.getElementById('gmw3').checked = false;
				document.getElementById('gmw4').checked = false;
				document.getElementById('gmw5').checked = false;
				document.getElementById('gmdjj').checked = false;
				document.getElementById('gmepc').checked = false;
								

			
   			}

}
function alld4(isi){
	
}
function alld5(isi){
	var remember = document.getElementById(isi);
    			if (remember.checked){
				document.getElementById('sekper2').checked = true;
				document.getElementById('sp2').checked = true;
				document.getElementById('gmku').checked = true;
				document.getElementById('gmak').checked = true;
				document.getElementById('hr').checked = true;
				
				
				
				
				
			
    			}else{
     				
				document.getElementById('sekper2').checked = false;
				document.getElementById('sp2').checked = false;
				document.getElementById('gmku').checked = false;
				document.getElementById('gmak').checked = false;
				document.getElementById('hr').checked = false;
				
			

			
   			}

}
function alld6(isi){
	var remember = document.getElementById(isi);
    			if (remember.checked){
				document.getElementById('sekper3').checked = true;
				document.getElementById('sp3').checked = true;
				document.getElementById('gmsu').checked = true;
				document.getElementById('gmsr').checked = true;
			
				
				
				
				
			
    			}else{
     				
				document.getElementById('sekper3').checked = false;
				document.getElementById('sp3').checked = false;
				document.getElementById('gmsu').checked = false;
				document.getElementById('gmsr').checked = false;
						

			
   			}

}


function allwil2(isi){
	var remember = document.getElementById(isi);
    			if (remember.checked){
			
				document.getElementById('gmw1').checked = true;
				document.getElementById('gmw2').checked = true;
				document.getElementById('gmdg').checked = true;
				
				
				
			
    			}else{
     				
				
				document.getElementById('gmw1').checked = false;
				document.getElementById('gmw2').checked = false;
				document.getElementById('gmdg').checked = false;
				
			
   			}

	
}
function allwil3(isi){
	var remember = document.getElementById(isi);
    			if (remember.checked){
			
				document.getElementById('gmw3').checked = true;
				document.getElementById('gmw4').checked = true;
				document.getElementById('gmw5').checked = true;
				document.getElementById('gmdjj').checked = true;
				document.getElementById('gmepc').checked = true;
				
				
				
			
    			}else{
     				
				
				document.getElementById('gmpjt').checked = false;
				document.getElementById('gmw3').checked = false;
				document.getElementById('gmw4').checked = false;
				document.getElementById('gmw5').checked = false;
				document.getElementById('gmdjj').checked = false;
				document.getElementById('gmepc').checked = false;
			
   			}

	
}
function allwil4(isi){
	
	
}
function allwil5(isi){
	
	
}
function allwil6(isi){


	
}

function ap2(isi){
	var remember = document.getElementById(isi);
    			if (remember.checked){
			
				document.getElementById('hk').checked = true;
				document.getElementById('hkp').checked = true;
				
				
				
				
			
    			}else{
     				
				
				document.getElementById('hk').checked = false;
				document.getElementById('hkp').checked = false;
			
				
			
   			}

}
function ap3(isi){

}
function ap4(isi){

}
function ap5(isi){
	var remember = document.getElementById(isi);
    			if (remember.checked){
			
				document.getElementById('hr').checked = true;
			
				
				
				
				
			
    			}else{
     				
				
				document.getElementById('hr').checked = false;
			
			
				
			
   			}

}
function ap6(isi){

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
function showdisposisi(){
	document.getElementById('Tnya').style.display='';
	document.getElementById('savenya').style.display='';
	document.getElementById('cancel').style.display='';
	document.getElementById('Cnya').style.display='';
	document.getElementById('catatan').style.display='';
	
	
}
function batalkan(){
	document.getElementById('Tnya').style.display='none';
	document.getElementById('savenya').style.display='none';
	document.getElementById('cancel').style.display='none';
	document.getElementById('Cnya').style.display='none';
	document.getElementById('catatan').style.display='none';
	
	
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
<label class="control-label col-md-2">Nomor Agenda</label>
<div class="col-md-3">
<p class="form-control-static"><b><?php echo $rs['nomor_agenda'];?></b></p>
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
<label class="control-label col-md-2"></label>
<div class="col-md-3">
<p class="form-control-static"></p>
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



<div id="disposisi">

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

		<div class="col-md-10 col-md-offset-5">
<input type="submit" value='Done' onclick="return confirm('Anda Yakin ?')" name="done" class="btn btn-success" > &nbsp;<input type="button" onclick="showdisposisi()" value='Disposisi' class="btn btn-success" >
</div>

</br>
<label for="textarea-editor" class="control-label col-md-2" style="display:none;" id="catatan" >Catatan</label>
<div class="col-md-10" style='display:none;' id="Tnya">
<textarea placeholder="..." rows="10" class="form-control textarea-editor"  name="catatan" id="textarea-editor"></textarea>

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
	<span style="align:center;">
		<input type="button" class="btn btn-danger" style='display:none;' id="cancel" name="batal" value="Cancel" onclick="batalkan()"></button>
		<input type="submit" class="btn btn-success" style='display:none;' id="savenya" name="save" value="Saves"><input type='checkbox' value='1' id='urgnt' name='urgnt'  class='css-checkbox lrg'/>
				<label for='urgnt' style="margin-top:-14px;display:none;" id="Cnya"   name='checkbox69_lbl' class='css-label lrg vlad' ><b style="color:red;">URGENT</b></label>

	</span>
		</div>
		</div>
</form>
</div>
</div>
</br>




<?php
//include "footer.php";

?>
