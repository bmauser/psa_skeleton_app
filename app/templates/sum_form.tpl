<form class="form-horizontal" role="form" method="post" action="{$psa_result->basedir_web}/default/calculate">
	
	<div class="form-group">
		<label for="num1" class="col-sm-2 control-label">Number 1:</label>
		<div class="col-sm-2">
			<input type="text" class="form-control" name="num1" id="num1" />
		</div>
	</div>
	
	<div class="form-group">
		<label for="num2" class="col-sm-2 control-label">Number 2:</label>
		<div class="col-sm-2">
			<input type="text" class="form-control" name="num2" id="num2" />
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-2 control-label">Sum:</label>
		<div class="col-sm-2" id="sum_result">
			{$sum_result}
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-2">
			{if !$ajax_form}
			<button type="submit" class="btn btn-default">Calculate sum</button>
			{else}
			<button type="button" class="btn btn-default" onclick="sum_ajax();">Calculate sum with ajax</button>
			{/if} 
		</div>
	</div>
</form>


<p>Numbers must be integers for sum calculation.<br />Try to enter  non integer value also.</p>
