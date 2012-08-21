<?php

// Display errors direct to output (debugging only, will invalidate JSON response) (defaults to false)
define('DISPLAY_ERRORS',true);

// Whether to include the Request object in the response (defaults to false)
define('RESPOND_WITH_REQUEST',false);

// DATABASE CONNECTION DETAILS
//-------------------------------------------------------------------------
define('dbNAME','rest_api');		// [required] Name of the database
define('dbUSER','rest_api_user');	// [required] Username for database
define('dbPASS','password');		// [required] Password for db user
define('dbHOST','localhost');		// [optional] DB Host (defaults to `localhost`)
define('dbTYPE','mysql');			// [optional] DB Type (defaults to mySQL)
define('dbCHARSET','utf-8');		// [optional] DB Charset (defaults to `utf-8`)
define('dbPREFIX','r_');			// [optional] Table prefix (defaults to null/'')


