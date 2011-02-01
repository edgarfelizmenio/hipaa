<table class="parent-panel">
<tr>
<td class="left-panel-header">
<div class="left-panel-topbar">
<button id="button_compose_" name= "compose_" class="left-panel-topbar-buttons" onclick="window.location = &quot;index.php?tab=mail&amp;target=compose&quot;;">Compose New Message</button>
</div>
</td>
<td class="msg-panel-header">
<div class = "horizontal-nav">
<ul>
<li><a href = "index.php?tab=mail">Mail</a></li>
<li class="active"><a href = "index.php?tab=tour">Product Tour</a></li>
<li><a href = "index.php?tab=guide">HIPAA Guide</a></li>
<li><a href = "index.php?tab=preferences">Preferences</a></li>
</ul>
</div>
</td>
</tr>
<tr class="main-panel">
<td class="left-panel">
<?php
require_once "leftbar.php";
?>
</td>

<td class="msg-panel">
<?php
require_once "tour/index.php";
?>
</td>
</tr>
</table>