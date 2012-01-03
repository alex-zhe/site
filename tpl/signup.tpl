<to>right</to>

<content>
<form target="frame" method="post" action="register.php" name="form" id="form" enctype=multipart/form-data>
<label for="login">Login:</label>
<br>
<input type="text" id="login" name="login">
<br>
<label for="pass">Pass:</label>
<br>
<input type="password" id="pass" name="pass">
<br>
<label for="confirm">Confirm:</label>
<br>
<input type="password" id="confirm" name="confirm">
<br>
<label for="file">Photo:</label>
<br>
<input type=file name="file" id="file">
<br>
<a style="float:right" href="#" onClick="document.form.submit()"><img src="img/signup_btn.png" alt="Sign Up"></a>
</form>
</content>