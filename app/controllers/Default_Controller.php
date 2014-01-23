<?php

/**
 * Controller class.
 */
class Default_Controller{


	/**
	 * Default action
	 */
	function default_action(){

		// ensure that user is logged in
		check_login(isset($_GET['aaieduhr_sso_login']));

		$main_view = new Main_View();
		$main_view->generate_html();
	}


	/**
	 * Login
	 */
	function login_action($msg_type = null){

		$main_view = new Main_View();
		$main_view->login($msg_type);
		$main_view->generate_html();
	}


	/**
	 * Logout
	 */
	function logout_action(){

		// kill session and delete cookie
		$_SESSION = array();
		if(isset($_COOKIE[session_name()])){
			setcookie(session_name(), '', time() - 42000, '/');
			$_COOKIE = array();
		}

		session_destroy();

		// go to login
		$this->login_action();
	}


	/**
	 * Sum
	 */
	function sum_action(){

		check_login();

		$sum_view = new Sum_View();
		$sum_view->sum();

		$main_view = new Main_View();
		$main_view->generate_html();
	}


	/**
	 * Sum with ajax
	 */
	function sumajax_action(){

		check_login();

		$sum_view = new Sum_View();
		$sum_view->sum_ajax();

		$main_view = new Main_View();
		$main_view->generate_html();
	}


	/**
	 * Calculates sum
	 */
	function calculate_action(){

		check_login();

		$sum = new Example();
		$sum_result = $sum->sum($_POST['num1'], $_POST['num2']);

		$sum_view = new Sum_View();
		$sum_view->sum($sum_result);

		$main_view = new Main_View();
		$main_view->generate_html();
	}


	/**
	 * Calculates sum with ajax
	 */
	function calculateajax_action(){

		check_login();

		$sum = new Example();
		$sum_result = $sum->sum($_POST['num1'], $_POST['num2']);

		$sum_view = new Sum_View();
		$sum_view->sum_result_ajax($sum_result);

		$main_view = new Main_View();
		$main_view->generate_html();
	}
}
