<?php include("pageTop.html"); ?>

	<form name=fileform method=GET action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
   	<?php 
      $fn = htmlspecialchars($_GET['fname']);
      $fPL = "./formalization/" . $fn . ".pl"; 
   	?>
	</form>
	   

<!-- start content -->
<div id="content">
  <div class="post">
	<h1 class="title"><?php echo $fn ?></h1>
	
	<div class="entry"> 
	<?php 
		ini_set('auto_detect_line_endings', true);
      	$fp = fopen($fPL, "r");
		while(!feof($fp))
	    {
        	echo fgets($fp, 4096) . "<br /> "; 
      	}
     ?>
     </div>

  </div>
</div>	
<!-- end content -->

<?php include("pageBottom.html"); ?>

