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
<li class="active"><a href = "index.php?tab=mail">Mail</a></li>
<li><a href = "index.php?tab=tour">Product Tour</a></li>
<li><a href = "index.php?tab=guide">HIPAA Guide</a></li>
<li><a href = "index.php?tab=preferences">Preferences</a></li>
</ul>
</div>
</td>
</tr>
<tr class="main-panel">
<td class="left-panel">
<div class="left-panel-content-area">
<div class="verticle-nav">
<ul>
<li><a href="index.php?tab=mail&amp;target=inbox">Inbox</a></li>
<li><a href="index.php?tab=mail&amp;target=sent">Sent</a></li>
<li><a href="index.php?tab=mail&amp;target=draft">Draft</a></li>
<li class="active"><a href="index.php?tab=mail&amp;target=thrash">Thrash</a></li>
</ul>		
</div>
</div>
</td>

<td class="msg-panel">
<table class="msg-panel-topbar-submenu">
<tr>
<td>
</td>
</tr>
</table>
<table class="msg-panel-topbar">
<tr>
<td>
<button id="button_send_" name= "send_" class="msg-panel-topbar-submenu-buttons">Send</button>
<button id="button_save_draft" name= "save_draft" class="msg-panel-topbar-submenu-buttons">Save Draft</button>
<button id="button_hippa_check_" name= "hippa_check_" class="msg-panel-topbar-submenu-buttons">HIPAA Check</button>
<button id="button_cancel_" name= "cancel_" class="msg-panel-topbar-submenu-buttons">Cancel</button>

</td>
</tr>
<tr>
<td>
<button id="button_to_" name= "about_" class="msg-panel-topbar-buttons">To:</button>
<input type="text" id= "text_to_"  name="to_" value="" class="msg-panel-topbar-textbox" />
</td>
</tr>
<tr>
<td>
<button id="button_about_" name= "about_" class="msg-panel-topbar-buttons">About:</button>
<input type="text" id= "text_about_" name= "about_"  value="" class="msg-panel-topbar-textbox" />
</td>
</tr>
<tr>
<td>
<button id="button_purpose_" name= "purpose_" class="msg-panel-topbar-buttons">Purpose:</button>
<input type="text" id="text_purpose_" name= "purpose_"  value="" class="msg-panel-topbar-textbox" />
</td>
</tr>
<tr>
<td>

</td>
</tr>
</table>
<textarea class="msg-panel-textarea" rows="100" cols="100">
</textarea>
</td>
</tr>
</table>