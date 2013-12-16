<div id="header_main">
	<div id="header_logo">
		{$psa_result->html_page_title} <span id="header_ver">ver. {$psa_result->app_version}</span>
	</div>

	{if $username}
	<div id="header_right">
	user: <strong>{$username}</strong>
	</div>
	{/if}
</div>
<div class="clear_float"></div>