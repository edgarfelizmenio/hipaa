<?php include_once('lib/common.php'); ?>
<html>
 <head>
   <?php include('tpl/header.php'); ?>
   <script type="text/javascript">
     window.onload = function() {
     dynamicSelect("pda-brand", "pda-type");
     }
     </script>
 </head>
 <body>
   <?php include('tpl/msg_menu.php'); ?>




   <h3> Testing values </h3>

   <form action="#">

     <div>
       <select id="pda-brand">
	 <option rel="none" value="select">Select PDA brand...</option>
	 <option rel="none" value="dell">Dell</option>
	 <option rel="none" value="hp">HP</option>
	 <option rel="none" value="palmone">PalmOne</option>
	 <option rel="secret" value="other">Secret other</option>
	 </select>

       <select id="pda-type">
	 <option class="select" value="select">Select PDA type...</option>
	 <option class="dell" value="aximx30">Axim X30</option>
	 <option class="dell" value="aximx50">Axim X50</option>
	 <option class="hp" value="ipaqhx2750">iPAQ hx2750</option>
	 <option class="hp" value="ipaqrx3715">iPAQ rx3715</option>
	 <option class="hp dell other" value="Both HP and Gell">HP & DELL</option>
	 <option class="hp" value="ipaqrz1710">iPAQ rz1710</option>
	 <option class="palmone" value="tungstene2">Tungsten E2</option>
	 <option class="palmone" value="tungstent5">Tungsten T5</option>
	 <option class="palmone other" value="zire72">Zire 72</option>
	 </select>
       </div>

     <div rel="secret">
       More input fields based on selection
     </div>
     </form>


 </body>
</html>
