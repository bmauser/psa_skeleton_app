<div class="login_page_content"> {$header_main}
	<form action="{$psa_result->basedir_web}/" method="post" name="login_form" id="login_form">
		<table width="100%" border="0" cellpadding="5" cellspacing="0" style="margin-top:10px;">
			<tr>
				<td width="1%">Username:</td>
				<td><input tabindex="1" name="login_user" type="text" id="login_user" size="25" /></td>
				<td class="login_enter" rowspan="2" align="right" valign="middle" nowrap="nowrap">
					<input tabindex="3" class="login_btt" id="login_btt" type="submit" value="Enter &gt;&gt;"/>
				</td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input tabindex="2" name="login_pass" type="password" id="login_pass" size="25" /></td>
			</tr>
			<tr>
				<td colspan="3" align="center" style="font-size:8pt;color:#437048;">{$error}</td>
			</tr>
		</table>
	</form>
</div>
{literal}
<script type="text/javascript">
	$('#login_user').focus();
</script>
{/literal}