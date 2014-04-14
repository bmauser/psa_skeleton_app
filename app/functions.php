<?php

/**
 * Checks for user ID in the session and restores user data.
 *
 * Also checks username and password if are sent from login form and tries to authorize the user.
 * This function will be called in most actions so I put it here in global scope.
 * In case of invalid authorization Unauthorized_Exception will be thrown.
 *
 * @throws Unauthorized_Exception
 */
function check_login(){

	try{
		// Check if we have user id in the session. This means that user is already logged in.
		if(isset($_SESSION['psa_current_user_data']['username']) && $_SESSION['psa_current_user_data']['username']){
			$user = new User($_SESSION['psa_current_user_data']['username']);
			$user->restore();
		}

		// Login user with username and password
		else if(isset($_POST['login_user']) && $_POST['login_user'] && isset($_POST['login_pass']) && $_POST['login_pass']){

			$user = new User($_POST['login_user']);
			try{
				$user->authorize($_POST['login_pass']);
			}
			catch(Psa_User_Exception $e){
				Psa_Result::get_instance()->unsuccessful_authorize = true;
				throw $e; // rethrow Psa_User_Exception exception
			}

			$user->save_last_login_time();
		}
		else
			throw new Exception();

		// put reference to user object into the registry object
		Psa_Registry::get_instance()->user = $user;

	}
	catch (Exception $e){
		throw new Unauthorized_Exception('Login needed.');
	}
}
