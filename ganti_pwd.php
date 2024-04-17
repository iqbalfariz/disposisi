<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
</head>


<?php

$date=date("Y-m-d H:i:s");
	if(isset($_POST['save'])){
	//	if(!empty($_POST['PL'])||!empty($_POST['PB'])){
			$sqlcekpwd="select pwd from tbl_jabatan_login where kode_jabatan='$_SESSION[uname]' ";
			$ekcekpwd=pg_query($sqlcekpwd);
			$rcekpwd=pg_fetch_array($ekcekpwd);
			$plama=md5($_POST['PL']);
			$pbaru=md5($_POST['PB']);

			if($rcekpwd['pwd']==$plama){
				$sqlupwd="update tbl_jabatan_login set pwd='$pbaru',no_telp='$_POST[hp]',email='$_POST[email]' where kode_jabatan='$_SESSION[uname]'";
				//echo $sqlupwd;
				pg_query($sqlupwd);
				echo "<script>alert('Password Dirubah')</script>";
			}elseif(empty($_POST['PL'])||empty($_POST['PB'])){
				$sqluHE="update tbl_jabatan_login set no_telp='$_POST[hp]',email='$_POST[email]' where kode_jabatan='$_SESSION[uname]'";
				//echo $sqluHE;
				pg_query($sqluHE)or die($sqluHE);
				echo "<script>alert('Email & No Hanphone Dirubah')</script>";
			}else{
				echo "<script>alert('Password Lama Tidak Cocok')</script>";
			}
		//}else{
			//echo "<script>alert('Lengkapi Data')</script>";
		//}
	}

?>


 

<div class="block block-themed">

	<div class="block-title">
		<div class="block-options">
			<a href="javascript:void(0)" class="btn btn-option enable-tooltip" data-toggle="block-collapse" title="Toggle block's content"><i class="icon-arrow-up"></i></a>
			<a href="javascript:void(0)" class="btn btn-option" data-toggle="tooltip" title="Settings"><i class="icon-cog"></i></a>
		</div>
	<h4>Ganti Password</h4>
	</div>
		<div class="block-content">
		<form action="" method="post" class="form-horizontal" enctype="multipart/form-data" >
	
		
		<div class="form-group">

		<label class="control-label col-md-2" for="textarea-large">Password Lama</label>
		<div class="col-md-10">
		<input type="password" class="form-control" value="<?php echo $_POST['PL'];?>" id="tags" name="PL">
		</div>
		</div>
		<div class="form-group">
		<label class="control-label col-md-2" for="textarea-large">Password Baru</label>
		<div class="col-md-10">
		<input type="password" class="form-control" value="<?php echo $_POST['perihal'];?>"  id="general-input-grid3" name="PB">
		</div>
		</div>
		<?php
		if($_SESSION['uname']!="admin"){
		?>
			<?php 
				$sqlcekvalue="select * from tbl_jabatan_login where kode_jabatan='$_SESSION[uname]'";
				//echo $sqlcekvalue;
				$eksqlcekvalue=pg_query($sqlcekvalue);
				$rvalue=pg_fetch_array($eksqlcekvalue);
			?>
			<div class="form-group">
            	    	<label class="control-label col-md-2" for="textarea-large">No Handphone</label>
               		 <div class="col-md-10">
                		<input type="text" class="form-control" value="<?php echo $rvalue['no_telp'];?>"  id="general-input-grid3" name="hp">
                	 </div>
                	</div>
			
			<div class="form-group">
	                <label class="control-label col-md-2" for="textarea-large">Email</label>
        	        <div class="col-md-10">
               			 <input type="text" class="form-control" value="<?php echo $rvalue['email'];?>"  id="general-input-grid3" name="email">
                	</div>
                	</div>

		<?php
		}
		?>
		
		<div class="form-group form-actions">
		<div class="col-md-10 col-md-offset-2">
		<button type="reset" class="btn btn-danger" value="teset"> Reset</button>
		<input type="submit" class="btn btn-success" name="save" value="save"></button>
		</div>
		</div>
		<!--<a href="">Setting Profile</a>-->
		</form>
	</div>
</div>

