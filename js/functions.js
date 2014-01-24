

/**
 * global ajax error setup
 */
$(document).ready(function () {
	
	$(document).ajaxError(function(event, request, settings){
		
		// redirect
		if(request.error().status == '310')
			window.location = request.responseText;
		else if(request.responseText)
			alert(request.responseText);
		else
			alert("Error requesting page: " + settings.url);
	})
});


/**
 * Does sum with ajax
 */
function sum_ajax(){
	$('#sum_result').load('calculateajax', {num1: $('#num1').val(), num2: $('#num2').val()});
}