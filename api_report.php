<?php
include "inc/conn.php";
$prefix = '';

     echo "data:[\n";
     $sql="select *  from tbl_disposisi";
     $eks=pg_query($sql);
     while ($row = pg_fetch_assoc($eks)) {

       
     

    
     $sql="select count(id_disposisi) as jml_surat from tbl_disposisi";
     $eks=pg_query($sql);
     while ($row = pg_fetch_assoc($eks)) {

       echo $prefix . " {\n";

       echo 'device:'."\n";

       echo "'Semua Surat'".',' . "\n";

       echo 'geekbench: ' . $row['jml_surat'] . '' . "\n";

       echo " },";

      $prefix = "\n";

    }

     $sql="select count(id_disposisi) as jml_surat from tbl_disposisi where tgl_baca is null";
     $eks=pg_query($sql);
     while ($row = pg_fetch_assoc($eks)) {

       echo $prefix . " {\n";

       echo 'device:'."\n";

       echo "'Belum Baca Surat'".',' . "\n";

       echo 'geekbench: ' . $row['jml_surat'] . '' . "\n";

       echo " },";

      $prefix = ",\n";

    }
  }

    echo "]";
?>