	<?php
		//include "header.php";
		//include "left.php";
	//echo str_replace('"',"'",$_GET[id]);
	if(!empty($_GET['idnya'])){
	$updatestatus="update tbl_notif2 set ip='1' where id='$_GET[idnya]'";
	//echo $updatestatus;
	$eks=pg_query($updatestatus)or die($updatestatus);
	}
	?>

<form action="" method="post">
<div class="block-section">
	
<table id="example-datatables" class="table table-bordered table-hover">
<thead>
<tr>
<th style="text-align:center;" class="text-center hidden-xs hidden-sm">No</th>
<th style="text-align:center;">Tanggal</th>
<th style="text-align:center;" class="hidden-xs hidden-sm">Jam</th>
<th style="text-align:center;" >Dari</th>
<th style="text-align:center;" >Ditujukan Ke</th>
<th style="text-align:center;" >History Catatan</th>
<th style="text-align:center;" >Status</th>


</tr>
</thead>
<tbody>
	<?php
		$arry=array($_GET[id]);
		if($_SESSION[uname]=="admin"){
			$dr=str_replace('"',"'", $_GET[id]);
		}else{
			$dr="'".implode("','", $arry)."'";
		}
		$sql="select a.*,b.pengirim,c.* from tbl_sekertariat_disposisi a left join tbl_kode_pengirim b on a.pengirim=b.kode_pengirim left join tbl_disposisi c on a.nomor_agenda=c.nomor_agenda where c.dari IN($dr) and a.nomor_agenda='$_GET[no]'  order by a.nomor_agenda desc";
		//echo $sql;
		$eks=pg_query($sql);
		$no=1;
		while($rs=pg_fetch_array($eks)){
	?>
<tr>
<td class="text-center hidden-xs hidden-sm"><?php echo $no;?></td>
<td width="11%"><a href="<?php if($_SESSION['uname']=='DU' or substr($_SESSION['jabatan'],0,8)=="Direktur"){echo $app."?detail=bacapesan7&id=".$rs['nomor_agenda']."&ke=".$rs['ke'];}else{ echo $app;?>?detail=list_file&id=<?php echo $rs['nomor_agenda'];}?>"><?php echo substr($rs['tgl_kirim'],8,2)."-".substr($rs['tgl_kirim'],5,2)."-".substr($rs['tgl_kirim'],0,4);?></a></td>
<td ><?php echo substr($rs['tgl_kirim'],10,8);?></td>

<td ><?php echo $rs['dari'];?></td>
<td ><?php echo $rs['ke'];?></td>
<td ><?php echo $rs['catatan'];?></td>
<td ><span class="label label-<?php if($rs['status']=="1"){echo "info";}else{echo "danger";} ?>"><?php  if($rs['status']=="1"){echo "Done,".$rs['dari'];}else{echo "On Progres,".$rs['ke']; echo "&nbsp;("; if($rs['tgl_baca']==""){echo "Unread";}else{echo "Read";} echo ")"; if($rs['tgl_tindak_lanjut']=="" ){echo "Undisposisi";} }?></span></td>

</tr>
	<?php
		$sql2="select a.*,b.pengirim,c.* from tbl_sekertariat_disposisi a left join tbl_kode_pengirim b on a.pengirim=b.kode_pengirim left join tbl_disposisi c on a.nomor_agenda=c.nomor_agenda where c.dari='".$rs['ke']."'  and c.nomor_agenda='".$rs['nomor_agenda']."' order by a.nomor_agenda desc";
	//echo $sql2;

		$eks2=pg_query($sql2);
		$cekjml=pg_num_rows($eks2);
		$no2=1;
		if($eks2>0){
		while($rs2=pg_fetch_array($eks2)){
			
			
	?>

			<tr>
<td class="text-center hidden-xs hidden-sm"><?php echo $no.".".$no2;?></td>
<td><a href="<?php if($_SESSION['uname']=='DU' or substr($_SESSION['jabatan'],0,8)=="Direktur"){echo $app."?detail=bacapesan7&id=".$rs2['nomor_agenda']."&ke=".$rs2['ke'];}else{ echo $app;?>?detail=list_file&id=<?php echo $rs2['nomor_agenda'];}?>"><?php echo substr($rs2['tgl_kirim'],8,2)."-".substr($rs2['tgl_kirim'],5,2)."-".substr($rs2['tgl_kirim'],0,4);?></a></td>
<td ><?php echo substr($rs2['tgl_kirim'],10,8)?></td>

<td ><?php echo $rs2['dari'];?></td>
<td ><?php echo $rs2['ke'];?></td>
<td ><?php echo $rs2['catatan'];?></td>
<td ><span class="label label-<?php if($rs2['status']=="1"){echo "info";}else{echo "danger";} ?>"><?php  if($rs2['status']=="1"){echo "Done,".$rs2['dari'];}else{echo "On Progres,".$rs2['ke']; echo "&nbsp;("; if($rs2['tgl_baca']==""){echo "Unread";}else{echo "Read";} echo ")"; if($rs2['tgl_tindak_lanjut']=="" && $rs2['tgl_kirim']==""){echo "Undisposisi";} }?></span></td>

</tr>
		
	<?php
		$sql3="select a.*,b.pengirim,c.* from tbl_sekertariat_disposisi a left join tbl_kode_pengirim b on a.pengirim=b.kode_pengirim left join tbl_disposisi c on a.nomor_agenda=c.nomor_agenda where c.dari='".$rs2['ke']."' and c.nomor_agenda='".$rs2['nomor_agenda']."' order by a.nomor_agenda desc";
		//echo $sql3;
		$eks3=pg_query($sql3);
		$no3=1;
		if($eks3>0){
		while($rs3=pg_fetch_array($eks3)){
	?>

			<tr>
<td class="text-center hidden-xs hidden-sm"><?php echo $no.".".$no2.".".$no3;?></td>
<td><a href="<?php if($_SESSION['uname']=='DU' or substr($_SESSION['jabatan'],0,8)=="Direktur"){echo $app."?detail=bacapesan7&id=".$rs3['nomor_agenda']."&ke=".$rs3['ke'];}else{ echo $app;?>/?detail=list_file&id=<?php echo $rs3['nomor_agenda'];}?>"><?php echo substr($rs3['tgl_kirim'],8,2)."-".substr($rs3['tgl_kirim'],5,2)."-".substr($rs3['tgl_kirim'],0,4);?></a></td>
<td ><?php echo substr($rs3['tgl_kirim'],10,8)?></td>

<td ><?php echo $rs3['dari'];?></td>
<td ><?php echo $rs3['ke'];?></td>
<td ><?php echo $rs3['catatan'];?></td>
<td ><span class="label label-<?php if($rs3['status']=="1"){echo "info";}else{echo "danger";} ?>"><?php  if($rs3['status']=="1"){echo "Done,".$rs3['dari'];}else{echo "On Progres,".$rs3['ke']; echo "&nbsp;("; if($rs3['tgl_baca']==""){echo "Unread";}else{echo "Read";} echo ")"; if($rs3['tgl_tindak_lanjut']==""){echo "Undisposisi";} }?></span></td>

</tr>
	<?php
		$sql4="select a.*,b.pengirim,c.* from tbl_sekertariat_disposisi a left join tbl_kode_pengirim b on a.pengirim=b.kode_pengirim left join tbl_disposisi c on a.nomor_agenda=c.nomor_agenda where c.dari='".$rs3['ke']."' and c.nomor_agenda='".$rs3['nomor_agenda']."' order by a.nomor_agenda desc";
		//echo $sql4;
		$eks4=pg_query($sql4);
		$no4=1;
		if($eks4>0){
		while($rs4=pg_fetch_array($eks4)){
	?>

			<tr>
<td class="text-center hidden-xs hidden-sm"><?php echo $no.".".$no2.".".$no3.".".$no4;?></td>
<td><a href="<?php if($_SESSION['uname']=='DU' or substr($_SESSION['jabatan'],0,8)=="Direktur"){echo $app."?detail=bacapesan7&id=".$rs3['nomor_agenda']."&ke=".$rs3['ke'];}else{ echo $app;?>?detail=list_file&id=<?php echo $rs3['nomor_agenda'];}?>"><?php echo substr($rs4['tgl_kirim'],8,2)."-".substr($rs4['tgl_kirim'],5,2)."-".substr($rs4['tgl_kirim'],0,4);?></a></td>
<td ><?php echo substr($rs4['tgl_kirim'],10,8)?></td>
<td ><?php echo $rs4['dari'];?></td>
<td ><?php echo $rs4['ke'];?></td>
<td ><?php echo $rs4['catatan'];?></td>
<td ><span class="label label-<?php if($rs4['status']=="1"){echo "info";}else{echo "danger";} ?>"><?php  if($rs4['status']=="1"){echo "Done,".$rs4['dari'];}else{echo "On Progres,".$rs4['ke']; echo "&nbsp;("; if($rs4['tgl_baca']==""){echo "Unread";}else{echo "Read";} echo ")"; if($rs4['tgl_tindak_lanjut']==""){echo "Undisposisi";} }?></span></td>

</tr>
	<?php
		$no3++;
		}
	}
	?>
	<?php
		$no3++;
		}
	}
	?>

	<?php

		$no2++;
		}
	}
	?>
<?php
		$no++;
		}
?>
</tbody>

</table>



<?php
//include "footer.php";

?>
</form>
