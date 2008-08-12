<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <?php include('tpl/header.php'); ?>
    <link rel="stylesheet" href="tpl/site.css" />
    <link rel="stylesheet" href="tpl/form.css" />
    <script type="text/javascript" src="lib/js/jquery-1.2.6.js"> </script>          
    <script type="text/javascript" src="lib/js/enforcer.js"></script>
    <script type="text/javascript" src="lib/js/usableforms.js"></script>

   <script type="text/javascript">
   $(document).ready(function() {
       // initialize update box if there is a prolog box to use
       if ($('#prolog').length > 0) {
	 initUpdate();
       }
       
       // style table rows
       $(".striped tr:even").addClass("alt");
     });
   </script>