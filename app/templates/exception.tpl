<div class="alert alert-danger">
	<p>Exception:  {$exception.type}</p>
	<p>
		Message:  {$exception.msg}
		{if $exception.code}
		<br />
		Code:  {$exception.code}
		{/if}
	</p>
</div>
