<script language="JavaScript" type="text/javascript">
function setFields() {
	window.opener.document.storyPageForm.senderEmail.value = document.emailForm.senderEmail.value;
	window.opener.document.storyPageForm.destinationEmail.value = document.emailForm.destinationEmail.value;
}
</script>

<form name="emailForm" method="post" action="#">
<p>What is your e-mail address?<br />
<input type="text" name="senderEmail">
</p>
	
<p>Who would you like to send the article to?<br />
<input type="text" name="destinationEmail"></p>
<button type="button" onclick="setFields();window.opener.storyPageForm.submit();" name="submit" value="send e-mail">Send e-mail</button>
</form>