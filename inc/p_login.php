<?php
$uname=$_POST['login-user'];
$pwd=md5($_POST['login-password']);
    if(isset($_POST['login'])){
        if(!empty($_POST['login-user']) && !empty($_POST['login-password'])){
            $sql="select * from tbl_jabatan_login where kode_jabatan='$uname' and pwd='$pwd'";
            //echo $sql;
            $eks=pg_query($sql) or die($sql);
            $rs=pg_fetch_array($eks);
            $cek=pg_num_rows($eks);
            if($cek==1){
                echo "<script>alert('tes')</script>";
            //@session_register('uname');
                    @session_start();
                    $kd=$rs['kode_jabatan'];
                     $_SESSION['uname']=$rs['kode_jabatan'];
                     session_register("uname");
      
              //  $uname=$rs['kode_jabatan'];
                echo "<script>alert('tes".$kd."')</script>";

                //echo "<script>alert('Login".$uname."')</script>";
                echo "header('location:http://localhost/aplikasi_surat')";
                //printf("<script>location.href='$app'</script>");
            }else{
                echo "<script>alert('Tidak Login".$pwd."')</script>";
            }
        }else{
            echo "<script>alert('Data Masih kosong')</script>";
        }
    }
    
?>