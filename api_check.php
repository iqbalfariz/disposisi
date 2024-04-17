<?php
include "inc/conn.php";
	$sql="select * from tbl_sekertariat_disposisi";
	$eks=pg_query($sql);
	while($r=pg_fetch_array($eks)){
		$kenya[]=$r['no_surat'];
	
	}
	//$disposisi_ke  = '"'.implode('","',$kenya).'"';
	$disposisi_ke  = implode(',',$kenya);
	echo $disposisi_ke;
?>