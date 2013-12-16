<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$html_page_title}</title>

{foreach from=$include_js item=js_file}
	<script type="text/javascript" src="{$psa_result->basedir_web}/{$js_file}"></script>
{/foreach}

{foreach from=$include_css item=css_file}
	<link href="{$psa_result->basedir_web}/{$css_file}" rel="stylesheet" media="screen" type="text/css" />
{/foreach}

<script type="text/javascript">
{foreach from=$js_code item=js_source}
	{$js_source}
{/foreach}
</script>

</head>

<body>
	{$content_main}
</body>
</html>
