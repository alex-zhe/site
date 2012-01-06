<to>right</to>

<content>
<form target="frame" method="post" action="register.php" name="form" id="form" enctype=multipart/form-data>
<label class="labels" for="login">Login*:</label>
<br>
<input class="inputs" type="text" id="login" name="login">
<br>
<label class="labels" for="pass">Pass*:</label>
<br>
<input class="inputs" type="password" id="pass" name="pass">
<br>
<label class="labels" for="confirm">Confirm*:</label>
<br>
<input class="inputs" type="password" id="confirm" name="confirm">
<br>
<label class="labels" for="Name">Name*:</label>
<br>
<input class="inputs" type="text" id="name" name="name">
<br>
<label class="labels" for="secondname">secondname*:</label>
<br>
<input class="inputs" type="secondname" id="secondname" name="secondname">
<br>
<label class="labels" for="birthday">birthday:</label>
<br>
<input class="inputs" type="text" id="birthday" name="birthday">
<br>
<label class="labels" for="male">Male:</label>
<br>
<select class="inputs"  id="male" name="confirm">
<option value="Male">Male</option>
<option value="Female">Female</option>
</select>
<br>
<label class="labels" for="hobbies">Hobbies:</label>
<br>
<textarea class="inputs" id="hobbies" name="hobbies">
</textarea>
<br>
<label class="labels" for="music">Music:</label>
<br>
<textarea class="inputs" id="music" name="music">
</textarea>
<br>
<label class="labels" for="cinema">Cinema:</label>
<br>
<textarea class="inputs" id="cinema" name="cinema">
</textarea>
<br>
<label class="labels" for="file">Photo:</label>
<br>
<input class="inputs" type=file name="file" id="file">
<br>
<a style="float:right" href="#" onClick="document.form.submit()"><img src="img/signup_btn.png" alt="Sign Up"></a>
</form>
</content>