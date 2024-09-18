{{$header}}
<h1>{{$meta.title}}</h1>
<h2 class="staticheading">Choose New Password</h2>
<div class="static-pages">
{{if $smarty.request.status eq 'failed'}}
	<div class="divfail">Something went wrong. We were not able to update your password.</div>
{{/if}}
{{if $row}}
	<div class="form">
		<form action="{{#server_url#}}inc/resetpass.php" method="POST" onsubmit="javascript: if(true || $('#pass').val() == $('#pass2').val()) return validateForm(this); else { failField('pass2'); return false;}" name="frmForm1" id="frmForm1">
			<input type="hidden" name="userid" value="{{$userid}}" />
			<input type="hidden" name="email" value="{{$smarty.request.email}}" />
			<input type="hidden" name="code" value="{{$smarty.request.code}}" />
			<div class="">
				<table>
					<tr>
						<td class="label">Password</td>
						<td>
							<input type="password" name="pass" value="" id="pass" size="24" maxlength="32" validation="required,password" />
                            <div class="notice">Should be 5-16 characters in length.</div>
						</td>
					</tr>
					<tr>
						<td class="label">Retype Password</td>
						<td>
							<input type="password" value="" id="pass2" size="24" maxlength="32" validation="required,password" />
                            <div class="notice">Should be same as above password.</div>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input class="register-btn2" type="submit" value="Update" />
						</td>
					</tr>
				</table>
			</div>
		</form>
	</div>
{{else}}
	<div class="fail">This is not a valid URL. Please visit our <a href="{{#server_url#}}forgot-password">forgot password</a> page to receive a new password reset URL.</div>
{{/if}}
</div>
{{$footer}}
