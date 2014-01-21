<div id="top-nav" class="navbar navbar-inverse navbar-static-top">
	
	<div class="navbar-header">
		<a class="navbar-brand" href="{$psa_result->basedir_web}/">{$psa_result->html_page_title} <span id="header_ver">ver. {$psa_result->app_version}</span></a>
	</div>
	
	{if $username}
	<div class="navbar-collapse collapse">
		<ul class="nav navbar-nav pull-right">
			<li><a><i class="fa fa-user fa-lg"></i>user: <strong>{$username}</strong></a></li>
		</ul>
	</div>
	{/if}
</div>
