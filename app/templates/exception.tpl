<div class="alert alert-danger">
	{if $exception.type}
	<p>Exception:  {$exception.type|escape:html}</p>
	{/if}
	
	{if $exception.msg}
	<p>
		Message:  {$exception.msg|escape:html}
		{if $exception.code}
		<br />
		Code:  {$exception.code|escape:html}
		{/if}
	</p>
	{/if}
	
	{if $exception.trace}
	<p>Trace:</p>
	<pre class="text-left">
{$exception.trace|escape:html}
	</pre>
	{/if}
</div>
