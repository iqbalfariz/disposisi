<?php include "header_baru.php"; ?>
<?php  include "left.php";?>
<div id="pre-page-content">
<h1><img src="<?php echo $app;?>/img/dashboard.png" width="70"> &nbsp;<?php echo $_SESSION['jabatan'];?><br><small>Welcome <strong><?php echo $_SESSION['jabatan'];?></strong>, everything looks good!</small></h1>
</div>
<div id="page-content">
<ul class="breadcrumb breadcrumb-top">

<li><a href="<?php echo $app;?>">
<?php echo $link;?>
</a></li>
</ul>


<?php

		switch ($_GET['menu']) {
			case 'disposisi':
				include "input_surat_sekertariat.php";
				break;
			case 'disposisidekom':
				include "input_surat_dekom.php";
				break;
			case 'disposisigm':
				include "input_surat_sekertariat_gm.php";
				break;
			case 'list_edaran':
				include "tableboot.php";
				break;
			case 'listsurat':
				include "surat_belum_disposisi_new.php";
				break;
			case 'listsuratPA':
				include "listsuratPA.php";
				break;
			case 'listsuratSK':
				include "listsuratSK.php";
				break;
			case 'listdisposisi':
				include "listdisposisi.php";
				break;
			case 'listfront':
				//include "list_front_disposisi.php";
				//include "list_front_disposisi_new1.php";
				include "list_front_disposisi_new2.php";
				break;
			case 'listfront1':
				//include "list_front_disposisi.php";
				//include "list_front_disposisi_new1.php";
				include "list_front_disposisi_new2.php";
				break;
			case 'listfront2':
				//include "list_front_disposisi.php";
				include "list_front_disposisi_new2.php";
				break;
			case 'listselesai':
				//include "list_front_disposisi.php";
				include "surat_selesai.php";
				break;
			case 'listexpired':
				//include "list_front_disposisi.php";
				include "surat_masa_tenggang.php";
				break;

			case 'setting':
				include "ganti_pwd.php";
				break;
			case 'report':
				//include "dashboard.php";
				include "chart_asli.php";
				break;
			case 'logout':
				include "inc/logout.php";
				break;
			case 'suratmasuk':
				include "surat_masuk.php";
				break;
			case 'edit_surat':
				include "edit_input_surat_sekertariat.php";
				break;
			case 'chart':
				include "chart_asli.php";
				break;
			case 'laporan':
				//echo "tess";
				include "laporan.php";
				break;
			case 'dsb':
				//echo "tess";
				include "tablelistsurat1.php";
				break;

			
			
		}
		switch ($_GET['detail']) {
			case 'list_file':
				include "list_file.php";
				break;
				case 'bacapesan':
				include "detail_surat7_baru.php";
				break;
				case 'bacapesan9':
				include "detail_surat7_baru.php";
				break;
				case 'bacapesan2':
				include "detail_surat2.php";
				break;
				case 'bacapesan3':
				include "detail_surat3.php";
				break;
				case 'bacapesan4':
				include "detail_surat4_revisi_akan_datang.php";
				break;
				case 'bacapesan5':
				include "detail_surat5_baru.php";
				break;
				case 'bacapesan6':
				include "detail_surat6_baru.php";
				break;
				case 'bacapesan7':
				include "detail_surat6_baru_tes.php";
				break;
				case 'bacapesan8':
				include "detail_surat6_baru_05.php";
				break;
				case 'bacanotif':
				include  "detail_surat6_baru_tes.php";
				break;
				


				case 'bacapesanPA':
				include "detail_suratPA.php";
				break;
					case 'listdisposisi':
				include "listdisposisi.php";
				break;
					case 'sekdetail':
				include "list_sekertariat.php";
				break;

		}
		switch ($_GET['disdetail']) {
			case 'disposisidetail':
				include "listdisposisi.php";
				break;
			case 'listsek':
				include "list_sekertariat.php";
				break;
				

		}
		switch ($_GET['pagemenu']) {
			case 'list_edaran':
				include "list.php";
				break;
			
				

		}
		switch ($_GET['pagesurat']) {
			case 'listsurat':
				include "listsurat.php";
				break;
			
				

		}

		//echo $_GET[detail];
		
	if(!empty($_GET[detail]) || !empty($_GET[disdetail]) || !empty($_GET[menu])){

	}else{
		if($_SESSION['uname']!="admin" && $_SESSION['unit_kerja']!='sekertaris' && $_SESSION['uname']!="SEKDEKOM"){
		//include "listsurat.php";
					//include "tablelistsurat_new.php";
					include "tbl.php";
	?>
	

	<?php

}elseif($_SESSION['unit_kerja']=="PA"){
//echo "testing";
	include "listsuratPA.php";
}elseif($_SESSION['unit_kerja']=="sekertaris"){
	//echo "testinggg";
	include "listsuratSK.php";
}elseif($_SESSION['uname']=="SEKDEKOM" || $_SESSION['uname']=="STAFI" || $_SESSION['uname']=="STAFII"){
	include "tableboot_dekom.php";
}else{
	//echo "tg";
	//include"list.php";
	include "tableboot.php";
}
	}
//echo $_SESSION['unit_kerja']."tes";
	?>

</div>
</div>
</div>
<?php include "footer.php";?>
