<?php
class FX_Controller_MyAuthAdapter implements Zend_Auth_Adapter_Interface
{
	/**
	 * Name of user
	 * @var unknown_type
	 */
	private $userName;
	
	/**
	 * Password given by user
	 * @var unknown_type
	 */
	private $passWord;

	/**
	 * Sets user nam and pass
	 * @return void
	 */
	
	public  function __construct($userName, $password)
	{
		$this->userName = $userName;
		$this->passWord = $password;
	}
	
	/**
	 * Performs check
	 */
	public function authenticate()
	{
		echo '<br>UserName ', $this->userName,'<br>';
		echo 'PassWord ', $this->passWord, '<br>';
		
		//Temporary
		return  new Zend_Auth_Result(Zend_Auth_Result::SUCCESS, $this->userName, array('Poprawne logowanie'));
// 		Zend_Auth_Result::FAILURE
// 		Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND
// 		Zend_Auth_Result::FAILURE_IDENTITY_AMBIGUOUS
// 		Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID
// 		Zend_Auth_Result::FAILURE_UNCATEGORIZED		
	}
}
?>