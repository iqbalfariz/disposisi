<?php
include "inc/conn.php";
$id=$_GET['id'];
	$sqldata="select * from tbl_sekertariat_disposisi where nomor_agenda like '$id%' order by nomor_agenda desc limit 1";
	//echo $sqldata."</br>";
	$eks=pg_query($sqldata);
	$rs=pg_fetch_array($eks);
	$cek=pg_num_rows($eks);
	//print_r($rs[nomor_agenda]);
	//echo $cek;	
	if($cek>0){
		$cekid= substr($rs['nomor_agenda'],12,3);
	}else{
		$ide=1;
	}
	//echo $cekid."</br>";
	//$ide=0;
if($cekid<9){
	$idtes=substr($cekid,2,1);
	$idnya=$idtes+1;
	$kode="00".$idnya;
}elseif($cekid<100){
	$idtp=substr($cekid,1,2);
	//echo $idtp;
	$idnya=$idtp+1;
	$kode="0".$idnya;
	//echo $idnya;
	//echo "tes";
}elseif($cekid<=100){
	$idtr=substr($cekid,0,3);
	//echo $idtp;
	$idnyar=$idtr+1;
	$kode=$idnyar;
	//echo $idnya;
	//echo "tes";
	echo "de";
}
echo $kode;
?>
 
