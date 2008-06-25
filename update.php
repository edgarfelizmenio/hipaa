<html>
<body>
<pre>
Preparing to update...
svn cleanup
<?php
$output = shell_exec("svn cleanup 2>&1");
echo $output;
?>
svn update
<?php
$output = shell_exec("svn update 2>&1");
echo $output;
?>
done!
</pre>
</body>
</html>

