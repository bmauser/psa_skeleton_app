<div class="container container-signin">
	
	<h2 class="form-signin-heading">{$psa_result->html_page_title} <span id="header_ver">ver. {$psa_result->app_version}</span></h2>
	
	<form class="form-signin" role="form" action="{$psa_result->basedir_web}/" method="post">
		
		<input type="text" name="login_user" class="form-control" placeholder="Username" required autofocus>
		
		<input type="password" name="login_pass" class="form-control" placeholder="Password" required>
		
		<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
	</form>
	
	{if $error}
	<div class="error-signin">
		{$error}
	</div>
	{/if}
</div>
