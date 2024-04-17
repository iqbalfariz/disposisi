    <?
    $email="disposisi";
    $message = "testing" ;
	$to="zikri@hk.co.id";
   @mail("$to", "Pemberitahuan Disposisi", $message, "From: $email")or die("salahhh");
    print "Congratulations your email has been sent";
    ?>s
