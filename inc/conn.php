<?php
$conn_string = "host=192.168.12.6 port=5432 dbname=disposisi user=prasnowo password=1sa4lmas1h";
$dbconn4 = pg_connect($conn_string);

function TanggalIndo($date){
 
   $tahun = substr($date, 6,4);
    $bulan = substr($date, 0, 2);
    $tgl   = substr($date, 3, 2);
 
    $result = $tahun."-" .$bulan . "-". $tgl;        
    return($result);
}
function TanggalLuar($date){
 
   $tahun = substr($date, 0,4);
    $bulan = substr($date, 5, 2);
    $tgl   = substr($date, 8, 2);
 
    $result = $bulan."/" .$tgl . "/". $tahun;        
    return($result);
}
function delete_directory($dirname) {
         if (is_dir($dirname))
           $dir_handle = opendir($dirname);
     if (!$dir_handle)
          return false;
     while($file = readdir($dir_handle)) {
           if ($file != "." && $file != "..") {
                if (!is_dir($dirname."/".$file))
                     unlink($dirname."/".$file);
                else
                     delete_directory($dirname.'/'.$file);
           }
     }
     closedir($dir_handle);
     rmdir($dirname);
     return true;
}

?>
