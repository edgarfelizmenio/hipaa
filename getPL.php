<html>

<head>
<title>Display file</title>
</head>

<body bgcolor=white
background="./image001.jpg" lang=EN-US
link="#996600" vlink="#666666" style='tab-interval:.5in'>
<div class=Section1>

<font size="2" face="Verdana">

<h4><CENTER> Prolog Source Code </CENTER> </h4>

<form name=fileform method=GET action="<?php echo htmlspecialchars($_SERVER['PHP_SE
LF'])?>">

<table cellpadding=0 cellspacing=0 align=center>
 <tr>
  <td width=9 height=0></td>
 </tr>
 <tr>
<td>
 <pre>
  <?php 

      $fp = fopen($_GET['fname'], "r");
 
	echo "<font size=\"2\" face=\"Courier\">";  
  while(!feof($fp))
      {
        $data = "";
        $data .= fgets($fp, 4096);
        echo $data; 
      }

      ?>

  </pre>
 </td>
 </tr>
</table>

</span><o:p></o:p></p>



</div>
<p class=MsoNormal><o:p></o:p></p>
<p class=MsoNormal><o:p></o:p></p>
<p class=MsoNormal><o:p></o:p></p>
<p class=MsoNormal><o:p></o:p></p>
<p class=MsoNormal><o:p></o:p></p>
<p class=MsoNormal><o:p></o:p></p>
<p class=MsoNormal><o:p></o:p></p>
<p class=MsoNormal><o:p></o:p></p>

</body>

</html>
