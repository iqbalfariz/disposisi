<footer>
<div class="pull-right">
Design By&nbsp;<a href="http://www.hutama-karya.com" target="_blank">Hutama Karya</a></strong>
</div>
<div class="pull-left">
<span id="year-copy"></span> &copy; <strong><a href="http://goo.gl/mssAH" target="_blank">Disposisi Surat 1.0</a></strong>
</div>
</footer>
</div>

<!--[if lte IE 8]><script src="js/helpers/excanvas.min.js"></script><![endif]-->
<?php
    if($_GET[menu]!="disposisi"){
?>
<!--<script src="<?php echo $app;?>/js/jquery.min.js"></script>-->
<script>!window.jQuery && document.write(unescape('%3Cscript src="<?php echo $app;?>/js/vendor/jquery-1.9.1.min.js"%3E%3C/script%3E'));</script>
<?php
}
?>
<script src="<?php echo $app;?>/js/bootstrap.min.js"></script>
<script src="<?php echo $app;?>/js/plugins-1.4.js"></script>
<script src="<?php echo $app;?>/js/main-1.4.js"></script><script src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script src="<?php echo $app;?>/js/gmaps.min.js"></script>
<script>$(function(){var e=$("#dashboard-chart"),t=$("#dashboard-map"),i="300px";$(".scrollable").slimScroll({height:i,color:"#333",size:"5px",alwaysVisible:!0,railVisible:!0,railColor:"#333",railOpacity:.1,touchScrollStep:750});var s=[[0,620],[1,500],[2,900],[3,650],[4,1250],[5,850],[6,1700]],a=[[0,110],[1,80],[2,320],[3,250],[4,550],[5,520],[6,600]];e.css("height",i),$.plot(e,[{data:s,lines:{show:!0,fill:!0,fillColor:{colors:[{opacity:.25},{opacity:.25}]}},points:{show:!0},label:"New Users"},{data:a,lines:{show:!0,fill:!0,fillColor:{colors:[{opacity:.1},{opacity:.1}]}},points:{show:!0},label:"New Projects"}],{legend:{position:"nw",backgroundColor:null},colors:["#2980b9","#333"],grid:{borderWidth:0,color:"#999999",labelMargin:10,hoverable:!0,clickable:!0},yaxis:{ticks:0,tickColor:"#fff"},xaxis:{tickSize:1,tickColor:"#fff",ticks:[[0,"MON"],[1,"TUE"],[2,"WED"],[3,"THU"],[4,"FRI"],[5,"SAT"],[6,"SUN"]]}});var o=null;e.bind("plothover",function(e,t,i){if(i){if(o!==i.dataIndex){o=i.dataIndex,$("#tooltip").remove();var s=(i.datapoint[0],i.datapoint[1]);$('<div id="tooltip" class="chart-tooltip"><strong>'+s+"</strong></div>").css({top:i.pageY-30,left:i.pageX-20}).appendTo("body").show()}}else $("#tooltip").remove(),o=null}),$('a[href="#dashboard-maps"]').on("shown.bs.tab",function(){t.css("height",i).css("width","100%"),new GMaps({div:"#dashboard-map",lat:0,lng:0,zoom:1})})});</script>
        <script>var _gaq=_gaq||[];_gaq.push(["_setAccount","UA-16158021-6"]),_gaq.push(["_setDomainName","pixelcave.com"]),_gaq.push(["_trackPageview"]),function(){var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src=("https:"==document.location.protocol?"https://ssl":"http://www")+".google-analytics.com/ga.js";var e=document.getElementsByTagName("script")[0];e.parentNode.insertBefore(t,e)}();</script>
<script type="text/javascript">
function Tamil(element){
	//\alert(element);
	document.getElementById(element).style.display= '';
}
function Tutup(element){
	//\alert(element);
	document.getElementById(element).style.display= 'none';
}
 function tampil_ket (checkbox) {
            if (checkbox.checked){
                alert ("The check box is checked."+checkbox.value);
            }
            else {
                alert ("The check box is not checked."+checkbox.value);
            }
        }
</script>
<script>$(function(){$("#form-validation").validate({errorClass:"help-block",errorElement:"span",errorPlacement:function(t,e){e.parents(".form-group > div").append(t)},highlight:function(t){$(t).closest(".form-group").removeClass("has-success has-error").addClass("has-error"),$(t).closest(".help-block").remove()},success:function(t){t.closest(".form-group").removeClass("has-success has-error").addClass("has-success"),t.closest(".help-block").remove()},rules:{val_username:{required:!0,minlength:2},val_password:{required:!0,minlength:5},val_confirm_password:{required:!0,minlength:5,equalTo:"#val_password"},val_email:{required:!0,email:!0},val_website:{required:!0,url:!0},val_date:{required:!0,date:!0},val_range:{required:!0,range:[1,100]},val_number:{required:!0,number:!0},val_digits:{required:!0,digits:!0},val_skill:{required:!0},val_credit_card:{required:!0,creditcard:!0},val_terms:{required:!0}},messages:{val_username:{required:"Please enter a username",minlength:"Your username must consist of at least 2 characters"},val_password:{required:"Please provide a password",minlength:"Your password must be at least 5 characters long"},val_confirm_password:{required:"Please provide a password",minlength:"Your password must be at least 5 characters long",equalTo:"Please enter the same password as above"},val_email:"Please enter a valid email address",val_website:"Please enter your website!",val_date:"Please select a date!",val_range:"Please enter a number between 1 and 100!",val_number:"Please enter a number!",val_digits:"Please enter digits!",val_credit_card:"Please enter a valid credit card!",val_skill:"Please select a skill!",val_terms:"You must agree to the terms!"}}),$("#masked_date").mask("99/99/9999"),$("#masked_date2").mask("99-99-9999"),$("#masked_phone").mask("(999) 999-9999"),$("#masked_phone_ext").mask("(999) 999-9999? x99999"),$("#masked_taxid").mask("99-9999999"),$("#masked_ssn").mask("999-99-9999"),$("#masked_pkey").mask("a*-999-a999")});</script>
        <script>var _gaq=_gaq||[];_gaq.push(["_setAccount","UA-16158021-6"]),_gaq.push(["_setDomainName","pixelcave.com"]),_gaq.push(["_trackPageview"]),function(){var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src=("https:"==document.location.protocol?"https://ssl":"http://www")+".google-analytics.com/ga.js";var e=document.getElementsByTagName("script")[0];e.parentNode.insertBefore(t,e)}();</script>
</body>
</html>