{if $exception.type}Exception:  {$exception.type|escape:html}{else}Error{/if} 
{if $exception.msg}Message:  {$exception.msg|escape:html}{/if} 
{if $exception.code}Code:  {$exception.code|escape:html}{/if} 
{if $exception.trace}Trace:
{$exception.trace|escape:html}{/if}
