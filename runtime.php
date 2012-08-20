<?php

// SET UP GLOBAL DEFINITIONS 
//=====================================================================

// Misc ----------------------------------------------
define('DS',DIRECTORY_SEPARATOR);


// File Paths ----------------------------------------
define('ROOT',dirname(__FILE__).'/');
define('LIB',ROOT.'lib/');
define('MODEL',ROOT.'model/');
define('CONFIG',ROOT.'config/');



// INCLUDE CONFIGURATION 
//	- Deployment specific configuration options
//=======================================================================
require CONFIG.'config.php';


// INCLUDE TOOLS
//	- Sets up automated globals and automagic class loader
//=======================================================================
require ROOT.'include.php';



