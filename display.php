<?php include("pageTop.html"); ?>

	<form name=fileform method=GET action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
   	<?php 
      $fn = htmlspecialchars($_GET['fname']);
      $fLaw = "./Law/" . $fn . ".txt";
      $fPL = "./formalization/" . $fn . ".pl"; 
   	?>
	</form>
	   

<!-- start content -->
<div id="content">
  <div class="post">
	<h1 class="title"><?php echo $fn ?></h1>
	
	<div class="leftAlign"> 
   	<?php 
			ini_set('auto_detect_line_endings', true);
			if (file_exists($fLaw))
			{
      	$fp = fopen($fLaw, "r");
		    while(!feof($fp))
	      {
    	    $data = "";
        	$data .= fgets($fp, 4096);
        	echo $data; 
        	echo "<br /> "; 
      	}
			}
     ?>
     </div>
     
	<div class="rightAlign"> 
	<?php 
			ini_set('auto_detect_line_endings', true);
			if (file_exists($fPL))
			{
      	$fp = fopen($fPL, "r");
		    while(!feof($fp))
	      {
    	    $data = "";
        	$data .= fgets($fp, 4096);
        	echo $data; 
        	echo "<br /> "; 
      	}
			}
     ?>
     </div>

  </div>
</div>	
<!-- end content -->

<?php include("pageBottom.html"); ?>

