<?php

/**
 * Model
 */
class Example extends Psa_Model {
		
	
	/**
	 * Checks if arguments are integers and sums them
	 */
	function sum($number1, $number2){
		
		// input validation
		$validator = new Psa_Validator();
		$validator->required($number1, 'int');
		$validator->required($number2, 'int');
		
		// sum numbers
		return $number1 + $number2;
	}
}
