<table class="msg-panel-topbar-submenu" style="margin:0px;">
<tr>
<td>
</td>
</tr>
</table>
<div style="background-color:#FFF; height:100%;">	
    <ul> <li><a href="index.php?tab=guide&amp;display=HIPAA/H164.502">164.502 Uses and disclosure of protected health information</a>
    <ul>
    <li> <a href="index.php?tab=guide&amp;display=HIPAA/H164.502.a">164.502.a Standard</a></li>
    <li> <a href="index.php?tab=guide&amp;display=HIPAA/H164.502.b">164.502.b Standard: Minimum necessary</a></li>
    <li> <a href="index.php?tab=guide&amp;display=HIPAA/H164.502.c">164.502.c Standard: Uses and disclosure of protected health information subject to an agreed upon restriction</a></li>
    <li> <a href="index.php?tab=guide&amp;display=HIPAA/H164.502.d">164.502.d Standard: Uses and disclosures of de-identified protected health information</a></li>
    <li> <a href="index.php?tab=guide&amp;display=HIPAA/H164.502.e">164.502.e Standard: disclosure to business associates</a></li>
    <li><a href="index.php?tab=guide&amp;display=HIPAA/H164.502.f">164.502.f Standard: Deceased individuals</a></li>
    <li> <a href="index.php?tab=guide&amp;display=HIPAA/H164.502.g">164.502.g Standard: Personal representatives</a></li>
    <li> <a href="index.php?tab=guide&amp;display=HIPAA/H164.502.h">164.502.h Standard: Confidential communication</a></li>
    <li> <a href="index.php?tab=guide&amp;display=HIPAA/H164.502.i">164.502.i Standard: Uses and disclosure consistent with notice</a></li>
    <li> <a href="index.php?tab=guide&amp;display=HIPAA/H164.502.j">164.502.j Standard: Disclosures by whistleblowers and workforce member crime victims</a></li>
    </ul>
    </li>
    <li>
    <a href="index.php?tab=guide&amp;display=HIPAA/H164.506">164.506 Uses and disclosure to carry out treatment, payment, or health care operations. </a>
    </li>
    </ul>
    <hr />
    <?php
	if(isset($_GET["display"])){
		$fname = $_GET["display"];
		$filepath = "hipaa-guide/files/" . $fname . ".txt";
		$file=fopen($filepath,"r") or print "Unable to open file!";
		echo "<h1 style= \"margin-left:20px;\"> $fname </h1>";
		echo "<p style= \"margin-left:30px;\">";		
		while (!feof($file)) {				
			echo fgets($file). "<br />";				
		}
		echo '</p>';
		fclose($file);
	}
	?>
    
</div>

