<?php
	include "inc/conn.php";
?>
<select name="pengirim"  onchange="tes(this.value)">
				<option></option>
				<?php
					$sql="select * from tbl_kode_pengirim where jenis='$_GET[id]'";
					$eks=pg_query($sql);
					while($rs=pg_fetch_array($eks)){
						echo "<option value='".$rs['kode_pengirim']."'>".$rs['pengirim']."</option>";
					}
				?>
				
			</select>