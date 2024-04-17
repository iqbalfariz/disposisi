<?php
    $items = array("red","yellow",
                    "pink","green",
                    "purple","blue",
                    "orange","opal",
                    "ruby","brown",
                    "bronze","copper",
                    "ginger","tope",
                    "orange","light blue",
                    "light green","dark yellow",
                    "grey","black",
                    "white","gold",
                    "silver");

    $thispage = $PHP_SELF ;
    $num = count($items); // number of items in list
    $per_page = 2; // Number of items to show per page
    $showeachside = 5 //  Number of items to show either side of selected page

    if(empty($start))$start=0;  // Current start position

    $max_pages = ceil($num / $per_page); // Number of pages
    $cur = ceil($start / $per_page)+1; // Current page number
?>
<style type="text/css">
<!--
.pageselected {
    color: #FF0000;
    font-weight: bold;
}
-->
</style>
<table width="400" border="0" align="center" cellpadding="0" cellspacing="0" class="PHPBODY">
<tr> 
<td width="99" align="center" valign="middle" bgcolor="#EAEAEA"> 
<?php
if(($start-$per_page) >= 0)
{
    $next = $start-$per_page;
?>
<a href="<?php print("$thispage".($next>0?("?start=").$next:""));?>"><<</a> 
<?php
}
?>
</td>
<td width="201" align="center" valign="middle" class="selected">
Page <?php print($cur);?> of <?php print($max_pages);?><br>
( <?php print($num);?> records )
</td>
<td width="100" align="center" valign="middle" bgcolor="#EAEAEA"> 
<?php 
if($start+$per_page<$num)
{
?>
<a href="<?php print("$thispage?start=".max(0,$start+$per_page));?>">&gt;&gt;</a> 
<?php
}
?>
</td>
</tr>
<tr><td colspan="3" align="center" valign="middle">&nbsp;</td></tr>
<tr> 
<td colspan="3" align="center" valign="middle" class="selected"> 
<?php 
$eitherside = ($showeachside * $per_page);
if($start+1 > $eitherside)print (" .... ");
$pg=1;
for($y=0;$y<$num;$y+=$per_page)
{
    $class=($y==$start)?"pageselected":"";
    if(($y > ($start - $eitherside)) && ($y < ($start + $eitherside)))
    {
?>
&nbsp;<a class="<?php print($class);?>" href="<?php print("$thispage".($y>0?("?start=").$y:""));?>"><?php print($pg);?></a>&nbsp; 
<?php
    }
    $pg++;
}
if(($start+$eitherside)<$num)print (" .... ");
?>
</td>
</tr>
<tr>
<td colspan="3" align="center">
<?php
    for($x=$start;$x<min($num,($start+$per_page)+1);$x++)print($items[$x]."<br>");
?>
</td>
</tr>
</table>