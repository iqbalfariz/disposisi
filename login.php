
<?php include "header_login.php";?>
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
            if($cek>0){
              
              session_start();
              $_SESSION['uname']=$rs[kode_jabatan];
              $_SESSION['jabatan']=$rs[jabatan];
               $_SESSION['id']=$rs[id];
               $_SESSION['unit_kerja']=$rs['unit_kerja'];
             // echo "<script>alert('Berhasil Login')</script>";
              printf("<script>location.href='$app'</script>");
            }else{
                echo "<script>alert('Password Salah')</script>";
            }
        }else{
            echo "<script>alert('Data Masih kosong')</script>";
        }
    }
    
?>
<body class="login">
<!--
<b style="color:red;">
&nbsp;&nbsp;&nbsp;&nbsp;Pemberitahuan Bahwa Disposisi Akan Ada Perpindahan Server Pada Hari Minggu </br> &nbsp;&nbsp;&nbsp;&nbsp;Sehubungan Dengan Ini Bahwa Hari Minggu 24/08/2014 Disposisi Tidak Bisa Diakses</br>TI </b>-->
<a href="javascript:void(0)" class="login-btn themed-background-default">
<span class="login-logo">
<span class="square1 themed-border-default"></span>
<span class="square2"></span>

<span class="name">E-Disposisi</span>
</span>
    </a>
<div class="left-door"></div>
<div class="right-door"></div>
<div id="login-container" class="display-none">
<div class="block-tabs block-themed">
<ul id="login-tabs" class="nav nav-tabs" data-toggle="tabs">
<li class="active text-center">
<a href="#login-form-tab">
<img src="<?php echo $app;?>/img/user.png"  width="20">Login
</a>
</li>
<!--
<li class="text-center">
<a href="#register-form-tab">
<img src="<?php echo $app;?>/img/plus.png"  width="20"> Register
</a>
</li>-->
</ul>
<div class="tab-content">
<div class="tab-pane active" id="login-form-tab">

<form action="" method="post" id="login-form" enctype="multipart/form-data" class="form-horizontal">
<div class="form-group">
<div class="col-xs-12">
<div class="input-group">
<span class="input-group-addon"><img src="<?php echo $app;?>/img/user_name.png"  width="15"></span>
<input type="text" id="login-email" name="login-user" class="form-control" placeholder="Username..">
</div>
</div>
</div>
<div class="form-group">
<div class="col-xs-12">
<div class="input-group">
<span class="input-group-addon"><img src="<?php echo $app;?>/img/pwd.png"  width="15"></span>
<input type="password" id="login-password" name="login-password" class="form-control" placeholder="Password..">
</div>
</div>
</div>
<div class="form-group">
<div class="col-xs-12 clearfix">
<div class="pull-right">
<input type="submit" name="login" class="btn btn-success remove-margin" value="Login">
</div>

</div>
</div>
</form>
</div>
<div class="tab-pane" id="register-form-tab">
<form action="page_login.php" method="post" id="register-form" class="form-horizontal" onSubmit="return false;">
<div class="form-group">
<div class="col-xs-12">
<div class="input-group">
<span class="input-group-addon"><i class="icon-user icon-fixed-width"></i></span>
<input type="text" id="register-username" name="register-username" class="form-control" placeholder="Username">
</div>
</div>
</div>
<div class="form-group">
<div class="col-xs-12">
<div class="input-group">
<span class="input-group-addon"><i class="icon-envelope-alt icon-fixed-width"></i></span>
<input type="text" id="register-email" name="register-email" class="form-control" placeholder="Email">
</div>
</div>
</div>
<div class="form-group">
<div class="col-xs-12">
<div class="input-group">
<span class="input-group-addon"><i class="icon-asterisk icon-fixed-width"></i></span>
<input type="password" id="register-password" name="register-password" class="form-control" placeholder="Password">
</div>
</div>
</div>
<div class="form-group">
<div class="col-xs-12">
<div class="input-group">
<span class="input-group-addon"><i class="icon-asterisk icon-fixed-width"></i></span>
<input type="password" id="register-repassword" name="register-repassword" class="form-control" placeholder="Retype Password">
</div>
</div>
</div>
<div class="form-group">
<div class="col-xs-12 text-center">
<a href="#modal-terms" data-toggle="modal">Terms and Conditions</a>
<div id="modal-terms" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h4>Terms and Conditions</h4>
</div>
<div class="modal-body text-left">
    <h5>1. Heading</h5>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus. Mauris tincidunt tincidunt turpis in porta. Integer fermentum tincidunt auctor. Vestibulum ullamcorper, odio sed rhoncus imperdiet, enim elit sollicitudin orci, eget dictum leo mi nec lectus. Nam commodo turpis id lectus scelerisque vulputate. Integer sed dolor erat. Fusce erat ipsum, varius vel euismod sed, tristique et lectus? Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque? Proin rhoncus dui at ligula vestibulum ut facilisis ante sodales! Suspendisse potenti. Aliquam tincidunt sollicitudin sem nec ultrices. Sed at mi velit. Ut egestas tempor est, in cursus enim venenatis eget! Nulla quis ligula ipsum. Donec vitae ultrices dolor?</p>
    <h5>2. Heading</h5>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus. Mauris tincidunt tincidunt turpis in porta. Integer fermentum tincidunt auctor. Vestibulum ullamcorper, odio sed rhoncus imperdiet, enim elit sollicitudin orci, eget dictum leo mi nec lectus. Nam commodo turpis id lectus scelerisque vulputate. Integer sed dolor erat. Fusce erat ipsum, varius vel euismod sed, tristique et lectus? Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque? Proin rhoncus dui at ligula vestibulum ut facilisis ante sodales! Suspendisse potenti. Aliquam tincidunt sollicitudin sem nec ultrices. Sed at mi velit. Ut egestas tempor est, in cursus enim venenatis eget! Nulla quis ligula ipsum. Donec vitae ultrices dolor?</p>
    <h5>3. Heading</h5>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus. Mauris tincidunt tincidunt turpis in porta. Integer fermentum tincidunt auctor. Vestibulum ullamcorper, odio sed rhoncus imperdiet, enim elit sollicitudin orci, eget dictum leo mi nec lectus. Nam commodo turpis id lectus scelerisque vulputate. Integer sed dolor erat. Fusce erat ipsum, varius vel euismod sed, tristique et lectus? Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque? Proin rhoncus dui at ligula vestibulum ut facilisis ante sodales! Suspendisse potenti. Aliquam tincidunt sollicitudin sem nec ultrices. Sed at mi velit. Ut egestas tempor est, in cursus enim venenatis eget! Nulla quis ligula ipsum. Donec vitae ultrices dolor?</p>
    <h5>4. Heading</h5>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus. Mauris tincidunt tincidunt turpis in porta. Integer fermentum tincidunt auctor. Vestibulum ullamcorper, odio sed rhoncus imperdiet, enim elit sollicitudin orci, eget dictum leo mi nec lectus. Nam commodo turpis id lectus scelerisque vulputate. Integer sed dolor erat. Fusce erat ipsum, varius vel euismod sed, tristique et lectus? Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque? Proin rhoncus dui at ligula vestibulum ut facilisis ante sodales! Suspendisse potenti. Aliquam tincidunt sollicitudin sem nec ultrices. Sed at mi velit. Ut egestas tempor est, in cursus enim venenatis eget! Nulla quis ligula ipsum. Donec vitae ultrices dolor?</p>
    <h5>5. Heading</h5>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida, urna ligula hendrerit nibh, ac cursus nibh sapien in purus. Mauris tincidunt tincidunt turpis in porta. Integer fermentum tincidunt auctor. Vestibulum ullamcorper, odio sed rhoncus imperdiet, enim elit sollicitudin orci, eget dictum leo mi nec lectus. Nam commodo turpis id lectus scelerisque vulputate. Integer sed dolor erat. Fusce erat ipsum, varius vel euismod sed, tristique et lectus? Etiam egestas fringilla enim, id convallis lectus laoreet at. Fusce purus nisi, gravida sed consectetur ut, interdum quis nisi. Quisque egestas nisl id lectus facilisis scelerisque? Proin rhoncus dui at ligula vestibulum ut facilisis ante sodales! Suspendisse potenti. Aliquam tincidunt sollicitudin sem nec ultrices. Sed at mi velit. Ut egestas tempor est, in cursus enim venenatis eget! Nulla quis ligula ipsum. Donec vitae ultrices dolor?</p>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="form-group">
<div class="col-xs-12 clearfix">
<div class="pull-right">
<button type="submit" class="btn btn-success remove-margin">Register</button>
</div>
<div class="pull-left login-extra-check">
<label for="register-terms">
<input type="checkbox" id="register-terms" name="register-terms" class="input-themed">
Accept terms
</label>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
<script src="<?php echo $app;?>/js/jquery.min.js"></script>
<script>!window.jQuery && document.write(unescape('%3Cscript src="js/jquery-1.9.1.min.js"%3E%3C/script%3E'));</script>
<script src="<?php echo $app;?>/js/bootstrap.min.js"></script>
<script src="<?php echo $app;?>/js/plugins-1.4.js"></script>
<script src="<?php echo $app;?>/js/main-1.4.js"></script>
<script>$(function(){if(!$("body").hasClass("no-animation")){var e=0;$("html").hasClass("csstransitions")&&(e=750),$(".login-btn").mouseenter(function(){$(".left-door, .right-door, .login-btn").addClass("login-animate"),setTimeout(function(){$("#login-container").fadeIn(1500),$(".login-btn .name").fadeOut(250,function(){$(".login-btn .square1, .login-btn .square2").fadeIn(750),$("#login-email").focus()})},e)})}});</script>
        <script>var _gaq=_gaq||[];_gaq.push(["_setAccount","UA-16158021-6"]),_gaq.push(["_setDomainName","pixelcave.com"]),_gaq.push(["_trackPageview"]),function(){var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src=("https:"==document.location.protocol?"https://ssl":"http://www")+".google-analytics.com/ga.js";var e=document.getElementsByTagName("script")[0];e.parentNode.insertBefore(t,e)}();</script>
</body>
</html>
