<html>
<body>
<pre>
Preparing to update...
svn update
<?php
$output = shell_exec("svn update 2>&1");
echo $output;
?>
done!
</pre>
</body>
</html>

