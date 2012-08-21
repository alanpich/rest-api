<?php


// SET CONFIG FOR ERROR OUTPUT
//------------------------------------------------------------------------
if(defined('DISPLAY_ERRORS') && DISPLAY_ERRORS){
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
} else {
	ini_set('display_errors', 0);
};


// AUTOMAGICAL CLASS LOADER
//------------------------------------------------------------------------
function __autoload($class){
		
		// Break into namespace bits
		$bits = explode('\\',$class);
		
		// If no namespacing, expect lib
		if(count($bits)==1){
			
			$lwr = strtolower($class);
			$path = LIB.$lwr.DS.$lwr.'.class.php';
		}
		
		// Test for alanpich/REST namespace (this project)
		else if( $bits[0] == 'alanpich' && $bits[1] == 'REST'){
			array_shift($bits); array_shift($bits);
			$path = ROOT.strtolower(implode(DS,$bits)).'.class.php';
		} else {
			echo "Unknown path [$class]\n";
		};
		
		if(file_exists($path)){
			require $path;
		};		
				
		
	}//
	
	
// PDO DSN GENERATOR 
//------------------------------------------------------------------------
if(defined('dbTYPE') && !defined('dbDSN')){

	$port = defined('dbPORT')? dbPORT : 3306;
	$charset = defined('dbCHARSET')? dbCHARSET : 'utf-8';
	$host = defined('dbHOST') ? dbHOST : 'localhost';

	switch( strtolower(dbTYPE) ){	
		case 'mysql'	:
		default			:	$DSN = 'mysql:host='.$host.';dbname='.dbNAME.';port='.$port.';charset='.$charset; break;
	};
	define('dbDSN',$DSN);
};


if(!defined('dbPREFIX')){	define('dbPREFIX',''); };


if(!defined('SERVER_NAME')){ define('SERVER_NAME',''); };



