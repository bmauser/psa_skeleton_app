<!DOCTYPE html>
<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>{$html_page_title}</title>
		
		{foreach $include_js as $js_file}
		<script type="text/javascript" src="{$psa_result->basedir_web}/{$js_file}"></script>
		{/foreach}
		
		{foreach $include_css as $css_file}
		<link href="{$psa_result->basedir_web}/{$css_file}" rel="stylesheet" media="screen" type="text/css" />
		{/foreach}
	</head>

	<body>
		{$content_main}
	</body>
</html>
