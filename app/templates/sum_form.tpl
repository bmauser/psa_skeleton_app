<form id="form1" name="form1" method="post" action="{$psa_result->basedir_web}/default/calculate">
<table border="0" cellspacing="0" cellpadding="5">
	<tr>
		<td>Number 1:</td>
		<td><input type="text" name="num1" id="num1" /></td>
	</tr>
	<tr>
		<td>Number 2:</td>
		<td><input type="text" name="num2" id="num2" /></td>
	</tr>
	<tr>
		<td>Sum:</td>
		<td><div id="sum_result">{$sum_result}</div></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>{if !$ajax_form}
			<input type="submit" name="calbutton" id="calbutton" value="Calculate sum" />
			{else}
			<input type="button" name="calbutton" id="calbutton" value="Calculate sum with ajax" onclick="sum_ajax();" />
			{/if}
		</td>
	</tr>
</table>
</form>

<p>Numbers must be integers for sum calculation.<br />
Try to enter  non integer value also.</p>
