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
function check_login($aaieduhr_sso = false){

	try{

		$psa_registry = Psa_Registry::get_instance();

		// Check if we have user id in the session. This means that user is already logged in.
		if(isset($_SESSION['psa_current_user_data']['id']) && $_SESSION['psa_current_user_data']['id']){
			$user = new User($_SESSION['psa_current_user_data']['id']);
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

		// AAI@EduHr SSO login
		else if(isset($psa_registry->CFG['login_method']['aaieduhr_sso']) && $psa_registry->CFG['login_method']['aaieduhr_sso'] && $aaieduhr_sso){

			require_once($psa_registry->CFG['simplesamlphp']['include']);
			$as = new SimpleSAML_Auth_Simple($psa_registry->CFG['simplesamlphp']['authentication_source']);

			// check if SSO session is valid
			if(!$as->isAuthenticated()){
				$as->requireAuth(array('ReturnTo' => $psa_registry->CFG['simplesamlphp']['after_sso_login_url']));
			}

			$sso_attributes = $as->getAttributes();

			if(!isset($sso_attributes['hrEduPersonUniqueID'][0]))
				throw new SSO_Exception('No valid result from SSO service.', 5);


			// if SSO user is not allowed
			if(!is_allowed_sso_user($sso_attributes['hrEduPersonUniqueID'][0])){
				$psa_result->unpermitted_sso_user = $sso_attributes['hrEduPersonUniqueID'][0];
				throw new SSO_Exception('Unpermited SSO user ' . $sso_attributes['hrEduPersonUniqueID'][0], 3);
			}

			try{
				$user = new User($sso_attributes['hrEduPersonUniqueID'][0]);
				$user->authorize();
			}
			catch(Psa_User_Exception $e){

				// create a new user if not exists
				try{
					$user = new User('new');
					$user->username = $sso_attributes['hrEduPersonUniqueID'][0];
					$user->password = md5(microtime()); // anything because password is useless for SSO users
					$user->sso = 1;
					$user->save();
					$user->authorize();
				}
				catch(Psa_User_Exception $e){
					throw new SSO_Exception('Error creating new user ' . $sso_attributes['hrEduPersonUniqueID'][0], 2);
				}
			}

			$user->save_last_login_time();
		}

		else
			throw new Exception();

		// put reference to user object into the registry object
		$psa_registry->user = $user;

	}
	catch (Exception $e){
		throw new Unauthorized_Exception('Login needed.', false);
	}
}


/**
 * Checks if SSO user is allowed to sign in.
 *
 * Checks if username match pattern in $CFG['sso']['allowed_users'] array.
 *
 * @param string $sso_username SSO username
 * @return bool
 */
function is_allowed_sso_user($sso_username){

	$CFG = Psa_Registry::get_instance()->CFG;

	// check for allowed user
	if(isset($CFG['sso']['allowed_users']) && is_array($CFG['sso']['allowed_users'])){
		foreach ($CFG['sso']['allowed_users'] as $regex){
			if($regex && preg_match('/^'.$regex.'$/', $sso_username))
				return 1;
		}
	}

	return 0;
}
