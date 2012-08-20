<?php namespace alanpich\REST;

class Service extends \xPDO {

function __construct(){

		// Set up xPDO Options -----------------------------------
		$opts = array(
	 		\xPDO::OPT_CACHE_PATH => TEMP.'cache/',
		    \xPDO::OPT_TABLE_PREFIX => dbPREFIX,
		    \xPDO::OPT_HYDRATE_FIELDS => true,
		    \xPDO::OPT_HYDRATE_RELATED_OBJECTS => true,
		    \xPDO::OPT_HYDRATE_ADHOC_FIELDS => true,
		    \xPDO::OPT_VALIDATE_ON_SAVE => true,	
		    \xPDO::OPT_AUTO_CREATE_TABLES => true,
		    
		    // Base classes to load on init
		    \xPDO::OPT_BASE_CLASSES => array(
		    		'REST_Service\model\BaseModel'
		    	)
		);
		parent::__construct(dbDSN,dbUSER,dbPASS,$opts);
		
		
		// Start Service ------------------------------------------
		$this->start();
	}//


private function start(){
		
		// Gather input into a nice object
		$this->Request = new HTTP\Request;
		
		print_r($this->Request);
		
		
		
		// We should have quit by now, but just in case...
		$Response = new HTTP\Response\Success;
		$Response->Send();
	}//


};// end class rest_service


