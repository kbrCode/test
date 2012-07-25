<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	/**
	 * Zend_Controller_Front
	 *
	 * @var Zend_Controller_Front
	 */
	protected $fxfrontController;
/*
	protected function _initDb(){

		$this->bootstrap('config');
		$this->bootstrap('cache');
        // Get config resource
        $config = $this->getResource('config');

        // Setup database
        Zend_Db_Table_Abstract::setDefaultMetadataCache(Zend_Registry::get('cache'));
        $db = Zend_Db::factory($config->baza->adapter, $config->baza->toArray());
        $db->setFetchMode(Zend_Db::FETCH_OBJ);
        $db->query("SET NAMES 'utf8'");

        Zend_Db_Table::setDefaultAdapter($db);
        // Return it, so that it can be stored by the bootstrap
        return $db;
	}

	protected function _initLocale(){
		$locale = new Zend_Locale();
		$locale->setLocale('pl');
		Zend_Registry::set('Zend_Locale', $locale);
	}

	protected function _initTranslate(){
		$this->bootstrap('cache');
		$cache = $this->getResource('cache');
		Zend_Translate::setCache($cache);
	}
*/
	protected function _initAutoload(){
		$this->bootstrap('frontController');
		$this->fxfrontController = $this->getResource('frontController');
	}
/*
	protected function _initCache(){
		// Cache options
        $frontendOptions = array(
           	'lifetime' => 1200,                      // Cache lifetime of 20 minutes
           	'automatic_serialization' => true,
           	'automatic_cleaning_factor'=> 1,
			'cache_id_prefix' => 'RabbitCMS_',
        );
        $backendOptions = array(
            'lifetime' => 3600,                     // Cache lifetime of 1 hour
            'cache_dir' => BASE_PATH . '/../data/cache/',   // Directory where to put the cache files
        );

        // Get a Zend_Cache_Core object
        $cache = Zend_Cache::factory('Core', 'File', $frontendOptions, $backendOptions);
        Zend_Registry::set('cache', $cache);
        // Return it, so that it can be stored by the bootstrap
        return $cache;

	}

	protected function _initXajax(){
		FX_Acl_Index::getInstance()->setResource(new Zend_Config_Xml(APPLICATION_PATH.'/configs/acl.xml', 'ajax'), true);
		$loader = new Zend_Loader_Autoloader_Resource(array(
						'basePath'	=> APPLICATION_PATH.'/xajax',
						'namespace'	=> 'Ajax_',
						'resourceTypes' => array(array('path'=>'akcje/', 'namespace'=>'Akcja'))
					));
	}

	protected function _initControllers(){
		$this->fxfrontController->registerPlugin(new FX_Controller_Auth());
	}

	protected function _initRouters(){
		$router = $this->fxfrontController->getRouter();
		$router->removeDefaultRoutes();

//		$router->addRoute('error', new FX_Controller_RouteError());
		$router->addRoute('default', new FX_Controller_Route());
	}
*/
	protected function _initConfig(){
		// Retrieve configuration from file
//         $config = new Zend_Config_Xml(APPLICATION_PATH . '/configs/config.xml', APPLICATION_ENV);

//         // Add config to the registry so it is available sitewide
//         $registry = Zend_Registry::getInstance();
//         $registry->set('config', $config);
//         // Return it, so that it can be stored by the bootstrap
//         return $config;

		try
		{
			$dbAdapter = Zend_Db_Table::getDefaultAdapter();
		}
		catch (Zend_Db_Adapter_Exception $e) {
			// perhaps a failed login credential, or perhaps the RDBMS is not running
			echo 'Zend_Db_Table::getDefaultAdapter failed', ' ', $e->__toString();
		}
		catch (Zend_Exception $e) {
			// perhaps factory() failed to load the specified Adapter class
			echo $e->__toString();
		}
		
//		$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
		
		
		//This is in your bootstrap, note you can also use Zend_Config in the constructor
		$config = array(
				'name'           => 'session',      //table name as per Zend_Db_Table
				'primary'        => 'Session_ID',   //the sessionID given by php
				'modifiedColumn' => 'modified',     //time the session should expire
				'dataColumn'     => 'Session_data', //serialized data
				'lifetimeColumn' => 'lifetime'      //end of life for a specific record
		);
// 		$saveHandler = new Zend_Session_SaveHandler_DbTable($config);
// 		//cookie persist for 30 days
// 		Zend_Session::rememberMe($seconds = (60 * 60 * 24 * 30));
		
// 		//make the session persist for 30 days
// 		$savehandler->setLifetime($seconds)->setOverrideLifetime(true);
// 		//similarly,
// 		//$saveHandler->setLifetime($seconds, true);
// 		Zend_Session::setSaveHandler($saveHandler);
// 		Zend_Session::start();		
	}

	protected function _initView(){
        $view = new Zend_View();
        $view->doctype('XHTML1_STRICT');
        $view->env = APPLICATION_ENV;

        Zend_Registry::set("baseUrl", $view->baseUrl());

        $view->addHelperPath(APPLICATION_PATH."/views/helpers/", "FX_View_Helper_");
		$view->addScriptPath(APPLICATION_PATH."/views/scripts/");


        // Add it to the ViewRenderer
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->setView($view);
        // Return it, so that it can be stored by the bootstrap
        return $view;
	}
}