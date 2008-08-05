<?php include_once('lib/common.php'); ?>
<?php include('tpl/header_top.php'); ?>
<title>Messaging Demo</title>
<?php include('tpl/header_bot.php'); requireLogin(false);?>

<h2>Simple hospital messaging + Prolog</h2>
<div id="content">
<p>Welcome to the HIPAA Compliance Checker Demo site</p>
<p>
The demo shows how the HIPAA Compliance checker can be integrated into
existing systems to enforce policies.  In this case, we have a simple hospital
message system that follows HIPAA guidelines.   Messages are not allowed
if they violate HIPAA in some way.  The demo also shows possible courses
of actions based on certain situations.  Please go to the <a href='write.php'>write a message
page</a> to view the example.
</p>
</div>
<?php include('tpl/footer.php'); ?>

