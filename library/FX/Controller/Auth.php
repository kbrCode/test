<?php
class FX_Controller_Auth extends Zend_Controller_Plugin_Abstract
{
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		echo "FX_Controller_Auth<br>";
		
		$auth = Zend_Auth::getInstance();
		$sessionamespace = new Zend_Session_Namespace('Default');

		if(isset($sessionamespace->userName))
		{
			$result = $auth->authenticate(new FX_Controller_MyAuthAdapter($sessionamespace->userName, $sessionamespace->password));
			if ($result->isValid())
			{
				;
			}
		}
		else{
			$sessionamespace->userName = 'anynomyous';
		}

	}

}
?>