{{$header}}
<h1>{{$meta.title}}</h1>
<h2 class="staticheading">Forgot Password?</h2>
<div class="static-pages">
	{{if $smarty.request.status eq 'success'}}
		<div class="success">A password reminder email was sent to you. Please click on the link in the email to change your password.</div>
	{{else}}
		{{if $smarty.request.status eq 'failed'}}
			<div class="fail">This email address is not registered with us.</div>
		{{/if}}
	<div class="form" style="width:500px;">
		<form action="{{#server_url#}}inc/forgotpassword.php" method="POST" onsubmit="javascript: return validateForm(this);" name="frmForm1" id="frmForm1">
			<table>
				<tr>
					<td class="label">Email</td>
					<td><input type="text" spellcheck="false" name="email" id="email" size="24" maxlength="128" value="{{$smarty.request.email}}" validation="required,email" /></td>
				</tr>
				<tr>
				    <td />
				    <td>{{include file="includes/captcha.tpl"}}</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type="submit" class="register-btn2" value="Send Reminder" />
					</td>
				</tr>
			</table>
		</form>
	</div>
	{{/if}}
</div>
{{$footer}}