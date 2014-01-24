<?php

/**
 * This is application main file.
 * Use it as a bootstrap file.
 */


// application base filesystem path
define('APP_BASE_DIR', dirname(__FILE__));


include 'functions.php';


class Main extends Psa_Router{


	/**
	 * This is the first method that is called on every request.
	 *
	 * Here you start building your application.
	 */
	function psa_main(){

		// put config array to the registry object
		include APP_BASE_DIR . '/config.php';
		$this->psa_registry->CFG = &$CFG;

		// put some default values in result object
		if(@$_SERVER["HTTP_X_REQUESTED_WITH"] == 'XMLHttpRequest')
			$this->psa_result->ajax_request = 1;
		else
			$this->psa_result->ajax_request = 0;

		$this->psa_result->basedir_web     = $this->psa_registry->basedir_web;
		$this->psa_result->html_page_title = $this->psa_registry->CFG['app_name'];
		$this->psa_result->app_version     = $this->psa_registry->CFG['app_ver'];

		// start session
		session_start();

		// call action method from controller
		try{
			$this->dispach();
		}
		// redirect to login screen if Unauthorized_Exception is raised
		catch(Unauthorized_Exception $e){
			$main_view = new Main_View();
			if(isset($this->psa_result->unsuccessful_authorize))
				$main_view->redirect('default/login/unsuccessful');
			else if(isset($this->psa_result->unpermitted_sso_user))
				$main_view->redirect('default/login/unpermittedsso');
			else if(isset($this->psa_result->single_logout))
				$main_view->redirect('default/logout/singlelogout');
			else
				$main_view->redirect('default/login');
		}
		// show exception screen for any uncaught exception
		catch(Exception $e){
			$main_view = new Main_View();
			$main_view->uncaught_exception($e);
		}
	}
}
