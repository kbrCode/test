<?php
ob_start("ob_gzhandler");
try {
	// Define base path obtainable throughout the whole application
	defined('BASE_PATH')
		|| define('BASE_PATH', realpath(dirname(__FILE__)));
	
	// Define path to application directory
	defined('APPLICATION_PATH')
		|| define('APPLICATION_PATH', BASE_PATH . '/../application');
	
	// Define application environment
	defined('APPLICATION_ENV')
		|| define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

	// definicja sciezki do uploadu plikow

	// zend path
	defined('FX_ZEND_PATH')
                || define('FX_ZEND_PATH', 'D:/Zend_Library/1.11.12/library');
	//	|| define('FX_ZEND_PATH', BASE_PATH.'/../../../Zend_Library/1.11.5/library');
	
	// Set include path to Zend (and other) libraries
	set_include_path(BASE_PATH . '/../library' .
			PATH_SEPARATOR . APPLICATION_PATH  .
			PATH_SEPARATOR . FX_ZEND_PATH .
			PATH_SEPARATOR . get_include_path() .
			PATH_SEPARATOR . '.'
		);
	
	// Require Zend_Application
	require_once 'Zend/Application.php';
	
	// Create application
	$application = new Zend_Application(
											APPLICATION_ENV,
											APPLICATION_PATH . '/configs/application.ini'
										);
	Zend_Locale::setDefault('pl_PL');
	
	$application->bootstrap()->run();
} catch (Exception $e){
#	$writer = new Zend_Log_Writer_Stream($application->getOption('fatalErrorLog'));
#	$logger = new Zend_Log($writer);
#	$logger->log($e,Zend_log::CRIT);
#	include('500.html');
	echo $e->getMessage();
}
while (@ob_end_flush());