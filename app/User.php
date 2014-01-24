<?php

/**
 * User object.
 *
 * It is always good to extend Psa_User and Psa_Group classes because
 * you'll probably need some custom field in the database or add some
 * method to the user object.
 * See documentation for details how to extend Psa_User class:
 * http://bojanmauser.from.hr/phpstartapp/reference/class-Psa_User.html
 */
class User extends Psa_User {

	public $id;
	public $username;
	public $sso;


	public function __construct($user_id_or_username){
		parent::__construct($user_id_or_username, array('id', 'username', 'sso'));
	}
}
