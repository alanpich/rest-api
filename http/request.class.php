<?php namespace alanpich\REST\HTTP;

class Request {

public $PATH;
public $METHOD;
public $PARAMS = array();
public $RECEIVED;


function __construct(){
		$this->METHOD = $_SERVER['REQUEST_METHOD'];		
		$this->PATH = $this->getPath();
		$this->RECEIVED = $_SERVER['REQUEST_TIME'];
		
		$this->HEADERS = $this->getHeaders();
		
		$this->getParams();		
	}//
	
	
// Get the REST uri path
//-------------------------------------------------------------------------------
private function getPath(){
		if(isset($_GET['_api_path_'])){
			$path = $_GET['_api_path_'];
			unset($_GET['_api_path_']);
		} else {
			$path = '';
		};
		return $path;
	}//
	
	
// Get request headers (separated to allow cross-server-compatability)
//-------------------------------------------------------------------------------
private function getHeaders(){
		return apache_request_headers();
	}//
	
// Get the params for the current request method
//-------------------------------------------------------------------------------
private function getParams(){
		switch($this->METHOD){
			case 'GET'  	: $this->PARAMS = $this->getGET();	break;
			case 'POST' 	: $this->PARAMS = $_POST;			break;
			case 'PUT'		: $this->PARAMS = $_PUT;			break;
			case 'DELETE'	: $this->PARAMS = $_DELETE;			break;
		}//
	}//	
	
// Wrapper to get $_GET params (redirect hides them grrrr)
//-------------------------------------------------------------------------------
private function getGET(){
		$str = explode('?',$_SERVER['REQUEST_URI']);
		if(count($str)==1){ return array(); };

		$GET = array();
		// Split into params
		$params = explode('&',$str[1]);
		foreach($params as $P){
			// Split into key=>val
			$bits = explode('=',$P);
			$key = $bits[0];
			$val = isset($bits[1]) ? $bits[1] : '';
			$GET[$key] = $val;
		};
		return $GET;
	}//

};// end class alanpich\REST\HTTP\Request
