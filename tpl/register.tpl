<div class="register">
<form action="register.php" method=post enctype=multipart/form-data onSubmit="register_process()">
<table class="fields">
<tbody>
	<tr>
		<td class="label">
			<label for="login">Login: </label>
		</td>
		<td>
			<input name="login" type="text" id="login">
		</td>
	</tr>
	
	<tr>
		<td class="label">
			<label for="mail">Email: </label>
		</td>
		<td>
			<input name="mail" type="text" id="mail">
		</td>
	</tr>
	
	<tr>
		<td class="label" >
			<label for="pass">Password: </label>
		</td>
		<td class="input">
			<input name="pass" type="password" id="pass">
		</td>
	</tr>
	
	<tr>
		<td class="label" >
			<label for="pass_c">Confirm: </label>
		</td>
		<td class="input">
			<input name="pass_c" type="password" id="pass_c">
		</td>
	</tr>
	
	

	
	<tr>
	<td class="label">
		<label for="photo">Male: </label>
	</td>
	<td class="input">
		<select name="male">
			<option value="m">Male</option>
			<option value="f">Female</option>
		</select>
	</td>
	</tr>

	<tr>
	<td class="label">
		<label for="photo">Photo: </label>
	</td>
	<td class="input">
		<input type=file name=uploadfile>
	</td>
	</tr>
	
	<tr align="right" class="buttons">
		<td>
			<a href="#" onClick="Login()"><img src="back_to_login.png" alt="back to login"></a>
		</td>
		<td>
			<a href="#" onClick="document.forms[0].submit()">
				<img src="img/register_btn.jpg" height="40px">
			</a>
		</td>
	</tr>
</tbody>
</table>
</form>
</div>


