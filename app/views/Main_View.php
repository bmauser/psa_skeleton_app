<?php

/**
 * Main View class.
 */
class Main_View extends Psa_Smarty_View{


	/**
	 * Login page.
	 */
	function login($msg_type = null){

		// authorization error
		if($msg_type == 'unsuccessful'){
			$this->psa_smarty->assign('error', 'You entered invalid username or password.');
		}
		// SSO unpermited user
		else if($msg_type == 'unpermittedsso'){
			$this->psa_smarty->assign('error', 'You have successfully signed in with AAI@EduHr SSO service, but access to this application is denied.<br/> Click <a href="' . $this->psa_registry->base_url . '/default/ssologout">here</a> to sign out from AAI@EduHr SSO service.');
		}
		// SSO single logout
		else if($msg_type == 'singlelogout'){
			$this->psa_smarty->assign('error', 'You have been logged out by AAI@EduHr single logout request probably from some other service.');
		}

		// show AAI login link
		if(isset($this->psa_registry->CFG['login_method']['aaieduhr_sso']) && $this->psa_registry->CFG['login_method']['aaieduhr_sso']){
			$this->psa_smarty->assign('aaieduhr_sso_login_url', $this->psa_registry->CFG['simplesamlphp']['after_sso_login_url']);
		}


		$this->psa_smarty->assign('login_method', $this->psa_registry->CFG['login_method']);
		$this->psa_smarty->assign('content_main', $this->psa_smarty->fetch('login.tpl'));
	}


	/**
	 * Main layout render and display method.
	 *
	 * This method determine if request is made by ajax or not and prints only
	 * ajax result or whole HTML page.
	 */
	function generate_html(){


		// if this is ajax request just echo content
		if(@$this->psa_result->ajax_request){
			header ("Content-Type: text/html; charset=utf-8");
			if(isset($this->psa_result->ajax_response))
				echo $this->psa_result->ajax_response;
			else
				echo @$this->psa_smarty->getTemplateVars('content');
		}
		// render complete page
		else{

			if(isset($this->psa_registry->CFG['js_files']))
				$this->psa_smarty->assign('include_js', $this->psa_registry->CFG['js_files']);
			if(isset($this->psa_registry->CFG['css_files']))
				$this->psa_smarty->assign('include_css', $this->psa_registry->CFG['css_files']);

			// put username into template values if user is logged in
			if(isset($this->psa_registry->user->username))
				$this->psa_smarty->assign('username', $this->psa_registry->user->username);

			// asign page header and main menu
			$this->psa_smarty->assign('header_main', $this->psa_smarty->fetch('header_main.tpl'));

			if(isset($this->psa_registry->user->username)){ // do not show menu if user is not logged in
				if(isset($this->psa_registry->user->sso) && $this->psa_registry->user->sso)
					$this->psa_smarty->assign('sso_user', 1);
				$this->psa_smarty->assign('layout_left', $this->psa_smarty->fetch('menu_main.tpl'));
			}

			// html page main content
			if(!$this->psa_smarty->getTemplateVars('content_main')){
				$this->psa_smarty->assign('content_main', $this->psa_smarty->fetch('layout_main.tpl'));
			}

			// echo complete rendered page
			echo $this->psa_smarty->fetch('main.tpl');
		}
	}


	/**
	 * Sends Location header to redirect browser
	 *
	 * @param string $url
	 */
	function redirect($url = ''){

		$url = $this->psa_registry->basedir_web . '/' . $url;

		if(!headers_sent()){
			// is ajax request
			if(@$this->psa_result->ajax_request){
				header('HTTP/1.1 310 redirect');
				echo $url;
			}
			else{
				header('Location: ' . $url);
			}
		}

		exit;
	}


	/**
	 * On uncaught exception
	 *
	 * @param exception $e
	 */
	function uncaught_exception($e){

		// get data from exception
		$exception['code'] = $e->getCode();
		$exception['msg'] = $e->getMessage();
		$exception['type'] = get_class($e);

		// if this is ajax request
		if(isset($this->psa_result->ajax_request) && $this->psa_result->ajax_request){

			// send 500 header
			if(!headers_sent())
				header('HTTP/1.1 500 Internal Server Error');

			$this->psa_smarty->assign('exception', $exception);
			echo $this->psa_smarty->fetch('exception_ajax.tpl');
		}
		else{
			$this->psa_smarty->assign('exception', $exception);
			$this->psa_smarty->assign('content', $this->psa_smarty->fetch('exception.tpl'));
			$this->generate_html();
		}

		exit;
	}
}
